<!-- set page name and import html head -->
<?php
$pagename = "Log In";
include("head.php");
include("connect.php");
include("fetch_Product.php");
include('calculate_price.php');
?>

<!-- import nav bar -->
<?php
include("navbar.php");

//resetting session if login page is reached
session_start();
// session_destroy();
// session_start();
?>

<div class="main">
    <div class="login-greet">
        <h2>Log In Your Account</h2>
    </div>
    <div class="login-div">
        <form action="#" method="post">
            <div class="row">
                <div class="col-25">
                    <label for="email">Email</label>
                </div>
                <div class="col-75">
                    <input type="email" id="email" name="email" placeholder="Your email" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="password">Password</label>
                </div>
                <div class="col-75">
                    <input type="password" id="password" name="password" placeholder="Your password">
                </div>
            </div>
            <!-- <div class="remember row">
                    <label for="remember">Remember me </label>
                    <input type="checkbox" checked="checked" id="remember" name="remember"> 
            </div> -->
            <div class="row submit-row">
                <input type="submit" name="submit" value="Log in">
            </div>
        </form>
    </div>
    <div style="text-align: center; margin-bottom: 10px;">
        <?php
        $loggedInUser;
        $userType;
        function userExists($email, $pass)
        {
            include('connect.php');
            include('data.php');
            $users = getUsers($pdo);
            $emailExists = false;
            $passwordMatches = false;
            foreach ($users as $user) {
                if ($user['email'] === $email && ($user['password'] === $pass)) {
                    $emailExists = true;
                    $passwordMatches = true;
                    $loggedInUser = $user['name'];
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['username'] = $user['name'];
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['phone'] = $user['phone'];
                    $_SESSION['address'] = $user['address'];
                    if ($user['user_type'] === "admin") {
                        $_SESSION['user_type'] = 'admin';
                    } else {
                        $_SESSION['user_type'] = 'customer';
                    }
                }
            }
            if ($emailExists && $passwordMatches) {
                return true;
            } else {
                return false;
            }
        }
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (userExists($email, $password)) {
                echo 'Log in successful!<br>';
                if($_SESSION['user_type'] === 'admin') {
                    echo '<a href="../admin/index.php"><b>Continue to admin dashboard.</b></a><br>';
                }
                echo '<a href="index.php"><b>Go back to home page.</b></a>';
            } else {
                echo '<font color="red"><b>';
                echo 'Incorrect email or password </font></b>';
            }
        }
        ?>
        <p>Don't have an account?&nbsp;<a href="register_page.php"><b>Create one here.</b></a></p>
    </div>
</div>


<!-- import footer -->
<?php
include("footer.php");
?>