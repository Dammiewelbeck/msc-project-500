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
                            <h1>CREATE REPORT</h1>
                            <p>Generate and save report with filters for date, product, region, etc.</p>
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
    <!-- FORM -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Create Custom Report</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Create Form -->
                    <form class="row g-3" action="generate_report.php" method="POST">
                        <!-- Date Range -->
                            <div class="col-md-6">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="startDate" name="start_date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="endDate" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="endDate" name="end_date" required>
                            </div>
                        <!-- Product Name -->
                        <div class="col-md-6">
                            <label for="reportName" class="form-label">Report Name</label>
                            <input type="text" class="form-control" id="reportName" name="reportName" placeholder="Enter report name" required>
                        </div>
                        <!-- Report Type -->
                        <div class="col-md-6">
                            <label for="reportType" class="form-label">Report Type</label>
                            <select class="form-select" id="reportType" name="report_type" required>
                                <option value="Sales">Sales</option>
                                <option value="Customer Insights">Customer Insights</option>
                                <option value="Market Trends">Market Trends</option>
                            </select>
                        </div>
                        <!-- Filters -->
                            <div class="col-md-6">
                                <label for="productFilter" class="form-label">Product</label>
                                <select class="form-select" id="productFilter" name="product">
                                    <option value="">All Products</option>
                                    <option value="Coca-Cola Classic">Coca-Cola Classic</option>
                                    <option value="Coca-Cola Zero Sugar">Coca-Cola Zero Sugar</option>
                                    <option value="Diet Coke">Diet Coke</option>
                                    <option value="Fanta Orange">Fanta Orange</option>
                                    <option value="Minute Maid Juice">Minute Maid Juice</option>
                                    <option value="Sprite">Sprite</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="regionFilter" class="form-label">Region</label>
                                <select class="form-select" id="regionFilter" name="region">
                                    <option value="">All Regions</option>
                                    <option value="Abuja">Abuja</option>
                                    <option value="Edo">Edo</option>
                                    <option value="Kano">Kano</option>
                                    <option value="Lagos">Lagos</option>
                                    <option value="Oyo">Oyo</option>
                                </select>
                            </div>
                        <!-- Description -->
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter report description"></textarea>
                        </div>
                        <!-- Submit -->
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Generate Report</button>
                        </div>


                        <!-- Product Name -->
                        <!-- <div class="col-md-6">
                            <label for="productName" class="form-label">Product Name</label>
                            <select class="form-select" id="productName" name="product_name" required>
                                <option selected disabled value="">Choose a product...</option>
                                <option value="Coca-Cola Classic">Coca-Cola Classic</option>
                                <option value="Coca-Cola Zero Sugar">Coca-Cola Zero Sugar</option>
                                <option value="Diet Coke">Diet Coke</option>
                                <option value="Fanta Orange">Fanta Orange</option>
                                <option value="Minute Maid Juice">Minute Maid Juice</option>
                                <option value="Sprite">Sprite</option>
                            </select>
                        </div> -->
                        <!-- Region -->
                        <!-- <div class="col-md-6">
                            <label for="region" class="form-label">Region</label>
                            <select class="form-select" id="region" name="region" required>
                                <option selected disabled value="">Choose a region...</option>
                                <option value="Abuja">Abuja</option>
                                <option value="Edo">Edo</option>
                                <option value="Kano">Kano</option>
                                <option value="Lagos">Lagos</option>
                                <option value="Oyo">Oyo</option>
                            </select>
                        </div> -->
                        <!-- Quantity -->
                        <!-- <div class="col-md-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity" required>
                        </div> -->
                        <!-- Revenue -->
                        <!-- <div class="col-md-6">
                            <label for="revenue" class="form-label">Revenue ($)</label>
                            <input type="number" class="form-control" id="revenue" name="revenue" placeholder="Enter revenue" step="0.01" required>
                        </div> -->
                        <!-- Submit and Reset Buttons -->
                        <!-- <div class="col-12">
                            <button type="submit" class="btn btn-primary">Add Sale</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include('../panel/footer.php');
?>

