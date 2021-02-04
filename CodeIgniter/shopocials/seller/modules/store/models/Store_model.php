<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_model extends CI_Model{


	/**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'shop';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'shop_id';





    public function getstorebyid(){

        if($this->session->userdata('is_merchant')){
            $mid = $this->session->userdata('m_id');
            $this->db->where('merchant_id',$mid);
        }


        $this->db->join('merchant', 'merchant.m_id = shop.merchant_id');

        $this->db->where('shop.merchant_id', $mid);
        $query = $this->db->get(self::TABLE_NAME)->row();

        return $query;

    }





   public function update(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array(self::PRI_INDEX => $where);

            }
        $this->db->update(self::TABLE_NAME, $data, $where);
        return $this->db->affected_rows();
    }





}

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */