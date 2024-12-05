<?php
    include('../panel/header.php');
    include('../panel/sidebar.php');
    include('../panel/navbar.php');

    if (isset($_POST['salesReport'])) {
        $userId = $_SESSION['id'];
        $regionId = $_POST['region'];
        $frequency = $_POST['frequency'];
        $description = $_POST['description'];
        $products = $_POST['products'];
        $quantities = $_POST['quantities'];
        $revenues = $_POST['revenues'];
    
        // Insert into reports table
        $insertReport = mysqli_query($database, "
            INSERT INTO `reports` (`user_id`, `report_type`) 
            VALUES ('$userId', 'sales')
        ");
        if (!$insertReport) {
            $_SESSION['error'] = "Failed to create report. Please try again.";
            echo "<script>window.location.href='create_report.php';</script>";
            exit();
        }
    
        $reportId = mysqli_insert_id($database);
    
        // Insert into sales_reports table
        $insertSalesReport = mysqli_query($database, "
            INSERT INTO `sales_reports` (`report_id`, `region_id`, `frequency`, `description`)
            VALUES ('$reportId', '$regionId', '$frequency', '$description')
        ");
        if (!$insertSalesReport) {
            $_SESSION['error'] = "Failed to create sales report. Please try again.";
            echo "<script>window.location.href='create_report.php';</script>";
            exit();
        }
    
        $salesReportId = mysqli_insert_id($database);
    
        // Insert into sales_report_items table
        for ($i = 0; $i < count($products); $i++) {
            $productId = $products[$i];
            $quantity = $quantities[$i];
            $revenue = $revenues[$i];
            $insertItem = mysqli_query($database, "
                INSERT INTO `sales_report_items` (`sales_report_id`, `product_id`, `quantity`, `revenue`)
                VALUES ('$salesReportId', '$productId', '$quantity', '$revenue')
            ");
            if (!$insertItem) {
                $_SESSION['error'] = "Failed to add sales report items. Please try again.";
                echo "<script>window.location.href='create_report.php';</script>";
                exit();
            }
        }
    
        $_SESSION['success'] = "Sales report created successfully.";
        echo "<script>window.location.href='all_reports.php';</script>";
        exit();
    }
    
?>

    <div class="iq-navbar-header" style="height: 215px;">
        <!-- Error Alert -->
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" 
                role="alert" style="z-index: 1050; width: 80%; max-width: 1000px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                <span><b>Error:</b> <?= htmlspecialchars($_SESSION['error']); ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                // Auto-dismiss the alert after 3 seconds
                setTimeout(() => {
                    const alert = document.querySelector('.alert');
                    if (alert) alert.classList.remove('show');
                }, 3000);
            </script>
        <?php unset($_SESSION['error']); } ?>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                                <h4 class="me-2 h4">Report Type</h4>
                                <span> - Select report type</span>
                            </div>
                        </div>
                        <ul class="d-flex nav nav-pills mb-0 text-center profile-tab" data-toggle="slider-tab" id="profile-pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" data-bs-toggle="tab" href="#profile-feed" role="tab" aria-selected="false">Sales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile-activity" role="tab" aria-selected="false">Market Trends</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile-friends" role="tab" aria-selected="false">Customer Insights</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile-profile" role="tab" aria-selected="false">Profile</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="profile-content tab-content">
                <div id="profile-feed" class="tab-pane fade active show">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Add Sales Report</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="create_report.php" method="POST">
                                <!-- Region -->
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="region" class="form-label">Region</label>
                                        <select class="form-select" id="region" name="region" required>
                                            <option selected disabled value="">Choose a region...</option>
                                            <?php 
                                            $regions = mysqli_query($database, "SELECT id, name FROM regions ORDER BY name ASC");
                                            while ($region = mysqli_fetch_assoc($regions)) { ?>
                                                <option value="<?= $region['id']; ?>"><?= htmlspecialchars($region['name']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- Frequency -->
                                    <div class="col-md-6">
                                        <label for="frequency" class="form-label">Frequency</label>
                                        <select class="form-select" id="frequency" name="frequency" required>
                                            <option value="daily">Daily</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Products, Quantities, Revenues -->
                                <div class="row g-3 mt-4" id="productsContainer">
                                    <div class="col-12 g-3 d-flex align-items-center product-row">
                                        <div class="col-lg-4">
                                            <label class="form-label">Product</label>
                                            <select class="form-select product-select" name="products[]" required>
                                                <option selected disabled value="">Choose a product...</option>
                                                <?php 
                                                $products = mysqli_query($database, "SELECT id, name FROM products ORDER BY name ASC");
                                                while ($product = mysqli_fetch_assoc($products)) { ?>
                                                    <option value="<?= $product['id']; ?>"><?= htmlspecialchars($product['name']); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Quantity</label>
                                            <input type="number" class="form-control" name="quantities[]" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Revenue</label>
                                            <input type="number" step="0.01" class="form-control" name="revenues[]" required>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <button type="button" class="btn btn-success add-row-btn mt-4">+</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Description -->
                                <div class="row g-3 mt-4">
                                    <div class="col-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <div class="row g-3 mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary" name="salesReport">Create Report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    const productsContainer = document.getElementById('productsContainer');
                    const addRowButton = document.querySelector('.add-row-btn');

                    addRowButton.addEventListener('click', () => {
                        const productRow = document.querySelector('.product-row').cloneNode(true);
                        productRow.querySelectorAll('input, select').forEach((input) => {
                            input.value = '';
                        });
                        const lastButton = productRow.querySelector('.add-row-btn');
                        lastButton.classList.remove('btn-success');
                        lastButton.classList.add('btn-secondary');
                        lastButton.disabled = true;
                        lastButton.innerHTML = productsContainer.childElementCount;
                        productsContainer.appendChild(productRow);
                    });
                </script>
                <!-- <div id="profile-activity" class="tab-pane fade">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Activity</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="iq-timeline0 m-0 d-flex align-items-center justify-content-between position-relative">
                                <ul class="list-inline p-0 m-0">
                                    <li>
                                        <div class="timeline-dots timeline-dot1 border-primary text-primary"></div>
                                        <h6 class="float-left mb-1 custom-float-left">Client Login</h6>
                                        <small class="float-right mt-1">24 November 2019</small>
                                        <div class="d-inline-block w-100">
                                        <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-dots timeline-dot1 border-success text-success"></div>
                                        <h6 class="float-left mb-1 custom-float-left">Scheduled Maintenance</h6>
                                        <small class="float-right mt-1">23 November 2019</small>
                                        <div class="d-inline-block w-100">
                                        <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-dots timeline-dot1 border-danger text-danger"></div>
                                        <h6 class="float-left mb-1 custom-float-left">Dev Meetup</h6>
                                        <small class="float-right mt-1">20 November 2019</small>
                                        <div class="d-inline-block w-100">
                                        <p>Bonbon macaroon jelly beans <a href="#">gummi bears</a>gummi bears jelly lollipop apple</p>
                                        <div class="iq-media-group iq-media-group-1">
                                            <a href="#" class="iq-media-1">
                                                <div class="icon iq-icon-box-3 rounded-pill">SP</div>
                                            </a>
                                            <a href="#" class="iq-media-1">
                                                <div class="icon iq-icon-box-3 rounded-pill">PP</div>
                                            </a>
                                            <a href="#" class="iq-media-1">
                                                <div class="icon iq-icon-box-3 rounded-pill">MM</div>
                                            </a>
                                        </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-dots timeline-dot1 border-primary text-primary"></div>
                                        <h6 class="float-left mb-1 custom-float-left">Client Call</h6>
                                        <small class="float-right mt-1">19 November 2019</small>
                                        <div class="d-inline-block w-100">
                                        <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-dots timeline-dot1 border-warning text-warning"></div>
                                        <h6 class="float-left mb-1 custom-float-left">Mega event</h6>
                                        <small class="float-right mt-1">15 November 2019</small>
                                        <div class="d-inline-block w-100">
                                        <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div id="profile-friends" class="tab-pane fade">
                    <div class="card">
                        <div class="card-header">
                            <div class="header-title">
                                <h4 class="card-title">Friends</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-inline m-0 p-0">
                                <li class="d-flex mb-4 align-items-center">
                                    <img src="../../assets/images/avatars/01.png" alt="story-img" class="rounded-pill avatar-40">
                                    <div class="ms-3 flex-grow-1">
                                        <h6>Paul Molive</h6>
                                        <p class="mb-0">Web Designer</p>
                                    </div>
                                    <div class="dropdown">
                                        <span class="dropdown-toggle" id="dropdownMenuButton9" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-end custom-dropdown-menu-friends" aria-labelledby="dropdownMenuButton9">
                                        <a class="dropdown-item " href="javascript:void(0);">Unfollow</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Unfriend</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Block</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 align-items-center">
                                    <img src="../../assets/images/avatars/05.png" alt="story-img" class="rounded-pill avatar-40">
                                    <div class="ms-3 flex-grow-1">
                                        <h6>Paul Molive</h6>
                                        <p class="mb-0">trainee</p>
                                    </div>
                                    <div class="dropdown">
                                        <span class="dropdown-toggle" id="dropdownMenuButton10" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-end custom-dropdown-menu-friends" aria-labelledby="dropdownMenuButton10">
                                        <a class="dropdown-item " href="javascript:void(0);">Unfollow</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Unfriend</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Block</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 align-items-center">
                                    <img src="../../assets/images/avatars/02.png" alt="story-img" class="rounded-pill avatar-40">
                                    <div class="ms-3 flex-grow-1">
                                        <h6>Anna Mull</h6>
                                        <p class="mb-0">Web Developer</p>
                                    </div>
                                    <div class="dropdown">
                                        <span class="dropdown-toggle" id="dropdownMenuButton11" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-end custom-dropdown-menu-friends" aria-labelledby="dropdownMenuButton11">
                                        <a class="dropdown-item " href="javascript:void(0);">Unfollow</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Unfriend</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Block</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 align-items-center">
                                    <img src="../../assets/images/avatars/03.png" alt="story-img" class="rounded-pill avatar-40">
                                    <div class="ms-3 flex-grow-1">
                                        <h6>Paige Turner</h6>
                                        <p class="mb-0">trainee</p>
                                    </div>
                                    <div class="dropdown">
                                        <span class="dropdown-toggle" id="dropdownMenuButton12" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-end custom-dropdown-menu-friends" aria-labelledby="dropdownMenuButton12">
                                        <a class="dropdown-item " href="javascript:void(0);">Unfollow</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Unfriend</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Block</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 align-items-center">
                                    <img src="../../assets/images/avatars/04.png" alt="story-img" class="rounded-pill avatar-40">
                                    <div class="ms-3 flex-grow-1">
                                        <h6>Barb Ackue</h6>
                                        <p class="mb-0">Web Designer</p>
                                    </div>
                                    <div class="dropdown">
                                        <span class="dropdown-toggle" id="dropdownMenuButton13" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-end custom-dropdown-menu-friends" aria-labelledby="dropdownMenuButton13">
                                        <a class="dropdown-item " href="javascript:void(0);">Unfollow</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Unfriend</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Block</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 align-items-center">
                                    <img src="../../assets/images/avatars/05.png" alt="story-img" class="rounded-pill avatar-40">
                                    <div class="ms-3 flex-grow-1">
                                        <h6>Greta Life</h6>
                                        <p class="mb-0">Tester</p>
                                    </div>
                                    <div class="dropdown">
                                        <span class="dropdown-toggle" id="dropdownMenuButton14" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-end custom-dropdown-menu-friends" aria-labelledby="dropdownMenuButton14">
                                        <a class="dropdown-item " href="javascript:void(0);">Unfollow</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Unfriend</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Block</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 align-items-center">
                                    <img src="../../assets/images/avatars/03.png" alt="story-img" class="rounded-pill avatar-40">                              <div class="ms-3 flex-grow-1">
                                        <h6>Ira Membrit</h6>
                                        <p class="mb-0">Android Developer</p>
                                    </div>
                                    <div class="dropdown">
                                        <span class="dropdown-toggle" id="dropdownMenuButton15" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-end custom-dropdown-menu-friends" aria-labelledby="dropdownMenuButton15">
                                        <a class="dropdown-item " href="javascript:void(0);">Unfollow</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Unfriend</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Block</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 align-items-center">
                                    <img src="../../assets/images/avatars/02.png" alt="story-img" class="rounded-pill avatar-40">
                                    <div class="ms-3 flex-grow-1">
                                        <h6>Pete Sariya</h6>
                                        <p class="mb-0">Web Designer</p>
                                    </div>
                                    <div class="dropdown">
                                        <span class="dropdown-toggle" id="dropdownMenuButton16" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-end custom-dropdown-menu-friends" aria-labelledby="dropdownMenuButton16">
                                        <a class="dropdown-item " href="javascript:void(0);">Unfollow</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Unfriend</a>
                                        <a class="dropdown-item " href="javascript:void(0);">Block</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <!-- <div id="profile-profile" class="tab-pane fade">
                    <div class="card">
                        <div class="card-header">
                            <div class="header-title">
                                <h4 class="card-title">Profile</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <div class="user-profile">
                                    <img src="../../assets/images/avatars/01.png" alt="profile-img" class="rounded-pill avatar-130 img-fluid">
                                </div>
                                <div class="mt-3">
                                    <h3 class="d-inline-block">Austin Robertson</h3>
                                    <p class="d-inline-block pl-3"> - Web developer</p>
                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="header-title">
                                <h4 class="card-title">About User</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-bio">
                                <p>Tart I love sugar plum I love oat cake. Sweet roll caramels I love jujubes. Topping cake wafer.</p>
                            </div>
                            <div class="mt-2">
                                <h6 class="mb-1">Joined:</h6>
                                <p>Feb 15, 2021</p>
                            </div>
                            <div class="mt-2">
                                <h6 class="mb-1">Lives:</h6>
                                <p>United States of America</p>
                            </div>
                            <div class="mt-2">
                                <h6 class="mb-1">Email:</h6>
                                <p><a href="#" class="text-body"> austin@gmail.com</a></p>
                            </div>
                            <div class="mt-2">
                                <h6 class="mb-1">Url:</h6>
                                <p><a href="#" class="text-body" target="_blank"> www.bootstrap.com </a></p>
                            </div>
                            <div class="mt-2">
                                <h6 class="mb-1">Contact:</h6>
                                <p><a href="#" class="text-body">(001) 4544 565 456</a></p>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <!-- FORM -->
    <!-- <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Create Custom Report</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="generate_report.php" method="POST">
                        <div class="col-md-6">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDate" name="start_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="endDate" name="end_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="reportName" class="form-label">Report Name</label>
                            <input type="text" class="form-control" id="reportName" name="reportName" placeholder="Enter report name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="reportType" class="form-label">Report Type</label>
                            <select class="form-select" id="reportType" name="report_type" required>
                                <option value="Sales">Sales</option>
                                <option value="Customer Insights">Customer Insights</option>
                                <option value="Market Trends">Market Trends</option>
                            </select>
                        </div>
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
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter report description"></textarea>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Generate Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
</div>

<?php
    include('../panel/footer.php');
?>

