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
        <!-- products -->
        <!-- grow -->
        <div class="grow">
            <div class="container">
                <h2>Products Catalog</h2>
            </div>
        </div>
        <!-- grow -->
        <div class="pro-du">
            <div class="container">
                <div class="col-md-9 product1">
                        <?php
                        $products = $session->fetchProducts();
                        for ($i = 0; $i < count($products); $i+=2) {
                                $image = $products[$i][0];
                                $productid = $products[$i][1];
                                $productname = $products[$i][2];
                                $desc = $products[$i][3];
                                $price = $products[$i][4];
                                if(strlen($desc) > 100) {
                                    $desc = substr($products[$i][3],0,100);
                                    $desc = $desc . "...";
                                }
     // @return array(image path, productid, productname, description, listprice)
                                ?>
                     
                    <div class=" bottom-product">
                        <div class="col-md-6 bottom-cd simpleCart_shelfItem">
                            <div class="product-at ">
                                <a href="single.php?prodid=<?php echo $productid; ?>"><img class="img-responsive" src="<?php echo $image; ?>" alt="">
                                    <div class="pro-grid">
                                        <span class="buy-in">Buy Now</span>
                                    </div>
                                </a>	
                            </div>
                            <p class="tun"><span><?php echo $productname; ?></span><br><?php echo $desc; ?></p>
                            <div class="ca-rt">                                        
                                <a href="addcart.php?prodid=<?php echo $productid; ?>" class="item_add"><p class="number item_price"><i> </i>$<?php echo $price; ?> </p></a>						
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php
                        $image = $products[$i+1][0];
                        $productid = $products[$i+1][1];
                        $productname = $products[$i+1][2];
                        $desc = $products[$i+1][3];
                        $price = $products[$i+1][4];
                        if(strlen($desc) > 100) {
                            $desc = substr($products[$i+1][3],0,100);
                            $desc = $desc . "...";
                        }
                        ?>
                         
                        <div class="col-md-6 bottom-cd simpleCart_shelfItem">
                            <div class="product-at ">
                                <a href="single.php?product=<?php echo $productid; ?>"><img class="img-responsive" src="<?php echo $image; ?>" alt="">
                                    <div class="pro-grid">
                                        <span class="buy-in">Buy Now</span>
                                    </div>
                                </a>	
                            </div>
                            <p class="tun"><span><?php echo $productname; ?></span><br><?php echo $desc; ?></p>
                            <div class="ca-rt">                                        
                                <a href="addcart.php?prodid=<?php echo $productid; ?>" class="item_add"><p class="number item_price"><i> </i>$<?php echo $price; ?> </p></a>						
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                                <?php
                        }
                        ?>
                </div>
                <div class="col-md-3 prod-rgt">
                    <div class="pr-btm">
                        <h4>What do our clients say</h4>
                        <img class="img-responsive" src="images/pi.jpg" alt="">
                        <h6>John</h6>
                        <p>Lorem Ipsum is simply dummy text of the printing industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                        
                        <img class="img-responsive" src="images/pi.jpg" alt="">
                        <h6>Tom</h6>
                        <p>Lorem Ipsum is simply dummy text of the printing industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                        
                        <img class="img-responsive" src="images/pi.jpg" alt="">
                        <h6>Lom</h6>
                        <p>Lorem Ipsum is simply dummy text of the printing industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                    </div>
                    
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- products -->
        <?php require_once('includes/footer.php'); ?>
    </body>
</html>
