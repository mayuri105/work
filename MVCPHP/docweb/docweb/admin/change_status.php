<?php
require_once('inc/connection.php');
if($_GET['jobseekerId']!="")
{
		
		if($_GET['status']=='0')
		{
			$status="1";	
		 $sql="update db_jobseeker_registration set jobseeker_status='".$status."' where id='".$_GET['jobseekerId']."'";
		}
		if($_GET['status']=='1')
		{
			$status="0";	
		   $sql="update db_jobseeker_registration set jobseeker_status='".$status."' where id='".$_GET['jobseekerId']."'";
		}
		$res=mysql_query($sql);
		if($res==1)
		{
			header("location:jobseeker.php");
		}
		else
		{
			header("location:jobseeker.php");
		}
}


if($_GET['studentId']!="")
{
		
		if($_GET['status']=='0')
		{
			$status="1";	
		 $sql="update db_student_registration set student_status='".$status."' where id='".$_GET['studentId']."'";
		}
		if($_GET['status']=='1')
		{
			$status="0";	
		   $sql="update db_student_registration set student_status='".$status."' where id='".$_GET['studentId']."'";
		}
		$res=mysql_query($sql);
		if($res==1)
		{
			header("location:student.php");
		}
		else
		{
			header("location:student.php");
		}
}

if($_GET['professorId']!="")
{
		
		if($_GET['status']=='0')
		{
			$status="1";	
		 $sql="update db_professor_registration set professor_status='".$status."' where id='".$_GET['professorId']."'";
		}
		if($_GET['status']=='1')
		{
			$status="0";	
		   $sql="update db_professor_registration set professor_status='".$status."' where id='".$_GET['professorId']."'";
		}
		$res=mysql_query($sql);
		if($res==1)
		{
			header("location:professor.php");
		}
		else
		{
			header("location:professor.php");
		}
}


if($_GET['companyId']!="")
{
		
		if($_GET['cstatus']=='0')
		{
		 $status="1";	
		 $sql="update db_company_registration set company_status='".$status."' where id='".$_GET['companyId']."'";
		}
		if($_GET['cstatus']=='1')
		{
		   $status="0";	
		   $sql="update db_company_registration set company_status='".$status."' where id='".$_GET['companyId']."'";
		}
		$res=mysql_query($sql);
		if($res==1)
		{
			header("location:company.php");
		}
		else
		{
			header("location:company.php");
		}
}	


if($_GET['catid']!="")
{
		
		if($_GET['catstatus']=='0')
		{
			$status="1";	
		  $sql="update admin_post_category set category_status='".$status."' where id='".$_GET['catid']."'";
		}
		if($_GET['catstatus']=='1')
		{
			$status="0";	
		   $sql="update admin_post_category set category_status='".$status."' where id='".$_GET['catid']."'";
		}
		$res=mysql_query($sql);
		if($res==1)
		{
			header("location:post-category.php");
		}
		else
		{
			header("location:post-category.php");
		}
}	

if($_GET['subcatid']!="")
{
	
		if($_GET['substatus']=='0')
		{
			$status="1";
		
		$sql="update admin_post_sub_category set subcategory_status='".$status."' where id='".$_GET['subcatid']."'";
		}
		if($_GET['substatus']=='1')
		{
			$status="0";	
	    $sql="update admin_post_sub_category set subcategory_status='".$status."' where id='".$_GET['subcatid']."'"; 
		}
		$res=mysql_query($sql);
		if($res==1)
		{
			header("location:post-subcategory.php");
		}
		else
		{
			header("location:post-subcategory.php");
		}
}

if($_GET['funid']!="")
{
	
		if($_GET['funstatus']=='0')
		{
			$status="1";
		
		$sql="update admin_functional_area set status='".$status."' where id='".$_GET['funid']."'";
		}
		if($_GET['funstatus']=='1')
		{
			$status="0";	
	    $sql="update admin_functional_area set status='".$status."' where id='".$_GET['funid']."'"; 
		}
		$res=mysql_query($sql);
		if($res==1)
		{
			header("location:functional-area.php");
		}
		else
		{
			header("location:functional-area.php");
		}
}	


if($_GET['indid']!="")
{
	
		if($_GET['indstatus']=='0')
		{
			$status="1";
		
		$sql="update admin_industry_type set status='".$status."' where id='".$_GET['indid']."'";
		}
		if($_GET['indstatus']=='1')
		{
		$status="0";	
	    $sql="update admin_industry_type set status='".$status."' where id='".$_GET['indid']."'"; 
		}
		$res=mysql_query($sql);
		if($res==1)
		{
			header("location:industry-type.php");
		}
		else
		{
			header("location:industry-type.php");
		}
}	


if($_GET['expertId']!="")
{
	
		if($_GET['expertStatus']=='0')
		{
			$status="1";
		
		$sql="update admin_experts set expert_status='".$status."' where id='".$_GET['expertId']."'";
		}
		if($_GET['expertStatus']=='1')
		{
		$status="0";	
	    $sql="update admin_experts set expert_status='".$status."' where id='".$_GET['expertId']."'"; 
		}
		$res=mysql_query($sql);
		if($res==1)
		{
			header("location:experts.php");
		}
		else
		{
			header("location:experts.php");
		}
}	





	
?>