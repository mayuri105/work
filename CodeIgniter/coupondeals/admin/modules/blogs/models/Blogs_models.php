<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogs_models extends CI_Model {

	
	/**
	 * @name string TABLE_NAME Holds the name of the table in use by this model
	 */
	const TABLE_NAME = 'tbl_blogs';

	/**
	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	 */
	const PRI_INDEX = 'tbl_blogs.blog_id';

	public function record_count() {
		
		$this->db->select('tbl_blogs.*,tbl_blog_categories.blog_cat_slug as cslug,tbl_blog_categories.blog_cat_name', FALSE);
		$this->db->join('tbl_blog_categories','tbl_blog_categories.blog_cat_slug = tbl_blogs.cat_slug', 'left');
	$this->db->order_by('tbl_blogs.added_date', 'desc');
		$query = $this->db->get(self::TABLE_NAME)->result();

		return count($query);
	}

	public function fetch_data($limit, $start) {
		$this->db->select('tbl_blogs.*,tbl_blog_categories.blog_cat_slug as cslug,tbl_blog_categories.blog_cat_name', FALSE);
		$this->db->join('tbl_blog_categories','tbl_blog_categories.blog_cat_slug = tbl_blogs.cat_slug', 'left');
		$this->db->limit($limit, $start);
		$this->db->order_by('tbl_blogs.added_date', 'desc');
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
			'cat_slug' =>post('cat_slug'),
			'title' =>post('title'),
			'short_desc'=>post('short_desc'),
			'long_desc' => post('long_desc'),
			'author' => post('author'),
			'feature' => post('feature'),
			
		);
		$where = array('blog_id'=>$data['blog_id']);
		$this->db->update(self::TABLE_NAME, $data2, $where);
		return $this->db->affected_rows();
		//echo $this->db->last_query();
	}


	public function delete($id) {
		$this->db->where(self::PRI_INDEX, $id);
		$this->db->delete(self::TABLE_NAME);
		return $this->db->affected_rows();
	}
	public function getblogByid($id){

        $this->db->where(self::PRI_INDEX, $id);
        $query=  $this->db->get(self::TABLE_NAME)->row();
        return $query;
    }
    public function getblog(){
    	 
        $query=  $this->db->get('tbl_blogs')->result();
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
	public function getcategory(){
    	 
        $query=  $this->db->get('tbl_blog_categories')->result();
        return $query;
    }
	public function updatestatus($id){
		
		
	   $sql = "update tbl_blogs set status = case when status = 0 then 1 else 0 end
	    where blog_id ='".$id."'";
	    $query = $this->db->query($sql);
	     return $query;
//echo $this->db->last_query();
	     
	}

}

/* End of file Categories_models.php */
/* category: ./application/models/Categories_models.php */