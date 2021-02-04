<?php
class functionalAreaClass
{
	public function fetchFunctionalAreaDetails()
	{
		$query="select * from admin_functional_area";
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	}
	
	public function fetchFunctionalAreaById($id)
	{
		$query="select * from admin_functional_area where id='".$id."'";
		$result=mysql_query($query);
		
		$row=mysql_fetch_array($result);
		return $row;
	}
	
	public function saveFunctionalArea($post)
	{
		$query="insert into admin_functional_area(functional_area_name,modified_date,added_date)values('".$post['name']."',CURDATE(),CURDATE())";
		
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Funactional Area Inserted";
			return true;
		}
		else
		{
			$_SESSION['message']="Funactional Area not Inserted";
			return false;
		}		
	
	}
	
	
	public function updateFunctionalArea($post)
	{
	$query="update admin_functional_area set functional_area_name='".$post['name']."', modified_date=CURDATE() where id='".$post['funId']."'";
		
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Funactional Area Updated";
			return true;
		}
		else
		{
			$_SESSION['message']="Funactional Area not Updated";
			return false;
		}		
	
	}
	
	
	
}


?>