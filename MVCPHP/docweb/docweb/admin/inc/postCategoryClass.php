<?php
class postCategoryClass
{
	public function fetchPostCategoryDetails()
	{
		$query="select * from admin_post_category";
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
			$rows[]=$row;
		}	
		return $rows;
	}
	
	public function fetchPostCategoryById($id)
	{
		$query="select * from admin_post_category where id='".$id."'";
		$result=mysql_query($query);
		
		$row=mysql_fetch_array($result);
		return $row;
	}
	
	public function insertPostCategory($post)
	{
		$query="insert into admin_post_category(category_name,category_date_created,category_date_modified)values('".$post['name']."',CURDATE(),CURDATE())";
		
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Post Category Inserted";
			return true;
		}
		else
		{
			$_SESSION['message']="Post Category not Inserted";
			return false;
		}		
	
	}
	
	
	public function updatePostCategory($post)
	{
	$query="update admin_post_category set category_name='".$post['name']."', category_date_modified=CURDATE() where id='".$post['catId']."'";
		
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Post Category Updated";
			return true;
		}
		else
		{
			$_SESSION['message']="Post Category not Updated";
			return false;
		}		
	
	}
	
	
	public function fetchPostSubCategory()
	{
		$query="select * from admin_post_sub_category";
		$result=mysql_query($query);
		$rows=array();
		while($row=mysql_fetch_array($result))
		{
		$rows[]=$row;
		}
		return $rows;
	}
	
	
		public function insertPostSubCategory($post)
	{
		$query="insert into admin_post_sub_category(catId,subcategory_name,subcategory_date_created,subcategory_date_modified)values('".$post['catId']."','".$post['name']."',CURDATE(),CURDATE())";
		
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Post Sub Category Inserted";
			return true;
		}
		else
		{
			$_SESSION['message']="Post Sub Category not Inserted";
			return false;
		}		
	
	}
	
	public function updatePostSubCategory($post)
	{
	$query="update admin_post_sub_category set catId='".$post['catId']."', subcategory_name='".$post['name']."', subcategory_date_modified=CURDATE() where id='".$post['subCatId']."'";
		
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Post Sub Category Updated";
			return true;
		}
		else
		{
			$_SESSION['message']="Post Sub Category not Updated";
			return false;
		}		
	
	}
	
	
		public function fetchPostSubCategoryById($id)
	{
		$query="select * from admin_post_sub_category where id='".$id."'";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		return $row;
	}
	

	
}


?>