<?php

require_once __DIR__ . '/../includes/global.php';

class Utility {

    private $db;

    /**
     *
     * Checks if the user is logged in, if he is, it will make sure the session hasn't expired.
     */
    function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    /**
     *
     * Securely hashes a string with a salt using both the md5 and sha1 algorithms
     * @param string $string to hash
     * @return string hashed string
     */
    function secureHash($string) {
        $salt = md5($string . "%*4!#$;\.k~'(_@");
        $string = md5("$salt$string$salt");
        $string = sha1($string);

        return $string;
    }

    /**
     * Generates a random ID with the length specified
     * @param int $length to use
     */
    function generateRandID($length) {
        return md5($this->generateRandStr($length));
    }

    /**
     * Generates a random string based on the length provided
     * @param int $length to use
     */
    function generateRandStr($length) {
        $randstr = "";
        for ($i = 0; $i < $length; $i++) {
            $randnum = mt_rand(0, 61);
            if ($randnum < 10) {
                $randstr .= chr($randnum + 48);
            } elseif ($randnum < 36) {
                $randstr .= chr($randnum + 55);
            } else {
                $randstr .= chr($randnum + 61);
            }
        }
        return $randstr;
    }

    /**
     *
     * Generates a VERY random string with a specific length
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
     * Redirects the the specified location
     * @param string $location to redirect to
     */
    function redirect($location) {
        if (!headers_sent())
            header('Location: ' . $location);
        else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . $location . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
            echo '</noscript>';
        }
    }

    static function buildAddressSearch($AddressID, $Line1, $Line2, $City, $State, $ZipCode, $Phone) {
        $query = "SELECT `AddressID`, `Line1`, `Line2`, `City`, `State`, `ZipCode`, `Phone` FROM `Addresses`";
        $init = 0;
        if ($AddressID != "") {
            if ($init > 0) {
                $query = $query . "AND ";
            } else {
                $query = $query . "WHERE ";
            }
            $query = $query . "AddressID LIKE '%{$AddressID}%' ";
            $init++;
        }
        if ($Line1 != "") {
            if ($init > 0) {
                $query = $query . "AND ";
            } else {
                $query = $query . "WHERE ";
            }
            $query = $query . "Line1 LIKE '%{$Line1}%' ";
            $init++;
        }
        if ($Line2 != "") {
            if ($init > 0) {
                $query = $query . "AND ";
            } else {
                $query = $query . "WHERE ";
            }
            $query = $query . "Line2 LIKE '%{$Line2}%' ";
            $init++;
        }
        if ($City != "") {
            if ($init > 0) {
                $query = $query . "AND ";
            } else {
                $query = $query . "WHERE ";
            }
            $query = $query . "City LIKE '%{$City}%' ";
            $init++;
        }
        if ($State != "") {
            if ($init > 0) {
                $query = $query . "AND ";
            } else {
                $query = $query . "WHERE ";
            }
            $query = $query . "State LIKE '%{$State}%' ";
            $init++;
        }
        if ($ZipCode != "") {
            if ($init > 0) {
                $query = $query . "AND ";
            } else {
                $query = $query . "WHERE ";
            }
            $query = $query . "ZipCode LIKE '%{$ZipCode}%' ";
            $init++;
        }
        if ($Phone != "") {
            if ($init > 0) {
                $query = $query . "AND ";
            } else {
                $query = $query . "WHERE ";
            }
            $query = $query . "Phone LIKE '%{$Phone}%' ";
            $init++;
        }
        return $query;
    }

    /**
     * Grabs info based on the parameter
     * @param string $arg to use
     * @return string|int
     */
    function get($arg) {
        if ($this->isLoggedIn()) {
            if ($arg == 'username' || $arg == 'sid') {
                switch ($arg) {
                    case 'username':
                        return ucfirst($_SESSION['username']);
                        break;
                    case 'sid':
                        return $_SESSION['sid'];
                        break;
                }
            } else {
                return 'Invalid $arg type for the get(); function!';
            }
        } else {
            return 'User is not logged in!';
        }
    }

}

?>