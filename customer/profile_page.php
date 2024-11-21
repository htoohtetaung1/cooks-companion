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

<div class="main">
<?php 
print_r($_SESSION);

?>
</div>


<!-- import footer -->
<?php
include("footer.php");
?>