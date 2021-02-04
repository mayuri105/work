function Validate_Form(frm)
{
	with(frm)
    {	
		if(!IsEmpty(title, 'Please, Enter Title.'))
		{
			title.focus();
			return false;
		}
		if(blog_img.value!='')
		{
			if(!checkImageType(blog_img, 'Please, Upload Photo.'))
			{
				blog_img.focus();	
				return false;
			}
		}
		return true;
	}
}

//====================================================================================================
//	Function Name	:	Edit_Click()
//----------------------------------------------------------------------------------------------------
function Edit_Click(cityId)
{
	with(document.frmBlog)
	{
		post_id.value	= cityId;
		Action.value		= 'Edit';
		submit();
	}
}
//====================================================================================================
//	Function Name	:	Delete_Click()
//----------------------------------------------------------------------------------------------------
function Delete_Click(cityId)
{
	with(document.frmBlog)
	{
		if(confirm('Are You Sure You Want to Delete?'))
		{
			post_id.value 	= cityId;
			Action.value	= 'Delete';
			submit();
		}
	}
}
//====================================================================================================
//	Function Name	:	DeleteChecked_Click()
//----------------------------------------------------------------------------------------------------
function DeleteChecked_Click()
{
	with(document.frmBlog)
	{
		var flg=false;
		if(document.all['lists[]'].length)
		{
			for(i=0; i < document.all['lists[]'].length; i++)
			{
				if(document.all['lists[]'][i].checked)
					flg = true;
			}
		}
		else
		{
			if(document.all['lists[]'].checked)
				flg = true;
		}
		if(!flg)
		{
			alert('Please, Select the Record You Want to Delete.');
			return false;
		}
		if(confirm('Are You Sure You Want to Delete Selected Blog?'))
		{
			Action.value 	= 'DeleteSelected';
			submit();
		}
	}
}
//====================================================================================================
//	Function Name	:	ToggleStatus_Click()
//----------------------------------------------------------------------------------------------------
function ToggleStatus_Click(cityId,state)
{
	 with(document.frmBlog)
	 {
		 post_id.value	= cityId;
		 status.value 	= state;
		 Action.value	= 'ChangeStatus';
		 submit();
	 }
}

