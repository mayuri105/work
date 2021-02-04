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

// JavaScript Document
function validateNotEmpty( strValue ) 
{
	var strTemp = strValue;
	strTemp = trimAll(strTemp);
	if(strTemp.length > 0)
	{
		return true;
	}
	return false;
}


function IsEmpty(fld,msg)
{
	strTemp = trimAll(fld.value);
	
	if(strTemp.length > 0)
	{
		return true;
	}
	else
	{
		alert(msg);
		try {fld.focus();}catch(e){return true;}
		return false;
	}
}
function trimAll( strValue ) 
{
	var objRegExp = /^(\s*)$/;
	//check for all spaces
	if(objRegExp.test(strValue)) 
	{
		strValue = strValue.replace(objRegExp, '');
		if( strValue.length == 0)
			return strValue;
	}
	//check for leading & trailing spaces
	objRegExp = /^(\s*)([\W\w]*)(\b\s*$)/;
	if(objRegExp.test(strValue)) 
	{
	//remove leading and trailing whitespace characters
		strValue = strValue.replace(objRegExp, '$2');
	}
	return strValue;
}
function IsEmail(fld,msg)
{

	var emailStr = fld.value;

	if (emailStr.toString() == "") 
	{
		alert ("Please Enter Email address");
			fld.focus()
			return false;

	}
	else if (emailStr != "")
	{	
	var checkTLD=1;
	var knownDomsPat=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/;
	var emailPat=/^(.+)@(.+)$/;
	var specialChars="\\(\\)><@,;:\\\\\\\"\\.\\[\\]";
	var validChars="\[^\\s" + specialChars + "\]";
	var quotedUser="(\"[^\"]*\")";
	var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
	var atom=validChars + '+';
	var word="(" + atom + "|" + quotedUser + ")";
	var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
	var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");
	var matchArray=emailStr.match(emailPat);
	
	if (matchArray==null) {
	alert("Email address seems incorrect (check @ and .'s)");
	fld.focus()
	return false;
	}
	var user=matchArray[1];
	var domain=matchArray[2];
	for (i=0; i<user.length; i++) {
	if (user.charCodeAt(i)>127) {
	alert("Email's username contains invalid characters.");
	fld.focus()
	return false;
	   }
	}
	for (i=0; i<domain.length; i++) {
	if (domain.charCodeAt(i)>127) {
	alert("Email's domain name contains invalid characters.");
	fld.focus()
	return false;
	   }
	}
	if (user.match(userPat)==null) {
	alert("Email's username doesn't seem to be valid.");
	fld.focus()
	return false;
	}
	
	var IPArray=domain.match(ipDomainPat);
	if (IPArray!=null) {
	for (var i=1;i<=4;i++) {
	if (IPArray[i]>255) {
	alert("Email's Destination IP address is invalid!");
	fld.focus()
	return false;
	   }
	}
	//return true;
	}
	var atomPat=new RegExp("^" + atom + "$");
	var domArr=domain.split(".");
	var len=domArr.length;
	for (i=0;i<len;i++) {
	if (domArr[i].search(atomPat)==-1) {
	alert("Email's domain name does not seem to be valid.");
	fld.focus()
	return false;
	   }
	}

	if (len<2) {
	alert("Email address is missing a hostname!");
	fld.focus()
	return false;
	}
	//return true;

	}

	return true;
      
}

/*jQuery(document).ready(function(){
	jQuery("#formSubmitButton").click(function(){
		jQuery("#frmRegister").validate();
	});
});*/