<?php
include("classes/outlet.cls.php");
$apcls=new outlet();
	if($_POST["act"]=="Add"){
	
		$res=$apcls->addOutlet();		
		
			echo "<script>alert('add Outlet ')</script>";
		echo "<script>window.location='showOutlet.php'</script>";
			
		}
	
	elseif( $_POST["act"]=="Edit"){
	
		$res=$apcls->editOutlet($_POST["id"]);		
		
			echo "<script>alert('Outlet Update')</script>";
		echo "<script>window.location='showOutlet.php'</script>";
		
	}
	
?>