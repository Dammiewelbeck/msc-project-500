<?php
    include('../panel/header.php');
    include('../panel/sidebar.php');
    include('../panel/navbar.php');
    // include('../auth/config.php');

    # DELETE BUTTON
    if ((isset($_GET['func'])) && ($_GET['func'] == 'delete')) {
        $deleteID = $_GET['id'];
        $delete = mysqli_query($database, "DELETE FROM `users` WHERE `id` = '$deleteID'");

        if ($delete) {
            $extra = "all_user.php";
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $link = "http://$host$uri/$extra";
            $_SESSION['success'] = "You have deleted the user record successfully.";
            echo "<script>window.location.href='" . $link . "';</script>";
            exit();
        } else {
            $_SESSION['error'] = "Failed to delete the user. Please try again.";
            echo "<script>window.location.href='all_users.php';</script>";
            exit();
        }
    }

    # ADD USER BUTTON
    if (isset($_POST['submit'])) {
        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];
        $regionID = $_POST['region'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $insert = mysqli_query($database, "
            INSERT INTO `users` (`first_name`, `last_name`, `email`, `phone`, `role`, `region_id`, `username`, `password`) 
            VALUES ('$firstName', '$lastName', '$email', '$phone', '$role', '$regionID', '$username', '$password')
        ");

        if ($insert) {
            $_SESSION['success'] = "You have successfully added a new user.";
            echo "<script>window.location.href='all_users.php';</script>";
            exit();
        } else {
            $_SESSION['error'] = "Failed to add the user. Please try again.";
            echo "<script>window.location.href='all_users.php';</script>";
            exit();
        }
    }

    # UPDATE USER BUTTON
    if (isset($_POST['update'])) {
        $userID = $_POST['user_id'];
        $regionID = $_POST['region'];
        $role = $_POST['role'];

        $update = mysqli_query($database, "
            UPDATE `users` 
            SET `region_id` = '$regionID', `role` = '$role'
            WHERE `id` = '$userID'
        ");

        if ($update) {
            $_SESSION['success'] = "User details updated successfully.";
            echo "<script>window.location.href='all_users.php';</script>";
            exit();
        } else {
            $_SESSION['error'] = "Failed to update user details. Please try again.";
            echo "<script>window.location.href='all_users.php';</script>";
            exit();
        }
    }

    # READ USERS
    $users = mysqli_query($database, "
        SELECT 
            users.*, 
            regions.name AS region_name 
        FROM 
            users 
        LEFT JOIN 
            regions 
        ON 
            users.region_id = regions.id 
        ORDER BY 
            users.id DESC
    ");

    # FETCH REGIONS FOR DROPDOWN
    $regions = mysqli_query($database, "SELECT `id`, `name` FROM `regions` ORDER BY `name` ASC");
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
                            <h1>USER MANAGEMENT</h1>
                            <p>This page displays a list of all users with search and filter options.</p>
                        </div>
                        <div>
                            <a href="#AddUser" class="btn btn-link btn-soft-light">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>                            </svg>                        
                                Add User
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
                        <h4 class="card-title">All Users</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>Region</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id = 1; foreach ($users as $user) { ?>
                                <tr>
                                    <td><?= $id++; ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded img-fluid avatar-40 me-3 bg-primary-subtle" src="../assets/images/users/<?= $user['image']; ?>" alt="profile">
                                            <h6><?= htmlspecialchars($user['first_name'] . " " . $user['last_name']); ?></h6>
                                        </div>
                                    </td>
                                    <td><?= $user['role']; ?></td>
                                    <td><?= htmlspecialchars($user['email']); ?></td>
                                    <td><?= htmlspecialchars($user['phone']); ?></td>
                                    <td><?= htmlspecialchars($user['region_name'] ?? 'N/A'); ?></td>
                                    <td>
                                        <!-- <a href="edit_user.php?id=<?php //echo $user['id']; ?>" class="btn btn-sm btn-warning">Edit</a> -->
                                        <button class="btn btn-sm btn-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editUserModal" 
                                            data-id="<?= $user['id']; ?>" 
                                            data-first-name="<?= htmlspecialchars($user['first_name']); ?>" 
                                            data-last-name="<?= htmlspecialchars($user['last_name']); ?>" 
                                            data-email="<?= htmlspecialchars($user['email']); ?>" 
                                            data-phone="<?= htmlspecialchars($user['phone']); ?>" 
                                            data-region="<?= $user['region_id']; ?>" 
                                            data-role="<?= $user['role']; ?>">Edit</button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $user['id']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>Region</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" action="all_users.php" method="POST">
                    <div class="modal-body">
                        <!-- User ID (Hidden Field) -->
                        <input type="hidden" id="userId" name="user_id">
                        <!-- First Name -->
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" value="" disabled>
                        </div>
                        <!-- Last Name -->
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" value="" disabled>
                        </div>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="" disabled>
                        </div>
                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="" disabled>
                        </div>
                        <!-- Region -->
                        <div class="mb-3">
                            <label for="region" class="form-label">Region</label>
                            <select class="form-select" id="region" name="region" required>
                                <option selected disabled value="">Choose a region...</option>
                                <?php foreach ($regions as $region) { ?>
                                    <option value="<?= $region['id']; ?>"><?= htmlspecialchars($region['name']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- Role -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option selected disabled value="">Assign role...</option>
                                <option value="Admin">Admin</option>
                                <option value="Analyst">Analyst</option>
                                <option value="Viewer">Viewer</option>
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user details?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle Edit Modal
        const editUserModal = document.getElementById('editUserModal');
        editUserModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            // Extract user data attributes
            document.getElementById('userId').value = button.getAttribute('data-id');
            document.getElementById('firstName').value = button.getAttribute('data-first-name');
            document.getElementById('lastName').value = button.getAttribute('data-last-name');
            document.getElementById('email').value = button.getAttribute('data-email');
            document.getElementById('phone').value = button.getAttribute('data-phone');
            document.getElementById('role').value = button.getAttribute('data-role');

            // Set the selected option for the region dropdown
            const regionDropdown = document.getElementById('region');
            const selectedRegion = button.getAttribute('data-region'); // Region ID
            for (const option of regionDropdown.options) {
                option.selected = option.value === selectedRegion;
            }
        });

        // Handle Delete Modal
        const deleteModal = document.getElementById('deleteModal');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        let deleteId = null;

        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            deleteId = button.getAttribute('data-id');
        });

        confirmDeleteButton.addEventListener('click', function () {
            if (deleteId) {
                window.location.href = `all_users.php?id=${deleteId}&func=delete`;
            }
        });
    </script>


    <!-- FORM -->
    <div class="row" id="AddUser">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Add a New User</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Add User Form -->
                    <form class="row g-3" action="all_users.php" method="POST">
                        <!-- First Name -->
                        <div class="mb-3 col-6 col-md-6">
                            <label for="fName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fName" name="fName" placeholder="Enter first name" required>
                        </div>
                        <!-- Last Name -->
                        <div class="mb-3 col-6 col-md-6">
                            <label for="lName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lName" name="lName" placeholder="Enter last name" required>
                        </div>
                        <!-- Email -->
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                        </div>
                        <!-- Phone -->
                        <div class="mb-3 col-6 col-md-6">
                            <label class="form-label" for="mobno">Mobile Number</label>
                            <input type="text" class="form-control" id="mobno" name="phone" placeholder="Mobile Number">
                        </div>
                        <!-- Username -->
                        <div class="mb-3 col-6 col-md-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                        </div>
                        <!-- Role -->
                        <div class="mb-3 col-6 col-md-4">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option selected disabled value="">Assign a role...</option>
                                <option value="Admin">Admin</option>
                                <option value="Analyst">Analyst</option>
                                <option value="Viewer">Viewer</option>
                            </select>
                        </div>
                        <!-- Region -->
                        <div class="mb-3 col-6 col-md-4">
                            <label class="form-label" for="region">Region</label>
                            <select class="form-select" id="region" name="region" required>
                                <option selected disabled value="">Choose a region...</option>
                                <?php foreach ($regions as $region) { ?>
                                    <option value="<?= $region['id']; ?>"><?= htmlspecialchars($region['name']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <!-- Password -->
                        <div class="mb-3 col-6 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        </div>
                        <div class="mb-3 col-6 col-md-6">
                            <label class="form-label" for="rpass">Repeat Password</label>
                            <input type="password" class="form-control" id="rpass" placeholder="Repeat Password" required>
                        </div>
                        <!-- Submit Button -->
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" name="submit" class="btn btn-primary">Add User</button>
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