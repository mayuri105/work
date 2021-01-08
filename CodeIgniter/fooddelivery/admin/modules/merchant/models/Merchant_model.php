<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merchant_model extends CI_Model {

	
	const TABLE_NAME = 'merchant';
	const PRI_INDEX = 'm_id';


	public function __construct()
	{
		parent::__construct();
		$this->load->library('encrypt');
	}
	public function record_count(){
        $merchant = $this->input->get('merchant');
        $email = $this->input->get('email');
        $phone = $this->input->get('phone');
        $approved = $this->input->get('approved');
        $date_added = $this->input->get('date_added');
        $city = $this->input->get('city');
        
        if($merchant){
            $this->db->like('business_name',$merchant);
           
        }
        if($email){
            $this->db->like('username',$email);
           
        }
        if($phone){
            $this->db->like('phone',$phone);
           
        }
       
        if($approved){
             if ($approved ==2) {
               
                 $this->db->where('is_pverified','0');
            }else{
                 $this->db->where('is_pverified',trim($approved));
            }
        }
        if($date_added){
            $this->db->like('created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
        if($city){
            $this->db->like('physical_city',$city);
           
        }

        $this->db->order_by(self::PRI_INDEX,'desc');
        $query = $this->db->get(self::TABLE_NAME)->result();
        return count($query);
    }
    public function fetch_data($limit, $start) {

    	$merchant = $this->input->get('merchant');
        $email = $this->input->get('email');
        $phone = $this->input->get('phone');
        $approved = $this->input->get('approved');
        $date_added = $this->input->get('date_added');
        $city = $this->input->get('city');
        
        if($merchant){
            $this->db->like('business_name',$merchant);
        }
        if($email){
            $this->db->like('username',$email);
           
        }
        if($phone){
            $this->db->like('phone',$phone);
           
        }
       
        if($approved){
             if ($approved ==2) {
               
                 $this->db->where('is_pverified','0');
            }else{
                 $this->db->where('is_pverified',trim($approved));
            }
        }
        if($date_added){
            $this->db->like('created_on',date('Y-m-d',strtotime($this->input->get('date_added'))));
            
        }
        if($city){
            $this->db->like('physical_city',$city);
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



   public function fetch_data_bysearch(){
        $this->db->like('business_name',post('search'), 'both');
        $this->db->or_like('physical_street',post('search'), 'both');
        $this->db->or_like('physical_city',post('search'), 'both');
        $this->db->or_like('corporate_name',post('search'), 'both');
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
	public function insert(){
		$password = $this->encrypt->encode(post('password'));
		$data =  array(
			'username' 				=>trim(post('username')),
			'password' 				=>$password,
			'business_name'			=>trim(post('business_name')),
			'physical_street'		=>trim(post('physical_street')),
			'physical_city'			=>trim(post('physical_city')),
			'physical_state'		=>trim(post('physical_state')),
			'physical_zip_code'		=>trim(post('physical_zipcode')),
			'same_as_physical'		=>trim(post('billingaddresscheck')),
			'billing_street'		=>trim(post('billing_street')),
			'billing_city'			=>trim(post('billing_street')),
			'billing_state'			=>trim(post('billing_state')),
			'billing_zip_code'		=>trim(post('billing_zip_code')),
			'phone'					=>preg_replace('/\D/','',post('phone')),
			'fax'					=>preg_replace('/\D/','',post('fax')),
			'merchant_des'			=>trim(post('merchant_des')),
			'federal_tax_id'		=>trim(post('federaltaxid')),
			'is_pverified'=>0,
			'created_on'			=>date('Y-m-d H:i:s'),
		);

		$this->db->insert('merchant',$data);
		$id = $this->db->insert_id();
		return $id;		

	}


	protected function merchant_contact($id){
		
		$number = count($this->input->post('first_name_1'));

		for ($i=0; $i<$number; $i++)
    	{
		    $data =  array(
				'm_id'		=>$id,
				'first_name'=>$this->input->post('first_name_1')[$i],
				'last_name'	=>$this->input->post('last_name_1')[$i],
				'mobile'	=>$this->input->post('mobile_1')[$i],
				'email'		=>$this->input->post('email_1')[$i],
				'is_owner'	=>$this->input->post('owner')[$i],
				'is_manager'=>$this->input->post('manger')[$i],
			);
			$ret = $this->db->insert('merchant_contact',$data);
			//echo $this->db->last_query();
		}
		
		return $ret;
		
	}
    public function delete($id) {
        $this->db->where(self::PRI_INDEX,$id);
        $this->db->delete(self::TABLE_NAME);
        $this->db->where('merchant_id', $id);
        $this->db->delete('store');
        return $this->db->affected_rows();
    }

    public function getmerchant($id){
    	$merchant = new stdClass();
    	$this->db->where(self::PRI_INDEX, $id);
    	$this->db->join('merchant_wallet', 'merchant_wallet.merchant_id = merchant.m_id', 'left');
    	$merchant->merchantinfo = $this->db->get('merchant')->row();
		$this->db->where('m_id', $id);
		$merchant->merchant_contact = $this->db->get('merchant_contact')->result();


		$this->db->where('merchant_id', $id);
		$merchant->merchant_transaction = $this->db->get('merchant_wallet_history')->result();

		if(!$merchant) 
			show_404();
		
		return $merchant;
    }

    // update process start here 
    public function merchantupdate(){
    	$id = post('m_id');
    	$password = $this->encrypt->encode(post('password'));	
		$data =  array(
			'username' 				=>trim(post('username')),
			'password' 				=>$password,
			'business_name'			=>trim(post('business_name')),
			'physical_street'		=>trim(post('physical_street')),
			'physical_city'			=>trim(post('physical_city')),
			'physical_state'		=>trim(post('physical_state')),
			'physical_zip_code'		=>trim(post('physical_zipcode')),
			'same_as_physical'		=>trim(post('billingaddresscheck')),
			'billing_street'		=>trim(post('billing_street')),
			'billing_city'			=>trim(post('billing_city')),
			'billing_state'			=>trim(post('billing_state')),
			'billing_zip_code'		=>trim(post('billing_zip_code')),
			'phone'					=>preg_replace('/\D/', '',post('phone')),
			'fax'					=>preg_replace('/\D/', '',post('fax')),
			'merchant_des'			=>trim(post('merchant_des')),
			'federal_tax_id'		=>trim(post('federaltaxid')),
			'payment_frequency'		=>post('frequency'),
			'payment_mode'			=>post('payment_mode'),
			'wire_details'=>trim(post('ecswire_details')),
			'is_pverified'=>post('is_pverified')
		);
		$this->db->where('m_id', $id);
		$this->db->update('merchant',$data);
		$this->merchant_contact_update($id);
		$veri = post('is_pverified');
		if($veri == 0){
			$data = array(
				'status' =>'0'
			);
			$this->db->where('merchant_id', $id );
			$this->db->update('store', $data);
		}

		return $id;		
    }
	protected function merchant_contact_update($mid){
    	$this->db->where('m_id',$mid);
        $this->db->delete('merchant_contact');
        $rets = $this->db->affected_rows();

		$cfirstname = count($this->input->post('first_name'));

		for($i=0; $i<$cfirstname; $i++)
    	{ 
    		$data =  array(
		    	'm_id'=>$mid,
				'first_name'=>$this->input->post('first_name')[$i],
				'last_name'	=>$this->input->post('last_name')[$i],
				'mobile'	=>$this->input->post('mobile')[$i],
				'email'		=>$this->input->post('email')[$i],
				'is_owner'	=>$this->input->post('owner')[$i],
				'is_manager'=>$this->input->post('manger')[$i],
			);
			$ret = $this->db->insert('merchant_contact',$data);
		}
		return $ret;	
	}
	// update process end here 

	public function getordersByMer($mer_id){
		$this->db->select('store.store_name,order_store.date_added,order_store.total,name,comment,so_id,o_id', FALSE);
		$this->db->where('merchant.m_id',$mer_id);
		$this->db->join('store', 'store.merchant_id = merchant.m_id', 'left');	
       	$this->db->join('order_store', 'order_store.store_id = store.store_id', 'left');
        $this->db->join('order_status', 'order_status.order_status_id = order_store.order_status_id', 'left');
        $this->db->where('order_store.order_status_id >=', '1', FALSE);
        $ret = $this->db->get('merchant')->result();
        return $ret;

	}

	public function getstoresByMer($mer_id){
		$this->db->where('merchant_id',$mer_id );
        $ret = $this->db->get('store')->result();
        return $ret;
	}

	public function addtransaction(){
		$data  = array(
			'merchant_id'=>post('merchant_id'),
			'description'=>post('description'),
			'transaction_type'=>post('transaction_type'),
			'amount'=>post('amount'),
			'added_date'=>date('Y-m-d')
		);
		$ret = $this->db->insert('merchant_wallet_history', $data);

		$merchant_id = post('merchant_id');
		$this->db->where('merchant_id',$merchant_id);
		$getmerchant = $this->db->get('merchant_wallet')->row();
		if($getmerchant->merchant_id){
			if($rest->transaction_type=='credit'){
				 $dataUp = array(
					'merchant_balance'=>$getmerchant->merchant_balance + post('amount')
				);
			 }else{
				 $dataUp = array(
					'merchant_balance'=>$getmerchant->merchant_balance -post('amount')
				);
			 }

			 $where = array('merchant_id'=>$getmerchant->merchant_id);
			 $this->db->update('merchant_wallet', $dataUp, $where);
		   
	   }else{
			if($rest->transaction_type=='credit'){
				 $dataUp = array(
					'merchant_id'=>$merchant_id,
					'merchant_balance'=> post('amount')
				);
			 }else{
				 $dataUp = array(
					'merchant_id'=>$merchant_id,
					'merchant_balance'=> - $rest->amount
				);
			 }
			 $this->db->insert('merchant_wallet', $dataUp);
	   	}

	return $ret;
	}
}

/* End of file Merchant_model.php */
/* Location: ./application/models/Merchant_model.php */