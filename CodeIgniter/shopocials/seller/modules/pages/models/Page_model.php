<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'shop_page';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'p_id';

    
    public function record_count() {
          if($this->session->userdata('is_merchant')){
            $mid = $this->session->userdata('m_id');
            $this->db->where('shop.merchant_id',$mid);
        } 
        $this->db->join('shop', 'shop.shop_id = shop_page.shop_id', 'left');
      $this->db->order_by(self::PRI_INDEX,'desc');
        $query = $this->db->get(self::TABLE_NAME)->result();
        return  count($query);
    }

    public function fetch_data($limit, $start) {
        if($this->session->userdata('is_merchant')){
            $mid = $this->session->userdata('m_id');
            $this->db->where('shop.merchant_id',$mid);
        } 
        $this->db->join('shop', 'shop.shop_id = shop_page.shop_id', 'left');
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

   
    public function get($id){

         $ret = $this->db->get_where(self::TABLE_NAME,array('p_id'=>$id))->row();
         if(!$ret){
            show_404();
         } 
         return $ret;
    }

     
    public function insert(Array $data) {
        if ($this->db->insert(self::TABLE_NAME, $data)) {
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

    public function pageupdatestatus($id){


       $sql = "update shop_page set IsActive = case when IsActive = 0 then 1 else 0 end

        where p_id ='".$id."'";

        $query = $this->db->query($sql);

         return $query;

         

    } 
    public function pagedelete($id) {
        
        $this->db->where(self::PRI_INDEX, $id);
    
        $this->db->delete(self::TABLE_NAME);
        return $this->db->affected_rows();
    }
    
}

?>