<!-- import header here -->
<?php
$pageName = "Add Product";
include("head.php");
include("connect.php");
include("data.php");
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
                        <h6 class="mb-4">Add Product</h6>
                        <form method="post" action="product_insert.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Name</label>
                                <input type="text" name="pname" class="form-control" id="prouct_name">
                            </div>
                            <div class="mb-3">
                                <label for="product_type" class="form-label">Product Type</label>
                                <br>
                                <select name="ptype" id="product_type" class="form-select">
                                        <option value="Kitchen Knives">Kitchen Knives</option>
                                        <option value="Cookware">Cookware</option>
                                        <option value="Accessories">Accessories</option>
                                        <option value="Appliances">Appliances</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" name="price" class="form-control" id="price">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label> <br>
                                <textarea id="description" class="form-control" name="desc" rows="4" wrap="soft" placeholder="Add product description"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="text" name="stock" class="form-control" id="stock">
                            </div>
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount: 0 to 100</label>
                                <input type="text" name="discount" class="form-control" id="discount">
                            </div>
                            <div class="mb-3">
                                <label for="img" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="img" name="img" placeholder="No File Choosen" aria-describedby="addon-wrapping">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form End -->


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