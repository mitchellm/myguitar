<?php

require_once('includes/head_imports_meta.php');
$refer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
$len = strlen($refer);
$start = $len - 12;
$important = substr($refer, $start, $len);
$orderitems = array();
if ($important == "checkout.php") {
    $cartItems = $store->getCart();
    if($cartItems < 1) {
        echo "Cart empty, check out our products in the top-left navbar and featured listings available on our home page!";
    }
    else {
        foreach ($cartItems as $key => $val) {
            $orderitems[] = $val;
        }
    }
    if ($session->isLoggedIn()) {
        $cartTotal = $store->getCartTotal();
        $tax = $cartTotal * .07;
        $ship = $cartTotal * .15;
        $qry = new QueryBuilder();
        $qry->insert_into('Orders', array('CustomerID' => $session->getUid(), 'ShipAmount' => $ship, 'TaxAmount' => $tax));
        $qry->exec();
        $qry2 = new QueryBuilder();
        $qry2->select('OrderID')->from('Orders')->where('OrderDate', '=', "__NOW")->limit(1);
        $result = $qry2->get();
        $orderid = $result[0]['OrderID'];
        foreach ($orderitems as $key => $val) {
            die(var_dump($val[3]));
            $quantity = $val[3];
            $productid = $val[5];
            $discount = $val[6];
            $price = $val[0];
            $qry3 = new QueryBuilder();
            $qry3->insert_into('orderitems', array('OrderID' => $orderid, 'ProductID' => $productid, 'Quantity' => $quantity, 'ItemPrice' => $price, 'DiscountAmount' => $discount));
            $qry3->exec();
        }
        echo "Order successfully placed, cart cleared. You can return to the homepage here: <a href=\"index.php\">Click</a>";
        $store->emptyCart();
    }
} else {
    $location ="index.php";
    echo '<script type="text/javascript">';
    echo 'window.location.href="' . $location . '";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
    echo '</noscript>';
}
?>
