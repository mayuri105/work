<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('loginmodel');
		$this->load->helper('language');
		$this->lang->load('users');


	}

	public function index()
	{

		$data =array();

		$theme = $this->session->userdata('admin_theme');

        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/login')) {
            $this->load->view('themes/' . $theme . '/template/users/login', $data);
        }else{
            $this->load->view('themes/default/template/users/login', $data);
        }

	}

	public function validateLogin()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            redirect('login');
        }else{


        	$data  = array('username' => post('username'),'password'=>post('password'));

    		$ret = $this->loginmodel->validatemerchant($data);
			if($ret){
    			redirect('home');
        	}else{
	        	$this->session->set_flashdata('error','Credentials Not match');
	            redirect('login');
		     }



        }
	}
	function forgetpassword(){

		$data =array();

		$theme = $this->session->userdata('admin_theme');

        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/login')) {
            $this->load->view('themes/' . $theme . '/template/users/login', $data);
        }else{
            $this->load->view('themes/default/template/users/login', $data);
        }

	}
	public function setforgotpassword(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'email', 'required|valid_email');

		if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				 redirect('login#reminder');
		}else{

			$user_email = post('username');
			$ret = $this->loginmodel->checkuser($user_email);
			//print_r($ret);
			//die;

			if ($ret) {

				$user= $this->loginmodel->checkuser($user_email);

    			$firstname=$user->firstname;
				$lastname=$user->lastname;
				$UniqueId=$user->UniqueId;
				//echo $FirstName;
				//die;

				$resetlink = $this->setting->get('site_url')."/resetpassword?key=".$UniqueId;
				$companyname = $this->setting->get('company_name');
				//echo $reset_password_link;
				//die;
				$sendto=$this->sendforgotmail($user_email,$firstname,$lastname,$resetlink,$companyname);
				if($sendto){
			$this->session->set_flashdata('success','Reset Password Link send  Check Your Inbox');
        	redirect('login#reminder');
				}
		}
		else{
				$this->session->set_flashdata('error','please confirm your email');
				redirect('login#reminder');
			}


		}
		}

		  public function resetpassword() {

		$data = array();
		$data['UniqueId'] = $_GET['key'];

		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/reset')) {
			$this->load->view('themes/' . $theme . '/template/common/reset',$data);
		} else {
			$this->load->view('themes/default/template/common/reset',$data);
		}
	}
	function account(){

		$data =array();





		//print_r($data);

		//die;

		$theme = $this->session->userdata('admin_theme');



		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/account')) {

			$this->load->view('themes/' . $theme . '/template/common/account', $data);

		}else{

			$this->load->view('themes/default/template/common/account', $data);

		}

	}



	function update_account(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('firstname', 'FirstName', 'required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('lastname', 'LastName', 'required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('username', 'Email','required|valid_email');







		if ($this->form_validation->run() == FALSE){

			$this->session->set_flashdata('error', validation_errors());

			redirect('login/account');

		}else{



			$data= array(
				'firstname'=>post('firstname'),
  				'lastname'=>post('lastname'),
				'email'=>post('username'),
			);
			$where = array('m_id'=>post('m_id'));
			$ret = $this->loginmodel->update($data,$where);
			$this->session->set_flashdata('success','Account Updated');
			redirect('login/account');
		}
	}
function changepassword(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('oldpassword', 'Old Password', 'required|min_length[3]');
		$this->form_validation->set_rules('newpassword', 'New Password', 'required|min_length[3]');
		$this->form_validation->set_rules('confpassword', 'Confirm Password', 'required|min_length[3]');

		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			redirect('login/account/');
		}else{
			$data= array(
				'username'=>post('username'),

			);



			$query = $this->loginmodel->getoldpassword($data);

			//print_r($query);

			//die;

			if($query == md5(post('oldpassword'))){

				$data= array(

					'password'=>md5(post('newpassword')),

				);

				$where = array('username'=>post('username'));

				$ret = $this->loginmodel->updatepassword($data,$where);

				$this->session->set_flashdata('success','Password has been changed');

				redirect('login/account');

			}else{

				$this->session->set_flashdata('error','Old password not match');

				redirect('login/account');

			}



		}





	}


	protected function sendforgotmail($user_email,$FirstName,$LastName,$resetlink,$companyname){
		$email_address = $this->setting->get('email_address');
        $forgotpw_mail_template = $this->setting->getMail('merchant_forgot_mail_template');


        $search  = array('{firstname}','{lastname}','{resetlink}','{companyname}');
        $replace = array($firstname,$lastname,$resetlink);
        $message = str_replace($search, $replace, $forgotpw_mail_template);
        $subject = 'Reset Password';
        //mail library
        $this->load->library('email');
        $config['protocol']     = $this->defaultsetting->get('mail_protocol');//'smtp';
        $config['smtp_host']    = $this->defaultsetting->get('smtp_host');//'ssl://smtp.gmail.com';
        $config['smtp_port']    = $this->defaultsetting->get('smtp_port');//'465';
        $config['smtp_timeout'] = $this->defaultsetting->get('smtp_timeout');//'7';
        $config['smtp_user']    = $this->defaultsetting->get('smtp_user');//'mygmail@gmail.com';
        $config['smtp_pass']    = $this->defaultsetting->get('smtp_pass');
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['mailtype']     = 'html';
        $this->email->initialize($config);

		$this->email->from($email_address);
		$this->email->to($user_email);

		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
		return 1;
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */