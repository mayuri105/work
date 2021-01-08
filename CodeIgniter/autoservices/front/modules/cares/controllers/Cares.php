<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cares extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cars_model', 'cars');
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
		$base_url = "/cars/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
        
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->cars->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["cars"] = $this->cars->fetch_data($perpage ,(($page-1) * $perpage));
        $data['name'] = $this->input->get('name');
        $data['reg_no'] = $this->input->get('reg_no');
       $data['registration_date_from'] = $this->input->get('registration_date_from');
        $data['registration_date_to'] = $this->input->get('registration_date_to');
        
        $theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cars/index')) {
			$this->load->view('themes/' . $theme . '/template/cars/index', $data);
		} else {
			$this->load->view('themes/default/template/cars/index', $data);
			
		}

	}
	// add cars 
	public function add()
	{
		
		$data = array();
		$data['gst'] = $this->settings->get('gst');
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cars/add')) {
			$this->load->view('themes/' . $theme . '/template/cars/add', $data);
		} else {
			$this->load->view('themes/default/template/cars/add', $data);
			
		}

	}
	// edit cars 
	public function edit($id='')
	{
		if($id=='') redirect('cares');
		
		$data = array();
			$data['gst'] = $this->settings->get('gst');
		$data['cares'] = $this->cars->get($id);
        
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cars/edit')) {
			$this->load->view('themes/' . $theme . '/template/cars/edit', $data);
		} else {
			$this->load->view('themes/default/template/cars/edit', $data);
			
		}

	}

	public function addclaim($id)
	{
		if($id=='') redirect('cares');
		$data = array();
		$data['caresclaims'] = $this->cars->getclaimbycaresid($id);
		$data['location'] = $this->cars->getlocation();
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cars/addclaim')) {
			$this->load->view('themes/' . $theme . '/template/cars/addclaim', $data);
		} else {
			$this->load->view('themes/default/template/cars/addclaim', $data);
			
		}

	}
	// edit cars 
	public function editclaim($id='')
	{
		if($id=='') redirect('cares');
		
		$data = array();
		$data['claims'] = $this->cars->getclaim($id);
        $data['location'] = $this->cars->getlocation();
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cars/editclaim')) {
			$this->load->view('themes/' . $theme . '/template/cars/editclaim', $data);
		} else {
			$this->load->view('themes/default/template/cars/editclaim', $data);
			
		}

	}
	public function view($id='')
	{
		if($id=='') redirect('cares');
		
		$data = array();
			$data['gst'] = $this->settings->get('gst');
		$data['cares'] = $this->cars->get($id);
        
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cars/view')) {
			$this->load->view('themes/' . $theme . '/template/cars/view', $data);
		} else {
			$this->load->view('themes/default/template/cars/view', $data);
			
		}

	}
	public function viewclaim($id='')
	{
		if($id=='') redirect('cares');
		
		$data = array();
		$data['claim'] = $this->cars->getclaim($id);
        
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cars/viewclaim')) {
			$this->load->view('themes/' . $theme . '/template/cars/viewclaim', $data);
		} else {
			$this->load->view('themes/default/template/cars/viewclaim', $data);
			
		}

	}
	public function claims($id='')
	{
		if($id=='') redirect('cares');
		
		$data = array();

		 
		$perpage = $this->settings->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		$base_url = "/cars/claim".$id."?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
        
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->cars->record_count_claim($id));
        $data["pagination_helper"]   = $this->pagination;
        $data["claims"] = $this->cars->fetch_data_claim($perpage ,(($page-1) * $perpage),$id);
        $data['customer'] = $this->input->get('customer');
        $data['certi_date'] = $this->input->get('certi_date');
       $data['claim_date_from'] = $this->input->get('claim_date_from');
        $data['claim_date_to'] = $this->input->get('claim_date_to');      
		 $data['id'] = $id;
        
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cars/claim')) {
			$this->load->view('themes/' . $theme . '/template/cars/claim', $data);
		} else {
			$this->load->view('themes/default/template/cars/claim', $data);
			
		}

	}
	public function addcares(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('certificate_date', 'certificate date', 'required');
		$this->form_validation->set_rules('certificate_no', 'certificate no', 'required');
		$this->form_validation->set_rules('name','customer name', 'required');
		$this->form_validation->set_rules('mob_no','mobile no', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		//$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('reg_no', 'registration no', 'required');
		$this->form_validation->set_rules('registration_date', 'registration date', 'required');
		$this->form_validation->set_rules('model', 'Model', 'required');
		$this->form_validation->set_rules('benifit_fromdate', 'benifit from date', 'required');
		$this->form_validation->set_rules('benifit_todate', 'benifit to date', 'required');
		$this->form_validation->set_rules('amount', 'amount', 'required');
		$this->form_validation->set_rules('sgst', 'SGST', 'required');
		$this->form_validation->set_rules('cgst', 'CGST', 'required');
		$this->form_validation->set_rules('total_amt', 'total amount', 'required');
		$this->form_validation->set_rules('payment_mode', 'payment mode', 'required');
       
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('cares/add');
	        }else{
	        	
			  $upload_path =  $this->config->item('upload_path').'/termscondition/';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  =  'gif|jpg|png|jpeg|x-png|pdf';
	           
$this->load->library('upload', $c_upload);

	            

	        	if ($this->upload->do_upload('fileinput')) {
				   $image = $this->upload->data();
	            
                   	$data= array(
		        	'certificate_date'=>post('certificate_date'),
	        		'certificate_no'=>post('certificate_no'),
	        		'name'=>post('name'),
	        		'mob_no'=>post('mob_no'),
	        		'address'=>post('address'),
	        		'email'=>post('email'),
	        		'reg_no'=>post('reg_no'),
	        		'registration_date'=>post('registration_date'),
	        		'model'=>post('model'),
	        		'benifit_fromdate'=>post('benifit_fromdate'),
	        		'benifit_todate'=>post('benifit_todate'),
	        		'amount'=>post('amount'),
	        		'sgst'=>post('sgst'),
	        		'cgst'=>post('cgst'),
	        		'total_amt'=>post('total_amt'),
	        		'payment_mode'=>post('payment_mode'),
	        		'terms'=>$image['file_name'],
		        		'profitvalue'=>post('total_amt'),	
		        		'gstin_no'=>post('gstin_no'),
		        	);	
		        	$ret = $this->cars->insert($data);
		        	$this->session->set_flashdata('success','Cares Added');
	        		redirect('cares');
               
	        	}else{
                	$this->session->set_flashdata('error',$this->upload->display_errors());
					redirect('cares');
                }
	        }

	        	
	        	

	}
	public function addclaims(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('certi_date', 'certificate date', 'required');
		$this->form_validation->set_rules('claim_date', 'certificate no', 'required');
		$this->form_validation->set_rules('customer','customer name', 'required');
		$this->form_validation->set_rules('invoiceno','mobile no', 'required');
		$this->form_validation->set_rules('location', 'address', 'required');
		$this->form_validation->set_rules('vehicleno', 'email', 'required');
		$this->form_validation->set_rules('insurancelaibility', 'registration no', 'required');
		$this->form_validation->set_rules('customerlaibility', 'registration date', 'required');
		$this->form_validation->set_rules('totalamt', 'Model', 'required');
		
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('cares/addclaims');
	        }else{
	        	
			  
                   	$data= array(
                   	'cares_id'=>post('cares_id'),
		        	'certi_date'=>post('certi_date'),
	        		'claim_date'=>post('claim_date'),
	        		'customer'=>post('customer'),
	        		'invoiceno'=>post('invoiceno'),
	        		'location'=>post('location'),
	        		'vehicleno'=>post('vehicleno'),
	        		'insurancelaibility'=>post('insurancelaibility'),
	        		'customerlaibility'=>post('customerlaibility'),
	        		'totalamt'=>post('totalamt'),
	        		
		        		
		        	);	
		        	$ret = $this->cars->insertclaim($data);
		        	if($ret){
		        	    
		        	    $data2=array('profitvalue'=> post('totalamt')
		        	    );
		        	    $where2 = array('car_id'=>post('cares_id'));
		        	//print_r($data); 
				//die;
		        	$ret2 = $this->cars->update($data2,$where2);
		        	}
		        
		        	$this->session->set_flashdata('success','Claim Added');
	        		redirect('cares/claims/'.post('cares_id').'');
               
	        	
	        }

	        	
	        	

	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('certificate_date', 'certificate date', 'required');
		$this->form_validation->set_rules('certificate_no', 'certificate no', 'required');
		$this->form_validation->set_rules('name','customer name', 'required');
		$this->form_validation->set_rules('mob_no','mobile no', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
	//	$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('reg_no', 'registration no', 'required');
		$this->form_validation->set_rules('registration_date', 'registration date', 'required');
		$this->form_validation->set_rules('model', 'Model', 'required');
		$this->form_validation->set_rules('benifit_fromdate', 'benifit from date', 'required');
		$this->form_validation->set_rules('benifit_todate', 'benifit to date', 'required');
		$this->form_validation->set_rules('amount', 'amount', 'required');
		$this->form_validation->set_rules('sgst', 'SGST', 'required');
		$this->form_validation->set_rules('cgst', 'CGST', 'required');
		$this->form_validation->set_rules('total_amt', 'total amount', 'required');
		$this->form_validation->set_rules('payment_mode', 'payment mode', 'required');
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('cares/edit/' . post('car_id') . '');
			} else {
				
				$upload_path =  $this->config->item('upload_path').'/termscondition';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	           $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png|pdf';
	            $ret2=$this->load->library('upload', $c_upload);

	        	if($this->upload->do_upload('fileinput')){
	        		
	        		$image1 = $this->upload->data();	
						
					$where =  array('car_id'=>post('car_id'));
					$data = array(
						'terms'=>$image1['file_name']
					);
					$ret = $this->cars->update($data,$where);
				}
                		$data2= array(
		        	'certificate_date'=>post('certificate_date'),
	        		'certificate_no'=>post('certificate_no'),
	        		'name'=>post('name'),
	        		'mob_no'=>post('mob_no'),
	        		'address'=>post('address'),
	        		'email'=>post('email'),
	        		'reg_no'=>post('reg_no'),
	        		'registration_date'=>post('registration_date'),
	        		'model'=>post('model'),
	        		'benifit_fromdate'=>post('benifit_fromdate'),
	        		'benifit_todate'=>post('benifit_todate'),
	        		'amount'=>post('amount'),
	        		'sgst'=>post('sgst'),
	        		'cgst'=>post('cgst'),
	        		'total_amt'=>post('total_amt'),
	        		'payment_mode'=>post('payment_mode'),
	        			'profitvalue'=>post('total_amt'),
	        			'gstin_no'=>post('gstin_no'),	
	        			);	
		        	$where2 = array('car_id'=>post('car_id'));
		        	//print_r($data); 
				//die;
		        	$ret = $this->cars->update($data2,$where2);
                	
                	$this->session->set_flashdata('success', 'Cares Updated');
					redirect('cares');
               
                }
				
			}
		
