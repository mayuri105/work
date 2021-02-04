<?php
class studentClass
{
	public function fetchStudentRegisteredDetails()
	{
		$query="select s.*, s1.* from db_student_registration as s left join db_student_resume_details as s1 on s.id=s1.userId";
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