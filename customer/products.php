<!-- import header here -->
<?php include("head.php"); ?>
<!-- import navbar here -->
<?php 
include("navbar.php");
?>
<?php
include("connect.php");
include("data.php");
$products=showAllProducts($pdo);

?>
<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Check Our Products</h2>
                    <span>View products</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- product -->
<section class="section" id="products">
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Our Products</h2>
                    <span>Check out all of our products.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- product container -->
    <div class="container mt-5">
        <div class="row">
            <?php foreach($products as $product): ?>
            
            <div class="col-md-4">
                <!-- product card -->
                <div class="card pt-4" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                    <img src="../admin/<?= $product['product_image'] ?>" class="card-img-top" alt="Product Image"
                        style="object-fit: contain; height: 250px;">
                    <div class="card-body" style="background-color: #f8f9fa;">
                        <h5 class="card-title" style="font-size: 1.25rem; font-weight: bold;"><?= $product['product_name'] ?></h5>
                        <p class="card-text" style="color: #6c757d;"><?= $product['product_category'] ?></p>
                        <p class="card-text mb-3" style="font-size: 1.25rem; font-weight: bold; color: #28a745;"><?= $product['product_price'] ?>
                        </p>
                        <p><?= $product['product_stock']>0? 'available': 'unavailable' ?></p>
                        
                        <form action="addtocart.php" method="post" class="d-flex justify-content-between mt-2">
                        <a href="productview.php?id=<?= $product['product_id']?>" class="btn btn-primary float-right" style="border-radius: 25px;">View Product</a>
                        <input type="hidden" value="<?= $product['product_id'] ?>" name="id">
                        <input type="hidden" value="productpage" name="goto" >
                        <button class="btn btn-warning float-right" style="border-radius: 25px;">Add to Cart</button>
                        
                        </form>
                    </div>
                </div>
            </div>

            

         
            <?php endforeach ?>
        </div>
    </div>
</section>

<!-- import footer here -->
<?php
include("footer.php");
?>