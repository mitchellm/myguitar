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
                <h2>Login</h2>
            </div>
        </div>
        <!-- grow -->
        <!--content-->
        <div class="container">
            <div class="account">
                <div class="account-pass">
                    <div class="col-md-8 account-top">
                        <?php if (!isset($_POST['submit'])) { ?>
                            <form action="login.php" method="post">

                                <div> 	
                                    <span>Email</span>
                                    <input name="email" type="text"> 
                                </div>
                                <div> 
                                    <span >Password</span>
                                    <input name="password" type="password">
                                </div>				
                                <input name="submit" type="submit" value="Login"> 
                            </form>
                            <?php
                        } else {
                            if ($session->login($_POST['email'], $_POST['password'])) {
                                $session->redirect('./index.php');
                            }
                        }
                        ?>
                    </div>
                    <div class="col-md-4 left-account ">
                        <a href="single.php"><img class="img-responsive " src="images/shutter_guitar.jpg" alt=""></a>
                        <div class="five">
                            <h2>25% </h2><span>discount</span>
                        </div>
                        <a href="register.php" class="create">Create an account</a>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>

        </div>

        <!--//content-->
        <?php require_once('includes/footer.php'); ?>
    </body>
</html>
