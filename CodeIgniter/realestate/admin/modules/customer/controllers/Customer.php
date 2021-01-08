<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MX_Controller {

	
	public function __construct(){
		
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
		$perpage = $this->setting->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/customer/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->customer->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data['customer'] = $this->input->get('customer');
        $data['email'] = $this->input->get('email');
        $data['phone'] = $this->input->get('phone');
        $data['enable'] = $this->input->get('enable');
        $data['date_added'] = $this->input->get('date_added');
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
		$data['customer'] = $this->customer->getcustomerbyid($id);
		$data['property'] = $this->customer->getcustomerFollowedProp($id);
		$data['package'] = $this->customer->getcustomerPackage($id);
			
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
		$this->form_validation->set_rules('confirm', 'Confirm Password', 'required|min_length[5]');

        if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('customer/addcustomer');
	        }else{
	        	$upload_path =  $this->config->item('upload_path').'/customer';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('fileinput')) {
                    $image = $this->upload->data();
                   	$pw =$this->encrypt->encode(post('password'));
		        	$data= array(
		        		'first_name'=>post('firstname'),
		        		'last_name'=>post('lastname'),
		        		'email'=>post('email'),
		        		'password'=>$pw,
		        		'phone'=>preg_replace('/(?<=\d)[^\d]+/', '',post('phone')),
		        		'newsletter'=>post('newsletter'),
		        		'enabled'=>post('enabled'),
		        		'created_on'=>date('Y-m-d'),
		        		'address'=>post('address'),
		        		'city'=>post('city'),
		        		'state'=>post('state'),
		        		'profile_picture'=>$image['file_name'],
		        		'ip'=>$this->remoteaddress->getIpAddress()
		        	);	
					$ret = $this->customer->insert($data);
		        }else{
                	$pw =$this->encrypt->encode(post('password'));
		        	$data= array(
		        		'first_name'=>post('firstname'),
		        		'last_name'=>post('lastname'),
		        		'email'=>post('email'),
		        		'password'=>$pw,
		        		'phone'=>preg_replace('/(?<=\d)[^\d]+/', '',post('phone')),
		        		'newsletter'=>post('newsletter'),
		        		'enabled'=>post('enabled'),
		        		'created_on'=>date('Y-m-d'),

		        		'address'=>post('address'),
		        		'city'=>post('city'),
		        		'state'=>post('state'),
		        		
		        		'ip'=>$this->remoteaddress->getIpAddress()
		        	);	
		        	$ret = $this->customer->insert($data);
		         }
	        	addactivty('Customer Created');
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

		if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('customer/edit/'.post('c_id').'');
	        }else{
	        	$upload_path =  $this->config->item('upload_path').'/customer';
	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('fileinput')) {
                    $image = $this->upload->data();
                   	$pw =$this->encrypt->encode(post('password'));
		        	$data= array(
		        		'first_name'=>post('firstname'),
		        		'last_name'=>post('lastname'),
		        		'email'=>post('email'),
		        		'password'=>$pw,
		        		'phone'=>preg_replace('/(?<=\d)[^\d]+/', '',post('phone')),
		        		'newsletter'=>post('newsletter'),
		        		'enabled'=>post('enabled'),
		        		'profile_picture'=>$image['file_name'],
		        		'address'=>post('address'),
		        		'city'=>post('city'),
		        		'state'=>post('state'),
		        	);	
		        	$where = array('c_id'=>post('c_id'));
		        	$ret = $this->customer->update($data,$where);
		        	$id = post('c_id');
		        	
		        	
                }else{
                	$pw =$this->encrypt->encode(post('password'));
		        	$data= array(
		        		'first_name'=>post('firstname'),
		        		'last_name'=>post('lastname'),
		        		'email'=>post('email'),
		        		'password'=>$pw,
		        		'phone'=>preg_replace('/(?<=\d)[^\d]+/', '',post('phone')),
		        		'newsletter'=>post('newsletter'),
		        		'enabled'=>post('enabled'),
		        		'ip'=>$this->remoteaddress->getIpAddress(),
		        		'address'=>post('address'),
		        		'city'=>post('city'),
		        		'state'=>post('state'),
		        	);	
		        	$where = array('c_id'=>post('c_id'));
		        	$ret = $this->customer->update($data,$where);
		        	
		        	
                }
	        	addactivty('Customer Updated');
        		$this->session->set_flashdata('success','Customer Updated');
        		redirect('customer/edit/'.post('c_id').'');
	        }
	        
	    }else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('customer/edit/'.post('c_id').'');
	    }   
	}

	// multiple delete customer method
	function deletemultiple(){
		foreach ($this->input->post('delete') as $u) {
			addactivty('Customer Deleted');
			$this->session->set_flashdata('success','Deleted Successfully  ');
			$ret =  $this->customer->delete($u);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($ret));
	
	}
}

/* End of file Customer.php */
/* Location: ./application/controllers/Customer.php */ ?>