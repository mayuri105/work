<?php
include("../config/dbconnect.php");
include("config/settings.php");
include("resizeimage.inc.php");

  class news{
  	function __construct($id=""){
		global $db;
		if($id){
		   $sql="Select * from tbl_docnews where id='".$id."'";
		   $res=mysql_query($sql);
		   $num=mysql_num_rows($res);
		   if($num > 0){
		   		$fields=mysql_fetch_array($res);
		   		$this->id=$fields["id"];
				$this->title=$fields["title"];
				$this->description=$fields["description"];
				$this->image=$fields["image"];
				$this->added_date=$fields["added_date"];
							
		   }
		   return true;
		}		
		
	}
	function getNewsInfo(){
		$Newsinfo=array("id"=>$this->id, "title"=>$this->title, "description"=>$this->description, "image"=>$this->image, "added_date"=>$this->added_date);			
		return $Newsinfo;	
	}
	
	
	function getNewsCount(){
		global $db;
		$sql="select * from tbl_docnews";
		$res=mysql_query($sql);
		$num=mysql_num_rows($res);
		if($num > 0){
			return $num;
		}else{
			return false;
		}	
	}
	function getNewsData(){
		global $db;
		$sql="select * from tbl_docnews";
		$res=mysql_query($sql);
		$num=mysql_num_rows($res);
		if($num > 0){
			$tbl_docnewsinfo=array();
		   	while($fields=mysql_fetch_array($res)){
				$tbl_docnewsinfo[]=array("id"=>$fields["id"], "title"=>$fields["title"], "description"=>$fields["description"], "image"=>$fields["image"], "added_date"=>$fields["added_date"]);			
			}	
			return $tbl_docnewsinfo;	
		}else{
			return false;
		}	
	}
	function addNews(){
		global $db;
	 	
		$sql="insert into tbl_docnews (title, description) 
		values('".$_REQUEST["txtTitle"]."','".$_REQUEST["txtDesc"]."')";
		$res=mysql_query($sql);
		$id=mysql_insert_id();
		if($id){
			$this->id=$id;
			$this->uploadNewsImage();	
			return $id;
		}else{
			return false;
		}
				
	}
	function editNews(){
		global $db;
		$sql="Update tbl_docnews SET 
				title='".$_REQUEST["txtTitle"]."',
				description='".$_REQUEST["txtDesc"]."' where id='".$_REQUEST["id"]."'";
		$res=mysql_query($sql);						
		if($res){
			$this->id=$_REQUEST["id"];
			$this->deleteNewsImageFile();	
			$this->uploadNewsImage();	
			return true;
		}else{
			return false;		
		}
	}
	
	function uploadNewsImage(){
		global $db;
		global $AppURL,$AppPATH, $SETTINGS;
		$uploaddestination=$AppPATH.$SETTINGS["images"].$SETTINGS["docnews_image"].$this->id."_".$_FILES["FileImg"]["name"];
		if(move_uploaded_file($_FILES["FileImg"]["tmp_name"], $uploaddestination)){
			$rimg=new image_resize($uploaddestination);									
			$filetitle=$this->id."_".$_FILES["FileImg"]["name"];
			$img=$rimg->resize(150,110,$uploaddestination);
			$sql="Update tbl_docnews SET image='".$filetitle."' where id='".$this->id."'";
			$res=mysql_query($sql);						
			if($res){
				return true;
			}
		}
		return true;
	}
	function deleteNewsImageFile(){
		global $db;
		global $AppURL,$AppPATH, $SETTINGS;
		if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]) ) {
			$blg=$this->getNewsInfo(" and id='".$this->id."'");
			$uploaddestination=$AppPATH.$SETTINGS["images"].$SETTINGS["docnews_image"].$blg[0]["image"];
			if(file_exists($uploaddestination)){
				@unlink($uploaddestination);			
				return true;
			}
		}elseif(!isset($_FILES["image"]["name"]) && isset($this->id)){
			$blg=$this->getNewsInfo(" and id='".$this->id."'");
			$uploaddestination=$AppPATH.$SETTINGS["images"].$SETTINGS["docnews_image"].$blg[0]["image"];
			if(file_exists($uploaddestination)){
				@unlink($uploaddestination);			
				return true;
			}
		}	
	}
	 
   function deleteNews($tbl_docnewsarr){
   		global $db;
		global $AppURL,$AppPATH, $SETTINGS;
		if(count($tbl_docnewsarr) > 0){
			for($i=0;$i<count($tbl_docnewsarr);$i++){
				$this->id=$tbl_docnewsarr[$i];
				$this->deleteNewsImageFile();
				$sql="DELETE from tbl_docnews where id='".$this->id."'";		
				$res=mysql_query($sql);
			}
			return true;
		}
		return false;
	}	
  } 
?>