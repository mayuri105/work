function Form_Submit(frm)
{
	with(frm)
    {
			if(!IsEmpty(site_title, 'Please, enter your site title.'))
			{
				return false;
			}
			
			if(!IsEmpty(site_keyword, 'Please, enter your site keyworld.'))
			{
				return false;
			}
		
			if(!IsEmpty(site_description, 'Please, enter your site description.'))
			{
				return false;
			}
			
		 return true;
    }
}

