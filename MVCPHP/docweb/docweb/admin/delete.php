<?php
require_once('inc/connection.php');
$dId=$_GET['dId'];
if($dId!="")
{

$query="delete from tbl_diseases where id='".$dId."'";
$result=mysql_query($query);
if($result)
		{
		    $_SESSION['message']="Diseases Deleted";
			header('location:add_diseases.php');
			return true;
			}
			else
		{
			$_SESSION['message']="Diseases not Deleted";
			header('location:add_diseases.php');
			return false;
		}
}
$sId=$_GET['sId'];
if($sId!="")
{

$query="delete from tbl_speciality where id='".$sId."'";
$result=mysql_query($query);
if($result)
		{
		    $_SESSION['message']="Speciality Deleted";
			header('location:add_speciality.php');
			return true;
			}
			else
		{
			$_SESSION['message']="Speciality not Deleted";
			header('location:add_speciality.php');
			return false;
		}
}


?>