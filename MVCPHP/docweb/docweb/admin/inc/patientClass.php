<?php
class patientClass
{
	public function patdetail()
	{
		 $query="SELECT tbl_patient. * , tbl_diseases.diseases_name
FROM tbl_patient, tbl_diseases
WHERE tbl_patient.`diseases` = tbl_diseases.id";
		//$query="SELECT * FROM tbl_patient"; 

		$result=mysql_query($query);
		
		$allpatient=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allpatient[]=$rows;
		}
		
		return $allpatient;
		
	}
}

?>