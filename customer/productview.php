<!-- import header here -->
<?php 
  include("head.php");
 ?>
<!-- import navbar here -->
<?php 
  include("navbar.php");
 ?>
<button?php
include("connect.php");
include("data.php");
$id=$_GET['id'];
$product=showSpecificProduct($pdo, $id);
?>

<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Product Detail</h2>
                    <span>Clear product view</span>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section" id="product">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="left-images">
                    <img src="../admin/<?= $product['product_image'] ?>" alt=""
                    style="width: 500px;height: 400px; object-fit:contain;">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="right-content">
                    <!-- product name -->
                    <h4><?= $product['product_category'] ?></h4>
                    <!-- price -->
                    <span class="price"><?= $product['product_price']?></span>
                    <!-- rating -->
                    <ul class="stars">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                    </ul>
                    <!-- description -->
                    <span><?= $product['product_stock']?></span>
                    <div class="quote">
                        <i class="fa fa-quote-left"></i>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiuski smod.</p>
                    </div>
                    <div class="quantity-content">
                        <div class="total">
                            <div class="main-border-button">
                                <form action="addtocart.php" method="post">
                                    <input type="hidden" value="<?= $product['product_id'] ?>" name="id" >
                                    <input type="hidden" value="viewpage" name="goto" >
                                    <button class="btn btn-outline-primary rounded-lg">Add To Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- import footer here -->
<?php 
  include("footer.php");
 ?>