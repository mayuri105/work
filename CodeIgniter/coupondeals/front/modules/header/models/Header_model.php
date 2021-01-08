<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Header_model extends CI_Model{
	function __construct() {
		$this->tableName = 'tbl_users';
		$this->primaryKey = 'user_id';
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
	
	 public function getcategorry(){
    	 
        $query=  $this->db->get('tbl_blog_categories')->result();
        return $query;
    }
	
}
