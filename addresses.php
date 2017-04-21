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
    </head>
    <body>
        <!--header-->
        <?php require_once('includes/header.php'); ?>
        <!-- grow -->
        <div class="grow">
            <div class="container">
                <h2>Attach address to your account</h2>
            </div>
        </div>
        <!-- grow -->
        <!--content-->
        <div class=" container">
            <?php
            if (!isset($_POST['submit'])) {
                ?>
                <div class=" register">
                    <form action="addresses.php" method="post">
                        <h3>Address infomation</h3>
                        <br/>
                        <div class="col-md-6 register-top-grid">
                            <div>
                                <span>Line 1</span>
                                <input name="line1" type="text"> 
                            </div>
                            <div>
                                <span>Line 2</span>
                                <input  name="line2" type="text"> 
                            </div>
                            <div>
                                <span>City</span>
                                <input name="city" type="text"> 
                            </div>
                        </div>
                        <div class="col-md-6 register-top-grid">
                            <div>
                                <span>State</span>
                                <input name="state" type="text"> 
                            </div>
                            <div>
                                <span>Zip</span>
                                <input name="zip" type="text"> 
                            </div>
                            <div>
                                <span>Phone</span>
                                <input name="phone" type="text"> 
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                        <input name="submit" type="submit" value="submit">
                    </form>
                </div>
                <?php
            } else {
                if( !(isset($_POST['line1']) && isset($_POST['line2']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['zip']) && isset($_POST['phone'])) )
                    echo "<br /><h3>Failed to properly fill out address form, go back and <a href=\"addresses.php\">try again!</a></h3>";
                else if($_POST['line1'] == "" || $_POST['line2'] == "" || $_POST['city'] == "" || $_POST['state'] == "" || $_POST['zip'] == "" || $_POST['phone'] == "")
                    echo "<br /><h3>Failed to properly fill out address form, go back and <a href=\"addresses.php\">try again!</a></h3>";
                else 
                    $session->pairAddress($_POST['line1'], $_POST['line2'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['phone']);
            }
            ?>
        </div>
        <!--//content-->
        <?php require_once('includes/footer.php'); ?>
    </body>
</html>
<?php
