<!-- set page name and import html head -->
<?php
$pagename = "Search Products";
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
    <div class="filter-row">
        
    </div>
    <div class="search-container">

    </div>
</div>


<!-- import footer -->
<?php
include("footer.php");
?>