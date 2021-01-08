<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_models extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getPage($slug){
		//echo $slug;
		//$this->db->where('field', 'value', FALSE);
		$slug_alias =  str_replace('_', '-',$slug);
		
		$this->db->where('page_slug', $slug_alias);
		$ret = $this->db->get('tbl_pages');
		return $ret->row();
	}


public function record_countbrand() {

	
         $this->db->select('tbl_brands.*', FALSE);
		
        $this->db->order_by('brand_id', 'desc');
        $query = $this->db->get('tbl_brands')->result();
		return count($query);
		

	}



public function fetch_databrand($limit, $start) {

		 $this->db->select('tbl_brands.*', FALSE);
		
		$this->db->limit($limit, $start);
        $this->db->order_by('brand_id', 'desc');
      
		$query = $this->db->get('tbl_brands');

		return $query->result();
     
       
	}

	


 public function getbrand(){
		   
		
        $this->db->select('tbl_brands.*', FALSE);
		// $this->db->where( 'feature', 1 );
		//$this->db->limit(4);
		 
        $this->db->order_by('brand_id', 'desc');
        $result = $this->db->get('tbl_brands')->result();
        return $result;
    } 
	public function insert(Array $data) {
        if ($this->db->insert('tbl_contact', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
        echo $this->db->last_query();
    }
}

/* End of file Page_models.php */
/* Location: ./application/models/Page_models.php */