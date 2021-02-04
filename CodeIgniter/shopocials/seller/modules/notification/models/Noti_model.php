<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noti_model  extends CI_Model{

	
	/**
	 * @name string TABLE_NAME Holds the name of the table in use by this model
	 */
	const TABLE_NAME = 'shop_mail_templates';

	/**
	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	 */
	const PRI_INDEX = 'semt_id';
	
	 public function getMailTemp(){
        $this->db->select('mail_templates.*', FALSE);
   $this->db->like('name','customer registration', FALSE);
         $this->db->or_like('name','customer forgot password', FALSE);
          $this->db->or_like('name','order status', FALSE);
         $query =$this->db->get('mail_templates');
        $ret = $query->result();
        return $ret;
    }
     public function insert(Array $data) {
        if ($this->db->insert(self::TABLE_NAME, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function getMailTempByid($id){
        $mt_id = $id;
        $this->db->where('mt_id',$mt_id, FALSE);
        $query =$this->db->get('mail_templates');
        $ret = $query->row();
        return $ret;
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
   public function getMailTempByshopid($id,$shopid){
        $mt_id = $id;
        $this->db->select('shop_mail_templates.*,mail_templates.mt_id,mail_templates.mail_title');
            $this->db->join('mail_templates', 'mail_templates.mt_id = shop_mail_templates.mail_id', 'left');
        $this->db->where('mail_id',$mt_id, FALSE);
         $this->db->where('shop_id',$shopid, FALSE);
        $query =$this->db->get('shop_mail_templates');
        $ret = $query->row();
        return $ret;
    }
   
    public function getMail($key = false){
        if (!$key)
            return $this->db->get('mail_templates')->result_array();
        else
            $result = $this->db->get_where('mail_templates', array('mail_title' => $key))->row_array();
        return $result['mail_content'];
    }

    public function getMsg($key = false){
        if (!$key)
            return $this->db->get('mail_templates')->result_array();
        else
            $result = $this->db->get_where('mail_templates', array('mail_title' => $key))->row_array();
        return $result['msg_template'];
    }  
    public function isMsgEnabled($key= false){
        if (!$key)
            return $this->db->get('mail_templates')->result_array();
        else
            $result = $this->db->get_where('mail_templates', array('mail_title' => $key))->row_array();
        return $result['send_msg'];
    }
     public function updateMail(Array $data, $where = array()) {
            
        $where = array('shop_id'=>$data['shop_id'],'mail_id'=>$data['mail_id']);
        $this->db->update(self::TABLE_NAME, $data, $where);
        //echo $this->db->last_query();
        //die;
        return $this->db->affected_rows();
    }
    
}   

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */