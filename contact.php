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

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Contact Us</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Contact</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-fluid pt-4">
        <div class="text-center mb-5">
            <h2 class="section-title px-5"><span class="px-2">Contact Us</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5 px-5">
                <form method="POST">
                    <div class="mt-3">
                        <input type="text" name="name" class="form-control shadow-none" placeholder="Enter Name" required>
                    </div>
                    <div class="mt-3">

                        <input type="email" name="email" class="form-control shadow-none" placeholder="Enter Email" required>
                    </div>
                    <div class="mt-3">

                        <input type="text" name="subject" class="form-control shadow-none" placeholder="Enter Subject" require>
                    </div>
                    <div class="mt-3">
                        <textarea class="form-control shadow-none" name="message" rows="5" style="resize: none" placeholder="Enter Message" required></textarea>
                    </div>
                    <button type="submit" name="send" class="btn btn-primary rounded mt-3">Send Message</button>
                </form>
            </div>
            <?php
            if (isset($_POST['send'])) {
                $frm_data = filteration($_POST);

                $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
                $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];

                $res = insert($q, $values, 'ssss');
            }
            ?>
            <div class="col-lg-5 mb-5 px-5">
                <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
                <p>Justo sed diam ut sed amet duo amet lorem amet stet sea ipsum, sed duo amet et. Est elitr dolor elitr erat sit sit. Dolor diam et erat clita ipsum justo sed.</p>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-semi-bold mb-3">Address</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i><?php echo $contact_r['address'] ?></p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i><?php echo $contact_r['con_email'] ?></p>
                    <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="pn1">
                        <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+<?php echo $contact_r['pn1'] ?></p>
                    </a>
                </div>
                <div class="d-flex flex-column">
                    <h5 class="font-weight-semi-bold mb-3">Other Info</h5>
                    <p class="mb-2"><i class="fa fa-hourglass-half text-primary mr-3"></i><?php echo $contact_r['op_hour'] ?></p>
                    <a href="https://goo.gl/maps/8tKpzhnTdNqXGcMc7" target="none" class="pn1">
                        <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i><?php echo $contact_r['gmap'] ?></p>
                    </a>
                </div>
            </div>
        </div>
        <iframe class="w-100 rounded" src="<?php echo $contact_r['iframe'] ?>" height="450" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- Contact End -->

    <?php include('include/footer.php'); ?>
</body>
</html>