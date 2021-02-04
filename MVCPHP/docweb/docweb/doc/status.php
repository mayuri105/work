

<?php
include("config/dbconnect.php");
if(isset($_GET['status']))
{
	$status=$_GET['status'];
	
	$select_status=mysql_query("select * from tbl_appointment where apid='$status'");
	
	while($row=mysql_fetch_object($select_status))
	{
		$st=$row->status;
	
	if($st=='0')
	{
		$status2=1;
	}
	else
	{
		$status2=0;
	}
	$update=mysql_query("update tbl_appointment set status='$status2' where apid='$status' ");
	if($update)
	{
		header("Location:conappointment.php");
	}
	else
	{
		echo mysql_error();
	}
	}
	?>
     
    <?php
}
?>