<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vfm_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'vfm';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'vfm_id';

    
    public function record_count() {
        $name = $this->input->get('name');
        $reg_no = $this->input->get('reg_no');

        $registration_date_from = $this->input->get('registration_date_from');
        $registration_date_to = $this->input->get('registration_date_to');

        if($name){
            $this->db->like('name',$name);
            
        }
        if($reg_no){
            
           
            $this->db->like('reg_no',$reg_no);
           
        }
       
        
        if($registration_date_from && $registration_date_to ){
           $this->db->where('registration_date >=', $registration_date_from);
$this->db->where('registration_date <=', $registration_date_to);
            
        }
        
 
      $this->db->order_by(self::PRI_INDEX,'desc');
        $query = $this->db->get(self::TABLE_NAME)->result();
        return  count($query);
    }

    public function fetch_data($limit, $start) {
        $name = $this->input->get('name');
        $reg_no = $this->input->get('reg_no');

        $registration_date_from = $this->input->get('registration_date_from');
        $registration_date_to = $this->input->get('registration_date_to');

        if($name){
            $this->db->like('name',$name);
            
        }
        if($reg_no){
            
           
            $this->db->like('reg_no',$reg_no);
           
        }
       
        
        if($registration_date_from && $registration_date_to ){
           $this->db->where('registration_date >=', $registration_date_from);
            $this->db->where('registration_date <=', $registration_date_to);
            
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

    public function record_count_claim($id) {
        $customer = $this->input->get('customer');
        $certi_date = $this->input->get('certi_date');

        $claim_date_from = $this->input->get('claim_date_from');
        $claim_date_to = $this->input->get('claim_date_to');

        if($customer){
            $this->db->like('customer',$customer);
            
        }
        if($certi_date){
            
           
            $this->db->like('certi_date',$certi_date);
           
        }
       
        
        if($claim_date_from && $claim_date_to ){
           $this->db->where('claim_date >=', $claim_date_from);
         $this->db->where('claim_date <=', $claim_date_to);
            
        }
        
 
     // $this->db->order_by('claim_date','desc');
      
        $this->db->where('vfm_id', $id);
        $query = $this->db->get('claims_vfm')->result();
        return  count($query);
    }

    public function fetch_data_claim($limit, $start,$id) {
       $customer = $this->input->get('customer');
        $certi_date = $this->input->get('certi_date');

        $claim_date_from = $this->input->get('claim_date_from');
        $claim_date_to = $this->input->get('claim_date_to');

        if($customer){
            $this->db->like('customer',$customer);
            
        }
        if($certi_date){
            
           
            $this->db->like('certi_date',$certi_date);
           
        }
       
        
        if($claim_date_from && $claim_date_to ){
           $this->db->where('claim_date >=', $claim_date_from);
         $this->db->where('claim_date <=', $claim_date_to);
         $this->db->where('claim_date <=', $claim_date_to);
     
        }
        
        $this->db->limit($limit, $start);
       // $this->db->order_by('claim_date','desc');
        $this->db->where('vfm_id', $id);
        $query = $this->db->get('claims_vfm');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

    public function getclaim($id){

         $ret = $this->db->get_where('claims_vfm',array('vfm_claim_id'=>$id))->row();
         if(!$ret){
            show_404();
         } 
         return $ret;
    }
    public function getclaimbycaresid($id){

         $ret = $this->db->get_where('vfm',array('vfm_id'=>$id))->row();
        // echo $this->db->last_query()
         if(!$ret){
            show_404();
         } 
         return $ret;
    }
     public function get($id){

         $ret = $this->db->get_where(self::TABLE_NAME,array('vfm_id'=>$id))->row();
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

    
   

  
    public function cardelete($id) {
        
        $this->db->where(self::PRI_INDEX, $id);
    
        $this->db->delete(self::TABLE_NAME);
        return $this->db->affected_rows();
    }
    public function insertclaim(Array $data) {
        if ($this->db->insert('claims_vfm', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    
    public function updateclaim(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('vfm_claim_id' => $where);
            }
        $this->db->update('claims_vfm', $data, $where);
        return $this->db->affected_rows();
    }

    
   public function getlocation(){
        $query =$this->db->get('location');
        $ret = $query->result();
        return $ret;
    }

  
    public function claimdelete($id) {
        
        $this->db->where('vfm_claim_id', $id);
    
        $this->db->delete('claims_vfm');
        return $this->db->affected_rows();
    }
}

?>