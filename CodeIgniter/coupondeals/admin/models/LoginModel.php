<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends CI_Model {

	function __construct() {
		$this->load->library('encrypt');
	}
	public function validate($data){
		
		$password = md5($data['password']);
		$this->db->where('email',$data['email']);
		$ret = $this->db->get('tbl_admin',1)->row();
		
		if($ret){
			$pwd_from_db = $ret->password;
			//echo $pwd_from_db;
			//die;
					if ($pwd_from_db == $password) {

						$userdata = array(
							'id' =>$ret->id,
						'email' =>$ret->email,
						'username'=>$ret->username,
						'logged_in' => TRUE,
						
					);
					$this->session->set_userdata($userdata);
					
				
					return 1;
				}else{
					return 0;
			}
		}
		
	}
	
	public function getpassword($data){
		$this->db->where('email',$data['email']);
		$ret = $this->db->get('tbl_admin',1)->row();
		return $ret;
	}
	
}
       