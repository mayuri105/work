<?php
require_once('inc/connection.php');
if($_GET['productId']!="")
{
		
		if($_GET['status']=='0')
		{
			$status="1";	
		 $sql="update db_product_type set status='".$status."' where id='".$_GET['productId']."'";
		}
		if($_GET['status']=='1')
		{
			$status="0";	
		   $sql="update db_product_type set status='".$status."' where id='".$_GET['productId']."'";
		}
		$res=mysql_query($sql);
		if($res==1)
		{
			header("location:product.php");
		}
		else
		{
			header("location:product.php");
		}
}


if($_GET['salesId']!="")
{
		
		if($_GET['status']=='0')
		{
			$status="1";	
		 $sql="update db_sales_register set status='".$status."' where id='".$_GET['salesId']."'";
		}
		if($_GET['status']=='1')
		{
			$status="0";	
		   $sql="update db_sales_register set status='".$status."' where id='".$_GET['salesId']."'";
		}
		$res=mysql_query($sql);
		if($res==1)
		{
			header("location:sales_register.php");
		}
		else
		{
			header("location:sales_register.php");
		}
}






	
?>