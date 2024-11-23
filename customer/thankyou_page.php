<!-- set page name and import html head -->
<?php
$pagename = "The Best Companion for a Cook!";
include("head.php");
include("connect.php");
include("fetch_Product.php");
include('calculate_price.php');
?>

<!-- import nav bar -->
<?php
include("navbar.php");
?>

<div class="main" style="text-align: center; height: 400px;">
    <div style="margin-top: 50px">

        <h3>Thank You For Your Purchase</h3> <br>
        <h4>We have you had a great experience shopping with Cook's Companion!</h4>
        <h5><a href="index.php"><u>Go back to home page.</u></a></h5>
    </div>
</div>


<!-- import footer -->
<?php
include("footer.php");
?>