<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amc extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('amc_model', 'plus');
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
		$base_url = "/plus/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
        
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->plus->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["plus"] = $this->plus->fetch_data($perpage ,(($page-1) * $perpage));
        
        
        $theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/amc/index')) {
			$this->load->view('themes/' . $theme . '/template/plus/index', $data);
		} else {
			$this->load->view('themes/default/template/amc/index', $data);
			
		}

	}
	// add cars 
	public function add()
	{
		
		$data = array();
			$data['gst'] = $this->settings->get('gst');
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/amc/add')) {
			$this->load->view('themes/' . $theme . '/template/amc/add', $data);
		} else {
			$this->load->view('themes/default/template/amc/add', $data);
			
		}

	}
	// edit cars 
	public function edit($id='')
	{
		if($id=='') redirect('amc');
		
		$data = array();
			$data['gst'] = $this->settings->get('gst');
		$data['plus'] = $this->plus->get($id);
        
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/amc/edit')) {
			$this->load->view('themes/' . $theme . '/template/amc/edit', $data);
		} else {
			$this->load->view('themes/default/template/amc/edit', $data);
			
		}

	}

	
	public function view($id='')
	{
		if($id=='') redirect('amc');
		
		$data = array();
		$data['gst'] = $this->settings->get('gst');
		$data['plus'] = $this->plus->get($id);
        
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/amc/view')) {
			$this->load->view('themes/' . $theme . '/template/amc/view', $data);
		} else {
			$this->load->view('themes/default/template/amc/view', $data);
			
		}

	}
	
	public function addamc(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('customer','beneficiary name', 'required');
		$this->form_validation->set_rules('address','beneficiary address', 'required');
		$this->form_validation->set_rules('mob_no', 'beneficiary mobile no', 'required');
		$this->form_validation->set_rules('email', 'beneficiary email', 'required');
		$this->form_validation->set_rules('reg_no', 'registration no', 'required');
		$this->form_validation->set_rules('registration_date', 'registration Date', 'required');
		$this->form_validation->set_rules('make', 'Make / Model / Variant', 'required');
		$this->form_validation->set_rules('validity_from_date', 'certificate from date', 'required');
		$this->form_validation->set_rules('validity_to_date', 'certificate to date', 'required');
			$this->form_validation->set_rules('km', 'Kilometer', 'required');
			$this->form_validation->set_rules('amount', 'amount', 'required');
		$this->form_validation->set_rules('sgst', 'SGST', 'required');
		$this->form_validation->set_rules('cgst', 'CGST', 'required');
		//$this->form_validation->set_rules('gsrin_no', 'CGST No', 'required');
		$this->form_validation->set_rules('total_amt', 'total amount', 'required');
		
       
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('amc/add');
	        }else{
	        	
			 
                   	$data= array(
		        	
	        		'customer'=>post('customer'),
	        		'address'=>post('address'),
	        		'mob_no'=>post('mob_no'),
	        		'email'=>post('email'),
	        		'reg_no'=>post('reg_no'),
	        		'registration_date'=>post('registration_date'),
	        		'gstin_no'=>post('gstin_no'),
	        		'make'=>post('make'),
	        		'validity_from_date'=>post('validity_from_date'),
	        		'validity_to_date'=>post('validity_to_date'),
	        		'km'=>post('km'),
	        		'amount'=>post('amount'),
	        		'sgst'=>post('sgst'),
	        		'cgst'=>post('cgst'),
	        		'total_amt'=>post('total_amt'),
	    	       
		        		
		        	);	
		        	$ret = $this->plus->insert($data);
		        	$this->session->set_flashdata('success','AMC Plan Added');
	        		redirect('amc');
               
	        	
	        }

	        	
	        	

	}
	

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('customer','beneficiary name', 'required');
		$this->form_validation->set_rules('address','beneficiary address', 'required');
		$this->form_validation->set_rules('mob_no', 'beneficiary mobile no', 'required');
		$this->form_validation->set_rules('email', 'beneficiary email', 'required');
		$this->form_validation->set_rules('reg_no', 'registration no', 'required');
		$this->form_validation->set_rules('registration_date', 'registration Date', 'required');
		$this->form_validation->set_rules('make', 'Make / Model / Variant', 'required');
		$this->form_validation->set_rules('validity_from_date', 'certificate from date', 'required');
		$this->form_validation->set_rules('validity_to_date', 'certificate to date', 'required');
			$this->form_validation->set_rules('km', 'Kilometer', 'required');
			$this->form_validation->set_rules('amount', 'amount', 'required');
		$this->form_validation->set_rules('sgst', 'SGST', 'required');
		$this->form_validation->set_rules('cgst', 'CGST', 'required');
		//$this->form_validation->set_rules('gsrin_no', 'CGST No', 'required');
		$this->form_validation->set_rules('total_amt', 'total amount', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('amc/edit/' . post('amc_id') . '');
			} else {
				
				$data2= array(
		        	
	        		'customer'=>post('customer'),
	        		'address'=>post('address'),
	        		'mob_no'=>post('mob_no'),
	        		'email'=>post('email'),
	        		'reg_no'=>post('reg_no'),
	        		'registration_date'=>post('registration_date'),
	        		'gstin_no'=>post('gstin_no'),
	        		'make'=>post('make'),
	        		'validity_from_date'=>post('validity_from_date'),
	        		'validity_to_date'=>post('validity_to_date'),
	        		'km'=>post('km'),
	        		'amount'=>post('amount'),
	        		'sgst'=>post('sgst'),
	        		'cgst'=>post('cgst'),
	        		'total_amt'=>post('total_amt'),
	    	        
		        		
		        	);	
		        	$where2 = array('amc_id'=>post('amc_id'));
		        	//print_r($data); 
				//die;
		        	$ret = $this->plus->update($data2,$where2);
                	
                	$this->session->set_flashdata('success', 'AMC Plan Updated');
					redirect('amc');
               
                }
				
			}
		


function amcdelete($id) {

	$ret=$this->plus->amcdelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}
	
	
	
}

/* End of file cars.php */
/* Location: ./application/controllers/cars.php */
