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
		$data = array();
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
			
		$data['order_no'] = $this->input->get('order_id');
		$data['order_status'] = $this->input->get('order_status');
       $data['order_status'] = $this->input->get('order_status');
        $data['payment_status'] = $this->input->get('payment_status');
        
        $data['created_on'] = $this->input->get('created_on');
        $data['order_statusd'] = $this->order->getorder_status();
		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/order/index')) {
			$this->load->view('themes/' . $theme . '/template/order/index', $data);
		} else {
			$this->load->view('themes/default/template/order/index', $data);
		}
	}

	
	// update order
	public function updateorderData(){
			$dataOrder = $this->input->post('order_status');
			//echo $dataOrder;die;
			$o_id = $this->input->post('o_id');
			$ret = $this->order->updatestatus($dataOrder,$o_id);
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));

			$this->session->set_flashdata('success', 'Update Successfully  ');
		
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

	
}	

/* End of file orders.php */
/* Location: ./application/controllers/orders.php */	