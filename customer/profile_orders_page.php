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
                    $sql = "SELECT photo,product_name,qty,price FROM order_info1 WHERE order_id= :order_id";
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
                            <img class="bg-light rounded" style="width: 110px; height: 110px; object-fit: contain; margin: auto;"
                                src="../admin/<?=$orderdetail['photo'] ?>" alt="image">
                        </div>
                        <!-- image end -->
                        <div class="col d-md-flex justify-content-between">
                            <!-- name and quantity-->
                            <div class="py-lg-4 fw-bold w-25%">
                                <p class="text-center"><?= htmlspecialchars($orderdetail['product_name']) ?></p>
                                <p class="text-center"><?=$orderdetail['price']?>Ks x <?=$orderdetail['qty']?></p>
                            </div>
                            <!-- total price -->
                            <div class="py-lg-5" style="margin-left: auto;">
                                <p class="text-center"><?= $orderdetail['qty'] * $orderdetail['price'] ?>Ks</p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                    <div class="row">
                    <div class="col d-flex justify-content-between">
                            <!-- delivery-->
                            <div class="py-1 fw-bold w-25%">
                                <p class="text-center">Delivery Fee:</p>
                            </div>
                            <!-- tax -->
                            <div class="py-1" style="margin-left: auto;">
                                <p class="text-center">5,000Ks</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col d-flex justify-content-between">
                            <!-- delivery-->
                            <div class="py-1 fw-bold w-25%">
                                <p class="text-center">Tax:</p>
                            </div>
                            <!-- tax -->
                            <div class="py-1" style="margin-left: auto;">
                                <p class="text-center">5%</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-end">
                        <!-- add delivery and tax -->
                        <?php $total_amount= $total_amount + 5000 + ($total_amount * 0.05) ?>
                        Total Amount : <?= number_format($total_amount,0) ?>Ks
                    </div>
                    

                </div>
                <hr>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php
try {
    if (isset($_POST['submit'])) {

        $user_id = $_SESSION['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $pass1 = $_POST['password'];
        $pass2 = $_POST['cpassword'];


        //if new passwords are entered check them and update with password
        if (!(empty($pass1) && empty($pass1))) {
            echo '<font color="red"><b>';
            if ($pass1 !== $pass2) {
                echo '<div class="text-center">';
                echo "The passwords have to be the same.";
                echo '</b></font>';
                return false;
            } else if (strlen($pass1) < 8) {
                echo "Your password must be at least 8 characters long.";
                echo "</b></font>";
            } else {
                echo "</b></font>";
                $sql = "UPDATE users SET
                name = :name,
                email = :email,
                phone = :phone,
                address = :address,
                password = :password
                WHERE user_id = :user_id";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':user_id' => $user_id,
                    ':name' => $name,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':address' => $address,
                    ':password' => $pass1,
                ]);

                echo '<div class="text-center"><h5>Profile Updated Successfully! </h5><div>';
            }
        } else if ((empty($pass1) && empty($pass1))) {

            //if new passwords are not entered update without them
            $sql = "UPDATE users SET
                name = :name,
                email = :email,
                phone = :phone,
                address = :address
                WHERE user_id = :user_id";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $user_id,
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':address' => $address,
            ]);
            echo '<div class="text-center"><h5>Profile Updated Successfully! </h5><div>';
        }
    }
} catch (Exception $e) {
    die($e->getMessage());
}
?>

<!-- import footer -->
<?php
include("footer.php");
?>