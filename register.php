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
                <h2>Register</h2>
            </div>
        </div>
        <!-- grow -->
        <!--content-->
        <div class=" container">
            <div class=" register">
                <?php if (!isset($_POST['submit'])) { ?>
                    <form action="register.php" method="post">
                        <div class="col-md-6 register-top-grid">
                            <h3>Personal infomation</h3>
                            <div>
                                <span>First Name</span>
                                <input name="fname" type="text"> 
                            </div>
                            <div>
                                <span>Last Name</span>
                                <input  name="lname" type="text"> 
                            </div>
                            <div>
                                <span>Email Address</span>
                                <input name="email" type="text"> 
                            </div>
                            <a class="news-letter" href="#">
                                <label class="checkbox"><input type="checkbox" name="nl" checked=""><i> </i>Sign Up for Newsletter</label>
                            </a>
                        </div>
                        <div class="col-md-6 register-bottom-grid">
                            <h3>Login information</h3>
                            <div>
                                <span>Password</span>
                                <input name="password" type="password">
                            </div>
                            <div>
                                <span>Confirm Password</span>
                                <input name="passwordconf" type="password">
                            </div>
                            <input name="submit" type="submit" value="submit">

                        </div>
                        <div class="clearfix"> </div>
                    </form>
                    <?php
                } else {
                    $session->register($_POST['email'], $_POST['password'], $_POST['passwordconf'], $_POST['fname'], $_POST['lname']);
                    if ($session->registered) {
                        $session->redirect("login.php");
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
