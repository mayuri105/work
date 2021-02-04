<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Packages extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
		$this->load->model('package_model', 'package');
		
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
		$base_url = "/packages/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
        
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->package->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["packages"] = $this->package->fetch_data($perpage ,(($page-1) * $perpage));
        $theme = $this->session->userdata('admin_theme');
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/packages/index')) {
			$this->load->view('themes/' . $theme . '/template/packages/index', $data);
		} else {
			$this->load->view('themes/default/template/packages/index', $data);
		}
	}
	public function edit($id = '') {
		if ('' == $id) {
			redirect('packages');
		}
		$data = array();
		
		$data['package'] = $this->package->getpackageByid($id);
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/packages/edit')) {
			$this->load->view('themes/' . $theme . '/template/packages/edit', $data);
		} else {
			$this->load->view('themes/default/template/packages/edit', $data);
		}
	}
	
	public function add() {
		
		$data = array();
		
		
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/packages/add')) {
			$this->load->view('themes/' . $theme . '/template/packages/add', $data);
		} else {
			$this->load->view('themes/default/template/packages/add', $data);
		}
	}
	
	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('package_name', 'Name', 'required');

		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('packages/edit/' . post('package_id') . '');
			} else {
				$data = array(
					'package_name' => post('package_name'),
					'package_price' => post('package_price'),
					'package_periods' => post('package_periods'),
					
				);

				$where = array('package_id'=>post('package_id'));
		        	
				$this->package->update($data,$where);
					$this->session->set_flashdata('success','Packages Update');
	        		redirect('packages');
				
			}
		
	}

	public function addpackage(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		
        $this->form_validation->set_rules('package_name', 'Name', 'required');
       
     

       
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	           redirect('packages');
	        }else{
	        	
			$data = array(
					'package_name' => post('package_name'),
					'package_price' => post('package_price'),
					'package_periods' => post('package_periods'),
					
				);
		        	$ret = $this->package->insert($data);
		        	$this->session->set_flashdata('success','Package Inserted');
	        		redirect('packages');
                }
	        	
	        }
	        	
	    function packagedelete($id) {



	$ret=$this->package->packagedelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}    	

	}


/* End of file product.php */
/* Location: ./application/controllers/product.php */ ?>