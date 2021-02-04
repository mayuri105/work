<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Theme_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'themes';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'id';

    
    public function record_count() {
          
      $this->db->order_by(self::PRI_INDEX,'asc');
        $query = $this->db->get(self::TABLE_NAME)->result();
        return  count($query);
    }

    public function fetch_data($limit, $start) {
      
        $this->db->limit($limit, $start);
        $this->db->order_by(self::PRI_INDEX,'asc');
        $query = $this->db->get(self::TABLE_NAME);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

   
  
    public function update(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('shop_id' => $where);
            }
        $this->db->update('shop', $data, $where);
        return $this->db->affected_rows();
    }

    
   public function getmerchant_wise_store(){
        if($this->session->userdata('is_merchant')){
            $mid = $this->session->userdata('m_id');
            $this->db->where('merchant_id',$mid);
        }
        $this->db->select('shop_id');
        $query = $this->db->get('shop');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row->shop_id;
            }
            return $data;
        }
        return false;
    }
}

?>