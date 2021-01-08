<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Deals_models extends CI_Model {



	

	/**

	 * @name string TABLE_NAME Holds the name of the table in use by this model

	 */

	const TABLE_NAME = 'tbl_product_deal';



	/**

	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model

	 */

	const PRI_INDEX = 'tbl_product_deal.deal_id';



	public function record_count() {

		

		

		$this->db->order_by(self::PRI_INDEX, 'desc');

		$this->db->select('tbl_product_deal.*,tbl_categories.cat_id as cid,tbl_categories.cat_name,tbl_brands.brand_id as bid,tbl_brands.brand_name', FALSE);

		$this->db->join('tbl_categories','tbl_categories.cat_id = tbl_product_deal.cat_id', 'left');

		$this->db->join('tbl_brands','tbl_brands.brand_id = tbl_product_deal.brand_id', 'left');		

		$query = $this->db->get(self::TABLE_NAME)->result();



		return count($query);

	}



	public function fetch_data($limit, $start) {

		

		

		$this->db->limit($limit, $start);

		$this->db->select('tbl_product_deal.*,tbl_categories.cat_id as cid,tbl_categories.cat_name,tbl_brands.brand_id as bid,tbl_brands.brand_name', FALSE);

		$this->db->join('tbl_categories','tbl_categories.cat_id = tbl_product_deal.cat_id', 'left');

		$this->db->join('tbl_brands','tbl_brands.brand_id = tbl_product_deal.brand_id', 'left');

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

		$data2 = array(

					'cat_id' => post('cat_id'),

					'brand_id'=>post('brand_id'),

					'title'=>post('title'),

					

					'long_desc' => post('long_desc'),

					'orignal_price' => post('orignal_price'),

					'discount' => post('discount'),

					'total_price' => post('total_price'),	

					'hotdeal' => post('hotdeal'),

					'deal_url' => post('deal_url'),				

				);

		$where = array('deal_id'=>$data['deal_id']);

		$this->db->update(self::TABLE_NAME, $data2, $where);

		return $this->db->affected_rows();

		//echo $this->db->last_query();

	}





	public function delete($id) {

		$this->db->where(self::PRI_INDEX, $id);

		$this->db->delete(self::TABLE_NAME);

		return $this->db->affected_rows();

	}

	public function getdealByid($id){

		

        $this->db->where(self::PRI_INDEX, $id);

        $query=  $this->db->get(self::TABLE_NAME)->row();

        return $query;

    }

	public function getdeal(){

    	 

        $query=  $this->db->get('tbl_product_deal')->result();

        return $query;

    }

    public function getbrand(){

    	 

        $query=  $this->db->get('tbl_brands')->result();

        return $query;

    }

	public function getcategory(){

    	 

        $query=  $this->db->get('tbl_categories')->result();

        return $query;

    }

   public function updateimages(Array $data, $where = array()){

		if (!is_array($where)) {

			$where = array(self::PRI_INDEX => $where);

		}

		$this->db->update(self::TABLE_NAME, $data, $where);

		return $this->db->affected_rows();

	}

	public function updatestatus($id){

		

		

	   $sql = "update tbl_product_deal set status = case when status = 0 then 1 else 0 end

	    where deal_id ='".$id."'";

	    $query = $this->db->query($sql);

	     return $query;

//echo $this->db->last_query();

	     

	}



}



/* End of file Categories_models.php */

/* category: ./application/models/Categories_models.php */