<?php 
session_start();
include("config/dbconnect.php");
if(isset($_REQUEST['post'])){
$comid=$_REQUEST['com_id'];
$userid=$_REQUEST['user_id'];
$utype=$_REQUEST['usertype'];

$com=$_REQUEST['msg'];
$sql="insert into tbl_reply(com_id,user_id,usertype,msg)values('$comid','$userid','$utype','$com')";
$res=mysql_query($sql) or die(mysql_error());
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<h3>Review List</h3>
                
                <?php
				
							include("config/dbconnect.php");
							$res = mysql_query("select * from tbl_patreview  order by id asc");
							while($data = mysql_fetch_array($res))
       							 {
        						?> 
                <table class="table table-bordered table-striped table-responsive" style="width:600px;">
                   <tr><td><?php echo $data['subject'];?></td>
                   <tr><td><?php echo $data['comment'];?></td></tr>
                   <tr><td id="comment_logs"></td></tr>
                 <tr><td><a id="btnreply<?php echo $data['id'];?>" onclick="testid('<?php echo $data['id'];?>')">reply</a>
                 
                  <div id="rform<?php echo $data['id'];?>" style="display:none;">
                  <form name="replyform" method="post">
                  <input type="hidden" name="com_id" id="com_id" value="<?php echo $data['id'];?>">
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['Login_docid'];?>">
                  <input type="hidden" name="usertype" value="<?php  echo $_SESSION['usertype']; ?>">
<p>Comment:<textarea name="msg"  placeholder="Comment*" id="msg"></textarea></p>
<p align="center"><input type="submit" name="post" value="post"></p>
 </form>
                
</div>
                  
                  </td></tr>
                 </table>


<script type="text/javascript">
function testid(com_id)
{

   
   		alert(com_id);
        var com_id=document.getElementById('com_id').value;
        
        
        $.ajaxSetup({type:"POST",
		  			
                url:"review_logs.php",
                data:"com_id="+com_id,
                });
				alert(com_id);
				
				
        setInterval(function() {$('#comment_logs').load('review_logs.php');}, 1000);
       
		}
   </script>
   <script type="text/javascript" src="../js/jquery.min.js"></script>
                   <script>
$(document).ready(function(){
    $("#btnreply<?php echo $data['id'];?>").click(function(){
        $("#rform<?php echo $data['id'];?>").toggle();
    });
});
</script>
                      <?php } ?>
                    
</body>
</html>
