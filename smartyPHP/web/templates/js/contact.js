// JavaScript Document
function ValidateContact(frm)
{
	with(frm)
	{
		if(!IsEmpty(name, 'Please enter name.'))
		{
			name.value="";			
			name.focus();
			return false;
		}

		if(!IsEmail(email, 'Please enter Email Address.'))
		{
			email.value="";			
			email.focus();
			return false;
		}
				  
		if(!IsEmpty(phone_number, 'Please enter phone number.'))
		{
			phone_number.value="";			
			phone_number.focus();
			return false;
		}
		
		
		if(!IsEmpty(comments, 'Please enter Message.'))
		{
			comments.value="";			
			comments.focus();
			return false;
		}
		
		if(!IsEmpty(captcha, 'Pleae Enter CAPTCHA shown in below image.'))
		{
			captcha.focus();
			return false;
		}
		return true;
	}
}
