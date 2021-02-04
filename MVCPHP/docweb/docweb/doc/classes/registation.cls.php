<?php
require_once("config/dbconnect.php");
class registerClass
{
function displayUserType()
	{
		//$query="select * from registration where id='".$id."'";
		
		$query="SELECT * FROM tbl_usertype"; 

		$result=mysql_query($query);
		
		$allUser=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allUser[]=$rows;
		}
		
		return $allUser;
		
	
	}
	
	function displayspecility()
	{
		//$query="select * from registration where id='".$id."'";
		
		$query="SELECT * FROM tbl_speciality"; 

		$result=mysql_query($query);
		
		$allspeciality=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allspeciality[]=$rows;
		}
		
		return $allspeciality;
		
	
	}
	
	function displaydiseases()
	{
		//$query="select * from registration where id='".$id."'";
		
		$query="SELECT * FROM tbl_diseases"; 

		$result=mysql_query($query);
		
		$alldiseases=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$alldiseases[]=$rows;
		}
		
		return $alldiseases;
		
	
	}
}
 ?>