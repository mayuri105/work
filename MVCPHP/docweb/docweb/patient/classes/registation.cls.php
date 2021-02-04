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
	function displaydoctor()
	{
		//$query="select * from registration where id='".$id."'";
		
		$query="SELECT * FROM tbl_doctor"; 

		$result=mysql_query($query);
		
		$alldoctor=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$alldoctor[]=$rows;
		}
		
		return $alldoctor;
		
	
	}
	
 function country_list()
{
$getCountry=mysql_query("select * from tbl_countries");

$getallCountry=array();

while($rows=mysql_fetch_array($getCountry))
{
$getallCountry[]=$rows;

}
return $getallCountry;
}


function state_list($id)
{
$getState=mysql_query("select * from tbl_states where country_id='".$id."'");

$getallState=array();

while($rows=mysql_fetch_array($getState))
{
$getallState[]=$rows;
}
return $getallState;
}

 function city_list($id)
{
$getCity=mysql_query("select * from tbl_cities where state_id='".$id."'");

$getallCity=array();

while($rows=mysql_fetch_array($getCity))
{
$getallCity[]=$rows;
}
return $getallCity;
}


function time_list()
{
$getTime=mysql_query("select * from tbl_ap_time_slot");

$getallTime=array();

while($rows=mysql_fetch_array($getTime))
{
$getallTime[]=$rows;

}
return $getallTime;
}


}
 ?>