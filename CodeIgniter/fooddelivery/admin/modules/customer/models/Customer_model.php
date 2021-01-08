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
           $this->db->group_start();

            $this->db->like('first_name',trim($customer));
            $this->db->or_like('last_name',trim($customer));
            $this->db->group_end();
        }
        if($email){
            $this->db->like('email',trim($email));
           
        }
        if($phone){
            $this->db->like('phone',trim($phone));
           
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
            $this->db->group_start();

            $this->db->like('first_name',trim($customer));
            $this->db->or_like('last_name',trim($customer));
            $this->db->group_end();
        }
        if($email){
            $this->db->like('email',trim($email));
           
        }
        if($phone){
            $this->db->like('phone',trim($phone));
           
        }
        
        if($enable){
            if ($enable ==2) {
                 $this->db->where('enabled','0');
            }else{
                 $this->db->where('enabled',trim($enable));
            }
           
        }
        if($date_added){
            $this->db->where('created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
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
    public function insertAddress(Array $data) {
        if ($this->db->insert_batch('address', $data)) {
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
       
        $this->db->where('customer_id', $id);
        $query->customer_address = $this->db->get('address')->result();

        if(!$query) 
            show_404();
        return $query;
        
    }
    public function getorders($cus_id){
        
        $this->db->where('customer_id',$cus_id);
        $this->db->where('order_status >=', '1', FALSE);
        $this->db->join('order_status', 'order_status.order_status_id = orders.order_status', 'left');
        $ret = $this->db->get('orders')->result();
        return $ret;

    }
    public function pointsHistory($cus_id){
        $this->db->where('customer_id',$cus_id, FALSE);
        $ret = $this->db->get('reedem_history')->result();
        return $ret;
    }
    public function walletHistory($cus_id){
        $this->db->where('customer_id',$cus_id, FALSE);
        $ret = $this->db->get('wallet_history')->result();
        return $ret;
    }
    public function wallet($cus_id){
        $this->db->where('customer_id',$cus_id, FALSE);
        $ret = $this->db->get('wallet')->row();
        return $ret;
    }
    public function reward($cus_id){
        $this->db->where('customer_id',$cus_id, FALSE);
        $ret = $this->db->get('customer_reward')->row();
        return $ret;
    }
    
    public  function getCity($code){
        $state = $code;
        $this->db->where('state',$state);
        $ret = $this->db->get('city')->result();
        return $ret;
    }
    public function deleteAddress($id){
        $this->db->where('customer_id',$id);
        $this->db->delete('address');
        return $this->db->affected_rows();
    }

    public function insertAdd($addres,$c_id){
        if ($addres) {
        $dataAdd = array();
        foreach ($addres as $address) {
                $dataAdd[] = array(
                    'street_address'=>$address['street_address'],
                    'apt_name'=>$address['apt_name'],
                    'city'=>$address['city'],
                    'state'=>$address['state'],
                    'zip'=>$address['zip'],
                    'customer_id'=>$c_id,
                );  
                
            }
            $ret = $this->insertAddress($dataAdd);
        }
    }
}

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */