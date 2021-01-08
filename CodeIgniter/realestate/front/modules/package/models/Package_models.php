<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Package_models extends CI_Model {

	public function getPackage($id='') {
		if ($id) {
			$this->db->where('package_category.package_category_id', $id, FALSE);
		
		}
		$this->db->join('package_category', 'package_category.package_category_id = package.package_category_id', 'left');
		$ret = $this->db->get('package');
		return $ret->result();
	}

	public function buypackage(array $data) {

		if ($this->db->insert('customer_buy_package', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}

	}
	public function getPackageInfo($package_id) {

		$this->db->where('package_id', $package_id, FALSE);
		$ret = $this->db->get('package');
		return $ret->row();
	}
    public function getBuyPackData($cip){
       // $cip =$this->session->userdata('buypackage');
        $this->db->where('cp_id', $cip);
        $ret = $this->db->get('customer_buy_package');
        return $ret->row();

    }

    public function updateBuyPack(array $data){
		$cip =$this->session->userdata('buypackage');
		$this->db->where('cp_id', $cip, FALSE);
		$ret = $this->db->update('customer_buy_package', $data);
		$cip2 =$this->session->userdata('history');
		$this->db->where('cp_id', $cip2, FALSE);
		$ret = $this->db->update('customer_package_history', $data);

         return $ret;

    }
    public function getActivePackage(){
    	$c_id = $this->session->userdata('c_id');
    	$this->db->where('payment_done', '1');
		$this->db->where('customer_id', $c_id, FALSE);
		$ret = $this->db->get('customer_package_history')->result();
		return $ret;

    }
    public function updateAlreadyBuyPackage(array $data,$cip){
    	 $this->db->where('cp_id', $cip, FALSE);
         $ret = $this->db->update('customer_buy_package', $data);
         return $ret;
    }
 	public function customer_package_history(array $data){
    	if ($this->db->insert('customer_package_history', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
    }
       
}
?>
