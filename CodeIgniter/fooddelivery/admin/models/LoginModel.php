<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends CI_Model {

	function __construct() {
		$this->load->library('remoteaddress');
		$this->load->library('encrypt');
	}
	public function validate($data){
		
		$password = $data['password'];
		$this->db->where('status', '1');
		$this->db->where('username',$data['username']);
		$ret = $this->db->get('user',1)->row();
		
		
		if($ret){
			$pwd_from_db = $this->encrypt->decode($ret->password);
					if ($pwd_from_db == $password) {
						$userdata = array(
						'u_id' =>$ret->u_id,
						'username'=>$ret->username,
						'is_admin'=>1,
						'user_group_id'=>$ret->user_group_id,
					);
					$updatedata =array(
						'last_login'=>date('Y-m-d H:i:s'),
						'ip'=>$this->remoteaddress->getIpAddress(),

					);
					
					$this->db->where('u_id',$ret->u_id);
					$this->db->update('user',$updatedata);
					$this->session->set_userdata($userdata);
					$unsetForOther = array('m_id','is_merchant');
					$this->session->unset_userdata($unsetForOther);
					
					return 1;
				}else{
					return 0;
			}
		}
		
	}
	public function validatemerchant($data){
		$password = $data['password'];
		$this->db->where('username',$data['username']);
		$ret = $this->db->get('merchant',1)->row();
		if($ret){
			$pwd_from_db = $this->encrypt->decode($ret->password);
				if ($pwd_from_db == $password) {
					$userdata = array(
						'm_id' =>$ret->m_id,
						'username'=>$ret->username,
						'is_merchant'=>1,
								
					);
					$updatedata =array(
						'last_login_ip'=>'',
						
					);
					$this->db->where('m_id',$ret->m_id);
					$this->db->update('merchant',$updatedata);

					$this->session->set_userdata($userdata);
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
       