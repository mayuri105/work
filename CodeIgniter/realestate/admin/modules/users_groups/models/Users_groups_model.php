<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_groups_model extends CI_Model {

	
	const TABLE_NAME = 'user_group';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'group_id';

	public function __construct()
	{
		parent::__construct();
		
	}
	public function fetch_data(){
		 $query = $this->db->get('user_group')->result();
        return $query;
	}

	public function insert(Array $data) {
        if ($this->db->insert(self::TABLE_NAME, $data)) {
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
    public function getUserGroups($id){
		$this->db->where('group_id', $id, FALSE);
		$query = $this->db->get('user_group')->row();
		return $query;
    }
    public function checkAssignOrnot($group_id){

    	$this->db->where('user_group_id', $group_id, FALSE);
		$query = $this->db->get('user')->result();
		if($query){
			return true;
		}else{
			return false;
		}
    }
    public function delete($group_id){
    	$this->db->where('group_id',$group_id);
        $this->db->delete(self::TABLE_NAME);
        return $this->db->affected_rows();
    }
}

/* End of file Users_groups_model.php */
/* Location: ./application/models/Users_groups_model.php */