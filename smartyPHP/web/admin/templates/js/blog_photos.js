function Validate_Form(frm)
{
	with(frm)
    {	
		if(!IsEmpty(title, 'Please, Enter Title.'))
		{
			title.focus();	
			return false;
		}
		if(!checkImageType(photo, 'Please, Upload Photo.'))
		{
			photo.focus();
			return false;
		}
		/*
		if(confirm('Please confirm this page has been approved?'))
		{
			return true;
		}
		else
		{
			return false;
		}
		*/
		return true;
	}
}

//====================================================================================================
//	Function Name	:	Edit_Click()
//----------------------------------------------------------------------------------------------------
function Edit_Click(catId)
{
	with(document.frmPhotos)
	{
		photo_id.value	= catId;
		Action.value		= 'Edit';
		submit();
	}
}
//====================================================================================================
//	Function Name	:	ToggleStatus_Click(catId,state)
//----------------------------------------------------------------------------------------------------
function ToggleStatus_Click(catId,state)
{
	 with(document.frmPhotos)
	 {
		 photo_id.value	= catId;
		 status.value 	= state;
		 Action.value	= 'ChangeStatus';
		 submit();
	 }
}
//====================================================================================================
//	Function Name	:	Delete_Click()
//----------------------------------------------------------------------------------------------------
function Delete_Click(catId)
{
	with(document.frmPhotos)
	{
		if(confirm('Are You Sure You Want to Delete?'))
		{
			photo_id.value 	= catId;
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
	with(document.frmPhotos)
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
		if(confirm('Are You Sure You Want to Delete Selected Photos?'))
		{
			Action.value 	= 'DeleteSelected';
			submit();
		}
	}
}
function Order_Click(catId)
{
	with(document.frmPhotos)
	{
		post_id.value 	= 	catId;
		Action.value 	= 	'Order';
		submit();
	}
}

function Button_Click(btn)
{
	with(document.frmPhotos)
	{
		submit.value = btn.value;
		for(i=0; i<photos.length; i++)
			display_order.value += photos[i].value + ':';
		
		submit();
	}
}

function UpDown_Click(direction)
{
	var list = document.frmPhotos.photos;
	var tmpVal;
	var tmpText;

	if(list.selectedIndex==-1)
	{
		alert("Select the photos you want to move.");
		return;
	}

	if(!list.length) return;
	
	if(direction==1)
	{
		if(list.selectedIndex == list.length-1) return;
	}
	else
		if(list.selectedIndex == 0) return;

	tmpVal 	= list.options[list.selectedIndex+direction].value;
	tmpText	= list.options[list.selectedIndex+direction].text;

	list.options[list.selectedIndex+direction].value	= list.options[list.selectedIndex].value;
	list.options[list.selectedIndex+direction].text		= list.options[list.selectedIndex].text;

	list.options[list.selectedIndex].value 	= tmpVal;
	list.options[list.selectedIndex].text 	= tmpText;

	list.selectedIndex += direction;
}
