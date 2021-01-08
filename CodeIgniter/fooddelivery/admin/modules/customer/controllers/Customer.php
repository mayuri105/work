<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MX_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('customer_model', 'customer');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
		$this->load->library('encrypt');
		$this->load->library('remoteaddress');
	}

	public function index()
	{

		$data = array();

		//pagination 

		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$perpage = $this->setting->get('per_page');

		$base_url = "customer/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->customer->record_count());
        $data["pagination_helper"]   = $this->pagination;
		
       	$data['customer'] = $this->input->get('customer');
        $data['email'] = $this->input->get('email');
        $data['phone'] = $this->input->get('phone');
        $data['enable'] = $this->input->get('enable');
        $data['date_added'] = date('m-d-Y',strtotime($this->input->get('date_added')));
        $data['ip'] = $this->input->get('ip');
		$data["customers"] = $this->customer->fetch_data($perpage ,(($page-1) * $perpage));
		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/customer/index')) {
			$this->load->view('themes/' . $theme . '/template/customer/index', $data);
		} else {
			$this->load->view('themes/default/template/customer/index', $data);
			
		}

	}
	// add customer form page
	public function addcustomer(){
		$data = array();
		$data['states'] = getstate();
		
		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/customer/add')) {
			$this->load->view('themes/' . $theme . '/template/customer/add', $data);
		} else {
			$this->load->view('themes/default/template/customer/add', $data);
			
		}

	}
	// edit customer form page
	public function edit($id=''){
		if ($id=='') {
			redirect('customer');
		}

		$data = array();
		$data['states'] = getstate();
		$data['customer'] = $this->customer->getcustomerbyid($id);
		$data['orders'] = $this->customer->getorders($id);
		$data['walletHistory'] = $this->customer->walletHistory($id);
		$data['pointsHistory'] = $this->customer->pointsHistory($id);
		$data['wall'] = $this->customer->wallet($id);
		$data['rewar'] = $this->customer->reward($id);
		
		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/customer/edit')) {
			$this->load->view('themes/' . $theme . '/template/customer/edit', $data);
		} else {
			$this->load->view('themes/default/template/customer/edit', $data);
			
		}
	}

	// add customer submit method
	public function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[customer.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('firstname');
		$this->form_validation->set_rules('lastname');
		$this->form_validation->set_rules('phone', 'phone', 'numeric|max_length[12]');


				
        if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            $data = array();
	           	$theme = $this->session->userdata('admin_theme');
				//load view 
				if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/customer/add')) {
					$this->load->view('themes/' . $theme . '/template/customer/add', $data);
				} else {
					$this->load->view('themes/default/template/customer/add', $data);
					
				}
	        }else{
	        	
	        	$pw =$this->encrypt->encode(post('password'));
	        	$data= array(
	        		'first_name'=>post('firstname'),
	        		'last_name'=>post('lastname'),
	        		'email'=>post('email'),
	        		'password'=>$pw,
	        		'phone'=>post('phone'),
	        		'newsletter'=>post('newsletter'),
	        		'enabled'=>post('enabled'),
	        		'created_on'=>date('Y-m-d'),
	        		'ip'=>$this->remoteaddress->getIpAddress()
	        	);	

	        	$ret = $this->customer->insert($data);
	        	$address = $this->input->post('address');
	        	$customer_id = $ret;
	        	$this->customer->insertAdd($address,$customer_id);
	        	addactivity('Customer Created');
	        	$this->session->set_flashdata('success','Customer Created');
	        	redirect('customer/addcustomer');
	        	
	        }
	 	}else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('customer/addcustomer');
	    }       
	}

	// update customer method
	public function update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('c_id', 'c_id', 'required');
		$this->form_validation->set_rules('phone', 'phone', 'numeric|max_length[12]');
		if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('customer/edit/'.post('c_id').'');
	        }else{

	        	if(post('newpassword')){
	        		$this->db->where('c_id',post('c_id'));
						$pw =$this->encrypt->encode(post('newpassword'));
			        	$data= array(
			        		'first_name'=>post('firstname'),
			        		'last_name'=>post('lastname'),
			        		'email'=>post('email'),
			        		'password'=>$pw,
			        		'phone'=>post('phone'),
			        		'newsletter'=>post('newsletter'),
			        		'enabled'=>post('enabled'),
			        		'created_on'=>date('Y-m-d'),
			        		'ip'=>$this->remoteaddress->getIpAddress()
			        	);	
			       
			        $where =array('c_id'=>post('c_id'));	
		        	$ret = $this->customer->update($data,$where);
		        	$id = post('c_id');
		        	$this->customer->deleteAddress($id);
		        	$address = $this->input->post('address');
		        	$this->customer->insertAdd($address,$id);	        		
				}else{

		        	$data= array(
		        		'first_name'=>post('firstname'),
		        		'last_name'=>post('lastname'),
		        		'email'=>post('email'),
		        		'phone'=>post('phone'),
		        		'newsletter'=>post('newsletter'),
		        		'enabled'=>post('enabled'),
		        		'created_on'=>date('Y-m-d'),
		        		'ip'=>$this->remoteaddress->getIpAddress()
		        	);	
		        	$where =array('c_id'=>post('c_id'));	
		        	$ret = $this->customer->update($data,$where);
		        	
		        	$id = post('c_id');
		        	$this->customer->deleteAddress($id);
		        	$address = $this->input->post('address');
					$this->customer->insertAdd($address,$id);		        	
	        	}
	        	addactivity('Customer Updated');
        		$this->session->set_flashdata('success','Customer Update');
        		redirect('customer/edit/'.post('c_id').'');
	        }
	    }else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('customer/edit/'.post('c_id').'');
	    }   
	}

	// ajax method for get city of state
	public function getcitybystate($code){
		$return = $this->customer->getCity($code);
		$this->output->set_content_type('application/json')->set_output(json_encode($return));
	}

	// multiple delete customer method
	function deletemultiple(){

		 if(checkModification()){
			foreach ($this->input->post('delete') as $u) {
				$this->session->set_flashdata('success','Deleted Successfully  ');
				$ret =  $this->customer->delete($u);
				$this->output->set_content_type('application/json')->set_output(json_encode($ret));
			}
		}else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        $this->output->set_content_type('application/json')->set_output(json_encode('1'));
	    } 
		
	}
}

/* End of file Customer.php */
/* Location: ./application/controllers/Customer.php */ ?>