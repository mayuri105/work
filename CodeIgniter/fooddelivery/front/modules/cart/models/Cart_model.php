<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
		
	}

	public function getProductOption(){
		$query = new stdClass();
		$this->db->select('product_option.*,product_option_value.*', FALSE);
		$this->db->order_by('product_option.option_id', 'asc');
		$this->db->group_by('product_option.option_id');
		$this->db->where('product_id',post('product_id'));
		$this->db->join('product_option_value', 'product_option_value.option_group_id = product_option.option_id');
		$query->product_option =  $this->db->get('product_option')->result();
		$this->db->where('product_id',post('product_id'));
		$query->products =  $this->db->get('products')->row();
		$query->DiscountPrice = $this->DiscountOnPrdoduct(post('product_id'));
		return $query;
	}

	

	public function getOption($id){

		$this->db->where('option_group_id',$id);
		$query =  $this->db->get('product_option_value')->result();
		if ($query) {
			return $query;
		}else{
			return 0;
		}
	}
	public function getOptionData($id){
		$this->db->where('po_id',$id);
		$this->db->join('product_option', 'product_option.option_id = product_option_value.option_group_id', 'left');
		$query =  $this->db->get('product_option_value')->row();
		if ($query) {
			return $query;
		}else{
			return 0;
		}
	}
	public function getProductCart(){
		$query = new stdClass();
		$cart = $this->cart->contents(); 
		$id = post('product_id'); 
		$exists = false;             
		$rowid = post('rowid');
		$query->productOpt =  $this->cart->product_options($rowid);
		$query->rowid = $rowid;
		return $query;
	}
	public function DiscountOnPrdoduct($product_id){
       $this->db->select('products.*,products.start_time as pst,
            products.end_time as pet,
            products.discount as pdiscount,
            category.start_time as cst,
            category.end_time as cet,
            category.discount as cdiscount,
			', FALSE);
        $this->db->join('product_to_category', 'product_to_category.product_id = products.product_id','left');
        $this->db->join('category', 'category.cat_id = product_to_category.category_id', 'left');
        $this->db->where('products.product_id', $product_id);
        $result = $this->db->get('products')->row();
        $today = date('Y-m-d');
        $product_discount = 0;
        $category_discount= 0;
        if ($result->pst <= $today && $result->pet >= $today) {
              $product_discount =$result->pdiscount;
        }
        if ($result->cst <= $today && $result->cet >= $today) {
             $category_discount=$result->cdiscount;
        }
        $discount = max($category_discount,$product_discount);
        $returnPrice = ($result->price * $discount )/100;
        return  $result->price - $returnPrice;
    }
    public function getminOrder($store_id){
        $this->db->where('store_id', $store_id, FALSE);
       	$query = $this->db->get('store')->row(); 
        return $query->minorder;
    }
    public function get_store_name($store_id){
    	$this->db->where('store_id', $store_id, FALSE);
        $query = $this->db->get('store')->row(); 
        return $query->store_name;
    }
    public function getStoreZip($store_id){
    	$this->db->select('city_zipcode.zipcode');
    	$this->db->where('city_zipcode.enabled','1');
    	$this->db->where('store_delivery_zip.store_id', $store_id);
    	$this->db->join('city_zipcode', 'city_zipcode.cz_id = store_delivery_zip.zip_code_id', 'left');
		$query = $this->db->get('store_delivery_zip')->result_array(); 
		$result = array();
		foreach ($query as $s) {
			$result[] = $s['zipcode'];
		}
        return $result;   
    }
}

/* End of file Cart_model.php */
/* Location: ./application/models/Cart_model.php */