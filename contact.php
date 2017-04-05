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
                <h2>Contact</h2>
            </div>
        </div>
        <!-- grow -->
        <!--content-->
        <div class="contact">

            <div class="container">
                <div class="contact-form">

                    <div class="col-md-8 contact-grid">
                        <form action="#" method="post">
                            <input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {
                                        this.value = 'Name';
                                    }">

                            <input type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {
                                        this.value = 'Email';
                                    }">
                            <input type="text" value="Subject" onfocus="this.value = '';" onblur="if (this.value == '') {
                                        this.value = 'Subject';
                                    }">

                            <textarea cols="77" rows="6" value=" " onfocus="this.value = '';" onblur="if (this.value == '') {
                                        this.value = 'Message';
                                    }">Message</textarea>
                            <div class="send">
                                <input type="submit" value="Send">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 contact-in">

                        <div class="address-more">
                            <h4>Address</h4>
                            <p>The company name,</p>
                            <p>Lorem ipsum dolor,</p>
                            <p>Glasglow Dr 40 Fe 72. </p>
                        </div>
                        <div class="address-more">
                            <h4>Address1</h4>
                            <p>Tel:1115550001</p>
                            <p>Fax:190-4509-494</p>
                            <p>Email:<a href="mailto:contact@example.com"> contact@example.com</a></p>
                        </div>

                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>

        </div>
        <!--//content-->
        <?php require_once('includes/footer.php'); ?>
    </body>
</html>
