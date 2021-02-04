<?php
require_once('inc/connection.php');
$sId=$_GET['sId'];
if($sId!="")
{

$query="delete from db_sales_register where id='".$sId."'";
$result=mysql_query($query);
if($result)
		{
		    $_SESSION['message']="Sales Deleted";
			header('location:sales_register.php');
			return true;
			}
			else
		{
			$_SESSION['message']="Sales not Deleted";
			header('location:sales_register.php');
			return false;
		}
}

$pId=$_GET['pId'];
if($pId!="")
{

$query="delete from db_product_type where id='".$pId."'";
$result=mysql_query($query);
if($result)
		{
		    $_SESSION['message']="Product Deleted";
			header('location:product.php');
			return true;
			}
			else
		{
			$_SESSION['message']="Product not Deleted";
			header('location:product.php');
			return false;
		}
}

$apId=$_GET['apId'];
if($apId!="")
{

$query="delete from db_assignto_salesdept where id='".$apId."'";
$result=mysql_query($query);
if($result)
		{
		    $_SESSION['message']=" Assign Product Deleted";
			header('location:assign_product.php');
			return true;
			}
			else
		{
			$_SESSION['message']=" Assign Product not Deleted";
			header('location:assign_product.php');
			return false;
		}
}


$skId=$_GET['skId'];
if($skId!="")
{

$query="delete from db_stock where id='".$skId."'";
$result=mysql_query($query);
if($result)
		{
		    $_SESSION['message']=" Stock Deleted";
			header('location:stock.php');
			return true;
			}
			else
		{
			$_SESSION['message']=" Stock not Deleted";
			header('location:stock.php');
			return false;
		}
}

$orderId=$_GET['orderId'];
if($orderId!="")
{

$query="delete from db_order where id='".$orderId."'";
$result=mysql_query($query);
if($result)
		{
		    $_SESSION['message']=" Order Deleted";
			header('location:order_display.php');
			return true;
			}
			else
		{
			$_SESSION['message']=" Order not Deleted";
		header('location:order_display.php');
			return false;
		}
}

$taId=$_GET['taId'];
if($taId!="")
{

$query="delete from db_target where id='".$taId."'";
$result=mysql_query($query);
if($result)
		{
		    $_SESSION['message']=" target Deleted";
			header('location:target.php');
			return true;
			}
			else
		{
			$_SESSION['message']=" target not Deleted";
		header('location:target.php');
			return false;
		}
}
$shopId=$_GET['shopId'];
if($shopId!="")
{

$query="delete from db_shop_register where id='".$shopId."'";
$result=mysql_query($query);
if($result)
		{
		    $_SESSION['message']=" Shop Deleted";
			header('location:shop_display.php');
			return true;
			}
			else
		{
			$_SESSION['message']=" Shop not Deleted";
		header('location:shop_display.php');
			return false;
		}
}
$cashId=$_GET['cashId'];
if($cashId!="")
{

$query="delete from db_payment_cash where id='".$cashId."'";
$result=mysql_query($query);
if($result)
		{
		    $_SESSION['message']=" Payment Deleted";
			header('location:payment_cash.php');
			return true;
			}
			else
		{
			$_SESSION['message']=" Payment not Deleted";
		header('location:payment_cash.php');
			return false;
		}
}

$chequeId=$_GET['chequeId'];
if($chequeId!="")
{

$query="delete from db_payment_cheque where id='".$chequeId."'";
$result=mysql_query($query);
if($result)
		{
		    $_SESSION['message']="Payment Deleted";
			header('location:payment_cheque.php');
			return true;
			}
			else
		{
			$_SESSION['message']=" Payment not Deleted";
		header('location:payment_cheque.php');
			return false;
		}
}

$mId=$_GET['mId'];
if($mId!="")
{

$query="delete from db_adv_material where id='".$mId."'";
$result=mysql_query($query);
if($result)
		{
		    $_SESSION['message']="Material Deleted";
			header('location:material.php');
			return true;
			}
			else
		{
			$_SESSION['message']=" Material not Deleted";
		header('location:material.php');
			return false;
		}
}
$amId=$_GET['amId'];
if($amId!="")
{

$query="delete from db_addadv_material where id='".$amId."'";
$result=mysql_query($query);
if($result)
		{
		    $_SESSION['message']="Material Deleted";
			header('location:material_display.php.php');
			return true;
			}
			else
		{
			$_SESSION['message']=" Material not Deleted";
		header('location:material_display.php');
			return false;
		}
}
?>