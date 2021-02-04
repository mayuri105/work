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
	
  	
  	function __construct($pid=""){
		global $db;
		if($pid){
		   $sql="select * from tbl_patient where patientid='".$pid."'";
		   $res=mysql_query($sql);
		   $num=@mysql_num_rows($res);
		    if($num > 0){
		   		$fields=mysql_fetch_array($res);
				$this->patientid=$fields["patientid"];
				$this->usertype=$fields["usertype"];
				$this->name=$fields["name"];
				$this->username=$fields["username"];
				$this->password=$fields["password"];
				$this->birthdate=$fields["birthdate"];
				$this->gender=$fields["gender"];
				$this->marital_status=$fields["marital_status"];
				$this->country=$fields["country"];
				$this->state=$fields["state"];
				$this->city=$fields["city"];
				$this->address=$fields["address"];
				$this->email=$fields["email"];
				$this->diseases=$fields["diseases"];
				$this->contact=$fields["contact"];
				$this->added_date=$fields["added_date"];
				
		   }
		   return true;
		}		
		
	}
	function getpatinfo(){
		$patinfo=array("patientid"=>$this->patientid, "usertype"=>$this->usertype, "name"=>$this->name, "username"=>$this->username, "password"=>$this->password, "birthdate"=>$this->birthdate, "gender"=>$this->gender, "marital_status"=>$this->marital_status, "country"=>$this->country, "state"=>$this->state, "city"=>$this->city, "address"=>$this->address, "email"=>$this->email, "diseases"=>$this->diseases, "contact"=>$this->contact, "added_date"=>$this->added_date);			
		return $patinfo;	
	}
	
	
	function getpatcount(){
		global $db;
		$sql="select * from tbl_patient";
		$res=mysql_query($sql);
		$num=@mysql_num_rows($res);
		if($num > 0){
			return $num;
		}else{
			return false;
		}	
	}
	function getpatData(){
		
		global $db;
		
		  $sql="select * from tbl_appointment where  doctor= '".$_SESSION['Login_docid']."'";
		  $res=mysql_query($sql);
		$num=@mysql_num_rows($res);
		if($num > 0){
			$patdata=array();
			   	while($fields=mysql_fetch_array($res)){
					$patdata[]=array("apid"=>$fields["apid"],"Patient_id"=>$fields["Patient_id"],"type"=>$fields["type"],"fname"=>$fields["fname"],"lname"=>$fields["lname"],"email"=>$fields["email"],"address"=>$fields["address"],"contactno"=>$fields["contactno"],"country"=>$fields["country"],"state"=>$fields["state"],"city"=>$fields["city"],"gender"=>$fields["gender"],"age"=>$fields["age"],"diseases"=>$fields["diseases"],"speciality"=>$fields["speciality"],"maultispeciality"=>$fields["maultispeciality"],"doctor"=>$fields["doctor"],"adate"=>$fields["adate"],"atime"=>$fields["atime"],"status"=>$fields["status"]);
				}	

			return $patdata;	
		}else{
			return false;
		}	
		
		
	}
	
	function getpatdetailData($id){
		
		global $db;
		//$id=$_REQUEST['patientId'];
		
		 $sql="select * from tbl_appointment where Patient_id = '".$id."' and doctor= '".$_SESSION['Login_docid']."'";
		 
		  $res=mysql_query($sql);
		
		$num=@mysql_num_rows($res);
		if($num > 0){
			$apdata=array();
			   	while($fields=mysql_fetch_array($res)){
					$apdata[]=array("apid"=>$fields["apid"],"Patient_id"=>$fields["Patient_id"],"type"=>$fields["type"],"fname"=>$fields["fname"],"lname"=>$fields["lname"],"email"=>$fields["email"],"address"=>$fields["address"],"contactno"=>$fields["contactno"],"country"=>$fields["country"],"state"=>$fields["state"],"city"=>$fields["city"],"gender"=>$fields["gender"],"age"=>$fields["age"],"diseases"=>$fields["diseases"],"speciality"=>$fields["speciality"],"maultispeciality"=>$fields["maultispeciality"],"doctor"=>$fields["doctor"],"adate"=>$fields["adate"],"atime"=>$fields["atime"],"status"=>$fields["status"]);
				}	

			return $apdata;	
		}else{
			return false;
		}	
		
		
	}
	
	
	
   
  } 
?>