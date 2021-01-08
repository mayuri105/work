<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends CI_Model {

	function __construct() {
		$this->load->library('encrypt');
		$this->load->library('remoteaddress');
	}
	
	public function validatemerchant($data){
		$password = $data['password'];
		$this->db->where('username',$data['username']);
		$this->db->where('is_pverified', '1');
		$ret = $this->db->get('merchant',1)->row();
		if($ret){
			$pwd_from_db = $this->encrypt->decode($ret->password);
			
				if ($pwd_from_db == $password) {
					$userdata = array(
						'm_id' =>$ret->m_id,
						'username'=>$ret->username,
						'is_merchant'=>1,
								
					);
					
					$unsetForOther = array('u_id','is_admin');
					$this->session->unset_userdata($unsetForOther);
					
					$this->session->set_userdata($userdata);
					$updatedata =array(
						'last_login'=>date('Y-m-d H:i:s'),
						'ip'=>$this->remoteaddress->getIpAddress(),
						
					);
					$this->db->where('m_id',$ret->m_id);
					$this->db->update('merchant',$updatedata);

					
					return 1;
				}else{
					return 0;
				}
		}else{
			return 0;
		}
	}
	public function getpassword($data){
		$this->db->where('email',$data['email']);
		$ret = $this->db->get('user',1)->row();
		return $ret;
	}
	public function getpasswordformerchant($data){
		$this->db->where('username',$data['email']);
		$ret = $this->db->get('merchant',1)->row();
		return $ret;
	}
}
       