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


    if (!isset($_GET['id']) || $contact_m['shutdown'] == true) {
        redirect('tour.php');
    } else if (!isset($_SESSION['login']) && $_SESSION['login'] == true) {
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

    $user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 'i');
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

                $tour_thumb = TOURS_IMG_PATH . "thumbnail.jpg";
                $thumb_q = mysqli_query($con, "SELECT * FROM `tour_images` 
                    WHERE `tour_id`='$tour_data[id]' 
                    AND `thumb`='1'");

                if (mysqli_num_rows($thumb_q) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $tour_thumb = TOURS_IMG_PATH . $thumb_res['image'];
                }

                echo <<<data

                    <center>
                    <div class="card pt-2 shadow rounded mb-1">
                    <h4>$tour_data[feature_name]</h4>
                    </div>
                    </center>
                    <div class="card p-3 shadow rounded mb-1">
                        <img src="$tour_thumb" class="card-img-top rounded-top">
                    </div>
                    <center>
                    <div class="card pt-2 shadow rounded mb-1">
                    <h4>₹ $tour_data[price]</h4>
                    </div>
                    </center>
                data;
                ?>
            </div>

            <div class="col-lg-6 pb-5">
                <div class="card p-3 shadow rounded">
                    <form action="" id="booking_form">
                        <h4 class="font-weight-semi-bold my-3">Booking Details</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none mb-2" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone No.</label>
                                <input name="name" type="number" value="<?php echo $user_data['phonenum'] ?>" class="form-control shadow-none mb-2" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address</label>
                                <input name="address" type="text" value="<?php echo $user_data['address'] ?>" class="form-control shadow-none mb-2" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Check In</label>
                                <input name="checkin" onchange="check_availability()" type="date" class="form-control shadow-none mb-2" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Check Out</label>
                                <input name="checkout" onchange="check_availability()" type="date" class="form-control shadow-none mb-2" required>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="spinner-border text-primary mb-3 d-none" id="info_loader" role="status">
                                    <span class="visually-hidden"></span>
                                </div>

                                <h6 class="mb-3 text-danger" id="pay_info">Provide Check-in & Check-out date !</h6>

                                <button name="pay_now" class="btn w-100 text-white bg-success rounded shadow-none mb-2" disabled>Pay Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Shop Detail End -->
    <?php
    include('include/footer.php');
    ?>
    <script>
        let booking_form = document.getElementById('booking_form');
        let info_loader = document.getElementById('info_loader');
        let pay_info = document.getElementById('pay_info');

        function check_availability() {
            let checkin_val = booking_form.elements['checkin'].value;
            let checkout_val = booking_form.elements['checkout'].value;

            booking_form.elements['pay_now'].setAttribute('disable', true);

            if (checkin_val != '' && checkout_val != '') {

                pay_info.classList.add('d-none');
                pay_info.classList.replace('text-dark', 'text-danger');
                info_loader.classList.remove('d-none');

                let data = new FormData();

                data.append('check_availability', '');
                data.append('check_in', checkin_val);
                data.append('check_out', checkout_val);

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/confirm_booking.php", true);

                xhr.onload = function() {
                    let data = JSON.parse(this.responseText);
                    if (data.status == 'check_in_out_equal') {
                        pay_info.innerText = "You can not check-out on the same day!";
                    } else if (data.status == 'check_out_earlier') {
                        pay_info.innerText = "Check-out date is earlier than check-in date!";
                    } else if (data.status == 'check_in_earlier') {
                        pay_info.innerText = "Check-in date is earlier than today's date!";
                    } else if (data.status == 'unavailable') {
                        pay_info.innerText = "Tour is not available for this date!";
                    } else {
                        pay_info.innerHTML = "No. of Days :- " + data.days + "<br>Total Amount to Pay :- ₹ " + data.payment;
                        pay_info.classList.replace('text-danger', 'text-dark');
                        booking_form.elements['pay_now'].removeAttribute('disable');
                    }
                    pay_info.classList.remove('d-none');
                    info_loader.classList.add('d-none');
                }
                xhr.send(data);
            }
        }
    </script>
</body>
</html>