<?php
class professorClass
{
	public function fetchProfessorRegisteredDetails()
	{
		$query="select p.*, p1.* from db_professor_registration as p left join db_professor_resume_details as p1 on p.id=p1.userId";
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	}
	
}

?>