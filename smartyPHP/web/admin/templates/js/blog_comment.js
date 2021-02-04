function Validate_Form(frm)
{
	with(frm)
    {	
		if(!IsEmpty(comment_by, 'Please, Enter Name.'))
		{
			comment_by.focus();
			return false;
		}
		
		if(!IsEmail(comment_email, 'Please, Enter Email.'))
		{
			comment_email.focus();
			return false;
		}
		
		if(!IsEmpty(comment, 'Please, Enter Comment.'))
		{
			comment.focus();
			return false;
		}
		return true;
	}
}

function Delete_Click(cityId)
{
	with(document.frmBlogComments)
	{
		if(confirm('Are You Sure You Want to Delete?'))
		{
			id.value	 	= cityId;
			Action.value	= 'Delete';
			submit();
		}
	}
}

function ToggleStatus_Click(cityId,state)
{
	 with(document.frmBlogComments)
	 {
		 id.value		= cityId;
		 status.value 	= state;
		 Action.value	= 'ChangeStatus';
		 submit();
	 }
}

function DeleteChecked_Click()
{
	with(document.frmBlogComments)
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
		if(confirm('Are You Sure You Want to Delete?'))
		{
			Action.value 	= 'DeleteSelected';
			submit();
		}
	}
}

function Edit_Click(cityId)
{
	with(document.frmBlogComments)
	{
		id.value		= cityId;
		Action.value	= 'Edit';
		submit();
	}
}
