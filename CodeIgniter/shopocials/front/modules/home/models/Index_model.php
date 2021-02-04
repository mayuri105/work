<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Index_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'products';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'product_id';

   
    public function getcategory(){

        $query = $this->db->get('merchant_type')->result();
        return $query;
    }
    
     public function getproducts(){
    	$this->db->where('IsActive', '1');
    	$query = $this->db->get('products')->result();
        return $query;
    }
   
    public function getpage()
    {
        $this->db->where('show_on_footer', '1');
        $ret = $this->db->get('pages');
        return $ret->result();  
    }

    public function getProductBycategory($store_id){
        $query = new stdClass();
        
        $this->db->where('shop_id',$store_id);
      
        $this->db->where('shop.status', '1');
        $query->store_data = $this->db->get('shop')->row();

        
        $query->category =  $this->db->get_where('parent_category',array('shop_id'=>$query->store_data->shop_id,'parent_category IS  NULL'=> null))->result();
        $query->popular_product =  $this->db->get_where('products',array('shop_id'=>$query->store_data->shop_id,'is_popular'=>'1'))->result();
        
        
       
       
        
        if(!$query) show_404();
        return $query;
    }

    public function getCategoryData($cat_id){
        $category =$this->db->get_where('parent_category',array('cat_id'=>$cat_id))->row();
        return $category;
    }

    public function getstoreDataByid($store_id){

        $this->db->where('shop.status', '1');
       
        $this->db->where('shop_id',$store_id);
        $store_data = $this->db->get('shop')->row();
       
        return $store_data;

    }

    public function getSubCategoryData($cat_id){
        $category =$this->db->get_where('parent_category',array('parent_category'=>$cat_id))->result();
        return $category;
    }

    

}   
?>