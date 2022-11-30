   <?php
    require('admin/inc/db_config.php');
    require('admin/inc/essentials.php');

    $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));

    $contact_m = "SELECT * FROM `settings` WHERE `sr_no`=?";
    $values = [1];
    $contact_m = mysqli_fetch_assoc(select($contact_m, $values, 'i'));

    ?>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
       <!-- Topbar Start -->
       <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h2 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">M</span><?php echo $contact_m['site_title'] ?></h2>
                </a>
            </div>
            <div class="col-lg-6 ">
                <form action="">
                    <div class="input-group px-3">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text border bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

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
                <a href="shop.php" class="nav-item nav-link">Shop</a>
                <a href="checkout.php" class="nav-item nav-link">Checkout</a>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
                <a href="admin/index.php" class="nav-item nav-link">Admin</a>
            </div>
            <div class="py-0">
                <button class="bg-white text-dark rounded shadow-sm" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>&emsp;
                <button class="bg-white text-dark rounded shadow-sm" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
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
                <form>
                    <div class="modal-header d-flex justif-content-between">
                        <h5>User Login</h5>
                        <button type="reset" class="btn bg-white text-dark align-middle shadow-none p-0 m-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-power"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control shadow-none" required>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none">Login</button>
                            <a href="javascript: void(0)" class="text-dark text-decoration-none">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