public function updateclaims() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('certi_date', 'certificate date', 'required');
		$this->form_validation->set_rules('claim_date', 'certificate no', 'required');
		$this->form_validation->set_rules('customer','customer name', 'required');
		$this->form_validation->set_rules('invoiceno','mobile no', 'required');
		$this->form_validation->set_rules('location', 'address', 'required');
		$this->form_validation->set_rules('vehicleno', 'email', 'required');
		$this->form_validation->set_rules('insurancelaibility', 'registration no', 'required');
		$this->form_validation->set_rules('customerlaibility', 'registration date', 'required');
		$this->form_validation->set_rules('totalamt', 'Model', 'required');
		
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('cares/editclaim/' .post('cares_claim_id'). '');
			} else {
				
					$data2= array(
                   	'cares_id'=>post('cares_id'),
		        	'certi_date'=>post('certi_date'),
	        		'claim_date'=>post('claim_date'),
	        		'customer'=>post('customer'),
	        		'invoiceno'=>post('invoiceno'),
	        		'location'=>post('location'),
	        		'vehicleno'=>post('vehicleno'),
	        		'insurancelaibility'=>post('insurancelaibility'),
	        		'customerlaibility'=>post('customerlaibility'),
	        		'totalamt'=>post('totalamt'),
	        		
		        		
		        	);	
		        	$where2 = array('cares_claim_id'=>post('cares_claim_id'));
		        	
		        	$ret = $this->cars->updateclaim($data2,$where2);
                	if($ret){
		        	    
		        	    $data3=array('profitvalue'=> post('totalamt')
		        	    );
		        	    $where3 = array('car_id'=>post('cares_id'));
		        	//print_r($data); 
				//die;
		        	$ret2 = $this->cars->update($data3,$where3);
		        	}
                	$this->session->set_flashdata('success', 'Claim Updated');
					redirect('cares/claims/'.post('cares_id').'');
               
                }
				
			}
		

function cardelete($id) {

	$ret=$this->cars->cardelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}
	function claimdelete($id) {

	$ret=$this->cars->claimdelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}
	
	
}

/* End of file cars.php */
/* Location: ./application/controllers/cars.php */