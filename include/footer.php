<?php
$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));

$contact_m = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$contact_m = mysqli_fetch_assoc(select($contact_m, $values, 'i'));
?>

<!-- Footer Start -->
<div class="container-fluid bg-secondary text-dark p-3">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="" class="text-decoration-none">
                <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">M</span><?php echo $contact_m['site_title'] ?></h1>
            </a>
            <p><?php echo $contact_m['site_about'] ?></p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i><?php echo $contact_r['address'] ?></p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i><?php echo $contact_r['con_email'] ?></p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+<?php echo $contact_r['pn1'] ?></p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-dark mb-2" href="tour.php"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                        <a class="text-dark mb-2" href="detail.php"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                        <a class="text-dark mb-2" href="checkout.php"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                        <a class="text-dark" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2 pn1" href="index.php"><i class="bi bi-linkedin mr-2"></i>LinkedIn</a>
                        <a class="text-dark mb-2 pn1" href="tour.php"><i class="bi bi-github mr-2"></i>Instagram</a>
                        <a class="text-dark mb-2 pn1" href="detail.php"><i class="bi bi-twitter mr-2"></i>Twitter</a>
                        <a class="text-dark mb-2 pn1" href="checkout.php"><i class="bi bi-telegram mr-2"></i>Checkout</a>
                        <a class="text-dark pn1" href="contact.php"><i class="bi bi-instagram mr-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                    <form action="">
                        <div class="form-group">
                            <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control border-0 py-4" placeholder="Your Email" required="required" />
                        </div>
                        <div>
                            <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top border-light mx-xl-5 py-4">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-dark">
                &copy; <a class="text-dark font-weight-semi-bold" href="#">TRS World</a>. All Rights Reserved. Designed
                by
                <a class="text-dark font-weight-semi-bold" href="https://makarand.netlify.app/" target="none">Makarand</a>
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="img/payments.png" alt="">
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>

<script>
    let register_form = document.getElementById('register-form');

    register_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();
        data.append('name', register_form.elements['name'].value);
        data.append('email', register_form.elements['email'].value);
        data.append('phonenum', register_form.elements['phonenum'].value);
        data.append('address', register_form.elements['address'].value);
        data.append('pincode', register_form.elements['pincode'].value);
        data.append('dob', register_form.elements['dob'].value);
        data.append('pass', register_form.elements['pass'].value);
        data.append('cpass', register_form.elements['cpass'].value);
        data.append('profile', register_form.elements['profile'].files[0]);
        data.append('register', '');

        var myModal = document.getElementById('registerModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            if(this.responseText == 'Pass_mismatched'){
                alert('Password Mismatched!');
            }
            else if(this.responseText == 'email_already'){
                alert('Email is already registred...');
            }
            else if(this.responseText == 'phone_already'){
                alert('Phone Number is already registred...');
            }
            else if(this.responseText == 'inv_img'){
                alert('Only JPEG, PNG, WEBP images are allowed!');
            }
            else if(this.responseText == 'upd_failed'){
                alert('Image Upload Failed!');
            }
            else if(this.responseText == 'mail_failed'){
                alert('Unable to send confirmation mail, Server Down!');
            }
            else if(this.responseText == 'ins_failed'){
                alert('Insertion of data failed');
            }
            else{
                alert('Sucess... Link is send to mail');
                register_form.reset();
            }
        }
        xhr.send(data);

    });

    let login_form = document.getElementById('login-form');
    login_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();
        
        data.append('email_mob', login_form.elements['email_mob'].value);
        data.append('pass', login_form.elements['pass'].value);
        data.append('login', '');

        var myModal = document.getElementById('loginModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            if(this.responseText == 'inv_email_mob'){
                alert('Invalid Email / Mobile');
            }
            else if(this.responseText == 'not_verified'){
                alert('Email is not verified yet...');
            }
            else if(this.responseText == 'inactive'){
                alert('Your Account Is Suspended, Please Contact Admin');
            }
            else if(this.responseText == 'invalid_pass'){
                alert('Invalid Password!');
            }
            else{
                window.location = window.location.pathname;
            }
        }
        xhr.send(data);

    });

    let forgot_form = document.getElementById('forgot-form');
    forgot_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();
        
        data.append('email', forgot_form.elements['email'].value);
        data.append('forgot_pass', '');

        var myModal = document.getElementById('forgotModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            if(this.responseText == 'inv_email'){
                alert('Invalid Email');
            }
            else if(this.responseText == 'not_verified'){
                alert('Email is not verified yet...');
            }
            else if(this.responseText == 'inactive'){
                alert('Your Account Is Suspended, Please Contact Admin');
            }
            else if(this.responseText == 'mail_failed'){
                alert('Cannot Send email, Server Down!');
            }
            else if(this.responseText == 'upd_failed'){
                alert('Account Recovery Failed!');
            }
            else{
                alert('Success, Link Sent to your mail');
                forgot_form.reset();
            }
        }
        xhr.send(data);

    });
</script>