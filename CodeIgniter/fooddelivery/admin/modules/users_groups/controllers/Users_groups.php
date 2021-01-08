<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_groups extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_groups_model', 'user_groups');
		
		
	}

	public function index()
	{
		$data = array();
        $data["users_groups"] = $this->user_groups->fetch_data();
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/usersgroups/index')) {
			$this->load->view('themes/' . $theme . '/template/usersgroups/index', $data);
		}else{
			$this->load->view('themes/default/template/usersgroups/index', $data);
		}
	}
	public function addgroups()
	{
		$data = array();
        $theme = $this->session->userdata('theme');
		//load view 
		$data['rights'] =$this->listall();
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/usersgroups/add')) {
			$this->load->view('themes/' . $theme . '/template/usersgroups/add', $data);
		}else{
			$this->load->view('themes/default/template/usersgroups/add', $data);
		}
	}

	public function add(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');
        if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('users_groups/addgroups');
	        }else{
	        	
	        	$data= array(
	        		'name'=>post('name'),
	        		'permission'=>json_encode(post('permission')),
	        		'modify'=>json_encode(post('modify')),
	        		
	        	);	
	        	$ret = $this->user_groups->insert($data);
	        	addactivity('Users groups Created');	
        		$this->session->set_flashdata('success','Users groups Created');
        		redirect('users_groups/addgroups');
        	
	        }
        }else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('users_groups');
		}
	}

	public function update(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');
        if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('users_groups/addgroups');
	        }else{
	        	
	        	$data= array(
	        		'name'=>post('name'),
	        		'permission'=>json_encode(post('permission')),
	        		'modify'=>json_encode(post('modify')),
	        	);	
	        	$where = array('group_id'=>post('group_id'));
	        	$ret = $this->user_groups->update($data,$where);
	        		addactivity('Users groups Created');	
	        		$this->session->set_flashdata('success','Users groups Created');
	        		redirect('users_groups');
	        	
	        	}
	    }else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('users_groups');
		}
	}

	public function edit($id=''){
		if($id==''){
			redirect('users_groups');
		}
		$data = array();
        $theme = $this->session->userdata('theme');
		//load view 
		$data['user_group'] =$this->user_groups->getUserGroups($id);
		$data['rights'] =$this->listall();
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/usersgroups/edit')) {
			$this->load->view('themes/' . $theme . '/template/usersgroups/edit', $data);
		}else{
			$this->load->view('themes/default/template/usersgroups/edit', $data);
		}
	}
	public function listall()
	{
		
		$newpath = str_replace('\\','/', APPPATH);
		
		$dir =  $newpath.'modules/';
		$this->load->library('directoryinfo');
		$sortedarray  = $this->directoryinfo->readDirectory($dir,true);	
		$list = array("Header", "Footer","Sidebar",'Merchantdashboard','Message');
	    // Search for the array key and unset   
	    foreach($list as $key){
	        $keyToDelete = array_search($key, $sortedarray);
	        unset($sortedarray[$keyToDelete]);
	    }
		return $sortedarray;
	}

	function deletemultiple(){
		if(checkModification()){
			foreach ($this->input->post('delete') as $u) {
				if ($this->user_groups->checkAssignOrnot($u)) {
					$this->session->set_flashdata('error','This user group cannot be deleted as it is currently assigned to  users!');
					
				}
				$ret =  $this->user_groups->delete($u);
			
			}
			$this->session->set_flashdata('success','Deleted successfully');
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	       
		}
	}


}

/* End of file Users_groups.php */
/* Location: ./application/controllers/Users_groups.php */