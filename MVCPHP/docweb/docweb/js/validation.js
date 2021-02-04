 function validateLogin()
 
{
//alert("hi");
   var allow = true;
  // var username,password,type;
  	var type = document.getElementById('type').checked;
	var type1 = document.getElementById('type1').checked;
  	var username = document.getElementById('txtUsername').value;
   	var password = document.getElementById('txtPassword').value;
   
  
  	if(type) {
document.getElementById("type_err").innerHTML="";
} else if(type1) {
document.getElementById("type_err").innerHTML="";
} else {
//alert("Select User Type");
 document.getElementById("type_err").innerHTML="Please Select UserType";
  allow =  false;
}
  
   
	
	if(username=='')
	{
	document.getElementById("uname_err").innerHTML="Please Enter UserName";
	allow = false;
	}
	else
	{
		document.getElementById("uname_err").innerHTML="";
	}
	if(password=='')
	{
	document.getElementById("pass_err").innerHTML="Please Enter Password";
	allow = false;
	}
	else
	{
		document.getElementById("pass_err").innerHTML="";
	}
	
	
	return allow;

}

//////doctor register form validation
function DoctorRegister()
{
//alert("hi");
   var allow = true;
  // var username,password;
 
			var name= document.getElementById('txtName').value;
			var username = document.getElementById('txtDocUsername').value;
			var password = document.getElementById('txtPassword').value;
			var docgender = document.getElementById('dgender').checked;
			var docgender1 = document.getElementById('dgender1').checked;
			var clinicname = document.getElementById('txtClinicName').value;
			var country = document.getElementById('selectCountry').value;
			var state = document.getElementById('selectState').value;
			var city = document.getElementById('selectcity').value;
			var address = document.getElementById('txtAddress').value;
			var emailformat = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+.[a-z]+$/;
			var email = document.getElementById('txtEmail').value;
			var speciality = document.getElementById('lblSpeciality').value;
			var from = /^[0-9]+$/;
			var cno = document.getElementById('txtContactno').value;
			var ecno = document.getElementById('txtEmergencyNo').value;
 	
   
  
    if(name=='')
	{
	document.getElementById("name_err").innerHTML="please enter name";
	allow =  false;
	}
	else
	{
	document.getElementById("name_err").innerHTML="";	
	}
	
	if(username=='')
	{
	//alert("sory");
	document.getElementById("username_err").innerHTML="please enter username";
	allow = false;
	}
	else
	{
		document.getElementById("username_err").innerHTML="";
	}
	if(password=='')
	{
	//alert("sory");
	document.getElementById("password_err").innerHTML="please enter password";
	allow = false;
	}
	else
	{
		document.getElementById("password_err").innerHTML="";
	}
	
	if(docgender) {
		//alert("hiii");
document.getElementById("docgender_err").innerHTML="";
} else if(docgender1) {
document.getElementById("docgender_err").innerHTML="";
} else {
//alert("Select User Type");
 document.getElementById("docgender_err").innerHTML="Please Select gender";
  allow =  false;
}
	
	
	if(clinicname=='')
	{
	//alert("sory");
	document.getElementById("clinicname_err").innerHTML="please enter clinic name";
	allow = false;
	}
	else
	{
		document.getElementById("clinicname_err").innerHTML="";
	}
	if(country=='select')
	{
	document.getElementById("con_err").innerHTML="please select country";
	allow = false;
	}
	else
	{
		document.getElementById("con_err").innerHTML="";
	}
	if(state=='select')
	{
	document.getElementById("state_err").innerHTML="please select state";
	allow = false;
	}
	else
	{
		document.getElementById("state_err").innerHTML="";
	}
	if(city=='select')
	{
	document.getElementById("city_err").innerHTML="please select city";
	allow = false;
	}
	else
	{
		document.getElementById("city_err").innerHTML="";
	}
	if(address=='')
	{
	document.getElementById("address_err").innerHTML="please select address";
	allow = false;
	}
	else
	{
		document.getElementById("address_err").innerHTML="";
	}
	
	
	if(!emailformat.test(email))
	{
	document.getElementById("email_err").innerHTML="plz enter  email";
	allow = false;
	}
	else
	{
		document.getElementById("email_err").innerHTML="";
	}
	
	if(speciality=='select')
	{
	document.getElementById("spe_err").innerHTML="please select specilaity";
	allow = false;
	}
	else
	{
		document.getElementById("spe_err").innerHTML="";
	}
	
	 if(cno.length != 10)
	{
		//alert("enter 10 digit no");
		document.getElementById("cno_err").innerHTML="enter contact no";
		allow = false;
	}
	else
	{
		//var from = /^[0-9]+$/;
		if(!from.test(cno))
		{
		//alert("enter contect no");
		document.getElementById("cno_err").innerHTML="invalid contact no";
	    allow = false;
		}
		else
		{
			document.getElementById("cno_err").innerHTML="";
		}
	}
	
	
	
	 if(ecno.length != 10)
	{
		//alert("enter 10 digit no");
		document.getElementById("ecno_err").innerHTML="enter contact no";
		allow = false;
	}
	else
	{
		//var from = /^[0-9]+$/;
		if(!from.test(ecno))
		{
		//alert("enter contect no");
		document.getElementById("ecno_err").innerHTML="invalid contact no";
	    allow = false;
		}
		else
		{
			document.getElementById("ecno_err").innerHTML="";
		}
	}
	
	
	
	return allow;

}


