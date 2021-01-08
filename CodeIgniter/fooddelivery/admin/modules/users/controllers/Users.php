<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MX_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model','user');
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
		$base_url = "/users/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
        
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->user->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["users"] = $this->user->fetch_data($perpage ,(($page-1) * $perpage));
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/index')) {
			$this->load->view('themes/' . $theme . '/template/users/index', $data);
		} else {
			$this->load->view('themes/default/template/users/index', $data);
			
		}

	}

	
	public function adduser(){
		$data = array();
		$data['usersgroups'] = $this->user->getusergroup();
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/add')) {
			$this->load->view('themes/' . $theme . '/template/users/add', $data);
		} else {
			$this->load->view('themes/default/template/users/add', $data);
			
		}

	}
	public function edituser($id=''){
		if($id==''){
			redirect('users');
		}
		$data = array();
		$data['usersgroups'] = $this->user->getusergroup();
		$data['users'] = $this->user->getuserbyid($id);
		$data['userActivity'] = $this->user->getuserActivity($id);
		
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/edit')) {
			$this->load->view('themes/' . $theme . '/template/users/edit', $data);
		} else {
			$this->load->view('themes/default/template/users/edit', $data);
			
		}

	}
	function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name', 'Username', 'required|max_length[12]|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
     
        if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('users/adduser');
	        }else{
	        	
	        	$pw =$this->encrypt->encode(post('password'));
	        	$data= array(
	        		'username'=>post('user_name'),
	        		'first_name'=>post('first_name'),
	        		'last_name'=>post('last_name'),
	        		'email'=>post('email'),
	        		'password'=>$pw,
	        		'created_on'=>date('Y-m-d H:i:s'),
	        		'user_group_id'=>post('user_group_id'),
	        		'status'=>post('status')
	        	);	


	        	$ret = $this->user->insert($data);
				addactivity('User Created');
        		$this->session->set_flashdata('success','User Created');
        		redirect('users/adduser');
	        	
	        }
	    }else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	      	redirect('users/adduser');
		}  
	}

	function update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
     	
        if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('users/edituser/'.post('u_id').'');
	        }else{
	        	if(post('newpassword')){
	        		
	        		//die;
	        		$this->db->where('u_id',post('u_id'));
					$rets = $this->db->get('user')->row();
					$password = post('curpassword');
					if($rets){

						$pwd_from_db = $this->encrypt->decode($rets->password);

						if ($pwd_from_db == $password) {
							$pw = $this->encrypt->encode(post('newpassword'));
					        	$data= array(
					        		'username'=>post('user_name'),
					        		'first_name'=>post('first_name'),
					        		'last_name'=>post('last_name'),
					        		'email'=>post('email'),
					        		'password'=>$pw,
					        		'last_update'=>date('Y-m-d H:i:s'),
					        		'user_group_id'=>post('user_group_id'),
					        		'status'=>post('status'),
					        			
					        	);
					        		
					        	$where =array('u_id' => trim(post('u_id')));
					        	$ret = $this->user->update($data,$where);
								addactivity('User Update');
								$this->session->set_flashdata('success','User Update');
					        	redirect('users/edituser/'.post('u_id').'');
					        	
					    }else{
					    	$this->session->set_flashdata('error','Current Password Not match');
						    redirect('users/edituser/'.post('u_id').'');
					    }

				    }else{
				    	$this->session->set_flashdata('error','User not Found');
						redirect('users/edituser/'.post('u_id').'');
				    }   
	        	}else{
	        		$data= array(
		        		'username'=>post('user_name'),
		        		'first_name'=>post('first_name'),
		        		'last_name'=>post('last_name'),
		        		'email'=>post('email'),
		        		'last_update'=>date('Y-m-d H:i:s'),
		        		'user_group_id'=>post('user_group_id'),
		        		'status'=>post('status'),
		        	);	
		        	$where =array('u_id' => trim(post('u_id')));	
		        	$ret = $this->user->update($data,$where);
		        	
					addactivity('User Update');
	        		$this->session->set_flashdata('success','User Update');
	        		redirect('users/edituser/'.post('u_id').'');
		        	
	        	}
		   }
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('users');
		}
	}
	function getuser(){

		$id = post('id');
		$ret =  $this->user->getuserbyid($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($ret));
	}
	
	public function editprofile(){
		$data = array();
		$id = $this->session->userdata('u_id');

		$data["users"] = $this->user->getuserbyid($id);
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/profile')) {
			$this->load->view('themes/' . $theme . '/template/users/profile', $data);
		} else {
			$this->load->view('themes/default/template/users/profile', $data);
			
		}
	}
	public function updateprofile(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            redirect('users');
        }else{
        	if(post('newpassword')){
        		$this->db->where('u_id',post('u_id'));
				$rets = $this->db->get('user')->row();
				$password = post('curpassword');
				if($rets){
					$pwd_from_db = $this->encrypt->decode($rets->password);
					if ($pwd_from_db == $password) {
						$pw = $this->encrypt->encode(post('newpassword'));
				        	$data= array(
				        		'username'=>post('user_name'),
				        		'first_name'=>post('first_name'),
				        		'last_name'=>post('last_name'),
				        		'email'=>post('email'),
				        		'password'=>$pw,
				        		'last_update'=>date('Y-m-d H:i:s')
				        	);
				        	$where =array('u_id' => trim(post('u_id')));	
				        	$ret = $this->user->update($data,$where);
			        		$this->session->set_flashdata('success','User Update');
			        		redirect('users/editprofile');
				        	
				    }else{
				    	$this->session->set_flashdata('error','Current Password Not match');
					    redirect('users/editprofile');
				    }

			    }else{
			    	$this->session->set_flashdata('error','User not Found');
					redirect('users/editprofile');
			    }   
        	}else{
        		
	        	$data= array(
	        		'username'=>post('user_name'),
	        		'first_name'=>post('first_name'),
	        		'last_name'=>post('last_name'),
	        		'email'=>post('email'),
	        		'last_update'=>date('Y-m-d H:i:s')
	        	);	
	        	$where =array('u_id' => trim(post('u_id')));	
	        	$ret = $this->user->update($data,$where);
        		$this->session->set_flashdata('success','User Update');
        		redirect('users/editprofile');
	        	
        	}
        }
	}
	function deletemultiple(){

		 if(checkModification()){
			foreach ($this->input->post('delete') as $u) {
				if ($u== $this->session->u_id) {
					exit;
				}
				$ret =  $this->user->delete($u);
			
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	        $this->output->set_content_type('application/json')->set_output(json_encode('1'));
		}
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */