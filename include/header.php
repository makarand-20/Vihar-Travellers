   <?php
    session_start();

    require('admin/inc/db_config.php');
    require('admin/inc/essentials.php');

    date_default_timezone_set("Asia/Kolkata");

    $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));

    $contact_m = "SELECT * FROM `settings` WHERE `sr_no`=?";
    $values = [1];
    $contact_m = mysqli_fetch_assoc(select($contact_m, $values, 'i'));

    if($contact_m['shutdown']){
        echo<<<alertbar
            <div class='bg-warning text-center text-dark p-2 fw-bold'>
                Bookings are temporary closed, Please visit after some time.
            </div>
        alertbar;
    }
    ?>

   <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-5 shadow-sm border-top">
       <a href="" class="text-decoration-none d-block d-lg-none">
           <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">M</span><?php echo $contact_m['site_title'] ?></h1>
       </a>
       <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
           <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
           <div class="navbar-nav mr-auto py-0">
               <a href="index.php" class="nav-item nav-link">Home</a>
               <a href="tour.php" class="nav-item nav-link">Tours</a>
               <a href="checkout.php" class="nav-item nav-link">Checkout</a>
               <a href="contact.php" class="nav-item nav-link">Contact</a>
               <a href="admin/index.php" class="nav-item nav-link">Admin</a>
           </div>
           <div class="py-0">

               <?php
                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                    $path = USERS_IMG_PATH;
                    echo <<<data
                            <div class="btn-group p-1">
                                <button type="button" class="bg-white text-dark rounded shadow-none px-2 py-1 dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <img src="$path$_SESSION[uPic]" style="width: 25px; height="25px;" class="me-1"></img>&nbsp;
                                $_SESSION[uName]
                                </button>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        data;
                } else {
                    echo <<<data
                            <button class="bg-white text-dark rounded shadow-sm" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>&emsp;
                            <button class="bg-white text-dark rounded shadow-sm" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                        data;
                }
                ?>

           </div>
       </div>
   </nav>

   <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <form id="register-form">
                   <div class="modal-header">
                       <h5 class="modal-title d-flex align-items-center justify-content-center">
                           <i class="bi bi-person-plus-fill fs-3 px-3 me-2"></i>
                           User Registration
                       </h5>
                       <button type="reset" class="btn bg-white text-dark align-middle shadow-none p-0 m-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-power"></i></button>
                   </div>
                   <div class="modal-body">
                       <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                           Note: Your details must match withyour ID(Aadhar card,passport,driving license,etc.)
                           that will be required during travelling.
                       </span>
                       <div class="container">
                           <div class="row">
                               <div class="col-md-6 p-2 mb-3">
                                   <label class="form-label">Name</label>
                                   <input type="text" name="name" class="form-control shadow-none" required>
                               </div>
                               <div class="col-md-6 p-2 mb-3">
                                   <label class="form-label">Email</label>
                                   <input type="email" name="email" class="form-control shadow-none" required>
                               </div>
                               <div class="col-md-6 p-2 mb-3">
                                   <label class="form-label">Phone Number</label>
                                   <input type="number" name="phonenum" class="form-control shadow-none" required>
                               </div>
                               <div class="col-md-6 p-2 mb-3">
                                   <label class="form-label mb-3">Picture</label>
                                   <input type="file" name="profile" accept=".jpg, .png, .jpeg, .webp" class=" shadow-none" required>
                               </div>
                               <div class="col-md-12 p-2 mb-3">
                                   <label class="form-label">Address</label>
                                   <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                               </div>
                               <div class="col-md-6 p-2 mb-3">
                                   <label class="form-label">Pincode</label>
                                   <input type="number" name="pincode" class="form-control shadow-none" required>
                               </div>
                               <div class="col-md-6 p-2 mb-3">
                                   <label class="form-label">Date of Birth</label>
                                   <input type="date" name="dob" class="form-control shadow-none" required>
                               </div>
                               <div class="col-md-6 p-2 mb-3">
                                   <label class="form-label">Password</label>
                                   <input type="password" name="pass" class="form-control shadow-none" required>
                               </div>
                               <div class="col-md-6 p-2 mb-3">
                                   <label class="form-label">Confirm Password</label>
                                   <input type="password" name="cpass" class="form-control shadow-none" required>
                               </div>
                           </div>
                       </div>
                       <div class="text-center my-1">
                           <button type="submit" class="btn btn-dark shadow-none">Register</button>
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </div>

   <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <form id="login-form">
                   <div class="modal-header d-flex justif-content-between">
                       <h5>User Login</h5>
                       <button type="reset" class="btn bg-white text-dark align-middle shadow-none p-0 m-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-power"></i></button>
                   </div>
                   <div class="modal-body">
                       <div class="mb-3">
                           <label class="form-label">Email / Mobile</label>
                           <input type="text" name="email_mob" class="form-control shadow-none" required>
                       </div>
                       <div class="mb-4">
                           <label class="form-label">Password</label>
                           <input type="password" name="pass" class="form-control shadow-none" required>
                       </div>
                       <div class="d-flex align-items-center justify-content-between mb-2">
                           <button type="submit" class="btn btn-dark shadow-none">Login</button>
                           <button type="button" class="btn text-dark text-decoration-none shadow-none p-0" data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">Forgot Password?</button>
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </div>

   <div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <form id="forgot-form">
                   <div class="modal-header d-flex justif-content-between">
                       <h5>Forgot Password</h5>
                       <button type="reset" class="btn bg-white text-dark align-middle shadow-none p-0 m-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-power"></i></button>
                   </div>
                   <div class="modal-body">
                       <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                           Note : A link will be sent to your email to reset password!
                       </span>
                       <div class="mb-3">
                           <label class="form-label">Email</label>
                           <input type="email" name="email" class="form-control shadow-none" required>
                       </div>
                       <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none">Send Link</button>  
                        </div>
                   </div>
               </form>
           </div>
       </div>
   </div>