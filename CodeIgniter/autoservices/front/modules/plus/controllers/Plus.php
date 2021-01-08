<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plus extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('plus_model', 'plus');
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
        $data['ben_name'] = $this->input->get('ben_name');
        $data['certificate_no'] = $this->input->get('certificate_no');
       $data['certi_date_from'] = $this->input->get('certi_date_from');
        $data['certi_date_to'] = $this->input->get('certi_date_to');
        
        $theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/plus/index')) {
			$this->load->view('themes/' . $theme . '/template/plus/index', $data);
		} else {
			$this->load->view('themes/default/template/plus/index', $data);
			
		}

	}
	// add cars 
	public function add()
	{
		
		$data = array();
			$data['gst'] = $this->settings->get('gst');
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/plus/add')) {
			$this->load->view('themes/' . $theme . '/template/plus/add', $data);
		} else {
			$this->load->view('themes/default/template/plus/add', $data);
			
		}

	}
	// edit cars 
	public function edit($id='')
	{
		if($id=='') redirect('plus');
		
		$data = array();
			$data['gst'] = $this->settings->get('gst');
		$data['plus'] = $this->plus->get($id);
        
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/plus/edit')) {
			$this->load->view('themes/' . $theme . '/template/plus/edit', $data);
		} else {
			$this->load->view('themes/default/template/plus/edit', $data);
			
		}

	}

	
	public function view($id='')
	{
		if($id=='') redirect('plus');
		
		$data = array();
		$data['gst'] = $this->settings->get('gst');
		$data['plus'] = $this->plus->get($id);
        
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/plus/view')) {
			$this->load->view('themes/' . $theme . '/template/plus/view', $data);
		} else {
			$this->load->view('themes/default/template/plus/view', $data);
			
		}

	}
	
	public function addplus(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('certificate_no', 'certificate no', 'required');
		$this->form_validation->set_rules('certi_date', 'certificate date', 'required');
		$this->form_validation->set_rules('ben_name','beneficiary name', 'required');
		$this->form_validation->set_rules('ben_addr','beneficiary address', 'required');
		$this->form_validation->set_rules('ben_mobno', 'beneficiary mobile no', 'required');
		$this->form_validation->set_rules('email', 'beneficiary email', 'required');
		$this->form_validation->set_rules('reg_no', 'registration no', 'required');
		$this->form_validation->set_rules('make', 'Make / Model / Variant', 'required');
		$this->form_validation->set_rules('certi_fromdate', 'certificate from date', 'required');
		$this->form_validation->set_rules('certi_todate', 'certificate to date', 'required');
			$this->form_validation->set_rules('km', 'Kilometer', 'required');
			$this->form_validation->set_rules('amount', 'amount', 'required');
		$this->form_validation->set_rules('sgst', 'SGST', 'required');
		$this->form_validation->set_rules('cgst', 'CGST', 'required');
		$this->form_validation->set_rules('total_amt', 'total amount', 'required');
		
       
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('plus/add');
	        }else{
	        	
			  $upload_path =  $this->config->item('upload_path').'/plustermscondition';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  =  'gif|jpg|png|jpeg|x-png|pdf';
	            $this->load->library('upload', $c_upload);

	        	if ($this->upload->do_upload('fileinput')) {
				   $image = $this->upload->data();
	            
                   	$data= array(
		        	'certificate_no'=>post('certificate_no'),
	        		'certi_date'=>post('certi_date'),
	        		'ben_name'=>post('ben_name'),
	        		'ben_addr'=>post('ben_addr'),
	        		'ben_mobno'=>post('ben_mobno'),
	        		'email'=>post('email'),
	        		'reg_no'=>post('reg_no'),
	        		'make'=>post('make'),
	        		'certi_fromdate'=>post('certi_fromdate'),
	        		'certi_todate'=>post('certi_todate'),
	        		'km'=>post('km'),
	        		'gstin_no'=>post('gstin_no'),
	        		'amount'=>post('amount'),
	        		'sgst'=>post('sgst'),
	        		'cgst'=>post('cgst'),
	        		'total_amt'=>post('total_amt'),
	    	        'terms'=>$image['file_name'],
		        		
		        	);	
		        	$ret = $this->plus->insert($data);
		        	$this->session->set_flashdata('success','Plus Plan Added');
	        		redirect('plus');
               
	        	}else{
                	$this->session->set_flashdata('error',$this->upload->display_errors());
					redirect('plus');
                }
	        }

	        	
	        	

	}
	

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('certificate_no', 'certificate no', 'required');
		$this->form_validation->set_rules('certi_date', 'certificate date', 'required');
		$this->form_validation->set_rules('ben_name','beneficiary name', 'required');
		$this->form_validation->set_rules('ben_addr','beneficiary address', 'required');
		$this->form_validation->set_rules('ben_mobno', 'beneficiary mobile no', 'required');
		$this->form_validation->set_rules('email', 'beneficiary email', 'required');
		$this->form_validation->set_rules('reg_no', 'registration no', 'required');
		$this->form_validation->set_rules('make', 'Make / Model / Variant', 'required');
		$this->form_validation->set_rules('certi_fromdate', 'certificate from date', 'required');
		$this->form_validation->set_rules('certi_todate', 'certificate to date', 'required');
		$this->form_validation->set_rules('km', 'Kilometer', 'required');
			$this->form_validation->set_rules('amount', 'amount', 'required');
		$this->form_validation->set_rules('sgst', 'SGST', 'required');
		$this->form_validation->set_rules('cgst', 'CGST', 'required');
		$this->form_validation->set_rules('total_amt', 'total amount', 'required');
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('plus/edit/' . post('plus_id') . '');
			} else {
				
				$upload_path =  $this->config->item('upload_path').'/plustermscondition';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	           $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png|pdf';
	            $ret2=$this->load->library('upload', $c_upload);

	        	if($this->upload->do_upload('fileinput')){
	        		
	        		$image1 = $this->upload->data();	
						
					$where =  array('plus_id'=>post('plus_id'));
					$data = array(
						'terms'=>$image1['file_name']
					);
					$ret = $this->plus->update($data,$where);
				}
                			$data2= array(
		        	'certificate_no'=>post('certificate_no'),
	        		'certi_date'=>post('certi_date'),
	        		'ben_name'=>post('ben_name'),
	        		'ben_addr'=>post('ben_addr'),
	        		'ben_mobno'=>post('ben_mobno'),
	        		'email'=>post('email'),
	        		'reg_no'=>post('reg_no'),
	        		'make'=>post('make'),	        		
	        		'certi_fromdate'=>post('certi_fromdate'),
	        		'certi_todate'=>post('certi_todate'),
	        			'km'=>post('km'),
	        			'gstin_no'=>post('gstin_no'),
	    	       'amount'=>post('amount'),
	        		'sgst'=>post('sgst'),
	        		'cgst'=>post('cgst'),
	        		'total_amt'=>post('total_amt'),
		        		
		        	);	
		        	$where2 = array('plus_id'=>post('plus_id'));
		        	//print_r($data); 
				//die;
		        	$ret = $this->plus->update($data2,$where2);
                	
                	$this->session->set_flashdata('success', 'Plus Plan Updated');
					redirect('plus');
               
                }
				
			}
		


function plusdelete($id) {

	$ret=$this->plus->plusdelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}
	
	
	
}

/* End of file cars.php */
/* Location: ./application/controllers/cars.php */