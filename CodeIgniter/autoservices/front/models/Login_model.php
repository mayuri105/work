<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Login_model extends CI_Model {



	/**

     * @name string TABLE_NAME Holds the name of the table in use by this model

     */

    const TABLE_NAME = 'user';

	

	/**

     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model

     */

    const PRI_INDEX = 'Id';

	

	function __construct() {

		

	}

	public function validate($data){

		

		$password = $data['password'];

		//echo $PasswordHash;

		//die;

		$this->db->where('username',$data['username']);

		$ret = $this->db->get('user',1)->row();

		

		if($ret){

			$pwd_from_db = $ret->password;

				if ($pwd_from_db == $password) {



						$userdata = array(

						'u_id' =>$ret->u_id,

						'first_name'=>$ret->first_name,
						'last_name'=>$ret->last_name,

						'email'=>$ret->email,

						'is_login'=>1,

						'user_group_id'=>$ret->user_group_id,

						
					);

					$updatedata =array(

						'last_login'=>date('Y-m-d H:i:s'),

					);

					//echo $this->db->last_query();

					//die;

					$this->db->where('u_id',$ret->u_id);

					$this->db->update('user',$updatedata);

					$this->session->set_userdata($userdata);

					

					return 1;

				}else{

					return 0;

			}

		}

		

	}

	

	public function getpassword($data){

		$this->db->where('email',$data['email']);

		$ret = $this->db->get('user',1)->row();

		return $ret;

	}

	

	public function getuserbyid($id){

        $query = new stdClass();

        $this->db->where(self::PRI_INDEX, $id);

        $query->user_detail = $this->db->get(self::TABLE_NAME)->row();

       

        if(!$query) 

            show_404();

        return $query;

        

    }

	

	 public function update(Array $data, $where = array()) {

            if (!is_array($where)) {

                $where = array(self::PRI_INDEX => $where);

            }

        $this->db->update(self::TABLE_NAME, $data, $where);

        return $this->db->affected_rows();

    }

	

	public function getoldpassword($data){

		$this->db->where('email',$data['email']);

		$ret = $this->db->get('user',1)->row();

		return $ret->PasswordHash;

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

			$this->db->where('email',$username);

			$ret = $this->db->get('user',1)->row();
//echo $this->db->last_query();
			//die;
			return $ret;

		}else{

			return 1;

		}

		

	}
	
	public function updatepass(Array $data, $where = array()) {
		
		$data2  = array(
					'password' =>md5($this->input->post('password')),
					
					
		);
		$where = array('u_id'=>$data['u_id']);
		$this->db->update('user', $data2, $where);
		//echo $this->db->last_query();
		//die;
		return $this->db->affected_rows();
		
	}

}

       