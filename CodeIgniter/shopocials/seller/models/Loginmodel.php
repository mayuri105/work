<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Loginmodel extends CI_Model {



  const TABLE_NAME = 'merchant';



    const PRI_INDEX = 'm_id';




	function __construct() {
		//$this->load->library('encrypt');
	//	$this->load->library('remoteaddress');
	}

	public function validatemerchant($data){
		$password = md5($data['password']);
		$this->db->where('email',$data['username']);
		$this->db->where('is_pverified', '1');
		$ret = $this->db->get('merchant',1)->row();
		if($ret){
			$pwd_from_db = $ret->password;

				if ($pwd_from_db == $password) {
					$userdata = array(
						'm_id' =>$ret->m_id,
						'username'=>$ret->email,
						'business_name'=>$ret->business_name,
						'firstname'=>$ret->firstname,
						'lastname'=>$ret->lastname,
						'is_merchant'=>1,

					);

					$unsetForOther = array('u_id','is_admin');
					$this->session->unset_userdata($unsetForOther);

					$this->session->set_userdata($userdata);
					$updatedata =array(
						'last_login'=>date('Y-m-d H:i:s'),
						//'ip'=>$this->remoteaddress->getIpAddress(),

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
	 public function update(Array $data, $where = array()) {

            if (!is_array($where)) {

                $where = array(self::PRI_INDEX => $where);

            }

        $this->db->update(self::TABLE_NAME, $data, $where);

        return $this->db->affected_rows();

    }



	public function getoldpassword($data){

		$this->db->where('username',$data['username']);

		$ret = $this->db->get('merchant',1)->row();

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

			$ret = $this->db->get('merchant',1)->row();
//echo $this->db->last_query();
			//die;
			return $ret;

		}else{

			return 1;

		}



	}
}
