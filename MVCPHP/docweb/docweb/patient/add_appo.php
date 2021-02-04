<?php
include("classes/appiontment.cls.php");
$apcls=new appo();
	if($_POST["act"]=="Add"){
	
		$res=$apcls->addappo();		
		
			echo "<script>alert('Appintment Book')</script>";
		echo "<script>window.location='showappo.php'</script>";
			
		}
	
	elseif( $_POST["act"]=="Edit"){
	
		$res=$apcls->editappo($_POST["apid"]);		
		
			echo "<script>alert('Appintment Update')</script>";
		echo "<script>window.location='showappo.php'</script>";
		
	}
	
?>