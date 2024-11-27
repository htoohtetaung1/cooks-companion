<!-- set page name and import html head -->
<?php
$pagename = "Our Shipping Policy";
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
    <div style="padding:30px; text-wrap: wrap;max-width: 1000px; text-align: justify">
    <h2>Shipping Information</h2>
    <p>Thank you for shopping with <strong>Cook's Companion</strong>! We strive to provide fast and reliable shipping for all your kitchenware needs. Below you'll find details about our shipping process, rates, and policies.</p>

    <h3>Shipping Rates</h3>
    <p>We offer affordable shipping rates based on your order total and delivery location. Here’s how it works:</p>
    <ul style="list-style-type: disc;line-height: 200%; margin-left: 20px">
        <li><strong>Free Shipping:</strong> Enjoy free standard shipping on orders over <strong>100,000 Ks</strong>.</li>
        <li><strong>Standard Shipping:</strong> For orders below 100,000 Ks, a low fixed rate of <strong>5,000 Ks</strong> will be applied at checkout.</li>
    </ul>

    <h3>Order Processing Time</h3>
    <p>Once your order is placed, we will process it within <strong>1-2 business days</strong>. Orders are processed Monday through Friday, excluding public holidays. You will receive an email confirmation once your order has been shipped, along with tracking information.</p>

    <h3>Delivery Times</h3>
    <p>Delivery times may vary based on your location. Below is an estimated delivery window for standard shipping:</p>
    <ul>
        <li>Local deliveries: <strong>2-5 business days</strong></li>
        <li>Regional deliveries: <strong>5-7 business days</strong></li>
    </ul>
    <p>For expedited shipping options or international orders, please contact us at <a href="mailto:support@cookscompanion.com">support@cookscompanion.com</a> for more details.</p>

    <h3>Shipping Restrictions</h3>
    <p>At this time, we only ship within <strong>Myanmar</strong>. Unfortunately, we do not offer international shipping yet, but we are working on expanding our shipping options in the future. Please check back for updates.</p>

    <h3>Tracking Your Order</h3>
    <p>Once your order has been shipped, you will receive a tracking number via email. You can use this number to track your package through the shipping carrier’s website. If you have any issues or need assistance tracking your order, feel free to contact our customer support team.</p>

    <h3>Lost or Damaged Items</h3>
    <p>If your order is lost or damaged during shipping, please contact us immediately at <a href="mailto:support@cookscompanion.com">support@cookscompanion.com</a>. We will investigate the issue and work with the carrier to resolve it as quickly as possible.</p>

    <h3>Contact Us</h3>
    <p>If you have any questions about our shipping policies or need further assistance, please don't hesitate to reach out to our customer service team. We’re here to help!</p>
    <p>Contact us at <a href="mailto:support@cookscompanion.com">support@cookscompanion.com</a> or call <strong>09975543222 , 09975543333</strong>.</p>

    </div>
</div>


<!-- import footer -->
<?php
include("footer.php");
?>