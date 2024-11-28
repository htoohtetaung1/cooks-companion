<!-- import header here -->
<?php
$pageName = "Edit Product";
include("head.php");
include("connect.php");
include("data.php");
$id = $_GET['id'];


$product = getSpecificProduct($pdo, $id);

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

        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-12 px-lg-5">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Edit Product</h6>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="product_id" class="form-label">Product ID</label>
                                <input type="number" name="pid" class="form-control" id="product_id" required aria-describedby="product_id" readonly value="<?= htmlspecialchars($product['product_id']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Name</label>
                                <input type="text" name="pname" class="form-control" id="prouct_name" required value="<?= htmlspecialchars($product['name']) ?>">
                            </div>

                            <div class="mb-3">
                                <label for="product_type" class="form-label">Product Type</label>
                                <br>
                                <select name="ptype" id="product_type" class="custom-select">
                                        <option value="Kitchen Knives">Kitchen Knives</option>
                                        <option value="Cookware">Cookware</option>
                                        <option value="Accessories">Accessories</option>
                                        <option value="Appliances">Appliances</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" name="price" class="form-control" id="price" value="<?= htmlspecialchars($product['price'])?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Description</label>
                                <input type="text" name="desc" class="form-control" id="stock" required value="<?= htmlspecialchars($product['description']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control" id="stock" required value="<?= htmlspecialchars($product['qty']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="number" name="discount" class="form-control" id="discount" required value="<?= htmlspecialchars($product['discount_percent']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="img" class="form-label">Photo</label>
                                <input type="file" name="img" class="form-control" id="img" >

                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form End -->
        <?php
        if (isset($_FILES['img'])) {
            $id = $product['product_id'];
            $target = $_FILES['img']['name'];
            $tmp = $_FILES['img']['tmp_name'];
            $targetDir = "img/" . $target; // Target directory to store the uploaded image
            move_uploaded_file($tmp, $targetDir); // Moving the uploaded image to the target directory
            if($_FILES['img']['size'] == 0) {
                print('<div class="text-center mt-2"><b>No new image inserted.</b></div> <br>');
                $targetDir = $product['photo'];
            }
        }


        if (isset($_POST['submit'])) {
            try {
                $id = $product['product_id'];
                $pname = $_POST['pname'];
                $ptype = $_POST['ptype'];
                $price = $_POST['price'];
                $desc = $_POST['desc'];
                $stock = $_POST['stock'];
                $discount = $_POST['discount'];

                $sql = "UPDATE products SET 
                name = :pname,
                product_type = :ptype,
                price = :price,
                description = :desc,
                qty = :stock,
                discount_percent = :discount,
                photo = :img
                WHERE product_id = :id";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':id' => $id,
                    ':pname' => $pname,
                    ':ptype' => $ptype,
                    ':price' => $price,
                    ':desc' => $desc,
                    ':stock' => $stock,
                    ':discount' => $discount,
                    ':img' => $targetDir
                ]);

                echo '<div class="text-center"><b>Product Updated Successfully! </b><div>';
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