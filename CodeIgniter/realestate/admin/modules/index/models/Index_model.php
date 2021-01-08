<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_model extends CI_Model {

	
	public function getuserActivity(){
			
		$this->db->order_by('activity_id', 'desc');
		$this->db->limit('10');
		$this->db->join('user', 'user.u_id = user_activity.user_id', 'left');
		$ret = $this->db->get('user_activity')->result();
		return $ret;
	}

	public function totalAgents(){
		$start = $this->input->get('start');
        $end =$this->input->get('end');
        if($start){
			$this->db->where('created_on >=' ,date('Y-m-d',strtotime($start)));
		}
		if($end){
			$this->db->where('created_on <=' ,date('Y-m-d',strtotime($end)));
		}

		$this->db->where('user_group_id', '2');
		$ret = $this->db->get('user')->result();
		return count($ret);
	}

	public function getPropertyForSale(){
		$start = $this->input->get('start');
        $end =$this->input->get('end');

        if($start){
			$this->db->where('added_on >=' ,date('Y-m-d',strtotime($start)));
		}
		if($end){
			$this->db->where('added_on <=' ,date('Y-m-d',strtotime($end)));
		}
		$this->db->where('property_action', 'sale');
		$ret = $this->db->get('property')->result();
		return count($ret);
	}

	public function getPropertySold(){
		$start = $this->input->get('start');
        $end =$this->input->get('end');

        if($start){
			$this->db->where('added_on >=' ,date('Y-m-d',strtotime($start)));
		}
		if($end){
			$this->db->where('added_on <=' ,date('Y-m-d',strtotime($end)));
		}
		$this->db->where('status', 'sold');
		$ret = $this->db->get('property')->result();
		return count($ret);
	}
	public function getPropertyForRent(){

		$start = $this->input->get('start');
        $end =$this->input->get('end');
        if($start){
			$this->db->where('added_on >=' ,date('Y-m-d',strtotime($start)));
		}
		if($end){
			$this->db->where('added_on <=' ,date('Y-m-d',strtotime($end)));
		}

		$this->db->where('property_action', 'rent');
		$ret = $this->db->get('property')->result();
		return count($ret);
	}
	

	public function todaysappointment(){

		$start = $this->input->get('start');
        $end =$this->input->get('end');

        if($start){
			$this->db->where('appointment_date >=' ,date('Y-m-d',strtotime($start)));
		}
		if($end){
			$this->db->where('appointment_date <=' ,date('Y-m-d',strtotime($end)));
		}
		$this->db->where('appointment_date', date('Y-m-d'));
		$ret = $this->db->get('appointment')->result();
		return count($ret);
	}
	
	public function getTotalCustomer(){
		$start = $this->input->get('start');
        $end =$this->input->get('end');
        if($start){
			$this->db->where('created_on >=' ,date('Y-m-d',strtotime($start)));
		}
		if($end){
			$this->db->where('created_on <=' ,date('Y-m-d',strtotime($end)));
		}
		$ret = $this->db->get('customer')->result();
		return count($ret);
	}	

	public function totalProfit(){
		$this->db->select('sum(package_price) as t');
		$this->db->where('payment_done', '1');
		$ret = $this->db->get('customer_package_history')->row();
		return $ret->t;
	}
	public function getAppointment()
	{
		$this->db->join('customer', 'customer.c_id = appointment.customer_id', 'left');
		$this->db->join('appointment_status', 'appointment_status.aps_id = appointment.appointment_status', 'left');
		$this->db->join('time_slot', 'time_slot.ts_id = appointment.appointment_time', 'left');
		$this->db->where('appointment_date', date('Y-m-d'));
		$ret = $this->db->get('appointment')->result();
		return $ret;
	}
}

/* End of file Index_model.php */
/* Location: ./application/models/Index_model.php */