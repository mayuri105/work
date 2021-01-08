<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_models extends CI_Model {

	
	/**
	 * @name string TABLE_NAME Holds the name of the table in use by this model
	 */
	const TABLE_NAME = 'tbl_pages';

	/**
	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	 */
	const PRI_INDEX = 'tbl_pages.page_id';

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

	public function insert(Array $data) {
		if ($this->db->insert(self::TABLE_NAME, $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function update(Array $data, $where = array()) {
		$data2  = array(
			
			'name' =>post('name'),
			'description'=>post('description'),
			
			
		);
		$where = array('page_id'=>$data['page_id']);
		$this->db->update(self::TABLE_NAME, $data2, $where);
		return $this->db->affected_rows();
		echo $this->db->last_query(); 
	}


	public function delete($id) {
		$this->db->where(self::PRI_INDEX, $id);
		$this->db->delete(self::TABLE_NAME);
		return $this->db->affected_rows();
	}
	public function getpageByid($id){

        $this->db->where(self::PRI_INDEX, $id);
        $query=  $this->db->get(self::TABLE_NAME)->row();
        return $query;
    }
    public function getpage(){
    	 
        $query=  $this->db->get('tbl_pages')->result();
        return $query;
    }
    public function updateimages(Array $data, $where = array()){
		if (!is_array($where)) {
			$where = array(self::PRI_INDEX => $where);
		}
		$this->db->update(self::TABLE_NAME, $data, $where);
		return $this->db->affected_rows();
		//echo $this->db->last_query();
	}
	

}

/* End of file Categories_models.php */
/* category: ./application/models/Categories_models.php */