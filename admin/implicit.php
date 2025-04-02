<?php  
session_start();
//session_id("6mcbv9iu48fhmtq06q25v7kfkl");
$_SESSION['user_id'] = 100;
$_SESSION['user_role'] = 200;
header("location:index.php");
//echo session_id();
//print_r(session_id());
?>