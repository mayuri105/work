<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_model extends CI_Model{

	
	/**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'shop';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'shop_id';
    
    public function record_count_trial() {
         $this->db->select('shop.*,merchant.m_id,merchant.firstname,merchant.lastname');
         $this->db->join('merchant', 'merchant.m_id = shop.merchant_id', 'left');
        $name = $this->input->get('name');
        $merchant = $this->input->get('merchant');

        $date_added = $this->input->get('date_added');
       

        if($name){
            $this->db->like('shop_name',$name);
            
        }
        if($merchant){
            
           
            $this->db->like('merchant.firstname',$merchant);
           
        }
       
        
        if($date_added){
            $this->db->like('shop.created_on',date('mm-dd-yy',strtotime($this->input->get('date_added'))));
            
        }
      
        $this->db->order_by(self::PRI_INDEX,'desc');
      $this->db->where('shop_type', 1);
        $query = $this->db->get(self::TABLE_NAME)->result();
        return count($query);

    }

    public function fetch_data_trial($limit, $start){
       $this->db->select('shop.*,merchant.m_id,merchant.firstname,merchant.lastname');
        $this->db->join('merchant', 'merchant.m_id = shop.merchant_id', 'left');
        $name = $this->input->get('name');
        $merchant = $this->input->get('merchant');
      
        
        $date_added = $this->input->get('date_added');
       

        if($name){
            $this->db->like('shop_name',$name);
            
        }
        if($merchant){
            
      
            $this->db->like('merchant.firstname',$merchant);
           
        }
       
      
        if($date_added){
            $this->db->like('shop.created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
        

        $this->db->limit($limit, $start);
       
        $this->db->order_by(self::PRI_INDEX,'desc');
       $this->db->where('shop_type', 1);
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
 public function record_count_premium() {
         $this->db->select('shop.*,merchant.m_id,merchant.firstname,merchant.lastname');
         $this->db->join('merchant', 'merchant.m_id = shop.merchant_id', 'left');
        $name = $this->input->get('name');
        $merchant = $this->input->get('merchant');

        $date_added = $this->input->get('date_added');
       

        if($name){
            $this->db->like('shop_name',$name);
            
        }
        if($merchant){
            
           
            $this->db->like('merchant.firstname',$merchant);
           
        }
       
        
        if($date_added){
            $this->db->like('shop.created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
        

      
        $this->db->order_by(self::PRI_INDEX,'desc');
      $this->db->where('shop_type', 2);
        $query = $this->db->get(self::TABLE_NAME)->result();
        return count($query);

    }

    public function fetch_data_premium($limit, $start){
       $this->db->select('shop.*,merchant.m_id,merchant.firstname,merchant.lastname');
        $this->db->join('merchant', 'merchant.m_id = shop.merchant_id', 'left');
        $name = $this->input->get('name');
        $merchant = $this->input->get('merchant');
      
        
        $date_added = $this->input->get('date_added');
       

        if($name){
            $this->db->like('shop_name',$name);
            
        }
        if($merchant){
            
      
            $this->db->like('merchant.firstname',$merchant);
           
        }
       
      
        if($date_added){
            $this->db->like('shop.created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
        

        $this->db->limit($limit, $start);
       
        $this->db->order_by(self::PRI_INDEX,'desc');
       $this->db->where('shop_type', 2);
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
   
public function record_count_allstore() {
         $this->db->select('shop.*,merchant.m_id,merchant.firstname,merchant.lastname');
         $this->db->join('merchant', 'merchant.m_id = shop.merchant_id', 'left');
        $name = $this->input->get('name');
        $merchant = $this->input->get('merchant');

        $date_added = $this->input->get('date_added');
       

        if($name){
            $this->db->like('shop_name',$name);
            
        }
        if($merchant){
            
           
            $this->db->like('merchant.firstname',$merchant);
           
        }
       
        
        if($date_added){
            $this->db->like('shop.created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
        

      
        $this->db->order_by(self::PRI_INDEX,'desc');
     
        $query = $this->db->get(self::TABLE_NAME)->result();
        return count($query);

    }

    public function fetch_data_allstore($limit, $start){
       $this->db->select('shop.*,merchant.m_id,merchant.firstname,merchant.lastname');
        $this->db->join('merchant', 'merchant.m_id = shop.merchant_id', 'left');
        $name = $this->input->get('name');
        $merchant = $this->input->get('merchant');
      
        
        $date_added = $this->input->get('date_added');
       

        if($name){
            $this->db->like('shop_name',$name);
            
        }
        if($merchant){
            
      
            $this->db->like('merchant.firstname',$merchant);
           
        }
       
      
        if($date_added){
            $this->db->like('shop.created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
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
   
   public function fetch_products($id,$limit, $start){
        $this->db->where('shop_id',$id);
        $this->db->limit($limit, $start);
        $this->db->order_by('product_id','desc');
        $query = $this->db->get('products');

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
            $id = $this->db->insert_id();

           
            return $id;
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
    
    
     public function storedelete($id) {
        
        $this->db->where(self::PRI_INDEX, $id);
    
        $this->db->delete(self::TABLE_NAME);
        return $this->db->affected_rows();
    }
    public function getstorebyid($id){
        
        $query = new stdClass();
        $this->db->select('shop.*', FALSE);
       
        $this->db->join('merchant', 'merchant.m_id = shop.merchant_id');
       
        $this->db->where(self::PRI_INDEX, $id);
        $query = $this->db->get(self::TABLE_NAME)->row();

        return $query;
        
    }

    public function getmerchant(){
        $this->db->select('m_id,business_name');
        $query =$this->db->get('merchant');
        $ret = $query->result();
        return $ret;
    }

    public function getpackage()
    {
        
        $ret = $this->db->get('package');
        return $ret->result();
        
    }
    public function shoptype(){
        $query =$this->db->get('shop_type');
        $ret = $query->result();
        return $ret;
    }
   

    public function getcity(){
        $query =$this->db->get('city');
        $ret = $query->result();
        return $ret;
    }
public function getstate(){
        $query =$this->db->get('state');
        $ret = $query->result();
        return $ret;
    }
    public function getcountry(){
        $query =$this->db->get('country');
        $ret = $query->result();
        return $ret;
    }
    public function insertCategory(Array $data) {
        if ($this->db->insert('product_category')) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

     public function updateCategory(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('cat_id' => $where);
                
            }
        $this->db->update('product_category', $data, $where);
        return $this->db->affected_rows();
    }
    public function insertpro_cat(Array $data) {
        if ($this->db->insert('product_category', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    public function getmerchant_wise_store(){
        if($this->session->userdata('is_merchant')){
            $mid = $this->session->userdata('m_id');
            $this->db->where('merchant_id',$mid);
        }
        $this->db->select('shop_id');
        $query = $this->db->get(self::TABLE_NAME);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row->store_id;
            }
            return $data;
        }
        return false;
    }

    
    public function getcategory(){
       
        $ret = $this->db->get('product_category')->result();
        return $ret;   
    }

    public function getProducts($category){
        $this->db->where('category_id', $category, FALSE);
       
        $ret = $this->db->get('products')->result();
        return $ret;    
    }
    
    public function getcatdata($id){

        $this->db->where('cat_id',$id);
        $ret = $this->db->get('product_category')->row();
        return $ret;    
    }
    public function getproduct($id){
        $this->db->where('product_id',$id);
        $ret = $this->db->get('products')->row();
        return $ret;  
    }
        public function getzipOfcity(){
       
        $this->db->where('enabled', '1');
        $ret = $this->db->get('city_zipcode');
       return $ret->result();
    }
    public function getstorebyzip($id){ 
     $query = new stdClass();  
        $this->db->where('shop_id', $id);
        $store_zip = $this->db->get('shop_delivery_zip')->result();
        $zipids = array();
        foreach ($store_zip as $sz) {
            $zipids[] = $sz->zip_code_id;
        }


        return $zipids;
        
    }
    public function insertzipcode(Array $data){
        if ($this->db->insert('shop_delivery_zip', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }   
    public function deletezips($id){
        $this->db->where('shop_id',$id);
        $this->db->delete('shop_delivery_zip');
        return $this->db->affected_rows();
    }
    public function getSubCategory($category_id){
        $this->db->where('parent_category',$category_id);
        $ret = $this->db->get('category');
        return $ret->result();
    }
 public function status($id) {
        
        $sql = "update shop set status = case when status = 0 then 1 else 0 end
        where shop_id ='".$id."'";
        $query = $this->db->query($sql);
         return $query;
    }
    
}   

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */