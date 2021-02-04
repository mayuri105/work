<?php
require_once('connection.php');
ini_set('display_errors', '1');
$process=$_POST['process'];
$returnUrl=$_POST['returnUrl'];

function uploadFileToDestination($files,$location)

{

	$fileName=$files['name'];

	$fileLocation = $location."/".$fileName;

	if(move_uploaded_file($files['tmp_name'],$fileLocation))

	{

	    return $fileName;

	}

	else

	{

	    return false;

	}

}


function uploadResumeFileToDestination($files,$location)

{
	//$allowed_filetypes = array('.doc','.docx');
	
	 $fileName=$files['name'];

	$fileLocation = $location."/".$fileName;
	

	if(move_uploaded_file($files['tmp_name'],$fileLocation))

	{

	    return $fileName;

	}

	else

	{

	    return false;

	}
	
}


switch($process)
{
	case 'saveDiseases':	
		include_once('diseasesClass.php');
		$diseasesClass = new diseasesClass();
		$diseasesClass->addDiseases($_POST);
		header("location:../add_diseases.php");
		break;
		
	case 'editDiseases':	
		include_once('diseasesClass.php');
		$diseasesClass = new diseasesClass();
		$diseasesClass->updateDiseases($_POST);
		header("location:../add_diseases.php");
		break;
		
	case 'saveSpeciality':	
		include_once('specialityClass.php');
		$specialityClass = new specialityClass();
		$specialityClass->addSpeciality($_POST);
		header("location:../add_speciality.php");
		break;
		
	case 'editeSpeciality':	
		include_once('specialityClass.php');
		$specialityClass = new specialityClass();
		$specialityClass->updateSpeciality($_POST);
		header("location:../add_speciality.php");
		break;
		
	
	default:	
	echo "Please select proper method";


}

?>