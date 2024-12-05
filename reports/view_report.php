<?php
    include('../panel/header.php');
    include('../panel/sidebar.php');
    include('../panel/navbar.php');
?>


    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-wrap d-flex justify-content-between align-items-center">
                        <div>
                            <h1>VIEW REPORT</h1>
                            <p>Set up automated report generation (frequency and filters).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="iq-header-img">
            <img src="../assets/images/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
            <img src="../assets/images/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
            <img src="../assets/images/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
            <img src="../assets/images/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
            <img src="../assets/images/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
            <img src="../assets/images/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
        </div>
    </div>          <!-- Nav Header Component End -->
<!--Nav End-->
</div>

<div class="container-fluid content-inner mt-n5 py-0">
    <!-- View Report -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Report Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <p><strong>Report Name:</strong> Monthly Sales Report</p>
                    <p><strong>Report Type:</strong> Sales</p>
                    <p><strong>Created On:</strong> 2024-11-01</p>
                    <p><strong>Description:</strong> A detailed report showing sales trends for the month of October 2024.</p>
                </div>
            </div>

            <!-- Report Data Visualization -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">Report Visualization</h5>
                </div>
                <div class="card-body">
                    <canvas id="reportChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Chart Data
        const labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
        const data = {
            labels: labels,
            datasets: [{
                label: 'Sales ($)',
                data: [12000, 15000, 17000, 14000],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Render Chart
        new Chart(document.getElementById('reportChart'), config);
    </script>
</div>


                                          
<?php
    include('../panel/footer.php');
?>