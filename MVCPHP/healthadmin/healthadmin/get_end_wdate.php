<?php
require_once('inc/connection.php');
 $sweek=$_POST['sweek'];

if($sweek!='')
{
$startdate=strtotime($sweek,$sweek);
//$enddate=strtotime("+1 weeks",$startdate);
$rtdate = strtotime("+1 week", $startdate);
$try= date('Y-m-d',$rtdate);
echo $try;
}
?>