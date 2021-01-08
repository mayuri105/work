<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Coupons_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'coupons';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'c_id';

    public function record_count() {
        return $this->db->count_all(self::TABLE_NAME);
    }

    public function fetch_data($limit, $start) {
        $this->db->limit($limit, $start);
       
        $query = $this->db->get(self::TABLE_NAME);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

   public function fetch_data_bysearch() {
        $this->db->like('coupon_name',post('search'), 'both');
        
       
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
    public function insertCoup_pro(Array $data) {
        if ($this->db->insert('coupons_to_products', $data)) {
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
    public function delete($id) {
        $this->db->where(self::PRI_INDEX, $id);
        $this->db->delete(self::TABLE_NAME);
        return $this->db->affected_rows();
    }
    public function getcouponsbyid($id){
        $this->db->where(self::PRI_INDEX, $id);
        $query = $this->db->get(self::TABLE_NAME)->row();

        return $query;
    }
    public function getcouponsHistorybyid($id){
        $this->db->where('coupon_id', $id);
        $this->db->join('customer', 'customer.c_id = coupons_histroy.customer_id', 'left');
        $query = $this->db->get('coupons_histroy')->result();
        return $query;
    }
    

    
}
        