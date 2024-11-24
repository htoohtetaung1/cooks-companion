<!-- set page name and import html head -->
<?php
session_start();
$pagename = "Your Cart";
include("head.php");
include("connect.php");
include("fetch_Product.php");
include('calculate_price.php');
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<?php

// Calculate the total number of items in the cart
$total_items = 0;
$total_price = 0; // Initialize total price
$cart_summary = []; // Array to store cart summary details
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        $total_items += $product['total'];
        $total_price += $product['total'] * $product['actualPrice'];
        $cart_summary[] = [
            'name' => htmlspecialchars($product['name']),
            'qty' => $product['total'],
            'price' => $product['actualPrice'],
            'total' => $product['total'] * $product['actualPrice']
        ];
    }
}
$tax = 0.05; // Assuming a fixed tax amount
$total_amount = $total_price + round($total_price * $tax); // Total amount including tax
?>
<!-- import nav bar -->
<?php
include("navbar.php");
?>

<div class="main">
    <div class="container" style="padding: 40px">
        <div class="row">
            <!-- left start -->
            <div class="col-md-8 col-sm-8 border rounded-4">
                <!-- top -->
                <div class="col d-flex mt-4 justify-content-between">
                    <h5>Your Shopping Cart</h5>
                    <h6>Total : <?= $total_items ?> Item<?= $total_items > 1 ? 's' : '' ?></h6>
                </div>
                <hr>
                <!-- product start -->
                <div class="row d-flex bg-light mb-5">
                    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                        <?php foreach ($_SESSION['cart'] as $product): ?>
                            <form action="cart_control.php" method="post" class="row d-flex bg-light mb-2">
                                <!-- image start -->
                                <div class="col-md-2 col-sm-4 text-center mt-2">
                                    <img class="bg-light rounded" style="width: 110px; height: 110px; object-fit: contain; margin: auto;"
                                        src="../admin/<?= '../admin/' . $product['photo'] ?>" alt="image">
                                </div>
                                <!-- image end -->
                                <div class="col d-md-flex justify-content-between">
                                    <!-- name -->
                                    <div class="py-lg-4 fw-bold w-25%">
                                        <input type="hidden" value="<?= htmlspecialchars($product['product_id']) ?>" name="id">
                                        <p class="text-center"><?= htmlspecialchars($product['name']) ?></p>
                                        <p class="text-center"><?= number_format($product['actualPrice'], 0) ?>Ks</p>
                                    </div>
                                    <!-- buttons -->
                                    <div class="py-lg-5" style="margin-left: auto;">
                                        <div class="text-center cart-control-buttons" style="text-wrap: nowrap">
                                            <button class="btn" name="decrease" type="submit"><i class="fa fa-minus  text-dark  rounded" style="cursor: pointer"></i></button>
                                            <input class="rounded-1 text-center" type="number" value="<?= $product['total'] ?>" style="width: 50px;" readonly>
                                            <button class="btn" name="increase" type="submit"> <i class="fa fa-plus  text-dark  rounded" style="cursor: pointer"></i></button>
                                            <button class="btn bg-transparent" name="remove" type="submit"> <i class="fa fa-trash fa-lg text-danger" style="cursor: pointer"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Your cart is empty.</p>
                    <?php endif; ?>
                </div>
                <!-- product end -->
            </div>
            <!-- left end -->

            <!-- right start -->
            <div class="col-md-4 col-sm-12 border rounded-4">
                <h5 class="mt-3">Summary</h5>
                <hr>
                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <!-- Cart Summary Start -->
                    <ul class="list-group mb-3">
                        <?php
                        $_SESSION['delivery_fee'] = 5000;
                        if ($total_price > 100000) {
                            $_SESSION['delivery_fee'] = 0;
                        }
                        ?>
                        <?php foreach ($cart_summary as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= $item['name'] ?> (<?= $item['qty'] ?> x <?= number_format($item['price'], 0) ?>Ks)
                                <span><?= number_format($item['total'], 0) ?>Ks</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <!-- Cart Summary End -->
                <?php endif; ?>
                <div class="d-flex justify-content-between">
                    <p>Price</p>
                    <p><?= number_format($total_price, 0) ?>Ks</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Quantity</p>
                    <p><?= $total_items ?></p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Tax</p>
                    <p>5%</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Delivery Fee</p>
                    <p><?= number_format($_SESSION['delivery_fee']) ?>Ks</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p style="font-size: 10px;">Free for orders above 100,000Ks (tax not included)</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <p>Total</p>
                    <!-- add 5000 fixed delivery fee -->
                    <p><?= number_format($total_amount + $_SESSION['delivery_fee'], 0) ?>Ks</p>
                </div>

                <div class="row bg-light">
                    <div class="col d-flex justify-content-between my-3">
                        <a href="all_products_page.php" class="text-danger fs-6">
                            << Continue Shopping</a>
                                <form action="checkout_page.php" method="post">
                                    <input type="hidden" name="total_amount" value="<?= $total_amount ?>">
                                    <input type="hidden" name="total_items" value="<?= $total_items ?>">
                                    <button type="submit" class="btn btn-danger">Checkout</button>
                                </form>
                    </div>
                </div>
            </div>
            <!-- right end -->
        </div>
    </div>


</div>


<!-- import footer -->
<?php
include("footer.php");
?>