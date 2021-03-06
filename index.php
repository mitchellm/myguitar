<?php
$refer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
?>

<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
    <head>
         <meta name="referrer" content="no-referrer" />
        <?php require_once('includes/head_imports_meta.php') ?>
        <?php
        if(isset($_GET['notice']) && strpos($refer, "index.php") == false && !is_null($refer)) {
            ?>
        <script type="text/javascript">
            alert("<?php echo $_GET['notice'] ?>");
        </script>
        <?php
        }
        ?>
    </head>
    <body>
        <!--header-->
        <?php require_once('includes/header.php'); ?>
        <div class="banner">
            <div class="container">
                <script src="js/responsiveslides.min.js"></script>
                <script>
                    $(function () {
                        $("#slider").responsiveSlides({
                            auto: true,
                            nav: true,
                            speed: 500,
                            namespace: "callbacks",
                            pager: true,
                        });
                    });
                </script>
                <div  id="top" class="callbacks_container">
                    <ul class="rslides" id="slider">
                        <?php
                        $banners = $store->fetchBanners();
                        $numBanners = count($banners);
                        for ($i = 0; $i < $numBanners; $i++) {
                            $title = $banners[$i]['title'];
                            $body = $banners[$i]['body'];
                            ?>
                            <li>
                                <div class="banner-text">
                                    <h3><?php echo $title; ?></h3>
                                    <p><?php echo $body; ?></p>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <!--content-->
        <div class="container">
            <div class="cont">
                <div class="content">
                    <div class="content-top-bottom">
                        <h2>COMING SOON PREVIEWS</h2>
                        <div class="col-md-6 men">
                            <a class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="images/t1.jpg" alt="">
                                <div class="b-wrapper">
                                    <h3 class="b-animate b-from-top top-in   b-delay03 ">
                                        <span>VOX MODEL 82 AMP</span>	
                                    </h3>
                                </div>
                            </a>


                        </div>
                        <div class="col-md-6">
                            <div class="col-md1 ">
                                <a class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="images/rare_spiral.jpg" alt="">
                                    <div class="b-wrapper">
                                        <h3 class="b-animate b-from-top top-in1   b-delay03 ">
                                            <span>Custom Jerry Guitar</span>	
                                        </h3>
                                    </div>
                                </a>

                            </div>
                            <div class="col-md2">
                                <div class="col-md-6 men1">
                                    <a class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="images/drums.jpg" alt="">
                                        <div class="b-wrapper">
                                            <h3 class="b-animate b-from-top top-in2   b-delay03 ">
                                                <span>Pearl Jam 5-Piece EXX725/C</span>	
                                            </h3>
                                        </div>
                                    </a>

                                </div>
                                <div class="col-md-6 men2">
                                    <a class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="images/bass_set.jpg" alt="">
                                        <div class="b-wrapper">
                                            <h3 class="b-animate b-from-top top-in2   b-delay03 ">
                                                <span>Telecaster Bass Set</span>	
                                            </h3>
                                        </div>
                                    </a>

                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="content-top">
                        <h1>RECENTLY PURCHASED</h1>
                        <div class="grid-in">
                            <?php
                            $recent = $store->fetchRecent();
                            for ($i = 0; $i < count($recent); $i++) {
                                $image = $recent[$i][0];
                                $prodid = $recent[$i][1];
                                $price = $recent[$i][2];
                                $prodname = $recent[$i][3];
                                ?>
                                <div class="col-md-3 grid-top simpleCart_shelfItem">
                                    <a href="single.php?prodid=<?php echo $prodid; ?>" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo $image; ?>" alt="">
                                        <div class="b-wrapper">
                                            <h3 class="b-animate b-from-left    b-delay03 ">
                                                <span><?php echo $prodname; ?></span>

                                            </h3>
                                        </div>
                                    </a>
                                    <p><a href="single.php?prodid=<?php echo $prodid; ?>"><?php echo $prodname; ?></a></p>
                                    <a href="addcart.php?prodid=<?php echo $prodid; ?>" class="item_add"><p class="number item_price"><i> </i>$<?php echo $price; ?></p></a>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
                <!----->
            </div>
            <!---->
        </div>
        <?php require_once('includes/footer.php'); ?> 
    </body>
</html>
