<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		
	}
	public function getStores(){
		$mid = $this->session->m_id;
		$this->db->where('status','1');
		$this->db->where('store.merchant_id',$mid);
		$store = $this->db->get('store')->result();
		return $store;
	}
	public function getStoreType(){
		$store_type = $this->db->get('merchant_type')->result();
		return $store_type;
	}
	public function getOrderStatus(){
		$order_status = $this->db->get('order_status')->result();
		return $order_status;
	}
	
	public function getMerchant(){
		$this->db->where('is_pverified','1');
		$merchant = $this->db->get('merchant')->result();
		return $merchant;
	}
	public function getSectorWiseSale(){
		$mid = $this->session->m_id;
		$start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

		if ($start_date) {
			$this->db->where('date_added >=',date('Y-m-d',strtotime($start_date)));
		}
		if ($end_date) {
			$this->db->where('date_added <=',date('Y-m-d',strtotime($end_date)));
		}
		$this->db->group_by('store.store_type');

		$this->db->select('merchant_type.type,sum(total) as tot,date_added');
		$this->db->where('store.merchant_id',$mid);

		$this->db->join('store', 'store.store_id = order_store.store_id', 'left');
		$this->db->join('merchant_type', 'merchant_type.mt_id = store.store_type', 'left');
		$this->db->where('order_store.order_status_id >=', '1', FALSE);
		$sale = $this->db->get('order_store')->result();
		
		return $sale;
	}	

	public function getOrders(){
		$mid = $this->session->m_id;
		$start_date = $this->input->get('date_start');
        $end_date = $this->input->get('date_end');
        $group = $this->input->get('group');
        $order_status_id = $this->input->get('order_status_id');
		$sector_id = $this->input->get('sector');
        $store_name = $this->input->get('store');

        $tip = $this->input->get('tip');
        $commission = $this->input->get('commission');

        if ($tip) {
        	$this->db->select('
        	sum(total- (order_store.total * store.store_commission)/100)  as total,
        	MIN(date_added) AS date_start, 
        	MAX(date_added) AS date_end,
        	sum(tip_in_currancy) as tip_in_currancy, 
        	COUNT(*) AS `orders`');
        }
        if ($commission) {
        	$this->db->select('
        	sum(total -tip_in_currancy)  as total,
        	MIN(date_added) AS date_start, 
        	MAX(date_added) AS date_end,
        	sum(tip_in_currancy) as tip_in_currancy, 
        	COUNT(*) AS `orders`');
        }

        if (!$tip && !$commission) {
        	$this->db->select('sum(total - (order_store.total * store.store_commission)/100 -tip_in_currancy)  as total,
        	MIN(date_added) AS date_start, 
        	MAX(date_added) AS date_end,
        	sum(tip_in_currancy) as tip_in_currancy, 
        	COUNT(*) AS `orders`');
        }
		if ($start_date) {
			$this->db->where('date_added >=',date('Y-m-d',strtotime($start_date)));
		}
		if ($end_date) {
			$this->db->where('date_added <=',date('Y-m-d',strtotime($end_date)));
		}

		if ($order_status_id) {
			$this->db->where('order_status_id',$order_status_id);
		}

		if($sector_id){
			$this->db->where('store_type',$sector_id);
		}
		if($store_name){
			$this->db->where('store.store_id',$store_name);
		}
		if ($group) {
        	$checkGroup = $group;
        } else {
            $checkGroup = 'week';
        }
		switch ($checkGroup) {
            case 'day';
                $this->db->group_by('YEAR(date_added), MONTH(date_added),DAY(date_added)');
                break;
            default:
            case 'week':
            	$this->db->group_by('YEAR(date_added), WEEK(date_added)');
               	break;
            case 'month':
                $this->db->group_by('YEAR(date_added),MONTH(date_added)');
                break;
            case 'year':
            	$this->db->group_by('YEAR(date_added)');
                break;
        }
        $this->db->where('store.merchant_id',$mid);
		$this->db->join('store', 'store.store_id = order_store.store_id', 'left');
        $this->db->where('order_store.order_status_id >=', '1');
		$order = $this->db->get('order_store')->result();
		return $order;
		
	}

	
	public function getTotalProductsPurchased(){
		$mid = $this->session->m_id;
		$start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $sector_id = $this->input->get('sector');
        $store_name = $this->input->get('store_name');
        $order_status_id = $this->input->get('order_status_id');	
		if ($start_date) {
			$this->db->where('date_added >=',date('Y-m-d',strtotime($start_date)));
		}
		if ($end_date) {
			$this->db->where('date_added <=',date('Y-m-d',strtotime($end_date)));
		}
		if ($order_status_id) {
			$this->db->where('order_status_id',$order_status_id);
		}
		if($sector_id){
			$this->db->where('store_type',$sector_id);
		}
		if($store_name){
			$this->db->where('store.store_id',$store_name);
		}
		$this->db->group_by('product_name');

		$this->db->select('product_name,order_store.store_name,sum(pro_quantity) as qty,sum(product_price * pro_quantity) as total');
		$this->db->join('store', 'store.store_id = order_store.store_id', 'left');
		$this->db->join('order_item', 'order_item.s_id = order_store.so_id', 'left');
		$this->db->where('store.merchant_id',$mid);

		$this->db->where('order_store.order_status_id >=', '1', FALSE);
		$products = $this->db->get('order_store')->result();
		return count($products);
	}
	public function getProductsPurchased($limit, $start){
		$mid = $this->session->m_id;
		$start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $sector_id = $this->input->get('sector');
        $store_name = $this->input->get('store_name');
        $order_status_id = $this->input->get('order_status_id');	
		if ($start_date) {
			$this->db->where('date_added >=',date('Y-m-d',strtotime($start_date)));
		}
		if ($end_date) {
			$this->db->where('date_added <=',date('Y-m-d',strtotime($end_date)));
		}
		if ($order_status_id) {
			$this->db->where('order_status_id',$order_status_id);
		}
		if($sector_id){
			$this->db->where('store_type',$sector_id);
		}
		if($store_name){
			$this->db->where('store.store_id',$store_name);
		}
		$this->db->limit($limit, $start);
		$this->db->group_by('product_name');
		$this->db->where('store.merchant_id',$mid);

		$this->db->select('product_name,order_store.store_name,sum(pro_quantity) as qty,sum(product_price * pro_quantity) as total');
		$this->db->join('store', 'store.store_id = order_store.store_id', 'left');
		$this->db->join('order_item', 'order_item.s_id = order_store.so_id', 'left');
		$this->db->where('order_store.order_status_id >=', '1', FALSE);
		$products = $this->db->get('order_store')->result();
		
		return $products;
	}

	

	public function getCommission(){
		$mid = $this->session->m_id;
		$start_date = $this->input->get('date_start');
        $end_date = $this->input->get('date_end');
        $group = $this->input->get('group');
        $merchant = $this->input->get('merchant');
        $this->db->select('store.store_id,sum(total) as total,
        	sum((total * store.store_commission)/100) as com, 
        	MIN(date_added) AS date_start,
        	MAX(date_added) AS date_end,
        	COUNT(*) AS `totalcommison`');
			
		if ($start_date) {
			$this->db->where('date_added >=',date('Y-m-d',strtotime($start_date)));
		}
		if ($end_date) {
			$this->db->where('date_added <=',date('Y-m-d',strtotime($end_date)));
		}


		if ($group) {
        	$checkGroup = $group;
        } else {
            $checkGroup = 'week';
        }
		switch ($checkGroup) {
            case 'day';
                $this->db->group_by('YEAR(date_added), MONTH(date_added),DAY(date_added)');
                break;
            default:
            case 'week':
            	$this->db->group_by('YEAR(date_added), WEEK(date_added)');
               	break;
            case 'month':
                $this->db->group_by('YEAR(date_added),MONTH(date_added)');
                break;
            case 'year':
            	$this->db->group_by('YEAR(date_added)');
                break;
        }
        $this->db->where('store.merchant_id',$mid);

		$this->db->join('store', 'store.store_id = order_store.store_id', 'left');
        $this->db->where('order_store.order_status_id >=', '1');
		$order = $this->db->get('order_store')->result();
		
		return $order;
	}

	
	public function gettip(){
		$mid = $this->session->m_id;
		$start_date = $this->input->get('date_start');
        $end_date = $this->input->get('date_end');
        $group = $this->input->get('group');
        $this->db->select('MIN(date_added) AS date_start, MAX(date_added) AS date_end, sum(tip_in_currancy) as totaltip');
		
		if ($group) {
        	$checkGroup = $group;
        } else {
            $checkGroup = 'week';
        }
		switch ($checkGroup) {
            case 'day';
                $this->db->group_by('YEAR(date_added), MONTH(date_added),DAY(date_added)');
                break;
            default:
            case 'week':
            	$this->db->group_by('YEAR(date_added), WEEK(date_added)');
               	break;
            case 'month':
                $this->db->group_by('YEAR(date_added),MONTH(date_added)');
                break;
            case 'year':
            	$this->db->group_by('YEAR(date_added)');
                break;
        }
        $this->db->where('store.merchant_id',$mid);
		$this->db->join('store', 'store.store_id = order_store.store_id', 'left');
        $this->db->where('order_store.order_status_id >=', '1');
		$tip = $this->db->get('order_store')->result();
		return $tip;
	}
	
}

/* End of file Reports_model.php */
/* Location: ./application/models/Reports_model.php */