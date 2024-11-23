<!-- set page name and import html head -->
<?php
include("connect.php");
include("fetch_Product.php");
include('calculate_price.php');
include("data.php");
session_start();

if (!isset($_SESSION['loggedIn'])) {
    header("Location: login_page.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $add = filter_input(INPUT_POST, 'amountAdd', FILTER_SANITIZE_NUMBER_INT);
    $goTo = $_POST['goTo'];

    // Fetch the specific product from the database using its ID
    $product = getSpecificProduct($pdo, $id);
    $actualPrice = calculatePrice($product);

    // Initialize cart session if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add the product to the cart or update its quantity
    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = $product;
        $_SESSION['cart'][$id]['total'] = 0;
        $_SESSION['cart'][$id]['total'] += $add;
        $_SESSION['cart'][$id]['actualPrice'] = $actualPrice;
    } else {
        $_SESSION['cart'][$id]['total'] += $add;
    }

    //debug - check cart items
    // foreach($_SESSION['cart'] as $cartitem) {
    //     print_r($cartitem);
    // }

    switch ($goTo) {
        case 'home': {
                header("Location: index.php");
                exit;
            }
        case 'products': {
                header("Location: all_products_page.php");
                exit;
            }
        default: {
                header("Location: product_detail_page.php?id=$id");
                exit;
            }
    }

    if ($goTo === 'samepage') {
        header(".");
        exit;
    }
}
?>