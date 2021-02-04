<?php
class diseasesClass
{
	public function diseasesdetail()
	{
		
		  $query="SELECT * FROM tbl_diseases"; 

		$result=mysql_query($query);
		
		$allDiseases=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allDiseases[]=$rows;
		}
		
		return $allDiseases;
		
	}
	
	public function diseasesdetailyById($id)
	{
		$query="select * from tbl_diseases where id='".$id."'";
		$result=mysql_query($query);
		
		$row=mysql_fetch_array($result);
		return $row;
	}
	
	
	public function addDiseases($post)
	{
		$query="insert into tbl_diseases(diseases_name)values('".$post['name']."')";
		
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Diseases Inserted";
			return true;
		}
		else
		{
			$_SESSION['message']="Diseases not Inserted";
			return false;
		}		
	
	}
	
	
	public function updateDiseases($post)
	{
	echo $query="update tbl_diseases set diseases_name='".$post['name']."' where id='".$post['dId']."'";
		
		$result=mysql_query($query);
		 
		if($result)
		{
			$_SESSION['message']="Diseases Updated";
			return true;
		}
		else
		{
			$_SESSION['message']="Diseases not Updated";
			return false;
		}		
	
	}
}

?>