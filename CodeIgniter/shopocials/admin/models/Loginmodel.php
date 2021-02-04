<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Loginmodel extends CI_Model {
const TABLE_NAME = 'user';

	

    const PRI_INDEX = 'u_id';
	function __construct() {
		//$this->load->library('remoteaddress');
		//$this->load->library('encrypt');
	}
	public function validate($data){
		
		$password = md5($data['password']);
		//echo $password;
		$this->db->where('status', '1');
		$this->db->where('username',$data['username']);
		$ret = $this->db->get('user',1)->row();
		
		
			
		if($ret){
			//echo 'yes';
			//die;
			$pwd_from_db = $ret->password;
					if ($pwd_from_db == $password) {

						//echo 'yes';
						//die;
						$userdata = array(
						'u_id' =>$ret->u_id,
						'username'=>$ret->username,
						'first_name'=>$ret->first_name,
						'last_name'=>$ret->last_name,
						'email'=>$ret->email,
						'is_admin'=>1,
						'user_group_id'=>$ret->user_group_id,
					);
					$updatedata =array(
						'last_login'=>date('Y-m-d H:i:s'),
						//'ip'=>$this->remoteaddress->getIpAddress(),

					);
					
					$this->db->where('u_id',$ret->u_id);
					$this->db->update('user',$updatedata);
					$this->session->set_userdata($userdata);
					
					
					return 1;
				}else{
					return 0;
				}
		}else{
			return 0;
		}
	}
	public function update(Array $data, $where = array()) {

            if (!is_array($where)) {

                $where = array(self::PRI_INDEX => $where);

            }

        $this->db->update(self::TABLE_NAME, $data, $where);

        return $this->db->affected_rows();

    }

	

	public function getoldpassword($data){

		$this->db->where('username',$data['username']);

		$ret = $this->db->get('user',1)->row();

		return $ret->password;

	}

	

	 public function updatepassword(Array $data, $where = array()) {

            if (!is_array($where)) {

                $where = array(self::PRI_INDEX => $where);

            }

        $this->db->update(self::TABLE_NAME, $data, $where);

        return $this->db->affected_rows();

    }

	


	

	public function checkuser($username){

		if ($username) {

			$this->db->where('username',$username);

			$ret = $this->db->get('user',1)->row();
//echo $this->db->last_query();
			//die;
			return $ret;

		}else{

			return 1;

		}

		

	}
}
       