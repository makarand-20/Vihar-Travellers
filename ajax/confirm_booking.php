<?php
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');
require("../include/sendgrid/sendgrid-php.php");

date_default_timezone_set("Asia/Kolkata");


if(isset($_POST['check_availability'])){
    $frm_data = filteration($_POST);

    $status = "";
    $result = "";

    //checkin and out validations

    $today_date = new DateTime(date("Y-m-d"));
    $checkin_date = new DateTime($frm_data['check_in']);
    $checkout_date = new DateTime($frm_data['check_out']);

    if($checkin_date == $checkout_date){
        $status = 'check_in_out_equal';
        $result = json_encode(["status"=>$status]);
    }
    else if($checkout_date < $checkin_date){
        $status = 'check_out_earlier';
        $result = json_encode(["status"=>$status]);
    }
    else if($checkout_date < $today_date){
        $status = 'check_in_earlier';
        $result = json_encode(["status"=>$status]);
    }

    //check booking availability

    if($status!=''){
        echo $result;
    }
    else{
        session_start();
        $_SESSION['tour'];

        //run query to check if room is available

        $count_days = date_diff($checkin_date, $checkout_date)->days;
        $payment = $_SESSION['tour']['price'] * $count_days;

        $_SESSION['tour']['payment'] = $payment;
        $_SESSION['tour']['available'] = true;

        $result = json_encode(["status"=>'available', "days"=>$count_days, "payment"=>$payment]);
        echo $result;
    }
}
?>