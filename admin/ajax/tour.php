<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if(isset($_POST['add_tour']))
{

  $features = filteration(json_decode($_POST['features']));

  $frm_data = filteration($_POST);
  $flag = 0;

  $q1 = "INSERT INTO `tours`(`feature_name`, `package_type`, `speciality_tour`, `days`, `price`, `location`, `description`, `quantity`) VALUES (?,?,?,?,?,?,?,?)"; 
  $values = [$frm_data['feature_name'], $frm_data['package_type'], $frm_data['speciality_tour'], $frm_data['days'], $frm_data['price'], $frm_data['location'], $frm_data['desc'], $frm_data['quantity']];

  $res = insert($q1, $values, 'sssiissi');
  echo $res;

  if($res){
    $flag = 1;
  }

  $tour_id = mysqli_insert_id($con);

  $q2 = "INSERT INTO `tour_features`(`tour_id`, `features_id`) VALUES (?,?)";

  if($stmt = mysqli_prepare($con, $q2)){
    foreach($features as $f){
      mysqli_stmt_bind_param($stmt, 'ii', $tour_id, $f);
      mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
  }
  else{
    $flag = 0;
    die('Query can not be prepared! - Insert');
  }
}

if(isset($_POST['get_all_tours']))
{
  $res = select("SELECT * FROM `tours` WHERE `removed`=?", [0],'i');
  $i = 1;

  $data = ""; 

  while($row = mysqli_fetch_assoc($res)){

    if($row['status'] == 1){
      $status = "
        <button onclick='toggle_status($row[id],0)' class='btn btn-primary btn-sm shadow-none'>Active</button>
      ";
    }
    else{
      $status = "
        <button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>Inactive</button>
      ";
    }

    $data.="
      <tr class='align-middle'>
        <td>$i</td>
        <td>$row[feature_name]</td>
        <td>$row[package_type]</td>
        <td>$row[speciality_tour]</td>  
        <td>$row[days]</td>
        <td>₹$row[price]</td>
        <td>$row[location]</td>
        <td>$row[quantity]</td>
        <td>$status</td>
        <td>
          <button type='button' onclick='edit_details($row[id])' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#edit-tour'>
            <i class='bi bi-pencil-square'></i>
          </button>
          <button type='button' onclick=\"tour_images($row[id],'$row[feature_name]')\" class='btn btn-secondary btn-sm' data-bs-toggle='modal' data-bs-target='#tour-images'>
            <i class='bi bi-images'></i>
          </button>
          <button type='button' onclick='remove_tour($row[id])' class='btn btn-danger btn-sm'>
            <i class='bi bi-trash'></i>
          </button>
        </td>
      </tr>
    ";
    $i++;
  }
  echo $data;
}

if(isset($_POST['get_tours']))
{
  $frm_data = filteration($_POST);
  $res1 = select("SELECT * FROM `tours` WHERE `id`=?", [$frm_data['get_tours']],'i');
  $res2 = select("SELECT * FROM `tour_features` WHERE `tour_id`=?", [$frm_data['get_tours']],'i');

  $tourdata = mysqli_fetch_assoc($res1);
  $features = [];

  if(mysqli_num_rows($res2)>0){
    while($row = mysqli_fetch_assoc($res2)){
      array_push($features, $row['features_id']);
    }
  }

  $data = ["tourdata" => $tourdata, "features" => $features];
  $data = json_encode($data);
  echo $data;
}

if(isset($_POST['edit_tour'])){
  $features = filteration(json_decode($_POST['features']));

  $frm_data = filteration($_POST);
  $flag = 0;

  $q1 = "UPDATE `tours` SET `feature_name`=?,`package_type`=?,`speciality_tour`=?,`days`=?,`price`=?,`location`=?,`description`=?,`quantity`=? WHERE `id`=?";
  
  $values = [$frm_data['feature_name'], $frm_data['package_type'], $frm_data['speciality_tour'], $frm_data['days'], $frm_data['price'], $frm_data['location'], $frm_data['desc'], $frm_data['quantity'], $frm_data['tour_id']];

  $res = update($q1, $values, 'sssiissii');
  echo $res;
  if($res){
    $flag = 1;
  }

  $del_features = delete("DELETE FROM `tour_features` WHERE `tour_id`=?", [$frm_data['tour_id']],'i');

  if($del_features != 1){
    $flag = 0;
  }

  $q2 = "INSERT INTO `tour_features`(`tour_id`, `features_id`) VALUES (?,?)";

  if($stmt = mysqli_prepare($con, $q2)){
    foreach($features as $f){
      mysqli_stmt_bind_param($stmt, 'ii', $frm_data['tour_id'], $f);
      mysqli_stmt_execute($stmt);
    }
    $flag = 1;
    mysqli_stmt_close($stmt);
  }
  else{
    $flag = 0;
    die('Query can not be prepared! - Insert');
  }
}

if(isset($_POST['toggle_status'])){
  $frm_data = filteration($_POST);

  $q = "UPDATE `tours` SET `status`=? WHERE  `id`=?";

  $v = [$frm_data['value'], $frm_data['toggle_status']];

  $res = update($q, $v, 'ii');
  echo $res;
}

if (isset($_POST['add_image'])) {
  $frm_data = filteration($_POST);
  $img_r = uploadImage($_FILES['image'], TOURS_FOLDER);

  if ($img_r == 'inv_img') {
    echo $img_r;
  } else if ($img_r == 'inv_size') {
    echo $img_r;
  } else if ($img_r == 'upd_failed') {
    echo $img_r;
  } else {
    $q = "INSERT INTO `tour_images`(`tour_id`, `image`) VALUES (?,?)";
    $values = [$frm_data['tour_id'], $img_r];
    $res = insert($q, $values, 'is');
    echo $res;
  }
}

if (isset($_POST['get_tour_images'])) {
  $frm_data = filteration($_POST);

  $res = select("SELECT * FROM `tour_images` WHERE `tour_id`=?", [$frm_data['get_tour_images']],'i');

  $path = TOURS_IMG_PATH;

  while($row = mysqli_fetch_assoc($res)){
    
    if($row['thumb']==1){
      $thumb_btn = "<i class='bi bi-check-lg bg-success text-light rounded px-2 py-1'></i>";  
    }
    else{
      $thumb_btn = "<button onclick='thumb_image($row[sr_no], $row[tour_id])' class='btn btn-secondary btn-sm shadow-none'><i class='bi bi-check-lg'></i></button>";
    }
    

    echo<<<data
      <tr class='align-middle'>
        <td><img src='$path$row[image]' class='img-fluid'></td>
        <td>$thumb_btn</td>
        <td>
          <button onclick='rem_image($row[sr_no], $row[tour_id])' class='btn btn-danger btn-sm shadow-none'>
          <i class='bi bi-trash'></i></button>
        </td>
      </tr>
    data;
  }
}

if (isset($_POST['rem_image'])) {
  $frm_data = filteration($_POST);
  $values = [$frm_data['image_id'],$frm_data['tour_id']];

  $pre_q = "SELECT * FROM `tour_images` WHERE `sr_no`=? AND `tour_id`=?";
  $res = select($pre_q, $values,'ii');
  $img = mysqli_fetch_assoc($res);

  if(deleteImage($img['image'], TOURS_FOLDER)){
    $q = "DELETE FROM `tour_images` WHERE `sr_no`=? AND `tour_id`=?";
    $res = delete($q, $values,'ii');
    echo $res;
  }
  else{
    echo 0;
  }
}

if (isset($_POST['thumb_image'])) {
  $frm_data = filteration($_POST);
  
  $pre_q = "UPDATE `tour_images` SET `thumb`=? WHERE `tour_id`=?";
  $pre_v = [0, $frm_data['tour_id']];
  $pre_res = update($pre_q, $pre_v, 'ii');

  $q = "UPDATE `tour_images` SET `thumb`=? WHERE `sr_no`=? AND `tour_id`=?";
  $v = [1, $frm_data['image_id'], $frm_data['tour_id']];
  $res = update($q, $v, 'iii');

  echo $res;
}

if (isset($_POST['remove_tour'])){
  $frm_data = filteration($_POST);

  $res1 = select("SELECT * FROM `tour_images` WHERE `tour_id`=?", [$frm_data['tour_id']],'i');

  while($row = mysqli_fetch_assoc($res1)){
    deleteImage($row['image'], TOURS_FOLDER);
  }

  $res2 = delete("DELETE FROM `tour_images` WHERE `tour_id`=?", [$frm_data['tour_id']],'i');

  $res3 = delete("DELETE FROM `tour_features` WHERE `tour_id`=?", [$frm_data['tour_id']],'i');

  $res4 = update("UPDATE `tours` SET `removed`=? WHERE `id`=?", [1, $frm_data['tour_id']],'ii');

  if($res2 || $res3 || $res4){
    echo 1;
  }
  else{
    echo 0;
  }
}