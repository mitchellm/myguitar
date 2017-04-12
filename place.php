<?php

require_once('includes/head_imports_meta.php');

if ($session->isLoggedIn() == false)
    Utility::redirect("index.php?notice=You must be logged in to place an order!");
else if($store->hasItems() == false) {
    Utility::redirect("index.php?notice=You don't have any items in your cart.");
    
}
$refer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
$len = strlen($refer);
$start = $len - 12;
$important = substr($refer, $start, $len);
$orderitems = array();
if ($important == "checkout.php") {
    $cartItems = $store->getCart();
    foreach ($cartItems as $key => $val) {
        $orderitems[] = $val;
    }
    if ($session->isLoggedIn()) {
        $cartTotal = $store->getCartTotal();
        $tax = $cartTotal * .07;
        $ship = $cartTotal * .15;
        $qry = QueryBuilder::getInstance();
        $qry->insert_into('Orders', array('CustomerID' => $session->getUid(), 'ShipAmount' => $ship, 'TaxAmount' => $tax));
        $qry->exec();
        $qry2 = QueryBuilder::getInstance();
        $qry2->select('OrderID')->from('Orders')->where('OrderDate', '=', "__NOW")->limit(1);
        $result = $qry2->get();
        $orderid = $result[0]['OrderID'];
        foreach ($orderitems as $key => $val) {
            $quantity = $val[3];
            $productid = $val[5];
            $discount = $val[6];
            $price = $val[0];
            $qry3 = QueryBuilder::getInstance();
            $qry3->insert_into('orderitems', array('OrderID' => $orderid, 'ProductID' => $productid, 'Quantity' => $quantity, 'ItemPrice' => $price, 'DiscountAmount' => $discount));
            $qry3->exec();
        }
        $store->emptyCart();
        Utility::redirect("index.php?notice=Order successfully placed, cart cleared.");
    } else {
        
    }
} else {
    $location = "index.php";
    echo '<script type="text/javascript">';
    echo 'window.location.href="' . $location . '";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
    echo '</noscript>';
}
?>