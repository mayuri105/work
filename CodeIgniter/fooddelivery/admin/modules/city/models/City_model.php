<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class City_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'city';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'city_id';

    public function record_count() {
        $city = $this->input->get('city');
        $state = $this->input->get('state');
        $zipcode = $this->input->get('zipcode');
        $enable = $this->input->get('enable');
        
        
        if($city){
            $this->db->like('city_name',$city);
        }
        if($state){
            $this->db->like('state',$state);
        }
        if($zipcode){
            $this->db->like('zipcode',$zipcode);
        }
         if($enable){
             if ($enable ==2) {
               
                 $this->db->where('city.status','0');
            }else{
                 $this->db->where('city.status',trim($enable));
            }
        }

        $this->db->join('city_zipcode', 'city_zipcode.city_id = city.city_id', 'left');
        $this->db->group_by('city_zipcode.city_id');
        $query = $this->db->get(self::TABLE_NAME)->result();
        return count($query);

    }

    public function fetch_data($limit, $start) {

        $city = $this->input->get('city');
        $state = $this->input->get('state');
        $zipcode = $this->input->get('zipcode');
        $enable = $this->input->get('enable');
        
        
        if($city){
            $this->db->like('city_name',$city);
        }
        if($state){
            $this->db->like('state',$state);
        }
        if($zipcode){
            $this->db->like('zipcode',$zipcode);
        }
          if($enable){
             if ($enable ==2) {
               
                 $this->db->where('city.status','0');
            }else{
                 $this->db->where('city.status',trim($enable));
            }
        }
    

        $this->db->limit($limit, $start);
        $this->db->join('city_zipcode', 'city_zipcode.city_id = city.city_id', 'left');
        $this->db->group_by('city_zipcode.city_id');
        $this->db->join('state', 'state.code = city.state', 'left');
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
        $this->db->like('city_name',post('search'), 'both');
        $this->db->or_like('state',post('search'), 'both');
       
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
    
    public function insertZips(Array $data) {
        if ($this->db->insert('city_zipcode', $data)) {
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
    public function delete($where ) {
        
        $arr_criteria = array('store_city',$where);
        $checking =$this->db->get_where('store', $arr_criteria)->row(); 

        if ($checking) {
            return false;
        }else{
             $this->db->where('city_id',$where );
             $this->db->delete(self::TABLE_NAME);
            return $this->db->affected_rows();
        }
    }
    public function getcitybyid($id){
        $query = new stdclass();
        $this->db->where(self::PRI_INDEX, $id);
        $query->city_info = $this->db->get(self::TABLE_NAME)->row();
        $this->db->where('city_id', $id);
        $query->city_zip = $this->db->get('city_zipcode')->result();
        return $query;
    }
    public function getzip($id){
        $this->db->where('cz_id', $id);
        $query = $this->db->get('city_zipcode')->row();
        return $query;
    }
    public function deletezips($where = array()) {
        if (!is_array()) {
            $where = array('cz_id' => $where);
        }
        $this->db->delete('city_zipcode', $where);
        return $this->db->affected_rows();
    }
    public function updateZips(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('cz_id' => $where);
            }
        $this->db->update('city_zipcode', $data, $where);
        return $this->db->affected_rows();
    }

    public function chckingZip($city_id,$zipcode){

        $this->db->where('city_id',$city_id);
        $this->db->where('zipcode',$zipcode);
        $ret = $this->db->get('city_zipcode')->row();
        if($ret){
            return 0;
        }else{
            return 1;
        }
    }
}
        