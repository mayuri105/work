<?php
class industryTypeClass
{
	public function fetchIndustryTypeDetails()
	{
		$query="select * from admin_industry_type";
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	}
	
	public function fetchIndustryTypeById($id)
	{
		$query="select * from admin_industry_type where id='".$id."'";
		$result=mysql_query($query);
		
		$row=mysql_fetch_array($result);
		return $row;
	}
	
	public function saveIndustryType($post)
	{
		$query="insert into admin_industry_type(industry_type_name,modified_date,added_date)values('".$post['name']."',CURDATE(),CURDATE())";
		
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Industry Type Inserted";
			return true;
		}
		else
		{
			$_SESSION['message']="Industry Type not Inserted";
			return false;
		}		
	
	}
	
	
	public function updateIndustryType($post)
	{
	$query="update admin_industry_type set industry_type_name='".$post['name']."', modified_date=CURDATE() where id='".$post['indId']."'";
		
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Industry Type Updated";
			return true;
		}
		else
		{
			$_SESSION['message']="Industry Type not Updated";
			return false;
		}		
	
	}
	
	
	
}


?>