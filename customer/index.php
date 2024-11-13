<!-- set page name and import html head -->
<?php
$pagename = "The Best Companion for a Cook!";
include("head.php");
?>

<!-- import nav bar -->
<?php
include("navbar.php");
?>

<div class="main">
    <div class="promo-img hero-img">
        <div class="promo-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit!
        </div>
        <div class="promo-button hero-button">
            <button>View Promos</button>
        </div>
    </div>
    <div class="browse-row hero-img">
        <div class="browse-1">
            <div class="browse-title">The Best Companion A Cook Can Have</div>
            <div class="browse-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
            <div class="browse-button hero-button">
                <button>Browse Products</button>
            </div>
        </div>
        <div class="browse-2">
            <img src="" alt="" width="400px">
        </div>
    </div>
    <div class="browse-product-container">
        <div class="browse-product">
            <div class="product-type-text-div">
                Product type <br>
                Product details, descriptions, varieties. <br>
                <button>View Products</button>
            </div>
            <div class="product-type-img">
                test
            </div>
        </div>
        <div class="browse-product">
            <div class="product-type-text-div">
                Product type <br>
                Product details, descriptions, varieties. <br>
                <button>View Products</button>
            </div>
            <div class="product-type-img">
                test
            </div>
        </div>
        <div class="browse-product">
            <div class="product-type-text-div">
                Product type <br>
                Product details, descriptions, varieties. <br>
                <button>View Products</button>
            </div>
            <div class="product-type-img">
                test
            </div>
        </div>
        <div class="browse-product">
            <div class="product-type-text-div">
                Product type <br>
                Product details, descriptions, varieties. <br>
                <button>View Products</button>
            </div>
            <div class="product-type-img">
                test
            </div>
        </div>

    </div>
    <div class="new-products-row carousel-row">
        <div class="carousel-title-div">
            <div class="carousel-title">New Products</div>
            <div class="carousel-browse-link"><a href="">Browse All Products</a></div>
        </div>
        <div class="carousel-group">
            <button class="carousel-arrow carousel-arrow--prev" onclick="moveCarousel(false)">
                &#8249;
            </button>

            <div class="carousel-container">
                <div class="carousel-item">1</div>
                <div class="carousel-item">2</div>
                <div class="carousel-item">3</div>
                <div class="carousel-item">4</div>
                <div class="carousel-item">5</div>
                <div class="carousel-item">6</div>
                <div class="carousel-item">7</div>
                <div class="carousel-item">8</div>
            </div>

            <button class="carousel-arrow carousel-arrow--next" onclick="moveCarousel()">
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
                <form action="" class="newsletter-form">
                    <input class="email-input" type="email" name="newsletter-email" id="" placeholder="Your email here">
                    <input class="email-submit" type="button" value="Submit" name="newsletter-submit">
                </form>
            </div>

        </div>
    </div>
    <div class="line-break"></div>

    <div class="guarantee-row">
        <div class="guarantee-box">
            <div class="guarantee-icon"></div>
            <div class="guarantee-title">
                Secure Payment
            </div>
            <div class="guarantee-payment">
                100% secure online payment or cash-on-delivery.
            </div>
        </div>
        <div class="guarantee-box">
            <div class="guarantee-icon"></div>
            <div class="guarantee-title">
                Secure Payment
            </div>
            <div class="guarantee-payment">
                100% secure online payment or cash-on-delivery.
            </div>
        </div>
        <div class="guarantee-box">
            <div class="guarantee-icon"></div>
            <div class="guarantee-title">
                Secure Payment
            </div>
            <div class="guarantee-payment">
                100% secure online payment or cash-on-delivery.
            </div>
        </div>
    </div>
</div>
</div>

<!-- import footer -->
<?php
include("footer.php");
?>