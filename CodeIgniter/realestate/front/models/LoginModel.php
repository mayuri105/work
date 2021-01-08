<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends CI_Model {

	function __construct() {
		$this->load->library('encrypt');
		$this->load->library('remoteaddress');
	}
	public function validate($data){
		$this->db->where('email',$data['email']);
		$this->db->where('enabled', '1', FALSE);
		$ret = $this->db->get('customer',1)->row();
		if($ret){
			$password =  $this->encrypt->decode($ret->password);
			
			if ($data['password'] == $password){
				
				$userdata = array(
					'first_name'=>$ret->first_name,
					'last_name'=>$ret->last_name,
					'username'=>$ret->first_name.' '.$ret->last_name,
					'c_id' =>$ret->c_id,
					'email'=>$ret->email,
					'is_login'=>1,
					'is_admin'=>0,
						
				);
				$updatedata =array(
					'last_login'=>date('Y-m-d H:i:s'),
					'ip'=>$this->remoteaddress->getIpAddress(),
				);
				
				$this->db->where('c_id',$ret->c_id);
				$this->db->update('customer',$updatedata);
				$this->session->set_userdata($userdata);
				return 1;
			}else{	
				return 0;
			}	
		}
		
	}

	public function checkuser($username){
		if ($username) {
			$this->db->where('email',$username);
			$ret = $this->db->get('customer',1)->row();
			return $ret;
		}else{
			return 1;
		}
		
	}
	public function checkuserSocial($provider,$providerId){
		
		$this->db->where('providername',$provider);
		$this->db->where('provider_id',$providerId);
		$ret = $this->db->get('customer',1)->row();
		if ($ret) {
			return $ret;
		}else{
			return 0;
		}
		
	}

	public function insert($data){
		if ($this->db->insert('customer',$data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	public function update(Array $data, $where = array()) {
		if (!is_array($where)) {
			$where = array('c_id' => $where);
		}
		$this->db->update('customer', $data, $where);
		return $this->db->affected_rows();
	}
	
	
}
       