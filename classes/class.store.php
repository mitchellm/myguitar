<?php

require_once __DIR__ . '/class.session.php';

class Store extends Session {
    private $db;
   
    /**
     *
     * Checks if the user is logged in, if he is, it will make sure the session hasn't expired.
     */
    function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
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
}

