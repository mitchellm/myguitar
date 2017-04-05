<?php

require_once('includes/head_imports_meta.php');
$session->clearSession($_SESSION['sid']);
$session->redirect("index.php");
?>