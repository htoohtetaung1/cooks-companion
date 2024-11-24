<?php
session_start();
$pagename = "Order Complete!";
include("head.php");
include("navbar.php");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<div class="main">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form data
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
        $user_id = $_SESSION['user_id'];
        $currentDate = date('Y-m-d');

        // Validate input data
        if (empty($name) || empty($address) || empty($payment_method)) {
            echo '<p class="text-danger">Please fill in all required fields.</p>';
            exit();
        }

        try {
            // Database connection using PDO
            include("connect.php");


            // Prepare SQL statement to insert order details
            $sql = "INSERT INTO orders (payment_type, user_id, address, date) VALUES (:payment_method, :user_id, :address, :date)";
            $stmt = $pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':payment_method', $payment_method);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':date', $currentDate);



            // Execute the statement
            $stmt->execute();

            // Order saved successfully
            $sql = "select * from orders order by order_id desc";
            $stmt = $pdo->query($sql);

            //get the single latest order row
            $thisOrder = $stmt->fetch(PDO::FETCH_ASSOC);
            $thisOrderID = $thisOrder['order_id'];
            foreach ($_SESSION['cart'] as $product) {
                try {
                    $sql = "INSERT INTO ordered_items (product_id, order_id, qty,buying_price, total_items_price) VALUES (:product_id, :order_id, :total,:buying_price,:total_items_price)";
                    $stmt = $pdo->prepare($sql);
                    // echo 'actual price = '.$product['actualPrice'].'<br>';
                    // echo 'amount = '.$product['total'].'<br>';
                    $total_items_price = $product['actualPrice'] * $product['total'];
                    // echo 'total = '.$total_items_price.'<br>';
                    $stmt->bindParam(':product_id', $product['product_id']);
                    $stmt->bindParam(':order_id', $thisOrderID);
                    $stmt->bindParam(':total', $product['total']);
                    $stmt->bindParam(':buying_price', $product['actualPrice']);
                    $stmt->bindParam(':total_items_price', $total_items_price);
                    $stmt->execute();
                    try {
                        $sql = "UPDATE products 
                        SET qty = (qty - :amount) 
                        WHERE product_id = :product_id AND qty > 0";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':amount', $product['total'], PDO::PARAM_INT);
                        $stmt->bindParam(':product_id', $product['product_id'], PDO::PARAM_INT);
                        $stmt->execute();
                        // echo "stock updated.";
                    } catch (Exception $e) {
                        die("
                        <h3>Cannot update stock</h3>" . $e->getMessage());
                    }
                } catch (Exception $e) {
                    die("<h3>Cannot insert data: </h3>" . $e->getMessage());
                }
            }
            // Clear the cart
            unset($_SESSION['cart']);
        } catch (PDOException $e) {
            // Handle errors
            echo '<p class="text-danger">There was an error placing your order. Please try again. Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
        }
    } else {
        // Redirect to cart if accessed directly
        header('Location: cart_page.php');
        exit();
    }
    ?>

    <div class="container" style="height: 400px;">
        <div class="row">
            <div class="col-md-12 border rounded-4 mt-4 p-3">
                <h2>Order Confirmation</h2>
                <hr>
                <p>Your order has been placed successfully. You will receive a confirmation email shortly.</p>
                <a href="index.php" class="hero-button" style="color:white; padding: 5px;">Return to Home</a>
            </div>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>