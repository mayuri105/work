<?php
$SITE_PATH="http://mdollarideas.com/healthadmin/";

class adminClass
{

//sales person function

	public function addSales($post)
	{
		
		$query="insert into db_sales_register(fname,lname,dob,address,contactno,role)values('".$post['fname']."','".$post['lname']."','".$post['bdate']."',
			'".$post['address']."','".$post['cno']."','".$post['role']."')";
	
		$result=mysql_query($query);
		 if($result)
		{
		
		  	   	$salesid = mysql_insert_id(); 
				 $sql="SELECT * FROM db_sales_register where id ='".$salesid."'"; 
				$rs=mysql_query($sql);
				while($row=mysql_fetch_array($rs))
				{
				  
				  
				  //print_r($rs);
				  $fname=$row['fname'];
				  $bdate=$row['dob'];
				  $role=$row['role'];
				  
				
				 $fnames=substr("$fname",0,3);
				 $bdates=substr("$bdate",5,2);
				 $roles=substr("$role",0,3);
				 $uniqueid=$fnames."".$bdates."".$roles;
				 
				 $sql2="UPDATE db_sales_register SET uniqueid ='".$uniqueid."' where id = '".$salesid."'";
				 $rs1=mysql_query($sql2)or  die ( mysql_error());
				}
				if($rs1)
					{
						$_SESSION['message']="Sales Person Inserted";
						return true;
					}
				
		}
		else
		{
			$_SESSION['message']="Sales Person  not Inserted";
			return false;
		}		
	
	}
	
	public function salesdetail()
	{
		
		$query="SELECT * FROM  db_sales_register"; 

		$result=mysql_query($query);
		
		$allsales=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allsales[]=$rows;
		}
		
		return $allsales;
		
	}
	
	public function salesdetailById($id)
	{
	 	$query="select * from  db_sales_register where id='".$id."'";
		$result=mysql_query($query);
		
		$row=mysql_fetch_array($result);
		return $row;
	}
	
	
	public function updateSales($post)
	{
	
	
	 $query="update db_sales_register set 
	                        fname='".$post['fname']."',
							lname='".$post['lname']."',
							dob='".$post['bdate']."',
							address='".$post['address']."',
							contactno='".$post['cno']."',
							role='".$post['role']."',
							status='".$post['status']."'
							 where id='".$post['sId']."'";
							
		$result=mysql_query($query);
		 
		if($result)
		{
			$_SESSION['message']="sales Updated";
			return true;
		}
		else
		{
			$_SESSION['message']="sales not Updated";
			return false;
		}		
	
	}
	
	//product function
	
	public function addProduct($post)
	{
	
		$query="insert into db_product_type(pname,price,qty,date)values('".$post['pname']."','".$post['price']."','".$post['qty']."',
			'".$post['date']."')";
	//die;	
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Product Inserted";
			return true;
		}
		else
		{
			$_SESSION['message']="Product not Inserted";
			return false;
		}		
	
	}
	
	public function productdetail()
	{
		 
		 $query="SELECT * FROM  db_product_type where id >= '1'"; 

		$result=mysql_query($query);
		
		$allproduct=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allproduct[]=$rows;
		}
		
		return $allproduct;
		
	}
	
	
	public function productdetailById($id)
	{
	 	$query="select * from  db_product_type where id='".$id."'";
		$result=mysql_query($query);
		
		$row=mysql_fetch_array($result);
		return $row;
	}
	
	
	public function updateProduct($post)
	{
	
	
	 $query="update db_product_type set 
	                        pname='".$post['pname']."',
							price='".$post['price']."',
							qty='".$post['qty']."',
							date='".$post['date']."'
							 where id='".$post['pId']."'";
							
		$result=mysql_query($query);
		 
		if($result)
		{
			$_SESSION['message']="Product Updated";
			return true;
		}
		else
		{
			$_SESSION['message']="Product not Updated";
			return false;
		}		
	
	}
	
	
	
	//assign product function
	public function assignProduct($post)
	{
	
		$query="insert into db_assignto_salesdept(product_typeid,sales_id,qty,sale_price,date)values('".$post['product_name']."','".$post['sales_name']."','".$post['qty']."','".$post['saleprice']."','".$post['assign_date']."')";
	//die;	
		$result=mysql_query($query);
		
		if($result)
		{
		
			
$id= mysql_insert_id(); 
	
	  $sql_sel="select * from db_assignto_salesdept where product_typeid= '".$post['product_name']."'";
			$sql_result = mysql_query($sql_sel);
			
			//echo "<pre>";print_r($sql_result_child);echo"</pre>";
			if(mysql_num_rows($sql_result) > 0)
			{
				
				while($data= mysql_fetch_assoc($sql_result))
				{
					 $result_asqty=$data['qty'];
					 $result_asproduct=$data['product_typeid'];
					
				}
				
			}

	echo $sql_stock="select * from db_stock where product_type= '".$result_asproduct."' ";
	
			$result_stock = mysql_query($sql_stock);
			
			if(mysql_num_rows($result_stock) > 0)
			{
			
				while($rows= mysql_fetch_assoc($result_stock))
				{
				  $result_stock_qty=$rows['qty'];
					
				
			}	
			
	if($result_stock)
	{
	 $sql_update="UPDATE db_stock set qty='".$result_stock_qty."' - '".$result_asqty."' WHERE product_type='".$result_asproduct."'";
			$sql_update_result = mysql_query($sql_update);
		
	}
			
			
			}
	
	if($sql_update_result){
			
		
			$_SESSION['message']="Product Assign ";
			return true;
			}
			
		}
		else
		{
			$_SESSION['message']="Product not Assign";
			return false;
		}		
	
	}
	
	
	public function assignProductDetail()
	{
		 
		 
		  $query="SELECT db_assignto_salesdept.*,db_sales_register.fname,db_product_type.pname from db_assignto_salesdept,db_sales_register,db_product_type where db_assignto_salesdept.product_typeid=db_product_type.id and db_assignto_salesdept.sales_id=db_sales_register.id"; 

		$result=mysql_query($query);
		
		$allproduct=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allproduct[]=$rows;
		}
		
		return $allproduct;
		
	}
	
	public function assignproductdetailById($id)
	{
	 	$query="select * from db_assignto_salesdept where id ='".$id."'";
		$result=mysql_query($query);
		
		$row=mysql_fetch_array($result);
		return $row;
	}
	
	
	public function updateassignProduct($post)
	{
	
	
	 $query="update db_assignto_salesdept set 
	                        product_typeid='".$post['product_name']."',
							sales_id='".$post['sales_name']."',
							qty='".$post['qty']."',
							sale_price='".$post['saleprice']."',
							date='".$post['assign_date']."'
							 where id='".$post['apId']."'";
							
		$result=mysql_query($query);
		 
		if($result)
		{
			$_SESSION['message']="assingnProduct Updated";
			return true;
		}
		else
		{
			$_SESSION['message']="assignProduct not Updated";
			return false;
		}		
	
	}
	
	
	// stock  function
	public function addStock($post)
	{
	
		$query="insert into db_stock(product_type,qty)values('".$post['product_name']."','".$post['qty']."')";
		
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Stock Inserted";
			return true;
		}
		else
		{
			$_SESSION['message']="Stock not Inserted";
			return false;
		}		
	
	}
	
	
	public function stockdetail()
	{
		 
		
		  $query="SELECT db_stock.*,db_product_type.pname from db_stock,db_product_type where db_stock.product_type=db_product_type.id"; 

		$result=mysql_query($query);
		
		$allstock=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allstock[]=$rows;
		}
		
		return $allstock;
		
	}
	

