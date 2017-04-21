<div class="header">
    <div class="header-top">
        <div class="container">
            <div class="social">
                <ul>
                    <li><a href="#"><i class="facebok"> </i></a></li>
                    <li><a href="#"><i class="twiter"> </i></a></li>
                    <li><a href="#"><i class="inst"> </i></a></li>
                    <li><a href="#"><i class="goog"> </i></a></li>
                    <div class="clearfix"></div>	
                </ul>
            </div>
            <div class="header-left">

                <div class="search-box">
                    <div id="sb-search" class="sb-search">
                        <form action="#" method="post">
                            <input class="sb-search-input" placeholder="Enter your search term..." type="search"  id="search">
                            <input class="sb-search-submit" type="submit" value="">
                            <span class="sb-icon-search"> </span>
                        </form>
                    </div>
                </div>

                <!-- search-scripts -->
                <script src="js/classie.js"></script>
                <script src="js/uisearch.js"></script>
                <script>
                    new UISearch(document.getElementById('sb-search'));
                </script>
                <!-- //search-scripts -->
                <div class="ca-r">
                    <div class="cart box_1">
                        <a href="checkout.php">
                            <h3> 
                                <div class="total">
                                    $<?php echo $store->getCartTotal(); ?>
                                </div>
                                <img src="images/cart.png" alt=""/>
                            </h3>
                        </a>
                        <p><a href="emptycart.php">Empty Cart</a></p>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="head-top">
            <div class="logo">
                <h1><a href="index.php">Guitar Shop</a></h1>
            </div>
            <div class=" h_menu4">
                <ul class="memenu skyblue">	
                    <li><a class="color1" href="products.php">PRODUCTS</a>
                        <div class="mepanel">
                            <div class="row">
                                <?php
                                $products = $store->getProductList();
                                $count = count($products);
                                $factor = ceil($count / 3);
                                $chunk = array_chunk($products, $factor);
                                foreach ($chunk as $piece) {
                                    ?>
                                    <div class="col1">
                                        <div class="h_nav">
                                            <ul>
                                                <?php
                                                for ($i = 0; $i < count($piece); $i++) {
                                                    ?>
                                                    <li><a href="single.php?product=<?php echo $piece[$i][1]; ?>"><?php echo $piece[$i][0]; ?></a></li>
                                                    <?php
                                                }
                                                ?>

                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </li>	
                    <?php if (!$session->isLoggedIn()) { ?>
                        <li><a class="color4" href="login.php">Login</a></li>	
                        <li><a class="color4" href="register.php">Register</a></li>				
                    <?php } if ($session->isAdministrator()) { ?>
                        <li><a class="color4" href="admincp.php">Administrator</a></li>	
                    <?php } ?>
                    <?php if ($session->isLoggedIn()) { ?> 
                        <li><a class="color4" href="addresses.php">Addresses</a></li>
                        <li><a class="color4" href="deposit.php">Balance: <?php echo $session->getBalance(); ?>$</a></li>
                        <li><a class="color4" href="logout.php">Logout</a></li>
                    <?php } ?>
                </ul> 
            </div>

            <div class="clearfix"> </div>
        </div>
    </div>
</div>