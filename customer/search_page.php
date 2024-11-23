<!-- set page name and import html head -->
<?php
session_start();
$pagename = "Search Products";
include("head.php");
include("connect.php");
include("data.php");
include("fetch_Product.php");
include('calculate_price.php');
?>

<!-- import nav bar -->
<?php
include("navbar.php");
?>



<div class="main">
    <div class="filter-row" style="margin-top:20px;padding-bottom: 20px;">

        <form action="search_process.php" method="get" style="display: flex; flex-wrap: wrap; justify-content:space-evenly;align-items:center;">
            <div class="filter-inputs">
                <label for="filter">Category:</label>
                <select name="filter" id="filter">
                    <option hidden disabled selected value> -- select an option -- </option>
                    <option value="Cookware">Cookware</option>
                    <option value="Kitchen Knives">Kitchen Knives</option>
                    <option value="Accessories">Accessories</option>
                    <option value="Appliances">Appliances</option>
                </select>
            </div>
            <div class="filter-inputs">
                <label for="sort">Sort By:</label>
                <select name="sort" id="sort">
                    <option value="price">Price</option>
                    <option value="product_id">Newest</option>
                    <option value="discount_percent">Discount</option>
                    <option value="name">Alphabetically</option>
                </select>
            </div>
            <div class="filter-inputs" style="display: flex; gap:5px">
                <input type="hidden" name="search" value="">
                <input type="submit" value="Filter" class="hero-button">
                <a onclick="resetSearch()" class="hero-button">Reset Search</a>
                <!-- <input type="button" value="Reset Search" class="hero-button"> -->
            </div>
        </form>
    </div>
    <hr>


    <div class="search-container" style="display:flex;flex-wrap:wrap;gap:30px; justify-content: center;margin: 25px">
        <!-- <?php print_r($_SESSION['search_result']) ?> -->
        <?php foreach ($_SESSION['search_result'] as $product): ?>
            <div class="search-carousel-item">
                <a href="<?= 'product_detail_page.php?id=' . $product['product_id'] ?>">
                    <img src="../admin/<?= $product['photo'] ?>" alt="<?php echo $product['name']; ?>" style="width:150px; height:150px;" />
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
                <form method="post" action="addtocart.php">
                    <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>" />
                    <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                    <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                    <input type="hidden" name="goTo" value="home" />
                    <input type="hidden" name="amountAdd" value="1" />
                    <button name="add_to_cart" name='submit' class="add-cart-btn" onclick="addedToCart()"><i class="fa-solid fa-cart-shopping"></i></button>
                </form>
            </div>
        <?php endforeach ?>
    </div>
</div>


<!-- import footer -->
<?php
include("footer.php");
?>