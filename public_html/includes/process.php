<?php include('../database/constants.php'); include('user.class.php');
include('./DBOperation.php'); ?>

<?php
//For Registration Processsing
$obj = new User();
if (isset($_POST['username']) and isset($_POST['email'])) {
  $username =  $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password1'];
  $usertype = $_POST['usertype'];
  
  $dbMethod = $obj->createUserAccount($username,$email,$password,$usertype);
  echo $dbMethod;
  exit();

}

/* For Login  */
  if (isset($_POST['log_email']) and isset($_POST['log_password'])) {
   $user = new User();
    $loginMethod = $user->userLogin($_POST['log_email'],$_POST['log_password']);
    echo $loginMethod;
    exit();
  }

  /* ADD catagery here  */
   if (isset($_POST['category_name']) AND isset($_POST['parent_cat'])) {
      $cat_obj = new DBOperation();
      $result = $cat_obj->Category($_POST['parent_cat'],$_POST['category_name']);
      echo $result;
      exit();
    }

    /* Add Brand Name Here */
if (isset($_POST['brand_name'])) {
  $bran_obj = new DBOperation();
  $result = $bran_obj->Add_brand($_POST['brand_name']);
  echo $result;
  exit();
}
    /* Fetch Category */
    if($_POST['Cat_data']){
      $obj = new DBOperation();
      $result = $obj->allRecords('categories');
      foreach ($result as $result_value) {
        echo "<option value='".$result_value['cid']."'>".$result_value['category_name']."</option>";
        // echo "<option value='".$row["cid"]."'>".$row["category_name"]."</option>";
      }
      exit();
    }
?>