<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model {

	
	/**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'customer';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'c_id';
    
    public function record_count() {
        $customer = $this->input->get('customer');
        $email = $this->input->get('email');
        $phone = $this->input->get('phone');
        $enable = $this->input->get('enable');
        $date_added = $this->input->get('date_added');
        $ip = $this->input->get('ip');
        
        if($customer){
            $this->db->like('first_name',$customer);
            $this->db->or_like('last_name',$customer);
        }
        if($email){
            $this->db->like('email',$email);
           
        }
        if($phone){
            $this->db->like('phone',$phone);
           
        }
        if($enable){
            if ($enable ==2) {
                 $this->db->where('enabled','0');
            }else{
                 $this->db->where('enabled',trim($enable));
            }
           
        }
        if($date_added){
            $this->db->like('created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
        if($ip){
            $this->db->like('ip',$ip);
           
        }
       
        $this->db->order_by(self::PRI_INDEX,'desc');
        $query = $this->db->get(self::TABLE_NAME)->result();

        return count($query);
    }

    public function fetch_data($limit, $start) {
        $customer = $this->input->get('customer');
        $email = $this->input->get('email');
        $phone = $this->input->get('phone');
        $enable = $this->input->get('enable');
        $date_added = $this->input->get('date_added');
        $ip = $this->input->get('ip');
        
        if($customer){
            $this->db->like('first_name',$customer);
            $this->db->or_like('last_name',$customer);
        }
        if($email){
            $this->db->like('email',$email);
           
        }
        if($phone){
            $this->db->like('phone',$phone);
           
        }
        
        if($enable){
            if ($enable ==2) {
                 $this->db->where('enabled','0');
            }else{
                 $this->db->where('enabled',trim($enable));
            }
           
        }
        if($date_added){
            $this->db->like('created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
        if($ip){
            $this->db->like('ip',$ip);
           
        }
        $this->db->limit($limit, $start);
        $this->db->order_by(self::PRI_INDEX,'desc');
        $query = $this->db->get(self::TABLE_NAME);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        return false;
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
        $this->db->where(self::PRI_INDEX,$id);
        $this->db->delete(self::TABLE_NAME);
        return $this->db->affected_rows();
    }

    
    public function getcustomerbyid($id){
        $query = new stdClass();
        $this->db->where(self::PRI_INDEX, $id);
        $query->customer_detail = $this->db->get(self::TABLE_NAME)->row();
       
       
        if(!$query) 
            show_404();
        return $query;
        
    }
    public function getcustomerFollowedProp($id){
        $this->db->where('customer_id',$id);
        $this->db->join('property', 'property.property_id = customer_followed_pro.property_id', 'left');
        $query = $this->db->get('customer_followed_pro')->result();
        return $query;
    }

    public function getcustomerPackage($id){
        $this->db->where('customer_id',$id);
        $query = $this->db->get('customer_buy_package')->result();
        return $query;
    }
}

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */