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
                            <h1>MARKET TRENDS</h1>
                            <p>This Page visualizes market trends performance over time.</p>
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
                        <h4 class="card-title">Market Trends</h4>
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
                            <input type="text" id="dateRange" name="dateRange" class="form-control range_flatpicker" placeholder="Range Date Picker">
                        </div>
                    </form>

                    <!-- Chart Placeholder -->
                    <div class="card">
                        <div class="card-body">
                            <!-- <h5 class="card-title">Sales Trend Chart</h5>
                            <div id="salesTrendChart" style="height: 400px; background: #f7f7f7; text-align: center; line-height: 400px;">
                                Chart will load here...
                            </div> -->
                            <canvas id="marketTrendsChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- DATATABLE -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Competitors</h4>
                    </div>
                </div>
                <div class="card-body">
                    <p>A table showing competitor details and market share.</p>
                    <div class="custom-datatable-entries">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Competitor Name</th>
                                    <th>Market Share (%)</th>
                                    <th>Revenue ($)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded img-fluid avatar-40 me-3 bg-primary-subtle"
                                                src="../assets/images/shapes/01.png" alt="profile">
                                            <h6>PepsiCo</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-2 d-flex align-items-center">
                                            <h6>35%</h6>
                                        </div>
                                        <div class="shadow-none progress bg-primary-subtle w-100" style="height: 4px">
                                            <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>1.2B</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded img-fluid avatar-40 me-3 bg-primary-subtle"
                                                src="../assets/images/shapes/02.png" alt="profile">
                                            <h6>Nigerian Breweries</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-2 d-flex align-items-center">
                                            <h6>15%</h6>
                                        </div>
                                        <div class="shadow-none progress bg-primary-subtle w-100" style="height: 4px">
                                            <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>600M</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded img-fluid avatar-40 me-3 bg-primary-subtle"
                                                src="../assets/images/shapes/03.png" alt="profile">
                                            <h6>Guinness Nigeria Plc</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-2 d-flex align-items-center">
                                            <h6>10%</h6>
                                        </div>
                                        <div class="shadow-none progress bg-primary-subtle w-100" style="height: 4px">
                                            <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>400M</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Competitor Name</th>
                                    <th>Market Share (%)</th>
                                    <th>Revenue ($)</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="mt-3 flex-wrap card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Visual comparison</h4>            
                    </div>
                    <div class="dropdown">
                        <a href="#" class="text-gray dropdown-toggle" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                            This Week
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end custom-dropdown-menu-end" aria-labelledby="dropdownMenuButton3">
                            <li><a class="dropdown-item" href="#">This Week</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="competitorsChart" width="400" height="200"></canvas>
                    <!-- <div id="d-activity" class="d-activity"></div> -->
                </div>
            </div>

        </div>
    </div>
</div>

<!-- CHART.js -->
<script>
    // Data for Market Trends Analytics (Line Chart)
    const marketTrendsLabels = ['January', 'February', 'March', 'April', 'May'];
    const marketTrendsData = {
        labels: marketTrendsLabels,
        datasets: [
            {
                label: 'Revenue ($)',
                data: [12000, 15000, 18000, 20000, 24000],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Sales Volume (Units)',
                data: [300, 400, 350, 450, 500],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }
        ]
    };

    const marketTrendsConfig = {
        type: 'line',
        data: marketTrendsData,
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

    // Render Market Trends Chart
    new Chart(document.getElementById('marketTrendsChart'), marketTrendsConfig);

    // Data for Competitors Visual Comparison (Bar Chart)
    const competitorsLabels = ['January', 'February', 'March', 'April', 'May'];
    const competitorsData = {
        labels: competitorsLabels,
        datasets: [
            {
                label: 'PepsiCo ($)',
                data: [3500, 4000, 4200, 4700, 5000],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            {
                label: 'Nigerian Breweries ($)',
                data: [3000, 3200, 3300, 3700, 3900],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            },
            {
                label: 'Guinness Nigeria Plc ($)',
                data: [2700, 2900, 3000, 3100, 3500],
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }
        ]
    };

    const competitorsConfig = {
        type: 'bar',
        data: competitorsData,
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

    // Render Competitors Chart
    new Chart(document.getElementById('competitorsChart'), competitorsConfig);
</script>

<?php
    include('../panel/footer.php');
?>