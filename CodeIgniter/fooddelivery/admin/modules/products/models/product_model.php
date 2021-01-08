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
		$this->db->join('store', 'store.store_id = products.store_id', 'left');
        $name = $this->input->get('name');
        $store_name = $this->input->get('store_name');
        $enable = $this->input->get('enable');
        $cuision = $this->input->get('cuision');
        $date_added = $this->input->get('date_added');
        $zipcode = $this->input->get('zipcode');

        if($name){
            $this->db->like('product_name',$name);
            
        }
        if($store_name){
            $this->db->like('store_name',$store_name);
           
        }
        
        if($cuision){
            $this->db->join('store_cuisine_data', 'store_cuisine_data.s_id = store.store_id', 'left');
            $this->db->join('cusine_data', 'cusine_data.cu_id = store_cuisine_data.cuisine_id', 'left');
            $this->db->like('cusine_type',$cuision,false);
        }
        if($zipcode){
            
            $this->db->where('store.store_zip',$zipcode,false);
        }
        if($enable){
             if ($enable ==2) {
               
                 $this->db->where('products.status','0');
            }else{
                 $this->db->where('products.status',trim($enable));
            }
        }
        if($date_added){
            $this->db->like('products.added_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
       
		
		$this->db->order_by(self::PRI_INDEX,'desc');
		$query = $this->db->get(self::TABLE_NAME)->result();
		return 	count($query);
	}

	public function fetch_data($limit, $start){

		$this->db->select('products.*,store.store_name,store.store_zip', FALSE);
		$this->db->join('store', 'store.store_id = products.store_id', 'left');
        $name = $this->input->get('name');
        $store_name = $this->input->get('store_name');
        $enable = $this->input->get('enable');
        $cuision = $this->input->get('cuision');
        $date_added = $this->input->get('date_added');
        $zipcode = $this->input->get('zipcode');

        if($name){
            $this->db->like('product_name',$name);
            
        }
        if($store_name){
            $this->db->like('store_name',$store_name);
           
        }
        if($enable){
             if ($enable ==2) {
               
                 $this->db->where('products.status','0');
            }else{
                 $this->db->where('products.status',trim($enable));
            }
        }
        if($cuision){
            $this->db->join('store_cuisine_data', 'store_cuisine_data.s_id = store.store_id', 'left');
            $this->db->join('cusine_data', 'cusine_data.cu_id = store_cuisine_data.cuisine_id', 'left');
            $this->db->like('cusine_type',$cuision,false);
        }
        if($zipcode){
            
            $this->db->where('store.store_zip',$zipcode,false);
        }

        if($date_added){
            $this->db->like('products.added_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
       
		$this->db->limit($limit, $start);
		$this->db->order_by(self::PRI_INDEX,'desc');
		$query = $this->db->get(self::TABLE_NAME);

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

	public function insertpro_cat(Array $data) {
		if ($this->db->insert('product_to_category', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}   
	public function update(Array $data, $where = array()) {
			if (!is_array($where)) {
				$where = array(self::PRI_INDEX => $where);
			}
		$this->db->update(self::TABLE_NAME, $data, $where);
		return $this->db->affected_rows();
	}

	public function updatepro_cat(Array $data, $where = array()) {
			if (!is_array($where)) {
				$where = array('ptc_id' => $where);
			}
		$this->db->update('product_to_category',$data,$where);
		return $this->db->affected_rows();
	}
   
	public function delete($id){
		$this->db->where(self::PRI_INDEX,$id);
		$this->db->delete(self::TABLE_NAME);
		
		// $this->db->where('product_id',$id);
		// $this->db->delete('product_option');
		return $this->db->affected_rows();
		
	}
	public function getproductbyid($id){
		$query = new stdClass();
		$this->db->select('products.*,product_to_category.category_id');
		$this->db->join('product_to_category','product_to_category.product_id = products.product_id'); 
		$this->db->where('products.product_id', $id);
		$query->product_data = $this->db->get(self::TABLE_NAME)->row();

		if(!$query) 
			show_404();
		return $query;
	}

	public function getmerchanttype(){
		$query =$this->db->get('merchant_type');
		$ret = $query->result();
		return $ret;
	}
	public function getmerchant(){
		$this->db->select('m_id,business_name');
		$this->db->join('store', 'store.merchant_id = merchant.m_id', 'right');
		$this->db->group_by('business_name');
		$query =$this->db->get('merchant');
		$ret = $query->result();
		return $ret;
	}

	public function getstorebymer($id=''){

		$this->db->select('store_id,store_name');


		if($this->session->userdata('is_merchant')){
			$mid = $this->session->userdata('m_id');
			$this->db->where('merchant_id',$mid);
		}else{
			$this->db->where('merchant_id',$id);
		}
		

		$query =$this->db->get('store');
		$ret = $query->result();
		return $ret;
	}

	public function get_category_by_store($id){

		$this->db->select('cat_id,category');
		$this->db->where('store_id',$id);
		$query =$this->db->get('category');
		$ret = $query->result();
		return $ret;
	}

	public function getcategory_by_pro($id){

		$this->db->select('cat_id,category');
		$this->db->where('cat_id',$id);
		$query =$this->db->get('category');
		$ret = $query->result();
		return $ret;
	}
	
	public function get_totalproduct_by_mer(){
		if($this->session->userdata('is_merchant')){
            $mid = $this->session->userdata('m_id');
            $this->db->where('merchant_id',$mid);
        }
        $this->db->select('product_id');
        $query = $this->db->get(self::TABLE_NAME);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row->product_id;
            }
            return $data;
        }
        return false;
	}
	public function insertProductOptioGr(Array $data){
		if ($this->db->insert('product_option', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	public function updateProductOptioGr(Array $data, $oid) {
		$this->db->where('option_id',$oid, FALSE);
		$this->db->update('product_option', $data, $where);
		return $this->db->affected_rows();
	}

	
	public function deletegroup($id){
		$this->db->where('option_id',$id);
		$this->db->delete('product_option');
		$this->db->where('option_group_id',$id);
		$this->db->delete('product_option_value');
		return $this->db->affected_rows();
	}

	public function insertProductOption(Array $data){
		if ($this->db->insert('product_option_value', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	public function updateProductOption(Array $data, $poid) {
		$this->db->where('po_id',$poid, FALSE);
		$this->db->update('product_option_value', $data, $where);
		return $this->db->affected_rows();
	}
	public function getgroupbyid($p_id){
		$this->db->where('product_id',$p_id);
		$query =$this->db->get('product_option');
		$ret = $query->result();
		return $ret;
	}
	public function getoptiongroupbyid($id){
		$this->db->where('option_id',$id);
		$query =$this->db->get('product_option');
		$ret = $query->row();
		return $ret;
	}
	public function getoptionbyid($product_id){
		$this->db->where('product_option.product_id',$product_id);
		$this->db->join('product_option', 'product_option.option_id = product_option_value.option_group_id', 'left');
		$query =$this->db->get('product_option_value');
		$ret = $query->result();
		return $ret;
	}
	public function getoptiondatabyid($id){
		$this->db->where('po_id',$id);
		$query =$this->db->get('product_option_value');
		$ret = $query->row();
		return $ret;
	}
	
	public function deleteoption($id){
		
		$this->db->where('po_id',$id);
		$this->db->delete('product_option_value');
		return $this->db->affected_rows();
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
}   

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */