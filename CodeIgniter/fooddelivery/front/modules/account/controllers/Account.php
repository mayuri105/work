<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('account_model', 'account');

		$this->load->library('encrypt');
		
	}

	
	public function orders()
	{	
		(!is_login()) ? redirect('index') : '';
		$data =array();
		$data['bodyclass'] ='page-order-history';
		$data['order_detail']= $this->account->getorderdetail();
		$theme = $this->session->userdata('front_theme');
       	
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/orders')) {
            $this->load->view('themes/' . $theme . '/template/account/orders', $data);
        }else{
            $this->load->view('themes/default/template/account/orders', $data);
        }
	}
	public function tell_a_friend()
	{	
		(!is_login()) ? redirect('index') : '';
		$data =array();
		$data['bodyclass'] ='page-tell-a-friend';	
		$id= $this->session->userdata('c_id');
		$this->load->helper('share');
		$data['customer'] = $this->account->getcustomerbyid($id);
		$data['refbycredits']=$this->setting->get('refbycredits');
		$data['minorder_for_credits']=$this->setting->get('minorder_for_credits');
		$data['site_name'] = $this->setting->get('site_name');
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/tell-a-friend')) {
            $this->load->view('themes/' . $theme . '/template/account/tell-a-friend', $data);
        }else{
            $this->load->view('themes/default/template/account/tell-a-friend', $data);
        }
	}
	public function profile()
	{	
		(!is_login()) ? redirect('index') : '';
		$c_id = $this->session->userdata('c_id');
		$data =array();
		$data['bodyclass'] ='page-my-account';	

		$data['customer'] =  $this->account->getcustomerbyid($c_id);
		$theme = $this->session->userdata('front_theme');
       	
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/profile')) {
            $this->load->view('themes/' . $theme . '/template/account/profile', $data);
        }else{
            $this->load->view('themes/default/template/account/profile', $data);
        }
	}
	public function addresses()
	{	
		(!is_login()) ? redirect('index') : '';
		$data =array();
		$c_id = $this->session->userdata('c_id');
		$data['bodyclass'] ='page-list-addresses';	
		$data['states'] = getstate();
		$data['address'] = $this->account->getcustomerbyid($c_id);
		$theme = $this->session->userdata('front_theme');
       	
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/addresses')) {
            $this->load->view('themes/' . $theme . '/template/account/addresses', $data);
        }else{
            $this->load->view('themes/default/template/account/addresses', $data);
        }
	}
	public function cards()
	{	
		(!is_login()) ? redirect('index') : '';
		$data =array();
		$c_id = $this->session->userdata('c_id');
		$data['bodyclass'] ='page-list-cards';	
		$theme = $this->session->userdata('front_theme');
       	$data['cards'] = $this->account->getcustomerbyid($c_id);
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/cards')) {
            $this->load->view('themes/' . $theme . '/template/account/cards', $data);
        }else{
            $this->load->view('themes/default/template/account/cards', $data);
        }
	}
	/*Save and update method*/
	public	function saveprofile(){
		(!is_login()) ? redirect('index') : '';
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="message">', '</div>');
		$this->form_validation->set_message('matches', 'The two passwords do not match|');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('lastname', 'lastname', 'required|min_length[3]');
        $this->form_validation->set_rules('firstname', 'firstname', 'required|min_length[3]');
        $this->form_validation->set_rules('password', 'password', 'min_length[5]');
        $this->form_validation->set_rules('confirmpassword', 'confirmpassword','min_length[5]|matches[password]');
        
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            
            $return = array('error'=>validation_errors(),'response'=>0);
            echo json_encode($return);

        }else{

        	$password = $this->encrypt->encode(post('password'));
	       	if(!empty(post('password'))){
	       		$data  = array(
					'first_name' => post('firstname'),
					'last_name'=>post('lastname'),
					'email'=>post('email'),
					'password'=>$password,
		       	);
		       	$c_id = $this->session->userdata('c_id');
	     		$where = array('c_id' => $c_id, );
				$ret = $this->account->update($data,$where);
	       	}else{
	       		$data  = array(
	       		'first_name' => post('firstname'),
	       		'last_name'=>post('lastname'),
	       		'email'=>post('email'),
	       		);
		       	$c_id = $this->session->userdata('c_id');
	     		$where = array('c_id' => $c_id, );
				$ret = $this->account->update($data,$where);
	       	}

		
			$return = array('response'=>1);
        	echo json_encode($return);
    	
        	
        	
        }
	}	
	public	function addaddress(){
		(!is_login()) ? redirect('index') : '';
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="message">', '</div>');
		$this->form_validation->set_rules('street', 'street', 'required');
        $this->form_validation->set_rules('city', 'city', 'required');
        $this->form_validation->set_rules('state', 'state', 'required');
        $this->form_validation->set_rules('zip', 'zip', 'required|min_length[5]|numeric');
        $this->form_validation->set_rules('phone', 'phone','required|min_length[10]|numeric');
        
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            $return = array('error'=>validation_errors(),'response'=>0);
            echo json_encode($return);

        }else{

        	$c_id = $this->session->userdata('c_id');
	       	
	       	if(post('address_id')){
	       		$data  = array(
					'street_address' => post('street'),
					'apt_name'=>post('apt'),
					'city'=>post('city'),
					'state'=>post('state'),
					'phone_no'=>preg_replace('/\D/', '',post('phone')),
					'zip'=>post('zip'),
					'customer_id'=>$c_id,
		       	);
		       	$where = array(
		       		'address_id'=>post('address_id')
		       	);

		       	$ret = $this->account->updateAddress($data,$where);
		       	
    			$return = array('response'=>1,$data,'address_id'=>post('address_id'));
            	echo json_encode($return);
        	
	        	
	       	}else{
	       		$data  = array(
	       		'street_address' => post('street'),
	       		'apt_name'=>post('apt'),
	       		'city'=>post('city'),
	       		'state'=>post('state'),
	       		'phone_no'=>preg_replace('/\D/', '',post('phone')),
	       		'zip'=>post('zip'),
	       		'customer_id'=>$c_id,
	    		
		       	);
		       	$ret = $this->account->insertAddress($data);
	       		

    			$return = array('response'=>1,$data,'address_id'=>$ret);
            	echo json_encode($return);
        	
	        	
	       	}
        	
        }
	}
	public function getaddress(){
		(!is_login()) ? redirect('index') : '';
		if(post('address_id')){
			$id=post('address_id');
			$ret = $this->account->getaddress($id);
			echo json_encode($ret);
			exit();

		}

	}
	public function getcard(){
		(!is_login()) ? redirect('index') : '';
		if(post('cc_id')){
			$id=post('cc_id');
			$ret = $this->account->getcard($id);
			$cardno = $this->encrypt->decode($ret->credit_card_no); 
			$result = array(
				'cc_id'=>$ret->cc_id,
				'credit_card_no'=>$cardno,
				'exp_month'=>$ret->exp_month,
				'exp_year'=>$ret->exp_year,
				'cvv'=>$ret->cvv,
				'billing_zip'=>$ret->billing_zip,
				'customer_id'=>$ret->customer_id,
			);
			echo json_encode($result);
			exit();

		}

	}
	
	public function deleteaddress($id){
		(!is_login()) ? redirect('index') : '';
		if($id){
			$ret =  $this->account->deleteaddress($id);
			if($ret){
				echo 'success';
			}else{
				echo 'error';
			}
			
		}
	}
	public function addcard(){
		(!is_login()) ? redirect('index') : '';
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="message">', '</div>');
		$this->form_validation->set_rules('cardnumber', 'cardnumber', 'required');
        $this->form_validation->set_rules('expmonth', 'expmonth', 'required');
        $this->form_validation->set_rules('expyear', 'expyear', 'required');
        $this->form_validation->set_rules('cvv', 'CVV', 'min_length[3]');
        $this->form_validation->set_rules('billingzip', 'Billing zip','min_length[5]');
        
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            
            $return = array('error'=>validation_errors(),'response'=>0);
            echo json_encode($return);

        }else{

        	$c_id = $this->session->userdata('c_id');
        	$cardno = preg_replace('/\D/', '',post('cardnumber'));
	       	$encrypted = $this->encrypt->encode($cardno);
	       	if(post('cc_id')){
	       		$data  = array(
		       		'credit_card_no' =>$encrypted,
					'exp_month'=>post('expmonth'),
					'exp_year'=>post('expyear'),
					'cvv'=>preg_replace('/\D/', '',post('cvv')),
					'billing_zip'=>preg_replace('/\D/', '',post('billingzip')),
		       		'customer_id'=>$c_id,
		       	);
		       	$where = array(
		       		'cc_id'=>post('cc_id')
		       	);
		       	$ret = $this->account->updateCard($data,$where);
				if($ret){
	    			$return = array('response'=>1,$data,
	    				'card_id'=>post('cc_id'),
	    				'credit_card_no'=>FormatCreditCard(post('cardnumber')),
	    				'cardtype'=>cardType(post('cardnumber'))
	    				);
	            	echo json_encode($return);
	        	}else{
		          	$return = array('error'=>'Error in update','response'=>0);
	            	echo json_encode($return);
			    }
	       	}else{
	       		$data  = array(
		       		'credit_card_no' => $encrypted,
		       		'exp_month'=>post('expmonth'),
		       		'exp_year'=>post('expyear'),
		       		'cvv'=>preg_replace('/\D/', '',post('cvv')),
		       		'billing_zip'=>preg_replace('/\D/', '',post('billingzip')),
		       		'customer_id'=>$c_id,
		       	);
		       	$ret = $this->account->insertCard($data);
				if($ret){
					$return = array('response'=>1,$data,
	    				'card_id'=>$ret,
	    				'credit_card_no'=>FormatCreditCard(post('cardnumber')),
	    				'cardtype'=>cardType(post('cardnumber'))
	    				);
	    			echo json_encode($return);
	            	
	        	}else{
		          	$return = array('error'=>'Error in insert','response'=>0);
	            	echo json_encode($return);
			    }
	        	
	       	}
        	
        }
	}
	public function deletecard($id){
		(!is_login()) ? redirect('index') : '';
		if($id){
			$ret =  $this->account->deletecard($id);
			if($ret){
				echo 'success';
			}else{
				echo 'error';
			}
		}
	}
	public function updateOrderrating(){
		(!is_login()) ? redirect('index') : '';
		$ret =  $this->account->Orderrating();
		if($ret){
			echo 'success';
		}else{
			echo 'error';
		}
	}	
	public function updateOrderFav(){
		(!is_login()) ? redirect('index') : '';
		$ret =  $this->account->orderSetFav();
		if($ret){
			$result = array('fav'=>post('setasfav'));
			echo json_encode($result);
		}else{
			$result = array('fav'=>'0');
			echo json_encode($result);
		}
	}
	public function points(){
		(!is_login()) ? redirect('index') : '';
		$data =array();
		$c_id = $this->session->userdata('c_id');
		$data['bodyclass'] ='page-points';	
		$data['points'] = $this->account->getTotalEarnpoints();
		$data['points50'] =$this->account->getbucketBypoint();
		
		$theme = $this->session->userdata('front_theme');
		$data['pointValue']  = $this->setting->get('redeem_points');
       	$data['cards'] = $this->account->getcustomerbyid($c_id);
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/points')) {
            $this->load->view('themes/' . $theme . '/template/account/points', $data);
        }else{
            $this->load->view('themes/default/template/account/points', $data);
        }
	}
	public function wallets(){
		(!is_login()) ? redirect('index') : '';
		$data =array();
		$c_id = $this->session->userdata('c_id');
		$data['bodyclass'] ='page-order-history';
		$data['wallet'] = $this->account->getWallet();	
		
		$data['redeemHistory'] = $this->account->getredeemHistory();	
		$data['points'] = $this->account->getearnPoints();
		$data['redeemHistory'] = $this->account->getredeemHistory();	
		
		$data['states'] = getstate();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/wallet')) {
            $this->load->view('themes/' . $theme . '/template/account/wallet', $data);
        }else{
            $this->load->view('themes/default/template/account/wallet', $data);
        }
	}
	public function redeempoints(){
		(!is_login()) ? redirect('index') : '';
		$ret = $this->account->redeem();
		if ($ret) {
			$result = array('resuponse_id'=>1,'msg'=>'Success');
			echo json_encode($result);
			exit;	
		}else{
			$result = array('resuponse_id'=>0,'msg'=>'Error');
			echo json_encode($result);
			exit;
		}
	}

	public  function register()
	{
		$this->load->model('index/index_model', 'index');
		$data=array();
		$this->input->get('sharer');
		$data['bodyclass'] ='page-home';
		
		$type = $this->getType();
		$theme = $this->session->userdata('front_theme');
		if($type=='food'){
       		$data['cuisine'] = $this->index->getcuisine(6,0);
       	}

       	$data['city'] = $this->index->getcity(4,0);
       	$data['citylist'] = $this->index->getcityBycategory($type);
       	$data['cuisinelist'] = $this->index->getcuisine(23,6);
       	$data['categories'] = $this->index->getcategory();
       	$data['type'] = $type;
       	
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/register')) {
            $this->load->view('themes/' . $theme . '/template/account/register', $data);
        }else{
            $this->load->view('themes/default/template/account/register', $data);
        }
	}
	public function getType(){
   		if(!$this->session->userdata('type'))
		{
			$userdata = array(
			'type'=>'food'
			);
			 $this->session->set_userdata($userdata);
			 return $this->session->userdata('type');
		}else{
			 return $this->session->userdata('type');
		}
   	}
}

/* End of file Account.php */
/* Location: ./application/controllers/Account.php */