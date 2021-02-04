<?php
class specialityClass
{
	public function specialitydetail()
	{
		
		$query="SELECT * FROM  tbl_speciality"; 

		$result=mysql_query($query);
		
		$allspec=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allspec[]=$rows;
		}
		
		return $allspec;
		
	}
	
	public function specialitydetailById($id)
	{
		$query="select * from tbl_speciality where id='".$id."'";
		$result=mysql_query($query);
		
		$row=mysql_fetch_array($result);
		return $row;
	}
	
	
	public function addSpeciality($post)
	{
		$query="insert into tbl_speciality(speciality_name)values('".$post['name']."')";
		
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Speciality Inserted";
			return true;
		}
		else
		{
			$_SESSION['message']="Speciality not Inserted";
			return false;
		}		
	
	}
	
	
	public function updateSpeciality($post)
	{
	echo $query="update tbl_speciality set speciality_name='".$post['name']."' where id='".$post['sId']."'";
		
		$result=mysql_query($query);
		 
		if($result)
		{
			$_SESSION['message']="Speciality Updated";
			return true;
		}
		else
		{
			$_SESSION['message']="Speciality not Updated";
			return false;
		}		
	
	}
}

?>