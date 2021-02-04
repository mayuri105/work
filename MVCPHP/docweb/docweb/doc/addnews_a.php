<?php
include("classes/news.cls.php");
$apcls=new news();
	if($_POST["act"]=="Add"){
	
		$res=$apcls->addNews();		
		
			echo "<script>alert('add News ')</script>";
		echo "<script>window.location='showNews.php'</script>";
			
		}
	
	elseif( $_POST["act"]=="Edit"){
	
		$res=$apcls->editNews($_POST["id"]);		
		
			echo "<script>alert('News Update')</script>";
		echo "<script>window.location='showNews.php'</script>";
		
	}
	
?>