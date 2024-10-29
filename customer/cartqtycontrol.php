<?php
session_start();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['id'];
    $action = isset($_POST['increase']) ? 'increase' : (isset($_POST['decrease']) ? 'decrease' : (isset($_POST['remove']) ? 'remove' : ''));

    if (isset($_SESSION['cart'][$product_id])) {
        switch ($action) {
            case 'increase':
                $_SESSION['cart'][$product_id]['qty']++;
                break;
            case 'decrease':
                if ($_SESSION['cart'][$product_id]['qty'] > 1) {
                    $_SESSION['cart'][$product_id]['qty']--;
                }
                break;
            case 'remove':
                unset($_SESSION['cart'][$product_id]);
                break;
        }
    }

    // Redirect to the cart page
    header("Location: cart.php");
    exit();
}
?>
