<?php
    include('../panel/header.php');
    include('../panel/sidebar.php');
    include('../panel/navbar.php');
    // include('../auth/config.php');

    # DELETE BUTTON
    if((isset($_GET['func'])) && ($_GET['func'] == 'delete')){
        $deleteID = $_GET['id'];
        $delete = mysqli_query($database, "DELETE FROM `scheduled_reports` WHERE `id` = '$deleteID' ");
        
        if($delete){
            $extra = "all_reports.php";
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            $link = "http://$host$uri/$extra";
            $_SESSION['success'] = "You have successfully deleted this schedule from history.";
            header("Location: $link"); 
            exit();
        } else {
            echo "<script>alert('Something went wrong. Please try again.'); window.location.href='" . $link . "'; </script>";
        }
    }

    $scheduled_reports = mysqli_query($database, "SELECT * FROM `scheduled_reports` ORDER BY `id` DESC ");


?>


    <div class="iq-navbar-header" style="height: 215px;">
        <?php if(isset($_SESSION['success'])) { ?>
            <div class="alert alert-left alert-success alert-dismissible fade show mb-3" role="alert">
                <span><b>Weldone!</b> <?= ($_SESSION['success']) ?></span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php unset($_SESSION['success']); } ?>
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-wrap d-flex justify-content-between align-items-center">
                        <div>
                            <h1>SCHEDULED REPORTS</h1>
                            <p>Set up automated report generation (frequency and filters).</p>
                        </div>
                        <div>
                            <a href="#AddSchedule" class="btn btn-link btn-soft-light">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>                            </svg>
                                Add a Schedule
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
    <!-- Scheduled Reports Table -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Scheduled Report History</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Report Name</th>
                                    <th>Frequency</th>
                                    <th>Last Run</th>
                                    <th>Next Run</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id = 1; foreach ($scheduled_reports as $schedule) { ?>
                                <tr>
                                    <td><?= $id++; ?></td>
                                    <td><?= htmlspecialchars($schedule['report_name']); ?></td>
                                    <td><?= $schedule['frequency']; ?></td>
                                    <td><?= (new DateTime($schedule['last_run']))->format('Y-m-d'); ?></td>
                                    <td><?= (new DateTime($schedule['next_run']))->format('Y-m-d'); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewModal" 
                                            data-id="<?= $schedule['id']; ?>" 
                                            data-name="<?= htmlspecialchars($schedule['report_name']); ?>" 
                                            data-frequency="<?= $schedule['frequency']; ?>" 
                                            data-last-run="<?= (new DateTime($schedule['last_run']))->format('Y-m-d'); ?>" 
                                            data-next-run="<?= (new DateTime($schedule['next_run']))->format('Y-m-d'); ?>" 
                                            data-description="<?= $schedule['description']; ?>">View</button>
                                        <!-- <a href="view_schedule.php?id=001" class="btn btn-sm btn-primary">View</a> -->
                                        <button class="btn btn-sm btn-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal" 
                                            data-id="<?= $schedule['id']; ?>" 
                                            data-name="<?= htmlspecialchars($schedule['report_name']); ?>" 
                                            data-frequency="<?= $schedule['frequency']; ?>" 
                                            data-last-run="<?= (new DateTime($schedule['last_run']))->format('Y-m-d'); ?>" 
                                            data-next-run="<?= (new DateTime($schedule['next_run']))->format('Y-m-d'); ?>" 
                                            data-description="<?= htmlspecialchars($schedule['description']); ?>">Edit</button>
                                        <button class="btn btn-sm btn-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal" 
                                            data-id="<?= $schedule['id']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Report Name</th>
                                    <th>Frequency</th>
                                    <th>Last Run</th>
                                    <th>Next Run</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Schedule Modal (Lightbox) -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Schedule ID:</strong> <span id="viewScheduleId"></span></p>
                    <p><strong>Report Name:</strong> <span id="viewReportName"></span></p>
                    <p><strong>Frequency:</strong> <span id="viewFrequency"></span></p>
                    <p><strong>Last Run:</strong> <span id="viewLastRun"></span></p>
                    <p><strong>Next Run:</strong> <span id="viewNextRun"></span></p>
                    <p><strong>Description:</strong> <span id="viewDescription"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Schedule Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editScheduleForm" action="edit_schedule.php" method="POST">
                    <div class="modal-body">
                        <!-- Schedule ID (Hidden Field) -->
                        <input type="hidden" id="editScheduleId" name="schedule_id">
                        
                        <!-- Report Name -->
                        <div class="mb-3">
                            <label for="editReportName" class="form-label">Report Name</label>
                            <input type="text" class="form-control" id="editReportName" name="report_name" required>
                        </div>
                        
                        <!-- Frequency -->
                        <div class="mb-3">
                            <label for="editFrequency" class="form-label">Frequency</label>
                            <select class="form-select" id="editFrequency" name="frequency" required>
                                <option value="Daily">Daily</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Monthly">Monthly</option>
                            </select>
                        </div>
                        
                        <!-- Last Run -->
                        <div class="mb-3">
                            <label for="editLastRun" class="form-label">Last Run</label>
                            <input type="date" class="form-control" id="editLastRun" name="last_run" readonly>
                        </div>
                        
                        <!-- Next Run -->
                        <div class="mb-3">
                            <label for="editNextRun" class="form-label">Next Run</label>
                            <input type="date" class="form-control" id="editNextRun" name="next_run" required>
                        </div>
                        
                        <!-- Description -->
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3" placeholder="Provide details about this schedule"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
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
                    Are you sure you want to delete this schedule?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Handle View Button
        const viewModal = document.getElementById('viewModal');
        viewModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            // Extract data attributes
            const scheduleId = button.getAttribute('data-id');
            const reportName = button.getAttribute('data-name');
            const frequency = button.getAttribute('data-frequency');
            const lastRun = button.getAttribute('data-last-run');
            const nextRun = button.getAttribute('data-next-run');
            const description = button.getAttribute('data-description');

            // Populate View Modal fields
            document.getElementById('viewScheduleId').textContent = scheduleId;
            document.getElementById('viewReportName').textContent = reportName;
            document.getElementById('viewFrequency').textContent = frequency;
            document.getElementById('viewLastRun').textContent = lastRun;
            document.getElementById('viewNextRun').textContent = nextRun;
            document.getElementById('viewDescription').textContent = description;
        });

        // Handle Edit Button
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            // Extract data attributes
            const scheduleId = button.getAttribute('data-id');
            const reportName = button.getAttribute('data-name');
            const frequency = button.getAttribute('data-frequency');
            const lastRun = button.getAttribute('data-last-run');
            const nextRun = button.getAttribute('data-next-run');
            const description = button.getAttribute('data-description');

            // Populate Edit Modal fields
            document.getElementById('editScheduleId').value = scheduleId;
            document.getElementById('editReportName').value = reportName;
            document.getElementById('editLastRun').value = lastRun;
            document.getElementById('editNextRun').value = nextRun;
            document.getElementById('editDescription').value = description;

            // Set dropdown selection
            const frequencyDropdown = document.getElementById('editFrequency');
            for (const option of frequencyDropdown.options) {
                option.selected = option.value === frequency;
            }
        });

        // Handle Delete Button
        const deleteModal = document.getElementById('deleteModal');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        let deleteId = null;

        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            deleteId = button.getAttribute('data-id');
        });

        confirmDeleteButton.addEventListener('click', function () {
            if (deleteId) {
                window.location.href = `delete_schedule.php?id=${deleteId}`;
            }
        });

    </script>

    <!-- FORM -->
    <div class="row" id="AddSchedule">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Schedule a Report</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Schedule Report Form -->
                    <form class="row g-3" action="schedule_report.php" method="POST">
                        <!-- Report Name -->
                        <div class="mb-3 col-md-6">
                            <label for="reportName" class="form-label">Report Name</label>
                            <input type="text" class="form-control" id="reportName" name="report_name" placeholder="Enter report name" required>
                        </div>
                        <!-- Frequency -->
                        <div class="mb-3 col-md-6">
                            <label for="frequency" class="form-label">Frequency</label>
                            <select class="form-select" id="frequency" name="frequency" required>
                                <option value="" selected disabled>Select frequency...</option>
                                <option value="Daily">Daily</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Monthly">Monthly</option>
                            </select>
                        </div>
                        <!-- Start Date -->
                        <div class="mb-3 col-md-6">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDate" name="start_date" required>
                        </div>
                        <!-- Report Type -->
                        <div class="mb-3 col-md-6">
                            <label for="reportType" class="form-label">Report Type</label>
                            <select class="form-select" id="reportType" name="report_type" required>
                                <option value="" selected disabled>Select report type...</option>
                                <option value="Sales">Sales</option>
                                <option value="Market Trends">Market Trends</option>
                                <option value="Customer Insights">Customer Insights</option>
                            </select>
                        </div>
                        <!-- Optional Filters: Region -->
                        <div class="mb-3 col-md-6">
                            <label for="region" class="form-label">Region (Optional)</label>
                            <select class="form-select" id="region" name="region">
                                <option value="" selected disabled>Select region...</option>
                                <option value="North">North</option>
                                <option value="South">South</option>
                                <option value="East">East</option>
                                <option value="West">West</option>
                            </select>
                        </div>
                        <!-- Description -->
                        <div class="mb-3 col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Provide additional details about the report"></textarea>
                        </div>
                        <!-- Submit Button -->
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Save Schedule</button>
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