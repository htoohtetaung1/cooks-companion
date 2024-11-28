<!-- set page name and import html head -->
<?php
$pagename = "Our Privacy Policy";
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
        <h1>Privacy Policy</h1>
        <p>
            At <strong>Cook's Companion</strong>, we value your trust and are committed to protecting
            your privacy. This Privacy Policy outlines how we collect, use, and safeguard your personal
            information when you visit our website or make a purchase.
        </p>
        <h2>Information We Collect</h2>
        <p>When you use our website, we may collect the following types of information:</p>
        <ul>
            <li><strong>Personal Information:</strong> Name, email address, phone number, billing and shipping addresses, and payment details when you make a purchase or create an account.</li>
            <li><strong>Non-Personal Information:</strong> Browser type, IP address, and usage data collected through cookies and similar technologies to improve your experience on our site.</li>
        </ul>
        <h2>How We Use Your Information</h2>
        <p>The information we collect is used for the following purposes:</p>
        <ul style="list-style-type: disc;line-height: 200%; margin-left: 20px">
            <li>To process and fulfill your orders, including payment and shipping.</li>
            <li>To communicate with you about your orders, updates, and promotions.</li>
            <li>To improve our website, products, and services based on your feedback and behavior.</li>
            <li>To comply with legal obligations and ensure the security of our platform.</li>
        </ul>
        <h2>How We Protect Your Information</h2>
        <p>
            We implement industry-standard security measures to safeguard your personal information
            from unauthorized access, disclosure, alteration, or destruction. This includes encrypted
            payment processing and secure server storage.
        </p>
        <h2>Sharing Your Information</h2>
        <p>
            We do not sell or rent your personal information to third parties. However, we may share
            your information with trusted partners to provide services such as payment processing,
            shipping, or marketing, only to the extent necessary for them to perform their duties.
        </p>
        <h2>Your Rights</h2>
        <p>
            You have the right to access, update, or delete your personal information at any time. If you
            wish to exercise these rights or have questions about your data, please contact us at
            <a href="mailto:privacy@cookscompanion.com">privacy@cookscompanion.com</a>.
        </p>
        <h2>Cookies and Tracking Technologies</h2>
        <p>
            Our website uses cookies to enhance your browsing experience and gather analytics data. You
            can manage your cookie preferences through your browser settings. By continuing to use our
            site, you consent to our use of cookies as outlined in this policy.
        </p>
        <h2>Policy Updates</h2>
        <p>
            We may update this Privacy Policy from time to time to reflect changes in our practices or
            legal requirements. Please check this page periodically for updates.
        </p>
        <h2>Contact Us</h2>
        <p>
            If you have any questions or concerns about our Privacy Policy or how your information is handled,
            <p>you can <a href="message_page.php"><u><b>send us a message</b></u></a> anytime and we'll be sure to reply as soon as possible.</p>
            You can also contact us at <strong><a href="mailto:privacy@cookscompanion.com">privacy@cookscompanion.com</a></strong>.
        </p>
    </div>


    <!-- import footer -->
    <?php
    include("footer.php");
    ?>