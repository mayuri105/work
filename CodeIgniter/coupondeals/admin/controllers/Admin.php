<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin_models', 'admin');
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
		
		$base_url = "/deals/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->admin->record_count());
		$data["pagination_helper"] = $this->pagination;
		$data["admins"] = $this->admin->fetch_data($perpage, (($page - 1) * $perpage));
		$data['admins_par'] = $this->admin->getadmin();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/admin')) {
			$this->load->view('themes/' . $theme . '/template/users/admin', $data);
		} else {
			$this->load->view('themes/default/template/users/admin', $data);

		}
	}
	// add categories form page
	
	public function addadmin() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/addadmin')) {
			$this->load->view('themes/' . $theme . '/template/users/addadmin', $data);
		} else {
			$this->load->view('themes/default/template/users/addadmin', $data);

		}

	}

	public function edit($id = '') {
		if ('' == $id) {
			redirect('admin/index');
		}
		$data = array();
		$data['admins'] = $this->admin->getadminByid($id);
		$data['admins_par'] = $this->admin->getadmin();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/editadmin')) {
			$this->load->view('themes/' . $theme . '/template/users/editadmin', $data);
		} else {
			$this->load->view('themes/default/template/users/editadmin', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'username', 'required');
		 $this->form_validation->set_rules('password', 'password', 'required|matches[cpassword]'); 
			  $this->form_validation->set_rules('cpassword', 'confirm', 'required'); 
			  $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[tbl_admin.email]');
		if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('admin/addadmin/');
			} else {
		
			
				$data = array(
					'username' => post('username'),
					'password'=>md5(post('password')),
					'email' => post('email'),
					
				);

				$ret = $this->admin->insert($data);
				
				

				$this->session->set_flashdata('success', 'admin Added');
				redirect('admin/index');
				

			}
		
	}

	
	function delete($id) {

	$ret=$this->admin->delete($id);
	$this->output->set_content_type('application/json')->set_output(json_encode($ret));
	$this->session->set_flashdata('success', 'Deleted Successfully  ');
	}

	

}

/* End of file Categories.php */
/* categories: ./application/controllers/Categories.php */