//////patient register form validation
function PatientRegister()
{
	//alert("hi...");
 var allow = true;
  
 
			var patname= document.getElementById('txtpName').value;
			var patusername = document.getElementById('txtpUsername').value;
			var patpass = document.getElementById('txtpPassword').value;
			var badate = document.getElementById('txtBdate').value;
 			var patgender = document.getElementById('pgender').checked;
			var patgender1 = document.getElementById('pgender1').checked;
			var patmstatus = document.getElementById('plblMstatus').value;
  			/*var patcon = document.getElementById('selectCountry').value;
			var patsta = document.getElementById('selectState').value;
			var patct = document.getElementById('selectcity').value;*/
			var padd = document.getElementById('ptxtAddress').value;
			var pemailformat = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+.[a-z]+$/;
			var pemail = document.getElementById('ptxtEmail').value;
			var pdises = document.getElementById('plblDiseases').value;
			var pfrom = /^[0-9]+$/;
			var pcno = document.getElementById('ptxtContactno').value;
			
    if(patname=='')
	{
	document.getElementById("patname_err").innerHTML="please enter name";
	allow =  false;
	}
	else
	{
	document.getElementById("patname_err").innerHTML="";	
	}
	 if(patusername=='')
	{
	document.getElementById("pusername_err").innerHTML="please enter username";
	allow =  false;
	}
	else
	{
	document.getElementById("pusername_err").innerHTML="";	
	}
	
	if(patpass=='')
	{
	document.getElementById("ppassword_err").innerHTML="please enter passsword";
	allow =  false;
	}
	else
	{
	document.getElementById("ppassword_err").innerHTML="";	
	}
	
	
	if(badate=='')
	{
	document.getElementById("pbdate_err").innerHTML="please enter birth date";
	allow =  false;
	}
	else
	{
	document.getElementById("pbdate_err").innerHTML="";	
	}
	

if(patgender) {
document.getElementById("pgender_err").innerHTML="";
} else if(patgender1) {
document.getElementById("pgender_err").innerHTML="";
} else {
//alert("Select User Type");
 document.getElementById("pgender_err").innerHTML="Please Select gender";
  allow =  false;
}

if(patmstatus=='select')
	{
	document.getElementById("patmstatus_err").innerHTML="please select Material status";
	allow =  false;
	}
	else
	{
	document.getElementById("patmstatus_err").innerHTML="";	
	}
	
	
	/*if(patcon=='select')
	{
	document.getElementById("pcon_err").innerHTML="please select country";
	allow =  false;
	}
	else
	{
	document.getElementById("pcon_err").innerHTML="";	
	}
	
	if(patsta=='select')
	{
	document.getElementById("pstate_err").innerHTML="please select state";
	allow =  false;
	}
	else
	{
	document.getElementById("pstate_err").innerHTML="";	
	}
	if(patct=='select')
	{
	document.getElementById("pcity_err").innerHTML="please select state";
	allow =  false;
	}
	else
	{
	document.getElementById("pcity_err").innerHTML="";	
	}
	*/
	
	if(padd=='')
	{
	document.getElementById("paddress_err").innerHTML="please enter addresss";
	allow =  false;
	}
	else
	{
	document.getElementById("paddress_err").innerHTML="";	
	}
	
	if(!pemailformat.test(pemail))
	{
	document.getElementById("pemail_err").innerHTML="plz enter  email";
	allow = false;
	}
	else
	{
		document.getElementById("pemail_err").innerHTML="";
	}
	
	
	
	if(pdises=='select')
	{
	document.getElementById("pdiseases_err").innerHTML="please select state";
	allow =  false;
	}
	else
	{
	document.getElementById("pdiseases_err").innerHTML="";	
	}
	
	if(pcno.length != 10)
	{
		//alert("enter 10 digit no");
		document.getElementById("pcno_err").innerHTML="enter contact no";
		allow = false;
	}
	else
	{
		//var from = /^[0-9]+$/;
		if(!pfrom.test(pcno))
		{
		//alert("enter contect no");
		document.getElementById("pcno_err").innerHTML="invalid contact no";
	    allow = false;
		}
		else
		{
			document.getElementById("pcno_err").innerHTML="";
		}
	}
	
	
	return allow;
	


}


