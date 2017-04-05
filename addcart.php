<?php

require_once('includes/head_imports_meta.php');
$store->addToCart($_GET['product']);
$session->redirect($_SERVER['HTTP_REFERER']);
?>