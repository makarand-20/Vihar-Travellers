<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TRS Travels</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    require('include/header.php');
    $contact_m = "SELECT * FROM `settings` WHERE `sr_no`=?";
    $values = [1];
    $contact_m = mysqli_fetch_assoc(select($contact_m, $values, 'i'));
    ?>

    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row px-xl-5 mt-5">
            <div class="col-lg-12">
                <div id="header-carousel" class="carousel slide shadow" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 480px;">
                            <img class="img-fluid shadow rounded" src="img/carousel/img 2.jpg" alt="Image">
                        </div>
                        <?php
                        $res = selectAll('carousel');
                        while ($row = mysqli_fetch_assoc($res)) {
                            $path = CAROUSEL_IMG_PATH;
                            echo <<<data
                                    <div class="carousel-item" style="height: 480px;">
                                        <img class="img-fluid shadow rounded" src="$path$row[image]" alt="Image">
                                    </div>
                                  data;
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Hot Deals Start -->
    <div class="container-fluid bg-white mt-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-cl-12 col-12">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-white px-2">Hot Deals!</span></h2>
                    <p>Big offers are going on, Hurry and grab the best selling deal right now! </p>
                </div>
                <div class="row px-xl-5 px-4">

                    <?php
                    $tour_res = select("SELECT * FROM `tours` WHERE `status`=? AND `removed`=? ORDER BY `price` LIMIT 4", [1, 0], 'ii');

                    while ($tour_data = mysqli_fetch_assoc($tour_res)) {
                        $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
                                INNER JOIN `tour_features` tfea ON f.sr_no = tfea.features_id 
                                WHERE tfea.tour_id = '$tour_data[id]'");


                        //getting features data
                        $features_data = "";
                        while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1'>$fea_row[name]</span>";
                        }

                        //getting thumbneail data

                        $tour_thumb = TOURS_IMG_PATH . "thumbnail.jpg";
                        $thumb_q = mysqli_query($con, "SELECT * FROM `tour_images` 
                                WHERE `tour_id`='$tour_data[id]' 
                                AND `thumb`='1'");

                        if (mysqli_num_rows($thumb_q) > 0) {
                            $thumb_res = mysqli_fetch_assoc($thumb_q);
                            $tour_thumb = TOURS_IMG_PATH . $thumb_res['image'];
                        }

                        $book_btn = "<button id='myBtn' disabled class='btn btn-sm bg-success rounded shadow-none'>Book Now</button>";

                        if (!$contact_m['shutdown']) {
                            $login = 0;
                            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                                $login = 1;
                            }

                            $book_btn = "<button onclick='checkLoginToBook($login, $tour_data[id])' class='btn btn-sm bg-success rounded shadow-none'>Book Now</button>";
                        }

                        //Print Tour Card

                        echo <<<data
                                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                                    <div class="card border-0 rounded shadow mb-4" style="max-width: 350px; margin: auto;">
                                        <img src="$tour_thumb" class="card-img-top rounded-top">
                                        <div class="card-body">
                                            <h5>$tour_data[feature_name]</h5>
                                            <div class="features d-flex mb-2">
                                                <p>$tour_data[package_type]</p>&emsp;<p>$tour_data[speciality_tour]</p>
                                            </div>
                                            <h5 class="mb-4">₹ $tour_data[price]/-</h5>
                                            <div class="rating mb-4">
                                                <h6 class="mb-1">Rating</h6>
                                                <span class="badge rounded-pill bg-light">
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                </span>
                                            </div>
                                        
                                            <div class="d-flex justify-content-between mb-2 mx-2">
                                                <a href="detail.php?id=$tour_data[id]" class="btn bg-primary btn-sm rounded shadow-none">More Details</a>                                                    
                                                $book_btn
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            data;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Hot Deals Start -->

    <!-- Featured Start -->
    <div class="container-fluid bg-light py-5">
        <div class="text-center mb-2 pb-2">
            <h2 class="section-title px-5 mb-4"><span class="bg-light px-2">Features</span></h2>
        </div>
        <div class="row px-xl-5 px-4">
            <?php
            $res = selectall('facilities');
            $path = FACILITIES_IMG_PATH;

            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<data
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="justify-content-center align-items-center shadow bg-white mb-4" style="padding: 30px;">
                                <img src="$path$row[icon]" alt="">
                                <h5 class="font-weight-semi-bold mb-2">$row[name]</h5>
                                <p>$row[description]</p>
                            </div>
                        </div>
                    data;
            }
            ?>
        </div>
    </div>
    <!-- Featured End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-5">
            <h2 class="section-title px-5"><span class="px-2">Winter Special</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <?php
                    $res = selectAll('extra_carousel');
                    while ($row = mysqli_fetch_assoc($res)) {
                        $path = EXTRA_CAROUSEL_IMG_PATH;
                        echo <<<data
                            <div class="card product-item border-0 shadow rounded mb-5">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="$path$row[images]" alt="">
                                </div>
                            </div>
                        data;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->

    <!-- Subscribe Start -->
    <div class="container-fluid bg-secondary mt-5 mb-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                    <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod duo labore labore.</p>
                </div>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Subscribe End -->

    <!-- ======= Our Team Section ======= -->
    <section id="team" class="team  bg-light pt-5 pb-3">
        <div class="container" data-aos="fade-up">

            <div class="text-center mb-2 pb-2">
                <h2 class="section-title px-5 mb-3"><span class="px-2 bg-light">Our Team</span></h2>
                <p>Our hardworking team members who try their best to complete the dreams of our clients</p>
            </div>
            <div class="row p-4">

                <?php
                $about_r = selectall('team_details');
                $path = ABOUT_IMG_PATH;
                while ($row = mysqli_fetch_assoc($about_r)) {
                    echo <<<data
                    <div class="col-xl-3 col-md-6 d-flex mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                            <img src="$path$row[picture]" class="img-fluid" alt="">
                            <h4>$row[name]</h4>
                            <span>Marketing</span>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                data;
                }
                ?>
            </div>
        </div>
    </section>
    <!-- End Our Team Section -->

    <!-- Password Reset -->
    <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="recovery-form">
                    <div class="modal-header d-flex justif-content-between">
                        <h5>Set up new Password</h5>
                        <button type="reset" class="btn bg-white text-dark align-middle shadow-none p-0 m-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-power"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">New Passoward</label>
                            <input type="password" name="pass" class="form-control shadow-none" required>
                            <input type="hidden" name="email">
                            <input type="hidden" name="token">
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Password Reset -->

    <?php
    include('include/footer.php');
    ?>

    <?php
    if (isset($_GET['account_recovery'])) {
        $data = filteration($_GET);
        $t_date = date("Y-m-d");

        $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1", [$data['email'], $data['token'], $t_date], 'sss');

        if (mysqli_num_rows($query) == 1) {
            echo <<<showModal
                    <script>
                        var myModal = document.getElementById('recoveryModal');

                        myModal.querySelector("input[name='email']").value = '$data[email]';
                        myModal.querySelector("input[name='token']").value = '$data[token]';

                        var modal = bootstrap.Modal.getOrCreateInstance(myModal);
                        modal.show();
                    </script>
                showModal;
        } else {
            alert('error', 'Invalid / Expired Link !');
        }
    }
    ?>

</body>
<script>
    //auto close
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 4000);


    let recovery_form = document.getElementById('recovery-form');
    recovery_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();

        data.append('email', recovery_form.elements['email'].value);
        data.append('token', recovery_form.elements['token'].value);
        data.append('pass', recovery_form.elements['pass'].value);
        data.append('recover_user', '');

        var myModal = document.getElementById('recoveryModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            if (this.responseText == 'failed') {
                alert('Account Reset Failed!');
            } else {
                alert('Account Recent Successful');
                recovery_form.reset();
            }
        }
        xhr.send(data);

        function myFunction() {
            document.getElementById("dis_book").disabled;
        }
    });
</script>

</html>