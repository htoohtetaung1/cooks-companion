<!-- import header here -->
<?php
$pageName = "Dashboard";
include("head.php");

include("connect.php");
?>
<div class="container-xxl position-relative bg-white d-flex p-0">

    <!-- Sidebar Start -->
    <!-- import sidebar here -->
    <?php

    include("sidebar.php");

    ?>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Navbar Start -->
        <!-- import navbar here -->
        <?php include("navbar.php"); ?>
        <!-- Navbar End -->

        <!-- Sale & Revenue Start -->
        <div class="container-fluid pt-4 px-4">
            <?php
            $currentYear = date('Y');
            $currentMonth = date('m');
            $monthlySalesQuery =
                "
                SELECT MONTH(date) AS month, SUM(total_price) AS total_sales
                FROM sales_info
                WHERE YEAR(date) = $currentYear
                GROUP BY MONTH(date)
                ORDER BY month;
            ";
            $monthlySalesResult = $pdo->query($monthlySalesQuery);

            $months = [];
            $monthlySales = [];
            $rows = $monthlySalesResult->fetchALL(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $months[] = date('F', mktime(0, 0, 0, $row['month'], 10)); // Convert month number to name
                $monthlySales[] = $row['total_sales'];
            }

            $dailySalesQuery = "
                SELECT DAY(date) AS day, SUM(total_price) AS total_sales
                FROM sales_info
                WHERE YEAR(date) = $currentYear AND MONTH(date) = $currentMonth
                GROUP BY DAY(date)
                ORDER BY day;
            ";
            $dailySalesResult = $pdo->query($dailySalesQuery);

            // Prepare data for the daily sales chart
            $days = [];
            $dailySales = [];
            $rows = $dailySalesResult->fetchALL(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $days[] = $row['day'];
                $dailySales[] = $row['total_sales'];
            }
            ?>

            <?php 
            $currentYear = date('Y');
            $currentMonth = date('m');
            $currentDay = date('Y-m-d');
            
            $monthlyTotalQuery = "
                SELECT SUM(total_price) AS total_sales
                FROM sales_info
                WHERE YEAR(date) = $currentYear AND MONTH(date) = $currentMonth;
            ";
            $monthlyTotalResult = $pdo->query($monthlyTotalQuery);
            $monthlyTotal = $monthlyTotalResult->fetch(PDO:: FETCH_ASSOC)['total_sales'] ?? 0;
            
            $dailyTotalQuery = "
                SELECT SUM(total_price) AS total_sales
                FROM sales_info
                WHERE DATE(date) = '$currentDay';
            ";
            $dailyTotalResult = $pdo->query($dailyTotalQuery);
            $dailyTotal = $dailyTotalResult->fetch(PDO:: FETCH_ASSOC)['total_sales'] ?? 0;

            $yearlyTotalQuery = "
            SELECT SUM(total_price) AS total_sales
            FROM sales_info
            WHERE Year(date) = '$currentYear';
        ";
        $yearlyTotalResult = $pdo->query($yearlyTotalQuery);
        $yearlyTotal = $yearlyTotalResult->fetch(PDO:: FETCH_ASSOC)['total_sales'] ?? 0;

            ?>
            <div class="row g-4">

                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-area fa-3x text-secondary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Today Revenue</p>
                            <h6 class="mb-0"><?=$dailyTotal?> Ks</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-pie fa-3x text-secondary"></i>
                        <div class="ms-3">
                            <p class="mb-2">This Month's Revenue</p>
                            <h6 class="mb-0"><?=$monthlyTotal?> Ks</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-pie fa-3x text-secondary"></i>
                        <div class="ms-3">
                            <p class="mb-2">This Year's Revenue</p>
                            <h6 class="mb-0"><?=$yearlyTotal?> Ks</h6>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Sale & Revenue End -->


        <!-- Sales Chart Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Daily Sales for This Month</h6>
                        </div>
                        <canvas id="dailySalesChart" width="400" height="200"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Monthly Sales for This Year</h6>
                        </div>
                        <canvas id="monthlySalesChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Monthly Sales Data
            const months = <?php echo json_encode($months); ?>;
            const monthlySales = <?php echo json_encode($monthlySales); ?>;

            const ctx1 = document.getElementById('monthlySalesChart').getContext('2d');
            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: months, // Month names
                    datasets: [{
                        label: 'Monthly Sales for <?php echo date('Y') ?>',
                        data: monthlySales, // Total sales per month
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Total Sales'
                            }
                        }
                    }
                }
            });

            // Daily Sales Data
            const days = <?php echo json_encode($days); ?>;
            const dailySales = <?php echo json_encode($dailySales); ?>;

            const ctx2 = document.getElementById('dailySalesChart').getContext('2d');
            new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: days, // Day of the month
                    datasets: [{
                        label: 'Daily Sales for <?php echo date('M') ; ?>',
                        data: dailySales, // Total sales per day
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Day'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Total Sales'
                            }
                        }
                    }
                }
            });
        </script>
        <!-- Sales Chart End -->
    </div>

    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<?php
include("jslibs.php");  ?>