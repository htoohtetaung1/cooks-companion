<?php
include("connect.php");

try {
    if (isset($_FILES['img'])) {
        $target = $_FILES['img']['name']; // Corrected the variable name from $terget to $target
        $tmp = $_FILES['img']['tmp_name'];
        $targetDir = "img/" . $target; // Target directory to store the uploaded image
        move_uploaded_file($tmp, $targetDir); // Moving the uploaded image to the target directory
    }

    if (isset($_POST['submit'])) {
        $id = $_POST['pid'];
        $product_name = $_POST['pname'];
        $product_category = $_POST['pcategory'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        // Prepared statement to prevent SQL injection
        $sql = "INSERT INTO products (product_id, product_name, product_category, product_stock, product_price, product_image) 
                VALUES (:id, :product_name, :product_category, :stock, :price, :product_img)";
        $stmt = $pdo->prepare($sql);

        // Binding parameters
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':product_category', $product_category);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':product_img', $targetDir); // Storing the image path in the database

        // Executing the query
        if ($stmt->execute()) {
            echo "Data inserted successfully!";
        } else {
            echo "Failed to insert data.";
        }

        
    }
} catch (Exception $e) {
    die("Cannot insert data: " . $e->getMessage());
}

?>
