<?php include('../database/constants.php'); include('../includes/user.class.php') ?>

<?php
//For Registration Processsing
$obj = new User();
if (isset($_POST['username']) and isset($_POST['email'])) {
  $username =  $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password1'];
  $usertype = $_POST['usertype'];
  
  $dbMethod = $obj->CreateUser($username,$email,$password,$usertype);
  echo $dbMethod;
  exit();

  if (isset($_POST['log_email']) and isset($_POST['log_password'])) {
   
    $loginMethod = $obj->userLogin($_POST['log_email'],$_POST['log_password']);
    echo $loginMethod;
    exit();
  }
}

?>