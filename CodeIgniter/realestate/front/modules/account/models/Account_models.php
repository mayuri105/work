<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Account_models extends CI_Model {

	public function updateprofile(Array $data, $where = array()) {
        if (!is_array($where)) {
            $where = array('c_id' => $where);
        }
        $this->db->update('customer', $data, $where);
        return $this->db->affected_rows();
    }



	public function getAppointment(){
		$c_id = $this->session->userdata('c_id');
		$this->db->select('appointment.*,time_slot.*,appointment_status.appointment_status as asname', FALSE);
		$this->db->where('customer_id', $c_id);
		$this->db->where('appointment_status.appointment_status >=', '1');
		$this->db->join('time_slot', 'time_slot.ts_id = appointment.appointment_time', 'left');
		$this->db->join('appointment_status', 'appointment_status.aps_id = appointment.appointment_status', 'left');
		$ret = $this->db->get('appointment');
		return $ret->result();
	}
	public function getPackage(){

		// $this->db->select('id')->from('employees_backup');
		// $subQuery =  $this->db->get_compiled_select();

		$c_id = $this->session->userdata('c_id');
		$this->db->where('customer_id', $c_id);
		$this->db->where('payment_done','1');
		$this->db->select('customer_buy_package.*,package_category.*', FALSE);
		$this->db->order_by('cp_id', 'desc');
		$this->db->join('package_category', 'package_category.package_category_id = customer_buy_package.package_category_id', 'left');

		$ret = $this->db->get('customer_buy_package');
		return $ret->result();

		
    	

	}
} 