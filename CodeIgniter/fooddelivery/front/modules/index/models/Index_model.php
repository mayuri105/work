<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Index_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'store';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 's_id';

    public function totaldata(){
        $ret = new stdClass();
        $ret->cusine_data =  $this->db->count_all_results('cusine_data');
        $ret->city =  $this->db->count_all_results('city');
        return $ret;

    }

    public function getcuisine(){
    	$this->db->where('status', '1');
    	$query = $this->db->get('cusine_data')->result();
        return $query;
    }
    public function getcategory(){

        $query = $this->db->get('merchant_type')->result();
        return $query;
    }
    public function getcity(){
        
        $query = $this->db->get('city')->result();
        return $query;
    }

    public function getCityByid($id){
        $this->db->where('city_id',$id);
         $query = $this->db->get('city')->row();
        return $query;
    }


    public function getfoodinfo(){
        
        $this->db->where('mt_id','1');
        $query = $this->db->get('merchant_type')->row();
        return $query;
     }
    public function getcuisinebyname($cuisine){
        $this->db->where('cusine_type',$cuisine);
        $query = $this->db->get('cusine_data')->row();
        return $query;
    }
    public function getcatbyname($type){
        $this->db->where('type',$type);
        $query = $this->db->get('merchant_type')->row();
        return $query;
    }
    public function getcitybyname($city,$state){
        $this->db->where('state',$state);
        $this->db->where('city_name',$city);
        $query = $this->db->get('city')->row();
        
        return $query;
    }
    // updated
    public function getcityBycategory($type){
        $optionOfdelivery = $this->session->pickordelivery;
        if ($optionOfdelivery) {
            $this->db->like('store.deliveryoption',$optionOfdelivery);
        }
        $this->db->group_by('city_id');
        $this->db->select('store_type,store_city,city.city_id,city.city_name,city.state,city.feature_city,city.city_image_url,COUNT(*) as count');
        $this->db->join('city', 'city.city_id = store.store_city');
        $this->db->join('state', 'state.code = city.state');
        $this->db->join('merchant_type', 'merchant_type.mt_id = store.store_type');
        $this->db->where('city.status', '1');
        $this->db->where('state.status', '1');
        $this->db->where('store.status', '1');
        $this->db->where('type', $type);
        $query = $this->db->get('store')->result();
        return $query;
    }
    public function getfoodcity($cusine = ''){
        $optionOfdelivery = $this->session->pickordelivery;
        if ($optionOfdelivery) {
            $this->db->like('store.deliveryoption',$optionOfdelivery);
        }
        $this->db->group_by('city_id');
        $this->db->select('store_type,store_city,city.city_id,city.city_name,city.state,COUNT(*) as count');
        $this->db->where('store_type','1' , null, false);
        $this->db->join('city', 'city.city_id = store.store_city');
        if($cusine){
            $this->db->join('store_cuisine_data', 'store_cuisine_data.s_id = store.store_id');
            $this->db->join('cusine_data', 'cusine_data.cu_id = store_cuisine_data.cuisine_id');
            $this->db->where('cusine_type', $cusine, null, false);
        }
        $this->db->where('store.status', '1');
        $query = $this->db->get('store')->result();
        
        return $query;

    }

    public function getstorebycity($city,$type,$offset=0)
    {
        $optionOfdelivery = $this->session->pickordelivery;
        if ($optionOfdelivery) {
            $this->db->like('store.deliveryoption',$optionOfdelivery);
        }
        $this->db->group_by('store_id');
        $this->db->select('store.*,
            GROUP_CONCAT(category.category) as catg,
            AVG(store_review.review_rating)as rating_avg,
            if(store.ads_status = 1 && CURDATE() between store.ads_start_date AND store.ads_end_date,1,0 ) as q');
        $this->db->order_by('q','desc');
        $this->db->join('city', 'city.city_id = store.store_city');
        $this->db->where('city.city_id',$city, null, false);
        $this->db->join('merchant_type', 'merchant_type.mt_id = store.store_type');
        $this->db->join('category', 'category.store_id = store.store_id','left');
        $this->db->join('store_review', 'store_review.store_id = store.store_id','left');
        $this->db->where('merchant_type.type',$type, null, false);
        $this->db->where('store.status', '1');  
        $this->db->where('city.status', '1');  
         
        $query = $this->db->get('store','10',$offset)->result(); 
        
        return $query;
    }
    function num_stores($city,$type){
        $optionOfdelivery = $this->session->pickordelivery;
        if ($optionOfdelivery) {
            $this->db->like('store.deliveryoption',$optionOfdelivery);
        }
        $this->db->group_by('store_id');
        $this->db->select('store.*,
            GROUP_CONCAT(category.category) as catg,
            AVG(store_review.review_rating)as rating_avg,
            if(store.ads_status = 1 && CURDATE() between store.ads_start_date AND store.ads_end_date,1,0 ) as q');
        $this->db->order_by('q','desc');
        $this->db->join('city', 'city.city_id = store.store_city');
        $this->db->where('city.city_id',$city, null, false);
        $this->db->join('merchant_type', 'merchant_type.mt_id = store.store_type');
        $this->db->join('category', 'category.store_id = store.store_id','left');
        $this->db->join('store_review', 'store_review.store_id = store.store_id','left');
        $this->db->where('merchant_type.type',$type, null, false);
        $this->db->where('store.status', '1');  
        $this->db->where('city.status', '1');  
                
        $query = $this->db->get('store')->result(); 
        return count($query);
    }
    public function getproductByStoredetail($city_id,$unique_alias,$type){
        $query = new stdClass();
        $this->db->select('store.*,merchant_type.*,city.*,AVG(store_review.review_rating)as rating_avg');
        $this->db->join('merchant_type', 'merchant_type.mt_id = store.store_type');
        $this->db->where('unique_alias',$unique_alias);
        $this->db->join('city', 'city.city_id = store.store_city');
        $this->db->join('store_review', 'store_review.store_id = store.store_id', 'left');
        $this->db->where('store.status', '1');
        //$this->db->where('store_review.approved ', '1'); 
        $query->store_data = $this->db->get('store')->row();
        $query->category =  $this->db->get_where('category',array('store_id'=>$query->store_data->store_id,'status'=>'1','parent_category IS  NULL'=> null))->result();
        $query->popular_product =  $this->db->get_where('products',array('store_id'=>$query->store_data->store_id,'is_popular'=>'1'))->result();
        $this->db->join('customer', 'customer.c_id = store_review.review_by');
        $query->review_detail = $this->db->get_where('store_review',array('store_id'=>$query->store_data->store_id,'approved'=>'1'))->result();
        if(!$query) show_404();
        return $query;
    }

    public function getproductBySearch($store_id,$search){
        $query = new stdClass();
        $this->db->where('store_id',$store_id);
        $this->db->group_start();
        $this->db->like('product_name', $search, 'both');
        $this->db->or_like('small_desc', $search, 'both');
        $this->db->group_end();
        $result = $this->db->get('products')->result();
        $query->searchresult = $result;
        
        if(!$query) show_404();
        return $query;
    }
    public function getproductdata($category){
        
        $this->db->join('product_to_category', 'product_to_category.product_id = products.product_id');
        $this->db->where('product_to_category.category_id', $category);
        $this->db->where('products.status','1');
        $result = $this->db->get('products')->result();
        return $result;
    }
    public function getcityBystate($state){
        $this->db->where('state',$state);
        $query = $this->db->get('city')->result();
        return $query;
    }     

    public function getstorebycityCuisine($city,$cusine,$type='food'){

        $this->db->group_by('store_id');
        $this->db->select('store.*,GROUP_CONCAT(category.category) as catg,AVG(store_review.review_rating)as rating_avg');
        $this->db->join('city', 'city.city_id = store.store_city');
        $this->db->where('city.city_id',$city, null, false);
        $this->db->join('merchant_type', 'merchant_type.mt_id = store.store_type');
        $this->db->join('category', 'category.store_id = store.store_id','left');
        $this->db->where('merchant_type.type',$type, null, false);

        $this->db->join('store_cuisine_data', 'store_cuisine_data.s_id = store.store_id');
        $this->db->join('cusine_data', 'cusine_data.cu_id = store_cuisine_data.cuisine_id');
        $this->db->join('store_review', 'store_review.store_id = store.store_id','left');
        $this->db->where('cusine_type', $cusine , null, false);

        $query = $this->db->get('store')->result(); 
        
        return $query;
    }
    
    public function getminOrder($store_id){
        $this->db->where('store_id', $store_id, FALSE);
        $query = $this->db->get('store')->row(); 
        return $query->minorder;
    }   


    // updated new 
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
    function getCustomerByRef($ref){
        $this->db->where('share_code', $ref);
        $ret= $this->db->get('customer');
        return $ret->row();
    }

    public function getpage()
    {
        $this->db->where('show_on_footer', '1');
        $ret = $this->db->get('page');
        return $ret->result();  
    }

    public function getProductBycategory($store_id){
        $query = new stdClass();
        $this->db->join('merchant_type', 'merchant_type.mt_id = store.store_type');
        $this->db->where('store_id',$store_id);
        $this->db->join('city', 'city.city_id = store.store_city');
       
        $this->db->where('store.status', '1');
        $query->store_data = $this->db->get('store')->row();

        
        $query->category =  $this->db->get_where('category',array('store_id'=>$query->store_data->store_id,'parent_category IS  NULL'=> null))->result();
        $query->popular_product =  $this->db->get_where('products',array('store_id'=>$query->store_data->store_id,'is_popular'=>'1'))->result();
        
        
        $this->db->join('customer', 'customer.c_id = store_review.review_by');
        $query->review_detail = $this->db->get_where('store_review',array('store_id'=>$query->store_data->store_id))->result();
        
        if(!$query) show_404();
        return $query;
    }

    public function getCategoryData($cat_id){
        $category =$this->db->get_where('category',array('cat_id'=>$cat_id))->row();
        return $category;
    }

    public function getstoreDataByid($store_id){

        $this->db->where('store.status', '1');
        $this->db->join('merchant_type', 'merchant_type.mt_id = store.store_type');
        $this->db->where('store_id',$store_id);
        $store_data = $this->db->get('store')->row();
       
        return $store_data;

    }

    public function getSubCategoryData($cat_id){
        $category =$this->db->get_where('category',array('parent_category'=>$cat_id))->result();
        return $category;
    }

    public  function inserReview(Array $data)
    {
        if ($this->db->insert('store_review', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    public  function store_review_cust($store_id)
    {
        $customer_id = $this->session->c_id;
        $this->db->where('customer_id',$customer_id);
        $this->db->where('order_store.store_id', $store_id);
        $this->db->join('order_store', 'order_store.o_id = orders.o_id', 'left');
        $ret = $this->db->get('orders');
        if ($ret->row()) {
            return true;
        }else{
            return false;
        }
        

    }

}   
?>