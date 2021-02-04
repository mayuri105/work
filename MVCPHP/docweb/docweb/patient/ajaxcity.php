<?php
include("config/dbconnect.php");

$stateId=$_POST['state_id'];
if($stateId!='')
{
$res=mysql_query("select * from tbl_cities where state_id='".$stateId."' order by id asc");
while($data=mysql_fetch_array($res))
{
?>
<option value="<?php echo $data['id']; ?>"><?php echo $data['name'];?></option>
<?php
}
}
else
{?>
<option value="">Please First Select State</option>

<?php }
?>
