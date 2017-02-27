<?php
require_once('includes/head_imports_meta.php');
if(!isset($_GET['all'])) {
    $session->removeCart($_POST['prodid'], $_POST['amount']);
    $session->redirect("checkout.php");
} else {
    $session->removeCart($_GET['prodid'], 0, true);
    $session->redirect("checkout.php");
}
?>