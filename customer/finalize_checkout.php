<?php
include("head.php");
include("navbar.php");
session_start();

// Check if form data is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $total_amount = isset($_POST['total_amount']) ? $_POST['total_amount'] : 0;
    $total_items = isset($_POST['total_items']) ? $_POST['total_items'] : 0;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';

    // Validate input data
    if (empty($name) || empty($address) || empty($payment_method)) {
        echo '<p class="text-danger">Please fill in all required fields.</p>';
        exit();
    }

    try {
        // Database connection using PDO
        include("connect.php");
        // Prepare SQL statement to insert order details
        $sql = "INSERT INTO submitorders (name, address, payment_method, total_amount, total_items) VALUES (:name, :address, :payment_method, :total_amount, :total_items)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':payment_method', $payment_method);
        $stmt->bindParam(':total_amount', $total_amount, PDO::PARAM_STR);
        $stmt->bindParam(':total_items', $total_items, PDO::PARAM_INT);

        // Execute the statement
        $stmt->execute();

        // Order saved successfully
        echo '<p class="text-success">Thank you for your purchase! Your order has been placed successfully.</p>';

        // Clear the cart
        unset($_SESSION['cart']);
    } catch (PDOException $e) {
        // Handle errors
        echo '<p class="text-danger">There was an error placing your order. Please try again. Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
} else {
    // Redirect to cart if accessed directly
    header('Location: cart.php');
    exit();
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 border rounded-4 mt-4">
            <h2>Order Confirmation</h2>
            <hr>
            <p>Your order has been placed successfully. You will receive a confirmation email shortly.</p>
            <a href="index.php" class="btn btn-primary">Return to Home</a>
        </div>
    </div>
</div>
