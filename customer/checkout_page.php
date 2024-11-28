<?php
session_start();
$pagename = "Complete Your Purchase";
include("head.php");
include("navbar.php");

// Check if form data is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the total amount and total items from POST data
    $total_amount = isset($_POST['total_amount']) ? $_POST['total_amount'] : 0;
    $total_items = isset($_POST['total_items']) ? $_POST['total_items'] : 0;
} else {
    // Redirect to cart if accessed directly or handle error
    header('Location: cart_page.php');
    exit();
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<div class="main">
    <div class="container" style="margin-top: -30px;">
        <div class="row">
            <div class="col-md-12 border rounded-4 mb-4 p-3">
                <h2>Checkout</h2>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <p>Total Items:</p>
                    <p><?= $total_items ?></p>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <p>Total Amount:</p>
                    <p>$ <?= number_format($total_amount, 0) ?></p>
                </div>

                <form action="process_checkout.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <a href="profile_page.php"><i class="fa-regular fa-pen-to-square"></i></a>
                        <input type="text" id="name" name="name" class="form-control" value="<?= $_SESSION['username'] ?>" readonly>
                    </div>
                    <div class="mb-3">  
                        <label for="address" class="form-label">Shipping Address</label>
                        <a href="profile_page.php"><i class="fa-regular fa-pen-to-square"></i></a>
                        <input type="text" name="address" id="address" class="form-control" value="<?= $_SESSION['address'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select id="payment_method" name="payment_method" class="form-select" required>
                            <option value="KBZ Pay">KBZ Pay</option>
                            <option value="AYA Pay">AYA Pay</option>
                            <option value="CB Pay">CB Pay</option>
                            <option value="Wave Pay">Wave Pay</option>
                            <option value="Cash on Delivery">Cash on Delivery</option>
                            <option value="MPU">MPU</option>
                            <option value="Visa">Visa</option>
                            <option value="PayPal">PayPal</option>
                            <!-- Add more payment options if needed -->
                        </select>
                    </div>
                    <div style="text-align:center">
                        <input type="submit" name="complete-checkout" class="btn btn-warning" value="Complete Checkout">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 
 debugging
 <?php
if (isset($_POST['complete-checkout'])) {
    // Retrieve the form data
    $total_amount = isset($_POST['total_amount']) ? $_POST['total_amount'] : 0;
    $total_items = isset($_POST['total_items']) ? $_POST['total_items'] : 0;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    
    echo "total_amount" . $total_amount . "<br>";
    echo "total_items" . $total_items . "<br>";
    echo "name" . $name . "<br>";
    echo "address" . $address . "<br>";
    echo "payment_method" . $payment_method . "<br>";
    foreach($_SESSION['cart'] as $product) {
        echo "product" . $product['product_id'] . "<br>";
        echo "amount" . $product['total'] . "<br>";
    }
    $currentDate = date('Y-m-d');
    echo 'date = '.$currentDate;
    // Validate input data
    if (empty($name) || empty($address) || empty($payment_method)) {
        echo '<p class="text-danger">Please fill in all required fields.</p>';
        exit();
    }

}
?> -->

<?php
include("footer.php");
?>