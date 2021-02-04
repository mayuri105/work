<?php
include("config/dbconnect.php");
if(isset($_REQUEST['btnPatSignup'])){
		$name = $_POST["txtName"];
		$uname = $_POST["txtUsername"];
		$password = $_POST['txtPassword'];
		$bdate = $_POST["txtBdate"];
		$gender = $_POST["gender"];
		$mstatus = $_POST['lblMstatus'];
		$country = $_POST["lblCountry"];
		$state = $_POST["lblState"];
		$city = $_POST['lblCity'];
		$address=$_POST['txtAddress'];
		$email=$_POST['txtEmail'];
		$diseases=$_POST['lblDiseases'];
		$contact=$_POST['txtContactno'];		
		
		$sql="INSERT INTO tbl_patient(name,username,password,birthdate,gender,marital_status,country,state,city,address,email,diseases,contact) VALUES ('$name','$uname','$password','$bdate','$gender','$mstatus','$country','$state','$city','$address','$email','$diseases','$contact')";
	mysql_query($sql) or die (mysql_error());
		
		echo "<script>alert('Register Done Login Continue')</script>";
		echo "<script>window.location='index.php'</script>";
		//header("location:index.php");
		
		
}
?>