<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conversion_model extends CI_Model {

    public function getusers()
    {
        $this->db->limit('5','0');
        $ret = $this->db->get('user');
        return $ret->result();
    }
    public function getmerchant()
    {
          $this->db->limit('5','0');
        $ret = $this->db->get('merchant');
        return $ret->result();
    }

    public function insert(Array $data) {
        if ($this->db->insert('conversion', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function getmessage($user_id,$user_type){
        $sender_id = $this->session->userdata('m_id');
        $this->db->where('sender_id', $sender_id);
        $this->db->where('sender_type','merchant');
        $this->db->where('receiver_id', $user_id);
        $this->db->where('receiver_type',$user_type);
        //$this->db->order_by('send_date', 'DESC');
        $this->db->order_by('conversion_id', 'asc');
        $ret = $this->db->get('conversion');

        $sent_message =  $ret->result_array();
        
        $sender_id = $this->session->userdata('m_id');
        $this->db->where('sender_id', $user_id);
        $this->db->where('sender_type',$user_type);
        $this->db->where('receiver_id', $sender_id);
        $this->db->where('receiver_type','merchant');
        //$this->db->order_by('send_date', 'DESC');
        $this->db->order_by('conversion_id', 'DESC');
        $ret2 = $this->db->get('conversion');
        $receies_message =  $ret2->result_array();
        
        $allMessage = array_merge($sent_message,$receies_message);
        asort($allMessage);
        return $allMessage;

    }
     public function getMessageUser()
    {
        $merchant_id = $this->session->userdata('m_id');
        $this->db->group_by('sender_id');
        $this->db->where('receiver_id', $merchant_id);
        $this->db->where('receiver_type', 'merchant');
        $this->db->where('sender_type', 'user');
        $this->db->join('user', 'user.u_id = conversion.sender_id');
        $ret = $this->db->get('conversion')->result_array();

        $this->db->group_by('receiver_id');
        $this->db->where('sender_id',$merchant_id);
        $this->db->where('receiver_type', 'merchant');
        $this->db->where('sender_type', 'user');
        $this->db->join('user', 'user.u_id = conversion.receiver_id');
        $ret2 = $this->db->get('conversion')->result_array();

        $result = array_merge($ret,$ret2);
        return $result;
    }
    public function getMerchantMessage()
    {
        $merchant_id = $this->session->userdata('m_id');
        $this->db->group_by('sender_id');
        $this->db->where('receiver_id', $merchant_id);
        $this->db->where('receiver_type', 'merchant');
        $this->db->where('sender_type', 'merchant');
        $this->db->join('merchant', 'merchant.m_id = conversion.sender_id');
        $ret = $this->db->get('conversion')->result_array();

        $this->db->group_by('receiver_id');
        $this->db->where('sender_id',$merchant_id);
        $this->db->where('receiver_type', 'getMerchantMessage');
        $this->db->where('sender_type', 'merchant');
        $this->db->join('merchant', 'merchant.m_id = conversion.receiver_id');
        $ret2 = $this->db->get('conversion')->result_array();
        $result = array_merge($ret,$ret2);
        return $result;
    }
    public function unReadmsgCount($sender_id,$sender_type){
        $merchant_id = $this->session->userdata('m_id');
        
        $this->db->where('message_read','0');
        $this->db->where('receiver_id', $merchant_id);
        $this->db->where('receiver_type', 'merchant');
        $this->db->where('sender_type',$sender_type);
        $this->db->where('sender_id', $sender_id);
        $this->db->join('user', 'user.u_id = conversion.sender_id');
        $ret = $this->db->get('conversion')->result();
        return count($ret);
    }
    public function unReadmsgCountMer($sender_id,$sender_type){
        $merchant_id = $this->session->userdata('m_id');
        
        $this->db->where('message_read','0');
        $this->db->where('receiver_id', $merchant_id);
        $this->db->where('receiver_type', 'merchant');
        $this->db->where('sender_type',$sender_type);
        $this->db->where('sender_id', $sender_id);
        $this->db->join('merchant', 'merchant.m_id = conversion.sender_id');
        $ret = $this->db->get('conversion')->result();
        return count($ret);
    }
    public function setReadMsg($user_id,$user_type){
        $data = array(
            'message_read'=>'1'
        );
        $sender_id = $this->session->userdata('m_id');
        $this->db->where('sender_id', $user_id);
        $this->db->where('sender_type',$user_type);
        $this->db->where('receiver_id', $sender_id);
        $this->db->where('receiver_type','merchant');
        $ret = $this->db->update('conversion', $data);
        return $ret;
    }
    public function getmsgLast(){

        $user_id = $this->session->userdata('m_id');
        $this->db->limit('5');
         $this->db->order_by('sender_id');
        $this->db->order_by('send_date', 'desc');
        $this->db->where('receiver_id', $user_id);
        $this->db->where('receiver_type', 'merchant');
        $this->db->where('sender_type', 'user');
        $this->db->join('user', 'user.u_id = conversion.sender_id');
        $ret = $this->db->get('conversion')->result_array();
        return $ret;
    }
    public function getmsgLastMer(){

        $user_id = $this->session->userdata('m_id');
        $this->db->limit('5');
        $this->db->order_by('sender_id');
        $this->db->order_by('send_date', 'desc');

        $this->db->where('receiver_id', $user_id);
        $this->db->where('receiver_type', 'merchant');
        $this->db->where('sender_type', 'merchant');
        $this->db->join('merchant', 'merchant.m_id = conversion.sender_id');
        $ret = $this->db->get('conversion')->result_array();
        return $ret;
    }
    public function getUnreaadMsg(){
        $user_id = $this->session->userdata('m_id');
        $this->db->where('message_read','0');
        $this->db->where('receiver_id', $user_id);
        $this->db->where('receiver_type', 'merchant');
        $ret = $this->db->get('conversion')->result();
        return count($ret);
    }

    public function getUserBySearch($search){
        $this->db->like('username', $search, 'both');
        $ret = $this->db->get('user');
        return $ret->result();
    }
    public function getmerchantBySearch($search){
        $this->db->like('business_name', $search, 'both');
        $ret = $this->db->get('merchant');
        return $ret->result();
    }


}

/* End of file Conversion_model.php */
/* Location: /models/Conversion_model.php */