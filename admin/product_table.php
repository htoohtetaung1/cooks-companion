<!-- import header here -->
<?php
require_once("head.php");
require_once("connect.php");
require_once("data.php");
$products = getProducts($pdo);

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
                        <?php echo 'Total products = ' . count($products) ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <?php
                                        if ($products == null) {
                                            print '<h3>There are no products!</h3>';
                                        }
                                        foreach (array_keys($products[0]) as $title): ?>
                                            <th scope="col"><?= $title ?></th>

                                        <?php endforeach    ?>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): ?>
                                        <tr>
                                            <td><?= $product['ID'] ?></td>
                                            <td><?= $product['Name'] ?></td>
                                            <td><?= $product['Product_Type'] ?></td>
                                            <td><?= $product['Price'] ?></td>
                                            <td>
                                                <p style="max-height: 120px; overflow-y: scroll;">
                                                    <?= $product['Description'] ?>
                                                </p>
                                            </td>
                                            <td><?= $product['Stock'] ?></td>
                                            <td><?= $product['Discount'] ?></td>
                                            <td><img src="<?= $product['Photo'] ?>" alt="Product Image" style="width: 80px; height: 100px;"></td> <!-- Display image -->

                                        <td>
                                                <form>
                                                    <a href=<?= "product_edit.php?id=" . $product['ID'] ?> class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                                                    <a href=<?= "product_delete.php?id=" . $product['ID'] ?> class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
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
                        &copy; <a href="#">Your Site Name</a>, All Right Reserved.
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