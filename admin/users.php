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
                                        <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search">
                                    </div>

                                    <!-- Table -->
                                    <div class="align-items-center justify-content-between mb-4">
                                        <div class="table-responsive mt-4">
                                            <table class="table table-hover bordered text-center" style="min-width: 1300px">
                                                <thead class="table-success">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Phone No.</th>
                                                        <th scope="col">Address</th>
                                                        <th scope="col">DOB</th>
                                                        <th scope="col">Verified</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="users-data">

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

    </main><!-- End #main -->
    <?php require('footer.php') ?>
    <script src="scripts/users.js"></script>

</body>

</html>