<?php
class doctorClass
{
	public function docdetail()
	{
		 $query="SELECT tbl_doctor. * , tbl_speciality.speciality_name
FROM tbl_doctor, tbl_speciality
WHERE tbl_doctor.`speciality` = tbl_speciality.id";
		//$query="SELECT * FROM tbl_doctor"; 

		$result=mysql_query($query);
		
		$alldoc=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$alldoc[]=$rows;
		}
		
		return $alldoc;
		
	}
}

?>