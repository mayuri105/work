<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('users_models', 'users');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index() {
		
		
		$data = array();
	$perpage = $this->setting->get('per_page');
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/users/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->users->record_count());
		$data["pagination_helper"] = $this->pagination;
		$data["users"] = $this->users->fetch_data($perpage, (($page - 1) * $perpage));
		$data['users_par'] = $this->users->getusers();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/userlist')) {
			$this->load->view('themes/' . $theme . '/template/users/userlist', $data);
		} else {
			$this->load->view('themes/default/template/users/userlist', $data);

		}
	}
	// add categories form page
	public function subcriber() {
		$data = array();
	$perpage = $this->setting->get('per_page');
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/users/subcriber?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->users->record_countsub());
		$data["pagination_helper"] = $this->pagination;
		$data["userssub"] = $this->users->fetch_datasub($perpage, (($page - 1) * $perpage));
		$data['userssub_par'] = $this->users->getuserssub();
		
		$theme = $this->session->userdata('admin_theme');
		
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/subcriberlist')) {
			$this->load->view('themes/' . $theme . '/template/users/subcriberlist', $data);
		} else {
			$this->load->view('themes/default/template/users/subcriberlist', $data);

		}

	}
	
public function contactuser() {
		$data = array();
	$perpage = $this->setting->get('per_page');
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/users/contactuser?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->users->record_countcontact());
		$data["pagination_helper"] = $this->pagination;
		$data["userscontact"] = $this->users->fetch_datacontact($perpage, (($page - 1) * $perpage));
		$data['userscontact_par'] = $this->users->getusercontact();
		
		$theme = $this->session->userdata('admin_theme');
		
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/contactusers')) {
			$this->load->view('themes/' . $theme . '/template/users/contactusers', $data);
		} else {
			$this->load->view('themes/default/template/users/contactusers', $data);

		}

	}

function deletesub($id) {

	$ret=$this->users->deletesub($id);
	$this->output->set_content_type('application/json')->set_output(json_encode($ret));
	$this->session->set_flashdata('success', 'Deleted Successfully  ');
	}
	function statussub($id){

		
		$ret = $this->users->updatestatus($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		$this->session->set_flashdata('success', 'Update Successfully  ');
	}

function deletecontact($id) {

	$ret=$this->users->deletecontact($id);
	$this->output->set_content_type('application/json')->set_output(json_encode($ret));
	$this->session->set_flashdata('success', 'Deleted Successfully  ');
	}
	
public function themeoption(){
		$data = array();
		$this->load->helper('directory');
		//themes
		$theme = $this->session->userdata('admin_theme');
		
		$data['aboutus'] = $this->setting->get('aboutus');
		$data['video_link'] = $this->setting->get('video_link');
		
		
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/setting/index')) {
			$this->load->view('themes/' . $theme . '/template/setting/index', $data);
		} else {
			$this->load->view('themes/default/template/setting/index', $data);
			
		}	
	}
	
	public function savethemeoption(){
		
			$this->setting->update('video_link', post('video_link'));
			$this->setting->update('aboutus', post('aboutus'));
			
			
		
			$this->session->set_flashdata('success', 'Update Successfully');
			redirect('users/themeoption');
			//redirect('users/themeoption');
	
	}
}

/* End of file Categories.php */
/* categories: ./application/controllers/Categories.php */