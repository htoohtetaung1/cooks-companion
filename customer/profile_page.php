<!-- set page name and import html head -->
<?php
session_start();
$pagename = $_SESSION['username'] . "'s Profile";
include("head.php");
include("connect.php");
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
    <div class="profile-container p-3" style="display: flex; flex-direction:column;">
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
            <h5>Update Your Information</h5>
            <form method="post" action="#">
                <input type="hidden" name="user_id" class="form-control" id="user_id" aria-describedby="user_id" readonly value="<?= $_SESSION['user_id'] ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?= $_SESSION['username'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email" value="<?= $_SESSION['email'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" id="phone" pattern="^0\d{8,}" value="<?= $_SESSION['phone'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" required><?= $_SESSION['address'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>

                <div class="mb-3">
                    <label for="cpassword" class="form-label">Confirm New Password</label>
                    <input type="password" name="cpassword" class="form-control" id="cpassword">
                </div>
                <div class="mb-1">
                    <input type="submit" value="Update" name="submit" class="btn btn-primary">
                </div>
            </form>
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
                echo "<script>setTimeout(function() {window.location.href = window.location.href;}, 500);</script>";

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

<?php 
include('footer.php');
?>