<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mfree_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'mfree';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'mfree_id';

    
    public function record_count() {
        $customer = $this->input->get('customer');
        $reg_no = $this->input->get('reg_no');

        $issue_date_from = $this->input->get('issue_date_from');
        $issue_date_to= $this->input->get('issue_date_to');

        if($customer){
            $this->db->like('customer',$customer);
            
        }
        if($reg_no){
            
           
            $this->db->like('reg_no',$reg_no);
           
        }
       
        
        if($issue_date_from && $issue_date_to ){
           $this->db->where('issue_date >=', $issue_date_from);
            $this->db->where('issue_date <=', $issue_date_to);
            
        }
        
 
      $this->db->order_by(self::PRI_INDEX,'desc');
        $query = $this->db->get(self::TABLE_NAME)->result();
        return  count($query);
    }

    public function fetch_data($limit, $start) {
       $customer = $this->input->get('customer');
        $reg_no = $this->input->get('reg_no');

        $issue_date_from = $this->input->get('issue_date_from');
        $issue_date_to= $this->input->get('issue_date_to');

        if($customer){
            $this->db->like('customer',$customer);
            
        }
        if($reg_no){
            
           
            $this->db->like('reg_no',$reg_no);
           
        }
       
        
        if($issue_date_from && $issue_date_to ){
           $this->db->where('issue_date >=', $issue_date_from);
            $this->db->where('issue_date <=', $issue_date_to);
            
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

   
     public function get($id){

         $ret = $this->db->get_where(self::TABLE_NAME,array('mfree_id'=>$id))->row();
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

      
    public function mfreedelete($id) {
        
        $this->db->where(self::PRI_INDEX, $id);
    
        $this->db->delete(self::TABLE_NAME);
        return $this->db->affected_rows();
    }
   
}

?>