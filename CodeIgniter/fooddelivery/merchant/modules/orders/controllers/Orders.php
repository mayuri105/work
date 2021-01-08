<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends MX_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('order_model','order');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
		$this->load->library('cart');
		
	}

	public function index(){
		
		$perpage = $this->setting->get('per_page');
		
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		$base_url = "/orders/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->order->record_count());
		
		$data["pagination_helper"]   = $this->pagination;
		$data["orders"] = $this->order->fetch_data($perpage ,(($page-1) * $perpage));
			
		$data['order_id'] = $this->input->get('order_id');
        $data['customer'] = $this->input->get('customer');
        $data['cv_status'] = $this->input->get('cv_status');
        $data['payment_type'] = $this->input->get('payment_type');
        $data['totalamt'] = $this->input->get('totalamt');
        $data['date_added'] = date('m-d-Y',strtotime($this->input->get('date_added')));
        $data['order_status'] = $this->order->getorder_status();
		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/order/index')) {
			$this->load->view('themes/' . $theme . '/template/order/index', $data);
		} else {
			$this->load->view('themes/default/template/order/index', $data);
		}
	}

	public function view($id =''){
		$data = array();
		if($id=='') redirect('orders');
		
		
		$data['orders'] = $this->order->getorder($id);
		$data['order_history'] = $this->order->getSubOrderHistory($id);
		$data['order_status'] = $this->order->getstatus();
		$data['state'] = getstate();
		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/order/view')) {
			$this->load->view('themes/' . $theme . '/template/order/view', $data);
		} else {
			$this->load->view('themes/default/template/order/view', $data);
		}
	}
	public function add(){
		$data = array();

		$data['customer'] = $this->order->fetch_customer();
		$data['store'] = $this->order->fetch_stores();
		$data['products'] = $this->order->fetch_products();
		$data['order_status'] = $this->order->getorder_status();
		$data['state'] = getstate();
		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/order/add')) {
			$this->load->view('themes/' . $theme . '/template/order/add', $data);
		} else {
			$this->load->view('themes/default/template/order/add', $data);
		}
	}
	public function edit($id =''){

		if($id==''){
			redirect('orders');
		}
		$data = array();
		$data['customer'] = $this->order->fetch_customer();
		// $data['store'] = $this->order->fetch_stores();
		
		$data['orders'] = $this->order->getorder($id);
		$data['state'] = getstate();
		$data['order_status'] = $this->order->getorder_status();
		$data['store'] = $this->order->getStoreByorder($id);	
		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/order/edit')) {
			$this->load->view('themes/' . $theme . '/template/order/edit', $data);
		} else {
			$this->load->view('themes/default/template/order/edit', $data);
		}
	}
	
	
	public function addorder(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('customer_id', 'Customer', 'required');
		$this->form_validation->set_rules('delivery_option', 'Delivery Option', 'required');
		$this->form_validation->set_rules('payment_method', 'Payment method Option', 'required');
		
		
			if($this->form_validation->run() == FALSE){
			  $this->session->set_flashdata('error', validation_errors());
			  redirect('orders/add');
			}else{
				$prf = 'INV';
				$yr = date('y');
				$invoice_prefix = $prf.'-'.$yr.'-'.'00';
				$data = array(
					'order_status'=>post('order_status'),
					'invoice_prefix' =>$invoice_prefix,
					'customer_id'=>post('customer_id'),
					'delivery_option'=>post('delivery_option'),
					'delivery_or_pic_datetime'=>date('Y-m-d H:i:s',strtotime(post('datetime'))),
					'special_inst'=>post('special_inst'),
					'payment_method'=>post('payment_method'),
					'payment_apt_name'=>post('payment_apt_name'),
					'payment_city'=>post('payment_city'),
					'payment_state'=>post('payment_state'),
					'payment_zip'=>post('payment_zip'),
					'shipping_address'=>post('shiping_address'),
					'shipping_apt_name'=>post('shiping_apt_name'),
					'shipping_city'=>post('shiping_city'),
					'shipping_state'=>post('shiping_state'),
					'shipping_zip'=>post('shiping_zip'),
					'created_on'=>date('Y-m-d'),
				);
				
				$orderid = $this->order->insert($data);

				$productSessionData = $this->cart->contents();

				$storeidForcheck = 0;
				foreach ($productSessionData as $ps ) {
					$product =$this->order->getPrductbyId($ps['id']);
					$discountPrice = $this->order->DiscountOnPrdoduct($ps['id']);
					
					if ($storeidForcheck != $product->store_id) {
						$subOrder = array(
							'o_id'=>$orderid,
							'store_id'=>$product->store_id,
							'store_name'=>$product->store_name,
							'delivery_option'=>post('delivery_option'),
							'order_status_id'=>'1',
							'payment_status'=>'1',
							'delivery_date_time'=>date('Y-m-d H:i:s',strtotime(post('datetime'))),
							'comment'=>post('special_inst'),
							'date_added'=>date('Y-m-d'),
						);
						$suborderid = $this->order->insertsubOrder($subOrder);
					}
					$dataInsert = array(
						'o_id'=>$orderid,
						's_id'=>$suborderid,
						'product_id'=>$product->product_id,
						'product_name'=>$product->product_name,
						'product_price'=>$discountPrice,
						'pro_quantity'=>$ps['qty'],
						'store_id'=>$product->store_id,
						'store_name'=>$product->store_name,
							
					);
					$order_item_id = $this->order->insert_orderitem($dataInsert);


					if($ps['rowid']){
						$productOpt =  $this->cart->product_options($ps['rowid']);
						if($productOpt['product_option']){
							foreach ($productOpt['product_option'] as $k) {
								$options_val_item = $this->cart_model->getOptionData($k);
								$dataItem = array(
									'order_item_id'=>$order_item_id,
									'product_id'=>$product->product_id,
									'option_name'=>$options_val_item->option_name,
									'option_value'=>$options_val_item->option_value,
									'option_id'=>$options_val_item->option_id,
									'option_value_id'=>$options_val_item->po_id,
									'price'=>$options_val_item->price,
								);
								$order_item_value_id = $this->order->insert_orderitemOp($dataItem);
							}
						}
					}	
					$totalSubOrder = $this->order->suborderTotalamt($suborderid);		
					
				}

			   if($orderid){
		   			$dataActivity = array(
	        			'user_id'=>$this->session->u_id,
	        			'act_key'=>'Order Added',
		        	);
	        		$this->db->insert('user_activity',$dataActivity);

					$this->session->set_flashdata('success','Order Successfully added');
					$this->cart->destroy();
					redirect('orders');
				}else{
					$this->session->set_flashdata('error','Error in Updated');
					redirect('orders');
				}

			} 
		
	}
	// update order
	public function updateorderData(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('delivery_option', 'Delivery Option', 'required');
		$this->form_validation->set_rules('payment_method', 'Payment method Option', 'required');
		
	  
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			redirect('orders/edit/'.post('order_id').'');
		}else{

			
			$dataOrder = array(
				'order_status'=>post('order_status'),
				'customer_id'=>post('customer_id'),
				'delivery_option'=>post('delivery_option'),
				'delivery_or_pic_datetime'=>date('Y-m-d h:i:s',strtotime(post('delivery_or_pic_datetime'))),
				'special_inst'=>post('special_inst'),
				'payment_method'=>post('payment_method'),

			);
			$where2 = array('o_id' =>post('order_id'));
			$ret = $this->order->update($dataOrder,$where2);
			if($ret){
				$this->session->set_flashdata('success','Customer Detail or Order Successfully Updated');
				redirect('orders/edit/'.post('order_id').'');
			}else{
				$this->session->set_flashdata('error','Error in Updated');
				redirect('orders/edit/'.post('order_id').'');
			}
		}
	}
	public function paymentupdateAddressData(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('payment_address', 'street_address ', 'required');
		$this->form_validation->set_rules('payment_apt_name', 'payment_apt_name', 'required');
		$this->form_validation->set_rules('payment_city', 'payment_city', 'required');
		$this->form_validation->set_rules('payment_state', 'payment_state', 'required');
		$this->form_validation->set_rules('payment_zip', 'payment_zip', 'required');
	  
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			redirect('orders/edit/'.post('order_id').'');
		}else{
			$data = array(
				'payment_address'=>post('payment_address'),
				'payment_apt_name'=>post('payment_apt_name'),
				'payment_city'=>post('payment_city'),
				'payment_state'=>post('payment_state'),
				'payment_zip'=>post('payment_zip'),

			);
			$where2 = array('o_id' =>post('order_id'));
			$ret = $this->order->update($data,$where2);
			if($ret){
				$this->session->set_flashdata('success','Customer Detail Successfully Updated');
				redirect('orders/edit/'.post('order_id').'');
			}else{
				$this->session->set_flashdata('error','Error in Updated');
				redirect('orders/edit/'.post('order_id').'');
			}
		}
	}
	public function shippingupdateAddressData(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('shipping_address', 'street_address ', 'required');
		$this->form_validation->set_rules('shipping_apt_name', 'shipping_apt_name', 'required');
		$this->form_validation->set_rules('shipping_city', 'shipping_city', 'required');
		$this->form_validation->set_rules('shipping_state', 'shipping_state', 'required');
		$this->form_validation->set_rules('shipping_zip', 'shipping_zip', 'required');
	  
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			redirect('orders/edit/'.post('order_id').'');
		}else{
			$data = array(
				'shipping_address'=>post('shipping_address'),
				'shipping_apt_name'=>post('shipping_apt_name'),
				'shipping_city'=>post('shipping_city'),
				'shipping_state'=>post('shipping_state'),
				'shipping_zip'=>post('shipping_zip'),

			);
			$where2 = array('o_id' =>post('order_id'));
			$ret = $this->order->update($data,$where2);
			if($ret){
				$this->session->set_flashdata('success','Customer Detail Successfully Updated');
				redirect('orders/edit/'.post('order_id').'');
			}else{
				$this->session->set_flashdata('error','Error in Updated');
				redirect('orders/edit/'.post('order_id').'');
			}
		}
	}
	// update order end

	// update product in order
	public function addproduct(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('order_id', 'Order', 'required');
	   
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			redirect('orders/edit/'.post('order_id').'');
		}else{
			$product =$this->order->getPrductbyId(post('product_id'));
			$order_id = post('order_id');

			$subOrderId = $this->order->getsuborderId($order_id,$product->store_id);
			$mainOrder = $this->order->getMainOrder($order_id);

			if($subOrderId){
				$dataInsert = array(
					'o_id'=>post('order_id'),
					'product_id'=>$product->product_id,
					'product_name'=>$product->product_name,
					'product_price'=>$product->price,
					'store_id'=>$product->store_id,
					'store_name'=>$product->store_name,
					'pro_quantity'=>post('qty'),
					'special_inst'=>post('special_instruction'),
					's_id'=>$subOrderId
				);
				$order_item_id = $this->order->insertOrderItem($dataInsert);

				if($this->input->post('option')){
					foreach ($this->input->post('option') as $k) {
						$options_val_item = $this->order->getOptionData($k);
						$dataItem = array(
							'order_item_id'=>$order_item_id,
							'product_id'=>$product->product_id,
							'option_name'=>$options_val_item->option_name,
							'option_value'=>$options_val_item->option_value,
							'option_id'=>$options_val_item->option_id,
							'option_value_id'=>$options_val_item->po_id,
							'price'=>$options_val_item->price,
						);
						$order_item_value_id = $this->order->insertOrderItemVal($dataItem);
					}
				}
				// update suborder totalamt
				$totalSubOrder = $this->order->suborderTotalamt($subOrderId);


			}else{

				// suborder create and then after insert new product to suborder
				$suborderData = array(
					'o_id'=>post('order_id'),
					'store_id'=>post('store_id'),
					'store_name'=>post('store_name'),
					'delivery_option'=>$mainOrder->delivery_option,
					'delivery_date_time'=>date('Y-m-d H:i',strtotime($mainOrder->delivery_or_pic_datetime)),
					'tip'=>$mainOrder->tip_amount,
					'comment'=>post('special_instruction'),
					'date_added'=>date('Y-m-d'),
					'order_status_id'=>1

				);
				$subid = $this->order->insertsubOrder($suborderData);
				$dataInsert = array(
					'o_id'=>post('order_id'),
					'product_id'=>$product->product_id,
					'product_name'=>$product->product_name,
					'product_price'=>$product->price,
					'store_id'=>$product->store_id,
					'store_name'=>$product->store_name,
					'pro_quantity'=>post('qty'),
					'special_inst'=>post('special_instruction'),
					's_id'=>$subid
				);
				$order_item_id = $this->order->insertOrderItem($dataInsert);

				if($this->input->post('option')){
					foreach ($this->input->post('option') as $k) {
						$options_val_item = $this->order->getOptionData($k);
						$dataItem = array(
							'order_item_id'=>$order_item_id,
							'product_id'=>$product->product_id,
							'option_name'=>$options_val_item->option_name,
							'option_value'=>$options_val_item->option_value,
							'option_id'=>$options_val_item->option_id,
							'option_value_id'=>$options_val_item->po_id,
							'price'=>$options_val_item->price,
						);
						$order_item_value_id = $this->order->insertOrderItemVal($dataItem);
					}
				}

				$totalSubOrder = $this->order->suborderTotalamt($subid);


			}
			if($order_item_id){
				$this->session->set_flashdata('success','Order Successfully Updated');
				redirect('orders/edit/'.post('order_id').'');
			}else{
				$this->session->set_flashdata('error','Error in Updated');
				redirect('orders/edit/'.post('order_id').'');
			}
		}
	}
	// update product end

	// delete Product and update suborder
	public function deleteitemandvalue($id,$suborder){
		$this->order->deleteItem($id);
		$ret = $this->order->suborderTotalamt($suborder);
		
		if($ret){
			
			echo 'success';
		}else{
			echo 'error';
		}
	}

	// get product for model on click
	public function getproduct(){
		$data['products'] = $this->order->getProductOption();
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/order/addproductoption')) {
			$this->load->view('themes/' . $theme . '/template/order/addproductoption', $data);
		}else{
			$this->load->view('themes/default/template/order/addproductoption', $data);
		}	
	}
	public function getproductsbycat(){

		$id = post('cat_id');
		$ret = $this->order->get_product_by_cat($id);
		echo json_encode($ret);
		exit;
	}
	public function addtocartForOrder(){
		$id = post('product_id');
		$ret = $this->order->get_product_by_id($id);
		echo json_encode($ret);
		exit;
	}

	public function addtocartOrder(){
		$total = 0;
		$option_id = array();
		$option_value_id =array();
		if($this->input->post('option')){
			foreach ($this->input->post('option') as $key ) {
				$option = $this->order->getOptionData($key);
				$option_id[] = $option->option_group_id;
				$option_value_id[] = $option->po_id;
				$total = $total + $option->price;
			}
		}
		$totalprice  = $total + $this->input->post('price');
		$data = array(
			   'id'      =>$this->input->post('product_id'),
			   'qty'     =>$this->input->post('qty'),
			   'price'   =>$totalprice,
			   'name'    =>$this->input->post('product_name'),
			   'options' =>array(
					'product_option' => $this->input->post('option'),
					'special_instruction'=>post('special_instruction')
				),
			   'store_id' =>post('store_id'),
			   
		);
		$this->cart->insert($data);
		// set store id 
		$this->session->set_userdata('store_id',post('store_id'));
		
		
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/order/showproducts')) {
			$this->load->view('themes/' . $theme . '/template/order/showproducts', $data);
		}else{
			$this->load->view('themes/default/template/order/showproducts', $data);
		}	
	}
	public function removeCart(){
		
		$data = array(
		'rowid'   => post('rowid'),
		'qty'     => 0
		);
		$this->cart->update($data); 
		
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/order/showproducts')) {
			$this->load->view('themes/' . $theme . '/template/order/showproducts', $data);
		}else{
			$this->load->view('themes/default/template/order/showproducts', $data);
		}
	}

	public function generate_invoice(){
		$ret = $this->order->getMaxInvoiceno();
		$newInvoiceNo = $ret->maxinv +1;
		$data = array(
			'invoice_no'=>$newInvoiceNo
		);
		$where = array('o_id'=>post('order_id'));
		$update = $this->order->update($data,$where);
		$newupdatedata = array(
			'invoice_no'=>$ret->invoice_prefix.$newInvoiceNo		
		);
		echo json_encode($newupdatedata);
		exit;
	}
	
	public function getProductData(){
		$data['products'] = $this->order->getProductOption();
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/order/searchproduct')) {
			$this->load->view('themes/' . $theme . '/template/order/searchproduct', $data);
		}else{
			$this->load->view('themes/default/template/order/searchproduct', $data);
		}	
	}
	public function addorderhistroy(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('order_id', 'Order', 'required');
		$this->form_validation->set_rules('order_status_id', 'Order Status', 'required');
		
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			redirect('orders/view/'.post('order_id').'');
		}else{
			$order_id = post('order_id');
			$order_status_id = post('order_status_id');
			$sub_order_id = post('sub_order_id');
			$where = array( 'so_id'=>$sub_order_id);
			$data2 = array(
				
				'order_status_id'=>$order_status_id,
			);
			$this->order->updateStoreOrder($data2,$where);
			$lastStatusId = $this->order->getLastStatusId($orderid,$sub_order_id);
				$data = array(
					'order_id'=>post('order_id'),
					'order_status'=>post('order_status_id'),
					'sub_order_id'=>post('sub_order_id'),
					'comment'=>post('comment'),
					'customer_notify'=>post('notify'),
					'date_added'=>date('Y-m-d'),
				);
			$rets = $this->order->insert_orderHistroy($data);
			if (post('notify')) {
				
				$this->sendmail($order_id,$sub_order_id,$order_status_id,$lastStatusId);
			}
			if($rets){
				$this->session->set_flashdata('success','Order Successfully Updated');
				redirect('orders/view/'.post('order_id').'');
			}else{
				$this->session->set_flashdata('error','Error in Updated');
				redirect('orders/view/'.post('order_id').'');
			}
		}
		

	}

	protected function sendmail($order_id,$sub_order_id,$order_status_id,$lastStatusId){
	
		$data = array();
		$customer_info	= $this->order->getCustInfo($order_id);
		$company_name =$this->setting->get('site_name');
		$email_address = $this->setting->get('email_address');
		$order_status = $this->order->getOrderStatus($order_status_id);
		$last_order_status = $this->order->getOrderStatus($lastStatusId);
		$store_name = $this->order->getStoreName($sub_order_id);
		$subject = 'Your order status is changed';

		$order_mail_template = $this->setting->getMail('order_mail_template');
    	$customerName = $customer_info->first_name.' '.$customer_info->last_name;
        $search  = array('{customername}',' {orderid}','{orderstatus}','{storename}');
        $replace = array($customerName,$order_id,$order_status,$store_name);
        $message = str_replace($search, $replace, $order_mail_template);


        $sms_enabled = $this->setting->get('sms_enabled');
		if ($sms_enabled) {
			$isMsgEnabled = $this->setting->isMsgEnabled('order_mail_template');
			$order_mail_tem = $this->setting->getMsg('order_mail_template');
			
			$company_name = $this->setting->get('site_name');
			$search1  = array('{customername}','{orderid}','{orderstatus}','{storename}');
       		$replace1 = array($customerName,$order_id,$order_status,$store_name);
	        $smsmsg = str_replace($search1, $replace1, $order_mail_tem);
	        $phone = $customer_info->phone;

			if ($isMsgEnabled) {
				$this->load->helper('twilio');
				$sid = $this->setting->get('twilio_sid');
				$token = $this->setting->get('twilio_auth_token');
				$twilio_messaging_service_sid = $this->setting->get('twilio_messaging_service_sid');
				$service = get_twilio_service($sid, $token);

				if ($phone) {
					$phoneNo = '+'.$phone;
					$sms =  $service->account->messages->create(array(
						'To' => $phoneNo,
						'MessagingServiceSid' =>$twilio_messaging_service_sid,
						'Body' =>$smsmsg,
					));
				}
				
			}	
		}

		//mail library
		$this->load->library('email');
		$config['protocol']     = $this->setting->get('mail_protocol');//'smtp';
		$config['smtp_host']    = $this->setting->get('smtp_host');//'ssl://smtp.gmail.com';
		$config['smtp_port']    = $this->setting->get('smtp_port');//'465';
		$config['smtp_timeout'] = $this->setting->get('smtp_timeout');//'7';
		$config['smtp_user']    = $this->setting->get('smtp_user');//'mygmail@gmail.com';
		$config['smtp_pass']    = $this->setting->get('smtp_pass');
		$config['charset']      = 'utf-8';
		$config['newline']      = "\r\n";
		$config['mailtype']     = 'html';
		$this->email->initialize($config);
		$this->email->from($email_address, $company_name);
		$this->email->to($customer_info->email); 
		$this->email->subject($subject);
		$this->email->message($message);	
		$this->email->send();
		//echo $this->email->print_debugger();
		//die;
		return true;		
	}

	public function updateRead(){
		if (post('is_ajax')) {
			$ret = $this->order->updateRecentOrder();
			echo json_encode($ret);			
		}
	}

	public function getrecentorders(){
		if (post('is_ajax')) {
			$ret = $this->order->getRecentOrder();
			$array =  (array) $ret;
			echo json_encode($array);			
		}
	}

	
	
	function deletemultiple(){
		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success','Deleted Successfully  ');
			$ret =  $this->order->delete($u);

		}
		echo json_encode($ret);
		exit;
	}
	// json methods
	public function getCustAddress(){
		$ret = $this->order->getCustmerAddress();
		echo json_encode($ret );
		die;
	}
	public function getAddressdetails(){
		$ret = $this->order->getAddressDet();
		echo json_encode($ret);
		die;
	}
	public function searchproducts(){
		$data = array();
		$product = $this->order->productSearch();
		echo json_encode($product);
	}
	public function getproducts(){
		$data = array();
		$product = $this->order->getProduct();
		echo json_encode($product);
	}
	public function getStore(){
		$zipcode = post('zip');
		$ret = $this->order->getStoreByzip($zipcode);
		echo json_encode($ret);
		die;
	}
	public function getperpage(){
		if(empty($this->session->userdata('per_page'))){
			return 10;
		}else{
			return $this->session->userdata('per_page');
		}
	}
}	

/* End of file orders.php */
/* Location: ./application/controllers/orders.php */	