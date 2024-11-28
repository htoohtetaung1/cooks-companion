<div class="sidebar bg-dp pe-4 pb-3">
    <nav class="navbar bg-dp navbar-light">
        <a href="" class="navbar-brand mx-4 mb-3">
            <div class="text-primary" style="color:white;"><b>
                    Cook's Companion
                </b>
            </div>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <!-- <div class="position-relative">
                 <img class="rounded-circle" src="" alt="" style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
             <div class="ms-3">
                <h6 class="mb-0">User</h6>
                <span>Admin</span>
            </div> -->
        </div>
        <?php
        $sql = "SELECT COUNT(*) AS message_count FROM messages WHERE replied = 'F';";
        $stmt = $pdo->query($sql);
        $msgCount = $stmt->fetch(PDO::FETCH_ASSOC);
        //print the unreplied message count
        // print_r("msgCount");
        $messageCount = $msgCount['message_count'];
        ?>


        <div class="navbar-nav w-100 bg-dp" style="color: white;">
            <a href="index.php" class="nav-item nav-link">&nbsp;<i class="fa-solid fa-gauge"></i>Dashboard</a>
            <a href="messages.php" class="nav-item nav-link">&nbsp;<i class="fa-regular fa-comments"></i>Messages&nbsp;<span style="color:red"><small><?=$messageCount?></small></span></a>
            <a href="product_create.php" class="nav-item nav-link">&nbsp;<i class="fa-solid fa-plus"></i>Add Products</a>
            <a href="product_table.php" class="nav-item nav-link">&nbsp;<i class="fa-solid fa-table"></i>Product Table</a>
            <a href="user_table.php" class="nav-item nav-link">&nbsp;<i class="fa-solid fa-table"></i>User Table</a>
            <a href="order_table.php" class="nav-item nav-link">&nbsp;<i class="fa-solid fa-table"></i>Order Table</a>
            <a href="customer_feedback.php" class="nav-item nav-link">&nbsp;<i class="fa-solid fa-message"></i></i>View Feedback</a>
        </div>
    </nav>
</div>