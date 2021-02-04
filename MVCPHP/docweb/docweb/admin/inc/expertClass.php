<?php
class expertClass
{
	public function fetchFunctionalArea()
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
	
	
	public function saveExpert($post,$files)
	{
	
		$file=uploadResumeFileToDestination($files,'../upload/photo');
	
		$query="insert into admin_experts(expert_title, expert_name, expert_email, expert_skype_id, expert_functional_area, expert_photo, expert_added)values('".$post['title']."','".$post['name']."','".$post['email']."','".$post['skype']."','".$post['fun_area']."','".$file."',now())";
		
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Expert Added";
			return true;
		}
		else
		{
			$_SESSION['message']="Expert Not Added";
			return false;
		}		
	
	}
	
	

	
	public function fetchExperts()
	{
		$query="select * from admin_experts";
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
		$rows[]=$row;
		}
		return $rows;
	}
	
	

	
	public function editExpert($post,$files)
	{
	
	$file=uploadResumeFileToDestination($files,'../upload/photo');
	
	if($file=='')
	{
	$query="update admin_experts set expert_title='".$post['title']."', expert_name='".$post['name']."', expert_email='".$post['email']."', expert_skype_id='".$post['skype']."', expert_functional_area= '".$post['fun_area']."', expert_modified=now() where id='".$post['expertId']."'";
		
	$result=mysql_query($query);
	}
	else
	{
	$query="update admin_experts set expert_title='".$post['title']."', expert_name='".$post['name']."', expert_email='".$post['email']."', expert_skype_id='".$post['skype']."', expert_functional_area= '".$post['fun_area']."', expert_photo='".$file."', expert_modified=now() where id='".$post['expertId']."'";
		
	$result=mysql_query($query);
	}	
		
		if($result)
		{
			$_SESSION['message']="Expert Updated";
			return true;
		}
		else
		{
			$_SESSION['message']="Expert not Updated";
			return false;
		}		
	
	}
	
	
		public function fetchExpertById($id)
	{
		$query="select * from admin_experts where id='".$id."'";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		return $row;
	}
	

	
}


?>