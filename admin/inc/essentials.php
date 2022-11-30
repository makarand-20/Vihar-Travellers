<?php

    // frontend retrive purpose data
    define('SITE_URL', 'http://127.0.0.1/Travel_ui/');
    define('ABOUT_IMG_PATH', SITE_URL.'img/team/');
    define('CAROUSEL_IMG_PATH', SITE_URL.'img/carousel/');
    define('EXTRA_CAROUSEL_IMG_PATH', SITE_URL.'img/extra_carousel/');
    define('FACILITIES_IMG_PATH', SITE_URL.'img/facilities/');
    define('TOURS_IMG_PATH', SITE_URL.'img/tours/');

    // backend upload purpose data
    define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'].'/Travel_ui/img/');
    define('ABOUT_FOLDER', 'team/');
    define('CAROUSEL_FOLDER', 'carousel/');
    define('EXTRA_CAROUSEL_FOLDER', 'extra_carousel/');
    define('FACILITIES_FOLDER', 'facilities/');
    define('TOURS_FOLDER', 'tours/');
    define('USERS_FOLDER', 'users/');

    //sendgrid api key
    define('SENDGRID_API_KEY',"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");

    function adminLogin(){
        session_start();
        if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']== true)){
            echo"<script>
            window.location.href='index.php';
            </script>";
            exit;
        }
    }

    function redirect($url){
        echo"<script>
            window.location.href='$url';
        </script>";
        exit;
    }

    function alert($type, $msg){
        $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
        echo <<<alert
        <div class="alert $bs_class alert-dismissible fade show" role="alert">
            <strong>$msg</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        alert;
    }
    
    function uploadImage($image, $folder){
        $valid_mine = ['image/jpeg', 'image/png','image/webp'];
        $img_mine = $image['type'];

   
        if(!in_array($img_mine, $valid_mine)){
            return 'inv_img'; //invalid image mime or format
        }
        else if(($image['size']/(1024*1024))>2){
            return 'inv_size'; //invalid size greater than 2mb
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
            return $rname;
            }
            else{
            return 'upd_failed';
            }
        }
    }

    function uploadSVGImage($image, $folder){
        $valid_mine = ['image/svg+xml'];
        $img_mine = $image['type'];

   
        if(!in_array($img_mine, $valid_mine)){
            return 'inv_img'; //invalid image mime or format
        }
        else if(($image['size']/(1024*1024))>1){
            return 'inv_size'; //invalid size greater than 1mb
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
            return $rname;
            }
            else{
            return 'upd_failed';
            }
        }

    }

    function deleteImage($image, $folder){
        if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
            return true;
        }
        else{
            return false;
        }
    }

    function uploadUserImage($image){
        $valid_mine = ['image/jpeg', 'image/png','image/webp', 'image/jpg'];
        $img_mine = $image['type'];

        if(!in_array($img_mine, $valid_mine)){
            return 'inv_img'; //invalid image mime or format
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".jpeg";

            $img_path = UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;

            if($ext == 'png' || $ext == 'PNG'){
                $img = imagecreatefrompng($image['tmp_name']);
            }
            else if($ext == 'webp' || $ext == 'WEBP'){
                $img = imagecreatefromwebp($image['tmp_name']);
            }
            else{
                $img = imagecreatefromjpeg($image['tmp_name']);
            }

            if(imagejpeg($img, $img_path, 75)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }
