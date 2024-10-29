<?php
include("connect.php");
include("data.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $goto = filter_input(INPUT_POST, 'goto', FILTER_SANITIZE_STRING);

    // Fetch the specific product from the database using its ID
    $product = showSpecificProduct($pdo, $id);

    // Initialize cart session if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add the product to the cart or update its quantity
    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = $product;
        $_SESSION['cart'][$id]['qty'] = 1;
    } else {
        $_SESSION['cart'][$id]['qty']++;
    }

    // Redirection logic based on the 'goto' value
    switch ($goto) {
        case "productpage":
            header("Location: products.php");
            break;
        case "viewpage":
            header("Location: productview.php?id=$id");
            break;
        default:
            echo "Invalid page redirection!";
            break;
    }
    exit;  // Make sure to call exit after a header redirection
}
?>
