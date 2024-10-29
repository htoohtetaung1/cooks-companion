<?php
include("head.php");
include("navbar.php");
session_start();

// Calculate the total number of items in the cart
$total_items = 0;
$total_price = 0; // Initialize total price
$cart_summary = []; // Array to store cart summary details
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        $total_items += $product['qty'];
        $total_price += $product['qty'] * $product['product_price'];
        $cart_summary[] = [
            'name' => htmlspecialchars($product['product_name']),
            'qty' => $product['qty'],
            'price' => $product['product_price'],
            'total' => $product['qty'] * $product['product_price']
        ];
    }
}
$tax = 5; // Assuming a fixed tax amount
$total_amount = $total_price + $tax; // Total amount including tax
?>

<div class="container" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
    <div class="row">
        <hr>
        <!-- left start -->
        <div class="col-md-8 col-sm-8 border rounded-4">
            <!-- top -->
            <div class="col d-flex mt-4 justify-content-between">
                <p>Shopping Cart</p>
                <p><?= $total_items ?> Item<?= $total_items > 1 ? 's' : '' ?></p>
            </div>
            <hr>
            <!-- product start -->
            <div class="row d-flex bg-light mb-5">
                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $product): ?>
                        <form action="cartqtycontrol.php" method="post" class="row d-flex bg-light mb-2">
                            <!-- image start -->
                            <div class="col-md-2 col-sm-4 text-center mt-2">
                                <img class="bg-light rounded" style="width: 110px; height: 110px; object-fit: contain;"
                                     src="../admin/<?= htmlspecialchars($product['product_image']) ?>" alt="image">
                            </div>
                            <!-- image end -->
                            <div class="col d-md-flex justify-content-between">
                                <!-- left -->
                                <div class="py-lg-4 fw-bold">
                                    <input type="hidden" value="<?= htmlspecialchars($product['product_id']) ?>" name="id">
                                    <p class="text-center"><?= htmlspecialchars($product['product_name']) ?></p>
                                    <p class="text-center">$<?= number_format($product['product_price'], 2) ?></p>
                                </div>
                                <!-- mid -->
                                <div class="py-lg-5">
                                    <div class="text-center">
                                       <button class="btn" name="increase" type="submit"> <i class="fa fa-plus bg-danger text-light p-1 rounded" style="cursor: pointer"></i></button>
                                        <input class="rounded-3 text-center" type="number" value="<?= $product['qty'] ?>" style="width: 50px;" readonly>
                                        <button class="btn" name="decrease" type="submit"><i class="fa fa-minus bg-danger text-light p-1 rounded" style="cursor: pointer"></i></button>
                                    </div>
                                </div>
                                <!-- right -->
                                <div class="text-center py-3 py-lg-5 my-3 me-lg-3">
                                    <button class="btn" name="remove" type="submit"> <i class="fa fa-trash fa-lg text-danger" style="cursor: pointer"></i></button>
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
        <div class="col-md-4 col-sm-12 border rounded-top-4">
            <p class="mt-3 fw-bolder">Summary</p>
            <hr>
            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                <!-- Cart Summary Start -->
                <ul class="list-group mb-3">
                    <?php foreach ($cart_summary as $item): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= $item['name'] ?> (<?= $item['qty'] ?> x $<?= number_format($item['price'], 2) ?>)
                            <span>$<?= number_format($item['total'], 2) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <!-- Cart Summary End -->
            <?php endif; ?>
            <div class="d-flex justify-content-between">
                <p>Price</p>
                <p>$ <?= number_format($total_price, 2) ?></p>
            </div>
            <div class="d-flex justify-content-between">
                <p>Quantity</p>
                <p><?= $total_items ?></p>
            </div>
            <div class="d-flex justify-content-between">
                <p>Tax</p>
                <p>$ <?= number_format($tax, 2) ?></p>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <p>Total</p>
                <p>$ <?= number_format($total_amount, 2) ?></p>
            </div>

            <div class="row bg-light">
                <div class="col d-flex justify-content-between my-3">
                    <a href="products.php" class="text-danger fs-6"><< Continue Shopping</a>
                    <form action="checkout.php" method="post">
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
