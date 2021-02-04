<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model {
const TABLE_NAME = 'customer';
const PRI_INDEX = 'c_id';
	
	
public function insertMerchant(Array $data) {
        if ($this->db->insert('merchant', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
public function insertcustomer(Array $data) {
        if ($this->db->insert('customer', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

public function update(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array(self::PRI_INDEX => $where);
            }
        $this->db->update(self::TABLE_NAME, $data, $where);
        return $this->db->affected_rows();
    }
public function validate($data){
		
		
		$this->db->where('email',$data['email']);
		$this->db->where('enabled', '1');
		$ret = $this->db->get('customer',1)->row();
		
		
		if($ret){
             $inputpassword= md5($data['password']);  
			$dbpassword =  $ret->password;
			if ($inputpassword == $dbpassword){
				
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
public function getoldpassword($c_id){

		$this->db->where('c_id',$c_id);

		$ret = $this->db->get('customer',1)->row();
	//	echo $this->db->last_query(); die;

		return $ret->password;

	}
public function getpassword($data){

		$this->db->where('email',$data['email']);

		$ret = $this->db->get('customer',1)->row();

		return $ret->password;

	}
public function checkuser($username){

if ($username) {

$this->db->where('email',$username);

$ret = $this->db->get('customer',1)->row();
//echo $this->db->last_query();
//die;
return $ret;

}else{

return 1;

}
}
public function updatepassword(Array $data, $where = array()) {

            if (!is_array($where)) {

                $where = array(self::PRI_INDEX => $where);

            }

        $this->db->update(self::TABLE_NAME, $data, $where);

        return $this->db->affected_rows();

}
public function getcustomerbyid($id){

         $ret = $this->db->get_where(self::TABLE_NAME,array('c_id'=>$id))->row();
        // echo $this->db->last_query(); die;
         if(!$ret){
            show_404();
         } 
         return $ret;
    }

    
}

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */