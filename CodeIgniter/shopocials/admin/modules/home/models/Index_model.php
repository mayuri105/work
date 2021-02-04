<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_model extends CI_Model {

	
	public function orderdata(){
		
		
		if($this->session->startdate){
			$this->db->where('created_on >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		
		$this->db->where('order_status >=',1);
		$total_order = $this->db->get('orders')->result();
		return count($total_order);
		
	}
	function getorders(){
		if($this->session->startdate){
			$this->db->where('orders.created_on >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		$this->db->where('order_status >=',1);
		$this->db->order_by('o_id', 'desc');
		$this->db->limit('10');
		$this->db->join('customer', 'customer.c_id = orders.customer_id', 'left');
		$this->db->join('order_status', 'order_status.order_status_id = orders.order_status', 'left');
		$ret = $this->db->get('orders')->result();
		return $ret;
		
	}

	public function totalAmount(){
		if($this->session->startdate){
			$this->db->where('created_on >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		$this->db->where('order_status >=',1);
		$this->db->select('sum(total) as total', FALSE);
		$this->db->join('order_store', 'order_store.o_id = orders.o_id', 'left');
		$query = $this->db->get('orders')->row();
		return $query;
	}
	public function totalcommison(){

		if($this->session->startdate){
			$this->db->where('orders.created_on >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		$this->db->where('order_status >=',1);
		$this->db->select('(total * store_commission)/100 as com', FALSE);
		
		$this->db->join('order_store', 'order_store.o_id = orders.o_id', 'left');
		$this->db->join('store', 'store.store_id = order_store.store_id', 'left');
		$query = $this->db->get('orders')->result();
		$total =0;
		foreach ($query as $key ) {
			$total =$total + $key->com;
		}
		
		return $total;
	}

	public function totalcustomer(){
		if($this->session->startdate){
			$this->db->where('created_on >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		$total_cust = $this->db->get('customer')->result();
		return count($total_cust);
	}
	public function totalProducts(){
		$total = $this->db->get('products')->result();
		return count($total);
	}
	public function totalMerchant(){
		$this->db->where('is_pverified',1);
		$total = $this->db->get('merchant')->result();
		return count($total);
	}
	public function totalStore(){
		$this->db->where('status','1');
		$total = $this->db->get('store')->result();
		return count($total);
	}

	
	public function getorderdata(){
		if($this->session->startdate){
			$this->db->where('created_on >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		$this->db->select('created_on,sum(total_amt) as tmt, count(o_id) as cd', FALSE);
		$this->db->group_by('created_on');
		$where = "created_on > DATE_SUB( NOW( ) , INTERVAL 10 DAY )";
		$this->db->where($where);
		$this->db->where('order_status >=',1);
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
	public function getuserActivity(){
		if($this->session->startdate){
			$this->db->where('date_added >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		$this->db->order_by('activity_id', 'desc');
		$this->db->limit('10');
		$this->db->join('user', 'user.u_id = user_activity.user_id', 'left');
		$ret = $this->db->get('user_activity')->result();
		return $ret;
	}

	public function totalAdRevenue(){
		if($this->session->startdate){
			$this->db->where('added_date >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}	
		$this->db->select('sum(package_price) as profit');
		$this->db->where('payment_done', '1', FALSE);
		$ret = $this->db->get('ads_order')->row();
		return $ret->profit ;
	}

	public function totalcouponAmount(){
		if($this->session->startdate){
			$this->db->where('added_date >=' ,date('Y-m-d',strtotime($this->session->startdate)));
		}
		$this->db->join('orders', 'orders.o_id = coupons_histroy.order_id', 'left');
		$result  = $this->db->get('coupons_histroy')->result();
		$totaldiscount = 0;
		foreach ($result as $res){
			if ($res->type=='F') {
				$totaldiscount = $totaldiscount + $res->discount;
			}else{
				$total =$res->total_amt ;
				$dis = $res->discount * $total /100;
				$totaldiscount = $totaldiscount + $dis;
			}
		}
		return $totaldiscount;
	}
}

/* End of file Index_model.php */
/* Location: ./application/models/Index_model.php */