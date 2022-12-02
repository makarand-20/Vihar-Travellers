<?php
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');
require("../include/sendgrid/sendgrid-php.php");

date_default_timezone_set("Asia/Kolkata");

function send_mail($uemail, $token){
    
    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom(SENDGRID_EMAIL, SENDGRID_TITLE_NAME);
    $email->setSubject("Account Verification Link");

    $email->addTo($uemail);
    
    $email->addContent(
        "text/html",
        "
            Click the link to verify Your Account<br>
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

function send_for_mail($uemail, $token){

    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom(SENDGRID_EMAIL, SENDGRID_TITLE_NAME);
    $email->setSubject("Account Reset Link");

    $email->addTo($uemail);
    
    $email->addContent(
        "text/html",
        "
            Click the link reset Your Account<br>
            <a href = '".SITE_URL."index.php?account_recovery&email=$uemail&token=$token"."'>
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

    if(!send_mail($data['email'], $token)){
        echo 'mail_failed';
        exit;
    }

    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    $q = "INSERT INTO `user_cred`(`name`, `email`, `phonenum`, `address`, `pincode`, `dob`, `pass`, `profile`, `token`) VALUES (?,?,?,?,?,?,?,?,?)";

    $values = [$data['name'],$data['email'],$data['phonenum'],$data['address'],$data['pincode'],$data['dob'], $enc_pass, $img , $token];

    if(insert($q, $values, 'ssssissss')){
        echo 1;
    }
    else{
        echo 'ins_failed';
    }
}

if(isset($_POST['login'])){
    $data = filteration($_POST);

    //check user exist

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1", [$data['email_mob'], $data['email_mob']],'ss');

    if(mysqli_num_rows($u_exist)==0){
        echo 'inv_email_mob'; 
    }
    else{
        $u_fetch = mysqli_fetch_assoc($u_exist);

        if($u_fetch['is_verified']==0){
            echo 'not_verified';
        }
        else if($u_fetch['status']==0){
            echo 'inactive';
        }
        else{
            if(!password_verify($data['pass'], $u_fetch['pass'])){
                echo 'invalid_pass';
            }
            else{
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['uId'] = $u_fetch['id'];
                $_SESSION['uName'] = $u_fetch['name'];
                $_SESSION['uPic'] = $u_fetch['profile'];
                $_SESSION['uPhone'] = $u_fetch['phonenum'];
                echo 1;
            }
        }
    }

}

if(isset($_POST['forgot_pass'])){
    $data = filteration($_POST);

    //check user exist

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1", [$data['email']],'s');

    if(mysqli_num_rows($u_exist)==0){
        echo 'inv_email'; 
    }
    else{
        $u_fetch = mysqli_fetch_assoc($u_exist);

        if($u_fetch['is_verified']==0){
            echo 'not_verified';
        }
        else if($u_fetch['status']==0){
            echo 'inactive';
        }
        else{
            $token = bin2hex(random_bytes(16));
            if(send_for_mail($data['email'], $token)){
                $date = date("Y-m-d");
                $query = mysqli_query($con, "UPDATE `user_cred` SET `token`='$token',`t_expire`='$date' WHERE `id`='$u_fetch[id]'");

                if($query){
                    echo 1;
                }
                else{
                    echo 'upd_failed';
                }
            }
            else{
                echo 'mail_failed';
            }
        }
    }

}
?>