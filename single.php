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
        <?php
        if (!isset($_GET['product'])) {
            $session->redirect("index.php");
        }

        $productInformation = $store->fetchProduct($_GET['product']);
        $productname = $productInformation[1];
        $description = $productInformation[2];
        $price = $productInformation[3];
        $productid = $productInformation[0];
        ?>
        <!-- grow -->
        <div class="grow">
            <div class="container">
                <h2><?php echo $productname; ?></h2>
            </div>
        </div>
        <!-- grow -->
        <div class="product">
            <div class="container">
                <div class="product-price1">
                    <div class="top-sing">
                        <div class="col-md-7 single-top">	
                            <div class="clearfix"> </div>
                            <!-- slide -->
                            <!-- FlexSlider -->
                            <script defer src="js/jquery.flexslider.js"></script>
                            <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
                            <script>
                                // Can also be used with $(document).ready()
                                $(window).load(function () {
                                    $('.flexslider').flexslider({
                                        animation: "slide",
                                        controlNav: "thumbnails"
                                    });
                                });
                            </script>
                            <div class="flexslider">
                                <ul class="slides">
                                    <?php
                                    $images = $store->getDisplays();
                                    for ($i = 0; $i < 4; $i++) {
                                        ?>
                                        <li data-thumb="<?php echo $images[$i]; ?>">
                                            <div class="thumb-image"> <img src="<?php echo $images[$i]; ?>" data-imagezoom="true" class="img-responsive"> </div>
                                        </li>                                    
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>	
                        <div class="col-md-5 single-top-in simpleCart_shelfItem">
                            <div class="single-para ">
                                <h4><?php echo $productname; ?></h4>
                                <h5 class="item_price">$ <?php echo $price; ?></h5>
                                <p>
                                    <?php print_r($description); ?>
                                </p>
                                <br />
                                <a href="addcart.php?product=<?php echo $productid; ?>" class="add-cart item_add">ADD TO CART</a>

                            </div>
                        </div>
                    </div>
                    <!---->
                    <?php /*
                      <div class=" bottom-product">
                      <?php
                      $products = $store->fetchNProducts(3);
                      for ($i = 0; $i < count($products); $i++) {
                      //            array_push($return, array($image, $productid, $productname, $description, $listprice));
                      ?>
                      <div class="col-md-4 bottom-cd simpleCart_shelfItem">
                      <div class="product-at ">
                      <a href="single.php?product=<?php echo $products[$i][1];?>"><img class="img-responsive" src="<?php echo $products[$i][0]; ?>" alt="a">
                      <div class="pro-grid">
                      <span class="buy-in">Buy Now</span>
                      </div>
                      </a>
                      </div>
                      <p class="tun"><span><?php echo $products[$i][2]; ?></span><br>CLARISSA</p>
                      <div class="ca-rt">
                      <a href="addcart.php?product=<?php echo $products[$i][1]; ?>" class="item_add"><p class="number item_price"><i> </i>$<?php echo $products[$i][4]; ?></p></a>
                      </div>
                      </div>
                      <?php } ?>
                      <div class="clearfix"> </div>
                      </div>
                     */ ?>
                </div>
            </div>
        </div>
        <!--//content-->
        <?php require_once('includes/footer.php'); ?>
    </body>
</html>
