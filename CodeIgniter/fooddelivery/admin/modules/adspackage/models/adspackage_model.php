<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adspackage_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'ads_package';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'asp_id';

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
        $this->db->like('type',post('search'), 'both');
        
       
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
    public function update(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array(self::PRI_INDEX => $where);
            }
        $this->db->update(self::TABLE_NAME, $data, $where);
        return $this->db->affected_rows();
    }
    public function delete($where = array()) {
        if (!is_array()) {
            $where = array(self::PRI_INDEX => $where);
        }
        $this->db->delete(self::TABLE_NAME, $where);
        return $this->db->affected_rows();
    }
    public function getpackagebyid($id){
        $this->db->where(self::PRI_INDEX, $id);
        $query = $this->db->get(self::TABLE_NAME)->row();
        return $query;
    }

    public function getReqOrders($limit, $start){
        $this->db->limit($limit, $start);
        $this->db->where('payment_done', '1');
        $query = $this->db->get('ads_order');
        return $query->result();
    }


    public function updateAdPackage(){
        $ao_id = post('ao_id');

        $where = array('ao_id'=>$ao_id);
        $data = array('ads_approved' =>'1'); 
        $this->db->update('ads_order', $data, $where);
        $ret = $this->db->affected_rows();
        $this->db->where('ao_id',$ao_id);
        $result = $this->db->get('ads_order')->row();
        $ads_start_date = date('Y-m-d');
        $offset = $result->package_periods; 
        $ads_end_date= date('Y-m-d', strtotime("+$offset months", strtotime($ads_start_date)));
        $updateStore = array(
            'ads_start_date'=>$ads_start_date,
            'ads_end_date'=>$ads_end_date,
            'ads_status'=>1
            );
        $where2 = array('store_id' => $result->store_id);
        $this->db->update('store', $updateStore, $where2);
        return $ret;
    }
     public function updateAdPackageDis(){
        $ao_id = post('ao_id');

        $where = array('ao_id'=>$ao_id);
        $data = array('ads_approved' =>'0'); 
        $this->db->update('ads_order', $data, $where);
        $ret = $this->db->affected_rows();
        $this->db->where('ao_id',$ao_id);
        $result = $this->db->get('ads_order')->row();
        $ads_start_date = date('Y-m-d');
        $offset = $result->package_periods; 
        $ads_end_date= date('Y-m-d', strtotime("+$offset months", strtotime($ads_start_date)));
        $updateStore = array(
            'ads_start_date'=>'',
            'ads_end_date'=>'',
            'ads_status'=>'0'
            );
        $where2 = array('store_id' => $result->store_id);
        $this->db->update('store', $updateStore, $where2);
        return $ret;
    }
    

}
        