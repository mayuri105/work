<?php
include("../config/dbconnect.php");
if(isset($_POST['show'])){
$report=$_REQUEST['lblWeekly'];
$Diseases=$_REQUEST['lblDiseases'];
$sdate=$_REQUEST['txtDateStart'];
$edate=$_REQUEST['txtDateEnd'];

echo $sql="SELECT *
FROM `tbl_appointment`
WHERE adate
BETWEEN '$sdate' 
AND '$edate' AND diseases = '$Diseases'";
$result=mysql_query($sql);
if($result){

//header("location:showwreport.php");
}
}
 ?>