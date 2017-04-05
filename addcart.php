<?php
require_once('includes/head_imports_meta.php');
$store->addToCart($_GET['prodid']);
$session->redirect($_SERVER['HTTP_REFERER']);
?>