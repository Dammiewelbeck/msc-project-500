<?php
    include('../panel/header.php');
    include('../panel/sidebar.php');
    include('../panel/navbar.php');
    // include('../auth/config.php');

    # DELETE BUTTON
    if((isset($_GET['func'])) && ($_GET['func'] == 'delete')){
        $deleteID = $_GET['id'];
        $delete = mysqli_query($database, "DELETE FROM `sales` WHERE `id` = '$deleteID' ");
        
        if($delete){
            $extra = "all_sales.php";
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            $link = "http://$host$uri/$extra";
            $_SESSION['success'] = "You have deleted this sales record successfully.";
            echo "<script>window.location.href='" . $link . "';</script>";
            exit();
        } else {
            echo "<script>alert('Something went wrong. Please try again.'); window.location.href='" . $link . "'; </script>";
        }
    }

    # ADD BUTTON
    if (isset($_POST['submit'])) {
        $productID = $_POST['productName']; 
        $regionID = $_POST['region'];      
        $quantity = $_POST['quantity'];
        $revenue = $_POST['revenue'];
        $date = date("Y-m-d");   
    
        $insert = mysqli_query($database, "
            INSERT INTO `sales` (`product_id`, `region_id`, `quantity`, `revenue`, `date`) 
            VALUES ('$productID', '$regionID', '$quantity', '$revenue', '$date')
        ");
    
        if ($insert) {
            $extra = "all_sales.php";
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $link = "http://$host$uri/$extra";
            $_SESSION['success'] = "You've successfully added a new sale.";
            echo "<script>window.location.href='" . $link . "';</script>";
            exit();
        } else {
            $_SESSION['error'] = "Failed to add the sale. Please try again.";
            echo "<script>window.location.href='all_sales.php';</script>";
            exit();
        }
    }

    # UPDATE BUTTON
    if (isset($_POST['update'])) {
        // Fetch data from the form
        $saleID = $_POST['sale_id']; // Hidden field for the Sale ID
        $productID = $_POST['product_name']; // Selected product ID
        $regionID = $_POST['region']; // Selected region ID
        $quantity = $_POST['quantity']; // Updated quantity
        $revenue = $_POST['revenue']; // Updated revenue

        // Perform the update query
        $update = mysqli_query($database, "
            UPDATE `sales`
            SET
                `product_id` = '$productID',
                `region_id` = '$regionID',
                `quantity` = '$quantity',
                `revenue` = '$revenue'
            WHERE `id` = '$saleID'
        ");

        // Check if the update was successful
        if ($update) {
            $extra = "all_sales.php";
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $link = "http://$host$uri/$extra";
            $_SESSION['success'] = "You've successfully updated the sale.";
            echo "<script>window.location.href='" . $link . "';</script>";
            exit();
        } else {
            $_SESSION['error'] = "Failed to update the sale. Please try again.";
            echo "<script>window.location.href='all_sales.php';</script>";
            exit();
        }
    }
   
    # READ
    $sales = mysqli_query($database, "
        SELECT 
            sales.id AS sale_id,
            products.image AS product_image,
            products.name AS product_name,
            regions.name AS region_name,
            sales.quantity,
            sales.revenue,
            sales.date
        FROM 
            sales
        JOIN 
            products ON sales.product_id = products.id
        JOIN 
            regions ON sales.region_id = regions.id
        ORDER BY 
            sales.id DESC
    ");
    // Fetch products and regions for the dropdowns
    $products = mysqli_query($database, "SELECT id, name FROM products ORDER BY name ASC");
    $regions = mysqli_query($database, "SELECT id, name FROM regions ORDER BY name ASC");



?>


    <div class="iq-navbar-header" style="height: 215px;">
        <!-- Success Alert -->
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" 
                role="alert" style="z-index: 1050; width: 80%; max-width: 1000px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                <span><b>Success!</b> <?= htmlspecialchars($_SESSION['success']); ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                // Auto-dismiss the alert after 5 seconds
                setTimeout(() => {
                    const alert = document.querySelector('.alert');
                    if (alert) alert.classList.remove('show');
                }, 5000);
            </script>
        <?php unset($_SESSION['success']); } ?>
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
                            <h1>ALL SALES</h1>
                            <p>This page displays a list of all sales transactions with search and filter options.</p>
                        </div>
                        <div>
                            <a href="#AddSale" class="btn btn-link btn-soft-light">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>                            </svg>
                                Add Sale
                            </a>
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
    <!-- DATATABLE -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">All Sales</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Transaction ID</th>
                                    <th>Product Name</th>
                                    <th>Region</th>
                                    <th>Quantity</th>
                                    <th>Revenue ($)</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id = 1; $pic = 1; foreach ($sales as $sale) { ?>
                                <tr>
                                    <td><?= $id++; ?></td>
                                    <td><?= $sale['sale_id']; ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                        <!-- <img src="<?php //echo $sale['product_image']; ?>" alt="product" class="rounded img-fluid avatar-40 me-3"> -->
                                            <img src="../assets/images/products/<?= $sale['product_image']; ?>" alt="product" class="rounded img-fluid avatar-40 me-3 bg-primary-subtle">
                                            <h6><?= $sale['product_name']; ?></h6>
                                        </div>
                                    </td>
                                    <td><?= $sale['region_name']; ?></td>
                                    <td><?= $sale['quantity']; ?></td>
                                    <td>$<?= $sale['revenue']; ?></td>
                                    <td><?= $sale['date']; ?></td>
                                    <td>
                                        <button 
                                            class="btn btn-sm btn-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editSaleModal" 
                                            data-id="<?= $sale['sale_id']; ?>" 
                                            data-product="<?= $sale['product_name']; ?>" 
                                            data-region="<?= $sale['region_name']; ?>" 
                                            data-quantity="<?= $sale['quantity']; ?>" 
                                            data-revenue="<?= $sale['revenue']; ?>" 
                                            data-date="<?= $sale['date']; ?>">
                                            Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $sale['sale_id']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Transaction ID</th>
                                    <th>Product Name</th>
                                    <th>Region</th>
                                    <th>Quantity</th>
                                    <th>Revenue ($)</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editSaleModal" tabindex="-1" aria-labelledby="editSaleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSaleModalLabel">Edit Sale</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editSaleForm" action="all_sales.php" method="POST">
                    <div class="modal-body">
                        <!-- Sale ID (Hidden Field) -->
                        <input type="hidden" id="saleId" name="sale_id">
                        <!-- Product Name -->
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Product Name</label>
                            <select class="form-select" id="editProductName" name="product_name" required>
                                <option selected disabled value="">Choose a product...</option>
                                <?php foreach ($products as $product) { ?>
                                    <option value="<?= $product['id']; ?>"><?= htmlspecialchars($product['name']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- Region -->
                        <div class="mb-3">
                            <label for="editRegion" class="form-label">Region</label>
                            <select class="form-select" id="editRegion" name="region" required>
                                <option selected disabled value="">Choose a region...</option>
                                <?php foreach ($regions as $region) { ?>
                                    <option value="<?= $region['id']; ?>"><?= htmlspecialchars($region['name']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="editQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="editQuantity" name="quantity" required>
                        </div>
                        <!-- Revenue -->
                        <div class="mb-3">
                            <label for="editRevenue" class="form-label">Revenue ($)</label>
                            <input type="number" class="form-control" id="editRevenue" name="revenue" step="0.01" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this sale transaction?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Edit Modal
        const editSaleModal = document.getElementById('editSaleModal');
        editSaleModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            // Extract data attributes from the clicked button
            const saleId = button.getAttribute('data-id');
            const productName = button.getAttribute('data-product');
            const regionName = button.getAttribute('data-region');
            const quantity = button.getAttribute('data-quantity');
            const revenue = button.getAttribute('data-revenue');

            // Populate modal fields
            document.getElementById('saleId').value = saleId;

            // Set selected product
            const productDropdown = document.getElementById('editProductName');
            for (const option of productDropdown.options) {
                option.selected = option.text === productName;
            }

            // Set selected region
            const regionDropdown = document.getElementById('editRegion');
            for (const option of regionDropdown.options) {
                option.selected = option.text === regionName;
            }

            document.getElementById('editQuantity').value = quantity;
            document.getElementById('editRevenue').value = revenue;
        });

        // Handle Delete Button
        const deleteModal = document.getElementById('deleteModal');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        let deleteId = null;

        // Set transaction ID to be deleted when the modal opens
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            deleteId = button.getAttribute('data-id'); // Extract transaction ID from data-id
        });

        // Handle confirmation button click
        confirmDeleteButton.addEventListener('click', function () {
            if (deleteId) {
                // Perform the delete operation (example: redirect to a PHP delete script)
                window.location.href = `all_sales.php?id=${deleteId}&func=delete`;
            }
        });
    </script>

    <!-- FORM -->
    <div class="row" id="AddSale">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Add a New Sale</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Add Sale Form -->
                    <form class="row g-3" action="all_sales.php" method="POST">
                        <!-- Product Name -->
                        <div class="col-md-6">
                            <label for="productName" class="form-label">Product Name</label>
                            <select class="form-select" id="productName" name="productName" required>
                                <option selected disabled value="">Choose a product...</option>
                                <?php foreach ($products as $product) { ?>
                                    <option value="<?= $product['id']; ?>"><?= htmlspecialchars($product['name']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- Region -->
                        <div class="col-md-6">
                            <label for="region" class="form-label">Region</label>
                            <select class="form-select" id="region" name="region" required>
                                <option selected disabled value="">Choose a region...</option>
                                <?php foreach ($regions as $region) { ?>
                                    <option value="<?= $region['id']; ?>"><?= htmlspecialchars($region['name']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- Quantity -->
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity" required>
                        </div>
                        <!-- Revenue -->
                        <div class="col-md-6">
                            <label for="revenue" class="form-label">Revenue ($)</label>
                            <input type="number" class="form-control" id="revenue" name="revenue" placeholder="Enter revenue" step="0.01" required>
                        </div>
                        <!-- Submit and Reset Buttons -->
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary">Add Sale</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
                 
                       
<?php
    include('../panel/footer.php');
?>