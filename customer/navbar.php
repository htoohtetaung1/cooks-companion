<div class="navbar" style="padding-left: 20px">
    <div class="nav-logo">
        <div class="nav-logo-text">
            <a href="index.php">Cook's Companion</a>
        </div>
    </div>
    <div class="nav-search nav-item">
        <form action="search_process.php" method="GET" class="nav-search-form">
            <input type="hidden" name="filter" value="">
            <input type="hidden" name="sort" value="price">
            <input type="text" placeholder="Search" list="categories" class="nav-search-input" name="search">
            <datalist id="categories">
                <option value="Kitchen Knives">
                <option value="Cookware">
                <option value="Appliances">
                <option value="Accessories">
            </datalist>
            <button class="search-button" name="submit"><i class="fa-solid fa-magnifying-glass"></i></button>

            <!-- <input type="button" class="search-button" src="pics/search-icon.png" width="30px"> -->
        </form>
    </div>
    <div class="nav-links-div nav-item">
        <div class="nav-link large-font dropdown">
            <button class="nav-link-anchor dropdown" onclick="dropdownNavLinks()">Browse&#x25BC</button>
            <div class="dropdown-navlinks" id="dropdown-navlinks">
                <a href="all_products_page.php">All Products</a>
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
        <div class="nav-icon"><a href="check_login.php"><img src="pics/user-icon.png" width="23px" alt=""></a></div>
        <div class="nav-icon"><a href="check_login_cart.php"><img src="pics/cart-icon.png" width="23px" alt=""></a></div>
    </div>
    <div class="hamburger nav-icon dropdown">
        <button onclick="dropdownHeader()">
            <img src="pics/hamburger-icon.png" alt="" width="23px"></a>
        </button>
        <div class="dropdown-content" id="dropdown-content">
            <form action="" class="nav-search-form dropsearch">
                <input type="text" placeholder="Search" class="nav-search-input dropsearch-input" name="nav-search">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div class="nav-link large-font droplink">
                <ul>
                    <span style="text-decoration:underline">Browse</span>
                    <li>
                        <a href="all_products_page.php">All Products</a>
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