<?php
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');
require("../include/sendgrid/sendgrid-php.php");

function send_mail($uemail, $name, $token){
    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom("makarandkhiste123@gmail.com", "Traveling Hub");
    $email->setSubject("Account Verification Link");

    $email->addTo($uemail, $name);
    
    $email->addContent(
        "text/html",
        "
            Click to confirm your email : <br>
            <a href = '".SITE_URL."email_confirm.php?email_confirmation&email=$uemail&token=$token"."'>
                CLICK ME
            </a>
        "
    );
    
    $sendgrid = new \SendGrid(SENDGRID_API_KEY);
    try{
        $sendgrid->send($email);
        return 1; 
    }
    catch(Exception $e){
        return 0;
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
    if(!send_mail($data['email'], $data['name'],$token)){
        echo 'mail_failed';
        exit;
    }

    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    $q = "INSERT INTO `user_cred`(`name`, `email`, `phonenum`, `address`, `pincode`, `dob`, `pass`, `profile`, `token`) VALUES (?,?,?,?,?,?,?,?,?)";

    $values = [$data['name'],$data['email'],$data['phonenum'],$data['address'],$data['pincode'],$data['dob'], $img, $enc_pass, $token];

    if(insert($q, $values, 'ssssissss')){
        echo 1;
    }
    else{
        echo 'ins_failed';
    }
}
?>