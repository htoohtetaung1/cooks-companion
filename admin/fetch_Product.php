<?php
include("connect.php");

try {
    // Query to fetch product information
    $sql = "SELECT * FROM products";
    $stmt = $pdo->query($sql);

    // Fetch all products as an associative array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display products
    foreach ($products as $product) {
        // Ensure the image path is correct and check if the image file exists
        if (!empty($product['product_image']) && file_exists($product['product_image'])) {
            $imgSrc = $product['product_image']; // Path to the image
        } else {
            // Default placeholder image if no image is found or the path is incorrect
            $imgSrc = "img/default.png"; // Ensure this default image exists
        }

        // Now display the product
        ?>
        <div class="product">
            <img src="<?php echo $imgSrc; ?>" alt="<?php echo $product['product_name']; ?>" style="width:150px; height:150px;" />
            <h2><?php echo $product['product_name']; ?></h2>
            <p>Category: <?php echo $product['product_category']; ?></p>
            <p>Price: $<?php echo $product['product_price']; ?></p>
            <p>Stock: <?php echo $product['product_stock']; ?> left</p>
            
            <!-- Add to cart button -->
            <form method="post" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>" />
                <input type="hidden" name="product_name" value="<?php echo $product['product_name']; ?>" />
                <input type="hidden" name="price" value="<?php echo $product['product_price']; ?>" />
                <input type="submit" name="add_to_cart" value="Add to Cart" />
            </form>
        </div>
        <hr>
        <?php
    }
} catch (Exception $e) {
    die("Error fetching products: " . $e->getMessage());
}
?>
