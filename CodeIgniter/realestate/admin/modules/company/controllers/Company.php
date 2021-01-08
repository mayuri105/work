<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends MX_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('company_model','company');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
		$this->load->library('encrypt');
		
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
		
		$base_url = "/company/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->company->record_count());
        $data["pagination_helper"]   = $this->pagination;

        $data["companys"]   = $this->input->get('companys');
        $data["enable"]   = $this->input->get('enable');
        $data["company"] = $this->company->fetch_data($perpage ,(($page-1) * $perpage));
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/company/index')) {
			$this->load->view('themes/' . $theme . '/template/company/index', $data);
		} else {
			$this->load->view('themes/default/template/company/index', $data);
			
		}

	}

	
	public function addcompany(){
		$data = array();
		
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/company/add')) {
			$this->load->view('themes/' . $theme . '/template/company/add', $data);
		} else {
			$this->load->view('themes/default/template/company/add', $data);
			
		}

	}
	public function editcompany($id=''){
		if($id==''){
			redirect('company');
		}
		$data = array();
		$data['company'] = $this->company->getcompanybyid($id);
		$data['wallet'] = $this->company->getCompanybyWallet($id);
		$data['company_transaction'] = $this->company->getCompanybyWalletHistry($id);
		$data['professionals'] = $this->company->getCompanyProfes($id);
		
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/company/edit')) {
			$this->load->view('themes/' . $theme . '/template/company/edit', $data);
		} else {
			$this->load->view('themes/default/template/company/edit', $data);
		}

	}
	public function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('company_name', 'company_name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('company_email', 'Email', 'required|valid_email|is_unique[company.company_email]');
     
        if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('company/addcompany');
	        }else{
	        	$pw =$this->encrypt->encode(post('password'));
	        	$data= array(
	        		'company_name'=>post('company_name'),
	        		'company_email	'=>post('company_email'),
	        		'password'=>$pw,
	        		'date_added'=>date('Y-m-d'),
	        		'enabled'=>post('status')
	        	);	
	        	$ret = $this->company->insert($data);
        		addactivty('Company Created');
        		$this->session->set_flashdata('success','Company Created');
        		redirect('company/addcompany');
	        	
	        }
	    }else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	      	redirect('company/addcompany');
		}  
	}

	public function update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('company_name', 'company_name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('company_email', 'Email', 'required|valid_email');
     
        if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('company/editcompany/'.post('company_id').'');
	        }else{
	        	$pw =$this->encrypt->encode(post('password'));
	        	$data= array(
	        		'company_name'=>post('company_name'),
	        		'company_email	'=>post('company_email'),
	        		'password'=>$pw,
	        		'date_added'=>date('Y-m-d'),
	        		'enabled'=>post('status'),
	        		'wire_details'=>post('wire_details')
	        	);	
	        	$where = array('company_id'=>post('company_id'));
	        	$ret = $this->company->update($data,$where);
	        	addactivty('Company updated');
	        	$this->session->set_flashdata('success','Company updated');
	        	redirect('company/editcompany/'.post('company_id').'');
	        }
	    }else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	      	redirect('company/addcompany');
		}  
	}

	
	
	function deletemultiple(){
		foreach ($this->input->post('delete') as $u) {
			$ret =  $this->company->delete($u);
			addactivty('Company Deleted');
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}
		
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */