<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'customer';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'c_id';

    public function record_count() {
         /*
         $order_no = $this->input->get('order_no');
        $order_status = $this->input->get('order_status');
       
        $payment_status = $this->input->get('payment_status');
        $created_on = $this->input->get('created_on');
        
        
        
        if($order_no){
            $this->db->where('orders.order_no',$order_no);
            
        }
         if($order_status){
            $this->db->where('orders.order_status',$order_status);
            
        }
        
         if($created_on){
            $this->db->like('orders.created_on',$created_on);
            
        }
       
        if($payment_status){
            $this->db->like('orders.payment_status',$payment_status);
           
        }
       
        
*/
        $this->db->select('customer.*', FALSE);
        if($this->session->userdata('is_merchant')){
            $mid = $this->session->userdata('m_id');
            $this->db->where('shop.merchant_id',$mid);
        } 
        
        $this->db->join('shop', 'shop.shop_id = customer.c_id', 'left');
        
       
        $ret = $this->db->get(self::TABLE_NAME)->result();
        return count($ret);
    }

    public function fetch_data($limit, $start){
     /*  $order_no = $this->input->get('order_no');
        $order_status = $this->input->get('order_status');
        $created_on = $this->input->get('created_on');
        $payment_status = $this->input->get('payment_status');
        
        
        
        if($order_no){
            $this->db->where('orders.order_no',$order_no);
            
        }
         if($order_status){
            $this->db->where('orders.order_status',$order_status);
            
        }
        
if($created_on){
            $this->db->like('orders.created_on',$created_on);
            
        }
       
        if($payment_status){
            $this->db->like('orders.payment_status',$payment_status);
           
        }
       
        */

     $this->db->select('customer.*', FALSE);
        if($this->session->userdata('is_merchant')){
            $mid = $this->session->userdata('m_id');
            $this->db->where('shop.merchant_id',$mid);
        } 
        
        $this->db->join('shop', 'shop.shop_id = customer.c_id', 'left');
        
        $this->db->limit($limit, $start);
        
        $this->db->order_by('customer.c_id','desc');
        $this->db->group_by('customer.c_id');
        
        $query = $this->db->get('customer');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                 $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    
        

   public function customerupdatestatus($id){

        
     $sql = "update customer set enabled = case when enabled = 0 then 1 else 0 end

        where c_id ='".$id."'";

        $query = $this->db->query($sql);

         return $query;

         

    } 

   public function customerdelete($id) {
        
        $this->db->where(self::PRI_INDEX, $id);
    
        $this->db->delete(self::TABLE_NAME);
        return $this->db->affected_rows();
    }


}
