<?php
require_once('includes/head_imports_meta.php');
if (isset($_SERVER['HTTP_REFERER'])) {
    $refer = $_SERVER['HTTP_REFERER'];
    $len = strlen($refer);
    $start = $len - 12;
    $important = substr($refer, $start, $len);
    $orderitems = array();
    if($important == "checkout.php") {
        $cartItems = $store->getCart();
        foreach($cartItems as $key => $val) {
            $orderitems[] = $val;
        }
    }
    if($session->isLoggedIn()) {
        $qry = new QueryBuilder();
        $qry->insert_into('Orders', array('CustomerID' => $session->getUid()));
        $qry->exec();
    }
}
?>