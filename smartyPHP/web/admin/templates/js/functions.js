function popupWindowURL(url, winname,  w, h, menu, resize, scroll, x, y) {
	
	if (winname == null) winname = "newWindow";
	if (w == null) w = 600;
	if (h == null) h = 600;
	if (resize == null) resize = 1;
	
	menutype   = "nomenubar";
	resizetype = "noresizable";
	scrolltype = "noscrollbars";
	if (menu) menutype = "menubar";
	if (resize) resizetype = "resizable";
	if (scroll) scrolltype = "scrollbars";
	
	if (x == null || y == null) {
		cwin=window.open(url,winname,"status," + menutype + "," + scrolltype + "," + resizetype + ",width=" + w + ",height=" + h);
	}
	else {
		cwin=window.open(url,winname,"top=" + y + ",left=" + x + ",screenX=" + x + ",screenY=" + y + "," + "status," + menutype + "," + scrolltype + "," + resizetype + ",width=" + w + ",height=" + h);
	}
	if (!cwin.opener) cwin.opener=self;
	cwin.focus();
	
	return true;
}

function setHomePage (url) {
  if (document.all && document.getElementById)
    oHomePage.setHomePage(url);
  else if (document.layers && navigator.javaEnabled()) {
    netscape.security.PrivilegeManager.enablePrivilege
('UniversalPreferencesWrite');
    navigator.preference('browser.startup.homepage', url);
  }
}

function Check_Click(selectall)
{
	if(document.all["recent_search_id[]"].length)
	{
		if(selectall == 'yes')
		{
			for(i=0; i < document.all["recent_search_id[]"].length; i++)
			{
				document.all["recent_search_id[]"][i].checked = true;
			}
		}
		else
		{
			for(i=0; i < document.all["recent_search_id[]"].length; i++)
			{
				document.all["recent_search_id[]"][i].checked = false;
			}
		}
	}
	else
	{
		if(document.frmMember.checkall.checked == true)
		{
			document.all["selectall[]"].checked = true;
		}
		else
		{
			document.all["selectall[]"].checked = false;
		}
	}
}


function UploadImage_Change(obj, imgTag, defaultVal, defaultWidth)
{
	imgTag.width=120;
	if(obj.value == '')
		imgTag.src = defaultVal;
	else
	{
		imgTag.src = obj.value;
		if(defaultWidth != '')
			imgTag.width=defaultWidth;
	}
}

function CheckUncheck_Click(fld, status)
{
	if(fld.length)
		for(i=0; i < fld.length; i++)
			fld[i].checked = status;
	else
		fld.checked = status;
}

function checkAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}

function uncheckAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}

function showHideSEO(val)
{
	if(val == true)
	{
		document.getElementById('meta1').style.visibility = 'visible';
		document.getElementById('meta1').style.display = 'table-row';
		document.getElementById('meta2').style.visibility = 'visible';
		document.getElementById('meta2').style.display = 'table-row';
	}
	else
	{
		document.getElementById('meta1').style.visibility = 'hidden';
		document.getElementById('meta1').style.display = 'none';
		document.getElementById('meta2').style.visibility = 'hidden';
		document.getElementById('meta2').style.display = 'none';
	}
}