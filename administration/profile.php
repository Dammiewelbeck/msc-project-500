<?php
    include('../panel/header.php');
    include('../panel/sidebar.php');
    include('../panel/navbar.php');
    // include('../auth/config.php');

    // Fetch data from the database
    $users = mysqli_query($database, "SELECT id, image, first_name, last_name, role FROM users ORDER BY id DESC LIMIT 10 ");

    $currentUser = mysqli_query($database, "SELECT * FROM users WHERE id = '".$_SESSION['id']."'");
    $profile = mysqli_fetch_assoc($currentUser);

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
                            <h1>PROFILE</h1>
                            <p>This page displays a list of all users with search and filter options.</p>
                        </div>
                        <div>
                            <a href="<?php echo dirname($_SERVER['PHP_SELF']) . '/../administration/edit_profile.php';?>" class="btn btn-link btn-soft-light">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.3764 20.0279L18.1628 8.66544C18.6403 8.0527 18.8101 7.3443 18.6509 6.62299C18.513 5.96726 18.1097 5.34377 17.5049 4.87078L16.0299 3.69906C14.7459 2.67784 13.1541 2.78534 12.2415 3.95706L11.2546 5.23735C11.1273 5.39752 11.1591 5.63401 11.3183 5.76301C11.3183 5.76301 13.812 7.76246 13.8651 7.80546C14.0349 7.96671 14.1622 8.1817 14.1941 8.43969C14.2471 8.94493 13.8969 9.41792 13.377 9.48242C13.1329 9.51467 12.8994 9.43942 12.7297 9.29967L10.1086 7.21422C9.98126 7.11855 9.79025 7.13898 9.68413 7.26797L3.45514 15.3303C3.0519 15.8355 2.91395 16.4912 3.0519 17.1255L3.84777 20.5761C3.89021 20.7589 4.04939 20.8879 4.24039 20.8879L7.74222 20.8449C8.37891 20.8341 8.97316 20.5439 9.3764 20.0279ZM14.2797 18.9533H19.9898C20.5469 18.9533 21 19.4123 21 19.9766C21 20.5421 20.5469 21 19.9898 21H14.2797C13.7226 21 13.2695 20.5421 13.2695 19.9766C13.2695 19.4123 13.7226 18.9533 14.2797 18.9533Z" fill="currentColor"></path>                            </svg>                        
                                Edit Profile
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
    <!-- PROFILE -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="profile-img position-relative me-3 mb-3 mb-lg-0 profile-logo profile-logo1">
                                <img src="../assets/images/users/<?= $profile['image']; ?>" alt="User-Profile" class="theme-color-default-img img-fluid rounded-pill avatar-100">
                            </div>
                            <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                                <h4 class="me-2 h4"><?= htmlspecialchars($profile['username']); ?></h4>
                                <span> - <?= $profile['role']; ?></span>
                            </div>
                        </div>
                        <ul class="d-none d-md-flex nav nav-pills mb-0 text-center profile-tab" data-toggle="slider-tab" id="profile-pills-tab" role="tablist">
                            <!-- <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile-friends" role="tab" aria-selected="false">Friends</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link active show" data-bs-toggle="tab" href="#profile-profile" role="tab" aria-selected="false">Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="profile-content tab-content">
                <div id="profile-profile" class="tab-pane fade active show">
                    <div class="card">
                        <div class="card-header">
                            <div class="header-title">
                            <h4 class="card-title">Profile</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                            <div class="user-profile">
                                <img src="../assets/images/users/<?= $profile['image']; ?>" alt="profile-img" class="rounded-pill avatar-130 img-fluid">
                            </div>
                            <div class="mt-3">
                                <h3 class="d-inline-block"><?= htmlspecialchars($profile['first_name'] . ' ' . $profile['last_name']); ?></h3>
                                <p class="d-inline-block pl-3"> - <?= $profile['role']; ?></p>
                                <p class="mb-0"><?= $profile['about']; ?></p>
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
                                <p><?= htmlspecialchars($profile['about']); ?></p>
                            </div>
                            <div class="mt-2">
                                <h6 class="mb-1">Joined:</h6>
                                <p><?= (new DateTime($profile['created_at']))->format('Y-m-d'); ?></p>
                            </div>
                            <div class="mt-2">
                                <h6 class="mb-1">Lives:</h6>
                                <p><?= htmlspecialchars($profile['address']); ?></p>
                            </div>
                            <div class="mt-2">
                                <h6 class="mb-1">Email:</h6>
                                <p><a href="#" class="text-body"><?= htmlspecialchars($profile['email']); ?></a></p>
                            </div>
                            <div class="mt-2">
                                <h6 class="mb-1">Contact:</h6>
                                <p><a href="#" class="text-body"><?= htmlspecialchars($profile['phone']); ?></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="profile-content tab-content">
                <div id="profile-friends" class="tab-pane fade active show">
                    <div class="card">
                        <div class="card-header">
                            <div class="header-title">
                                <h4 class="card-title">Other Users</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-inline m-0 p-0">
                                <?php foreach ($users as $user) { ?>
                                    <li class="d-flex mb-4 align-items-center">
                                        <img src="../assets/images/users/<?= $user['image']; ?>" alt="user-img" class="rounded-pill avatar-40">
                                        <div class="ms-3 flex-grow-1">
                                            <h6><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h6>
                                            <p class="mb-0"><?= htmlspecialchars($user['role']); ?></p>
                                        </div>
                                    </li>
                                <?php } ?>
                                <!-- <li class="d-flex mb-4 align-items-center">
                                    <img src="../assets/images/avatars/01.png" alt="story-img" class="rounded-pill avatar-40">
                                    <div class="ms-3 flex-grow-1">
                                        <h6>Paul Molive</h6>
                                        <p class="mb-0">Admin</p>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 align-items-center">
                                    <img src="../assets/images/avatars/05.png" alt="story-img" class="rounded-pill avatar-40">
                                    <div class="ms-3 flex-grow-1">
                                        <h6>Paul Molive</h6>
                                        <p class="mb-0">Analyst</p>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 align-items-center">
                                    <img src="../assets/images/avatars/02.png" alt="story-img" class="rounded-pill avatar-40">
                                    <div class="ms-3 flex-grow-1">
                                        <h6>Anna Mull</h6>
                                        <p class="mb-0">Viewer</p>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 align-items-center">
                                    <img src="../assets/images/avatars/03.png" alt="story-img" class="rounded-pill avatar-40">
                                    <div class="ms-3 flex-grow-1">
                                        <h6>Paige Turner</h6>
                                        <p class="mb-0">Analyst</p>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 align-items-center">
                                    <img src="../assets/images/avatars/04.png" alt="story-img" class="rounded-pill avatar-40">
                                    <div class="ms-3 flex-grow-1">
                                        <h6>Barb Ackue</h6>
                                        <p class="mb-0">Admin</p>
                                    </div>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                 
                       
<?php
    include('../panel/footer.php');
?>