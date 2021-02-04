<?php
include("config/dbconnect.php");

$countryId=$_POST['country_id'];
if($countryId!='')
{
$res=mysql_query("select * from tbl_states where country_id='".$countryId ."'order by id asc");
while($data=mysql_fetch_array($res))
{
?>
<option value="<?php echo $data['id']; ?>"><?php echo $data['name'];?></option>
<?php
}
}
else
{?>
<option value="">Please First Select Country</option>

<?php }
?>