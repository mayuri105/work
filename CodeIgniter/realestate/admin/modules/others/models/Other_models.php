<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Other_models extends CI_Model {

	public function __construct(){

	}

	public function getBuyPacakge($limit, $start){

		$this->db->limit($limit, $start);
		$this->db->order_by('cp_id', 'desc');
		$this->db->join('customer', 'customer.c_id = customer_buy_package.customer_id', 'left');
		$query = $this->db->get('customer_buy_package')->result();
		return $query;
	}
	public function record_countBuyPac(){
		$this->db->order_by('cp_id', 'desc');
		$query = $this->db->get('customer_buy_package')->result();
		return count($query);
	}

	public function getRentProp($limit, $start){
		$property_title = $this->input->get('property_title');
		if ($property_title ) {
			$this->db->like('property_title',$property_title, 'both');
		}
		$this->db->limit($limit, $start);
		$this->db->order_by('rp_id', 'desc');
		$this->db->join('property', 'property.property_id = rented_propety.property_id', 'left');
		$this->db->join('customer', 'customer.c_id = rented_propety.customer_id', 'left');
		$query = $this->db->get('rented_propety')->result();
		return $query;
	}
	
	public function getSaleProp($limit, $start){
		$property_title = $this->input->get('property_title');
		if ($property_title ) {
			$this->db->like('property_title',$property_title, 'both');
		}
		$this->db->limit($limit, $start);
		$this->db->order_by('sale_property.property_id', 'desc');
		$this->db->join('property', 'property.property_id = sale_property.property_id', 'left');
		$this->db->join('customer', 'customer.c_id = sale_property.customer_id', 'left');
		$query = $this->db->get('sale_property')->result();
		return $query;
	}
	public function record_countRentProp(){
		$property_title = $this->input->get('property_title');
		if ($property_title ) {
			$this->db->like('property_title',$property_title, 'both');
		}
		$this->db->order_by('rp_id', 'desc');
		$this->db->join('property', 'property.property_id = rented_propety.property_id', 'left');
		
		$query = $this->db->get('rented_propety')->result();
		return count($query);
	}
	public function getPackage(){
		$query = $this->db->get('package')->result();
		return $query;
	}

	public function getPackageDetail($id){
		$this->db->where('package_id', $id);
		$query = $this->db->get('package')->row();
		$date = date('Y-m-d');
		$date = date('Y-m-d', strtotime("+".$query->package_periods." months"));;
		$arr = array();

		$arr['package_price'] = $query->package_price;
		$arr['package_name'] = $query->package_name;
		$arr['package_end_date'] = $date;

		return $arr;

	}	
	public function insertSubPak(array $data){
		if ($this->db->insert('customer_buy_package', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function insertSalePro(array $data){
		if ($this->db->insert('sale_property', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	public function insertRentPro(array $data){
		if ($this->db->insert('rented_propety', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	public function updateSubPak(Array $data, $where = array()) {
		if (!is_array($where)) {
			$where = array('cp_id' => $where);
		}
		$this->db->update('customer_buy_package', $data, $where);
		return $this->db->affected_rows();
	}

	public function updateRentPro(Array $data, $where = array()) {
		if (!is_array($where)) {
			$where = array('rp_id' => $where);
		}
		$this->db->update('rented_propety', $data, $where);
		return $this->db->affected_rows();
	}
	public function updateSalePro(Array $data, $where = array()) {
		if (!is_array($where)) {
			$where = array('sale_property_id' => $where);
		}
		$this->db->update('sale_property', $data, $where);
		return $this->db->affected_rows();
	}

	public function getSubPacakge($id){
		$this->db->where('cp_id',$id);
		$query = $this->db->get('customer_buy_package')->row();
		return $query;
	}
	public function getCustprop($id){
		$this->db->where('rp_id',$id);
		$this->db->join('property', 'property.property_id = rented_propety.property_id', 'left');
		$query = $this->db->get('rented_propety')->row();

		return $query;
	}
	
	public function getSoldCustprop($id){
		$this->db->where('sale_property_id',$id);
		$this->db->join('property', 'property.property_id = sale_property.property_id', 'left');
		$query = $this->db->get('sale_property')->row();
		return $query;
	}
	public function deletePack($id) {
		$this->db->where('sale_property_id', $id);
		$this->db->delete('customer_buy_package');
		return $this->db->affected_rows();
	}
	public function deleteSalePro($id) {
		$this->db->where('sale_property_id', $id);
		$this->db->delete('sale_property');
		return $this->db->affected_rows();
	}
	public function deleteRenPro($id) {
		$this->db->where('rp_id', $id);
		$this->db->delete('rented_propety');
		return $this->db->affected_rows();
	}	
	public function getClientsImage(){
		$query = $this->db->get('client_images')->result();
		return $query;
	}

	public function insertClientImage(array $data){

    	$total = count($data['attachment']);
    	for ($i=0; $i < $total ; $i++) { 
    		$data2['image_name'] = $data['attachment'][$i];
    		$this->db->insert('client_images', $data2);
    	}	
    	//echo $this->db->last_query();
    	return true;
    }

    public function deleteImg(){
    	$this->db->truncate('client_images');
		return $this->db->affected_rows();
    }
}

/* End of file Other_models.php */
/* Location: ./application/models/Other_models.php */