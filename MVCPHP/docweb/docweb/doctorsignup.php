
<?php
include("config/dbconnect.php");
if(isset($_REQUEST['btnDocSignup'])){
		$name = $_POST["txtName"];
		$uname = $_POST["txtDocUsername"];
		$password = $_POST['txtPassword'];
		$gender = $_POST["gender"];
		$clincname=$_POST['txtClinicName'];
		$country = $_POST["lblCountry"];
		$state = $_POST["lblState"];
		$city = $_POST['lblCity'];
		$address = $_POST["txtAddress"];
		$email = $_POST["txtEmail"];
		$speciality = $_POST['lblSpeciality'];
		$contact=$_POST['txtContactno'];
		$econtact=$_POST['txtEmergencyNo'];
		$biod_file=$_FILES['biodata']['name'];
   		$filemove=$_FILES['biodata']['tmp_name'];
   		$path="doc_biodata/".$biod_file;
    	move_uploaded_file($filemove, $path);
		//move_uploaded_file($_FILES['biodata']['tmp_name'], 'images/doc_biodata'.$_FILES['biodata']['name']);
		//$biopath=$_FILES['biodata']['name'];
		
		
		mysql_query("INSERT INTO tbl_doctor(name,username,password,
		gender,clinic_name,country,state,city,address,email,speciality,contactno,emg_contact,doc_biodata) VALUES ('$name','$uname','$password','$gender','$clincname','$country','$state','$city','$address','$email','$speciality','$contact','$econtact','$biod_file')");
		
		echo "<script>alert('Register Done Login Continue')</script>";
		echo "<script>window.location='index.php'</script>";
		//header("location:index.php");
		
		
}
?>