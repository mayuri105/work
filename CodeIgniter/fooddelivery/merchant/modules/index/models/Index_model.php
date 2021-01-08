<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_model extends CI_Model {

	
	public function orderdata(){
	
		if($this->session->startdate){
			$this->db->where('orders.created_on >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		$mid = $this->session->userdata('m_id');
		$this->db->join('order_store', 'order_store.o_id = orders.o_id');
		$this->db->join('store', 'store.store_id = order_store.store_id');
       
        $this->db->where('merchant_id',$mid);
		$this->db->where('order_status >=',1);
		$total_order = $this->db->get('orders')->result();
		return count($total_order);
		
	}
	function getorders(){
		if($this->session->startdate){
			$this->db->where('orders.created_on >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		$this->db->where('order_status >=',1);
		$this->db->order_by('orders.o_id', 'desc');
		$this->db->limit('10');
		$this->db->join('customer', 'customer.c_id = orders.customer_id', 'left');
		$this->db->join('order_status', 'order_status.order_status_id = orders.order_status', 'left');
		$mid = $this->session->userdata('m_id');
		$this->db->join('order_store', 'order_store.o_id = orders.o_id');
		$this->db->join('store', 'store.store_id = order_store.store_id');
       
        $this->db->where('merchant_id',$mid);

		$ret = $this->db->get('orders')->result();
		return $ret;
		
	}

	public function totalAmount(){
		if($this->session->startdate){
			$this->db->where('created_on >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		$mid = $this->session->userdata('m_id');
		$this->db->where('order_status_id >=',1);
		$this->db->where('merchant_id',$mid);
		$this->db->select('sum(total) as total', FALSE);
		$this->db->join('store', 'store.store_id = order_store.store_id');

		$query = $this->db->get('order_store')->row();
		return $query;
	}

	public function totalcustomer(){
		if($this->session->startdate){
			$this->db->where('created_on >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		$total_cust = $this->db->get('customer')->result();
		return count($total_cust);
	}

	
	public function totalStore(){
		$mid = $this->session->userdata('m_id');
		$this->db->where('merchant_id',$mid);
		$this->db->where('status','1');
		$total = $this->db->get('store')->result();
		return count($total);
	}

	
	public function getorderdata(){
		if($this->session->startdate){
			$this->db->where('orders.created_on >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		$this->db->select('orders.created_on,sum(order_store.total) as tmt, count(orders.o_id) as cd', FALSE);
		$this->db->group_by('orders.created_on');
		$this->db->where('orders.order_status >=',1);
		$where = "orders.created_on > DATE_SUB( NOW() , INTERVAL 10 DAY )";
		$this->db->where($where);
		
		$mid = $this->session->userdata('m_id');
		$this->db->join('order_store', 'order_store.o_id = orders.o_id');
		$this->db->join('store', 'store.store_id = order_store.store_id');
       
        $this->db->where('merchant_id',$mid);
		$ret = $this->db->get('orders')->result();
		
		return $ret;
	}
	public function getCustomerData(){
		if($this->session->startdate){
			$this->db->where('created_on >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		$this->db->select('created_on,count(c_id) as cd');
		$this->db->group_by('created_on');
		$where = "created_on > DATE_SUB( NOW( ) , INTERVAL 10 DAY )";
		$this->db->where($where);
		$ret = $this->db->get('customer')->result();
		
		return $ret;
	}
	public function getordersByMer($mer_id){
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
	public function getmerchant($id){
    	$merchant = new stdClass();
    	$this->db->where('m_id', $id);
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

    public function getcityOfstate($state){
    	
    	$this->db->where('state', $state);
    	$ret =$this->db->get('city')->result();
    	return $ret;

    }
     // update process start here 
    public function merchantupdate(){
    	$this->load->library('encrypt');
    	$id = $this->session->userdata('m_id');
    	$password = $this->encrypt->encode(post('password'));	
		$data =  array(
			'username' 				=>trim(post('username')),
			'password' 				=>$password,
			'business_name'			=>trim(post('business_name')),
			'physical_street'		=>trim(post('physical_street')),
			'physical_city'			=>trim(post('physical_city')),
			'physical_state'		=>trim(post('physical_state')),
			'physical_zip_code'		=>trim(post('physical_zipcode')),
			'same_as_physical'		=>trim(post('same_as_physical')),
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
		);
		$this->db->where('m_id', $id);
		$this->db->update('merchant',$data);
		$this->merchant_contact_update($id);
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


}

/* End of file Index_model.php */
/* Location: ./application/models/Index_model.php */