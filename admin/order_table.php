<!-- import header here -->
<?php
$pageName = "Order Table";
require_once("head.php");
require_once("connect.php");
require_once("data.php");

?>
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <!-- import spinner here -->
    <!-- Spinner End -->

    <!-- Sidebar Start -->
    <!-- import sidebar here -->
    <?php include("sidebar.php"); ?>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <!-- import navbar here -->
        <?php include("navbar.php"); ?>
        <!-- Navbar End -->

        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h5 class="mb-4">Order Table</h5>
                        <?php
                        $sql = "SELECT * FROM orders";
                        if (isset($_GET['sort'])) {
                            $sort = $_GET['sort'];
                            switch ($_GET['sort']) {
                                case 'date':
                                    $sql .= ' ORDER BY date';
                                    break;
                                case 'dateDesc':
                                    $sql .= ' ORDER BY date DESC';
                                    break;
                                case 'payment_type':
                                    $sql .= ' ORDER BY payment_type';
                                    break;
                                case 'user_id':
                                    $sql .= ' ORDER BY user_id';
                                    break;
                            }
                        }
                        $stmt = $pdo->query($sql);
                        $orders = $stmt->fetchALL(PDO::FETCH_ASSOC);
                        ?>

                        <?php echo 'Total Orders = ' . count($orders) ?>

                        <div>
                            <form action="#" method="GET">
                                <label for="sort">Sort By:</label>
                                <select name="sort" class="form-control" id="sort" onchange="this.form.submit()">
                                    <option value="NULL">--choose sort order--</option>
                                    <option value="dateDesc">Last Ordered</option>
                                    <option value="date">First Ordered</option>
                                    <option value="payment_type">Payment Type</option>
                                    <option value="user_id">User ID</option>
                                </select>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <?php
                                if ($orders == null) {
                                    print '<h3>There are no orders!</h3>';
                                }

                                //  foreach (array_slice($orders, 0, 2) as $order): {
                                foreach ($orders as $order): {
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
                                    }
                                ?>

                                    <tr style="text-decoration:underline">
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">User ID</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col" class="text-end">Payment Type</th>
                                        <th scope="col" class="text-end">Total Amount</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                    <tr>

                                        <td><?= $order['order_id'] ?></td>
                                        <td><?= $order['date'] ?></td>
                                        <td><?= $order['user_id'] ?></td>
                                        <td><?= $user['name'] ?></td>
                                        <td class="text-end"><?= $order['payment_type'] ?></td>
                                        <td class="text-end"><?= number_format($total_amount, 0) . 'Ks' ?></td>
                                        <td class="text-end">
                                            <form>
                                                <a href=<?= "order_edit.php?id=" . $order['order_id'] ?> class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                                                <a onClick="javascript: return confirm('Please confirm deletion');" href=<?= "order_delete.php?id=" . $order['order_id'] ?> class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                            </form>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td></td>
                                        <th scope="col">Ordered Item ID</th>
                                        <th scope="col">Product ID</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col" class="text-end">Buying Price</th>
                                        <th scope="col" class="text-end">Qty</th>
                                        <th scope="col" class="text-end">Total Product Price</th>
                                    </tr>
                                    <?php
                                    foreach ($order_details as $order_detail):
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td><?= $order_detail['ordered_items_id'] ?></td>
                                            <td><?= $order_detail['product_id'] ?></td>
                                            <td><?= $order_detail['product_name'] ?></td>
                                            <td class="text-end"><?php echo number_format($order_detail['buying_price'], 0) . 'Ks' ?></td>
                                            <td class="text-end"><?= $order_detail['qty'] ?></td>
                                            <td class="text-end"><?php echo number_format($order_detail['total_price'], 0) . 'Ks' ?></td>
                                        </tr>


                                    <?php endforeach ?>
                                    <tr style="max-height: 5px;background-color:eef0f3;">
                                        <td colspan="7">
                                            <hr>
                                        </td>
                                        
                                    </tr>

                                <?php endforeach ?>

                                </tr>

                                <tbody>

                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table End -->


        <!-- Footer Start -->
        <div class="container-fluid pt-4 px-4">
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