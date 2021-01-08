<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Cronjobs_models extends CI_Model {



	public function  getExpireSubscription(){
		$this->db->select('phone,email,first_name,last_name,package_end_date', FALSE);
		$currentDate = date('Y-m-d');
		$endDate =  date('Y-m-d', strtotime("+3 days"));

		$this->db->where('package_end_date  >=',$currentDate);
		$this->db->where('package_end_date  <=',$endDate);

		$this->db->join('customer', 'customer.c_id = customer_buy_package.customer_id', 'left');
		$ret = $this->db->get('customer_buy_package')->result();
		
		return $ret;

	}

	public function  getNextHourAppointment(){

		$this->db->select('phone,email,first_name,last_name,appointment_status,start_time,end_time', FALSE);
		$current = date('H:i:s');
		$nextTime = date('H:i:s',strtotime('1 HOUR'));
		$this->db->where('start_time >=',  $current);
		$this->db->where('start_time <=',  $nextTime);
		$currentDate = date('Y-m-d');
		$this->db->where('appointment_date',$currentDate);
		$this->db->where('appointment_status >=', '1');
		$this->db->join('time_slot', 'time_slot.ts_id = appointment.appointment_time', 'left');
		$this->db->join('customer', 'customer.c_id = appointment.customer_id', 'left');
		$ret = $this->db->get('appointment')->result();
		return $ret;
	}


	public function runOnBidover(){
		$current = date('H:i:s');
		$currentDate = date('Y-m-d');
		$nextTime = date('H:i:s');
		$this->db->where('date',$currentDate);
		$this->db->where('end_time <',  $current);
		$this->db->where('is_notified IS  NULL');
		$ret = $this->db->get('bid_time_table')->result();
		
			
		if($ret){
			$this->db->limit(5);
	    	$this->db->select('bid.*,customer.*', FALSE);
	    	$this->db->order_by('amount', 'desc');
			$current = date('H:i:s');
        	$this->db->where('bid_dates_property.dates =', date('Y-m-d'));
	    	$this->db->join('property', 'property.property_id = bid.property_id', 'left');
	    	$this->db->join('bid_dates_property', 'bid_dates_property.property_id = property.property_id', 'left');
        	$this->db->join('customer', 'customer.c_id = bid.customer_id', 'left');
	    	$result = $this->db->get('bid')->result();
	    	return $result;
		}

		
		
	}
	public function updateNotification(){
		// $current = date('H:i:s');
		// $currentDate = date('Y-m-d');
		// $nextTime = date('H:i:s');
		// $this->db->where('date',$currentDate);
		// $this->db->where('end_time <',  $current);
		// $this->db->where('is_notified IS  NULL');
		// $data = array('is_notified' => 1);
		// $t = $this->db->update('bid_time_table',$data);
		// return $t;
	}
}