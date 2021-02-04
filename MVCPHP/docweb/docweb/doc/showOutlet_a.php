<?php
include("classes/appiontment.cls.php");
$apcls=new appo();

if(isset($_REQUEST["act"]) && $_REQUEST["act"]=="Delete"){
	  if(isset($_REQUEST["chkappo"]) && count($_REQUEST["chkappo"]) > 0){
			$del=$apcls->deleteappo($_REQUEST["chkappo"]);
			if($del){
				echo "<script>alert('Appintment Delete')</script>";
		echo "<script>window.location='showappo.php'</script>";
			
			}else{
				echo "<script>alert('There are some problem while deleting the Record(s). Please try again.')</script>";
				header("Location:showappo.php");
				exit;
			}
	  }
}



?>