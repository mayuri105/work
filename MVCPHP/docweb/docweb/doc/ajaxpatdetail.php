<?php
session_start();
include("config/dbconnect.php");
include("classes/patient.cls.php");
$patcls=new appo();
$patdata=$patcls->getpatdetailData($_REQUEST['patientId']);

 
for($j=0;$j<count($patdata);$j++){ ?> 
 <div class="tab-content col-md-8 col-sm-8 col-xs-7 pull-right">
                
                 <div class="fade tab-pane active in" id="a">
                    <div class="dept-title-tabs" style="background:#107FC9; color:#FFFFFF; height:45px;">Patient Detail</div>
               
    <table class="table table-bordered table-striped table-responsive">
    <tr>
                   
 <td> <strong style="color:#107FC9; font-size:16px;">Name:</strong></td><td><?php echo $patdata[$j]["fname"];?> &nbsp;<?php echo $patdata[$j]["lname"];?></td></tr>
 <tr><td>
<strong style="color:#107FC9;font-size:16px;">Email:</strong></td><td><?php echo $patdata[$j]["email"];?></td>
</tr>
<tr>
<td>
<strong style="color:#107FC9; font-size:16px;">Address:</strong></td><td><?php echo $patdata[$j]["address"];?></td>
</tr>

<tr>
<td><strong style="color:#107FC9; font-size:16px;">Gender:</strong></td><td><?php echo $patdata[$j]["gender"];?></p></td>
</tr>
<tr>
<td><strong style="color:#107FC9; font-size:16px;">Age:</strong></td><td><?php echo $patdata[$j]["age"];?></td>
</tr>
<tr>
<td><strong style="color:#107FC9; font-size:16px;">Diseases:</strong></td><td><?php echo $patdata[$j]["diseases"];?></td>
</tr>

</table>
</div>
   </div>          
                              
<?php    
  }?>
