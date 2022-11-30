<?php
require('inc/essentials.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title>TRS World - Settings</title>
</head>

<body>
    <?php include('header.php') ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Settings</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Settings</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Site Title & About -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title">General Settings</h5>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#general_s">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                    </div>
                                    <h6 class="fw-bold">Site Title</h6>
                                    <p id="site_title"></p>
                                    <h6 class="fw-bold">About Us</h6>
                                    <p id="site_about"></p>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="general_s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="general_sLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form id="general_s_form">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">General Settings</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Site Title</label>
                                                        <input type="text" name="site_title" id="site_title_inp" class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">About Us</label>
                                                        <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" rows="5" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about" class="btn btn bg-white shadow-none" data-bs-dismiss="modal">Cancel</button>

                                                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Site Title & About -->

                        <!-- Shutdown Site -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title">Shutdown Website</h5>
                                        <div class="form-check form-switch">
                                            <form>
                                                <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id="shoutdown-toggle">
                                            </form>
                                        </div>
                                    </div>
                                    <p>User can not book the package when the shutdown button is turned on.</p>
                                </div>

                            </div>
                        </div>
                        <!-- End Shutdown Site -->

                        <!-- Contact Details -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title">Contacts Settings</h5>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#contacts-s">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <h6 class="fw-bold">Address</h6>
                                            <p id="address"></p>

                                            <h6 class="fw-bold">Email</h6>
                                            <p id="con_email"></p>

                                            <h6 class="fw-bold">Phone No.</h6>
                                            <p>
                                                <i class="bi bi-telephone-fill">
                                                    <span id="pn1"></span>
                                                </i>
                                            </p>

                                            <h6 class="fw-bold">Open Hours</h6>
                                            <p id="op_hour"></p>

                                            <h6 class="fw-bold">Google Map</h6>
                                            <p id="gmap"></p>

                                        </div>

                                        <div class="col-lg-6">

                                            <h6 class="fw-bold">iFrame</h6>
                                            <iframe id="iframe" class="border p2 w-100" loading="lazy" height="300px"></iframe>
                                        </div>

                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="contacts_s_formLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form id="contacts_s_form">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Contact Settings</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid p-0">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-bold">Address</label>
                                                                    <input type="text" name="address" id="address_inp" class="form-control shadow-none" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label fw-bold">Email</label>
                                                                    <input type="email" name="email" id="con_email_imp" class="form-control shadow-none" required>
                                                                </div>

                                                                <label class="form-label fw-bold">Phone No</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                                    <input type="number" name="pn1" id="pn1_inp" class="form-control shadow-none" required>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">

                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-bold">Open Hour</label>
                                                                        <input type="text" name="op_hour" id="op_hour_inp" class="form-control shadow-none" required>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-bold">Google Map</label>
                                                                        <input type="text" name="gmap" id="gmap_inp" class="form-control shadow-none" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-bold">iFrame src</label>
                                                                        <input type="text" name="iframe" id="iframe_inp" class="form-control shadow-none" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" onclick="contacts_inp(contacts_data)" class="btn btn bg-white shadow-none" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Contact Details -->

                        <!-- Management Team -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title">Management Team</h5>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#team-s">
                                            <i class="bi bi-plus-square"></i> Add
                                        </button>
                                    </div>

                                    <div class="row mt-3 mx-2" id="team-data">

                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="team-sLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form id="team_s_form">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Team Member</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Name</label>
                                                        <input type="text" name="member_name" id="member_name_inp" class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Upload picture</label>
                                                        <input type="file" name="member_picture" id="member_picture_inp" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" onclick="member_name.value='',member_picture.value=''" class="btn btn bg-white shadow-none" data-bs-dismiss="modal">Cancel</button>

                                                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Management Team -->

                    </div>
                </div><!-- End Right side columns -->
            </div>
        </section>

    </main><!-- End #main -->
    <?php require('footer.php') ?>
    <script src="scripts/setting.js"></script>

</body>
</html>