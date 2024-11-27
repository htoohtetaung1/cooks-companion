<!-- import header here -->
<?php
$pageName = "Edit User";
include("head.php");
include("connect.php");
include("data.php");
$id = $_GET['id'];


$user = getSpecificUser($pdo, $id);

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
                        <h6 class="mb-4">Edit User</h6>
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
                                <label for="password" class="form-label">Password</label>
                                <input type="text" name="password" class="form-control" id="password" value="<?= htmlspecialchars($user['password']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="user_type" class="form-label">User Type</label>
                                <select name="user_type" id="user_type" class="custom-select form-select">
                                    <option value="customer">customer</option>
                                    <option value="admin">admin</option>
                                </select>
                            </div>


                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form End -->
        <?php

        if (isset($_POST['submit'])) {
            try {
                $user_id = $user['user_id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $password = $_POST['password'];
                $user_type = $_POST['user_type'];

                $sql = "UPDATE users SET 
                name = :name,
                email = :email,
                address = :address,
                phone = :phone,
                password = :password,
                user_type = :user_type
                WHERE user_id = :user_id";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':address' => $address,
                    ':phone' => $phone,
                    ':password' => $password,
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