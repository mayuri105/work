<?php 
session_start();
setcookie("username","", time()-3600); 
setcookie("pass","", time()-3600); 
session_unset();
header('location:index.php');
?>