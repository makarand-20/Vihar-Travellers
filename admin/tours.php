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
    <title>TRS World - Tours</title>
</head>

<body>
    <?php include('header.php') ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tours</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Tours</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Tours-->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title">Tours</h5>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-tour">
                                            <i class="bi bi-plus-square"></i> Add
                                        </button>
                                    </div>

                                    <!-- Table -->
                                    <div class="align-items-center justify-content-between mb-4">
                                        <div class="table-responsive-lg mt-4" style="height: 450px; overflow-y:scroll">
                                            <table class="table table-hover bordered text-center">
                                                <thead class="table-success">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Package Type</th>
                                                        <th scope="col">Speciality Tour</th>
                                                        <th scope="col">Days</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Location</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tour-data">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- End Table -->

                                </div>
                            </div>
                        </div>
                        <!-- End Tours -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Facility Modal -->
        <div class="modal fade" id="add-tour" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="add-tour-sLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="add_tour_form" method="POST" autocomplete="off">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Tour</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Name</label>
                                    <input type="text" name="feature_name" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Package Type</label>
                                    <input type="text" name="package_type" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Speciality Tour</label>
                                    <input type="text" name="speciality_tour" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Days</label>
                                    <input type="number" name="days" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Price</label>
                                    <input type="number" name="price" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Location</label>
                                    <input type="text" name="location" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Quantity</label>
                                    <input type="number" name="quantity" class="form-control shadow-none" required>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Features</label>
                                    <div class="row">
                                        <?php
                                        $res = selectall('features');
                                        while ($opt = mysqli_fetch_assoc($res)) {
                                            echo "
                                                    <div class='col-md-3 mb-1'>
                                                        <label>
                                                            <input type='checkbox' name='features' value='$opt[sr_no]' class='form-check-input shadow-none'>
                                                            $opt[name]
                                                        </label>
                                                    </div>
                                                ";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="desc" rows="2" class="form-control shadow-none" required></textarea>
                                </div>

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

        <!-- Edit row Modal -->
        <div class="modal fade" id="edit-tour" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="edit-tour-sLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="edit_tour_form" method="POST" autocomplete="off">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Tour</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Name</label>
                                    <input type="text" name="feature_name" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Package Type</label>
                                    <input type="text" name="package_type" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Speciality Tour</label>
                                    <input type="text" name="speciality_tour" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Days</label>
                                    <input type="number" name="days" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Price</label>
                                    <input type="number" name="price" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Location</label>
                                    <input type="text" name="location" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Quantity</label>
                                    <input type="number" name="quantity" class="form-control shadow-none" required>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Features</label>
                                    <div class="row">
                                        <?php
                                        $res = selectall('features');
                                        while ($opt = mysqli_fetch_assoc($res)) {
                                            echo "
                                                    <div class='col-md-3 mb-1'>
                                                        <label>
                                                            <input type='checkbox' name='features' value='$opt[sr_no]' class='form-check-input shadow-none'>
                                                            $opt[name]
                                                        </label>
                                                    </div>
                                                ";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="desc" rows="2" class="form-control shadow-none" required></textarea>
                                </div>

                                <input type="hidden" name="tour_id">

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
        <!-- End Edit row Modal -->

        <!-- Tour Images -->
        <!-- Modal -->
        <div class="modal fade" id="tour-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tour Name</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="border-bottom border-3 pb-3 mb-3">
                            <form id="add_image_form">
                                <label class="form-label fw-bold">Add Image</label>
                                <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3" required>
                                <button class="btn btn-primary">SUBMIT</button>
                                <input type="hidden" name="tour_id">
                            </form>
                        </div>
                        <!-- Table -->
                        <div class="align-items-center justify-content-between mb-4">
                            <div class="table-responsive-lg mt-4" style="height: 350px; overflow-y:scroll">
                                <table class="table table-hover bordered text-center">
                                    <thead class="table-success">
                                        <tr class="sticky-top">
                                            <th scope="col" width="60%">Image</th>
                                            <th scope="col">Thumb</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tour-image-data">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Table -->
                    </div>
                </div>
            </div>
        </div>

        <!-- End Tour Images -->

    </main><!-- End #main -->
    <?php require('footer.php') ?>
    <script src="scripts/tours.js"></script>

</body>

</html>