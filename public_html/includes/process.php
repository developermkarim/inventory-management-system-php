<?php include('../database/constants.php'); include('user.class.php') ?>

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
?>