

<?php

include("config/dbconnect.php");
session_start();
if(isset($_REQUEST['btnLogin'])){
$Uname = $_POST["txtUsername"];
$Pass = $_POST["txtPassword"];
$type = $_POST["LoginType"];

if($type=='1')
		{

		$sql="SELECT * FROM tbl_doctor where username='".$Uname."' AND password='".$Pass."'";
		$result = mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		
		$rows=mysql_num_rows($result);
		
		if($rows)
		{
		$_SESSION['username']=$row['username'];
		 $_SESSION['speciality']=$row['speciality'];
		$_SESSION['Login_docid']=$row['docid'];
		 $_SESSION['usertype']=$row['usertype'];
		header("location:doc/index.php");		
		}
		
}
else{
 $sql="SELECT * FROM tbl_patient where username='".$Uname."' AND password='".$Pass."'"; 
		$result = mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		
		$rows=mysql_num_rows($result);
		if($rows)
		{
		$_SESSION['username']=$row['username'];
		$_SESSION['Login_patid']=$row['patientid'];
		header("location:patient/index.php");		
		}
}
		
		echo "<script>alert('Invalid Login Try again!!!')</script>";
		echo "<script>window.location='index.php'</script>";
		
}
?>