<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Appointment_models extends CI_Model {

	

	public function addAppointment(array $data) {

		if ($this->db->insert('appointment', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
		
	}
	public function getAppointmentDet($id){
        $this->db->where('appointment_id', $id);
        $this->db->join('time_slot', 'time_slot.ts_id = appointment.appointment_time', 'left');
        $ret = $this->db->get('appointment')->row();
        return $ret;
    }
    public function update(Array $data, $where = array()) {
        if (!is_array($where)) {
            $where = array('appointment_id' => $where);
        }
        $this->db->update('appointment', $data, $where);
        return $this->db->affected_rows();
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

    public function checkbidwinner($property_id){
        $c_id = $this->session->userdata('c_id');
        $this->db->order_by('amount', 'desc');
        $this->db->where('property_id', $property_id);
        $this->db->limit(5);

        $result = $this->db->get('bid')->result();
        foreach ($result as $r) {
            if($r->customer_id == $c_id){
                return true;
            }else{
                
            }
        }
        return false;
    }
    
}


