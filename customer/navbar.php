<?php
session_start();
$qty = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        $qty += $product['qty'];
    }
}
?>
<navbar class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="text-warning mb-0">
                            <a href="/ecommerce_website/customer">Ecommerce Website</a>
                        </h2>
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="/ecommerce_website/customer" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#">Men's</a></li>
                            <li class="scroll-to-section"><a href="#">Women's</a></li>
                            <li class="scroll-to-section"><a href="#">Kid's</a></li>
                            <li class="submenu">
                                <a href="javascript:;">Pages</a>
                                <ul>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="products.php">Products</a></li>
                                    <li><a href="productview.php">Product View</a></li>
                                    <li><a href="contact.php">Contact Us</a></li>
                                </ul>
                            </li>
                            <li class="scroll-to-section">
                                <a href="cart.php" class="text-secondary">
                                    <i class="fa-solid fa-cart-shopping fa-xl"></i>
                                    <span><sub>13</sub></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</navbar>
