<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title>TRS World - Features & Facilities</title>
</head>

<body>
    <?php include('header.php') ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Features & Facilities</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Features & Facilities</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Facilities-->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title">Facilities</h5>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#facility-s">
                                            <i class="bi bi-plus-square"></i> Add
                                        </button>
                                    </div>

                                    <!-- Table -->
                                    <div class="align-items-center justify-content-between mb-4">
                                        <div class="table-responsive-md mt-4" style="height: 350px; overflow-y:scroll">
                                            <table class="table table-hover bordered">
                                                <thead class="table-success">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Icon</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col" width="40%">Description</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="facilities-data">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- End Table -->

                                </div>
                            </div>
                        </div>
                        <!-- End Facilities -->

                        <!-- Feature -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title">Features</h5>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#feature-s">
                                            <i class="bi bi-plus-square"></i> Add
                                        </button>
                                    </div>

                                    <!-- Table -->
                                    <div class="align-items-center justify-content-between mb-4">
                                        <div class="table-responsive-md mt-4" style="height: 350px; overflow-y:scroll">
                                            <table class="table table-hover bordered">
                                                <thead class="table-success">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col" width="80%">Name</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="features-data">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- End Table -->

                                </div>
                            </div>
                        </div>
                        <!-- End Feature -->

                    </div>
                </div>
            </div>
        </section>

        <!-- Feature Modal -->
        <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="feature-sLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="feature_s_form" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Feature</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="feature_name" class="form-control shadow-none" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn bg-white shadow-none" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Feature Modal -->


        <!-- Facility Modal -->
        <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="facility-sLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="facility_s_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Facility</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="facility_name" class="form-control shadow-none" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Icon</label>
                                <input type="file" name="facility_icon" id="member_picture_inp" accept=".svg" class="form-control shadow-none" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="facility_desc" rows="4" class="form-control shadow-none" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn bg-white shadow-none" data-bs-dismiss="modal">Cancel</button>

                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Facility Modal -->

    </main><!-- End #main -->
    <?php require('footer.php') ?>
    <script src="scripts/features.js"></script>
</body>

</html>