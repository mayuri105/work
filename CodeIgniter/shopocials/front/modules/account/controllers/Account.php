<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('account_model', 'account');
		$this->load->helper('string');
		$this->load->helper('form');
		$this->load->helper('url');
		
	}

	

	public function profile()
	{	
		(!is_login()) ? redirect('account/login') : '';
		$c_id = $this->session->userdata('c_id');
		$data =array();
		$data['customerinfo'] =  $this->account->getcustomerbyid($c_id);
		$theme = $this->session->userdata('front_theme');
       	
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/edit_profile')) {
            $this->load->view('themes/' . $theme . '/template/account/edit_profile', $data);
        }else{
            $this->load->view('themes/default/template/account/edit_profile', $data);
        }
	}
	
	
	public	function saveprofile(){
		(!is_login()) ? redirect('home') : '';
		$this->load->library('form_validation');
  
	$this->form_validation->set_rules('first_name', 'FirstName', 'required|min_length[2]|max_length[30]');
	$this->form_validation->set_rules('last_name', 'LastName', 'required|min_length[2]|max_length[30]');
        
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
           redirect('account/profile');

        }else{
            
            $c_id = $this->session->userdata('c_id');
            if(!empty(post('oldpassword'))){
	       	 $query = $this->account->getoldpassword($c_id);
  
			//print_r($query);
  
			//die;
  
			if($query == md5(post('oldpassword'))){
  
				$data= array(					
  
					'password'=>md5(post('password')),					
  
				);	
  
				$where = array('c_id',$c_id);
  
				$ret = $this->account->updatepassword($data,$where);	
  
				$this->session->set_flashdata('success','Password has been changed');
  
				redirect('account/profile');	
  
			}else{
			    
  
				$this->session->set_flashdata('error','Old password not match');
  
				redirect('account/profile');
  
			}

	       	}else{
	       		$data  = array(
	       		'first_name' => post('first_name'),
	       		'last_name'=>post('last_name'),
	       		'email'=>post('email'),
	       		'phone' => post('phone_number'),
	       		'address'=>post('address'),
	       		);
		       	$c_id = $this->session->userdata('c_id');
	     		$where = array('c_id' => $c_id, );
				$ret = $this->account->update($data,$where);
	       

        		$this->session->set_flashdata('success','Customer Profile Updated Successfully..');
        		 redirect('account/profile');
	       	}
           
        	//$password = $this->encrypt->encode(post('password'));
	       	
    	
        	
        	
        }
	}	
	
	public  function seller_register()
	{
		
		$data=array();
		
		$theme = $this->session->userdata('front_theme');
		//$data['categories'] = $this->account->get_category_by_shop();

       
       	
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/seller_register')) {
            $this->load->view('themes/' . $theme . '/template/account/seller_register', $data);
        }else{
            $this->load->view('themes/default/template/account/seller_register', $data);
        }
	}

	public function add_seller()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('business_name', 'Busines Name', 'required|min_length[3]');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[merchant.email]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
		$this->form_validation->set_rules('cpassword', 'confirm Password', 'required|min_length[6]|matches[password]');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|numeric');

		//$this->form_validation->set_rules('shop_cat', 'Category', 'required');
		
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            redirect('account/seller_register');
        }else{
        	$business_uname = $this->generatUnique(post('business_name'));
        	$data= array(
        		'UniqueId'=> random_string('alnum',20),
		        		'business_name'=>$business_uname,
		        		'firstname'=>post('first_name'),
		        		'lastname'=>post('last_name'),
	        		'email'=>post('email'),
	        		'password'=>md5(post('password')),
	        		'phone'=>post('phone_number'),
	
		        			        		
		        	);	
        	$ret = $this->account->insertMerchant($data);
		        
        		
        	
        	if($ret){
        		$to= post('email');
        		//echo $to;die;
        		$businessname = $business_uname;
        		$username= post('first_name') .' '.post('last_name');
        		$password= post('password');
        		$this->sendSignUpmail($to,$businessname,$username,$password);

        		$this->session->set_flashdata('success','Merchant Signup done Check Your Email Account for Activate Account');
        		 redirect('account/seller_register');
       
	
	}
}
}
public  function register()
	{
		
		$data=array();
		
		$theme = $this->session->userdata('front_theme');
		//$data['categories'] = $this->account->get_category_by_shop();

       
       	
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/register')) {
            $this->load->view('themes/' . $theme . '/template/account/register', $data);
        }else{
            $this->load->view('themes/default/template/account/register', $data);
        }
	}
	public function add_customer()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[customer.email]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
		$this->form_validation->set_rules('cpassword', 'confirm Password', 'required|min_length[6]|matches[password]');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|numeric');

		//$this->form_validation->set_rules('shop_cat', 'Category', 'required');
		
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            redirect('account/register');
        }else{
        	$data= array(
		        		'first_name'=>post('first_name'),
		        		'last_name'=>post('last_name'),
	        		'email'=>post('email'),
	        		'password'=>md5(post('password')),
	        		'phone'=>post('phone_number'),
		        	);	
        	$ret = $this->account->insertcustomer($data);
		        
        		
        	
        	if($ret){

        		$this->session->set_flashdata('success','Customer Signup done Check Your Email Account for Activate Account');
        		 redirect('account/register');
       
	
	}
}
}
public  function login()
	{
		
		$data=array();
		
		$theme = $this->session->userdata('front_theme');
		//$data['categories'] = $this->account->get_category_by_shop();

       
       	
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/login')) {
            $this->load->view('themes/' . $theme . '/template/account/login', $data);
        }else{
            $this->load->view('themes/default/template/account/login', $data);
        }
	}
