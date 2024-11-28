<!-- import header here -->
<?php
$pageName = "Edit Order";
include("head.php");
include("connect.php");
include("data.php");
$id = $_GET['id'];


$order = getSpecificOrder($pdo, $id);

?>
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <!-- import spinner here -->
    <?php
    include("spinner.php");
    ?>
    <!-- Spinner End -->

    <!-- Sidebar Start -->
    <!-- import sidebar here -->
    <?php
    include("sidebar.php");
    ?>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <!-- import navbar here -->
        <?php
        include("navbar.php");
        ?>
        <!-- Navbar End -->

        <!-- Form Start -->

        <!-- <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-12 px-lg-5">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Update User</h6>
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="user_id" class="form-label">User ID</label>
                                <input type="number" name="user_id" class="form-control" id="user_id" aria-describedby="user_id" readonly value="<?= htmlspecialchars($user['user_id']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="<?= htmlspecialchars($user['name']) ?>">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="<?= htmlspecialchars($user['email']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" id="addrerss" value="<?= htmlspecialchars($user['address']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="number" name="phone" class="form-control" id="phone" value="<?= htmlspecialchars($user['phone']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="user_type" class="form-label">User Type</label>
                                <select name="user_type" id="user_type" class="custom-select">
                                    <option value="customer">customer</option>
                                    <option value="admin">admin</option>
                                </select>
                            </div>


                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Form End -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h5 class="mb-4">Edit Order</h5>

                        <div class="table-responsive">
                            <table class="table">
                                <?php
                                if ($order == null) {
                                    print '<h3>There are no orders!</h3>';
                                }


                                $sql = "SELECT * FROM sales_info WHERE order_id= :id";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([':id' => $order['order_id']]);
                                $order_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                $total_amount = 0;
                                $user_id = $order['user_id'];
                                foreach ($order_details as $order_detail) {
                                    $total_amount += $order_detail['total_price'];
                                }
                                $sql = "SELECT * FROM users WHERE user_id= :id";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([':id' => $user_id]);
                                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                // print_r ($user);

                                ?>

                                <tr style="text-decoration:underline">
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col" colspan="2">User ID and Name</th>
                                    <th scope="col" class="text-end">Payment Type</th>
                                </tr>
                                <tr>
                                    <form action="" method="POST">
                                        <td><?= $order['order_id'] ?></td>
                                        <td><input type="date" name="date" id="date" value="<?= $order['date'] ?>" class="form-control" required> </td>
                                        <td colspan="2">
                                            <select name="user_id" id="user_id" class="form-select">
                                                <?php
                                                $users = getUsers($pdo);
                                                foreach ($users as $user):
                                                    if ($user['user_type'] !== 'admin'):
                                                ?>
                                                        <option value="<?= $user['user_id'] ?>"><?php echo $user['user_id'] . "-" . $user['name'] ?></option>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </select>
                                        </td>
                                        <td class="text-end">
                                            <select name="payment_type" class="form-select">
                                                <option value="<?= $order['payment_type'] ?>"><?= $order['payment_type'] ?></option>
                                                <option value="KBZ Pay">KBZ Pay</option>
                                                <option value="AYA Pay">AYA Pay</option>
                                                <option value="CB Pay">CB Pay</option>
                                                <option value="Wave Pay">Wave Pay</option>
                                                <option value="MPU">MPU</option>
                                                <option value="Visa">Visa</option>
                                                <option value="PayPal">PayPal</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="submit" name="order_edit" value="Edit Order Detail" class="btn btn-primary">
                                        </td>
                                    </form>
                                </tr>
                                <?php
                                if (isset($_POST['order_edit'])) {
                                    try {
                                        $order_id = $id;
                                        $date = $_POST['date'];
                                        $user_id = $_POST['user_id'];
                                        $payment_type = $_POST['payment_type'];

                                        $sql = "UPDATE orders SET 
                                            user_id = :user_id,
                                            date = :date,
                                            payment_type = :payment_type
                                            WHERE order_id = :order_id";

                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute([
                                            ':user_id' => $user_id,
                                            ':date' => $date,
                                            ':payment_type' => $payment_type,
                                            ':order_id' => $order_id
                                        ]);

                                        echo '<div class="text-center"><b>Order Updated Successfully! </b><div>';
                                    } catch (Exception $e) {
                                        echo "<h4>Error updating product: " . $e->getMessage() . "</h4>";
                                    }
                                }
                                ?>

                                <tr>
                                    <td></td>
                                    <th scope="col">Ordered Item ID</th>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col" class="text-end">Qty</th>
                                </tr>
                                <?php
                                foreach ($order_details as $order_detail):

                                ?>
                                    <tr class="text-end">

                                        <td></td>
                                        <td><?= $order_detail['ordered_items_id'] ?></td>
                                        <td>
                                            <?= $order_detail['product_id'] ?>
                                        </td>
                                        <td>
                                            <?= $order_detail['product_name'] ?>
                                        </td>
                                        <td>
                                            <?= $order_detail['qty'] ?>
                                        </td>
                                        <td>
                                            <form action="" method="GET">
                                                <a onClick="javascript: return confirm('Please confirm deletion');" href=<?= "ordered_item_delete.php?od_id=" . $order_detail['ordered_items_id'] . "&o_id=" . $order['order_id'] ?> class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>

                                            </form>
                                        </td>
                                    </tr>


                                <?php endforeach ?>




                                <tbody>

                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <form action="ordered_item_add.php" method="get">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                Add a product:
                                            </td>
                                            <td>Qty:</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>

                                                <select name="product_id" id="product_id" class="form-select">
                                                    <?php
                                                    $products = getProducts($pdo);
                                                    foreach ($products as $product):
                                                    ?>
                                                        <option value="<?= $product['ID'] ?>"><?= $product['ID'] . ' - ' . $product['Name'] ?>.</option>
                                                    <?php endforeach ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="hidden" name="o_id" value="<?= $id ?>">
                                                <input type="number" name="qty" id="qty" min="1" class="form-control" value="1">
                                            </td>
                                            <td>
                                                <input type="submit" id="submit" value="Add Item" name="submit" class="btn btn-primary">
                                            </td>
                                        </tr>

                                    </table>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php

        if (isset($_POST['submit'])) {
            try {
                $user_id = $user['user_id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $user_type = $_POST['user_type'];

                $sql = "UPDATE users SET 
                name = :name,
                email = :email,
                address = :address,
                phone = :phone,
                user_type = :user_type
                WHERE user_id = :user_id";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':address' => $address,
                    ':phone' => $phone,
                    ':user_type' => $user_type,
                    ':user_id' => $user_id
                ]);

                echo '<div class="text-center"><b>User Updated Successfully! </b><div>';
            } catch (Exception $e) {
                echo "<h4>Error updating product: " . $e->getMessage() . "</h4>";
            }
        }
        ?>


        <!-- Footer Start -->
        <div class="pt-4">
            <div class="bg-light rounded-top p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        &copy; <a href="#">2024 Cook's Companion</a>, All Right Reserved.
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<?php include("jslibs.php");  ?>