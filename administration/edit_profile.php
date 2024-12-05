<?php
    include('../panel/header.php');
    include('../panel/sidebar.php');
    include('../panel/navbar.php');

    // Check if the update button is submitted
    if (isset($_POST['update'])) {
        // Extract values from the form inputs
        $role = $_POST['role'];
        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $userName = $_POST['uname'];
        $region = $_POST['region'];
        $email = $_POST['email'];
        $mobileNumber = $_POST['mobno'];
        $address = $_POST['address'];
        $about = $_POST['about'];
        $password = $_POST['pass'];
        $repeatPassword = $_POST['rpass'];

        // Validate passwords
        if ($password !== $repeatPassword) {
            $_SESSION['error'] = "Passwords do not match. Please try again.";
            echo "<script>window.location.href='edit_profile.php';</script>";
            exit();
        }

        // Encrypt the password (if provided)
        $hashedPassword = $password ? password_hash($password, PASSWORD_BCRYPT) : null;

        // Handle profile image upload
        $profilePic = $_FILES['profileImage']['name'] ?? null;
        $profilePicTmp = $_FILES['profileImage']['tmp_name'] ?? null;
        $imageSQL = ""; // Initialize image SQL part

        if ($profilePic) {
            $uploadDir = "../assets/images/users/";
            $extension = strtolower(pathinfo($profilePic, PATHINFO_EXTENSION));
            $profilePicName = 'profile_' . rand(10000, 99999) . '.' . $extension;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($profilePicTmp, $uploadDir . $profilePicName)) {
                $imageSQL = "`image` = '$profilePicName',"; // Update image only if uploaded
            } else {
                $_SESSION['error'] = "Failed to upload profile image.";
                echo "<script>window.location.href='edit_profile.php';</script>";
                exit();
            }
        }

        // Build the SQL query to update the user's profile
        $userId = $_SESSION['id'];
        $passwordSQL = $hashedPassword ? "`password` = '$hashedPassword'," : ""; // Add password SQL only if provided

        $updateQuery = "
            UPDATE `users`
            SET
                `first_name` = '$firstName',
                `last_name` = '$lastName',
                `username` = '$userName',
                `region_id` = '$region',
                `email` = '$email',
                `phone` = '$mobileNumber',
                `address` = '$address',
                `about` = '$about',
                `role` = '$role',
                $imageSQL
                $passwordSQL
                `updated_at` = NOW()
            WHERE `id` = '$userId'
        ";

        // Remove trailing commas caused by optional fields
        $updateQuery = preg_replace('/,\s*WHERE/', ' WHERE', $updateQuery);

        // Execute the query
        $update = mysqli_query($database, $updateQuery);

        // Redirect based on success or failure
        if ($update) {
            $_SESSION['success'] = "Your profile has been updated successfully.";
            echo "<script>window.location.href='profile.php';</script>";
            exit();
        } else {
            $_SESSION['error'] = "Failed to update your profile. Please try again.";
            echo "<script>window.location.href='edit_profile.php';</script>";
            exit();
        }
    }

    // Fetch the user details based on the session user ID
    $userId = $_SESSION['id'];
    $query = mysqli_query($database, "
        SELECT 
            users.*, 
            regions.name AS region_name 
        FROM 
            users 
        LEFT JOIN 
            regions 
        ON 
            users.region_id = regions.id 
        WHERE 
            users.id = '$userId'
    ");
    $user = mysqli_fetch_assoc($query);
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
                            <h1>EDIT PROFILE</h1>
                            <p>This page displays a list of all users with search and filter options.</p>
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
    <!-- EDIT PROFILE -->
    <div class="row">
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Profile Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="profile-img-edit position-relative">
                                        <!-- Profile Image -->
                                        <img src="../assets/images/users/<?= htmlspecialchars($user['image']); ?>" 
                                            alt="profile-pic" 
                                            id="profilePicPreview" 
                                            class="theme-color-default-img profile-pic rounded img-thumbnail"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                        <!-- Upload Button -->
                                        <div class="upload-icone bg-primary">
                                            <label for="profileImage">
                                                <svg class="upload-button icon-14" width="14" viewBox="0 0 24 24">
                                                    <path fill="#ffffff" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                </svg>
                                            </label>
                                            <input id="profileImage" class="file-upload d-none" type="file" name="profileImage" accept="image/*">
                                        </div>
                                    </div>
                                    <script>
                                        // Select the file input and image preview elements
                                        const profileImageInput = document.getElementById('profileImage');
                                        const profilePicPreview = document.getElementById('profilePicPreview');

                                        // Listen for file selection
                                        profileImageInput.addEventListener('change', (event) => {
                                            const file = event.target.files[0]; // Get the selected file
                                            if (file) {
                                                const reader = new FileReader();

                                                // When the file is read, update the preview image
                                                reader.onload = (e) => {
                                                    profilePicPreview.src = e.target.result; // Update the image source
                                                };

                                                reader.readAsDataURL(file); // Read the file as a data URL
                                            }
                                        });
                                    </script>
                                    <div class="img-extension mt-3">
                                        <div class="d-inline-block align-items-center">
                                            <span>Only</span>
                                            <a href="javascript:void();">.jpg</a>
                                            <a href="javascript:void();">.png</a>
                                            <a href="javascript:void();">.jpeg</a>
                                            <span>allowed</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="role" class="form-label">User Role:</label>
                                    <select class="form-select" id="role" name="role" required>
                                        <option value="Admin" <?= $user['role'] === 'Admin' ? 'selected' : ''; ?>>Admin</option>
                                        <option value="Analyst" <?= $user['role'] === 'Analyst' ? 'selected' : ''; ?>>Analyst</option>
                                        <option value="Viewer" <?= $user['role'] === 'Viewer' ? 'selected' : ''; ?>>Viewer</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="fName">First Name:</label>
                                    <input type="text" class="form-control" id="fName" name="fName" value="<?= htmlspecialchars($user['first_name']); ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="lName">Last Name:</label>
                                    <input type="text" class="form-control" id="lName" name="lName" value="<?= htmlspecialchars($user['last_name']); ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="uname">User Name:</label>
                                    <input type="text" class="form-control" id="uname" name="uname" value="<?= htmlspecialchars($user['username']); ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="region">Region:</label>
                                    <select class="form-select" id="region" name="region" required>
                                        <option selected disabled value="">Choose a region...</option>
                                        <?php $regionsQuery = mysqli_query($database, "SELECT id, name FROM regions ORDER BY name ASC"); while ($region = mysqli_fetch_assoc($regionsQuery)) { ?>
                                            <option value="<?= $region['id']; ?>" <?= $user['region_id'] == $region['id'] ? 'selected' : ''; ?>><?= htmlspecialchars($region['name']); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="mobno">Mobile Number:</label>
                                    <input type="text" class="form-control" id="mobno" name="mobno" value="<?= htmlspecialchars($user['phone']); ?>" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($user['address']); ?>" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="about" class="form-label">Short About:</label>
                                    <textarea class="form-control" id="about" name="about" rows="3"><?= htmlspecialchars($user['about']); ?></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="pass">Password:</label>
                                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="rpass">Repeat Password:</label>
                                    <input type="password" class="form-control" id="rpass" name="rpass" placeholder="Repeat Password">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="checkbox" id="showPassword" class="form-check-input me-2">
                                    <label for="showPassword" class="form-check-label">Show Password</label>
                                </div>
                                <script>
                                    const showPasswordCheckbox = document.getElementById('showPassword');
                                    const passwordField = document.getElementById('pass');
                                    const repeatPasswordField = document.getElementById('rpass');

                                    // Toggle password visibility on checkbox change
                                    showPasswordCheckbox.addEventListener('change', function () {
                                        const type = this.checked ? 'text' : 'password';
                                        passwordField.type = type;
                                        repeatPasswordField.type = type;
                                    });
                                </script>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary mt-3">Update Record</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                 
                       
<?php
    include('../panel/footer.php');
?>