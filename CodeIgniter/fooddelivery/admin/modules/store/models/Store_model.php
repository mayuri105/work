<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_model extends CI_Model{

	
	/**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'store';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'store_id';
    
    public function record_count() {
        $name = $this->input->get('name');
        $merchant = $this->input->get('merchant');
        $enable = $this->input->get('enable');
        $cuisine = $this->input->get('cuisine');
        $date_added = $this->input->get('date_added');
        $city = $this->input->get('city');

        if($name){
            $this->db->like('store_name',$name);
            
        }
        if($merchant){
            
            $this->db->join('merchant', 'merchant.m_id = store.merchant_id', 'left');
            $this->db->like('business_name',$merchant);
           
        }
        if($enable){
             if ($enable ==2) {
               
                 $this->db->where('store.status','0');
            }else{
                 $this->db->where('store.status',trim($enable));
            }
        }
        if($cuisine){
            $this->db->join('store_cuisine_data', 'store_cuisine_data.s_id = store.store_id', 'left');
            $this->db->join('cusine_data', 'cusine_data.cu_id = store_cuisine_data.cuisine_id', 'left');
            $this->db->like('cusine_type',$cuisine,false);
        }
        if($city){
            
            $this->db->where('city.city_name',$city);
        }

        if($date_added){
            $this->db->like('store.created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
        

       
        $this->db->order_by(self::PRI_INDEX,'desc');
        $this->db->join('city', 'city.city_id = store.store_city', 'left');
        $query = $this->db->get(self::TABLE_NAME)->result();
        return count($query);

    }

    public function fetch_data($limit, $start){
       $this->db->select('store.*,city.city_name', FALSE);
        $name = $this->input->get('name');
        $merchant = $this->input->get('merchant');
        $enable = $this->input->get('enable');
        $cuisine = $this->input->get('cuisine');
        $date_added = $this->input->get('date_added');
        $city = $this->input->get('city');

        if($name){
            $this->db->like('store_name',$name);
            
        }
        if($merchant){
            
            $this->db->join('merchant', 'merchant.m_id = store.merchant_id', 'left');
            $this->db->like('business_name',$merchant);
           
        }
        if($enable){
             if ($enable ==2) {
               
                 $this->db->where('store.status','0');
            }else{
                 $this->db->where('store.status',trim($enable));
            }
        }
        if($cuisine){
            $this->db->join('store_cuisine_data', 'store_cuisine_data.s_id = store.store_id', 'left');
            $this->db->join('cusine_data', 'cusine_data.cu_id = store_cuisine_data.cuisine_id', 'left');
            $this->db->like('cusine_type',$cuisine,false);
        }
        if($city){
            
            $this->db->where('city.city_name',$city);
        }

        if($date_added){
            $this->db->like('store.created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
        

        $this->db->limit($limit, $start);
        $this->db->order_by(self::PRI_INDEX,'desc');
        $this->db->join('city', 'city.city_id = store.store_city', 'left');
        $query = $this->db->get(self::TABLE_NAME);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

   public function countproducts($id){
        $this->db->where('store_id',$id);
        $ret = $this->db->get('products')->result();
        return  count($ret);
        
       
   }

   public function fetch_products($id,$limit, $start){
        $this->db->where('store_id',$id);
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



   public function fetch_data_bysearch() {

        if($this->session->userdata('is_merchant')){
            $mid = $this->session->userdata('m_id');
            $this->db->group_start();
            $this->db->where('merchant_id',$mid);
            $this->db->group_end();
        }
        $this->db->group_start();

        $this->db->like('store_name',post('search'), 'both');
        $this->db->or_like('store_street',post('search'), 'both');
        $this->db->or_like('store_city',post('search'), 'both');
        $this->db->or_like('store_state',post('search'), 'both');

        $this->db->group_end();
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
            $id = $this->db->insert_id();

            if(post('store_type')=='1'){
                $this->store_cuisine_data_update($id);
            }
            return $id;
        } else {
            return false;
        }
    }
    
    protected function store_cuisine_data($id){
        $number = count($this->input->post('multicusine'));

        for ($i=0; $i<$number; $i++)
        {
            $data =  array(
                's_id'      =>$id,
                'cuisine_id' =>$this->input->post('multicusine')[$i],
            );
            $ret = $this->db->insert('store_cuisine_data',$data);
        }    
        return $ret;
    }
    public function update(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array(self::PRI_INDEX => $where);
                
            }
        $this->db->update(self::TABLE_NAME, $data, $where);
        return $this->db->affected_rows();
    }

   
    
    public function store_cuisine_data_update($mid)
    {
        $this->db->where('s_id',$mid);
        $this->db->delete('store_cuisine_data');
        $rets = $this->db->affected_rows();
        
        $number = count($this->input->post('multicusine'));

        for ($i=0; $i<$number; $i++)
        {
            $data =  array(
                's_id'      =>$mid,
                'cuisine_id' =>$this->input->post('multicusine')[$i],
            );
            $ret = $this->db->insert('store_cuisine_data',$data);
        }    
        return $ret;
        
    }
    public function delete($id) {
        $this->db->where(self::PRI_INDEX,$id);
        $this->db->delete(self::TABLE_NAME);
        return $this->db->affected_rows();
    }
    public function getstorebyid($id){
        
        $query = new stdClass();
        $this->db->select('store.*,city.city_name', FALSE);
        $this->db->join('merchant_type', 'merchant_type.mt_id = store.store_type');
        $this->db->join('merchant', 'merchant.m_id = store.merchant_id');
        $this->db->join('city', 'city.city_id = store.store_city');
        $this->db->where(self::PRI_INDEX, $id);
        $query->store_info = $this->db->get(self::TABLE_NAME)->row();
       
        $this->db->where('s_id', $id);
        $query->store_cuisine_data = $this->db->get('store_cuisine_data')->result();

        
        $this->db->where('store_id', $id);
        $store_zip = $this->db->get('store_delivery_zip')->result();
        $zipids = array();
        foreach ($store_zip as $sz) {
            $zipids[] = $sz->zip_code_id;
        }

        $query->zipcode = $zipids;

        return $query;
        
    }

    public function getmerchanttype(){
        $query =$this->db->get('merchant_type');
        $ret = $query->result();
        return $ret;
    }
    public function getmerchant(){
        $this->db->select('m_id,business_name');
        $query =$this->db->get('merchant');
        $ret = $query->result();
        return $ret;
    }

    
    public function insertdiscountCat(Array $data) {
        if ($this->db->insert('discount_to_pr_category', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    public function insertdiscountPro(Array $data) {
        if ($this->db->insert('product_to_discount', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    public function insertCategory(Array $data) {
        if ($this->db->insert('category', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

     public function updateCategory(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('cat_id' => $where);
                
            }
        $this->db->update('category', $data, $where);
        return $this->db->affected_rows();
    }
    public function insertpro_cat(Array $data) {
        if ($this->db->insert('product_to_category', $data)) {
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
        $this->db->select('store_id');
        $query = $this->db->get(self::TABLE_NAME);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row->store_id;
            }
            return $data;
        }
        return false;
    }

    public function getcusine_data(){
        $query =$this->db->get('cusine_data');
        $ret = $query->result();
        return $ret;
    }
    public function getcity(){
        $query =$this->db->get('city');
        $ret = $query->result();
        return $ret;
    }
    

    public function getOrderbystore($store_id){
        $this->db->where('store.store_id',$store_id);
        $this->db->join('store', 'store.store_id = order_store.store_id', 'left');
        $this->db->join('order_status', 'order_status.order_status_id = order_store.order_status_id', 'left');
        $this->db->where('order_store.order_status_id >=', '1', FALSE);
        $ret = $this->db->get('order_store')->result();
        
        return $ret;        
    }
    
    public function getcategory($id){
        $this->db->where('store_id',$id);
        $this->db->where('parent_category IS  NULL', null);
        $ret = $this->db->get('category')->result();
        return $ret;    
    }

    public function getProducts($category){
        $this->db->where('category_id', $category, FALSE);
        $this->db->join('product_to_category', 'product_to_category.product_id = products.product_id');
        $ret = $this->db->get('products')->result();
        return $ret;    
    }
    public function deleteproduct($id){
        $this->db->where('product_id',$id);
        $ret = $this->db->delete('products');
        $this->db->where('product_id',$id);
        $this->db->delete('product_to_category');
        $this->db->where('product_id',$id);
        $this->db->join('product_option_value', 'product_option_value.option_id = product_option.option_group_id', 'left');
        $this->db->delete('product_option'); 
        return  $ret;
    }
    public function deletecategory($id){
        $this->db->where('cat_id',$id);
        $ret = $this->db->delete('category');
        $this->db->where('category_id',$id);
        $this->db->delete('product_to_category');
        return  $ret;
    }
    public function getcatdata($id){

        $this->db->where('cat_id',$id);
        $ret = $this->db->get('category')->row();
        return $ret;    
    }
    public function getproduct($id){
        $this->db->where('product_id',$id);
        $ret = $this->db->get('products')->row();
        return $ret;  
    }
    public function getoptionGroup($id){
        $this->db->where('product_id',$id);
        $ret = $this->db->get('product_option')->result();
        return $ret;  
        
    }
    public function product_optionvalue($id){
        $this->db->where('option_group_id',$id);
        $ret = $this->db->get('product_option_value')->result();
        return $ret;  
    }

    
    public function updateOption(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('po_id' => $where);
                
            }
        $this->db->update('product_option_value', $data, $where);
        return $this->db->affected_rows();
    }
    public function insertOption(Array $data) {
        if ($this->db->insert('product_option_value', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
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
    
    public function deleteoptiongroup($id){
        $this->db->where('option_id',$id);
        $ret = $this->db->delete('product_option');
        $this->db->where('option_group_id',$id);
        $this->db->delete('product_option_value');
        return $ret;
    }
    public function getoptiongroupbyid($id){
        $this->db->where('option_id',$id);
        $query =$this->db->get('product_option');
        $ret = $query->row();
        return $ret;
    }
    public function updateProductOptioGr(Array $data, $oid) {
        $this->db->where('option_id',$oid, FALSE);
        $this->db->update('product_option', $data, $where);
        return $this->db->affected_rows();
    }
    public function insertProductOptioGr(Array $data){
        if ($this->db->insert('product_option', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function getzipOfcity($id){
        $this->db->where('city_id',$id);
        $this->db->where('enabled', '1');
        $ret = $this->db->get('city_zipcode');
       return $ret->result();
    }
    public function updatezipcode($data,$where){
        $ret = $this->db->update('store_delivery_zip',$data,$where);

        return $this->db->affected_rows();
    }
    public function insertzipcode(Array $data){
        if ($this->db->insert('store_delivery_zip', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }   

    public function deletezips($id){
        $this->db->where('store_id',$id);
        $this->db->delete('store_delivery_zip');
        return $this->db->affected_rows();
    }

    public function updateCatofProduct(){
        $category_id = str_replace('list-','', post('category_id'));
        $product_id = post('product_id');   

        $this->db->where('product_id',$product_id);
        $this->db->delete('product_to_category');

        $data = array('product_id' => $product_id,'category_id' =>$category_id  );
        $ret = $this->db->insert('product_to_category', $data);
        return $ret;
    }

    public function getSubCategory($category_id){
        $this->db->where('parent_category',$category_id);
        $ret = $this->db->get('category');
        return $ret->result();
    }

    public function getStoreReview($id){

        $this->db->where('store_id',$id);
        $this->db->join('customer', 'customer.c_id = store_review.review_by', 'left');
        $ret = $this->db->get('store_review');
        return $ret->result();
        
    }
    public function storerReviewDelete($id){
        $this->db->where('sr_id',$id);
        $ret = $this->db->delete('store_review');
        return $ret;
    }

    public function storerReviewApproved($id)
    {
        $this->db->where('sr_id',$id);
        $result = $this->db->get('store_review')->row();

        $ap = $result->approved ? '0' :'1';

        $data  = array(
            'approved'=>$ap    
        );
        $this->db->where('sr_id',$id);
        $ret = $this->db->update('store_review',$data);
        return $this->db->affected_rows();
    }
}   

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */