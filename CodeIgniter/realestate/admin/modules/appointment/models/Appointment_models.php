<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointment_models extends CI_Model {

	
	/**
	 * @name string TABLE_NAME Holds the name of the table in use by this model
	 */
	
	const TABLE_NAME = 'Appointment';

	/**
	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	 */
	const PRI_INDEX = 'appointment_id';

	public function record_count() {
		$customer = $this->input->get('customer');
		$as_status = $this->input->get('appointment_status');
		$date_added = $this->input->get('date_added');
		if ($customer) {
			$this->db->like('first_name', $customer);
		}
		if ($as_status) {
			$this->db->where('appointment.appointment_status', $as_status);
		}
		if ($date_added) {
			$this->db->where('appointment_date', date('Y-m-d',strtotime($date_added)));
		}
		$this->db->join('customer', 'customer.c_id = appointment.customer_id', 'left');
		$this->db->join('appointment_status', 'appointment_status.aps_id = appointment.appointment_status', 'left');
		$this->db->order_by(self::PRI_INDEX, 'desc');
		$this->db->join('time_slot', 'time_slot.ts_id = appointment.appointment_time', 'left');
       	$query = $this->db->get(self::TABLE_NAME)->result();
		return count($query);
	}

	public function fetch_data($limit, $start) {
		
		$customer = $this->input->get('customer');
		$as_status = $this->input->get('appointment_status');
		$date_added = $this->input->get('date_added');
		$this->db->select('appointment.*,customer.*,appointment_status.*,time_slot.*,property.property_title', FALSE);
		if ($customer) {
			$this->db->like('first_name', $customer);
			
		}
		if ($as_status) {
			$this->db->where('appointment.appointment_status', $as_status);
			
		}
		if ($date_added) {
			$this->db->where('appointment_date', date('Y-m-d',strtotime($date_added)));
		}
		$this->db->limit($limit, $start);
		$this->db->order_by(self::PRI_INDEX, 'desc');
		$this->db->join('customer', 'customer.c_id = appointment.customer_id', 'left');
		$this->db->join('time_slot', 'time_slot.ts_id = appointment.appointment_time', 'left');
		 $this->db->join('property', 'property.property_id = appointment.property_id', 'left');
       
		$this->db->join('appointment_status', 'appointment_status.aps_id = appointment.appointment_status', 'left');
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
	}

	public function insert(Array $data) {
		if ($this->db->insert(self::TABLE_NAME, $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function update(Array $data, $where = array()) {
		if (!is_array($where)) {
			$where = array(self::PRI_INDEX => $where);
		}
		$this->db->update(self::TABLE_NAME, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete($id) {
		$this->db->where(self::PRI_INDEX, $id);
		$this->db->delete(self::TABLE_NAME);
		return $this->db->affected_rows();
	}
	public function getAppointmentByid($id){

        $this->db->where(self::PRI_INDEX, $id);
        $this->db->join('time_slot', 'time_slot.ts_id = appointment.appointment_time', 'left');
        $this->db->join('property', 'property.property_id = appointment.property_id', 'left');
        $query=  $this->db->get(self::TABLE_NAME)->row();
        return $query;
    }
   	

   	public function getAppointmentSta(){
      	 $query=  $this->db->get('appointment_status')->result();
        return $query;
    }
	public function getCust(){
		$this->db->where('enabled', '1');
		$query =  $this->db->get('customer')->result();
        return $query;
    }
    
   
     public function getTimeslot($date){
        // // $checkdateAppointmentSlot 

        $this->db->group_by('appointment_time');
        $this->db->select('appointment_time');
        $this->db->where('appointment_status >=', '1');
        $this->db->where('appointment_date',date('Y-m-d',strtotime($date)));
        $occupiedSlot =  $this->db->get('appointment')->result();
        $query = $this->db->last_query();
        $this->db->order_by('ts_id', 'desc');
        $this->db->select('time_slot.*');
        $this->db->where('enabled', '1');
        $this->db->where('time_slot.ts_id NOT IN ('.$query.')', NULL, FALSE);
        $timeslot = $this->db->get('time_slot')->result();
        $return = array();
        foreach ($timeslot as $t) {
           $return[] = array(
                'ts_id' =>$t->ts_id,
                'start_time' => date('g:i:a',strtotime($t->start_time)),
                'end_time' =>date('g:i:a',strtotime($t->end_time)),
            );
        }
        return $return;
    }
     public function getSearchProperty($search){
		$this->db->select('property_title,property_id');
		$this->db->like('property_id', $search, 'both');
		$this->db->or_like('property_title',$search, 'both');
		$query =  $this->db->get('property')->result();
		$row = array();
		foreach ($query as $r) {
			$row['value']=htmlentities(stripslashes($r->property_title));
			$row['id']=(int)$r->property_id;
			$row_set[] = $row;//build an array
		}
		
        return $row_set;
    }
}

/* End of file Area_models.php */
/* amenites: ./application/models/Area_models.php */