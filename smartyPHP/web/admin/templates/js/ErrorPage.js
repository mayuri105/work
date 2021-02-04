//====================================================================================================
//	Function Name	:	Validate_Form
//----------------------------------------------------------------------------------------------------
function Validate_Form(frm)
{ 
	with(frm)
    {	
		
		if(IsEmpty(error_page_content, 'Please Enter Cantent.'))
		{
			error_page_content.value = '';
			error_page_content.focus();
			return false;
		}
		return true;
	}
}
 
