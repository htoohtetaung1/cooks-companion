<!-- set page name and import html head -->
<?php
$pagename = "Our Return Policy";
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
    <div style="padding: 30px; text-wrap: wrap;">
    <h1>Return Policy</h1>
    <p>
        At <strong>Cook's Companion</strong>, your satisfaction is our priority. If you're not completely happy with your purchase, we’re here to help.
        <br> Our Return Policy ensures a simple and hassle-free process for returning or exchanging your items.
    </p>
    <h2>Eligibility for Returns</h2>
    <p>To qualify for a return, the following conditions must be met:</p>
    <ul style="list-style-type: disc;line-height: 200%; margin-left: 20px">
        <li>The item must be unused, in its original condition, and in its original packaging.</li>
        <li>A return request must be initiated within <strong>30 days</strong> of receiving your order.</li>
        <li>You must provide proof of purchase, such as your order confirmation or receipt.</li>
    </ul>
    <h2>Non-Returnable Items</h2>
    <p>The following items are not eligible for return:
        <ul  style="list-style-type: disc;line-height: 200%; margin-left: 20px">
            <li>Gift cards.</li>
            <li>Clearance or final sale items.</li>
            <li>Used or damaged items that are not due to a manufacturing defect.</li>
        </ul>
    </p>
    <h2>How to Initiate a Return</h2>
    <p>To start the return process, follow these steps:</p>
    <ol type="i">
        <li>Contact our Customer Service team at <a href="mailto:returns@cookscompanion.com">returns@cookscompanion.com</a> or call us at <strong>09975543222 , 09975543333</strong>.</li>
        <li>Provide your order details and reason for the return.</li>
        <li>Our team will provide you with a return authorization and shipping instructions.</li>
    </ol>
    <p>
        Please ensure the returned item is securely packaged to avoid damage during transit. You are responsible for the cost of return shipping unless the item was damaged or incorrect upon delivery.
    </p>
    <h2>Refunds</h2>
    <p>
        Once we receive and inspect your return, we will notify you of the status of your refund. Approved refunds will be processed to your original payment method within <strong>5-7 business days</strong>. Please note that shipping costs are non-refundable.
    </p>
    <h2>Exchanges</h2>
    <p>
        If you received a defective or damaged item, we will replace it at no additional cost. Contact us within <strong>30 days</strong> of delivery to arrange for an exchange.
    </p>
    <h2>Contact Us</h2>
    <p>
        If you have any questions about our Return Policy or need assistance, please contact us at 
        <a href="mailto:returns@cookscompanion.com">returns@cookscompanion.com</a> or call <strong>09975543222 , 09975543333</strong>.
    </p>
    </div>
</div>


<!-- import footer -->
<?php
include("footer.php");
?>