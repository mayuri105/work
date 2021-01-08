<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Package extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('package_models', 'package');
		// $this->load->library('cart');

		if(!is_login()){
			redirect('index');
		}

	}
	public function index() {

		$data = array();
		
		$theme = $this->session->userdata('front_theme');
		$id = $this->input->get('id');
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		$data['user'] = getActiveCustomerInfo();
		$data['package'] = $this->package->getPackage($id);
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/package/index')) {
			$this->load->view('themes/' . $theme . '/template/package/index', $data);
		} else {
			$this->load->view('themes/default/template/package/index', $data);
		}
	}

	function buypackage(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('package_id', 'package_id', 'required');
       
        if ($this->form_validation->run() == FALSE){
        	$return  =  $this->session->flashdata('error',validation_errors());
            redirect('package','refresh');
        }else{
        	$package_id = post('package_id');
        	$package = $this->package->getPackageInfo($package_id);
        	$cust = getActiveCustomerInfo();
        	$ret = checkPackage($package->package_category_id);
        	if($ret){
        		$addDays = $ret->extend_days_for_same_package;
        		$totalDays = $package->package_periods + $addDays;
        		$endDate =  date('Y-m-d', strtotime("+".$totalDays." days"));

        		$data = array(
        			'package_end_date'=>$endDate,
        			'payment_done'=>0,
        		);
        		$buyPackId = $ret->cp_id;
        		$this->package->updateAlreadyBuyPackage($data,$buyPackId);

	        	$userDa = array('buypackage'=>$buyPackId);
	        	$this->session->set_userdata($userDa);
        	}else{
        		$endDate =  date('Y-m-d', strtotime("+".$package->package_periods." days"));
        		$data = array(
	        		'customer_id'=>$cust->c_id,
	        		'package_name'=>$package->package_name,
	        		'package_id'=>$package->package_id,
	        		'package_price'=>$package->package_price,
	        		'package_start_date'=>date('Y-m-d'),
	        		'package_end_date'=>$endDate,
	        		'totalamt'	=>$package->package_price,
	        		'package_category_id'=>$package->package_category_id,
	        		'payment_done'=>0,
					'payment_method'=>'PayUmoney',
					'added_date'=>date('Y-m-d')
	        	);
	        	$buyPackId = $this->package->buypackage($data);
	        	$userDa = array('buypackage'=>$buyPackId);
	        	$this->session->set_userdata($userDa);
        	}
        	$data = array(
        		'customer_id'=>$cust->c_id,
        		'package_name'=>$package->package_name,
        		'package_price'=>$package->package_price,
        		'package_start_date'=>date('Y-m-d'),
        		'package_end_date'=>$endDate,
        		'totalamt'	=>$package->package_price,
        		'package_category_id'=>$package->package_category_id,
        		'payment_done'=>0,
				'payment_method'=>'PayUmoney',
				'added_date'=>date('Y-m-d')
        	);
        	$ret = $this->package->customer_package_history($data);
        	$userDa = array('history'=>$ret);
	        $this->session->set_userdata($userDa);
        	redirect('payumoney','refresh');	
        }
	}

	public function success(){

		$package_id = $this->session->userdata('buypackage');
		if($package_id){
			$packageInfo = $this->package->getBuyPackData($package_id);
	        $cust = getActiveCustomerInfo();
			$userDa = array('buypackage','history');

			$this->session->unset_userdata($userDa);
			$data = array();
			$theme = $this->session->userdata('front_theme');
			$data['title'] = $this->setting->get('site_name');
			$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
			$data['meta_keywords'] = $this->setting->get('meta_keywords');
			$data['meta_titles'] = $this->setting->get('meta_titles');
			$data['active_package'] = $this->package->getActivePackage();

			$this->sendSubscriptionMail($packageInfo,$cust->first_name,$cust->email);
			//$this->sendSubscriptionMsg($packageInfo,$cust->first_name,$cust->phone);



			if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/package/success')) {
				$this->load->view('themes/' . $theme . '/template/package/success', $data);
			} else {
				$this->load->view('themes/default/template/package/success', $data);
			}
	
		}else{
			redirect('package');
		}
		
	}


	protected function sendSubscriptionMsg($packageInfo,$customername,$mobile){

		$package_subscribed = $this->setting->getMsg('package_subscribed');
		$company_name = $this->setting->get('site_name');
    	$package_name =$packageInfo->package_name;
    	$date =$packageInfo->package_end_date;
    	$price = $packageInfo->package_price;
   		$search  = array('{customername}','{package_name}','{price}','{date}','{company_name}');
        $replace = array($customername, $package_name, $price,$date,$company_name);
        $message = str_replace($search, $replace, $package_subscribed);
        send_msg($mobile,$message);
	}

	protected function sendSubscriptionMail($packageInfo,$customername,$to){

		$email_address = $this->setting->get('email_address');
        $package_subscribed = $this->setting->getMail('package_subscribed');
        // variables
    	$company_name = $this->setting->get('site_name');
    	$package_name =$packageInfo->package_name;
    	$date =$packageInfo->package_end_date;
    	$price = $packageInfo->package_price;

        $search  = array('{customername}','{package_name}','{price}','{date}','{company_name}');
        $replace = array($customername, $package_name, $price,$date,$company_name);
        $message = str_replace($search, $replace, $package_subscribed);
        $subject = 'Package Subscription Details-"'.$company_name.'"';
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
		$this->email->to($to); 
		$this->email->subject($subject);
		$this->email->message($message);	
		$this->email->send();
		return true;		
	}

	public function payment_pending(){
		$userDa = array('buypackage');
		$this->session->unset_userdata($userDa);
		$data = array();
		$theme = $this->session->userdata('front_theme');
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/package/pending')) {
			$this->load->view('themes/' . $theme . '/template/package/pending', $data);
		} else {
			$this->load->view('themes/default/template/package/pending', $data);
		}

	}
	public function payment_failure(){
		$userDa = array('buypackage');
		$this->session->unset_userdata($userDa);
		$data = array();
		$theme = $this->session->userdata('front_theme');
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/package/failure')) {
			$this->load->view('themes/' . $theme . '/template/package/failure', $data);
		} else {
			$this->load->view('themes/default/template/package/failure', $data);
		}

	}
		
}

/* End of file package.php */
/* Location: ./application/controllers/package.php */
