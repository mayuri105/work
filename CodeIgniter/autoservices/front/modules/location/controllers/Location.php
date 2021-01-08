<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Location_model', 'location');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
	}
	// main page
	public function index()
	{
		
		$perpage = $this->settings->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		$base_url = "/location/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
        
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->location->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["location"] = $this->location->fetch_data($perpage ,(($page-1) * $perpage));
        $theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/location/index')) {
			$this->load->view('themes/' . $theme . '/template/location/index', $data);
		} else {
			$this->load->view('themes/default/template/location/index', $data);
			
		}

	}
	// add page 
	public function add()
	{
		
		$data = array();
		
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/location/add')) {
			$this->load->view('themes/' . $theme . '/template/location/add', $data);
		} else {
			$this->load->view('themes/default/template/location/add', $data);
			
		}

	}
	// edit page 
	public function edit($id='')
	{
		if($id=='') redirect('location');
		
		$data = array();
		$data['location'] = $this->location->get($id);
      
		$theme = $this->session->userdata('front_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/location/edit')) {
			$this->load->view('themes/' . $theme . '/template/location/edit', $data);
		} else {
			$this->load->view('themes/default/template/location/edit', $data);
			
		}

	}
	
	public function addlocation(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Location Name ', 'required');
		
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('location/add');
	        }else{
	        	
			
				
	          
                   	$data= array(
		        		'name'=>post('name'),
	        	
		        		
		        	);	
		        	$ret = $this->location->insert($data);
		        	$this->session->set_flashdata('success','location Added');
	        		redirect('location');
                
	        	
	        }
	        	
	        	

	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');
      
        
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('location/edit/' . post('location_id') . '');
			} else {
				
				$data= array(
		        		'name'=>post('name'),
	        		    	
		        		
		        	);	
		        	$where = array('location_id'=>post('location_id'));
		        	$ret = $this->location->update($data,$where);
                	
                	$this->session->set_flashdata('success', 'location Updated');
					redirect('location');
                }
				
			}
		



		function locdelete($id) {



	$ret=$this->location->locationdelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}
	
	
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */