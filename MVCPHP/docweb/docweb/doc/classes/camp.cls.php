<?php
include("../config/dbconnect.php");
include("config/settings.php");
include("resizeimage.inc.php");

  class camp{
  	function __construct($id=""){
		global $db;
		if($id){
		   $sql="Select * from tbl_doccamp where id='".$id."'";
		   $res=mysql_query($sql);
		   $num=mysql_num_rows($res);
		   if($num > 0){
		   		$fields=mysql_fetch_array($res);
		   		$this->id=$fields["id"];
				$this->subject=$fields["subject"];
				$this->description=$fields["description"];
				$this->location=$fields["location"];
				$this->start_date=$fields["start_date"];
				$this->end_date=$fields["end_date"];
				$this->ctime=$fields["ctime"];
				$this->added_date=$fields["added_date"];
							
		   }
		   return true;
		}		
		
	}
	function getCampInfo(){
		$Outletinfo=array("id"=>$this->id, "subject"=>$this->subject, "description"=>$this->description, "location"=>$this->location, "start_date"=>$this->start_date, "end_date"=>$this->end_date, "ctime"=>$this->ctime, "added_date"=>$this->added_date);			
		return $Outletinfo;	
	}
	
	
	function getCampCount(){
		global $db;
		$sql="select * from tbl_doccamp";
		$res=mysql_query($sql);
		$num=mysql_num_rows($res);
		if($num > 0){
			return $num;
		}else{
			return false;
		}	
	}
	function getCampData(){
		global $db;
		$sql="select * from tbl_doccamp";
		$res=mysql_query($sql);
		$num=mysql_num_rows($res);
		if($num > 0){
			$tbl_doccampinfo=array();
		   	while($fields=mysql_fetch_array($res)){
				$tbl_doccampinfo[]=array("id"=>$fields["id"], "subject"=>$fields["subject"], "description"=>$fields["description"], "location"=>$fields["location"], "start_date"=>$fields["start_date"], "end_date"=>$fields["end_date"], "ctime"=>$fields["ctime"], "added_date"=>$fields["added_date"]);			
			}	
			return $tbl_doccampinfo;	
		}else{
			return false;
		}	
	}
	function addCamp(){
		global $db;
	 	
		$sql="insert into tbl_doccamp (subject, description,location,start_date,end_date,ctime) 
		values('".$_REQUEST["txtSubject"]."','".$_REQUEST["txtDesc"]."','".$_REQUEST["txtLocation"]."','".$_REQUEST["txtSdate"]."','".$_REQUEST["txtEdate"]."','".$_REQUEST["txtTime"]."')";
		$res=mysql_query($sql);
		if($res){
				return true;
			}else{
				return false;		
			}
				
	}
	function editCamp(){
		global $db;
		 $sql="Update tbl_doccamp SET 
				subject='".$_REQUEST["txtSubject"]."',
				description='".$_REQUEST["txtDesc"]."',
				location='".$_REQUEST["txtLocation"]."',
				start_date='".$_REQUEST["txtSdate"]."',
				end_date='".$_REQUEST["txtEdate"]."',
				ctime='".$_REQUEST["txtTime"]."' where id='".$_REQUEST["id"]."'";
		$res=mysql_query($sql);						
			if($res){
				return true;
			}else{
				return false;		
			}
	}
	
	
	
	 
  function deleteCamp($camparr){
		global $db;
		if(count($camparr) > 0){
			for($i=0;$i<count($camparr);$i++){
				$sql="DELETE from tbl_doccamp where id='".$camparr[$i]."'";		
				$res=mysql_query($sql);
			}
			return true;
		}
		return false;
	}
  } 
?>