<?php
require_once('includes/head_imports_meta.php');
$session->addToCart($_GET['prodid']);
$session->redirect("index.php");
?>