<?php
include("classes/camp.cls.php");
$apcls=new camp();
	if($_POST["act"]=="Add"){
	
		$res=$apcls->addCamp();		
		
			echo "<script>alert('add Camp ')</script>";
		echo "<script>window.location='showcamp.php'</script>";
			
		}
	
	elseif( $_POST["act"]=="Edit"){
	
		$res=$apcls->editCamp($_POST["id"]);		
		
			echo "<script>alert('Camp Update')</script>";
		echo "<script>window.location='showcamp.php'</script>";
		
	}
	
?>