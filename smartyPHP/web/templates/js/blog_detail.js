// JavaScript Document

function Validate_Form(frm)
{
	with(frm)
    {	
		if(!IsEmpty(comment_by, 'Please, Enter Name.'))
		{
			comment_by.value = '';
			comment_by.focus();
			return false;
		}
		
		if(!IsEmpty(comment_email, 'Please, Enter Email.'))
		{
			comment_email.value = '';
			comment_email.focus();
			return false;
		}
		if(!IsEmail(comment_email, 'Please, Enter Valid Email.'))
		{
			comment_email.focus();
			return false;
		}
		
		if(!IsEmpty(comment, 'Please, Enter Comment.'))
		{
			comment.value = '';
			comment.focus();
			return false;
		}
		if(!IsEmpty(captcha, 'Please enter the captcha.'))
		{
			captcha.value = '';
			captcha.focus();
			return false;
		}
		return true;
	}
}