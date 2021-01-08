<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );



class Index_model extends CI_Model {

	

	

	const TABLE_NAME = 'tbl_product_deal';



	/**

	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model

	 */

	const PRI_INDEX = 'tbl_product_deal.deal_id';



	public function record_count() {

		$category = $this->input->get('category');

		

        $category_search = $this->input->get('category_search');

       

		if ($category) {

			$this->db->where('cat_name', $category);



		}

		if($category_search){

            $this->db->like('title',$category_search);

           

        }

        $this->db->select('tbl_product_deal.*,tbl_categories.cat_id as cid,tbl_categories.cat_name,tbl_brands.brand_id as bid,tbl_brands.brand_name', FALSE);

		$this->db->join('tbl_categories','tbl_categories.cat_id = tbl_product_deal.cat_id', 'left');

		$this->db->join('tbl_brands','tbl_brands.brand_id = tbl_product_deal.brand_id', 'left');

		$this->db->order_by(self::PRI_INDEX, 'desc');

		$this->db->where('tbl_product_deal.status',1);

		$query = $this->db->get(self::TABLE_NAME)->result();



		return count($query);

	}



public function fetch_data($limit, $start) {

		$category = $this->input->get('category');

		

        $category_search = $this->input->get('category_search');

       

		if ($category) {

			$this->db->like('cat_name', $category);



		}

		if($category_search){

            $this->db->like('title',$category_search);

           

        }

       $this->db->select('tbl_product_deal.*,tbl_categories.cat_id as cid,tbl_categories.cat_name,tbl_brands.brand_id as bid,tbl_brands.brand_name', FALSE);

		$this->db->join('tbl_categories','tbl_categories.cat_id = tbl_product_deal.cat_id', 'left');

		$this->db->join('tbl_brands','tbl_brands.brand_id = tbl_product_deal.brand_id', 'left');

		$this->db->limit($limit, $start);

		$this->db->where('tbl_product_deal.status', 1);

		$this->db->order_by(self::PRI_INDEX, 'desc');

		//$where = "status='hot' OR status='medium' OR status='low'";

		//$this->db->where($where);

		

		$query = $this->db->get(self::TABLE_NAME);

		return $query->result();

	}

	



	

	

     public function getdeal(){

		//$this->db->select(MINUTE('tbl_product_deal.added_date as create_date') );  

		$this->db->select('tbl_product_deal.*,tbl_categories.cat_id as cid,tbl_categories.cat_name,tbl_brands.brand_id as bid,tbl_brands.brand_name', FALSE);

		$this->db->join('tbl_categories','tbl_categories.cat_id = tbl_product_deal.cat_id', 'left');

		$this->db->join('tbl_brands','tbl_brands.brand_id = tbl_product_deal.brand_id', 'left');

        $this->db->select('tbl_product_deal.*', FALSE);

        $this->db->order_by('tbl_product_deal.deal_id', 'desc');

		$this->db->where('tbl_product_deal.status', 1);

        $result = $this->db->get('tbl_product_deal')->result();

        return $result;

    } 



 public function getpopulardeal(){

		  

		$this->db->select('tbl_product_deal.*,tbl_categories.cat_id as cid,tbl_categories.cat_name,tbl_brands.brand_id as bid,tbl_brands.brand_name', FALSE);

		$this->db->join('tbl_categories','tbl_categories.cat_id = tbl_product_deal.cat_id', 'left');

		$this->db->join('tbl_brands','tbl_brands.brand_id = tbl_product_deal.brand_id', 'left');

        $this->db->select('tbl_product_deal.*', FALSE);

		 $this->db->limit(4);

		 $this->db->where('tbl_product_deal.status', 1);

        $this->db->order_by('deal_id', 'asc');

        $result = $this->db->get('tbl_product_deal')->result();

        return $result;

    } 

 public function getfeaturebrand(){

		   

		

        $this->db->select('tbl_brands.*', FALSE);

		 $this->db->where( 'feature', 1 );

		 $this->db->limit(4);

		 

        $this->db->order_by('brand_id', 'asc');

        $result = $this->db->get('tbl_brands')->result();

        return $result;

    } 

public function getcategory(){

		   

		

        $this->db->select('tbl_categories.*', FALSE);

		//$this->db->where( 'feature', 1 );

		//$this->db->limit(4);

		 

        $this->db->order_by('cat_id', 'asc');

        $result = $this->db->get('tbl_categories')->result();

        return $result;

    } 



 public function getdealbyurl($slug){

        

        $slug_alias =  str_replace('_', '-',$slug);

		$this->db->select('tbl_product_deal.*,tbl_categories.cat_id as cid,tbl_categories.cat_name,tbl_brands.brand_id as bid,tbl_brands.brand_name,tbl_brands.img_name as brandimg', FALSE);

		$this->db->join('tbl_categories','tbl_categories.cat_id = tbl_product_deal.cat_id', 'left');

		$this->db->join('tbl_brands','tbl_brands.brand_id = tbl_product_deal.brand_id', 'left');

        $this->db->where('deal_slug', $slug_alias);

        $ret = $this->db->get('tbl_product_deal');

        return $ret->row();

        

    }

	

	public function getdealbrand($id){

        

       

		$this->db->select('tbl_product_deal.*,tbl_categories.cat_id as cid,tbl_categories.cat_name,tbl_brands.brand_id as bid,tbl_brands.brand_name,tbl_brands.img_name as brandimg', FALSE);

		$this->db->join('tbl_categories','tbl_categories.cat_id = tbl_product_deal.cat_id', 'left');

		$this->db->join('tbl_brands','tbl_brands.brand_id = tbl_product_deal.brand_id', 'left');

        $this->db->where('tbl_product_deal.cat_id', $id);

        $ret = $this->db->get('tbl_product_deal');

       return $ret->result();

        

    }

   

}

?>

   