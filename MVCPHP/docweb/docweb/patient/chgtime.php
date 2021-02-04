<?php
mysql_connect('localhost','root','');
mysql_select_db('doc');
 
?>
<?php 
$calendar .= "
<select name='atime' id='atime' class='seltime' $disable>
<option value=''>Select a Time</option>";
    			$event_date=$_GET["ctime"];
    			$taken_time_slots = array();
    		 $booking_qry = "SELECT `atime` FROM `tbl_appointment` WHERE `adate` = '$event_date'";
    			$booking_rs = mysql_query($booking_qry);
    			while($booking_row = mysql_fetch_array($booking_rs))
    			{
    				$taken_time_slots[] = $booking_row['atime'];
    			}
    			
    			$timeslots_qry = "SELECT * FROM `tbl_ap_time_slots`";
    			$timeslots_rs = mysql_query($timeslots_qry);
    			while($timeslots_row = mysql_fetch_array($timeslots_rs))
    			{
    				$event_time_slot_id = $timeslots_row['ap_time_slot_id'];
    				$calendar .= "<option value='" . $event_time_slot_id . "'";
    				if(in_array($event_time_slot_id, $taken_time_slots))
    				{
    					$calendar .= "disabled='disabled'";
    					$status = "Taken";
    				}
    				else
    				{
    					$status = "Available";
    				}
    				$calendar .= ">" . $timeslots_row['ap_time_slots'] . " - $status</option>";
    			}
    			
    		echo $calendar .= "</select>";
     

?>