<!-- set page name and import html head -->
<?php
session_start();
$pagename = $_SESSION['username'] . "'s Profile";
include("head.php");
include("connect.php");
include("data.php");
include("fetch_Product.php");
include('calculate_price.php');
?>

<!-- import nav bar -->
<?php
include("navbar.php");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<div class="main">
    <div class="profile-container p-3">
        <div class="profile-links" style="display: flex; gap:10px;justify-content: space-evenly;">
            <div>
                <a href="profile_page.php">
                    Edit Profile
                </a>
            </div>
            <div>
                <a href="profile_orders_page.php">
                    My Orders
                </a>
            </div>
            <div>
                <a href="logout.php">
                    Log Out
                </a>
            </div>
        </div>
        <div class="line-break">

        </div>
        <div class="profile-content">
            <h4>Your Orders</h4>
            <?php
            $orders = getOrderByUser($pdo, $_SESSION['user_id']);
            // print_r($orders);
            foreach ($orders as $order): {
                    $sql = "SELECT product_id,photo,product_name,qty,price FROM order_info1 WHERE order_id= :order_id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([':order_id' => $order['order_id']]);
                    $order_details = $stmt->fetchALL(PDO::FETCH_ASSOC);
                    $total_amount = 0;
                }
            ?>
                <div class="row p-2">
                    <h5> Order ID : <?= $order['order_id'] ?></h5>
                    <?php
                    foreach ($order_details as $orderdetail): {
                            $total_amount += ($orderdetail['qty'] * $orderdetail['price']);
                        }
                    ?>
                        <div class="row d-flex">

                            <!-- image start -->
                            <div class="col-md-2 col-sm-4 text-center mt-2">
                                <a href="product_detail_page.php?id=<?= $orderdetail['product_id'] ?>">
                                    <img class="bg-light rounded" style="width: 110px; height: 110px; object-fit: contain; margin: auto;"
                                        src="../admin/<?= $orderdetail['photo'] ?>" alt="image">
                                </a>
                            </div>
                            <!-- image end -->
                            <div class="col d-md-flex justify-content-between">
                                <!-- name and quantity-->
                                <div class="py-lg-4 fw-bold w-25%">
                                    <a href="product_detail_page.php?id=<?= $orderdetail['product_id'] ?>">
                                        <p class="text-center"><?= htmlspecialchars($orderdetail['product_name']) ?></p>
                                    </a>
                                    <p class="text-center"><?= $orderdetail['price'] ?>Ks x <?= $orderdetail['qty'] ?></p>
                                </div>
                                <!-- total price -->
                                <div class="py-lg-5" style="margin-left: auto;">
                                    <p class="text-center"><?= $orderdetail['qty'] * $orderdetail['price'] ?>Ks</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <?php $delivery_fee = 5000;
                    if ($total_amount > 100000 ) {
                    $delivery_fee = 0;
                    } ?>
                        <div class="row">
                            <div class="col d-flex justify-content-between">
                                <!-- tax-->
                                <div class="py-1 fw-bold w-25%">
                                    <p class="text-center">Tax:</p>
                                </div>
                                <!-- tax -->
                                <div class="py-1" style="margin-left: auto;">
                                    <p class="text-center">5%</p>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col d-flex justify-content-between">
                            <!-- delivery-->
                            <div class="py-1 fw-bold w-25%">
                                <p class="text-center">Delivery Fee:</p>
                            </div>
                            <!-- delivery -->
                            <div class="py-1" style="margin-left: auto;">
                                <p class="text-center"><?=number_format($delivery_fee)?>Ks</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="text-end">
                        <?php
                        // add delivery and tax 
                        $total_amount = $total_amount + $delivery_fee + ($total_amount * 0.05) ?>
                        Total Amount :&nbsp;&nbsp;&nbsp;&nbsp;
                        <?= number_format($total_amount, 0) ?>Ks
                    </div>


                </div>
                <hr>
            <?php endforeach ?>
        </div>
    </div>
</div>

<!-- import footer -->
<?php
include("footer.php");
?>