////Book appointment form validation
function Bookappo()
{
		//alert("hi");
   			var allow = true;
  // var username,password;
 
			var aptype= document.getElementById('lblApType').value;
			var apfname = document.getElementById('txtFirstName').value;
			var aplname = document.getElementById('txtLastName').value;
			var emailformat = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+.[a-z]+$/;
			var apemail = document.getElementById('txtEmail').value;
			var apaddress = document.getElementById('txtAddress').value;
			var from = /^[0-9]+$/;
			var apcno = document.getElementById('txtContactno').value;
			var apcountry = document.getElementById('selectCountry').value;
			var apstate = document.getElementById('selectState').value;
			var apcity = document.getElementById('selectCity').value;
			var apage = document.getElementById('txtAge').value;
			var apdises = document.getElementById('lblDiseases').value;
			var apspe = document.getElementById('lblSpeciality').value;
			var apmspe = document.getElementById('txtMultiSpec').value;
			var apdoc = document.getElementById('Doctor').value;
			var apdate = document.getElementById('date').value;
			var aptime = document.getElementById('atime').value;
			
			
    if(aptype=='select')
	{
	//alert("type");
	document.getElementById("apotype_err").innerHTML="please select appointment type";
	allow =  false;
	}
	else
	{
	document.getElementById("apotype_err").innerHTML="";	
	}
	
	if(apfname=='')
	{
	//alert("fnmae");
	document.getElementById("apfname_err").innerHTML="please enter first name";
	allow = false;
	}
	else
	{
		document.getElementById("apfname_err").innerHTML="";
	}
	
	if(aplname=='')
	{
	//alert("sory");
	document.getElementById("aplname_err").innerHTML="please enter last name";
	allow = false;
	}
	else
	{
		document.getElementById("aplname_err").innerHTML="";
	}
	
	if(!emailformat.test(apemail))
	{
	document.getElementById("apemail_err").innerHTML="plz enter valid email";
	allow = false;
	}
	else
	{
		document.getElementById("apemail_err").innerHTML="";
	}
	
	
	
	if(apaddress=='')
	{
	document.getElementById("apaddress_err").innerHTML="please enter address";
	allow = false;
	}
	else
	{
		document.getElementById("apaddress_err").innerHTML="";
	}
  
  
  
  if(apcno.length != 10)
	{
		//alert("enter 10 digit no");
		document.getElementById("apcno_err").innerHTML="enter contact no";
		allow = false;
	}
	else
	{
		//var from = /^[0-9]+$/;
		if(!from.test(apcno))
		{
		//alert("enter contect no");
		document.getElementById("apcno_err").innerHTML="invalid contact no";
	    allow = false;
		}
		else
		{
			document.getElementById("apcno_err").innerHTML="";
		}
	}
  
  
  	if(apcountry=='select')
	{
	document.getElementById("apcon_err").innerHTML="please select country";
	allow = false;
	}
	else
	{
		document.getElementById("apcon_err").innerHTML="";
	}
	
	if(apstate=='select')
	{
	document.getElementById("apstate_err").innerHTML="please select state";
	allow = false;
	}
	else
	{
		document.getElementById("apstate_err").innerHTML="";
	}
	if(apcity=='select')
	{
	document.getElementById("apcity_err").innerHTML="please select city";
	allow = false;
	}
	else
	{
		document.getElementById("apcity_err").innerHTML="";
	}
	if(apage=='')
	{
	document.getElementById("apage_err").innerHTML="please Enter age";
	allow = false;
	}
	else
	{
		document.getElementById("apage_err").innerHTML="";
	}
	
	if(apdises=='select')
	{
	document.getElementById("apdises_err").innerHTML="please select Diseases";
	allow = false;
	}
	else
	{
		document.getElementById("apdises_err").innerHTML="";
	}
	if(apspe=='select')
	{
	document.getElementById("apspe_err").innerHTML="please select speciality";
	allow = false;
	}
	else
	{
		document.getElementById("apspe_err").innerHTML="";
	}
	if(apmspe=='')
	{
	document.getElementById("apmultispe_err").innerHTML="please enter multi speciality ";
	allow = false;
	}
	else
	{
		document.getElementById("apmultispe_err").innerHTML="";
	}
	if(apdoc=='select')
	{
	document.getElementById("apdoc_err").innerHTML="please select doctor";
	allow = false;
	}
	else
	{
		document.getElementById("apdoc_err").innerHTML="";
	}
	
	if(apdate=='')
	{
	document.getElementById("apdate_err").innerHTML="please enater date";
	allow = false;
	}
	else
	{
		document.getElementById("apdate_err").innerHTML="";
	}
	
	if(aptime=='select')
	{
	document.getElementById("aptime_err").innerHTML="please select time";
	allow = false;
	}
	else
	{
		document.getElementById("aptime_err").innerHTML="";
	}
	
	return allow;

}

////add riview form validation
function addreview()
{
		//alert("hi");
   			var allow = true;
  
 
			
			var doc= document.getElementById('lblDoc').value;
			var name= document.getElementById('txtName').value;
			var subj= document.getElementById('txtSubject').value;
			var com= document.getElementById('txtComment').value;
			
			
			
    if(doc=='select')
	{
	//alert("type");
	document.getElementById("sdoc_err").innerHTML="please select Doctor";
	allow =  false;
	}
	else
	{
	document.getElementById("sdoc_err").innerHTML="";	
	}
	
	 if(name=='')
	{
	//alert("type");
	document.getElementById("name_err").innerHTML="please enter name";
	allow =  false;
	}
	else
	{
	document.getElementById("name_err").innerHTML="";	
	}
	
	 if(subj=='')
	{
	//alert("type");
	document.getElementById("sub_err").innerHTML="please enter subject";
	allow =  false;
	}
	else
	{
	document.getElementById("sub_err").innerHTML="";	
	}
	 if(com=='')
	{
	//alert("type");
	document.getElementById("com_err").innerHTML="please enter comment";
	allow =  false;
	}
	else
	{
	document.getElementById("com_err").innerHTML="";	
	}
	
	return allow;

}

//////customization form validation

function custom()
{
		//alert("hi");
   			var allow = true;
  
 
			var report= document.getElementById('lblWeekly').value;
			var descus= document.getElementById('lblDiseases').value;
			
			
			
			
    if(report=='select')
	{
	//alert("type");
	document.getElementById("report_err").innerHTML="please select Report Type";
	allow =  false;
	}
	else
	{
	document.getElementById("report_err").innerHTML="";	
	}
	
	 if(descus=='select')
	{
	//alert("type");
	document.getElementById("dise_err").innerHTML="please select Dieaseses";
	allow =  false;
	}
	else
	{
	document.getElementById("dise_err").innerHTML="";	
	}
	 
	return allow;

}
/////outlet form validation
function addoutlet()
{
		//alert("hi");
   			var allow = true;
  
 
			var title= document.getElementById('txtTitle').value;
			var desc= document.getElementById('txtOAddress').value;
			var loc= document.getElementById('txtLocation').value;
			
			
			//alert(desc);
			
    if(title=='')
	{
	//alert("type");
	document.getElementById("otitle_err").innerHTML="please enter title";
	allow =  false;
	}
	else
	{
	document.getElementById("otitle_err").innerHTML="";	
	}
	
	  if(desc=='')
	{
			//alert("helllooooo");
	document.getElementById("oaddress_err").innerHTML="please enter description";
	allow =  false;
	}
	else
	{
	document.getElementById("oaddress_err").innerHTML="";	
	}
	
	
	  if(loc=='')
	{
	//alert("type");
	document.getElementById("olocation_err").innerHTML="please enter Location";
	allow =  false;
	}
	else
	{
	document.getElementById("olocation_err").innerHTML="";	
	}
	 
	return allow;

}

