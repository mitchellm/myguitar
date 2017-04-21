<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
    <head>
        <?php require_once('includes/head_imports_meta.php') ?>
        <?php $session->isLoggedIn() == true ? null : Utility::redirect("index.php"); ?>
    </head>
    <body>
        <!--header-->
        <?php require_once('includes/header.php'); ?>
        <!-- grow -->
        <div class="grow">
            <div class="container">
                <h2>Deposit</h2>
            </div>
        </div>
        <!-- grow -->
        <!--content-->
        <div class=" container">
            <div class=" register">
                <?php if (!isset($_POST['submit'])) { ?>
                    <form action="deposit.php" method="post">
                        <div class="col-md-6 register-top-grid">
                            <h3>Payment Information</h3>
                            <div>
                                <span>ACCOUNT #</span>
                                <input name="acc" type="text"> 
                            </div>
                            <div>
                                <span>ROUTING #</span>
                                <input  name="rout" type="text"> 
                            </div>
                            <div>
                                <span>CONFIRM ROUTING #</span>
                                <input name="confrout" type="text"> 
                            </div>
                        </div>
                        <div class="col-md-6 register-top-grid">
                            <h3>Amount Information</h3>
                            <div>
                                <span>AMOUNT</span>
                                <input name="total" type="text"> 
                            </div>
                            <div>
                                <span>CONFIRM AMOUNT</span>
                                <input  name="conftotal" type="text"> 
                            </div>
                            <input name="submit" type="submit" value="submit">
                        </div> 
                        <div class="clearfix"> </div>
                    </form>
                    <?php
                } else {
                        ?>
                <?php
                    if (isset($_POST['acc']) && isset($_POST['rout']) && isset($_POST['confrout']) && $_POST['rout'] == $_POST['confrout'] &&
                            $session->deposit($_POST['total'], $_POST['conftotal'])) {
                        ?>
                <h3>You have deposited <?php echo number_format(html_entity_decode($_POST['total']), 2); ?></h3>
                        <?php
                    } else {
                        ?>
                        
                <h3>You have failed to properly fill out the deposit form. <a href="deposit.php">Try again</a>.</h3>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <!--//content-->
        <?php require_once('includes/footer.php'); ?>
    </body>
</html>
<?php
