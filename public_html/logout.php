<?php
include('./database/constants.php');
if (isset($_SESSION['userid'])) {
    session_destroy();
    unset($_SESSION['userid']);
    
}
header('location:'.DOMAIN.'/index.php');
?>