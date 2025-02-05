<?php
    include('../panel/header.php');
    include('../panel/sidebar.php');
    include('../panel/navbar.php');
    // include('../auth/config.php');

    # DELETE BUTTON
    if((isset($_GET['func'])) && ($_GET['func'] == 'delete')){
        $deleteID = $_GET['id'];
        $delete = mysqli_query($database, "DELETE FROM `reports` WHERE `id` = '$deleteID' ");
        
        if($delete){
            $extra = "all_reports.php";
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            $link = "http://$host$uri/$extra";
            $_SESSION['success'] = "You have successfully deleted this report from history.";
            echo "<script>window.location.href='" . $link . "';</script>";
            exit();
        } else {
            echo "<script>alert('Something went wrong. Please try again.'); window.location.href='" . $link . "'; </script>";
        }
    }

    // $reports = mysqli_query($database, "SELECT * FROM `reports` ORDER BY `id` DESC ");

    // Fetch reports with detailed joins and aggregated data
    $reportsQuery = mysqli_query($database, "
        SELECT 
            r.id AS report_id,
            u.first_name AS owner_first_name,
            u.last_name AS owner_last_name,
            u.image AS owner_image,
            reg.name AS region_name,
            sr.frequency,
            sr.created_at,
            (
                SELECT GROUP_CONCAT(DISTINCT CONCAT_WS('|', p.image, p.name) SEPARATOR ',') 
                FROM sales_report_items sri
                JOIN products p ON sri.product_id = p.id
                WHERE sri.sales_report_id = sr.id
            ) AS product_images_with_names,
            (
                SELECT SUM(sri.quantity) 
                FROM sales_report_items sri
                WHERE sri.sales_report_id = sr.id
            ) AS total_quantity,
            (
                SELECT SUM(sri.revenue) 
                FROM sales_report_items sri
                WHERE sri.sales_report_id = sr.id
            ) AS total_revenue
        FROM reports r
        JOIN users u ON r.user_id = u.id
        JOIN sales_reports sr ON r.id = sr.report_id
        JOIN regions reg ON sr.region_id = reg.id
        WHERE r.report_type = 'sales'
        ORDER BY r.created_at DESC
    ");
    
    // Fetch data into an array
    $reports = [];
    while ($row = mysqli_fetch_assoc($reportsQuery)) {
        $reports[] = $row;
    }
    




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
                            <h1>ALL REPORTS</h1>
                            <p>This page displays a list of previously generated custom reports with actions to view or delete.</p>
                        </div>
                        <div>
                            <a href="<?php echo dirname($_SERVER['PHP_SELF']) . '/../reports/create_report.php';?>" class="btn btn-link btn-soft-light">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>                            </svg>
                                Create Report
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
                        <h4 class="card-title">View Sales Reports</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Owner</th>
                                    <th>Region</th>
                                    <th>Frequency</th>
                                    <th>Products</th>
                                    <th>Quantity</th>
                                    <th>Revenue</th>
                                    <th>Created On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id = 1; foreach ($reports as $report) { ?>
                                <tr>
                                    <td><?= $id++; ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="../assets/images/users/<?= htmlspecialchars($report['owner_image']); ?>" 
                                                alt="Owner Image" 
                                                class="rounded-circle" 
                                                style="width: 40px; height: 40px; object-fit: cover;">
                                            <span class="ms-2"><?= htmlspecialchars($report['owner_first_name'] . ' ' . $report['owner_last_name']); ?></span>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($report['region_name']); ?></td>
                                    <td><?= htmlspecialchars($report['frequency']); ?></td>
                                    <td>
                                        <div class="iq-media-group iq-media-group-1">
                                            <?php $productImages = explode(',', $report['product_images_with_names']);
                                            foreach ($productImages as $productData) { 
                                                list($image, $name) = explode('|', $productData); 
                                            ?>
                                            <a href="" class="iq-media-1" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= htmlspecialchars($name); ?>">
                                                <div class="icon iq-icon-box-3 rounded-pill">
                                                    <img src="../assets/images/products/<?= htmlspecialchars($image); ?>" alt="<?= htmlspecialchars($name); ?>" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                                </div>
                                            </a>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td><?= number_format($report['total_quantity']); ?></td>
                                    <td>$<?= number_format($report['total_revenue'], 2); ?></td>
                                    <td><?= (new DateTime($report['created_at']))->format('Y-m-d'); ?></td>
                                    <td>
                                        <a href="view_report.php?id=<?= $report['report_id']; ?>" class="btn btn-sm btn-primary">View</a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $report['report_id']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Owner</th>
                                    <th>Region</th>
                                    <th>Frequency</th>
                                    <th>Products</th>
                                    <th>Quantity</th>
                                    <th>Revenue</th>
                                    <th>Created On</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
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
                    Are you sure you want to delete this report from records?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
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
                window.location.href = `all_reports.php?id=${deleteId}&func=delete`;
            }
        });
    </script>
</div>
                 
                       
<?php
    include('../panel/footer.php');
?>