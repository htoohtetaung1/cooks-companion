<!-- import header here -->
<?php
$pageName = "Product Table";
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
                        <h5 class="mb-4">Product Table</h5>
                        <?php
                        $sql = 'SELECT * from products';
                        if (isset($_GET['sort'])) {

                            $sql .= ' ORDER BY ';
                            switch ($_GET['sort']) {
                                case 'product_id':
                                    $sql .= 'product_id';
                                    break;
                                case 'product_id2':
                                    $sql .= 'product_id DESC';
                                    break;
                                case 'name':
                                    $sql .= 'name';
                                    break;
                                case 'price':
                                    $sql .= 'price';
                                    break;
                                case 'price1':
                                    $sql .= 'price DESC';
                                    break;
                                case 'discount_percent':
                                    $sql .= 'discount_percent DESC';
                                    break;
                                default:
                                    $sql = 'SELECT * FROM products';
                            }
                        }
                        $stmt = $pdo->query($sql);
                        $products = $stmt->fetchALL(PDO::FETCH_ASSOC);
                        ?>
                        <?php echo 'Total products = ' . count($products) ?>
                        <div>
                            <form action="#" method="GET">
                                <label for="sort">Sort By:</label>
                                <select name="sort" class="form-control" id="sort" onchange="this.form.submit()">
                                    <option value="NULL">--choose sort order--</option>
                                    <option value="product_id">ID Ascending</option>
                                    <option value="product_id2">ID Descending</option>
                                    <option value="name">Name</option>
                                    <option value="price">Lowest Price</option>
                                    <option value="price1">Highest Price</option>
                                    <option value="discount_percent">Discount Percent</option>
                                </select>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <?php
                                        if ($products == null) {
                                            print '<h3>There are no products!</h3>';
                                        }
                                        ?>

                                        <th scope="col">Product ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Product Type</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Discount Percent</th>
                                        <th scope="col">Photo</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): ?>
                                        <tr>
                                            <td><?= $product['product_id'] ?></td>
                                            <td><?= $product['name'] ?></td>
                                            <td><?= $product['product_type'] ?></td>
                                            <td><?= $product['price'] ?></td>
                                            <td>
                                                <p style="max-height: 120px; overflow-y: scroll;">
                                                    <?= $product['description'] ?>
                                                </p>
                                            </td>
                                            <td><?= $product['qty'] ?></td>
                                            <td><?= $product['discount_percent'] ?></td>
                                            <td><img src="<?= $product['photo'] ?>" alt="Product Image" style="width: 80px; height: 100px;"></td> <!-- Display image -->

                                            <td>
                                                <form>
                                                    <a href=<?= "product_edit.php?id=" . $product['product_id'] ?> class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                                                    <a onClick="javascript: return confirm('Please confirm deletion');" href=<?= "product_delete.php?id=" . $product['product_id'] ?> class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
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