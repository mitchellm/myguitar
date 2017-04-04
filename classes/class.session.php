<?php

require_once __DIR__ . '/class.util.php';
require_once __DIR__ . '/../includes/global.php';

class Session extends Util {

    private $db;
    var $registered;

    /**
     *
     * Checks if the user is logged in, if he is, it will make sure the session hasn't expired.
     */
    function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->isLoggedIn() ? $this->checkSession($_SESSION['sid'], time()) : '';
    }

    /**
     *
     * Inserts the new user into the mysql database.
     */
    function register($email, $pass, $confirm, $fname, $lname) {
        $password = $pass;

        $errors = array();

        if (!$password) {
            $errors[] = "Password is not defined!";
        }

        if (!$fname) {
            $errors[] = "First name is not defined!";
        }

        if (!$lname) {
            $errors[] = "Last name is not defined!";
        }

        if ($password) {
            if (!$confirm) {
                $errors[] = "Confirmation password is not defined!";
            }
        }
        if (!$email) {
            $errors[] = "E-mail is not defined!";
        }

        if ($password && $confirm) {
            if ($password != $confirm) {
                $errors[] = "Passwords do not match!";
            }
        }

        if ($email) {
            $checkemail = "/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
            if (!preg_match($checkemail, $email)) {
                $errors[] = "E-mail is not valid, must be name@server.tld!";
            }
        }

        if ($email) {
            $stmt = $this->db->prepare("SELECT * FROM `customers` WHERE `EmailAddress`= ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $errors[] = "The e-mail address you supplied is already in use of another user!";
            }
            $stmt->close();
        }

        if (count($errors) > 0) {
            foreach ($errors AS $error) {
                echo $error . "<br>\n";
            }
            echo "<br />Return to the register form: <a href=\"./register.php\" class=\"boldAnchor\">here</a>";
        } else {
            $fname = ucfirst($fname);
            $lname = ucfirst($fname);
            $email = strtolower($email);
            $pass = Util::secureHash($pass);
            $stmt = $this->db->prepare("INSERT INTO `customers` (`FirstName` ,`LastName` ,`EmailAddress`, `Password`)VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $fname, $lname, $email, $pass);
            $stmt->execute();
            $stmt->close();
            $this->registered = true;
        }
    }

    /**
     *
     * Validates a username and password, returns based on success or failure
     * @param string|int $user
     * @param string|int $pass
     * @return boolean
     */
    function checkLogin($user, $pass, $echo = false) {
        $user = strtolower($user);
        $pass = Util::secureHash($pass);

        $stmt = $this->db->prepare("SELECT * FROM `customers` WHERE `EmailAddress` = ? AND `Password` = ?");
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();
        $stmt->store_result();
        echo $stmt->num_rows;
        if ($stmt->num_rows > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     *
     * Sets a user session using the php $_SESSION array as well as inserting the rows into the session DB table
     * @param string|int $user
     * @param string|int $pass
     */
    function setSession($user, $pass) {
        $loginCode = $this->checkLogin($user, $pass);
        if ($loginCode == 0) {
            $username = htmlspecialchars(mysqli_real_escape_string($this->db, $user));
            $password = Util::secureHash($pass);
            $stmt = $this->db->query("SELECT CustomerID FROM `Customers` WHERE EmailAddress ='{$username}'");
            $data = $stmt->fetch_array(MYSQLI_ASSOC);
            $stmt->close();

            $stmt = $this->db->query("SELECT * FROM sessions WHERE uid = '{$data['CustomerID']}'");
            if ($stmt->num_rows >= 1) {
                $delete = $this->db->query("DELETE FROM sessions WHERE uid='{$data['CustomerID']}'");
            }
            $sid = Util::generateRandID(16);
            $timestamp = time() + 60 * SESSION_LENGTH;
            $insertQuery = $this->db->query("INSERT INTO `sessions` (`uid`,`sid`,`timestamp`) VALUES ('{$data['CustomerID']}', '{$sid}', '{$timestamp}')");
            $_SESSION['username'] = $username;
            $_SESSION['sid'] = $sid;
            return true;
        } else if ($loginCode == 1)  {
            echo "Failed to login, please try again.";
            echo "<br />Return to the login form: <a href=\"./login.php\" class=\"boldAnchor\">here</a>";
        }
    }

    /**
     *
     * Clears all sessions on the website
     */
    function clearSiteSessions() {
        if ($this->isAdministrator()) {
            $query = $this->db->query("DELETE FROM sessions");
        } else {
            return;
        }
    }

    /**
     * Deletes the current session from the database and destroys the session.
     * @param string $sid the session id to remove
     */
    function clearSession($sid) {
        $sid = mysqli_real_escape_string($sid);
        $query = $this->db->query("DELETE FROM sessions WHERE sid='{$sid}'");
        Util::redirect('index.php?notice=You have been logged out! Your session may have expired!');
        session_destroy();
    }

    /**
     * Checks for an expired session
     * @param string $sid to check
     * @param int $time to evaluate
     */
    function checkSession($sid, $time) {
        $timestamp = time();
        $sid = htmlentities(mysqli_real_escape_string($this->db, $sid));
        $stmt = $this->db->prepare("SELECT timestamp, uid FROM `sessions` WHERE `sid` = ?");
        $stmt->bind_param("s", $sid);
        $stmt->bind_result($timestamp, $uid);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows >= 1) {
            while ($stmt->fetch()) {
                if ($time > $timestamp) {
                    $this->clearSession($sid);
                    return true;
                }
            }
        }
        $stmt->close();

        $updateClick = $this->db->prepare("UPDATE `sessions` SET `lastclick` = ? WHERE sid = ?");
        $updateClick->bind_param("is", $timestamp, $sid);
        $updateClick->execute();
        $updateClick->close();


        return false;
    }
    
    function addToCart($prodID) {
        if(isset($_SESSION['cart'][$prodID])) {
            $_SESSION['cart'][$prodID]++;
        } else {
            $_SESSION['cart'][$prodID] = 1;
        }
    }
     
    function removeCart($prodID, $quantity, $all = false) {
        if(isset($_SESSION['cart'][$prodID])) {
            if(!$all) {
                $_SESSION['cart'][$prodID] = $_SESSION['cart'][$prodID] - $quantity;
                if($_SESSION['cart'][$prodID] < 1)
                    unset($_SESSION['cart'][$prodID]);
            } else {
                unset($_SESSION['cart'][$prodID]);
            }
        }
    }
    
    function emptyCart() {
        if(isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
    }
    
    function getCartTotal() {
        $totalprice = 0;
        if(isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $key => $val) {
                $mysqli = $this->db->prepare("SELECT `ListPrice` FROM `Products` WHERE `ProductID` = ?");
                $mysqli->bind_param("i", $key);
                $mysqli->bind_result($price);
                $mysqli->execute();
                while($mysqli->fetch()) {
                    $totalprice+=($price) * $val;
                }
            }
        }
        return $totalprice;
    }
    
    function getCart() {
        $return = array();
        if(isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $item => $quantity) {
                $mysqli = $this->db->prepare("SELECT `ListPrice`, `ProductName`, `Description`, `ProductCode` FROM `Products` WHERE `ProductID` = ?");
                $mysqli->bind_param("i", $item);
                $mysqli->bind_result($price,$name,$description,$productcode);
                $mysqli->execute();
                while($mysqli->fetch()) {
                    $return[$item] = array($price,$name,$description,$quantity,$productcode);
                }
            }
        }
        return $return;
    }
    
    /**
     * fetchProducts
     * @return array(image path, productid, productname, description, listprice)
     */
    function fetchProducts() {
        $return = array();
        $mysqli = $this->db->prepare("SELECT `image`, `ProductID`, `ProductName`, `Description`, `ListPrice` FROM `Products` WHERE `image` IS NOT NULL");
        $mysqli->bind_result($image, $productid, $productname, $description, $listprice);
        $mysqli->execute();
        while($mysqli->fetch()) {
            array_push($return, array($image, $productid, $productname, $description, $listprice));
        }
        return $return;
    }
    
    /**
     * Fetches information about specific product
     */
    function fetchProduct($product_id) {
        $return = array();
        $mysqli = $this->db->prepare("SELECT `ProductID`, `ProductName`, `Description`, `ListPrice` FROM `Products` WHERE `ProductID` = ?");
        $mysqli->bind_result($productID, $productname, $description, $listprice);
        $mysqli->bind_param("i", $product_id);
        $mysqli->execute();
        while($mysqli->fetch()) {
            return array($productID, $productname, $description, $listprice);
        }
    }
    
    /**
     * fetchProducts
     * @return array(image path, productid, productname, description, listprice)
     */
    function fetchNProducts($n) {
        $return = array();
        $mysqli = $this->db->prepare("SELECT `image`, `ProductID`, `ProductName`, `Description`, `ListPrice` FROM `Products` WHERE `image` IS NOT NULL LIMIT ?");
        $mysqli->bind_result($image, $productid, $productname, $description, $listprice);
        $mysqli->bind_param("i", $n);
        $mysqli->execute();
        while($mysqli->fetch()) {
            array_push($return, array($image, $productid, $productname, $description, $listprice));
        }
        return $return;
    }
    
    /**
     * return array(image, prodID, price)
     */
    function fetchRecent() {
        $return = array();
        $mysqli = $this->db->prepare("Select products.productname, products.image, orderitems.ProductID, products.ListPrice "
                . "FROM products "
                . "LEFT JOIN orderitems "
                . "ON orderitems.ProductID = products.ProductID "
                . "WHERE orderitems.orderID IS NOT NULL "
                . "ORDER BY orderitems.OrderID "
                . "LIMIT 4");
        $mysqli->bind_result($name, $image,$prodid,$price);
        $mysqli->execute();
        while($mysqli->fetch()) {
            array_push($return, array($image, $prodid, $price, $name));
        }
        return $return;
    }
    
    /**
     * getProductList
     * @return array(productname, productid)
     */
    function getProductList() {
        $return = array();
        $mysqli = $this->db->prepare("SELECT `ProductName`, `ProductID` FROM `Products`");
        $mysqli->bind_result($productname, $productid);
        $mysqli->execute();
        while($mysqli->fetch()) {
            array_push($return, array($productname, $productid));
        }
        return $return;
    }
    
    /**
     * Fetch display pictures (potentially random, purely for display)
     */
    function getDisplays() {
        $return = array();
        $mysqli = $this->db->prepare("SELECT image FROM Products");
        $mysqli->bind_result($image);
        $mysqli->execute();
        while($mysqli->fetch()) {
            array_push($return, $image);
        }
        return $return;
    }

    /**
     *
     * Generates a random string with a specific length
     * @param int $length of string
     * @return string generated
     */
    function rand_sha1($length) {
        $max = ceil($length / 40);
        $random = '';
        for ($i = 0; $i < $max; $i ++) {
            $random .= sha1(microtime(true) . mt_rand(10000, 90000));
        }
        return substr($random, 0, $length);
    }
    
    /**
     * Checks if user is logged in
     * @return boolean
     */
    function isLoggedIn() {
        if (isset($_SESSION['sid'])) {
            return true;
        }
        return false;
    }
    
    /**
     *
     * Checks online users
     * @param int[] $uidArray
     * @return string users
     */
    function getOnlineUsers($uidArray) {
        if (count($uidArray) > 0) {
            foreach ($uidArray as $uid) {
                $query = $this->db->prepare("SELECT `EmailAddress` FROM `customers` WHERE `CustomerID` = ?");
                $query->bind_param("i", $uid);
                $query->bind_result($username);
                $query->execute();
                while ($query->fetch()) {
                    $users[] = $username;
                }
            }
        } else {
            $users[] = "Nobody is currently logged in!";
        }
        return $users;
    }

    /**
     *
     * Gets username of logged in user
     * @param int $uid
     * @return string
     */
    function getUsername($uid = null) {
        $uid = $uid == null ? $this->getUid() : $uid;
        $stmt = $this->db->prepare("SELECT `EmailAddress` FROM `customers` WHERE `CustomerID` = ?");
        $stmt->bind_param("i", $uid);
        $stmt->bind_result($username);
        $stmt->execute();
        while ($stmt->fetch()) {
            return $username;
        }
    }

    /**
     *
     * Gets all currently active sessions
     * @return multitype:string
     */
    function getCurrentSessions() {
        $sessions = array();
        $timeVar = time() - (60 * SESSION_LENGTH);
        $stmt = $this->db->prepare("SELECT uid FROM `sessions` WHERE lastclick > ?");
        $stmt->bind_param("i", $timeVar);
        $stmt->bind_result($uid);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {

                $sessions[] = $uid;
            }
        }
        return $sessions;
    }

    /**
     *
     * Gets the user's uid based on a valid session
     * @return int $uid
     */
    function getUid() {
        if (isset($_SESSION['sid'])) {
            $stmt = $this->db->prepare("SELECT uid FROM sessions WHERE `sid` = ?");
            $stmt->bind_param("s", $_SESSION['sid']);
            $stmt->bind_result($uid);
            $stmt->execute();
            while ($stmt->fetch()) {
                return $uid;
            }
        }
        return false;
    }

}

?>