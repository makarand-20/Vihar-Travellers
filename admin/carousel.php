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
    <title>TRS World - Carousel</title>
</head>

<body>
    <?php include('header.php') ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Carousel</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Carousel</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Carousel Team -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title">Carousel</h5>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#carousel-s">
                                            <i class="bi bi-plus-square"></i> Add
                                        </button>
                                    </div>

                                    <div class="row mt-3 mx-2" id="carousel-data">

                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="carousel-sLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form id="Carousel_s_form">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Carousel Image</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Upload picture</label>
                                                        <input type="file" name="carousel_picture" id="carousel_picture_inp" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" onclick="carousel_picture.value=''" class="btn btn bg-white shadow-none" data-bs-dismiss="modal">Cancel</button>

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
    <script src="scripts/carousel.js"></script>

</body>

</html>