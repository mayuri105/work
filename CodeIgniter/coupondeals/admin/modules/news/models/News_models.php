<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_models extends CI_Model {

	
	/**
	 * @name string TABLE_NAME Holds the name of the table in use by this model
	 */
	const TABLE_NAME = 'tbl_news';

	/**
	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	 */
	const PRI_INDEX = 'tbl_news.news_id';

	/*public function record_count() {
		$post_title = $this->input->get('post_title');
		
		if ($post_title) {
			$this->db->like('post_title', $post_title);

		}
		
		$this->db->order_by(self::PRI_INDEX, 'desc');
		$query = $this->db->get(self::TABLE_NAME)->result();

		return count($query);
	}

	public function fetch_data($limit, $start) {
		
		$post_title = $this->input->get('post_title');
		
		if ($post_title) {
			$this->db->like('post_title', $post_title);

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
		$data2  = array('post_title' =>$data['post_title'],
			'post_desc'=>post('post_desc'),
			'img_class' => post('img_class'),
			
		);
		$where = array('id'=>$data['id']);
		$this->db->update(self::TABLE_NAME, $data2, $where);
		return $this->db->affected_rows();
		//echo $this->db->last_query();
	}


	public function delete($id) {
		$this->db->where(self::PRI_INDEX, $id);
		$this->db->delete(self::TABLE_NAME);
		return $this->db->affected_rows();
	}
	public function getcareersByid($id){

        $this->db->where(self::PRI_INDEX, $id);
        $query=  $this->db->get(self::TABLE_NAME)->row();
        return $query;
    }
    public function getcareer(){
    	 
        $query=  $this->db->get('tbl_careers')->result();
        return $query;
    }
    public function updatefile(Array $data, $where = array()){
		if (!is_array($where)) {
			$where = array(self::PRI_INDEX => $where);
		}
		$this->db->update(self::TABLE_NAME, $data, $where);
		return $this->db->affected_rows();
	}*/

}

/* End of file Categories_models.php */
/* category: ./application/models/Categories_models.php */