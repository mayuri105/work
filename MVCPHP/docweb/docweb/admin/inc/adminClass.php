<?php
class adminClass
{
	
	public function fetchUserType($id)
	{
		$query="select * from user_type where id='".$id."'";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		return $row;
	}
	
	
	public function fetchAllUserResumeData($id)
	{
	
		$query="select * from resume_details where userId='".$id."'";
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}
	
public function fetchAllUserEducationData($id)
	{
	
	 $query="select * from education_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}
	
public function fetchAllUserTalentPhotoData($id)
	{
	
		$query="select * from talent_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}
	
	
public function fetchAllUserTalentVideoData($id)
	{
	
		$query="select * from talent_video_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}		
	
	
public function fetchAllUserDarePhotoData($id)
	{
	
		$query="select * from dare_sports_photo_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}
	
	
public function fetchAllUserDareVideoData($id)
	{
	
		$query="select * from dare_sports_video_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}	
	
	
public function fetchAllUserCrazyPhotoData($id)
	{
	
		$query="select * from crazy_photo_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}
	
	
public function fetchAllUserCrazyVideoData($id)
	{
	
		$query="select * from crazy_video_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}	
	
	
public function fetchAllUserReferenceVideoData($id)
	{
	
		$query="select * from refereces_video_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}
	
public function fetchAllUserReferenceLetterData($id)
	{
	
		$query="select * from refereces_letter_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}						
	
	
public function fetchAllUserLifeAudioData($id)
	{
	
		$query="select * from life_audio_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}
	
	
public function fetchAllUserLifeVideoData($id)
	{
	
		$query="select * from life_video_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}	
	
public function fetchAllUserLifeTextData($id)
	{
	
		$query="select * from life_text_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}						
		
		
public function fetchAllUserHousePhotoData($id)
	{
	
		$query="select * from house_photo_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}
	
	
public function fetchAllUserHouseVideoData($id)
	{
	
		$query="select * from house_video_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}	
	
	
public function fetchAllUserLoveAudioData($id)
	{
	
		$query="select * from love_audio_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}
	
	
public function fetchAllUserLoveVideoData($id)
	{
	
		$query="select * from love_video_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}	
	
public function fetchAllUserLoveTextData($id)
	{
	
		$query="select * from love_text_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}		
	
public function fetchAllUserHateAudioData($id)
	{
	
		$query="select * from hate_audio_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}
	
	
public function fetchAllUserHateVideoData($id)
	{
	
		$query="select * from hate_video_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}	
	
public function fetchAllUserHateTextData($id)
	{
	
		$query="select * from hate_text_details where userId='".$id."'"; 
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	
	}		


}


?>