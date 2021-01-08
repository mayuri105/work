<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class package_category_models extends CI_Model {

	/**
	 * @name string TABLE_NAME Holds the name of the table in use by this model
	 */
	const TABLE_NAME = 'package_category';

	/**
	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	 */
	const PRI_INDEX = 'package_category_id';

	public function record_count() {
		$package_category = $this->input->get('package_category');
		
		if ($package_category) {
			$this->db->like('package_category_name', $package_category);

		}
		
		$this->db->order_by(self::PRI_INDEX, 'desc');
		$query = $this->db->get(self::TABLE_NAME)->result();

		return count($query);
	}

	public function fetch_data($limit, $start) {
		
		$package_category = $this->input->get('package_category');
		
		if ($package_category) {
			$this->db->like('package_category_name', $package_category);

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
	public function getpackage_categoryByid($id){

        $this->db->where(self::PRI_INDEX, $id);
        $query=  $this->db->get(self::TABLE_NAME)->row();
        return $query;
    }
   

}

/* End of file package_category_models.php */
/* package_category: ./application/models/package_category_models.php */