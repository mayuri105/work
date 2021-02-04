<?php
require_once('connection.php');
ini_set('display_errors', '1');
$process=$_POST['process'];
//$returnUrl=$_POST['returnUrl'];


switch($process)
{
	case 'saveSales':	
		include_once('admincls.php');
		$adminClass = new adminClass();
		$adminClass->addSales($_POST);
		header("location:../sales_register.php");
		break;
		
	case 'editSales':	
		include_once('admincls.php');
		$adminClass = new adminClass();
		$adminClass->updateSales($_POST);
		header("location:../sales_register.php");
		break;
		
	case 'saveProduct':	
		include_once('admincls.php');
		$adminClass = new adminClass();
		$adminClass->addProduct($_POST);
		header("location:../product.php");
		break;
		
	case 'editProduct':	
		include_once('admincls.php');
		$adminClass = new adminClass();
		$adminClass->updateProduct($_POST);
		header("location:../product.php");
		break;
	case 'saveassignProduct':	
		include_once('admincls.php');
		$adminClass = new adminClass();
		$adminClass->assignProduct($_POST);
		header("location:../assign_product.php");
		break;	
	
	
	case 'editassignProduct':	
		include_once('admincls.php');
		$adminClass = new adminClass();
		$adminClass->updateassignProduct($_POST);
		header("location:../assign_product.php");
		break;
	
	case 'saveStock':	
		include_once('admincls.php');
		$adminClass = new adminClass();
		$adminClass->addStock($_POST);
		header("location:../stock.php");
		break;
	case 'editStock':	
		include_once('admincls.php');
		$adminClass = new adminClass();
		$adminClass->updateStock($_POST);
		header("location:../stock.php");
		break;	
		
	case 'saveaddTarget':	
		include_once('admincls.php');
		$adminClass = new adminClass();
		$adminClass->addTarget($_POST);
		header("location:../target.php");
		break;
	case 'editTarget':	
		include_once('admincls.php');
		$adminClass = new adminClass();
		$adminClass->updateTarget($_POST);
		header("location:../target.php");
		break;	
		
	case 'saveMaterial':	
		include_once('admincls.php');
		$adminClass = new adminClass();
		$adminClass->addMaterial($_POST);
		header("location:../material.php");
		break;
	case 'editMaterial':	
		include_once('admincls.php');
		$adminClass = new adminClass();
		$adminClass->updateMaterial($_POST);
		header("location:../material.php");
		break;	
		
		
	default:	
	echo "Please select proper method";


}

?>