public function StockdetailById($id)
	{
	 	$query="select * from  db_stock where id='".$id."'";
		$result=mysql_query($query);
		
		$row=mysql_fetch_array($result);
		return $row;
	}
	
	
	public function updateStock($post)
	{
	
	
	 $query="update db_stock set 
	                        product_type='".$post['product_name']."',
							qty='".$post['qty']."'
							 where id='".$post['sId']."'";
							
		$result=mysql_query($query);
		 
		if($result)
		{
			$_SESSION['message']="Stock Updated";
			return true;
		}
		else
		{
			$_SESSION['message']="Stock not Updated";
			return false;
		}		
	
	}
	
	//order...
	
	public function orderdetail()
	{
		  $query="select db_order.*,db_product_type.pname as product_name,db_sales_register.fname as sales_name,db_shop_register.shop_name as shop_name from db_order,db_product_type,db_sales_register,db_shop_register where db_order.producttype_id = db_product_type.id and db_order.sales_id= db_sales_register.id and db_order.shop_id= db_shop_register.id"; 

		$result=mysql_query($query);
		
		$allorder=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allorder[]=$rows;
		}
		
		return $allorder;
		
	}
	
	public function orderdetaildaily()
	{
		  $query="select db_order.*,db_product_type.pname as product_name,db_sales_register.fname as sales_name,db_shop_register.shop_name as shop_name ,sum(db_order.qty) as totalqty, sum(db_order.total) as grandtot from db_order,db_product_type,db_sales_register,db_shop_register where db_order.producttype_id = db_product_type.id and db_order.sales_id= db_sales_register.id and db_order.shop_id= db_shop_register.id and db_order.order_date = '".date('Y-m-d')."' group by db_order.sales_id"; 



		$result=mysql_query($query);
		
		$allorder=array();
		
		while($rows=mysql_fetch_array($result))
		{
		
		
		
			$allorder[]=$rows;
		
		}
		
		return $allorder;
		
	}
	
	public function ordercount($date)
{
   
   	  	  $query="SELECT sum(qty) as totalqty, sum(total) as grandtot,sales_id ,order_date from db_order where order_date='".$date."' group by db_order.sales_id ";
		 $result=mysql_query($query);
	
		while($rows=mysql_fetch_array($result))
		{
			$allordercount[]=$rows;
		}
		
		return $allordercount;
		
		
}