public function validateLogin()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            redirect('account/login');
           

        }else{
	       	$data  = array('email' => post('email'),'password'=>post('password'));
     	
			$ret = $this->account->validate($data);
			if($ret){

    			//$this->session->set_flashdata('success','Customer login done');
        		 redirect('home');
        	}
        	else{
	        	
	          	$this->session->set_flashdata('error','invalid username or password');
	            redirect('account/login');
		    }
        	
        	
        }
}
function forgotpassword(){

		$data=array();
		
		$theme = $this->session->userdata('front_theme');
		//$data['categories'] = $this->account->get_category_by_shop();

       
       	
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/forgotpassword')) {
            $this->load->view('themes/' . $theme . '/template/account/forgotpassword', $data);
        }else{
            $this->load->view('themes/default/template/account/forgotpassword', $data);
        }

	}

public function setforgotpassword(){

$this->load->library('form_validation');
$this->form_validation->set_rules('email', 'email', 'required|valid_email');
      
if($this->form_validation->run() == FALSE){
$this->session->set_flashdata('error', validation_errors());
redirect('account/forgotpassword');
}else{

$email = post('email');
$ret = $this->account->checkuser($email);
//print_r($ret);
//die;

if ($ret) {

$user= $this->account->checkuser($email);

$firstname=$user->first_name;
$lastname=$user->last_name;
$cid=$user->c_id;
//echo $FirstName;
//die;

$resetlink = $this->setting->get('site_url')."/reset?key=".$cid;
$companyname = $this->setting->get('company_name');
//echo $reset_password_link;
//die;
$sendto=$this->sendforgotmail($email,$firstname,$resetlink,$companyname);
if($sendto){	
$this->session->set_flashdata('success','Reset Password Link send  Check Your Inbox');
       	redirect('account/forgotpassword');
}
}
else{
$this->session->set_flashdata('error','please confirm your email');
redirect('account/forgotpassword');
}	


}
}

	public function resetpassword() {
	
		$data=array();
		$data['c_id']= $_GET['key'];
		
		$theme = $this->session->userdata('front_theme');
		//$data['categories'] = $this->account->get_category_by_shop();
       	
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/reset')) {
            $this->load->view('themes/' . $theme . '/template/account/reset', $data);
        }else{
            $this->load->view('themes/default/template/account/reset', $data);
        }

	}
