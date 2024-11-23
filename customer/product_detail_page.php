<?php
include("navbar.php");
include("connect.php");
include("data.php");
include("calculate_price.php");
$id = $_GET['id'];
$product = getSpecificProduct($pdo, $id);
$pagename = $product['name'];
include("head.php");
?>

<div class="main">
    <div class="product-detail-container">
        <div class="product-detail1">
            <img src="../admin/<?= $product['photo'] ?>" alt="" class="product-img">
        </div>
        <div class="product-detail2">
            <div class="pd-name">
                <h2><?= $product['name'] ?></h2>
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
                    <form action="addtocart.php" method="post" class="pd-add-form">
                        <input type="number" value="1" min="1" name="amountAdd" onKeyDown="return false">
                        <input type="hidden" value="<?= $product['product_id'] ?>" name="id">
                        <input type="submit" name="submit" class="hero-button" value="Add to Cart"></input>
                    </form>
            </div>
        </div>
    </div>
</div>


<!-- import footer here -->
<?php
include("footer.php");
?>