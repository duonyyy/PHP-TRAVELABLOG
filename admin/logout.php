<?php  
session_start();
/*unset($_SESSION['user_id']);
unset($_SESSION['user_role']);*/
//$_SESSION=[];
session_destroy();
header("location:login.php");
?>