<?php
include("connect.php");
include("data.php");
try {
    if (isset($_FILES['img'])) {
        $target = $_FILES['img']['name']; 
        $tmp = $_FILES['img']['tmp_name'];
        $targetDir = "img/" . $target; // Target directory to store the uploaded image
        move_uploaded_file($tmp, $targetDir); // Moving the uploaded image to the target directory
    }

    if (isset($_POST['submit'])) {
        $product_name = nullConvert($_POST['pname']);
        $product_type = nullConvert($_POST['ptype']);
        $price = nullConvert($_POST['price']);
        $desc = nullConvert($_POST['desc']);
        $stock = nullConvert($_POST['stock']);
        $discount = $_POST['discount'];
        print '<h3>Inserting Data:</h3>';
        print 'Product Name = ' . $product_name . '<br>Product Type = ' . $product_type . '<br>Price = ' . $price . '<br>Description:<br>' . $desc . '<br>Stock = ' 
                                . $stock . '<br>Discount = ' . $discount . '<br>Photo = ' . $targetDir . '<br>'; 

        $sql = "INSERT INTO products (name, product_type, price, description, qty, discount_percent, photo) 
                VALUES (:pname, :ptype, :price, :desc, :qty, :discount, :photo)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':pname', $product_name);
        $stmt->bindParam(':ptype', $product_type);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':qty', $stock);
        $stmt->bindParam(':discount', $discount);
        $stmt->bindParam(':photo', $targetDir); // Storing the image path in the database

        if ($stmt->execute()) {
            echo 'Data inserted successfully!<br>' . 
            '<br><a href="product_create.php">Go back to previous page.</a>';
        } else {
            echo "Failed to insert data.";
        }
        
        
    }
} catch (Exception $e) {
    die("<h3>Cannot insert data: </h3>" . $e->getMessage() . 
        '<br><a href="product_create.php">Go back to previous page.</a>');
}
?>
