<!-- set page name and import html head -->
<?php
$pagename = "Frequently Asked Questions";
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
    <div style="padding: 30px; text-wrap: wrap;margin-right: 30px; max-width: 1000px; text-align: justify">
    <h2>Frequently Asked Questions (FAQ)</h2>
    <p>Welcome to our FAQ page! Here you'll find answers to some of the most common questions our customers have. 
        If you can't find what you're looking for, feel free to contact us directly.</p>

    <h3>1. What products do you sell?</h3>
    <p>We offer a wide range of high-quality kitchenware, including cookware, bakeware, utensils, knives, small appliances, and much more. 
        Whether you're a beginner or a professional chef, we have something for every kitchen.</p>

    <h3>2. How can I place an order?</h3>
    <p>Placing an order is easy! Simply browse our product catalog, add your items to the cart, and proceed to checkout.  
        You'll need to sign up for an account and provide your shipping information and payment details to complete the order.</p>

    <h3>3. How do I track my order?</h3>
    <p>Once your order has been shipped, you will receive an email with a tracking number and a link to track your package.</p>

    <h3>4. Can I modify or cancel my order?</h3>
    <p>We strive to process orders as quickly as possible. If you need to make a change to your order, please contact us immediately at <a href="mailto:support@cookscompanion.com">support@cookscompanion.com</a>. We may be able to assist you if the order hasn’t been processed or shipped yet.</p>

    <h3>5. Do you offer free shipping?</h3>
    <p>Yes, we offer free standard shipping on orders over 100,000Ks. 
        For orders under 100,000Ks, we deliver to anywhere within the country for a low shipping pice of only 5,000Ks!</p>

    <h3>6. What is your return policy?</h3>
    <p>We want you to be completely satisfied with your purchase. If you’re not happy, you can return most items within 30 days of receiving your order.
         Please visit our <u> <a href="return_policy_page.php">Return Policy</a></u> page for more details.</p>

    <h3>7. How can I contact customer support?</h3>
    <p>If you have any questions or need assistance, our customer support team is here to help! 
        You can contact us via email at <a href="mailto:support@cookscompanion.com">support@cookscompanion.com</a> or call us at <strong>09975543222 , 09975543333</strong>.</p>

    <h3>8. Is my personal information safe on your website?</h3>
    <p>Yes! We take your privacy seriously. Our website uses secure encryption technology to protect your personal and payment information.
         For more details, please see our <a href="privacy_policy_page.php">Privacy Policy</a>.</p>

    <h3>9. Do you ship internationally?</h3>
    <p>Currently, we only ship within Myanmar.
         However, we are working on expanding our shipping options to other countries in the future. Stay tuned for updates!</p>

    <h3>10. Can I change the delivery address after placing an order?</h3>
    <p>If your order hasn't been shipped yet, we may be able to update the delivery address. 
        Please contact our customer support team as soon as possible to request a change.</p>

    <h3>Still Have Questions?</h3>
    <p>If you couldn't find the answer to your question here, don’t hesitate to get in touch with us. We're happy to assist you!</p>
    <p>You can <a href="message_page.php"><u><b>send us a message</b></u></a> anytime and we'll be sure to reply as soon as possible.</p>
    <p>Contact us at <a href="mailto:support@cookscompanion.com">support@cookscompanion.com</a> or call <strong>09975543222 , 09975543333</strong>.</p>
    </div>
</div>


<!-- import footer -->
<?php
include("footer.php");
?>