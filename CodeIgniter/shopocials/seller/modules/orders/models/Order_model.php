<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'orders';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'o_id';

    public function record_count() {
       
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
       
        

        $this->db->join('order_item', 'order_item.o_id = orders.o_id');
        $this->db->join('customer', 'customer.c_id = orders.customer_id');
        $this->db->join('order_status', 'order_status.order_status_id = orders.order_status');
        $this->db->join('shop', 'shop.shop_id = orders.shop_id');
        
        $this->db->order_by('orders.o_id','desc');
        $this->db->group_by('orders.o_id');
        $mid = $this->session->userdata('m_id');
        $this->db->where('merchant_id',$mid);
       
        $ret = $this->db->get(self::TABLE_NAME)->result();
        return count($ret);
    }

    public function fetch_data($limit, $start){
       $order_no = $this->input->get('order_no');
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
       
        

      $this->db->join('order_item', 'order_item.o_id = orders.o_id');
        $this->db->join('customer', 'customer.c_id = orders.customer_id');
        $this->db->join('order_status', 'order_status.order_status_id = orders.order_status');
        $this->db->join('shop', 'shop.shop_id = orders.shop_id');
        
        $this->db->limit($limit, $start);
        
        $this->db->order_by('orders.o_id','desc');
        $this->db->group_by('orders.o_id');
        $mid = $this->session->userdata('m_id');
        $this->db->where('merchant_id',$mid);
        $query = $this->db->get('orders');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                 $data[] = $row;
            }
            return $data;
        }
        return false;
    }
     public function getorder_status(){
        return $this->db->get('order_status')->result();
    }
        

    public function updatestatus($dataOrder,$o_id){

        

       $sql = "update orders set order_status ='".$dataOrder."' 

        where o_id ='".$o_id."'";

        $query = $this->db->query($sql);

         return $query;

         

    } 

   


}
