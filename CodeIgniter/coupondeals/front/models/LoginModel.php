<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class LoginModel extends CI_Model {

	function __construct() {
		$this->load->helper('url');
		$this->tableName = 'tbl_users';
		$this->primaryKey = 'user_id';
	}
	public function validate($data){
		$this->db->where('email',$data['email']);
		
		$ret = $this->db->get('tbl_users',1)->row();
		if($ret){
			$password =  $ret->password;
			
			if ($data['password'] == $password){
				
				$userdata = array(
					'username'=>$ret->username,
					'user_id' =>$ret->user_id,
					'email'=>$ret->email,
					'is_login'=>1,
					
					
						
				);
				
				
				$this->db->where('user_id',$ret->user_id);
				
				$this->session->set_userdata($userdata);
				return 1;
			}else{	
				return 0;
			}	
		}
		
	}
	public function insert($data){
		if ($this->db->insert('tbl_users',$data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	public function getpassword($data){
		$this->db->where('email',$data['email']);
		$ret = $this->db->get('tbl_users',1)->row();
		return $ret;
	}
	
	public function checkUser($data = array()){
		 $this->db->select($this->primaryKey);
        $this->db->from($this->tableName);
        $this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        
        if($prevCheck > 0){
            $prevResult = $prevQuery->row_array();
            $userID = $prevResult['user_id'];
			$userdata = array(
					'username'=>$prevResult['username'],
					'user_id' =>$prevResult['user_id'],
					'email'=>$prevResult['email'],
					'is_login'=>1,
					
					
						
				);
				
				
				$this->session->set_userdata($userdata);
        }else{
           
            $insert = $this->db->insert($this->tableName,$data);
			 $prevResult = $prevQuery->row_array();
            $userID = $prevResult['user_id'];
			$userdata = array(
					'username'=>$prevResult['username'],
					'user_id' =>$prevResult['user_id'],
					'email'=>$prevResult['email'],
					'is_login'=>1,
					
					
						
				);
				
				
				$this->session->set_userdata($userdata);
            $userID = $this->db->insert_id();
			
        }

        return $userID?$userID:FALSE;
    }
	
	
	 public function save_fb_data($data){

       
        $user_info = array(
            'username' => $data['first_name']. " ". $data['last_name'],
           
            'email' => $data['email'],
			  'oauth_uid' => $data['id'],
			  'oauth_provider' =>'facebook',
            'phone' => '',
            'password' => '',
         
        );
       
       $this->db->insert('tbl_users',$user_info);
	   return $this->db->insert_id();
    }
	
}
       