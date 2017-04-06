<?php

require_once('includes/head_imports_meta.php');
if (!isset($_GET['all'])) {
    $store->removeCart($_POST['product'], $_POST['amount']);
    $session->redirect("checkout.php");
} else {
    $store->removeCart($_GET['product'], 0, true);
    $session->redirect("checkout.php");
}
?>