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

  /* ADD Products with full details into database */

   if (isset($_POST["added_date"]) AND isset($_POST["product_name"])) {
      $product_obj = new DBOperation();
      $result = $product_obj->add_products(
        $_POST["select_cat"],
							$_POST["select_brand"],
							$_POST["product_name"],
							$_POST["product_price"],
							$_POST["product_qty"],
							$_POST["added_date"]
      );
      echo $result;
      exit();
    }


    /* Fetch Category */
    if($_POST['getCategory']){
      $obj = new DBOperation();
      $result = $obj->allRecords('categories');
      foreach ($result as $result_value) {
        echo "<option value='".$result_value['cid']."'>".$result_value['category_name']."</option>";
        // echo "<option value='".$row["cid"]."'>".$row["category_name"]."</option>";
      }
      exit();
    }

    /* Fetch Brand */
    if ($_POST['Brand_cat']) {
      $obj = new DBOperation();
      $result = $obj->allRecords('brands');
      foreach ($result as $res_value) {
       echo '<option value="'.$res_value['bid'].'">'.$res_value['brand_name'].'</option>';
      }
      exit();
    }
?>