<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Coupon_model extends CI_Model {
	
	
	const TABLE_NAME = 'tbl_coupon';

	/**
	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	 */
	const PRI_INDEX = 'tbl_coupon.coupon_id';

	public function record_count() {
		
       
		$this->db->order_by(self::PRI_INDEX, 'desc');
			$this->db->select('tbl_coupon.*,tbl_brands.brand_id as bid,tbl_brands.brand_name,tbl_brands.img_name', FALSE);
			$this->db->join('tbl_brands','tbl_brands.brand_id = tbl_coupon.brand_id', 'left');		
		$query = $this->db->get(self::TABLE_NAME)->result();
		return count($query);
	}

public function fetch_data($limit, $start) {
		
      
		$this->db->select('tbl_coupon.*,tbl_brands.brand_id as bid,tbl_brands.brand_name,tbl_brands.img_name', FALSE);
			$this->db->join('tbl_brands','tbl_brands.brand_id = tbl_coupon.brand_id', 'left');	
		$this->db->limit($limit, $start);
		$this->db->order_by(self::PRI_INDEX, 'desc');
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
	}
	

	 public function getlatestdeal(){
		  
		 $this->db->order_by('tbl_product_deal.deal_id', 'desc');
		$this->db->where('status', 1);
		$this->db->limit(4);
        $result = $this->db->get('tbl_product_deal')->result();
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
   
}
?>
   