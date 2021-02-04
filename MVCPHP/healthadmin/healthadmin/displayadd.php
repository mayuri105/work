<?php
require_once('inc/connection.php');
$sales_id=$_POST['sales_id'];
if($sales_id!='')
{
$res=mysql_query("select * from db_sales_register where id='".$sales_id ."'");
while($data=mysql_fetch_array($res))
{
?>
<br>
<textarea cols="30"><?php echo $data['address']; ?></textarea>
<?php
}
}
?>