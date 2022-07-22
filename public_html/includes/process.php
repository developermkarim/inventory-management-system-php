<?php include('../database/constants.php'); include('../includes/user.class.php') ?>

<?php
//For Registration Processsing

if (isset($_POST['username']) and isset($_POST['email'])) {
  $username =  $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password1'];
  $usertype = $_POST['usertype'];
  $obj = new User();
  $dbMethod = $obj->CreateUser($username,$email,$password,$usertype);
  echo $dbMethod;
  exit();
}

?>