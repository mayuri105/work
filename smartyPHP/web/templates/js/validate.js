//====================================================================================================
//	Function Name	:	IsEmpty
//	Purpose			:	checks whether a field has value or is blank, it returns false if a field
//						is empty otherwise true.
//	Parameters		:	fld	-	field name to be checked
//					    msg -   error message to be displayed
//----------------------------------------------------------------------------------------------------
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


//====================================================================================================
//	Function Name	:	IsEmail
//	Purpose			:	checks Email validity. Email must have character @ followed by one or more
//						dots. It returns flase if Email is invalid otherwise true.
//	Parameters		:	fld	-	field name to be checked
//					    msg -   error message to be displayed
//----------------------------------------------------------------------------------------------------
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

//====================================================================================================
//	Function Name	:	IsValidString
//	Purpose			:	checks if field value contains only alphanumeric and '_' charactes. Also checks
//						that alphabetical chars. and '_' must have to be come first and followed by
//						numbers. It returns false if above conditions will not satisfy otherwise true.
//	Parameters		:	fld	-	field name to be checked
//					    msg -   error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsValidString(fld,msg)
{
	var regex = /^[_]*[a-zA-Z_]+[a-zA-Z0-9_]+$/;
	if(!regex.test(fld.value))
	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}

//====================================================================================================
//	Function Name	:	IsLen
//	Purpose			:	checks if field value has number of characters between two specified limits.
//						It returns false if no. of chars. is < min. length or > max. length
//						otherwise true.
//	Parameters		:	fld	   - field name to be checked
//						minlen - minimum length of a field
//						maxlen - maximum length of a field
//					    msg    -   error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsLen(fld, minlen, maxlen, msg)
{
	if(fld.value.length < minlen || fld.value.length > maxlen)
	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}



//====================================================================================================
//	Function Name	:	IsCurrency
//	Purpose			:	checks if Currency value is in proper format i.e. ',' must be after 1(at first place)
//						or 3 digits also dot '.' must be followed by ',' . '$' is optinal as a first char.
//						It returns false if above condition will not satisfy otherwise true.
//	Parameters		:	fld	-  field name to be checked
//					    msg -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsCurrency(fld,msg)
{
    val = fld.value.replace(/\s/g, "");

	regex = /^\$?\d{1,2}(,?\d{2})*(\.\d{1,2})?$/;

    if(!regex.test(val)) {
         alert(msg);
		 fld.focus();
		 return false;
    }
	return true;
}


//====================================================================================================
//	Function Name	:	IsPhone
//	Purpose			:	checks if phone field has following characters : 0-9, '-', '+', '(' , ')' .
//						It returns false if there are other than above characters otherwise true .
//	Parameters		:	fld1	-  area code to be checked
//					:	fld2	-  city code to be checked
//					:	fld3	-  actual phone no to be checked
//					    msg -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsPhone(fld1,fld2,fld3,msg)
{
	var regex = /^[\d\-+()]+$/;

	var phone = "(" + fld1.value + ")" + fld2.value + "-" + fld3.value;
	if(!regex.test(phone))
	{
		alert(msg);
		fld1.focus();
		return false;
	}
	return true;
}


//====================================================================================================
//	Function Name	:	IsZip
//	Purpose			:	checks if zip field value is of length 5 or 9 . (for U.S. zip code).
//						It returns false if it contains alphabetic chars. or length is not as
//						specified.
//	Parameters		:	fld	-  field name to be checked
//					    msg -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsZip(fld,msg)
{
	var num = /^[\d]+$/;

	if(!num.test(fld.value) || (fld.value.length !=5 && fld.value.length !=9))
	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}

function allDigits(str)
{
	return inValidCharSet(str,"0123456789");
}

function inValidCharSet(str,charset)
{
	var result = true;
	for (var i=0;i<str.length;i++)
		if (charset.indexOf(str.substr(i,1))<0)
		{
			result = false;
			break;
		}
	return result;
}


//====================================================================================================
//	Function Name	:	checkFileType
//	Purpose			:	It checks the file type. It must be either doc or pdf.
//	Parameters		:	fld -  field name containig file name
//						msg -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function checkFileType(fld,msg)
{
	var regex = /(.doc|.pdf)$/;
	if(!regex.test(fld.value))
	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}

//====================================================================================================
//	Function Name	:	checkImageType
//	Purpose			:	It checks the image type. It must be either jpg or gif.
//	Parameters		:	fld -  field name containig image file name
//						msg -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function checkImageType(fld,msg)
{
	var regex = /(.jpg|.jpeg|.gif|.png)$/;
	if(!regex.test(fld.value))
	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}

//====================================================================================================
//	Function Name	:	IsUrl
//	Purpose			:	It check that if url starts with htpp://
//	Parameters		:	fld -  field name containig url
//						msg -  error message to be displayed
//----------------------------------------------------------------------------------------------------
function IsUrl(fld,msg)
{
	var regex = /^(http:\/\/)/;
	if(!regex.test(fld.value))
	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}

//====================================================================================================
//	Function Name	:	IsFileSize
//	Purpose			:	It ckecks the size of the image file.
//	Parameters		:	fld -  field name containig image file name
//	Return			:	None
//	Author			:	Jignasa Naik
//	Creation Date	:	29-May-2003
//----------------------------------------------------------------------------------------------------
function IsFileSize(fld,msg)
{
	var img = new Image();
	img.src = fld.value;
//	alert('Dimensions:' + img.width + 'x' + img.height);
//	alert('File Size:' + img.fileSize);
	if(img.fileSize > 102400)
	{
		alert(msg);
		fld.focus();
		return false;
	}

	return true;
}
function IsNumeric(str)
{
   if((window.event.keyCode<48) || (window.event.keyCode>57) )
   {
   	  if(window.event.keyCode!=46)
	  {
	  	window.event.keyCode=0;
	  }
   }		
}

function IsPassword(fld,msg)
{
	var regex = /^[_]*[a-zA-Z]+[a-zA-Z0-9]*$/;
	if(!regex.test(fld.value))
  	{
		alert(msg);
		fld.focus();
		return false;
	}
	return true;
}


function isNumericKeyDec()
{
	if (window.event.keyCode < 48 || window.event.keyCode > 57)
	{
		if (window.event.keyCode != 46)
			window.event.keyCode = 0;
	} 
}

function IsNumber(fld,msg)
{
	var regex = /^[0-9]*\.?[0-9][0-9][0-9]$/;
	if(!regex.test(fld.value))
  	{
		alert(msg);
		//fld.focus();
		return false;
	}
	return true;
}


function isNumericKey()
{
	if (window.event.keyCode < 48 || window.event.keyCode > 57)
	{
		window.event.keyCode = 0;
	} 
}
//====================================================================================================
//	Function Name	:	checkFileExt(file)
//----------------------------------------------------------------------------------------------------
function checkFileExt(file)
{
	var filelength = parseInt(file.length) - 3;
	var fileext = file.substring(filelength,filelength + 3);
	if(fileext.toLowerCase() != "gif" && fileext.toLowerCase() != "jpg" && fileext.toLowerCase() != "png")
	{
		return false;
	}
	else
	{
		return true;
	}
}
//====================================================================================================
//	Function Name	:	checkFileExt(file)
//----------------------------------------------------------------------------------------------------
function checkPNGExt(file,msg)
{
	var filelength = parseInt(file.length) - 3;
	var fileext = file.substring(filelength,filelength + 3);
	if(fileext.toLowerCase() != "png")
	{
		alert(msg);
		return false;
	}
	else
	{
		return true;
	}
}