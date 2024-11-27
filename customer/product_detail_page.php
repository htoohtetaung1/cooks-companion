<?php
include("navbar.php");
include("connect.php");
include("data.php");
include("calculate_price.php");
$id = $_GET['id'];
$product = getSpecificProduct($pdo, $id);
$ptype = $product['product_type'];
$pagename = $product['name'];
include("head.php");
?>

<div class="main">
    <div class="product-detail-container" style="border: 0.1px solid #0000001d">
        <div class="product-detail1">
            <img src="../admin/<?= $product['photo'] ?>" alt="" class="product-img">
        </div>
        <div class="product-detail2">
            <div class="pd-name">
                <h2><?= $product['name'] ?></h2>
            </div>
            <div class="pd-stock">
                <h5><a href="search_process.php?filter=<?= $ptype ?>">
                        <u>Category : <?= $ptype ?>
                    </a></u></h5>
            </div>
            <div class="pd-stock">
                <h4>In Stock : &nbsp; <?= $product['qty'] ?></h4>
            </div>
            <div class="pd-price">
                <?php if ($product['discount_percent'] > 0): ?>
                    <div class="item-price">
                        <h3>
                            Price:
                            <?php
                            echo '<s>' . $product['price'] . 'Ks</s>&nbsp;&nbsp;' . calculatePrice($product) . 'Ks';
                            echo '&nbsp<span>(' . $product['discount_percent'] . '% Off!)</span>';
                            ?>
                        </h3>
                    </div>
                <?php endif ?>
                <?php if ($product['discount_percent'] == 0): ?>
                    <div class="item-price">Price: <?php echo $product['price'] . 'Ks'; ?></div>
                <?php endif ?>
            </div>
            <div class="pd-desc">
                <h4>Product Description</h4>
                <?= $product['description'] ?>
            </div>
            <div class="pd-add">
                <form action="addtocart.php" method="post" class="pd-add-form add-to-cart-form">
                    <input type="number" value="1" min="1" name="amountAdd" onKeyDown="return false">
                    <input type="hidden" value="<?= $product['product_id'] ?>" name="id">
                    <input type="submit" name="submit" class="hero-button show-popup-btn" value="Add to Cart"></input>
                    <!-- Overlay -->
                    <div class="popup-overlay"></div>

                    <!-- Popup -->
                    <div class="popup" id="popup">
                        <p>Added to Cart!</p>
                        <button class="close-popup-btn hero-button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- import footer here -->
<?php
include("footer.php");
?>