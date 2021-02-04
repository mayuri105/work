
<?php
include("../config/dbconnect.php");
include("config/settings.php");
include("resizeimage.inc.php");

  class outlet{
  	function __construct($id=""){
		global $db;
		if($id){
		   $sql="Select * from tbl_docoutlet where id='".$id."'";
		   $res=mysql_query($sql);
		   $num=mysql_num_rows($res);
		   if($num > 0){
		   		$fields=mysql_fetch_array($res);
		   		$this->id=$fields["id"];
				$this->title=$fields["title"];
				$this->description=$fields["description"];
				$this->image=$fields["image"];
				$this->location=$fields["location"];
				$this->added_date=$fields["added_date"];
							
		   }
		   return true;
		}		
		
	}
	function getOutletInfo(){
		$Outletinfo=array("id"=>$this->id, "title"=>$this->title, "description"=>$this->description, "image"=>$this->image, "location"=>$this->location, "added_date"=>$this->added_date);			
		return $Outletinfo;	
	}
	
	
	function getOutletCount(){
		global $db;
		$sql="select * from tbl_docoutlet";
		$res=mysql_query($sql);
		$num=mysql_num_rows($res);
		if($num > 0){
			return $num;
		}else{
			return false;
		}	
	}
	function getOutletData(){
		global $db;
		$sql="select * from tbl_docoutlet";
		$res=mysql_query($sql);
		$num=mysql_num_rows($res);
		if($num > 0){
			$tbl_docoutletinfo=array();
		   	while($fields=mysql_fetch_array($res)){
				$tbl_docoutletinfo[]=array("id"=>$fields["id"], "title"=>$fields["title"], "location"=>$fields["location"], "description"=>$fields["description"], "image"=>$fields["image"], "added_date"=>$fields["added_date"]);			
			}	
			return $tbl_docoutletinfo;	
		}else{
			return false;
		}	
	}
	function addOutlet(){
		global $db;
	 	
		$sql="insert into tbl_docoutlet (title, description,location) 
		values('".$_REQUEST["txtTitle"]."','".$_REQUEST["txtDesc"]."','".$_REQUEST["txtLocation"]."')";
		$res=mysql_query($sql);
		$id=mysql_insert_id();
		if($id){
			$this->id=$id;
			$this->uploadOutletImage();	
			return $id;
		}else{
			return false;
		}
				
	}
	function editOutlet(){
		global $db;
		$sql="Update tbl_docoutlet SET 
				title='".$_REQUEST["txtTitle"]."',
				description='".$_REQUEST["txtDesc"]."',
				location='".$_REQUEST["txtLocation"]."' where id='".$_REQUEST["id"]."'";
		$res=mysql_query($sql);						
		if($res){
			$this->id=$_REQUEST["id"];
			$this->deleteOutletImageFile();	
			$this->uploadOutletImage();	
			return true;
		}else{
			return false;		
		}
	}
	
	function uploadOutletImage(){
		global $db;
		global $AppURL,$AppPATH, $SETTINGS;
		$uploaddestination=$AppPATH.$SETTINGS["images"].$SETTINGS["docoutlet_image"].$this->id."_".$_FILES["FileImg"]["name"];
		if(move_uploaded_file($_FILES["FileImg"]["tmp_name"], $uploaddestination)){
			$rimg=new image_resize($uploaddestination);									
			$filetitle=$this->id."_".$_FILES["FileImg"]["name"];
			$img=$rimg->resize(150,110,$uploaddestination);
			$sql="Update tbl_docoutlet SET image='".$filetitle."' where id='".$this->id."'";
			$res=mysql_query($sql);						
			if($res){
				return true;
			}
		}
		return true;
	}
	function deleteOutletImageFile(){
		global $db;
		global $AppURL,$AppPATH, $SETTINGS;
		if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]) ) {
			$blg=$this->getOutletInfo(" and id='".$this->id."'");
			$uploaddestination=$AppPATH.$SETTINGS["images"].$SETTINGS["docoutlet_image"].$blg[0]["image"];
			if(file_exists($uploaddestination)){
				@unlink($uploaddestination);			
				return true;
			}
		}elseif(!isset($_FILES["image"]["name"]) && isset($this->id)){
			$blg=$this->getOutletInfo(" and id='".$this->id."'");
			$uploaddestination=$AppPATH.$SETTINGS["images"].$SETTINGS["docoutlet_image"].$blg[0]["image"];
			if(file_exists($uploaddestination)){
				@unlink($uploaddestination);			
				return true;
			}
		}	
	}
	 
   function deleteOutlet($tbl_docoutletarr){
   		global $db;
		global $AppURL,$AppPATH, $SETTINGS;
		if(count($tbl_docoutletarr) > 0){
			for($i=0;$i<count($tbl_docoutletarr);$i++){
				$this->id=$tbl_docoutletarr[$i];
				$this->deleteOutletImageFile();
				$sql="DELETE from tbl_docoutlet where id='".$this->id."'";		
				$res=mysql_query($sql);
			}
			return true;
		}
		return false;
	}	
  } 
?>