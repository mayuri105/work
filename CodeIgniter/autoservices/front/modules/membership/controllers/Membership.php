<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Membership extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('membership_model', 'membership');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
	}
	// main cars
	public function index()
	{
		
		$perpage = $this->settings->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		$base_url = "/membership/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
        
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->membership->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["membership"] = $this->membership->fetch_data($perpage ,(($page-1) * $perpage));
        $data['customer'] = $this->input->get('customer');
        $data['reg_no'] = $this->input->get('reg_no');
       
        $theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/membership/index')) {
			$this->load->view('themes/' . $theme . '/template/membership/index', $data);
		} else {
			$this->load->view('themes/default/template/membership/index', $data);
			
		}

	}
	// add cars 
	public function add()
	{
		
		$data = array();
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/membership/add')) {
			$this->load->view('themes/' . $theme . '/template/membership/add', $data);
		} else {
			$this->load->view('themes/default/template/membership/add', $data);
			
		}

	}
	// edit cars 
	public function edit($id='')
	{
		if($id=='') redirect('membership');
		
		$data = array();
		$data['membership'] = $this->membership->get($id);
        
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/membership/edit')) {
			$this->load->view('themes/' . $theme . '/template/membership/edit', $data);
		} else {
			$this->load->view('themes/default/template/membership/edit', $data);
			
		}

	}

	
	public function view($id='')
	{
		if($id=='') redirect('membership');
		
		$data = array();
		$data['membership'] = $this->membership->get($id);
        
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/membership/view')) {
			$this->load->view('themes/' . $theme . '/template/membership/view', $data);
		} else {
			$this->load->view('themes/default/template/membership/view', $data);
			
		}

	}
	
	public function addmembership(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('card_no', 'card no', 'required');
		$this->form_validation->set_rules('birthdate', 'birth date', 'required');
		$this->form_validation->set_rules('customer','customer name', 'required');
		$this->form_validation->set_rules('address',' address', 'required');
		$this->form_validation->set_rules('mob_no', ' mobile no', 'required');
		$this->form_validation->set_rules('email', ' email', 'required');
		$this->form_validation->set_rules('reg_no', 'registration no', 'required');
		$this->form_validation->set_rules('fromdate', 'validity from date', 'required');
		$this->form_validation->set_rules('todate', 'validity to date', 'required');
		
		
       
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('membership/add');
	        }else{
	        	
			  
	            
                   	$data= array(
		        	'card_no'=>post('card_no'),
	        		'birthdate'=>post('birthdate'),
	        		'customer'=>post('customer'),
	        		'address'=>post('address'),
	        		'mob_no'=>post('mob_no'),
	        		'email'=>post('email'),
	        		'reg_no'=>post('reg_no'),
	        		'fromdate'=>post('fromdate'),
	        		'todate'=>post('todate'),
	        		'gstin_no'=>post('gstin_no'),
	    	        
		        		
		        	);	
		        	$ret = $this->membership->insert($data);
		        	$this->session->set_flashdata('success','Membership  Added');
	        		redirect('membership');
               
	        	
	        }

	        	
	        	

	}
	

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('card_no', 'card no', 'required');
		$this->form_validation->set_rules('birthdate', 'birth date', 'required');
		$this->form_validation->set_rules('customer','customer name', 'required');
		$this->form_validation->set_rules('address',' address', 'required');
		$this->form_validation->set_rules('mob_no', ' mobile no', 'required');
		$this->form_validation->set_rules('email', ' email', 'required');
		$this->form_validation->set_rules('reg_no', 'registration no', 'required');
		$this->form_validation->set_rules('fromdate', 'validity from date', 'required');
		$this->form_validation->set_rules('todate', 'validity to date', 'required');
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('membership/edit/' . post('membership_id') . '');
			} else {
				
				
				$data2= array(
		        	'card_no'=>post('card_no'),
	        		'birthdate'=>post('birthdate'),
	        		'customer'=>post('customer'),
	        		'address'=>post('address'),
	        		'mob_no'=>post('mob_no'),
	        		'email'=>post('email'),
	        		'reg_no'=>post('reg_no'),
	        		'fromdate'=>post('fromdate'),
	        		'todate'=>post('todate'),
	        		'gstin_no'=>post('gstin_no'),
	    	        
		        		
		        	);	
		        	$where2 = array('membership_id'=>post('membership_id'));
		        	//print_r($data); 
				//die;
		        	$ret = $this->membership->update($data2,$where2);
                	
                	$this->session->set_flashdata('success', 'Membership  Updated');
					redirect('membership');
               
                }
				
			}
		


function membershipdelete($id) {

	$ret=$this->membership->membershipdelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}
	
	
	
}

/* End of file cars.php */
/* Location: ./application/controllers/cars.php */