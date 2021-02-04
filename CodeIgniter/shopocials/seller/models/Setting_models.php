<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting_models extends CI_Model {


	function get($key = false){
		if (!$key)
            return $this->db->get('settings')->result_array();
        else
            $result = $this->db->get_where('settings', array('set_key' => $key))->row_array();
        return $result['value'];
	}

	public function update($name, $value) {
        $data = array(
            'value' => $value,
        );

        $this->db->where('set_key', $name);
        $this->db->update('settings', $data);
        return $this->db->affected_rows();
    }
    public function getmerchanttype(){
        $query =$this->db->get('merchant_type');
        $ret = $query->result();
        return $ret;
    }

    public function getMailTemp(){
        $this->db->select('mail_templates.*', FALSE);
   $this->db->like('name','customer registration', FALSE);
         $this->db->or_like('name','customer forgot password', FALSE);
          $this->db->or_like('name','order status', FALSE);
         $query =$this->db->get('mail_templates');
        $ret = $query->result();
        return $ret;
    }

    public function getMailTempByid($id){
        $mt_id = $id;
        $this->db->where('mt_id',$mt_id, FALSE);
        $query =$this->db->get('mail_templates');
        $ret = $query->row();
        return $ret;
    }
   
    public function updateMail(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('mt_id' => $where);
            }
        $this->db->update('mail_templates', $data, $where);
        return $this->db->affected_rows();
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
}

