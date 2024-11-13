<link rel="stylesheet" href="style.css">

<div class="navbar">
    <div class="nav-logo">
        <div class="nav-logo-text">
            <a href="index.php">Cook's Companion</a>
        </div>
    </div>
    <div class="nav-search nav-item">
        <form action="" class="nav-search-form">
            <input type="text" placeholder="Search" class="nav-search-input" name="nav-search">
            <input type="image" class="search-button" src="pics/search-icon.png" width="30px">
        </form>
    </div>
    <div class="nav-links-div nav-item">
        <div class="nav-link large-font dropdown">
            <button class="nav-link-anchor dropdown" onclick="dropdownNavLinks()">Browse&#x25BC</button>
            <div class="dropdown-navlinks" id="dropdown-navlinks">
                <a href="">All Products</a>
                <a href="">Cookware</a>
                <a href="">Kitchen Knives</a>
                <a href="">Accessories</a>
                <a href="">Appliances</a>
            </div>
        </div>


        <div class="nav-link large-font"><a class="nav-link-anchor" href="">Promotions</a></div>
        <div class="nav-link large-font"><a class="nav-link-anchor" href="">FAQs</a></div>
        <div class="nav-link large-font"><a class="nav-link-anchor" href="">About Us</a></div>
    </div>
    <div class="nav-icons-div">
        <div class="nav-icon"><a href=""><img src="pics/user-icon.png" width="23px" alt=""></a></div>
        <div class="nav-icon"><a href=""><img src="pics/cart-icon.png" width="23px" alt=""></a></div>
    </div>
    <div class="hamburger nav-icon dropdown">
        <button onclick="dropdownHeader()">
            <img src="pics/hamburger-icon.png" alt="" width="23px"></a>
        </button>
        <div class="dropdown-content" id="dropdown-content">
            <form action="" class="nav-search-form dropsearch">
                <input type="text" placeholder="Search" class="nav-search-input dropsearch-input" name="nav-search">
                <input type="image" class="search-button" src="pics/search-icon.png" width="30px">
            </form>
            <div class="nav-link large-font droplink">
                <ul>
                    <span style="text-decoration:underline">Browse</span> 
                    <li>
                        <a href="">All Products</a>
                    </li>
    
                    <li>
                        <a href="">Cookware</a>
                    </li>
    
                    <li>
                        <a href="">Kitchen Knives</a>
                    </li>
                    <li>
                        <a href="">Accessories</a>
                    </li>
                    <li>
                        <a href="">Appliances</a>
                    </li>
                </ul>

            </div>
            <div class="nav-link large-font droplink"><a class="nav-link-anchor" href="">Promotions</a></div>
            <div class="nav-link large-font droplink"><a class="nav-link-anchor" href="">FAQs</a></div>
            <div class="nav-link large-font droplink"><a class="nav-link-anchor" href="">About Us</a></div>
        </div>
    </div>

</div>