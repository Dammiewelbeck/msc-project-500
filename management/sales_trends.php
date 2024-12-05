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
                            <h1>SALES TRENDS</h1>
                            <p>This Page visualizes sales performance over time.</p>
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
    <!-- CARD -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Sales Trends</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filters -->
                    <form class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="productFilter" class="form-label">Product</label>
                            <select class="form-select" id="productFilter">
                                <option value="" selected>All Products</option>
                                <option value="Coca-Cola Classic">Coca-Cola Classic</option>
                                <option value="Coca-Cola Zero Sugar">Coca-Cola Zero Sugar</option>
                                <option value="Diet Coke">Diet Coke</option>
                                <option value="Fanta Orange">Fanta Orange</option>
                                <option value="Minute Maid Juice">Minute Maid Juice</option>
                                <option value="Sprite">Sprite</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="regionFilter" class="form-label">Region</label>
                            <select class="form-select" id="regionFilter">
                                <option value="" selected>All Regions</option>
                                <option value="Abuja">Abuja</option>
                                <option value="Edo">Edo</option>
                                <option value="Kano">Kano</option>
                                <option value="Lagos">Lagos</option>
                                <option value="Oyo">Oyo</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="dateRange" class="form-label">Date Range</label>
                            <input type="date" class="form-control" id="dateRange">
                        </div>
                    </form>

                    <!-- Chart Placeholder -->
                    <div class="card">
                        <div class="card-body">
                            <!-- <div id="salesTrendChart" style="height: 400px; background: #f7f7f7; text-align: center; line-height: 400px;">
                                Chart will load here...
                            </div> -->
                            <canvas id="chartjsSalesTrend" width="400" height="200"></canvas>
                        </div>
                    </div>

                    <!-- <div class="card" data-aos="fade-up" data-aos-delay="800">
                        <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                            <div class="header-title">
                                <h4 class="card-title">$855.8K</h4>
                                <p class="mb-0">Gross Income</p>          
                            </div>
                            <div class="d-flex align-items-center align-self-center">
                                <div class="d-flex align-items-center text-primary">
                                    <svg class="icon-12" xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                                    <g>
                                        <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                    </g>
                                    </svg>
                                    <div class="ms-2">
                                    <span class="text-gray">Sales</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center ms-3 text-info">
                                    <svg class="icon-12" xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                                    <g>
                                        <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                    </g>
                                    </svg>
                                    <div class="ms-2">
                                    <span class="text-gray">Income</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="text-gray dropdown-toggle" id="dropdownMenuButton22" data-bs-toggle="dropdown" aria-expanded="false">
                                This Week
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end custom-dropdown-menu-end" aria-labelledby="dropdownMenuButton22">
                                    <li><a class="dropdown-item" href="#">This Week</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="d-main" class="d-main"></div>
                        </div>
                    </div> -->
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Data for the chart
    const labels = ['January', 'February', 'March', 'April', 'May'];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Sales ($)',
            data: [1200, 1900, 3000, 5000, 2500],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    // Chart Configuration
    const config = {
        type: 'line', // Change to 'bar' or 'pie' for different types
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
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
    const chartCanvas = document.getElementById('chartjsSalesTrend');
    new Chart(chartCanvas, config);
</script>

<?php
    include('../panel/footer.php');
?>