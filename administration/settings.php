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
                            <h1>SETTINGS</h1>
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
    <!-- FORM -->
    <div class="row" id="AddUser">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">General Settings</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- General Settings Form -->
                    <form class="row g-3" action="update_settings.php" method="POST">
                        <!-- Application Name -->
                        <div class="mb-3 col-md-6">
                            <label for="appName" class="form-label">Application Name</label>
                            <input type="text" class="form-control" id="appName" name="app_name" value="Coca-Cola Dashboard" required>
                        </div>
                        <!-- Theme -->
                        <div class="mb-3 col-md-6">
                            <label for="theme" class="form-label">Theme</label>
                            <select class="form-select" id="theme" name="theme" required>
                                <option value="Light">Light</option>
                                <option value="Dark">Dark</option>
                            </select>
                        </div>
                        <!-- Submit Button -->
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FORM -->
    <div class="row" id="AddUser">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Security Settings</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Security Settings Form -->
                    <form class="row g-3" action="update_settings.php" method="POST">
                        <!-- Password Policy -->
                        <div class="mb-3">
                            <label for="passwordPolicy" class="form-label">Password Policy</label>
                            <select class="form-select" id="passwordPolicy" name="password_policy" required>
                                <option value="Simple">Simple</option>
                                <option value="Strong">Strong</option>
                            </select>
                        </div>
                        <!-- Enable 2FA -->
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="enable2FA" name="enable_2fa">
                            <label class="form-check-label" for="enable2FA">Enable Two-Factor Authentication</label>
                        </div>
                        <!-- Submit Button -->
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
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