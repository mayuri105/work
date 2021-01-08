<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adsorder_model extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
		
	}
	public function getStoreData(){
		$store_id = $this->session->store_id;
		$this->db->where('store_id',$store_id);
		$ret = $this->db->get('store')->row();
		return $ret;
	}

	public function getPackageData(){
		$asp_id = $this->session->addpackge_id;
		$this->db->where('asp_id',$asp_id);
		$ret = $this->db->get('ads_package')->row();
		return $ret;
	}

	public function insert(Array $data) {
        if ($this->db->insert('ads_order', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    public function getActiveMerchantInfo(){
    	$m_id = $this->session->m_id;
		$this->db->where('m_id',$m_id);
		$ret = $this->db->get('merchant')->row();
		return $ret;
    }
	
	public function updateMerchant(Array $data, $where = array()) {
			if (!is_array($where)) {
				$where = array('m_id' => $where);
			}
		$this->db->update('merchant', $data, $where);
		return $this->db->affected_rows();
	}

	public function updateAdsOrder(Array $data, $where = array()){
			if (!is_array($where)) {
				$where = array('ao_id' => $where);
			}
		$this->db->update('ads_order', $data, $where);
		return $this->db->affected_rows();
	}
}

/* End of file adsorder_model.php */
/* Location: ./application/models/adsorder_model.php */