public function reset() {

	$this->load->library('form_validation');
  
	$this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
	$this->form_validation->set_rules('cpassword', 'confirm Password', 'required|min_length[6]|matches[password]');
        
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
           redirect('account/resetpassword');

        }else{
            
            
  				$c_id =post('c_id');
			if(!empty(post('password'))){
  
				$data= array(					
  
					'password'=>md5(post('password')),					
  
				);	
  
				$where = array('c_id',$c_id);
  
				$ret = $this->account->updatepassword($data,$where);	
  
				$this->session->set_flashdata('success','Password has been changed');
  
				redirect('account/resetpassword');	
  
			}else{
			    
  
				$this->session->set_flashdata('error','Password not changed');
  
				redirect('account/resetpassword');
  
			}

	       	}
}


function logout(){
		$this->session->sess_destroy();
		redirect('account/login');
	}
protected function sendSignUpmail($to,$businessname,$username,$password){
		$email_address = $this->setting->get('email_address');
        $welcome_mail_template = $this->setting->getMail('seller_welcome_mail_template');
		$company_name = $this->setting->get('company_name');
		$loginlink = $this->setting->get('site_url').'seller/';
        $search  = array('{email}','{businessname}','{username}','{password}','{company_name}','{loginlink}');
        $replace = array($to,$businessname,$username,$password,$company_name,$loginlink);
        $message = str_replace($search, $replace, $welcome_mail_template);
        $subject = 'Worm welcome on '.$companyname;
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
		$this->email->from($email_address, $companyname);
		$this->email->to($to); 
		$this->email->subject($subject);
		$this->email->message($message);	
		//$this->email->send();
	    if($this->email->send()){
   //Success email Sent
   echo $this->email->print_debugger();
    }else{
   //Email Failed To Send
   echo $this->email->print_debugger();
    }

		
	}

	protected function sendforgotmail($email,$firstname,$resetlink,$companyname){
		$email_address = $this->setting->get('email_address');
        $forgott_mail_template = $this->setting->getMail('customer_forgot_mail_template');
    	$company_name = $this->setting->get('site_name');
    	$reset_password_link = $this->setting->get('site_url').'account/resetpassword/';
        $search  = array('{email}','{username}','{company_name}','{reset_password_link}');
        $replace = array($email,$firstname,$company_name, '<a href="'.$reset_password_link.'">rest password</a>');
        $message = str_replace($search, $replace, $forgott_mail_template);

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
		$this->email->to($email); 
		$this->email->subject('Reset password for "'.$company_name.'"');
		$this->email->message($message);	
		$this->email->send();
		return true;		
	}
	function generatUnique($string,$id=''){
		$this->load->helper('url');
		$string2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string);

		$slug =strtolower($string2);

		$slugrpc = str_replace(' ','', $slug); // Replaces all spaces with hyphens.

		$last = preg_replace('/[^A-Za-z0-9\-]/',' ', $slugrpc); 
		$i = 1; $baseSlug = $last;

		if ($id=='') {
			while($this->store_exist($last)){
				$last = $baseSlug.''.$i++;        
			}

			$mainstring =  $last;
			return url_title($mainstring);	
		}else{
			while($this->store_exist($last,$id)){
				$last = $baseSlug.''.$i++;        
			}

			$mainstring =  $last;
			return url_title($mainstring);	
		}
	
	}
	public function store_exist($store,$id=''){
		
		$this->db->where('business_name',$store);
		$ret = $this->db->get('merchant');

		if($ret->row()){
			return true;
		}else{
			return false;
		}
	}

	
	
	
	


	
}

/* End of file Account.php */
/* Location: ./application/controllers/Account.php */