//target function..
public function addTarget($post)
	{
		
		if(isset($_POST['d_qty']) && isset($_POST['d_incentive']) && isset($_POST['assign_date'])){
			$type="daily";
		 echo $query="insert into db_target(target_type,sales_id,qty,incentive,start_date,end_date)values('".$type."','".$post['sales_name']."','".$post['d_qty']."','".$post['d_incentive']."','".$post['assign_date']."','')";
		$result=mysql_query($query);
		}
		
		
		if(isset($_POST['w_qty']) && isset($_POST['w_incentive']) && isset($_POST['sweek'])&& isset($_POST['eweek'])){
			$type="weekly";
		 echo $query="insert into db_target(target_type,sales_id,qty,incentive,start_date,end_date)values('".$type."','".$post['sales_name']."','".$post['w_qty']."','".$post['w_incentive']."','".$post['sweek']."','".$post['eweek']."')";
		$result=mysql_query($query);
		}
		if(isset($_POST['m_qty']) && isset($_POST['m_incentive']) && isset($_POST['smonth'])&& isset($_POST['emonth'])){
			$type="monthly";
		 echo $query="insert into db_target_my(target_type,sales_id,qty,incentive,month,year)values('".$type."','".$post['sales_name']."','".$post['m_qty']."','".$post['m_incentive']."','".$post['smonth']."','".$post['emonth']."')";
		$result=mysql_query($query);
		}
		if(isset($_POST['y_qty']) && isset($_POST['y_incentive']) && isset($_POST['syear'])&& isset($_POST['eyear'])){
			$type="yearly";
		 echo $query="insert into db_target_my(target_type,sales_id,qty,incentive,month,year)values('".$type."','".$post['sales_name']."','".$post['y_qty']."','".$post['y_incentive']."','".$post['syear']."','".$post['eyear']."')";
		$result=mysql_query($query);
		}
		if($result)
		{
			$_SESSION['message']="Target Inserted";
			return true;
		}
		else
		{
			$_SESSION['message']="Target not Inserted";
			return false;
		}		
	
	}
	
	public function targetdetail()
	{
		 
		$date=date('Y-m-d');
		// $query="SELECT db_target.*,db_sales_register.fname from db_target,db_sales_register where  db_target.sales_id=db_sales_register.id and target_type= 'daily'";
		  $query="select db_target.*,SUM(db_order.qty )as daily_achive,db_sales_register.fname 
			from db_target,db_order,db_sales_register
			where  db_order.sales_id = db_target.sales_id  and  db_target.sales_id=db_sales_register.id 
			and db_target.target_type ='daily'
			and db_order.order_date = '".$date."' and db_order.status = 'done'
			 
			 ";
		$result=mysql_query($query);
		
		$alltarget=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$alltarget[]=$rows;
		}
		
		return $alltarget;
		
	}
	public function targetwdetail()
	{
		 
		$date=date('Y-m-d');
		 $query="SELECT db_target.*,db_sales_register.fname,SUM(db_order.qty )as Weekly_achive from db_target,db_sales_register,db_order where  db_target.sales_id=db_sales_register.id and target_type= 'weekly' and db_order.sales_id = db_target.sales_id and db_order.order_date = '".$date."' and db_order.status = 'done'";
		 
		$result=mysql_query($query);
		
		$alltarget=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$alltarget[]=$rows;
		}
		
		return $alltarget;
		
	}
	public function targetmdetail()
	{
		 
		$date=date('Y-m-d');
		 $query="SELECT db_target_my.*,db_sales_register.fname,SUM(db_order.qty ) as monthly_achive from db_target_my,db_sales_register,db_order where  db_target_my.sales_id=db_sales_register.id and db_target_my.target_type= 'monthly' and db_order.order_date = '".$date."' and db_order.status = 'done'";
		 
		$result=mysql_query($query);
		
		$alltarget=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$alltarget[]=$rows;
		}
		
		return $alltarget;
		
	}
	public function targetydetail()
	{
		 
		$date=date('Y-m-d');
		 $query="SELECT db_target_my.*,db_sales_register.fname,SUM(db_order.qty )as yearly_achive from db_target_my,db_sales_register,db_order where  db_target_my.sales_id=db_sales_register.id and db_target_my.target_type= 'yearly' and db_order.order_date = '".$date."' and db_order.status = 'done'";
		 
		$result=mysql_query($query);
		
		$alltarget=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$alltarget[]=$rows;
		}
		
		return $alltarget;
		
	}
	
	public function TargetdetailById($id)
	{
	 	$query="select * from  db_target where id='".$id."'";
		$result=mysql_query($query);
		
		$row=mysql_fetch_array($result);
		return $row;
	}
	
	
	public function updateTarget($post)
	{
	
	
	 $query="update db_target set 
	                        
							sales_id='".$post['sales_name']."',
							producttype_id='".$post['product_name']."',
							qty='".$post['qty']."',
							date='".$post['assign_date']."'
							 where id='".$post['taId']."'";
							
		$result=mysql_query($query);
		 
		if($result)
		{
			$_SESSION['message']="Target Updated";
			return true;
		}
		else
		{
			$_SESSION['message']="Target not Updated";
			return false;
		}		
	
	}
	
	
	//shop function
	
	public function shopdetail()
	{
		  $query="select * from db_shop_register"; 

		$result=mysql_query($query);
		
		$allshop=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allshop[]=$rows;
		}
		
		return $allshop;
		
	}
	
	//payment cash function
	
	public function paycashdetail()
	{
		 
		
		/* $query="SELECT db_payment_cash.*,db_sales_register.fname,db_product_type.pname,db_shop_register.shop_name from db_payment_cash,db_sales_register,db_product_type,db_shop_register where db_payment_cash.producttype_id=db_product_type.id and db_payment_cash.sales_id=db_sales_register.id and db_payment_cash.shop_id = db_shop_register.id";
*/
 $query="SELECT db_payment_cash.*,db_sales_register.fname,db_shop_register.shop_name from db_payment_cash,db_sales_register,db_shop_register where  db_payment_cash.sales_id=db_sales_register.id and db_payment_cash.shop_id = db_shop_register.id";

		$result=mysql_query($query);
		
		$allcash=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allcash[]=$rows;
		}
		
		return $allcash;
		
	}
	
	
	//payment cheque
	
	public function paychequehdetail()
	{
		 
		
		/* $query="SELECT db_payment_cash.*,db_sales_register.fname,db_product_type.pname,db_shop_register.shop_name from db_payment_cash,db_sales_register,db_product_type,db_shop_register where db_payment_cash.producttype_id=db_product_type.id and db_payment_cash.sales_id=db_sales_register.id and db_payment_cash.shop_id = db_shop_register.id";
*/
 $query="SELECT db_payment_cheque.*,db_sales_register.fname,db_shop_register.shop_name from db_payment_cheque,db_sales_register,db_shop_register where  db_payment_cheque.sales_id=db_sales_register.id and db_payment_cheque.shop_id = db_shop_register.id";

		$result=mysql_query($query);
		
		$allcheque=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allcheque[]=$rows;
		}
		
		return $allcheque;
		
	}
	
	
	
	
	//material funaction
	
	public function Materialdetail()
	{
		 
		
		  $query="SELECT * from db_adv_material  where id >= '1'"; 

		$result=mysql_query($query);
		
		$allMaterial=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allMaterial[]=$rows;
		}
		
		return $allMaterial;
		
	}
	
	public function addMaterial($post)
	{
		$img_file=$_FILES['mat_image']['name'];
		$filemove=$_FILES['mat_image']['tmp_name'];
		$path="../upload/".$img_file;
		move_uploaded_file($filemove, $path);
		$query="insert into db_adv_material(type,image)values('".$post['mtype']."','".$img_file."')";
		
		$result=mysql_query($query);
		
		if($result)
		{
			$_SESSION['message']="Material Inserted";
			return true;
		}
		else
		{
			$_SESSION['message']="Material not Inserted";
			return false;
		}		
	
	}
	
	
	public function MaterialdetailById($id)
	{
	 	$query="select * from  db_adv_material where id='".$id."'";
		$result=mysql_query($query);
		
		$row=mysql_fetch_array($result);
		return $row;
	}
	
	
	public function updateMaterial($post)
	{
	$img_file=$_FILES['mat_image']['name'];
		$filemove=$_FILES['mat_image']['tmp_name'];
		$path=$SITE_PATH."upload/".$img_file;
		move_uploaded_file($filemove, $path);
	if($img_file!='')
	{
	
	 $query="update db_adv_material set 
	                        type='".$post['mtype']."',
							image='".$img_file."'
							 where id='".$post['mId']."'";
	}
	else
	{
	 $query="update db_adv_material set 
	                        type='".$post['mtype']."'
							 where id='".$post['mId']."'";
	
	}						
		$result=mysql_query($query);
		 
		if($result)
		{
			$_SESSION['message']="Meterial Updated";
			return true;
		}
		else
		{
			$_SESSION['message']="Meterial not Updated";
			return false;
		}		
	
	}
	
	public function salesmaterialdetail()
	{
		  $query="SELECT db_addadv_material.*,db_sales_register.fname,db_shop_register.shop_name from db_addadv_material,db_sales_register,db_shop_register where  db_addadv_material.sales_id=db_sales_register.id and db_addadv_material.shop_id = db_shop_register.id"; 

		$result=mysql_query($query);
		
		$allsalesmat=array();
		
		while($rows=mysql_fetch_array($result))
		{
			$allsalesmat[]=$rows;
		}
		
		return $allsalesmat;
		
	}
	
	
}

?>