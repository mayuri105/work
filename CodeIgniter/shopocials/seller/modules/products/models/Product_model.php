<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{

	
	/**
	 * @name string TABLE_NAME Holds the name of the table in use by this model
	 */
	const TABLE_NAME = 'products';

	/**
	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	 */
	const PRI_INDEX = 'product_id';
	
	public function record_count() {
		if($this->session->userdata('is_merchant')){
			$mid = $this->session->userdata('m_id');
			$this->db->where('shop.merchant_id',$mid);
		} 
		$this->db->join('shop', 'shop.shop_id = products.shop_id', 'left');
        $name = $this->input->get('name');
        $category = $this->input->get('product_cat_id');
        $stock = $this->input->get('stock');
          $date_added = $this->input->get('date_added');
       
       
        if($name){
            $this->db->like('product_name',$name);
            
        }
        if($stock){
            $this->db->like('stock',$stock);
           
        }
        if($category){
            $this->db->like('product_cat_id',$category);
           
        }
        
       
       if($date_added){
            $this->db->like('products.added_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
        }
		
		$this->db->order_by(self::PRI_INDEX,'desc');
		$query = $this->db->get(self::TABLE_NAME)->result();
		return 	count($query);
	}

	public function fetch_data($limit, $start){
		$this->db->select('products.*', FALSE);
		if($this->session->userdata('is_merchant')){
			$mid = $this->session->userdata('m_id');
			$this->db->where('shop.merchant_id',$mid);
		} 
		
		$this->db->join('shop', 'shop.shop_id = products.shop_id', 'left');
        
        $date_added = $this->input->get('date_added');
        

       $name = $this->input->get('name');
        $category = $this->input->get('product_cat_id');
        $stock = $this->input->get('stock');
       
        if($name){
            $this->db->like('product_name',$name);
            
        }
        if($stock){
            $this->db->like('stock',$stock);
           
        }
        if($category){
            $this->db->like('product_cat_id',$category);
           
        }
        if($date_added){
            $this->db->like('products.added_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
        }
       
		$this->db->limit($limit, $start);
		$this->db->order_by(self::PRI_INDEX,'desc');
		$query = $this->db->get(self::TABLE_NAME);
//echo $this->db->last_query();
//die;
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
   }

   
	public function insert(Array $data) {
		if ($this->db->insert(self::TABLE_NAME, $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
public function updateProd(Array $data, $where = array()){
		if (!is_array($where)) {
			$where = array(self::PRI_INDEX => $where);
		}
		$this->db->update(self::TABLE_NAME, $data, $where);
		return $this->db->affected_rows();
	}
	public function insertPrImage(array $data,$product_id,$shop_id){

    	$total = count($data['attachment']);
    	for ($i=0; $i < $total ; $i++) { 
    		$data2['p_id'] = $product_id;
    		$data2['shop_id'] = $shop_id;
    		$data2['image_name'] = $data['attachment'][$i];
    		$this->db->insert('product_images', $data2);
    	}	
    }
    public function deletePrImage($id,$shop_id) {
		$this->db->where('p_id', $id);
		$this->db->where('shop_id', $shop_id);
		$this->db->delete('product_images');
		return $this->db->affected_rows();
	}	
	
	public function getshopbymer($id=''){

		$this->db->select('shop_id,shop_name');


		if($this->session->userdata('is_merchant')){
			$mid = $this->session->userdata('m_id');
			$this->db->where('merchant_id',$mid);
		}else{
			$this->db->where('merchant_id',$id);
		}
		

		$query =$this->db->get('shop');
		$ret = $query->row();
		return $ret;
	}
	public function update(Array $data, $where = array()) {
			$data2 = array(
					'product_name' => post('product_name'),
					'product_slug' =>$this->generatUnique(post('product_name')),
					'stock'=>post('stock'),
					'small_desc'=>post('small_desc'),
					'brand_id' => post('brand_id'),
					'product_cat_id' => post('product_cat_id'),
					'price' => post('price'),
					'merchant_id'=> post('merchant_id'),
					'shop_id'=> post('shop_id'),
					'total_price' => post('total_amt'),
					'qty'=> post('qty'),
					'is_popular'=> post('is_popular'),
				);
		$where = array('product_id'=>$data['product_id']);
		$this->db->update(self::TABLE_NAME, $data2, $where);
		return $this->db->affected_rows();
	}

function generatUnique($string,$id=''){
		$this->load->helper('url');
		$string2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string);
		$slug =strtolower($string2);
		$slugrpc = str_replace(' ','-', $slug); // Replaces all spaces with hyphens.

		$last = preg_replace('/[^A-Za-z0-9\-]/',' ', $slugrpc); 
		$i = 1; $baseSlug = $last;

		if ($id=='') {
			while($this->exitcheck($last)){
				$last = $baseSlug.'-'.$i++;        
			}
			$mainstring =  $last;
			return url_title($mainstring);	
		}else{
			while($this->exitcheck($last,$id)){
				$last = $baseSlug.'-'.$i++;        
			}
			$mainstring =  $last;
			return url_title($mainstring);		
		}
	
	}
	public function exitcheck($store,$id=''){
		if ($id) {
			$this->db->where('product_id !=',$id);
		}
		$this->db->where('product_slug',$store);
		$ret = $this->db->get('products');

		if($ret->row()){
			return true;
		}else{
			return false;
		}
	}
	public function productupdatestatus($id){

		
if($this->session->userdata('is_merchant')){
			$mid = $this->session->userdata('m_id');
		}
		

	   $sql = "update products set IsActive = case when IsActive = 0 then 1 else 0 end

	    where product_id ='".$id."' and merchant_id ='".$mid."'";

	    $query = $this->db->query($sql);

	     return $query;

	     

	} 
	public function productdelete($id) {
		if($this->session->userdata('is_merchant')){
			$mid = $this->session->userdata('m_id');
		}
		$this->db->where(self::PRI_INDEX, $id);
		$this->db->where('merchant_id', $mid);
		$this->db->delete(self::TABLE_NAME);
		return $this->db->affected_rows();
	}
	public function getproductbyid($id){
		//$query = new stdClass();
		if($this->session->userdata('is_merchant')){
			$mid = $this->session->userdata('m_id');
			$this->db->where('shop.merchant_id',$mid);
		} 
		$this->db->select('products.*,product_category.cat_id,brand.brand_id');
			$this->db->join('shop', 'shop.shop_id = products.shop_id', 'left');
		$this->db->join('product_category','product_category.cat_id = products.product_cat_id'); 
		$this->db->join('brand','brand.brand_id = products.brand_id'); 
		$this->db->where('products.product_id', $id);
		$query = $this->db->get(self::TABLE_NAME)->row();

		if(!$query) 
			show_404();
		return $query;
	}


	public function getProdImages($id){
		if($this->session->userdata('is_merchant')){
			$mid = $this->session->userdata('m_id');
			$this->db->where('shop.merchant_id',$mid);
		} 
		$this->db->join('shop', 'shop.shop_id = product_images.shop_id', 'left');
        $this->db->where('p_id', $id);
        $query=  $this->db->get('product_images')->result();
        return $query;
    }

	public function get_category_by_shop(){		
	
		$query =$this->db->get('product_category');
		$ret = $query->result();
		return $ret;
	}
public function get_brand_by_shop(){
		if($this->session->userdata('is_merchant')){
			$mid = $this->session->userdata('m_id');
			$this->db->where('shop.merchant_id',$mid);
		} 
		$this->db->join('shop', 'shop.shop_id = brand.shop_id', 'left');
		$this->db->select('brand_id,name');
	
		$query =$this->db->get('brand');
		$ret = $query->result();
		return $ret;
	}
	
	
	
	public function insertpro_discount($data){
		if ($this->db->insert('product_to_discount', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	public function getDiscount($id){
		$this->db->where('product_id',$id);
		$query =$this->db->get('product_to_discount');
		$ret = $query->result();
		return $ret;
	}
	public function deleteDiscount($id){
		
		$this->db->where('product_id',$id);
		$this->db->delete('product_to_discount');
		return $this->db->affected_rows();
	}
	public function insertdiscountPro(Array $data) {
        if ($this->db->insert('product_to_discount', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    public function gettaxrate($id){
		$this->db->select('tax_rate');
		$this->db->where('cat_id', $id);
		$query = $this->db->get('product_category')->row();

		if(!$query) 
			show_404();
		return $query;
	}
	public function getmarketrate($id){
	$this->db->select('market_comm_rate');
	$this->db->where('cat_id', $id);
	$query = $this->db->get('product_category')->row();

	if(!$query) 
		show_404();
	return $query;
	}
}   

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */