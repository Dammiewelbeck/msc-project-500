<?php
    include('../panel/header.php');
    include('../panel/sidebar.php');
    include('../panel/navbar.php');
    // include('../auth/config.php');

    # DELETE BUTTON
    if ((isset($_GET['func'])) && ($_GET['func'] == 'delete')) {
        $deleteID = $_GET['id'];
        $delete = mysqli_query($database, "DELETE FROM `regions` WHERE `id` = '$deleteID'");

        if ($delete) {
            $extra = "all_regions.php";
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $link = "http://$host$uri/$extra";
            $_SESSION['success'] = "You have deleted this region successfully.";
            echo "<script>window.location.href='" . $link . "';</script>";
            exit();
        } else {
            $_SESSION['error'] = "Failed to delete the region. Please try again.";
            echo "<script>window.location.href='all_regions.php';</script>";
            exit();
        }
    }

    # ADD BUTTON
    if (isset($_POST['submit'])) {
        $regionName = $_POST['region_name'];
        $parentRegion = $_POST['parent_region'] ?? null;

        $insert = mysqli_query($database, "
            INSERT INTO `regions` (`name`, `parent`) 
            VALUES ('$regionName', '$parentRegion')
        ");

        if ($insert) {
            $_SESSION['success'] = "You've successfully added a new region.";
            echo "<script>window.location.href='all_regions.php';</script>";
            exit();
        } else {
            $_SESSION['error'] = "Failed to add the region. Please try again.";
            echo "<script>window.location.href='all_regions.php';</script>";
            exit();
        }
    }

    # UPDATE BUTTON
    if (isset($_POST['update'])) {
        $regionID = $_POST['region_id'];
        $regionName = $_POST['region_name'];
        $parentRegion = $_POST['parent_region'] ?? null;

        $update = mysqli_query($database, "
            UPDATE `regions`
            SET
                `name` = '$regionName',
                `parent` = '$parentRegion'
            WHERE `id` = '$regionID'
        ");

        if ($update) {
            $_SESSION['success'] = "You've successfully updated the region.";
            echo "<script>window.location.href='all_regions.php';</script>";
            exit();
        } else {
            $_SESSION['error'] = "Failed to update the region. Please try again.";
            echo "<script>window.location.href='all_regions.php';</script>";
            exit();
        }
    }

    # READ
    $regions = mysqli_query($database, "SELECT * FROM `regions` ORDER BY `id` DESC");
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
                            <h1>ALL REGIONS</h1>
                            <p>This page displays a list of all regions where products are being distributed.</p>
                        </div>
                        <div>
                            <a href="#AddRegion" class="btn btn-link btn-soft-light">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>                            </svg>
                                Add Region
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
                        <h4 class="card-title">All Regions</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Region Name</th>
                                    <th>Parent Region</th>
                                    <th>Date Added</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id = 1; foreach ($regions as $region) { ?>
                                <tr>
                                    <td><?= $id++; ?></td>
                                    <td><?= htmlspecialchars($region['name']); ?></td>
                                    <td><?= $region['parent'] ? htmlspecialchars($region['parent']) : 'None'; ?></td>
                                    <td><?= (new DateTime($region['created_at']))->format('Y-m-d'); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal" 
                                            data-id="<?= $region['id']; ?>" 
                                            data-name="<?= htmlspecialchars($region['name']); ?>" 
                                            data-parent="<?= $region['parent']; ?>">Edit</button>
                                        <button class="btn btn-sm btn-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal" 
                                            data-id="<?= $region['id']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Region Name</th>
                                    <th>Parent Region</th>
                                    <th>Date Added</th>
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
                    Are you sure you want to delete this region?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Region Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Region Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editRegionForm" action="all_regions.php" method="POST">
                    <div class="modal-body">
                        <!-- Region ID (Hidden Field) -->
                        <input type="hidden" id="regionId" name="region_id" value="">
                        <!-- Region Name -->
                        <div class="mb-3">
                            <label for="regionName" class="form-label">Region Name</label>
                            <input type="text" class="form-control" id="regionName" name="region_name" required>
                        </div>
                        <!-- Parent Region -->
                        <div class="mb-3">
                            <label for="parentRegion" class="form-label">Parent Region (Optional)</label>
                            <select class="form-select" id="parentRegion" name="parent_region">
                                <option value="">Select parent region...</option>
                                <option value="North">North</option>
                                <option value="North-East">North-East</option>
                                <option value="North-West">North-West</option>
                                <option value="South">South</option>
                                <option value="South-East">South-East</option>
                                <option value="South-West">South-West</option>
                                <option value="East">East</option>
                                <option value="West">West</option>
                                <option value="Central">Central</option>
                            </select>
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

    <script>
        // Handle Delete Button
        const deleteModal = document.getElementById('deleteModal');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        let deleteId = null;

        // Set region ID to be deleted when the modal opens
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            deleteId = button.getAttribute('data-id'); // Extract region ID from data-id
        });

        // Handle confirmation button click
        confirmDeleteButton.addEventListener('click', function () {
            if (deleteId) {
                // Redirect to delete script
                window.location.href = `all_regions.php?id=${deleteId}&func=delete`;
            }
        });

        // Handle Edit Button
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const regionId = button.getAttribute('data-id'); // Extract region ID
            const regionName = button.getAttribute('data-name'); // Extract region name
            const parentRegion = button.getAttribute('data-parent'); // Extract parent region

            // Populate the modal fields with the extracted data
            document.getElementById('regionId').value = regionId;
            document.getElementById('regionName').value = regionName;
            document.getElementById('parentRegion').value = parentRegion || ""; // Default to empty if no parent
        });
    </script>

    <!-- FORM -->
    <div class="row" id="AddRegion">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Add a New Region</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Add Region Form -->
                    <form class="row g-3" action="all_regions.php" method="POST">
                        <!-- Region Name -->
                        <div class="mb-3 col-md-6">
                            <label for="regionName" class="form-label">Region Name</label>
                            <input type="text" class="form-control" id="regionName" name="region_name" placeholder="Enter region name" required>
                        </div>
                        <!-- Parent Region (Optional) -->
                        <div class="mb-3 col-md-6">
                            <label for="parentRegion" class="form-label">Parent Region (Optional)</label>
                            <select class="form-select" id="parentRegion" name="parent_region">
                                <option value="" selected disabled>Select parent region...</option>
                                <option value="North">North</option>
                                <option value="North-East">North-East</option>
                                <option value="North-West">North-West</option>
                                <option value="South">South</option>
                                <option value="South-East">South-East</option>
                                <option value="South-West">South-West</option>
                                <option value="East">East</option>
                                <option value="West">West</option>
                                <option value="Central">Central</option>
                            </select>
                        </div>
                        <!-- Submit Button -->
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" name="submit" class="btn btn-primary">Add Region</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MAP -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Region Map</h4>
                    </div>
                </div>
                <div class="card-body">
                    <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3963.2600903898515!2d3.352007075785715!3d6.614573322096629!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMzYnNTIuNCJOIDPCsDIxJzE2LjUiRQ!5e0!3m2!1sen!2sng!4v1733000984162!5m2!1sen!2sng" height="500" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

                                             
<?php
    include('../panel/footer.php');
?>