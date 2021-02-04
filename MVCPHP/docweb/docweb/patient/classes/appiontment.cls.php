<?php
//error_reporting(0);
include("../config/dbconnect.php");
  class appo{
  	public $apid=false;
  	public $Patient_id=false;
	public $type=false;
	public $fname=false;
  	public $lname=false;
  	public $email=false;
  	public $address=false;
	public $contactno=false;
  	public $country=false;
	public $state=false;
	public $city=false;
  	public $gender=false;
  	public $age=false;
	public $diseases=false;
  	public $speciality=false;
	public $maultispeciality=false;
  	public $doctor=false;
	public $adate=false;
	public $atime=false;
	public $status=false;
  	public $added_date=false;
  	
  	function __construct($apid=""){
		global $db;
		if($apid){
		   $sql="select * from tbl_appointment where apid='".$apid."'";
		   $res=mysql_query($sql);
		   $num=@mysql_num_rows($res);
		    if($num > 0){
		   		$fields=mysql_fetch_array($res);
				$this->apid=$fields["apid"];
				$this->Patient_id=$fields["Patient_id"];
				$this->type=$fields["type"];
				$this->fname=$fields["fname"];
				$this->lname=$fields["lname"];
				$this->email=$fields["email"];
				$this->address=$fields["address"];
				$this->contactno=$fields["contactno"];
				$this->country=$fields["country"];
				$this->state=$fields["state"];
				$this->city=$fields["city"];
				$this->gender=$fields["gender"];
				$this->age=$fields["age"];
				$this->diseases=$fields["diseases"];
				$this->speciality=$fields["speciality"];
				$this->maultispeciality=$fields["maultispeciality"];
				$this->doctor=$fields["doctor"];
				$this->adate=$fields["adate"];
				$this->atime=$fields["atime"];
				$this->status=$fields["status"];
				$this->added_date=$fields["added_date"];
		   }
		   return true;
		}		
		
	}
	function getappoinfo(){
		$appoinfo=array("apid"=>$this->apid, "Patient_id"=>$this->Patient_id, "type"=>$this->type, "fname"=>$this->fname, "lname"=>$this->lname, "email"=>$this->email, "address"=>$this->address, "contactno"=>$this->contactno, "country"=>$this->country, "state"=>$this->state, "city"=>$this->city, "gender"=>$this->gender, "age"=>$this->age, "diseases"=>$this->diseases, "speciality"=>$this->speciality, "maultispeciality"=>$this->maultispeciality, "doctor"=>$this->doctor, "adate"=>$this->adate, "atime"=>$this->atime, "status"=>$this->status, "added_date"=>$this->added_date);			
		return $appoinfo;	
	}
	function addappo(){
		
			  $sql="insert into tbl_appointment (Patient_id, type, fname, lname, email, address, contactno, country, state, city, gender, age,diseases, speciality, maultispeciality, doctor, adate, atime) 
			values('".$_REQUEST["patid"]."','".$_REQUEST["lblApType"]."','".$_REQUEST["txtFirstName"]."','".$_REQUEST["txtLastName"]."','".$_REQUEST["txtEmail"]."','".$_REQUEST["txtAddress"]."','".$_REQUEST["txtContactno"]."','".$_REQUEST["lblCountry"]."','".$_REQUEST["lblState"]."','".$_REQUEST["lblCity"]."','".$_REQUEST["gender"]."','".$_REQUEST["txtAge"]."','".$_REQUEST["lblDiseases"]."','".$_REQUEST["lblSpeciality"]."','".$_REQUEST["txtMultiSpec"]."','".$_REQUEST["Doctor"]."','".$_REQUEST["txtDate"]."','".$_REQUEST["lblTime"]."')"; 
			$res=mysql_query($sql);
			
				
	}
	
	function deleteappo($id){
		global $db;
		 $sql="DELETE from tbl_appointment where apid='".$id."'";		
				$res=mysql_query($sql);
			
		
	}
	function getappocount(){
		global $db;
		$sql="select * from tbl_appointment";
		$res=mysql_query($sql);
		$num=@mysql_num_rows($res);
		if($num > 0){
			return $num;
		}else{
			return false;
		}	
	}
	function getappoData(){
		global $db;	
	 $sql="SELECT tbl_appointment. * , tbl_ap_time_slots.ap_time_slots, tbl_doctor.name
FROM tbl_appointment, tbl_ap_time_slots, tbl_doctor
WHERE tbl_appointment.`atime` = tbl_ap_time_slots.ap_time_slot_id
AND tbl_appointment.doctor = tbl_doctor.docid AND Patient_id= '".$_SESSION['Login_patid']."'
";
		  $res=mysql_query($sql);
		$num=@mysql_num_rows($res);
		if($num > 0){
			$appodata=array();
			   	while($fields=mysql_fetch_array($res)){
					$appodata[]=array("apid"=>$fields["apid"],"Patient_id"=>$fields["Patient_id"],"type"=>$fields["type"],"fname"=>$fields["fname"],"lname"=>$fields["lname"],"email"=>$fields["email"],"contactno"=>$fields["contactno"],"country"=>$fields["country"],"state"=>$fields["state"],"city"=>$fields["city"],"gender"=>$fields["gender"],"age"=>$fields["age"],"diseases"=>$fields["diseases"],"speciality"=>$fields["speciality"],"maultispeciality"=>$fields["maultispeciality"],"doctor"=>$fields["doctor"],"adate"=>$fields["adate"],"atime"=>$fields["atime"],"ap_time_slots"=>$fields["ap_time_slots"],"name"=>$fields["name"],"status"=>$fields["status"]);
				}	

			return $appodata;	
		}else{
			return false;
		}	
	}
	
	
	
	 
	public function editappo($id){
		//global $db;
			
			 $sql="Update tbl_appointment SET 
					type='".$_REQUEST["lblApType"]."',
					fname='".$_REQUEST["txtFirstName"]."',
					lname='".$_REQUEST["txtLastName"]."',
					email='".$_REQUEST["txtEmail"]."',
					address='".$_REQUEST["txtAddress"]."',
					contactno='".$_REQUEST["txtContactno"]."',
					country='".$_REQUEST["lblCountry"]."',
					state='".$_REQUEST["lblState"]."',
					city='".$_REQUEST["lblCity"]."',
					gender='".$_REQUEST["gender"]."',
					age='".$_REQUEST["txtAge"]."',
					diseases='".$_REQUEST["lblDiseases"]."',
					speciality='".$_REQUEST["lblSpeciality"]."',
					maultispeciality='".$_REQUEST["txtMultiSpec"]."',
					doctor='".$_REQUEST["Doctor"]."',
					adate='".$_REQUEST["txtDate"]."',
					atime='".$_REQUEST["lblTime"]."' where apid='".$id."'"; 
			$res=mysql_query($sql);						
			if($res){
				return true;
			}else{
				return false;		
			}
		
	  
	}
   
  } 
?>