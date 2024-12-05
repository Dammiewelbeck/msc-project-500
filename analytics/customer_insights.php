<?php
    include('../panel/header.php');
    include('../panel/sidebar.php');
    include('../panel/navbar.php');
    // include('../auth/config.php');

    # DELETE BUTTON
    if((isset($_GET['func'])) && ($_GET['func'] == 'delete')){
        $deleteID = $_GET['id'];
        $delete = mysqli_query($database, "DELETE FROM `customers` WHERE `id` = '$deleteID' ");
        
        if($delete){
            $extra = "customer_insights.php";
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            $link = "http://$host$uri/$extra";
            $_SESSION['success'] = "You have deleted the customer records successfully.";
            echo "<script>window.location.href='" . $link . "';</script>";
            exit();
        } else {
            echo "<script>alert('Something went wrong. Please try again.'); window.location.href='" . $link . "'; </script>";
        }
    }

    $customers = mysqli_query($database, "SELECT * FROM `customers` ORDER BY `id` DESC ");
 
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
                            <h1>CUSTOMER INSIGHTS</h1>
                            <p>This page displays a list of all customer records with edit and delete options.</p>
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
                        <h4 class="card-title">All Customers</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Ratings</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id = 1; foreach ($customers as $customer) { ?>
                                <tr>
                                    <td><?= $id++; ?></td>
                                    <td><?= htmlspecialchars($customer['name']); ?></td>
                                    <td><?= htmlspecialchars($customer['email']); ?></td>
                                    <td><?= htmlspecialchars($customer['phone']); ?></td>
                                    <td><?= htmlspecialchars($customer['ratings']); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $customer['id']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td>111</td>
                                    <td>John Doe</td>
                                    <td>johndoe@example.com</td>
                                    <td>+1234567890</td>
                                    <td>4.3</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="001">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>111</td>
                                    <td>Jane Smith</td>
                                    <td>janesmith@example.com</td>
                                    <td>+1234567891</td>
                                    <td>4.3</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="002">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Ratings</th>
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
                    Are you sure you want to delete this customer's record?
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
                window.location.href = `delete_customer.php?id=${deleteId}`;
            }
        });
    </script>

    <!-- DEMOGRAPHY -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Customer Demographics</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filters -->
                    <form class="row g-3 mb-4">
                        <div class="col-6 col-md-4">
                            <label for="ageGroup" class="form-label">Age Group</label>
                            <select class="form-select" id="ageGroup">
                                <option value="" selected>All Ages</option>
                                <option value="0-19">0-19</option>
                                <option value="20-34">20-34</option>
                                <option value="35-49">35-49</option>
                                <option value="50-69">50-69</option>
                                <option value="70 Above">70 Above</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-4">
                            <label for="genderFilter" class="form-label">Gender</label>
                            <select class="form-select" id="genderFilter">
                                <option value="" selected>All Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
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
                    </form>

                    <!-- Demographic Chart -->
                    <div class="card">
                        <div class="card-body">
                            <!-- <h5 class="card-title">Demographic Insights</h5>
                            <div id="demographicChart" style="height: 400px; background: #f7f7f7; text-align: center; line-height: 400px;">
                                Chart will load here...
                            </div> -->
                            <canvas id="demographicsChart" width="400" height="200"></canvas>
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
    const data = {
        labels: ['18-24', '25-34', '35-44', '45+'],
        datasets: [{
            label: 'Customer Demographics',
            data: [25, 40, 20, 15],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true
                }
            }
        }
    };

    new Chart(document.getElementById('demographicsChart'), config);
</script>

<?php
    include('../panel/footer.php');
?>