/////camp form validation
function addcamp()
{
		//alert("hi");
   			var allow = true;
  
 
			var csubj= document.getElementById('txtSubject').value;
			var desc= document.getElementById('txtDesc').value;
			var cloc= document.getElementById('txtLocation').value;
			var sdate= document.getElementById('txtSdate').value;
			var edate= document.getElementById('txtEdate').value;
			var ctime= document.getElementById('txtTime').value;
			
			
			
			//alert(desc);
			
    if(csubj=='')
	{
	//alert("type");
	document.getElementById("csubj_err").innerHTML="please enter Subject";
	allow =  false;
	}
	else
	{
	document.getElementById("csubj_err").innerHTML="";	
	}
	
	 if(desc=='')
	{
	//alert("type");
	document.getElementById("caddress_err").innerHTML="please enter Description";
	allow =  false;
	}
	else
	{
	document.getElementById("caddress_err").innerHTML="";	
	}
	 if(cloc=='')
	{
	//alert("type");
	document.getElementById("clocation_err").innerHTML="please enter Location";
	allow =  false;
	}
	else
	{
	document.getElementById("clocation_err").innerHTML="";	
	}
	
	  if(sdate=='')
	{
	//alert("type");
	document.getElementById("cstdate_err").innerHTML="enter start date";
	allow =  false;
	}
	else
	{
	document.getElementById("cstdate_err").innerHTML="";	
	}
	
	 
	  if(edate=='')
	{
	//alert("type");
	document.getElementById("ceddate_err").innerHTML=" enter end date";
	allow =  false;
	}
	else
	{
	document.getElementById("ceddate_err").innerHTML="";	
	}
	
	if(ctime=='')
	{
	//alert("type");
	document.getElementById("ctime_err").innerHTML=" enter Time";
	allow =  false;
	}
	else
	{
	document.getElementById("ctime_err").innerHTML="";	
	}
	 
	return allow;

}

////add news form validation

function addnews()
{
		//alert("hi");
   			var allow = true;
  
 
			var ntitle= document.getElementById('txtTitle').value;
			var ndesc= document.getElementById('txtDesc').value;
			
			
			
			
    if(ntitle=='')
	{
	//alert("type");
	document.getElementById("ntitle_err").innerHTML="please enter title";
	allow =  false;
	}
	else
	{
	document.getElementById("ntitle_err").innerHTML="";	
	}
	
	 if(ndesc=='')
	{
	//alert("type");
	document.getElementById("ndesc_err").innerHTML="please enter description";
	allow =  false;
	}
	else
	{
	document.getElementById("ndesc_err").innerHTML="";	
	}
	
	return allow;

}
