<!-- import header here -->
<?php
$pageName='View Feedback';
require_once("head.php");
require_once("connect.php");
require_once("data.php");
?>
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <!-- import spinner here -->
    <!-- Spinner End -->

    <!-- Sidebar Start -->
    <!-- import sidebar here -->
    <?php include("sidebar.php"); ?>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <!-- import navbar here -->
        <?php include("navbar.php"); ?>
        <!-- Navbar End -->

        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h5 class="mb-4">Customer Feedback </h5>
                        <?php 
                        $sql = "SELECT * from feedback";
                        if (isset($_GET['sort'])) {
                            switch ($_GET['sort']) {
                                case 'newest':
                                    $sql .= ' ORDER BY feedback_id DESC';
                                    break;
                                case 'oldest':
                                    $sql .= ' ORDER BY feedback_id';
                                    break;
                                case 'lowest_rating':
                                    $sql .= ' ORDER BY rating';
                                    break;
                                case 'highest_rating':
                                    $sql .= ' ORDER BY rating desc';
                                    break;
                            }
                        }
                        $stmt = $pdo->query($sql);
                        $messages = $stmt->fetchALL(PDO::FETCH_ASSOC);

?>

                        <?php
                        echo 'Total Feedback = ' . count($messages);
                        ?>
                        <div>
                            <form action="#" method="GET">
                                <label for="sort">Sort By:</label>
                                <select name="sort" class="form-control" id="sort" onchange="this.form.submit()">
                                    <option value="NULL">--choose sort order--</option>
                                    <option value="highest_rating">Highest Rating</option>
                                    <option value="lowest_rating">Lowest Rating</option>
                                    <option value="newest">Newest</option>
                                    <option value="oldest">Oldest</option>
                                </select>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <?php
                                        if ($messages == null) {
                                            print '<h3>There is no feedback!</h3>';
                                        }?>
                                            <th scope="col">Feedback ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Message</th>
                                            <th scope="col">Rating</th>
                                            <th scope="col">Action</th>
                                           
                                    </tr>
                                </thead>
                                <tbody>
                                        
                                    <?php foreach ($messages as $msg): ?>
                                        <tr>
                                            <td><?= $msg['feedback_id'] ?></td>
                                            <td><?= $msg['name'] ?></td>
                                            <td><?= $msg['email'] ?></td>
                                            <td><?= $msg['subject'] ?></td>
                                            <td>
                                                <p style="max-height: 120px; overflow-y: scroll;">
                                                    <?= $msg['message'] ?>
                                                </p>
                                            </td>
                                            <td><?= $msg['rating'] ?></td>
                                            <td>
                                            <form>
                                                <a onClick="javascript: return confirm('Please confirm deletion');" href=<?= "feedback_delete.php?id=" . $msg['feedback_id'] ?> class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                            </form>
                                            </td>
                                           
                                        </tr>
                                    <?php endforeach ?>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table End -->


        <!-- Footer Start -->
        <div class="pt-4">
            <div class="bg-light rounded-top p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        &copy; <a href="#">2024 Cook's Companion</a>, All Right Reserved.
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<?php include("jslibs.php");  ?>