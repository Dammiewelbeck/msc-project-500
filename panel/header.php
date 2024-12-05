<?php
session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: ../auth/index.php");
        exit();
    }


    // if (!isset($_SESSION['id'])) {
    //     header("Location: ");
    //     exit();
    // } 

?>

<!-- <div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
    <a class="btn btn-danger" href="../auth/index.php?func=logout">Logout</a>
</div> -->

<!doctype html>
<html lang="en" dir="ltr" data-bs-theme="light" data-bs-theme-color="theme-color-default">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title> COCACOLA BUSINESS INTELLIGENCE - Control Panel </title>
      
      <!-- Favicon -->
      <!-- <link rel="shortcut icon" href="../assets/images/favicon.ico"> -->
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="../assets/css/core/libs.min.css">
      
      <!-- Aos Animation Css -->
      <link rel="stylesheet" href="../assets/vendor/aos/dist/aos.css">
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="../assets/css/hope-ui.min.css?v=5.0.0">
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="../assets/css/custom.min.css?v=5.0.0">
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="../assets/css/customizer.min.css?v=5.0.0">
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="../assets/css/rtl.min.css?v=5.0.0">

      <!-- Chart.js -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <!-- Google Chart -->
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      
      
  </head>
  <body class="  ">