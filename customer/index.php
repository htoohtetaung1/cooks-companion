<!-- set page name and import html head -->
<?php
session_start();
$pagename = "The Best Companion for a Cook!";
include("head.php");
include("connect.php");
include("fetch_Product.php");
?>

<!-- import nav bar -->
<?php
include("navbar.php");
?>

<div class="main">
    <!-- <?= 'Your session ID: ' . session_id() ?>
    <?= $_SESSION['loggedIn'] ?>
    <?= $_SESSION['username'] ?> -->
    <div class="promo-img hero-img">
        <div class="promo-text">
            <!-- <?php print_r($_SESSION); ?> -->
            Get the best products at the best prices! Check out our discounted products!
            <div class="promo-button">
                <button class="hero-button"><a href="search_process.php?sort=discount_percent">View Promos</a></button>
            </div>
        </div>
    </div>
    <div class="browse-row hero-img">
        <div class="browse-1">
            <div class="browse-title">The Best Companion A Cook Can Have</div>
            <div class="browse-text">We have curated for you the best products that would serve as your companion in the kitchen.</div>
            <div class="browse-button">
                <button class="hero-button" id="browsebutton"><a href="all_products_page.php">Browse Products</a></button>
            </div>
        </div>
        <div class="browse-2 browse-row-img">
        </div>
    </div>
    <div class="browse-product-container">
        <div class="browse-product">
            <div class="product-type-text-div">
                <h3>
                    Cookware
                </h3>
                Our premium cookware combines durability, style,
                and performance to elevate your cooking experience.
                Perfect for home cooks and professionals alike! <br>
                <button class="hero-button"><a href="search_process.php?filter=Cookware">View Cookware</a></button>
            </div>
            <div class="product-type-img">
                <img src="pics/browse-cookware.webp" alt="pots">
            </div>
        </div>
        <div class="browse-product">
            <div class="product-type-text-div">
                <h3>
                    Kitchen Knives
                </h3>
                Our premium cookware combines durability, style,
                and performance to elevate your cooking experience.
                Perfect for home cooks and professionals alike! <br>
                <button class="hero-button"><a href="search_process.php?filter=Kitchen+Knives">View Knives</a></button>
            </div>
            <div class="product-type-img">
                <img src="pics/browse-knives.webp" alt="pots">
            </div>
        </div>
        <div class="browse-product">
            <div class="product-type-text-div">
                <h3>
                    Accessories
                </h3>
                Our premium cookware combines durability, style,
                and performance to elevate your cooking experience.
                Perfect for home cooks and professionals alike! <br>
                <button class="hero-button"><a href="search_process.php?filter=Accessories">View Accessories</a></button>
            </div>
            <div class="product-type-img">
                <img src="pics/browse-accessories.jpg" alt="pots">
            </div>
        </div>
        <div class="browse-product">
            <div class="product-type-text-div">
                <h3>
                    Appliances
                </h3>
                Our premium cookware combines durability, style,
                and performance to elevate your cooking experience.
                Perfect for home cooks and professionals alike! <br>
                <button class="hero-button"><a href="search_process.php?filter=Appliances">View Appliances</a></button>
            </div>
            <div class="product-type-img">
                <img src="pics/browse-appliances.avif" alt="pots">
            </div>
        </div>

    </div>
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
                include('calculate_price.php');
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
                            <input type="hidden" name="goTo" value="home" />
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
    <div class="newsletter-row">
        <div class="newsletter-title">Stay Up to Date With Our Newsletter!</div>
        <div class="newsletter-content">
            <div class="newsletter-text">
                Subscribe to our newsletter to keep in touch with our latest products and promotions!
                Don't miss out on discounts and sales ever again!
            </div>
            <div>
                <form action="" class="newsletter-form add-to-cart-form">
                    <input class="email-input" type="email" name="newsletter-email" id="" placeholder="Your email here">
                    <button class="email-submit show-popup-btn" name="submit" name="newsletter-submit">Submit</button>
                            <!-- Overlay -->
                            <div class="popup-overlay"></div>
            
                            <!-- Popup -->
                            <div class="popup" id="popup" style="text-align: center;">
                                <p id="nl-msg">Thanks for signing up to our newsletter!</p>
                                <button class="close-popup-btn hero-button">Close</button>
                            </div>
                </form>
            </div>

        </div>
    </div>
    <div class="line-break"></div>

    <div class="guarantee-row">
        <div class="guarantee-box">
            <div class="guarantee-icon">
                <img src="pics/payment-guarantee.png" alt="">
            </div>
            <div class="guarantee-title">
                Secure Payment
            </div>
            <div class="guarantee-payment">
                100% secure online payment or cash-on-delivery.
            </div>
        </div>
        <div class="guarantee-box">
            <div class="guarantee-icon">
                <img src="pics/delivery-guarantee.png" alt="">
            </div>
            <div class="guarantee-title">
                Deliver Nationwide
            </div>
            <div class="guarantee-payment">
                Purchase from anywhere in the nation.
            </div>
        </div>
        <div class="guarantee-box">
            <div class="guarantee-icon">
                <img src="pics/approved-guarantee.png" alt="">
            </div>
            <div class="guarantee-title">
                Tested and Approved
            </div>
            <div class="guarantee-payment">
                All items sold are quality tested and approved.
            </div>
        </div>
    </div>
</div>
</div>


<!-- import footer -->
<?php
include("footer.php");
?>