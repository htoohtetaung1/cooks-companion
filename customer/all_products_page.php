<!-- set page name and import html head -->
<?php
$pagename = "Browse our kitchenware!";
include("head.php");
include("connect.php");
include("fetch_Product.php");
include('calculate_price.php');
?>

<!-- import nav bar -->
<?php
include("navbar.php");
?>

<div class="main">
    <div class="products-hero">
        <h3>All Our Products</h3>
        <p>Find your next kitchen companion and also see our newest products and latest promotions!</p>
    </div>

    <!-- new carousel -->
    <div class="carousel-row">
        <div class="carousel-title-div">
            <div class="carousel-title">New Products</div>
            <div class="carousel-browse-link"><a href="search_process.php?sort=product_id">Browse All Products ></a></div>
        </div>
        <div class="carousel-group">
            <button class="carousel-arrow carousel-arrow--prev" onclick="moveCarousel(false,'new-carousel','new-carousel-item')">
                &#8249;
            </button>

            <div class="carousel-container new-carousel">
                <?php
                $newProducts = fetchProducts($pdo, "newest");
                // show 8 newest products in the carousel 
                foreach (array_slice($newProducts, 0, 8) as $product): {
                        $product['photo'] = '../admin/' . $product['photo'];
                        if (!empty($product['photo']) && file_exists($product['photo'])) {
                            $imgSrc = $product['photo']; // Path to the image
                        } else {
                            // Default placeholder image if no image is found or the path is incorrect
                            $imgSrc = "img/default.png"; // Ensure this default image exists
                        }
                    }


                ?>

                    <div class="carousel-item new-carousel-item">
                        <a href="<?= 'product_detail_page.php?id=' . $product['product_id'] ?>">
                            <img src="<?php echo $imgSrc; ?>" alt="<?php echo $product['name']; ?>" style="width:150px; height:150px;" />
                        </a>
                        <div class="item-name"><a href="<?= 'product_detail_page.php?id=' . $product['product_id'] ?>"><?php echo $product['name']; ?></a></div>
                        <div class="line-break" style="margin-bottom: 0px"></div>
                        <?php if ($product['discount_percent'] > 0): ?>
                            <div class="item-price">Price:
                                <?php
                                echo '<s>' . $product['price'] . '</s>Ks&nbsp;<br>' . calculatePrice($product) . 'Ks';
                                echo '&nbsp<span>(' . $product['discount_percent'] . '% Off!)</span>';
                                ?>
                            </div>
                        <?php endif ?>
                        <?php if ($product['discount_percent'] == 0): ?>
                            <div class="item-price">Price: <?php echo $product['price'] . 'Ks'; ?></div>
                        <?php endif ?>

                        <!-- Add to cart button -->
                        <form method="post" action="addtocart.php" class="add-to-cart-form">
                            <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>" />
                            <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                            <input type="hidden" name="goTo" value="products" />
                            <input type="hidden" name="amountAdd" value="1" />
                            <button name="add_to_cart" name='submit' class="add-cart-btn show-popup-btn"><i class="fa-solid fa-cart-shopping"></i></button>
                            <!-- Overlay -->
                            <div class="popup-overlay"></div>
            
                            <!-- Popup -->
                            <div class="popup" id="popup">
                                <p>Added to Cart!</p>
                                <button class="close-popup-btn hero-button">Close</button>
                            </div>
                        </form>
                    </div>

                <?php endforeach ?>

            </div>

            <button class="carousel-arrow carousel-arrow--next" onclick="moveCarousel(true,'new-carousel','new-carousel-item')">
                &#8250;
            </button>
        </div>
    </div>

    <!-- promo carousel -->
    <div class="carousel-row">
        <div class="carousel-title-div">
            <div class="carousel-title">Promo Products</div>
            <div class="carousel-browse-link"><a href="search_process.php?sort=discount_percent">Browse All Products ></a></div>
        </div>
        <div class="carousel-group">
            <button class="carousel-arrow carousel-arrow--prev" onclick="moveCarousel(false,'promo-carousel','promo-carousel-item')">
                &#8249;
            </button>

            <div class="carousel-container promo-carousel">
                <?php
                $newProducts = fetchProducts($pdo, "promos");
                // show 8 newest products in the carousel 
                foreach (array_slice($newProducts, 0, 8) as $product): {
                        $product['photo'] = '../admin/' . $product['photo'];
                        if (!empty($product['photo']) && file_exists($product['photo'])) {
                            $imgSrc = $product['photo']; // Path to the image
                        } else {
                            // Default placeholder image if no image is found or the path is incorrect
                            $imgSrc = "img/default.png"; // Ensure this default image exists
                        }
                    }


                ?>

                    <div class="carousel-item promo-carousel-item">
                        <a href="<?= 'product_detail_page.php?id=' . $product['product_id'] ?>">
                            <img src="<?php echo $imgSrc; ?>" alt="<?php echo $product['name']; ?>" style="width:150px; height:150px;" />
                        </a>
                        <div class="item-name"><a href="<?= 'product_detail_page.php?id=' . $product['product_id'] ?>"><?php echo $product['name']; ?></a></div>
                        <div class="line-break" style="margin-bottom: 0px"></div>
                        <?php if ($product['discount_percent'] > 0): ?>
                            <div class="item-price">Price:
                                <?php
                                echo '<s>' . $product['price'] . '</s>Ks&nbsp;<br>' . calculatePrice($product) . 'Ks';
                                echo '&nbsp<span>(' . $product['discount_percent'] . '% Off!)</span>';
                                ?>
                            </div>
                        <?php endif ?>
                        <?php if ($product['discount_percent'] == 0): ?>
                            <div class="item-price">Price: <?php echo $product['price'] . 'Ks'; ?></div>
                        <?php endif ?>

                        <!-- Add to cart button -->
                        <form method="post" action="addtocart.php" class="add-to-cart-form">
                            <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>" />
                            <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                            <input type="hidden" name="goTo" value="products" />
                            <input type="hidden" name="amountAdd" value="1" />
                            <button name="add_to_cart" name='submit' class="add-cart-btn show-popup-btn"><i class="fa-solid fa-cart-shopping"></i></button>
                            <!-- Overlay -->
                            <div class="popup-overlay"></div>
            
                            <!-- Popup -->
                            <div class="popup" id="popup">
                                <p>Added to Cart!</p>
                                <button class="close-popup-btn hero-button">Close</button>
                            </div>
                        </form>
                    </div>

                <?php endforeach ?>

            </div>

            <button class="carousel-arrow carousel-arrow--next" onclick="moveCarousel(true,'promo-carousel','promo-carousel-item')">
                &#8250;
            </button>
        </div>
    </div>

    <!-- cookware carousel -->
    <div class="carousel-row">
        <div class="carousel-title-div">
            <div class="carousel-title">Cookware</div>
            <div class="carousel-browse-link"><a href="search_process.php?filter=Cookware">Browse All Products ></a></div>
        </div>
        <div class="carousel-group">
            <button class="carousel-arrow carousel-arrow--prev" onclick="moveCarousel(false,'cc-carousel','cc-carousel-item')">
                &#8249;
            </button>

            <div class="carousel-container cc-carousel">
                <?php
                $newProducts = fetchProducts($pdo, "cookware");
                // show 8 newest products in the carousel 
                foreach (array_slice($newProducts, 0, 8) as $product): {
                        $product['photo'] = '../admin/' . $product['photo'];
                        if (!empty($product['photo']) && file_exists($product['photo'])) {
                            $imgSrc = $product['photo']; // Path to the image
                        } else {
                            // Default placeholder image if no image is found or the path is incorrect
                            $imgSrc = "img/default.png"; // Ensure this default image exists
                        }
                    }


                ?>

                    <div class="carousel-item cc-carousel-item">
                        <a href="<?= 'product_detail_page.php?id=' . $product['product_id'] ?>">
                            <img src="<?php echo $imgSrc; ?>" alt="<?php echo $product['name']; ?>" style="width:150px; height:150px;" />
                        </a>
                        <div class="item-name"><a href="<?= 'product_detail_page.php?id=' . $product['product_id'] ?>"><?php echo $product['name']; ?></a></div>
                        <div class="line-break" style="margin-bottom: 0px"></div>
                        <?php if ($product['discount_percent'] > 0): ?>
                            <div class="item-price">Price:
                                <?php
                                echo '<s>' . $product['price'] . '</s>Ks&nbsp;<br>' . calculatePrice($product) . 'Ks';
                                echo '&nbsp<span>(' . $product['discount_percent'] . '% Off!)</span>';
                                ?>
                            </div>
                        <?php endif ?>
                        <?php if ($product['discount_percent'] == 0): ?>
                            <div class="item-price">Price: <?php echo $product['price'] . 'Ks'; ?></div>
                        <?php endif ?>

                        <!-- Add to cart button -->
                        <form method="post" action="addtocart.php" class="add-to-cart-form">
                            <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>" />
                            <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                            <input type="hidden" name="goTo" value="products" />
                            <input type="hidden" name="amountAdd" value="1" />
                            <button name="add_to_cart" name='submit' class="add-cart-btn show-popup-btn"><i class="fa-solid fa-cart-shopping"></i></button>
                            <!-- Overlay -->
                            <div class="popup-overlay"></div>
            
                            <!-- Popup -->
                            <div class="popup" id="popup">
                                <p>Added to Cart!</p>
                                <button class="close-popup-btn hero-button">Close</button>
                            </div>
                        </form>
                    </div>

                <?php endforeach ?>

            </div>

            <button class="carousel-arrow carousel-arrow--next" onclick="moveCarousel(true,'cc-carousel','cc-carousel-item')">
                &#8250;
            </button>
        </div>
    </div>

    <!-- knives carousel -->
    <div class="carousel-row">
        <div class="carousel-title-div">
            <div class="carousel-title">Kitchen Knives</div>
            <div class="carousel-browse-link"><a href="search_process.php?filter=Kitchen+Knives">Browse All Products ></a></div>
        </div>
        <div class="carousel-group">
            <button class="carousel-arrow carousel-arrow--prev" onclick="moveCarousel(false,'knives-carousel','knives-carousel-item')">
                &#8249;
            </button>

            <div class="carousel-container knives-carousel">
                <?php
                $newProducts = fetchProducts($pdo, "knives");
                // show 8 newest products in the carousel 
                foreach (array_slice($newProducts, 0, 8) as $product): {
                        $product['photo'] = '../admin/' . $product['photo'];
                        if (!empty($product['photo']) && file_exists($product['photo'])) {
                            $imgSrc = $product['photo']; // Path to the image
                        } else {
                            // Default placeholder image if no image is found or the path is incorrect
                            $imgSrc = "img/default.png"; // Ensure this default image exists
                        }
                    }


                ?>

                    <div class="carousel-item knives-carousel-item">
                        <a href="<?= 'product_detail_page.php?id=' . $product['product_id'] ?>">
                            <img src="<?php echo $imgSrc; ?>" alt="<?php echo $product['name']; ?>" style="width:150px; height:150px;" />
                        </a>
                        <div class="item-name"><a href="<?= 'product_detail_page.php?id=' . $product['product_id'] ?>"><?php echo $product['name']; ?></a></div>
                        <div class="line-break" style="margin-bottom: 0px"></div>
                        <?php if ($product['discount_percent'] > 0): ?>
                            <div class="item-price">Price:
                                <?php
                                echo '<s>' . $product['price'] . '</s>Ks&nbsp;<br>' . calculatePrice($product) . 'Ks';
                                echo '&nbsp<span>(' . $product['discount_percent'] . '% Off!)</span>';
                                ?>
                            </div>
                        <?php endif ?>
                        <?php if ($product['discount_percent'] == 0): ?>
                            <div class="item-price">Price: <?php echo $product['price'] . 'Ks'; ?></div>
                        <?php endif ?>

                        <!-- Add to cart button -->
                        <form method="post" action="addtocart.php" class="add-to-cart-form">
                            <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>" />
                            <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                            <input type="hidden" name="goTo" value="products" />
                            <input type="hidden" name="amountAdd" value="1" />
                            <button name="add_to_cart" name='submit' class="add-cart-btn show-popup-btn"><i class="fa-solid fa-cart-shopping"></i></button>
                            <!-- Overlay -->
                            <div class="popup-overlay"></div>
            
                            <!-- Popup -->
                            <div class="popup" id="popup">
                                <p>Added to Cart!</p>
                                <button class="close-popup-btn hero-button">Close</button>
                            </div>
                        </form>
                    </div>

                <?php endforeach ?>

            </div>

            <button class="carousel-arrow carousel-arrow--next" onclick="moveCarousel(true,'knives-carousel','knives-carousel-item')">
                &#8250;
            </button>
        </div>
    </div>

    <!-- appliances carousel -->
    <div class="carousel-row">
        <div class="carousel-title-div">
            <div class="carousel-title">Appliances</div>
            <div class="carousel-browse-link"><a href="search_process.php?filter=Appliances">Browse All Products ></a></div>
        </div>
        <div class="carousel-group">
            <button class="carousel-arrow carousel-arrow--prev" onclick="moveCarousel(false,'app-carousel','app-carousel-item')">
                &#8249;
            </button>

            <div class="carousel-container app-carousel">
                <?php
                $newProducts = fetchProducts($pdo, "appliances");
                // show 8 newest products in the carousel 
                foreach (array_slice($newProducts, 0, 8) as $product): {
                        $product['photo'] = '../admin/' . $product['photo'];
                        if (!empty($product['photo']) && file_exists($product['photo'])) {
                            $imgSrc = $product['photo']; // Path to the image
                        } else {
                            // Default placeholder image if no image is found or the path is incorrect
                            $imgSrc = "img/default.png"; // Ensure this default image exists
                        }
                    }


                ?>

                    <div class="carousel-item app-carousel-item">
                        <a href="<?= 'product_detail_page.php?id=' . $product['product_id'] ?>">
                            <img src="<?php echo $imgSrc; ?>" alt="<?php echo $product['name']; ?>" style="width:150px; height:150px;" />
                        </a>
                        <div class="item-name"><a href="<?= 'product_detail_page.php?id=' . $product['product_id'] ?>"><?php echo $product['name']; ?></a></div>
                        <div class="line-break" style="margin-bottom: 0px"></div>
                        <?php if ($product['discount_percent'] > 0): ?>
                            <div class="item-price">Price:
                                <?php
                                echo '<s>' . $product['price'] . '</s>Ks&nbsp;<br>' . calculatePrice($product) . 'Ks';
                                echo '&nbsp<span>(' . $product['discount_percent'] . '% Off!)</span>';
                                ?>
                            </div>
                        <?php endif ?>
                        <?php if ($product['discount_percent'] == 0): ?>
                            <div class="item-price">Price: <?php echo $product['price'] . 'Ks'; ?></div>
                        <?php endif ?>

                        <!-- Add to cart button -->
                        <form method="post" action="addtocart.php" class="add-to-cart-form">
                            <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>" />
                            <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                            <input type="hidden" name="goTo" value="products" />
                            <input type="hidden" name="amountAdd" value="1" />
                            <button name="add_to_cart" name='submit' class="add-cart-btn show-popup-btn"><i class="fa-solid fa-cart-shopping"></i></button>
                            <!-- Overlay -->
                            <div class="popup-overlay"></div>
            
                            <!-- Popup -->
                            <div class="popup" id="popup">
                                <p>Added to Cart!</p>
                                <button class="close-popup-btn hero-button">Close</button>
                            </div>
                        </form>
                    </div>

                <?php endforeach ?>

            </div>

            <button class="carousel-arrow carousel-arrow--next" onclick="moveCarousel(true,'app-carousel','app-carousel-item')">
                &#8250;
            </button>
        </div>
    </div>

    <!-- accessories carousel -->
    <div class="carousel-row" style="margin-bottom: 40px">
        <div class="carousel-title-div">
            <div class="carousel-title">Accessories</div>
            <div class="carousel-browse-link"><a href="search_process.php?filter=Accessories">Browse All Products ></a></div>
        </div>
        <div class="carousel-group">
            <button class="carousel-arrow carousel-arrow--prev" onclick="moveCarousel(false,'acc-carousel','acc-carousel-item')">
                &#8249;
            </button>

            <div class="carousel-container acc-carousel">
                <?php
                $newProducts = fetchProducts($pdo, "accessories");
                // show 8 newest products in the carousel 
                foreach (array_slice($newProducts, 0, 8) as $product): {
                        $product['photo'] = '../admin/' . $product['photo'];
                        if (!empty($product['photo']) && file_exists($product['photo'])) {
                            $imgSrc = $product['photo']; // Path to the image
                        } else {
                            // Default placeholder image if no image is found or the path is incorrect
                            $imgSrc = "img/default.png"; // Ensure this default image exists
                        }
                    }


                ?>

                    <div class="carousel-item acc-carousel-item">
                        <a href="<?= 'product_detail_page.php?id=' . $product['product_id'] ?>">
                            <img src="<?php echo $imgSrc; ?>" alt="<?php echo $product['name']; ?>" style="width:150px; height:150px;" />
                        </a>
                        <div class="item-name"><a href="<?= 'product_detail_page.php?id=' . $product['product_id'] ?>"><?php echo $product['name']; ?></a></div>
                        <div class="line-break" style="margin-bottom: 0px"></div>
                        <?php if ($product['discount_percent'] > 0): ?>
                            <div class="item-price">Price:
                                <?php
                                echo '<s>' . $product['price'] . '</s>Ks&nbsp;<br>' . calculatePrice($product) . 'Ks';
                                echo '&nbsp<span>(' . $product['discount_percent'] . '% Off!)</span>';
                                ?>
                            </div>
                        <?php endif ?>
                        <?php if ($product['discount_percent'] == 0): ?>
                            <div class="item-price">Price: <?php echo $product['price'] . 'Ks'; ?></div>
                        <?php endif ?>

                        <!-- Add to cart button -->
                        <form method="post" action="addtocart.php" class="add-to-cart-form">
                            <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>" />
                            <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                            <input type="hidden" name="goTo" value="products" />
                            <input type="hidden" name="amountAdd" value="1" />
                            <button name="add_to_cart" name='submit' class="add-cart-btn show-popup-btn"><i class="fa-solid fa-cart-shopping"></i></button>
                            <!-- Overlay -->
                            <div class="popup-overlay"></div>
            
                            <!-- Popup -->
                            <div class="popup" id="popup">
                                <p>Added to Cart!</p>
                                <button class="close-popup-btn hero-button">Close</button>
                            </div>
                        </form>
                    </div>

                <?php endforeach ?>

            </div>

            <button class="carousel-arrow carousel-arrow--next" onclick="moveCarousel(true,'acc-carousel','acc-carousel-item')">
                &#8250;
            </button>
        </div>
    </div>

</div>
<!-- import footer -->
<?php
include("footer.php");
?>