<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups_models extends CI_Model {

	
	/**
	 * @name string TABLE_NAME Holds the name of the table in use by this model
	 */
	const TABLE_NAME = 'attributes_groups';

	/**
	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	 */
	const PRI_INDEX = 'ag_id';

	public function record_count() {
		$groups = $this->input->get('groups');
		if ($groups) {
			$this->db->like('groups_name', $groups);
			
		}
		$this->db->order_by(self::PRI_INDEX, 'desc');
		$query = $this->db->get(self::TABLE_NAME)->result();

		return count($query);
	}

	public function fetch_data($limit, $start) {
		
		$groups = $this->input->get('groups');
		
		if ($groups) {
			$this->db->like('groups_name', $groups);

		}
		$this->db->limit($limit, $start);
		$this->db->order_by(self::PRI_INDEX, 'desc');
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
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

	public function delete($id) {
		$this->db->where(self::PRI_INDEX, $id);
		$this->db->delete(self::TABLE_NAME);
		return $this->db->affected_rows();
	}
	public function getgroupsByid($id){

        $this->db->where(self::PRI_INDEX, $id);
        $query=  $this->db->get(self::TABLE_NAME)->row();
        return $query;
    }
    public function getState(){
    	 $this->db->where('enabled','1');
        $query=  $this->db->get('state')->result();
        return $query;
    }

}

/* End of file Groups_models.php */
/* city: ./application/models/Groups_models.php */