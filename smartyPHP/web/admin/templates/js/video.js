//====================================================================================================
//	Function Name	:	Form_Submit(frm)
//----------------------------------------------------------------------------------------------------
function Form_Submit(frm)
{
	with(frm)
	{
		if(!IsEmpty(video_title, 'Please enter Title.'))
		{
			video_title.focus();
			return false;
		}
		if(!IsEmpty(video_desc, 'Please enter Content.'))
		{
			video_desc.focus();
			return false;
		}
		
		if(confirm('Please confirm this Video has been approved?'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
//====================================================================================================
//	Function Name	:	Edit_Click()
//----------------------------------------------------------------------------------------------------
function Edit_Click(videoId)
{
	with(document.frmVideo)
	{
		video_id.value		= videoId;
		Action.value	= 'Edit';
		submit();
	}
}
//====================================================================================================
//	Function Name	:	Preview_Click()
//----------------------------------------------------------------------------------------------------
function Preview_Click(videoId)
{
	with(document.frmVideo)
	{
		video_id.value	= videoId;	
		Action.value = 'Preview';
		submit();
	}
}
//====================================================================================================
//	Function Name	:	Add_Click()
//----------------------------------------------------------------------------------------------------

function Add_Click()
{
	with(document.frmVideo)
	{
		
		Action.value	= 'Add';
		submit();
	}
}
//====================================================================================================
//	Function Name	:	ToggleStatus_Click(videoId,state)
//----------------------------------------------------------------------------------------------------

function ToggleStatus_Click(videoId,state)
{
	 with(document.frmVideo)
	 {
		 video_id.value	= videoId;
		 status.value 	= state;
		 Action.value	= 'ChangeStatus';
		 submit();
	 }
}
//====================================================================================================
//	Function Name	:	Delete_Click()
//----------------------------------------------------------------------------------------------------
function Delete_Click(videoId)
{
	with(document.frmVideo)
	{
		if(confirm('Are you sure you wants to delete Video?'))
		{
			video_id.value 		= videoId;
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
	with(document.frmVideo)
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
			alert('Please select the record you want to delete.');
			return false;
		}
			
		if(confirm('Are you sure you want to delete selected Video(s)?'))
		{
			Action.value 	= 'DeleteSelected';
			submit();
		}
	}
}
function Order_Click()
{
	with(document.frmVideo)
	{
		Action.value 	= 'Order';
		submit();
	}
}

function Button_Click(btn)
{
	with(document.frmVideo)
	{
		Submit.value = btn.value;
		for(i=0; i<video.length; i++)
			display_order.value += video[i].value + ':';
		submit();
	}
}

function UpDown_Click(direction)
{
	var list = document.frmVideo.video;
	var tmpVal;
	var tmpText;

	if(list.selectedIndex==-1)
	{
		alert("Select the video you want to move.");
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

