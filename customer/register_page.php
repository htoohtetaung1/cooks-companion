<!-- set page name and import html head -->
<?php
$pagename = "Register";
include("head.php");
include("connect.php");
include("fetch_Product.php");
include('calculate_price.php');
include('register_validate.php');
include('data.php');
?>

<!-- import nav bar -->
<?php
include("navbar.php");
?>

<div class="main">
  <div class="register-greet">
    <h2>Create Your Cook's Companion Account</h2>
    <?php 
      getUsers($pdo);
    ?> 
  </div>
  <div class="register-div">
    <form action="#" method="post">
      <div class="row">
        <div class="col-25">
          <label for="name">Name</label>
        </div>
        <div class="col-75">
          <input type="text" id="name" name="name" placeholder="Your name" required>
        </div>
      </div>
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
          <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="cpassword">Confirm Password</label>
        </div>
        <div class="col-75">
          <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="phone">Phone Number</label>
        </div>
        <div class="col-75">
          <input type="text" inputmode="numeric" id="phone" name="phone" pattern="^0\d{8,}" placeholder="Your phone number. e.g. 0950123123" required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="address">Address</label>
        </div>
        <div class="col-75">
          <textarea id="address" name="address" placeholder="Your address" style="height:120px" required></textarea>
        </div>
      </div>
      <div class="row submit-row">
        <input type="submit" name="submit" value="Register">
      </div>

    </form>
  </div>
      
  <div style="text-align: center;">
    <?php
    if(isset($_POST['submit'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $cpassword = $_POST['cpassword'];
      $address = $_POST['address'];
      $phone = $_POST['phone'];
      if (validateRegister($email,$password,$cpassword,$phone)) {
        addUser($name,$email,$password,$phone,$address, "customer");
      };
    }
    ?>
    <p style="margin-bottom: 10px;">Already have an account?&nbsp;<a href="login_page.php"><b>Log in here.</b></a></p>
  </div>
</div>


<!-- import footer -->
<?php
include("footer.php");
?>
