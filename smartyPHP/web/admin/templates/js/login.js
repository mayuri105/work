function Form_Submit(frm)
{
	with(frm)
    {
    	if(!IsEmpty(username, 'Please Enter Username.'))
        {
			return false;
        }
    	if(!IsEmpty(password, 'Please Enter Password.'))
        {
			return false;
        }
        return true;
    }
}



function Form_Submit1(frm)
{
	with(frm)
    {

		if(!IsEmpty(old_password, 'Enter old password'))
        {
			return false;
        }
		if(!IsEmpty(user_password, 'Enter new password'))
        {
			return false;
        }
		if(!IsEmpty(retype_password, 'Retype password'))
        {
			return false;
        }
		else if(user_password.value!=retype_password.value)
        {
			
			alert('Password confirmation does not match!!');	
			user_password.focus();
			return false;
	   }
        return true;
    }
}

function validateUserLogin(frm)
{
	with(frm)
    {
    	if(!IsEmpty(password, 'Please Enter Password.'))
        {
			password.focus();
			return false;
        }
        return true;
    }
}