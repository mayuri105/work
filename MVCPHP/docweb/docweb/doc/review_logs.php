<?php
  include("config/dbconnect.php");
	
	
  $comid=$_REQUEST['comid'];
	

	

					
	echo $sql="SELECT * FROM tbl_reply where com_id='".$comid."' order by added_date desc";
			
	$result=mysql_query($sql);

	$num_rows = mysql_num_rows($result);
	
	if($num_rows>0){
	
	while($fields=mysql_fetch_array($result)){
	if($fields['usertype']=1)
	{
	
	 $query=mysql_query("select name from tbl_doctor where docid='".$fields['user_id']."'");
	$doc_name=mysql_fetch_assoc($query);
	$reviewBy=$doc_name['name'];
	?>
		
					<p><?php echo $reviewBy ;?><span style="font-size:10px;float:right;"><?php echo $fields['added_date'];?></span></p>
                    <p style="color:red;"><?php echo $fields['msg'];?></p>
	</div>
	<?php
	}
	
	}}
	?>
	
