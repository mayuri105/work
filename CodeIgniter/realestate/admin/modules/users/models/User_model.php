<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'user';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'u_id';

    public function record_count() {

         $name = $this->input->get('name');
        
        if ($name) {
            $this->db->like('first_name', $name);
            
        }
        $this->db->order_by(self::PRI_INDEX,'desc');
        $this->db->join('user_group', 'user_group.group_id = user.user_group_id', 'left');
        $query = $this->db->get(self::TABLE_NAME)->result();
        return count($query);
    }

    public function fetch_data($limit, $start) {
        $name = $this->input->get('name');
        $email = $this->input->get('email');
        
        if ($name) {
            $this->db->like('first_name', $name);
            
        }
        if ($email) {
            $this->db->like('email', $email);
            
        }
        $this->db->limit($limit, $start);
        $this->db->order_by(self::PRI_INDEX,'desc');
        $this->db->join('user_group', 'user_group.group_id = user.user_group_id', 'left');
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
        $this->db->where('u_id',$id);
        $this->db->delete(self::TABLE_NAME);
        return $this->db->affected_rows();
    }

    public function getusers($params = array()){
        $this->db->select('*');
        $this->db->from(self::TABLE_NAME);
        $this->db->order_by(self::PRI_INDEX,'desc');
        
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $query = $this->db->get();
        
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

    public function getuserbyid($id){
        $this->db->where(self::PRI_INDEX, $id);
        $query = $this->db->get(self::TABLE_NAME)->row();
        return $query;
        
    }

    public function getusergroup(){
        $query = $this->db->get('user_group')->result();
        return $query;
    }
    public function getuserActivity($id){
        $this->db->order_by('activity_id', 'desc');
        $this->db->where('user_id', $id);
        $this->db->join('user', 'user.u_id = user_activity.user_id', 'left');
        $query = $this->db->get('user_activity',10)->result();
        return $query;
    }

    public function setAprvdisapprove($id){
        $result = $this->getuserbyid($id);
        $data = array(
            'status'=>$result->status ? '0' : '1'
        );
        $where = array('u_id'=>$id);
        $ret = $this->db->update(self::TABLE_NAME, $data, $where);
        return $ret;
    }
}
