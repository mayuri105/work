
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

 function country_list()
{
$getCountry=mysql_query("select * from tbl_countries");
echo $getCountry;
$getallCountry=array();

while($rows=mysql_fetch_array($getCountry))
{
$getallCountry[]=$rows;

}
return $getallCountry;
}


 function state_list()
{
$getState=mysql_query("select * from tbl_states");

$getallState=array();

while($rows=mysql_fetch_array($getState))
{
$getallState[]=$rows;
}
return $getallState;
}

 function city_list()
{
$getCity=mysql_query("select * from tbl_cities" );

$getallCity=array();

while($rows=mysql_fetch_array($getCity))
{
$getallCity[]=$rows;
}
return $getallCity;
}

	
	
}
 ?>