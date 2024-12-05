<?php
include('header.php');
include('sidebar.php');
include('navbar.php');

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
   
   <!-- Nav Header Component Start -->
      <div class="iq-navbar-header" style="height: 215px;">
         <div class="container-fluid iq-container">
            <div class="row">
               <div class="col-md-12">
                  <div class="flex-wrap d-flex justify-content-between align-items-center">
                     <div>
                        <h1>COCACOLA BUSINESS INTELLIGENCE PANEL</h1>
                        <p>Welcome to the Coca-Cola Business Intelligence Panel. Our mission is to empower businesses by providing tools and resources for accurate sales prediction and data-driven decision making.</p>
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

<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-md-12 col-lg-12">
         <div class="row row-cols-1">
            <div class="overflow-hidden d-slider1 ">
               <ul  class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                  <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                     <div class="card-body">
                        <div class="progress-widget">
                           <div id="circle-progress-01" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                              <svg class="card-slie-arrow icon-24" width="24"  viewBox="0 0 24 24">
                                 <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                              </svg>
                           </div>
                           <div class="progress-detail">
                              <p  class="mb-2">Total Sales</p>
                              <h4 class="counter">$560K</h4>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                     <div class="card-body">
                        <div class="progress-widget">
                           <div id="circle-progress-02" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                              <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                 <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                              </svg>
                           </div>
                           <div class="progress-detail">
                              <p  class="mb-2">Total Profit</p>
                              <h4 class="counter">$185K</h4>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                     <div class="card-body">
                        <div class="progress-widget">
                           <div id="circle-progress-03" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                              <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                 <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                              </svg>
                           </div>
                           <div class="progress-detail">
                              <p  class="mb-2">Total Cost</p>
                              <h4 class="counter">$375K</h4>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                     <div class="card-body">
                        <div class="progress-widget">
                           <div id="circle-progress-04" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                              <svg class="card-slie-arrow icon-24" width="24px"  viewBox="0 0 24 24">
                                 <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                              </svg>
                           </div>
                           <div class="progress-detail">
                              <p  class="mb-2">Revenue</p>
                              <h4 class="counter">$742K</h4>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1100">
                     <div class="card-body">
                        <div class="progress-widget">
                           <div id="circle-progress-05" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="50" data-type="percent">
                              <svg class="card-slie-arrow icon-24" width="24px"  viewBox="0 0 24 24">
                                 <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                              </svg>
                           </div>
                           <div class="progress-detail">
                              <p  class="mb-2">Net Income</p>
                              <h4 class="counter">$150K</h4>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1200">
                     <div class="card-body">
                        <div class="progress-widget">
                           <div id="circle-progress-06" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="40" data-type="percent">
                              <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                 <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                              </svg>
                           </div>
                           <div class="progress-detail">
                              <p  class="mb-2">Today</p>
                              <h4 class="counter">$4600</h4>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                     <div class="card-body">
                        <div class="progress-widget">
                           <div id="circle-progress-07" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="30" data-type="percent">
                              <svg class="card-slie-arrow icon-24 " width="24" viewBox="0 0 24 24">
                                 <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                              </svg>
                           </div>
                           <div class="progress-detail">
                              <p  class="mb-2">Members</p>
                              <h4 class="counter">11.2M</h4>
                           </div>
                        </div>
                     </div>
                  </li>
               </ul>
               <div class="swiper-button swiper-button-next"></div>
               <div class="swiper-button swiper-button-prev"></div>
            </div>
         </div>
      </div>
      <div class="col-md-12 col-lg-12">
         <div class="row">
            <div class="col-md-12">
               <div class="card" data-aos="fade-up" data-aos-delay="800">
                  <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                     <div class="header-title">
                        <h4 class="card-title">$855.8K</h4>
                        <p class="mb-0">Gross Sales</p>          
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
                              <span class="text-gray">Cost</span>
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
               </div>
            </div>
            <!-- remove -->
            <!-- <div class="col-md-8">
               <div class="card" data-aos="fade-up" data-aos-delay="900">
                  <div class="flex-wrap card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Earnings</h4>            
                     </div>   
                     <div class="dropdown">
                        <a href="#" class="text-gray dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                           This Week
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end custom-dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                           <li><a class="dropdown-item" href="#">This Week</a></li>
                           <li><a class="dropdown-item" href="#">This Month</a></li>
                           <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="flex-wrap d-flex align-items-center justify-content-between">
                        <div id="myChart" class="col-md-8 col-lg-8 myChart"></div>
                        <div class="d-grid gap col-md-4 col-lg-4">
                           <div class="d-flex align-items-start">
                              <svg class="mt-2 icon-14" xmlns="http://www.w3.org/2000/svg" width="14" viewBox="0 0 24 24" fill="#3a57e8">
                                 <g>
                                    <circle cx="12" cy="12" r="8" fill="#3a57e8"></circle>
                                 </g>
                              </svg>
                              <div class="ms-3">
                                 <span class="text-gray">Fashion</span>
                                 <h6>251K</h6>
                              </div>
                           </div>
                           <div class="d-flex align-items-start">
                              <svg class="mt-2 icon-14" xmlns="http://www.w3.org/2000/svg" width="14" viewBox="0 0 24 24" fill="#4bc7d2">
                                 <g>
                                    <circle cx="12" cy="12" r="8" fill="#4bc7d2"></circle>
                                 </g>
                              </svg>
                              <div class="ms-3">
                                 <span class="text-gray">Accessories</span>
                                 <h6>176K</h6>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div> -->

            <!-- remove -->
            <!-- <div class="col-md-4">
               <div class="col-md-12">
                  <div class="card" data-aos="fade-up" data-aos-delay="1000">
                     <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Conversions</h4>            
                        </div>
                        <div class="dropdown">
                           <a href="#" class="text-gray dropdown-toggle" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                              This Week
                           </a>
                           <ul class="dropdown-menu dropdown-menu-end custom-dropdown-menu-end" aria-labelledby="dropdownMenuButton3">
                              <li><a class="dropdown-item" href="#">This Week</a></li>
                              <li><a class="dropdown-item" href="#">This Month</a></li>
                              <li><a class="dropdown-item" href="#">This Year</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="card-body">
                        <div id="d-activity" class="d-activity"></div>
                     </div>
                  </div>
               </div>  
            </div>    -->
         </div>
      </div>
   </div>

   <!-- SALES DATATABLE -->
   <div class="row">
      <div class="col-sm-12">
         <div class="card" data-aos="fade-up" data-aos-delay="800">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">Sales Reports</h4>
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
                                       <a href="../reports/view_report.php?id=<?= $report['report_id']; ?>" class="btn btn-sm btn-primary">View</a>
                                       <!-- <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?php //echo $report['report_id']; ?>">Delete</button> -->
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

   <!-- COMPETITORS DATATABLE -->
   <div class="row">
      <div class="col-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                        <h4 class="card-title">Competitors</h4>
                  </div>
               </div>
               <div class="card-body">
                  <p>A table showing competitor details and market share.</p>
                  <div class="custom-datatable-entries">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                           <thead>
                              <tr>
                                    <th>S/N</th>
                                    <th>Competitor Name</th>
                                    <th>Market Share (%)</th>
                                    <th>Revenue ($)</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                    <th>1</th>
                                    <td>
                                       <div class="d-flex align-items-center">
                                          <img class="rounded img-fluid avatar-40 me-3 bg-primary-subtle"
                                                src="../assets/images/shapes/01.png" alt="profile">
                                          <h6>PepsiCo</h6>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="mb-2 d-flex align-items-center">
                                          <h6>35%</h6>
                                       </div>
                                       <div class="shadow-none progress bg-primary-subtle w-100" style="height: 4px">
                                          <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                       </div>
                                    </td>
                                    <td>1.2B</td>
                              </tr>
                              <tr>
                                    <th>2</th>
                                    <td>
                                       <div class="d-flex align-items-center">
                                          <img class="rounded img-fluid avatar-40 me-3 bg-primary-subtle"
                                                src="../assets/images/shapes/02.png" alt="profile">
                                          <h6>Nigerian Breweries</h6>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="mb-2 d-flex align-items-center">
                                          <h6>15%</h6>
                                       </div>
                                       <div class="shadow-none progress bg-primary-subtle w-100" style="height: 4px">
                                          <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                       </div>
                                    </td>
                                    <td>600M</td>
                              </tr>
                              <tr>
                                    <th>3</th>
                                    <td>
                                       <div class="d-flex align-items-center">
                                          <img class="rounded img-fluid avatar-40 me-3 bg-primary-subtle"
                                                src="../assets/images/shapes/03.png" alt="profile">
                                          <h6>Guinness Nigeria Plc</h6>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="mb-2 d-flex align-items-center">
                                          <h6>10%</h6>
                                       </div>
                                       <div class="shadow-none progress bg-primary-subtle w-100" style="height: 4px">
                                          <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                       </div>
                                    </td>
                                    <td>400M</td>
                              </tr>
                           </tbody>
                           <tfoot>
                              <tr>
                                    <th>S/N</th>
                                    <th>Competitor Name</th>
                                    <th>Market Share (%)</th>
                                    <th>Revenue ($)</th>
                              </tr>
                           </tfoot>
                        </table>
                  </div>
               </div>

               <div class="mt-3 flex-wrap card-header d-flex justify-content-between">
                  <div class="header-title">
                        <h4 class="card-title">Visual comparison</h4>            
                  </div>
                  <div class="dropdown">
                        <a href="#" class="text-gray dropdown-toggle" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                           This Week
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end custom-dropdown-menu-end" aria-labelledby="dropdownMenuButton3">
                           <li><a class="dropdown-item" href="#">This Week</a></li>
                           <li><a class="dropdown-item" href="#">This Month</a></li>
                           <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                  </div>
               </div>
               <div class="card-body">
                  <canvas id="competitorsChart" width="400" height="200"></canvas>
                  <!-- <div id="d-activity" class="d-activity"></div> -->
               </div>
            </div>

      </div>
   </div>
</div>

<!-- CHART.js -->
<script>
    // Data for Market Trends Analytics (Line Chart)
    const marketTrendsLabels = ['January', 'February', 'March', 'April', 'May'];
    const marketTrendsData = {
        labels: marketTrendsLabels,
        datasets: [
            {
                label: 'Revenue ($)',
                data: [12000, 15000, 18000, 20000, 24000],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Sales Volume (Units)',
                data: [300, 400, 350, 450, 500],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }
        ]
    };

    const marketTrendsConfig = {
        type: 'line',
        data: marketTrendsData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Render Market Trends Chart
    new Chart(document.getElementById('marketTrendsChart'), marketTrendsConfig);

    // Data for Competitors Visual Comparison (Bar Chart)
    const competitorsLabels = ['January', 'February', 'March', 'April', 'May'];
    const competitorsData = {
        labels: competitorsLabels,
        datasets: [
            {
                label: 'PepsiCo ($)',
                data: [3500, 4000, 4200, 4700, 5000],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            {
                label: 'Nigerian Breweries ($)',
                data: [3000, 3200, 3300, 3700, 3900],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            },
            {
                label: 'Guinness Nigeria Plc ($)',
                data: [2700, 2900, 3000, 3100, 3500],
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }
        ]
    };

    const competitorsConfig = {
        type: 'bar',
        data: competitorsData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Render Competitors Chart
    new Chart(document.getElementById('competitorsChart'), competitorsConfig);
</script>

<?php
include('footer.php');
?>