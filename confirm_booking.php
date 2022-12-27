<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TRS Travels</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    include('include/header.php');
    ?>

    <?php

    /*  Check room id is present or not
        Shutdown mode is acive or not
        User is loged in or not
    */


    if (!isset($_GET['id']) || $contact_m['shutdown']==true) {
        redirect('tour.php');
    }
    else if(!isset($_SESSION['login']) && $_SESSION['login'] == true){
        redirect('tour.php');
    }

    //filter and get rooms data from here
    $data = filteration($_GET);
    $tour_res = select("SELECT * FROM `tours` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

    if (mysqli_num_rows($tour_res) == 0) {
        redirect('tour.php');
    }

    $tour_data = mysqli_fetch_assoc($tour_res);

    $_SESSION['tour'] = [
        "id" => $tour_data['id'],
        "name" => $tour_data['feature_name'],
        "price" => $tour_data['price'],
        "payment" => null,
        "available" => false,
    ];

    $user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']],'i');
    $user_data = mysqli_fetch_assoc($user_res);


    $book_btn = "<button id='myBtn' disabled class='btn btn-sm bg-success rounded shadow-none'>Book Now</button>";

    if (!$contact_m['shutdown']) {
        $login = 0;
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            $login = 1;
        }
        $book_btn = "<button onclick='checkLoginToBook($login, $tour_data[id])' class='btn btn-primary btn-sm px-3 shadow-none rounded'>Book Now</button>";
    }
    ?>

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Confirm Booking</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Tour Detail</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid p-4">
        <div class="row px-xl-5">

            <div class="col-lg-6 pb-5">
                <?php
                //getting thumbneail data

                $tour_thumb = TOURS_IMG_PATH."thumbnail.jpg";
                $thumb_q = mysqli_query($con, "SELECT * FROM `tour_images` 
                    WHERE `tour_id`='$tour_data[id]' 
                    AND `thumb`='1'");

                if (mysqli_num_rows($thumb_q) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $tour_thumb = TOURS_IMG_PATH.$thumb_res['image'];
                }

                echo<<<data
                    <div class="card p-3 shadow rounded">
                        <img src="$tour_thumb" class="card-img-top rounded-top">
                    </div>
                data;
                ?>
            </div>

            <div class="col-lg-6 pb-5">
                <h3 class="font-weight-semi-bold"><?php echo $tour_data['feature_name'] ?></h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(50 Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">₹<?php echo $tour_data['price'] ?></h3>
                <p class="mb-4"><?php echo $tour_data['description'] ?></p>

                <?php
                $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
                    INNER JOIN `tour_features` tfea ON f.sr_no = tfea.features_id 
                    WHERE tfea.tour_id = '$tour_data[id]'");

                //getting features data
                $features_data = "";
                while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                    $features_data .= "<span class='text-dark custom-control-inline me-1 p-0'>$fea_row[name]</span>";
                }

                echo <<<features
                        <div class="d-flex">
                            <p class="text-dark"><b>Features :</b></p>&nbsp&nbsp
                            $features_data
                        </div>
                    features;
                ?>

                <div class="d-flex mb-4">
                    <p class="text-dark font-weight-medium mb-0 mr-3"><b>Status :</b></p>
                    <span class='text-dark custom-control-inline me-1 p-0'> 📍 <?php echo $tour_data['location'] ?></span>
                    <span class='text-dark custom-control-inline me-1 p-0'><?php echo $tour_data['days'] ?> days</span>
                    <span class='text-dark custom-control-inline me-1 p-0'><?php echo $tour_data['quantity'] ?> bookings remaining</span>
                </div>

                <?php
                echo <<<book
                        <div class="d-flex align-items-center mb-4 pt-2">
                            $book_btn
                        </div>
                    book;
                ?>
            </div>

        </div>

        <div class="row px-xl-5">
            <div class="col-lg-6 pb-5">
                <div class="card p-3 shadow rounded">
                    
                </div>
            </div>
        </div>

    <!-- Shop Detail End -->
    <?php
    include('include/footer.php');
    ?>
</body>

</html>