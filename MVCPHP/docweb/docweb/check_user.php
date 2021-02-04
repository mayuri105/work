<?php
include('config/dbconnect.php');
$user = trim($_REQUEST['username']);
$res = mysql_query("SELECT * FROM tbl_doctor  where username='$user'");
if(mysql_num_rows($res)>=1)
{
echo '<span style="color:red">Already Exists ! </span>';
}
else
{
echo '<span style="color:green">Available</span>';
}
?>