<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['add_img'])) {
  $img_r = uploadImage($_FILES['picture'], EXTRA_CAROUSEL_FOLDER);

  if ($img_r == 'inv_img') {
    echo $img_r;
  } else if ($img_r == 'inv_size') {
    echo $img_r;
  } else if ($img_r == 'upd_failed') {
    echo $img_r;
  } else {
    $q = "INSERT INTO `extra_carousel`(`images`) VALUES (?)";
    $values = [$img_r];
    $res = insert($q, $values, 's');
    echo $res;
  }
}

if (isset($_POST['get_extra_carousel'])) {
  $res = selectall('extra_carousel');

  while ($row = mysqli_fetch_assoc($res)) {
    $path = EXTRA_CAROUSEL_IMG_PATH;
    echo <<<data
      <div class="col-md-4">
        <div class="card bg-light text-white shadow">
            <img src="$path$row[images]" class="card-img rounded-0">
            <div class="card-img-overlay text-end">
              <button type="button" onclick="rem_img($row[sr_no])" class="btn btn-danger btn-sm shadow-none"><i class="bi bi-trash"></i></button>        
            </div>
        </div>
      </div>
      data;
  }
}

if (isset($_POST['rem_img'])) {
  $frm_data = filteration($_POST);
  $values = [$frm_data['rem_img']];

  $pre_q = "SELECT * FROM `extra_carousel` WHERE `sr_no`=?";
  $res = select($pre_q, $values,'i');
  $img = mysqli_fetch_assoc($res);

  if(deleteImage($img['images'], EXTRA_CAROUSEL_FOLDER)){
    $q = "DELETE FROM `extra_carousel` WHERE `sr_no`=?";
    $res = delete($q, $values,'i');
    echo $res;
  }
  else{
    echo 0;
  }
}
