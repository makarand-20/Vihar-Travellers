 <!-- Favicons -->
 <link href="assets/img/favicon.png" rel="icon">
 <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

 <!-- Google Fonts -->
 <link href="https://fonts.gstatic.com" rel="preconnect">
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

 <!-- Vendor CSS Files -->
 <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
 <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
 <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
 

 <!-- Template Main CSS File -->
 <link href="assets/css/style.css" rel="stylesheet">

 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">

   <div class="d-flex align-items-center justify-content-between">
     <a href="dashboard.php" class="logo d-flex align-items-center">
       <img src="assets/img/logo.png" alt="">
       <span class="d-none d-lg-block">TRSAdmin</span>
     </a>
     <i class="bi bi-list toggle-sidebar-btn"></i>
   </div><!-- End Logo -->

   <div class="search-bar">
     <form class="search-form d-flex align-items-center" method="POST" action="#">
       <input type="text" name="query" placeholder="Search" title="Enter search keyword">
       <button type="submit" title="Search"><i class="bi bi-search"></i></button>
     </form>
   </div><!-- End Search Bar -->

   <nav class="header-nav ms-auto">
     <ul class="d-flex align-items-center">

       <li class="nav-item d-block d-lg-none">
         <a class="nav-link nav-icon search-bar-toggle " href="#">
           <i class="bi bi-search"></i>
         </a>
       </li><!-- End Search Icon-->

       <li class="nav-item dropdown pe-3">

         <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
           <img src="assets/img/pro.jpg" alt="Profile" class="rounded-circle">
           <span class="d-none d-md-block dropdown-toggle ps-2">Makarand Khiste</span>
         </a><!-- End Profile Iamge Icon -->

         <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
           <li class="dropdown-header">
             <h6>Makarand Khsite</h6>
             <span>Web Designer</span>
           </li>
           <li>
             <hr class="dropdown-divider">
           </li>

           <li>
             <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
               <i class="bi bi-person"></i>
               <span>My Profile</span>
             </a>
           </li>
           <li>
             <hr class="dropdown-divider">
           </li>

           <li>
             <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
               <i class="bi bi-gear"></i>
               <span>Account Settings</span>
             </a>
           </li>
           <li>
             <hr class="dropdown-divider">
           </li>
           <li>
             <hr class="dropdown-divider">
           </li>

           <li>
             <a class="dropdown-item d-flex align-items-center" href="logout.php">
               <i class="bi bi-box-arrow-right"></i>
               <span>Sign Out</span>
             </a>
           </li>
         </ul><!-- End Profile Dropdown Items -->
       </li><!-- End Profile Nav -->

     </ul>
   </nav><!-- End Icons Navigation -->

 </header><!-- End Header -->

 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

   <ul class="sidebar-nav" id="sidebar-nav">

     <li class="nav-item">
       <a class="nav-link" href="../index.php">
         <i class="bi bi-house-door-fill"></i>
         <span>Home</span>
       </a>
       <a class="nav-link" href="dashboard.php">
         <i class="bi bi-grid"></i>
         <span>Dashboard</span>
       </a>
       <a class="nav-link" href="users-profile.php">
         <i class="bi bi-person-fill"></i>
         <span>Profile</span>
       </a>
       <a class="nav-link" href="tours.php">
         <i class="bi bi-airplane-engines"></i>
         <span>Tours</span>
       </a>
       <a class="nav-link" href="users.php">
         <i class="bi bi-people-fill"></i>
         <span>Users</span>
       </a>
       <a class="nav-link" href="carousel.php">
         <i class="bi bi-image"></i>
         <span>Carousel</span>
       </a>
       <a class="nav-link" href="features.php">
         <i class="bi bi-list-task"></i>
         <span>Features & Facilities</span>
       </a>
       <a class="nav-link" href="extra_carousel.php">
         <i class="bi bi-images"></i>
         <span>Extra Carousel</span>
       </a>
       <a class="nav-link" href="user_queries.php">
         <i class="bi bi-question-lg"></i>
         <span>User Queries</span>
       </a>
       <a class="nav-link" href="setting.php">
         <i class="bi bi-gear"></i>
         <span>Settings</span>
       </a>
     </li><!-- End Dashboard Nav -->
   </ul>
 </aside><!-- End Sidebar-->