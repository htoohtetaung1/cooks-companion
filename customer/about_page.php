<!-- set page name and import html head -->
<?php
$pagename = "About Cook's Companion";
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
    <div style="padding: 30px; text-wrap: wrap;max-width: 1000px; text-align: justify">
        <h2>About Us</h2>
        <p>
            Welcome to <strong>Cook's Companion</strong>, your trusted partner in the kitchen.
            We believe that every meal tells a story, and with the right tools, every home chef
            can create something extraordinary. That’s why we’re dedicated to bringing you top-quality
            kitchenware that combines functionality, style, and durability.
        </p>
        <p>
            At <strong>Cook's Companion</strong>, we curate a wide selection of products to suit
            chefs of all levels—from everyday cooks to culinary enthusiasts. Whether you're flipping
            pancakes for breakfast, hosting a gourmet dinner party, or perfecting your grandma's pie
            recipe, we’ve got the tools to make it happen.
        </p> <br>
        <h3>What Sets Us Apart?</h3>
        <ul style="list-style-type: disc;line-height: 200%; margin-left: 20px;">
            <li><strong>Quality You Can Trust:</strong> Every item we sell is rigorously tested for durability and performance.</li>
            <li><strong>Stylish and Practical Designs:</strong> Our products don’t just work well; they look great in any kitchen.</li>
            <li><strong>Commitment to Sustainability:</strong> We prioritize eco-friendly materials and packaging to help you cook with care for the planet.</li>
        </ul>
        <p>
            Founded with a passion for food and a mission to inspire, <strong>Cook's Companion</strong>
            is here to help you transform cooking into an art and your kitchen into your happy place.
        </p>
        <p>
            Join our community of home chefs and discover how the right tools can make all the difference.
            We’re excited to be part of your culinary journey.
        </p>
        <p><strong>Cook’s Companion – Cook with Confidence.</strong></p>
    </div>
</div>


<!-- import footer -->
<?php
include("footer.php");
?>