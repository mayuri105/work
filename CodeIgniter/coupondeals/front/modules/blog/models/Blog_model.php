<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Blog_model extends CI_Model {
	
	
	const TABLE_NAME = 'tbl_blogs';

	/**
	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	 */
	const PRI_INDEX = 'tbl_blogs.blog_id';

	public function record_count() {
		
       
		
		$this->db->order_by(self::PRI_INDEX, 'desc');
		$this->db->where('status',1);
		$query = $this->db->get(self::TABLE_NAME)->result();
$this->db->order_by('blog_cat_name', 'desc');
		return count($query);
	}

public function fetch_data() {
		
      
		
		$this->db->where('status', 1);
		$this->db->order_by(self::PRI_INDEX, 'desc');
		$this->db->group_by('cat_slug', 'asc');
		
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
	}
	

	 public function getmobblog(){
		
       
		$this->db->limit(4);
		$this->db->where('status', 1);
		$this->db->where('cat_slug','mobiles');
		$this->db->order_by(self::PRI_INDEX, 'desc');
		//$this->db->group_by('cat_id', 'asc');
		
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
    } 
	 public function getenblog(){
		
        
		$this->db->limit(4);
		$this->db->where('status', 1);
		$this->db->where('cat_slug','entertainment');
		$this->db->order_by(self::PRI_INDEX, 'desc');
		//$this->db->group_by('cat_id', 'asc');
		
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
    } 
	public function getehblog(){
		
       
		$this->db->limit(4);
		$this->db->where('status', 1);
		$this->db->where('cat_slug','tech');
		$this->db->order_by(self::PRI_INDEX, 'desc');
		//$this->db->group_by('cat_id', 'asc');
		
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
    } 
	public function getfablog(){
		
        
		$this->db->limit(4);
		$this->db->where('status', 1);
		$this->db->where('cat_slug','fashion');
		$this->db->order_by(self::PRI_INDEX, 'desc');
		//$this->db->group_by('cat_id', 'asc');
		
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
    } 
	public function getlablog(){
		
       
		$this->db->limit(4);
		$this->db->where('status', 1);
		$this->db->where('cat_slug','lifestyle');
		$this->db->order_by(self::PRI_INDEX, 'desc');
		//$this->db->group_by('cat_id', 'asc');
		
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
    } 
	public function getsablog(){
		
       
		$this->db->limit(4);
		$this->db->where('status', 1);
		$this->db->where('cat_slug','shopping');
		$this->db->order_by(self::PRI_INDEX, 'desc');
		//$this->db->group_by('cat_id', 'asc');
		
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
    } 
	public function gethalblog(){
		
        
		$this->db->limit(4);
		$this->db->where('status', 1);
		$this->db->where('cat_slug','health');
		$this->db->order_by(self::PRI_INDEX, 'desc');
		//$this->db->group_by('cat_id', 'asc');
		
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
    } 
	public function getipblog(){
		
        
		$this->db->limit(4);
		$this->db->where('status', 1);
		$this->db->where('cat_slug','tips');
		$this->db->order_by(self::PRI_INDEX, 'desc');
		//$this->db->group_by('cat_id', 'asc');
		
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
    } 
	
	public function getnewsblog(){
		
        
		$this->db->limit(4);
		$this->db->where('status', 1);
		$this->db->where('cat_slug','news');
		$this->db->order_by(self::PRI_INDEX, 'desc');
		//$this->db->group_by('cat_id', 'asc');
		
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
    } 
	public function getfoodblog(){
		
        
		$this->db->limit(4);
		$this->db->where('status', 1);
		$this->db->where('cat_slug','food');
		$this->db->order_by(self::PRI_INDEX, 'desc');
		//$this->db->group_by('cat_id', 'asc');
		
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
    } 
     public function gettopblog(){
		
        $this->db->order_by(self::PRI_INDEX, 'desc');
		$this->db->where('status', 1);
		//$this->db->where('cat_slug','tech');
		$this->db->limit(6);
        $result = $this->db->get(self::TABLE_NAME);
        return $result->result();
    } 

 public function getlatestblog(){
		  
		 $this->db->order_by(self::PRI_INDEX, 'desc');
		$this->db->where('status', 1);
		$this->db->limit(4);
        $result = $this->db->get('tbl_blogs')->result();
        return $result;
    } 
	 public function getlatesttwoblog(){
		  
		 $this->db->order_by(self::PRI_INDEX, 'desc');
		$this->db->where('status', 1);
		$this->db->limit(3);
        $result = $this->db->get('tbl_blogs')->result();
        return $result;
    } 
 public function getfeaturebrand(){
		   
		
        $this->db->select('tbl_brands.*', FALSE);
		 $this->db->where( 'feature', 1 );
		 $this->db->limit(4);
		 
        $this->db->order_by('brand_id', 'desc');
        $result = $this->db->get('tbl_brands')->result();
        return $result;
    } 
	 public function getfeatureblog(){
		   
		
        $this->db->select('tbl_blogs.*', FALSE);
		 $this->db->where( 'feature', 1 );
		 $this->db->limit(3);
		 
        $this->db->order_by('blog_id', 'desc');
        $result = $this->db->get('tbl_blogs')->result();
        return $result;
    } 
/*public function getcategory(){
		   
		
        $this->db->select('tbl_categories.*', FALSE);
		//$this->db->where( 'feature', 1 );
		//$this->db->limit(4);
		 
        $this->db->order_by('cat_id', 'asc');
        $result = $this->db->get('tbl_categories')->result();
        return $result;
    } */

 public function getblogbyurl($slug){
        
        $slug_alias =  str_replace('_', '-',$slug);
		
        $this->db->where('blog_slug', $slug_alias);
       $ret = $this->db->get(self::TABLE_NAME);
        return $ret->row();
        
    }
	
	public function getblogcat($slug){
        
     
		//$this->db->limit(4);
		$this->db->where('status', 1);
		$this->db->where('cat_slug',$slug);
		$this->db->order_by(self::PRI_INDEX, 'desc');
		//$this->db->group_by('cat_id', 'asc');
		
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
        
    }
	 public function getpost($slug){
        
        $slug_alias =  str_replace('_', '-',$slug);
		
        $this->db->where('blog_slug', $slug_alias);
       $query = $this->db->get('tbl_blog_comment');
        return $query->result();
		//$query = $this->db->get(self::TABLE_NAME);
		//return $query->result();
        
    }
	public function insert(Array $data) {
		if ($this->db->insert('tbl_blog_comment', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
		//echo $this->db->last_query();
		//die;
	}
	 public function getlatestdeal(){
		  
		 $this->db->order_by('tbl_product_deal.deal_id', 'desc');
		$this->db->where('status', 1);
		$this->db->limit(4);
        $result = $this->db->get('tbl_product_deal')->result();
        return $result;
    } 
	
	/*public function getdealbrand($id){
        
       
		$this->db->select('tbl_product_deal.*,tbl_categories.cat_id as cid,tbl_categories.cat_name,tbl_brands.brand_id as bid,tbl_brands.brand_name,tbl_brands.img_name as brandimg', FALSE);
		$this->db->join('tbl_categories','tbl_categories.cat_id = tbl_product_deal.cat_id', 'left');
		$this->db->join('tbl_brands','tbl_brands.brand_id = tbl_product_deal.brand_id', 'left');
        $this->db->where('tbl_product_deal.brand_id', $id);
        $ret = $this->db->get('tbl_product_deal');
       return $ret->result();
        
    }*/
   
}
?>
   