<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

if (isset($_GET['seen'])) {
    $frm_data = filteration($_GET);
    if ($frm_data['seen'] == 'all') {
        $q = "UPDATE `user_queries` SET `seen`=?";
        $values = [1];
        if (update($q, $values, 'i')) {
        } else {
            alert('error', 'Operation failed');
        }
    } 
    else {
        $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
        $values = [1, $frm_data['seen']];
        if (update($q, $values, 'ii')) {
        } else {
            alert('error', 'Operation failed');
        }
    }
}

if (isset($_GET['del'])) {
    $frm_data = filteration($_GET);
    if ($frm_data['del'] == 'all') {
        $q = "DELETE FROM `user_queries`";
        if (mysqli_query($con, $q)) {
        } else {
            alert('error', 'Operation failed');
        }
    }
    else {
        $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
        $values = [$frm_data['del']];
        if (delete($q, $values, 'i')) {
        } else {
            alert('error', 'operation failed');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title>TRS World - User Queries</title>
</head>

<body>
    <?php include('header.php') ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>User Queries</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">User Queries</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Carousel Team -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <div class="text-end mt-5">
                                        
                                        <a class="btn btn-success btn-sm" href="?seen=all"><i class="bi bi-check2-circle"></i> Read All</a>

                                        <a class="btn btn-danger btn-sm" href="?del=all"><i class="bi bi-trash3"></i> Delete All</a>

                                    </div>
                                    <div class="align-items-center justify-content-between mb-4">
                                        <div class="table-responsive-md mt-4" style="height: 400px; overflow-y:scroll">
                                            <table class="table table-hover bordered">
                                                <thead class="table-success">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col" width="20%">Subject</th>
                                                        <th scope="col" width="20%">Message</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC";
                                                    $data = mysqli_query($con, $q);
                                                    $i = 1;

                                                    while ($row = mysqli_fetch_assoc($data)) {

                                                        $seen = '';
                                                        if ($row['seen'] != 1) {
                                                            $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-success me-2'><i class='bi bi-check2-circle'></i></a>";
                                                        }
                                                        $seen .= "<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger'><i class='bi bi-trash3'></i></a>";

                                                        echo <<<query
                                                            <tr>
                                                                <td>$i</td>
                                                                <td>$row[name]</td>
                                                                <td>$row[email]</td>
                                                                <td>$row[subject]</td>
                                                                <td>$row[message]</td>
                                                                <td>$row[date]</td>
                                                                <td>$seen</td>
                                                            </tr>
                                                        query;
                                                        $i++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
    <?php require('footer.php') ?>
</body>

</html>