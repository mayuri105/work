include("config/dbconnect.php");

<?PHP
 
ECHO getTimeDiff("23:30","01:30");
 
FUNCTION getTimeDiff($dtime,$atime){
 
 $nextDay=$dtime>$atime?1:0;
 $dep=EXPLODE(':',$dtime);
 $arr=EXPLODE(':',$atime);
 $diff=ABS(MKTIME($dep[0],$dep[1],0,DATE('n'),DATE('j'),DATE('y'))-MKTIME($arr[0],$arr[1],0,DATE('n'),DATE('j')+$nextDay,DATE('y')));
 $hours=FLOOR($diff/(60*60));
 $mins=FLOOR(($diff-($hours*60*60))/(60));
 $secs=FLOOR(($diff-(($hours*60*60)+($mins*60))));
 IF(STRLEN($hours)<2){$hours="0".$hours;}
 IF(STRLEN($mins)<2){$mins="0".$mins;}
 IF(STRLEN($secs)<2){$secs="0".$secs;}
 RETURN $hours.':'.$mins.':'.$secs;
}
$sql="select db_mycharan.mycharan_charan_id,db_panch_detail.*,db_panchtatva_detatil.panchatatva_name,panchatatva_img
            
            
            from db_mycharan,db_panch_detail,db_panchtatva_detatil
            
             where mycharan_prof_id='".$id1."' and
            db_mycharan.mycharan_charan_id=db_panch_detail.charan_id
            and db_panchtatva_detatil.id=db_panch_detail.panchtatva_id
 
            and date='2015-06-01'" ; 
			
			
			
			$sql = "SELECT enrollee_info.*, 
   payments.* 
FROM   enrollee_info 
       INNER JOIN payments 
               ON payments.enrollee_id = enrollee_info.e_id 
WHERE  enrollee_info.category = 'Walk In' 
       AND payments.entrydate >= Subdate(Curdate(), ";

switch ($range) {
    case "month":
        $sql .= 'INTERVAL 1 MONTH';
        break;
    case "year":
        $sql .= 'INTERVAL 1 YEAR';
        break;
    //if no match, use week
    default:
        $sql .= 'INTERVAL 1 WEEK';
}

$sql .= ')';


SELECT * FROM jokes WHERE date > DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY score DESC;        
SELECT * FROM jokes WHERE date > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER BY score DESC;
SELECT * FROM jokes WHERE date > DATE_SUB(NOW(), INTERVAL 1 MONTH) ORDER BY score DESC;


SELECT
COUNT(*) AS reports_in_week,
MIN(mydate) as week_start,
MAX(mydate) as week_end,
FROM
mytable
GROUP BY
WEEK(mydate)

///////////////////////
SELECT *
FROM `tbl_appointment`
WHERE adate
BETWEEN '2015-06-01'
AND '2015-06-24'
////////////////////
SELECT *
FROM `tbl_appointment`
WHERE adate
BETWEEN '2015-06-01'
AND '2015-06-24' AND diseases = 'aaaaa'

SELECT *
FROM tbl_appointment
WHERE month( adate )
BETWEEN 01
AND 11
LIMIT 0 , 30


?> 
<option value="<?=$alloType['id'];?>" <?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){  if($alloType['id']==$data['jimmygo_offer_type_id']) {  ?> selected="selected" <?php } }?>><?=$alloType['type_name'];?></option>
<?php
 $sql="SELECT tbl_patient. * , tbl_countries.name as conutry_name, tbl_states.name as state_name, tbl_cities.name as city_name, tbl_diseases.diseases_name
FROM tbl_patient, tbl_countries, tbl_states ,tbl_cities ,tbl_diseases
WHERE tbl_patient.`country` = tbl_countries.id
AND tbl_patient.state = tbl_states.id
AND tbl_patient.city = tbl_cities.id
AND tbl_patient.diseases = tbl_diseases.id
AND patientid = '$id'
";
?>

<tr>
<td><strong style="color:#107FC9; font-size:16px;">Country:</strong></td><td><?php echo $patdata[$j]["country"];?></td>
</tr>
<tr>
<td><strong style="color:#107FC9; font-size:16px;">State:</strong></td><td><?php echo $patdata[$j]["state"];?></td>
</tr>
<tr>
<td>
<strong style="color:#107FC9; font-size:16px;">City:</strong></td><td><?php echo $patdata[$j]["city"];?></td>
</tr>