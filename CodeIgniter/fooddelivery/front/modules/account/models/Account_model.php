<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model {

	
	/**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'customer';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'c_id';
    
    public function record_count() {
        return $this->db->count_all(self::TABLE_NAME);
    }

    public function fetch_data($limit, $start) {
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

   public function fetch_data_bysearch() {
        $this->db->like('first_name',post('search'), 'both');
        $this->db->or_like('username',post('search'), 'both');
        $this->db->or_like('last_name',post('search'), 'both');
        $this->db->or_like('email',post('search'), 'both');
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
        if ($this->db->insert('address', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    public function insertCard(Array $data) {
        if ($this->db->insert('customer_card_details', $data)) {
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

    public function updateAddress(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('address_id' => $where);
            }
        $this->db->update('address', $data, $where);
        return $this->db->affected_rows();
    }
    public function updateCard(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('cc_id' => $where);
            }
        $this->db->update('customer_card_details', $data, $where);
        return $this->db->affected_rows();
    }
    public function delete($id) {
        $this->db->where(self::PRI_INDEX,$id);
        $this->db->delete(self::TABLE_NAME);
        return $this->db->affected_rows();
    }

    public function getaddress($id){
        $this->db->where('address_id',$id);
         return $this->db->get('address')->row();
       
    }
    public function getearnPoints() {
        $customer_id = $this->session->userdata('c_id');
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->get('customer_reward')->row();
        return $query;
    }
    public function getcard($id){
         $this->db->where('cc_id',$id);
         return $this->db->get('customer_card_details')->row();
       
    }
    public function deleteaddress($id){
        $this->db->where('address_id',$id);
        $this->db->delete('address');
        return $this->db->affected_rows();
    }
     public function deletecard($id){
        $this->db->where('cc_id',$id);
        $this->db->delete('customer_card_details');
        return $this->db->affected_rows();
    }
    public function getcustomerbyid($id){
        $query = new stdClass();
        $this->db->where(self::PRI_INDEX, $id);
        $query->customer_detail = $this->db->get(self::TABLE_NAME)->row();
        $this->db->where('customer_id', $id);
        $query->customer_address = $this->db->get('address')->result();
        $this->db->where('customer_id', $id);
        $query->customer_card_details = $this->db->get('customer_card_details')->result();
        if(!$query) 
            show_404();
        return $query;
        
    }

    public function getorderdetail(){
        $customer_id = $this->session->userdata('c_id');
        $this->db->group_by('order_store.store_name,orders.o_id');
        $this->db->select('orders.*,products.store_id,store.store_name,GROUP_CONCAT(products.price *  order_item.pro_quantity) as pricetotal ,GROUP_CONCAT(products.product_name) as productname,wallet_history.*,order_store.tip_in_currancy,order_store.*');
        $this->db->where('orders.customer_id', $customer_id);
        $this->db->join('order_item', 'order_item.o_id = orders.o_id');
        $this->db->join('products', 'products.product_id = order_item.product_id');
        $this->db->join('store', 'store.store_id = products.store_id');
        $this->db->join('wallet_history', 'wallet_history.order_id = orders.o_id', 'left');
        $this->db->join('order_store', 'order_store.o_id = orders.o_id', 'left');
        $this->db->where('order_status >','0');
        $this->db->order_by('orders.o_id', 'desc');

        $ret = $this->db->get('orders')->result();
        
        return $ret;
    }
    
    public function orderrating(){
        $this->db->where('sto_id',post('storeid'));
        $this->db->where('order_id',post('id'));

        $result = $this->db->get('order_rating')->row();

        if($result){
            $data = array(
            'rating_star'=>post('score')
            );
            $this->db->where('st_id', $result->st_id);
            $ret = $this->db->update('order_rating', $data);
            return $ret;
        }else{
            $data = array(
            'rating_star'=>post('score'),
            'sto_id'=>post('storeid'),
            'order_id'=>post('id'),
            
            );
            $ret = $this->db->insert('order_rating', $data);
            return $ret;
        }
    }

    public function orderSetFav(){
        
        $this->db->where('order_id',post('id'));

        $result = $this->db->get('order_rating')->row();

        if($result){
            
            $data = array(
            'setasfav'=>post('setasfav')
            );
            $this->db->where('st_id', $result->st_id);
            $ret = $this->db->update('order_rating', $data);
            
            return $ret;

        }else{
            $data = array(
            'setasfav'=>post('setasfav'),
            'sto_id'=>post('storeid'),
            'order_id'=>post('id'),
            
            );
            $ret = $this->db->insert('order_rating', $data);
            return $ret;
        }
    }

    public function getrating($o_id){
        $this->db->where('order_id',$o_id);
        $result = $this->db->get('order_rating')->row();

        if($result){
            return $result;
        }else{
            return 0;
        }
    }
    public function getTotalEarnpoints(){
        $c_id = $this->session->userdata('c_id');
        $this->db->where('customer_id',$c_id);
        $result = $this->db->get('customer_reward')->result();
        $totalPoint = 0;
        foreach ($result  as $r) {
            $totalPoint += $r->points;
        }
        return $totalPoint;
    }

    public function getbucketBypoint(){

        //$this->db->where('points_reward',$points);
        $result = $this->db->get('reward_bucket')->result();
        return $result;
    }
    public function redeem(){
        $bucketid = post('bucketid');
        $this->db->where('rb_id',$bucketid);
        $result = $this->db->get('reward_bucket');
        $data = $result->row();

        $customer_id = $this->session->userdata('c_id');
        $dataRedeemHistory = array(
            'reward_bucket_id'=>$data->rb_id,
            'customer_id'=>$customer_id,
            'earn_credit'=>$data->credits,
            'points'=>$data->points_reward,
            'date_added'=>date('Y-m-d')

        );
        $ret = $this->db->insert('reedem_history', $dataRedeemHistory);


        $last_point = $this->db->get_where('customer_reward',array('customer_id'=>$customer_id))->row();

        $pointToupdate = $last_point->points - $data->points_reward;
        $pointsUpd = array(
            'points'=>$pointToupdate,
        );
        $this->db->update('customer_reward', $pointsUpd, array('customer_id'=>$customer_id));
        
        $wallet = $this->db->get_where('wallet',array('customer_id'=>$customer_id))->row();
        if ($wallet) {
            $totalCredit = $wallet->credit+$data->credits;
            $datawallet = array(
                'customer_id'=>$customer_id,
                'credit'=> $totalCredit,
                'date_added'=>date('Y-m-d')
               
            );
            $this->db->update('wallet', $datawallet, array('customer_id'=>$customer_id));
            
        }else{
           $datawallet = array(
                'customer_id'=>$customer_id,
                'credit'=>$data->credits,
                'date_added'=>date('Y-m-d')
            ); 
            $this->db->insert('wallet', $datawallet);

        }
        
        return $ret;


    }
    public function getWallet()
    {
        $customer_id= $this->session->userdata('c_id');
        $wallet = $this->db->get_where('wallet',array('customer_id'=>$customer_id))->row();
        return $wallet;
    }

    public function getredeemHistory()
    {
        $customer_id= $this->session->userdata('c_id');
        $this->db->select('sum(points) as p', FALSE);
        $history = $this->db->get_where('reedem_history',array('customer_id'=>$customer_id))->row();
        return $history;
    }
}

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */