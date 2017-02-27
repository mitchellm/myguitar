<?php
/**
 * @Author Mitchell M
 * @package What's Your Beef
 * @version 1.00
 */

/**
 * Starting sessions
 */
session_start();
define('SESSION_LENGTH', '30');

define('STORE_TITLE', 'JGS');
/**
 *
 * Defining Database Settings
 * @var strings
 */
define('DB_HOST','127.0.0.1');
define('DB_NAME','MyGuitarShop');
define('DB_USER','root');
define('DB_PASS','');

/* For cleaner inclusions */
define('ROOT', dirname(__FILE__). '/../');
define('ROOT_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT))));

error_reporting(E_ALL);
?>