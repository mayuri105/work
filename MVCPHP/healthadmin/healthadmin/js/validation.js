 
//////employee register form validation
function addsales()
{
//alert("hi");
   var allow = true;
  // var username,password;
 
			var fname= document.getElementById('fname').value;
			var lname = document.getElementById('lname').value;
			var bsdate = document.getElementById('bsdate').value;
			var address = document.getElementById('address').value;
			var cno = document.getElementById('cno').value;
			var role = document.getElementById('role').value;
			
			
	if(fname=='')
	{
	//alert("sory");
	document.getElementById("fname_err").innerHTML="Please Enter Firstname";
	allow = false;
	}
	else
	{
		document.getElementById("fname_err").innerHTML="";
	}
	if(lname=='')
	{
	//alert("sory");
	document.getElementById("lname_err").innerHTML="Please Enter Lastname";
	allow = false;
	}
	else
	{
		document.getElementById("lname_err").innerHTML="";
	}
	if(bsdate=='')
	{
	//alert("sory");
	document.getElementById("bdate_err").innerHTML="Please Enter Birth Date";
	allow = false;
	}
	else
	{
		document.getElementById("bdate_err").innerHTML="";
	}
	
	if(address=='')
	{
	//alert("sory");
	document.getElementById("add_err").innerHTML="Please Enter Address";
	allow = false;
	}
	else
	{
		document.getElementById("add_err").innerHTML="";
	}
	
	if(cno=='')
	{
	//alert("sory");
	document.getElementById("cno_err").innerHTML="Please Enter Contact No";
	allow = false;
	}
	else
	{
		document.getElementById("cno_err").innerHTML="";
	}
	
	
	
	if(role=='')
	{
	//alert("sory");
	document.getElementById("role_err").innerHTML="Please Enter Role";
	allow = false;
	}
	else
	{
		document.getElementById("role_err").innerHTML="";
	}
	
	
	return allow;

}

function addproduct()
{
//alert("hi");
   var allow = true;
  // var username,password;
 
			var pname= document.getElementById('pname').value;
			var price = document.getElementById('price').value;
			var date = document.getElementById('date').value;
			
			
 	
	if(pname=='')
	{
	//alert("sory");
	document.getElementById("pname_err").innerHTML="Please Enter Product Name";
	allow = false;
	}
	else
	{
		document.getElementById("pname_err").innerHTML="";
	}
	if(price=='')
	{
	//alert("sory");
	document.getElementById("price_err").innerHTML="Please Enter Price";
	allow = false;
	}
	else
	{
		document.getElementById("price_err").innerHTML="";
	}
	if(date=='')
	{
	//alert("sory");
	document.getElementById("date_err").innerHTML="Please Enter Date";
	allow = false;
	}
	else
	{
		document.getElementById("date_err").innerHTML="";
	}
	
	
	
	return allow;

}


function asproduct()
{
//alert("hi");
   var allow = true;
  // var username,password;
 
			var product_name= document.getElementById('product_name').value;
			var sales_name = document.getElementById('sales_name').value;
			var qty = document.getElementById('qty').value;
			var sale_price = document.getElementById('saleprice').value;
			var date = document.getElementById('date').value;
			
			
 	
	if(product_name=='select')
	{
	//alert("sory");
	document.getElementById("prname_err").innerHTML="Please Select Product";
	allow = false;
	}
	else
	{
		document.getElementById("prname_err").innerHTML="";
	}
	if(sales_name=='select')
	{
	//alert("sory");
	document.getElementById("sname_err").innerHTML="Please Select Sales Person";
	allow = false;
	}
	else
	{
		document.getElementById("sname_err").innerHTML="";
	}
	if(qty=='')
	{
	//alert("sory");
	document.getElementById("qty_err").innerHTML="Please Enter Qty";
	allow = false;
	}
	else
	{
		document.getElementById("qty_err").innerHTML="";
	}
	
	if(sale_price=='')
	{
	//alert("sory");
	document.getElementById("saleprice_err").innerHTML="Please Enter Price";
	allow = false;
	}
	else
	{
		document.getElementById("saleprice_err").innerHTML="";
	}
	
	
	if(date=='')
	{
	//alert("sory");
	document.getElementById("apdate_err").innerHTML="Please Enter Date";
	allow = false;
	}
	else
	{
		document.getElementById("apdate_err").innerHTML="";
	}
	
	
	
	return allow;

}


function addstock()
{
//alert("hi");
   var allow = true;
  // var username,password;
 
			var product_name= document.getElementById('product_name').value;
			var qty = document.getElementById('qty').value;
			
			
 	
   
  
    if(product_name=='select')
	{
	document.getElementById("product_err").innerHTML="Please Select Product";
	allow =  false;
	}
	else
	{
	document.getElementById("product_err").innerHTML="";	
	}
	
	if(qty=='')
	{
	//alert("sory");
	document.getElementById("sqty_err").innerHTML="Please Enter Qty";
	allow = false;
	}
	else
	{
		document.getElementById("sqty_err").innerHTML="";
	}
	
	
	
	return allow;

}


function htarget()
{
//alert("hi");
   var allow = true;
  // var username,password;
 
			
			var sales_name = document.getElementById('sales_name').value;
			
			
			
 	
	
	if(sales_name=='select')
	{
	//alert("sory");
	document.getElementById("sales_err").innerHTML="Please Select Sales Person";
	allow = false;
	}
	else
	{
		document.getElementById("sales_err").innerHTML="";
	}
	
	
	
	
	
	return allow;

}
function addmat()
{
//alert("hi");
   var allow = true;
  // var username,password;
 
			var mtype= document.getElementById('mtype').value;
			
			
			
 	
	if(mtype=='')
	{
	//alert("sory");
	document.getElementById("mtype_err").innerHTML="Please Enter Material Type";
	allow = false;
	}
	else
	{
		document.getElementById("mtype_err").innerHTML="";
	}
	
	
	
	
	return allow;

}
