<?php
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');
require("../include/sendgrid/sendgrid-php.php/sendgrid-php.php");

function send_mail($email, $name, $token){
    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom("makarandkhiste123@gmail.com", "MkTravels");
    $email->setSubject("Account Verification Link");
    $email->addTo($email, $name);
    
    $email->addContent(
        "text/html",
        "<strong>and easy to do anywhere, even with PHP</strong>"
    );
    
    $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }
}

if(isset($_POST['register'])){
    $data = filteration($_POST);

    //match pass
    if($data['pass'] != $data['cpass']){
        echo 'Pass_mismatched';
        exit;
    }

    //check user exist

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1", [$data['email'], $data['phonenum']],'ss');

    if(mysqli_num_rows($u_exist)!=0){
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    // upload image to server
    $img = uploadUserImage($_FILES['profile']);

    if($img == 'inv_img'){
        echo 'inv_img';
        exit;
    }
    else if($img == 'upd_failed'){
        echo 'upd_failed';
        exit;
    }

    //send confirmation link to the user
    $token = bin2hex(random_bytes(16));
    send_mail($data['email'], $data['name'],$token);

}


?>