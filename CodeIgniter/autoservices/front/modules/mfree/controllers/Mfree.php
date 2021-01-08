<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mfree extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mfree_model', 'mfree');
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
		$base_url = "/mfree/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
        
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->mfree->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["mfree"] = $this->mfree->fetch_data($perpage ,(($page-1) * $perpage));
        $data['customer'] = $this->input->get('customer');
        $data['reg_no'] = $this->input->get('reg_no');
       $data['issue_date_from'] = $this->input->get('issue_date_from');
        $data['issue_date_to'] = $this->input->get('issue_date_to');
        
        $theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/mfree/index')) {
			$this->load->view('themes/' . $theme . '/template/mfree/index', $data);
		} else {
			$this->load->view('themes/default/template/mfree/index', $data);
			
		}

	}
	// add cars 
	public function add()
	{
		
		$data = array();
			$data['gst'] = $this->settings->get('gst');
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/mfree/add')) {
			$this->load->view('themes/' . $theme . '/template/mfree/add', $data);
		} else {
			$this->load->view('themes/default/template/mfree/add', $data);
			
		}

	}
	// edit cars 
	public function edit($id='')
	{
		if($id=='') redirect('mfree');
		
		$data = array();
			$data['gst'] = $this->settings->get('gst');
		$data['mfree'] = $this->mfree->get($id);
        
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/mfree/edit')) {
			$this->load->view('themes/' . $theme . '/template/mfree/edit', $data);
		} else {
			$this->load->view('themes/default/template/mfree/edit', $data);
			
		}

	}

	
	public function view($id='')
	{
		if($id=='') redirect('mfree');
		
		$data = array();
		$data['gst'] = $this->settings->get('gst');
		$data['mfree'] = $this->mfree->get($id);
        
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/mfree/view')) {
			$this->load->view('themes/' . $theme . '/template/mfree/view', $data);
		} else {
			$this->load->view('themes/default/template/mfree/view', $data);
			
		}

	}
	
	public function addmfree(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('card_no', 'card no', 'required');
		$this->form_validation->set_rules('issue_date', 'issue date', 'required');
		$this->form_validation->set_rules('customer','customer name', 'required');
		$this->form_validation->set_rules('address',' address', 'required');
		$this->form_validation->set_rules('mob_no', ' mobile no', 'required');
		$this->form_validation->set_rules('email', ' email', 'required');
		$this->form_validation->set_rules('reg_no', 'registration no', 'required');
		$this->form_validation->set_rules('validity_from_date', 'validity from date', 'required');
		$this->form_validation->set_rules('validity_to_date', 'validity to date', 'required');
			$this->form_validation->set_rules('km', 'Kilometer', 'required');
			$this->form_validation->set_rules('amount', 'amount', 'required');
		$this->form_validation->set_rules('sgst', 'SGST', 'required');
		$this->form_validation->set_rules('cgst', 'CGST', 'required');
		$this->form_validation->set_rules('total_amt', 'total amount', 'required');
		
       
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('mfree/add');
	        }else{
	        	
			  
	            
                   	$data= array(
		        	'card_no'=>post('card_no'),
	        		'issue_date'=>post('issue_date'),
	        		'customer'=>post('customer'),
	        		'address'=>post('address'),
	        		'mob_no'=>post('mob_no'),
	        		'email'=>post('email'),
	        		'reg_no'=>post('reg_no'),
	        		'validity_from_date'=>post('validity_from_date'),
	        		'validity_to_date'=>post('validity_to_date'),
	    	        'km'=>post('km'),
	        		'amount'=>post('amount'),
	        		'sgst'=>post('sgst'),
	        		'cgst'=>post('cgst'),
	        		'total_amt'=>post('total_amt'),
	        		'gstin_no'=>post('gstin_no'),
		        		
		        	);	
		        	$ret = $this->mfree->insert($data);
		        	$this->session->set_flashdata('success','MFree  Added');
	        		redirect('mfree');
               
	        	
	        }

	        	
	        	

	}
	

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('card_no', 'card no', 'required');
		$this->form_validation->set_rules('issue_date', 'issue date', 'required');
		$this->form_validation->set_rules('customer','customer name', 'required');
		$this->form_validation->set_rules('address',' address', 'required');
		$this->form_validation->set_rules('mob_no', ' mobile no', 'required');
		$this->form_validation->set_rules('email', ' email', 'required');
		$this->form_validation->set_rules('reg_no', 'registration no', 'required');
		$this->form_validation->set_rules('validity_from_date', 'validity from date', 'required');
		$this->form_validation->set_rules('validity_to_date', 'validity to date', 'required');
			$this->form_validation->set_rules('km', 'Kilometer', 'required');
			$this->form_validation->set_rules('amount', 'amount', 'required');
		$this->form_validation->set_rules('sgst', 'SGST', 'required');
		$this->form_validation->set_rules('cgst', 'CGST', 'required');
		$this->form_validation->set_rules('total_amt', 'total amount', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('mfree/edit/' . post('mfree_id') . '');
			} else {
				
				$upload_path =  $this->config->item('upload_path').'/mfreetermscondition';
				$data2= array(
		        	'card_no'=>post('card_no'),
	        		'issue_date'=>post('issue_date'),
	        		'customer'=>post('customer'),
	        		'address'=>post('address'),
	        		'mob_no'=>post('mob_no'),
	        		'email'=>post('email'),
	        		'reg_no'=>post('reg_no'),
	        		'validity_from_date'=>post('validity_from_date'),
	        		'validity_to_date'=>post('validity_to_date'),
	    	        'km'=>post('km'),
	        		'amount'=>post('amount'),
	        		'sgst'=>post('sgst'),
	        		'cgst'=>post('cgst'),
	        		'total_amt'=>post('total_amt'),
	        		'gstin_no'=>post('gstin_no'),
		        		
		        	);	
		        	$where2 = array('mfree_id'=>post('mfree_id'));
		        	//print_r($data); 
				//die;
		        	$ret = $this->mfree->update($data2,$where2);
                	
                	$this->session->set_flashdata('success', 'mfree  Updated');
					redirect('mfree');
               
                }
				
			}
		


function mfreedelete($id) {

	$ret=$this->mfree->mfreedelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}
	
	
	
}

/* End of file cars.php */
/* Location: ./application/controllers/cars.php */