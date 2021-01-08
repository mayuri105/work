<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class State extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('state_model', 'state');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
		
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
		$base_url = "/state/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->state->record_count());
		$data["pagination_helper"]   = $this->pagination;
		$data["states"] = $this->state->fetch_data($perpage ,(($page-1) * $perpage));
		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/state/index')) {
			$this->load->view('themes/' . $theme . '/template/state/index', $data);
		} else {
			$this->load->view('themes/default/template/state/index', $data);
			
		}

	}

	
	
	public function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('state', 'state', 'required|is_unique[state.name]');
		$this->form_validation->set_rules('code', 'code', 'required|is_unique[state.code]|max_length[2]');
		if(checkModification()){
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				redirect('state');
			}else{

				$data= array(
	        		'code'=>strtoupper(post('code')) ,
	        		'name'=>post('state'),
	        		'status'=>post('status'),
	        	);	
	        	$ret = $this->state->insert($data);
        		$this->session->set_flashdata('sucess','Successfully inserted');
                redirect('state');
	        	
			}
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			redirect('state');
		}

	}

	public function update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'state', 'required|edit_unique[state.name.'.post('id').']');
		$this->form_validation->set_rules('code', 'code', 'required|edit_unique[state.code.'.post('id').']|max_length[2]');

		if(checkModification()){
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				redirect('state');
			}else{
				$data= array(
	        		'code'=>post('code'),
	        		'name'=>post('name'),
	        		'status'=>post('status'),
	        	);	
	        	$where = array('id'=>post('id'));
	        	$ret = $this->state->update($data,$where);
	        	
        		$this->session->set_flashdata('sucess','Successfully Updated');
                redirect('state');
            }
        	
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			redirect('state');
		}
	}
	function getstate(){
		$id = post('id');
		$ret =  $this->state->getstatebyid($id);
		echo  json_encode($ret);
		exit;
	}
	
	public function search(){

		$data = array();
		$data["states"] = $this->state->fetch_data_bysearch();
		$theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/state/search')) {
			$this->load->view('themes/' . $theme . '/template/state/search', $data);
		} else {
			$this->load->view('themes/default/template/state/search', $data);
			
		}
	}

	public function deletemultiple(){
		if(checkModification()){
			foreach ($this->input->post('delete') as $u) {
				$ret =  $this->state->delete($u);
			}
			if($ret){
				$this->session->set_flashdata('success','Deleted Successfully  ');
				echo json_encode($ret);
			}else{
				$this->session->set_flashdata('error','Item Currently being used');
				echo json_encode($ret);
			}
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			echo json_encode('1');
		}
	}
}	

/* End of file state.php */
/* Location: ./application/controllers/state.php */