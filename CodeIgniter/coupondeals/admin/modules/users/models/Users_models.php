<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_models extends CI_Model {

	
	/**
	 * @name string TABLE_NAME Holds the name of the table in use by this model
	 */
	const TABLE_NAME = 'tbl_users';

	/**
	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	 */
	const PRI_INDEX = 'tbl_users.user_id';

	public function record_count() {
		
		
		$this->db->order_by(self::PRI_INDEX, 'desc');
		$query = $this->db->get(self::TABLE_NAME)->result();

		return count($query);
	}

	public function fetch_data($limit, $start) {
		
		
		$this->db->limit($limit, $start);
		$this->db->order_by(self::PRI_INDEX, 'desc');
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
	}


    public function getusers(){
    	 
        $query=  $this->db->get('tbl_users')->result();
        return $query;
    }
	 public function getuserssub(){
    	 
        $query=  $this->db->get('tbl_subscribe_user')->result();
        return $query;
    }
	 public function getusercontact(){
    	 
        $query=  $this->db->get('tbl_contact')->result();
        return $query;
    }
   public function delete($id) {
		$this->db->where(self::PRI_INDEX, $id);
		$this->db->delete(self::TABLE_NAME);
		return $this->db->affected_rows();
	}


public function record_countsub() {
		
		
		$this->db->order_by('subc_id', 'desc');
		$query = $this->db->get('tbl_subscribe_user')->result();

		return count($query);
	}

	public function fetch_datasub($limit, $start) {
		
		
		$this->db->limit($limit, $start);
		$this->db->order_by('subc_id', 'desc');
		$query = $this->db->get('tbl_subscribe_user');
		return $query->result();
	}


   
   public function deletesub($id) {
		$this->db->where('subc_id', $id);
		$this->db->delete('tbl_subscribe_user');
		return $this->db->affected_rows();
	}
	
	public function record_countcontact() {
		
		
		$this->db->order_by('contact_id', 'desc');
		$query = $this->db->get('tbl_contact')->result();

		return count($query);
	}

	public function fetch_datacontact($limit, $start) {
		
		
		$this->db->limit($limit, $start);
		$this->db->order_by('contact_id', 'desc');
		$query = $this->db->get('tbl_contact');
		return $query->result();
	}


   
   public function deletecontact($id) {
		$this->db->where('contact_id', $id);
		$this->db->delete('tbl_contact');
		return $this->db->affected_rows();
	}
	
public function updatestatus($id){
		
		
	   $sql = "update tbl_subscribe_user set status = case when status = 0 then 1 else 0 end
	    where subc_id ='".$id."'";
	    $query = $this->db->query($sql);
	     return $query;
//echo $this->db->last_query();
	     
	}
}

/* End of file Categories_models.php */
/* category: ./application/models/Categories_models.php */