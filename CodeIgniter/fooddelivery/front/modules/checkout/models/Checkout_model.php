<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Checkout_model extends CI_Model {

	public function update(Array $data, $where = array(), $tablename) {
		$this->db->update($tablename, $data, $where);
		return $this->db->affected_rows();
	}
	public function insert(Array $data, $tablename) {
		if ($this->db->insert($tablename, $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	public function getStoreDetailbyId($store_id) {
		$query = new stdClass();
		$this->db->where('store_id', $store_id);
		$query->store_data = $this->db->get('store')->row();
		if (!$query) {
			show_404();
		}

		return $query;
	}
	public function getcustomerdata() {
		$query = new stdClass();
		$c_id = $this->session->userdata('c_id');
		$this->db->where('c_id', $c_id);
		$query->customer_info = $this->db->get('customer')->row();
		$this->db->order_by('address_id', 'desc');
		$res = $this->db->get_where('address', array('customer_id' => $c_id));
		$query->customer_address = $res->row();
		$query->card_detail = $this->db->get_where('customer_card_details', array('customer_id' => $c_id))->row();
		return $query;
	}
	public function getPrductbyId($id) {
		$this->db->where('product_id', $id);
		$this->db->join('store', 'store.store_id = products.store_id', 'left');
		$query = $this->db->get('products')->row();

		return $query;
	}

	public function addressInsert() {
		$customer_id = $this->session->userdata('c_id');
		if (post('address_id')) {
			$address = array(
				'street_address' => post('street'),
				'apt_name' => post('apt_name'),
				'city' => post('city'),
				'state' => post('state'),
				'zip' => post('zip'),
				'phone_no' => preg_replace('/\D/', '', post('phone')),
			);
			$where = array('address_id' => post('address_id'));
			$ret = $this->update($address, $where, 'address');
		} else {
			$address = array(
				'street_address' => post('street'),
				'apt_name' => post('apt_name'),
				'city' => post('city'),
				'state' => post('state'),
				'zip' => post('zip'),
				'phone_no' => preg_replace('/\D/', '', post('phone')),
				'customer_id' => $customer_id,
			);
			$ret = $this->insert($address, 'address');
		}
		return true;
	}

	public function getearnPoints() {
		$customer_id = $this->session->userdata('c_id');
		$this->db->where('customer_id', $customer_id);
		$query = $this->db->get('customer_reward')->row();
		return $query;
	}

	public function getOrderData($order_id) {

		$this->db->select('orders.*,order_item.*,sum(order_item_option.price) as priceNew', FALSE);
		$this->db->group_by('order_item.oi_id');
		$this->db->where('orders.o_id', $order_id);
		$this->db->join('order_item', 'order_item.o_id  = orders.o_id');
		$this->db->join('order_item_option', 'order_item_option.order_item_id = order_item.oi_id', 'left');
		$query = $this->db->get('orders');

		return $query->result();
	}

	public function DiscountOnPrdoduct($product_id) {
		$this->db->select('products.*,products.start_time as pst,
			products.end_time as pet,
			products.discount as pdiscount,
			category.start_time as cst,
			category.end_time as cet,
			category.discount as cdiscount,

			', FALSE);
		$this->db->join('product_to_category', 'product_to_category.product_id = products.product_id', 'left');
		$this->db->join('category', 'category.cat_id = product_to_category.category_id', 'left');
		$this->db->where('products.product_id', $product_id);
		$result = $this->db->get('products')->row();
		$today = date('Y-m-d');
		$product_discount = 0;
		$category_discount = 0;
		if ($result->pst <= $today && $result->pet >= $today) {
			$product_discount = $result->pdiscount;
		}
		if ($result->cst <= $today && $result->cet >= $today) {
			$category_discount = $result->cdiscount;
		}
		$discount = max($category_discount, $product_discount);
		$returnPrice = ($result->price * $discount) / 100;
		return $result->price - $returnPrice;

	}

	public function apcoupon() {
		$today = date('Y-m-d');
		$coupn = post('couponcode');
		$this->db->where('coupon_code', $coupn);
		$this->db->where('uses_per_coupon >', '0');
		$this->db->where('date_start <=', $today);
		$this->db->where('date_end >=', $today);
		$ret = $this->db->get('coupons');
		return $ret->row();
	}

	public function checkCoupon($id) {
		$this->db->where('c_id', $id);
		$coupondata = $this->db->get('coupons')->row();

		$customer_id = $this->session->c_id;
		$coupon = $id;
		$this->db->where('coupon_id', $coupon);
		//$this->db->where('customer_id', $customer_id);
		$ret = $this->db->get('coupons_histroy')->result();

		$totalUsed = count($ret);

		if ($coupondata->uses_per_coupon > $totalUsed) {
			$this->db->where('coupon_id', $coupon);
			$this->db->where('customer_id', $customer_id);
			$histroy_customer = $this->db->get('coupons_histroy')->result();
			$usedby = count($histroy_customer);
			if ($coupondata->uses_per_customer > $usedby) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}

	}
	public function checkMinBal($id){
		$this->db->where('c_id', $id);
		$coupondata = $this->db->get('coupons')->row();
		$cup = $coupondata->total_amount;
		if ($this->cart->total() > $cup) {
			return true;
		}else{
			return false;
		}
	}
	public function getCopuponData() {
		$today = date('Y-m-d');
		$coupn = $this->session->userdata('coupon');
		$this->db->where('c_id', $coupn);
		$this->db->where('uses_per_coupon >', '0');
		$this->db->where('date_start <=', $today);
		$this->db->where('date_end >=', $today);
		$ret = $this->db->get('coupons');
		return $ret->row();

	}
	public function getProductsCopoundata($coupn) {
		$this->db->where('coupon_id', $coupn);
		$ret = $this->db->get('coupons_to_products');
		return $ret->result();
	}
	public function getcustomerReward() {
		$customer_id = $this->session->userdata('c_id');
		$this->db->where('customer_id', $customer_id);
		$ret = $this->db->get('customer_reward');
		return $ret->row();
	}
	public function getwallets() {
		$customer_id = $this->session->userdata('c_id');
		$wallet = $this->db->get_where('wallet', array('customer_id' => $customer_id))->row();
		return $wallet;
	}

	public function CheckFirstOrderOfCust() {
		$customer_id = $this->session->c_id;
		$this->db->where('customer_id', $customer_id);
		$this->db->where('order_status >=', '1');
		$ret = $this->db->get('orders');
		if ($ret->row()) {
			return false;
		} else {
			return true;
		}

	}
	public function getRefCustomerWallet($customer_id) {
		$this->db->where('customer_id', $customer_id);
		$ret = $this->db->get('wallet');
		return $ret->row();

	}

	public function getStoreViseTotal($order_id) {
		$this->db->order_by('order_store.store_id', 'asc');
		$this->db->where('order_store.o_id', $order_id);
		$this->db->select('order_item.s_id ,order_item.pro_quantity * order_item.product_price as finalprice', FALSE);
		$this->db->join('order_item', 'order_item.s_id = order_store.so_id', 'left');
		$this->db->join('order_item_option', 'order_item_option.order_item_id = order_item.oi_id', 'left');
		$ret = $this->db->get('order_store');
	}

	public function checkStoreSuborder($order_id, $store_id) {
		$this->db->where('o_id', $order_id);
		$this->db->where('store_id', $store_id);
		$ret = $this->db->get('order_store')->row();
		if ($ret) {
			return $ret->so_id;
		} else {
			return false;
		}

	}

	function getorder($id) {
		$query = new stdClass();
		$this->db->where('o_id', $id);
		$this->db->join('customer', 'customer.c_id = orders.customer_id', 'left');
		$this->db->join('address', 'address.customer_id = customer.c_id', 'left');
		$this->db->join('order_status', 'order_status.order_status_id = orders.order_status', 'left');

		$this->db->order_by('o_id', 'desc');
		$query->order = $this->db->get('orders')->row();
		$this->db->where('order_id', $id);
		$query->order_coupon = $this->db->get('coupons_histroy')->row();
		$this->db->where('o_id', $id);
		$query->order_store = $this->db->get('order_store')->result();
		return $query;
	}
	function getOrderItemByStore($id) {
		$this->db->group_by('order_item.oi_id');
		$this->db->where('order_item.s_id', $id);
		$this->db->join('order_item_option', 'order_item_option.order_item_id = order_item.oi_id', 'left');
		$query = $this->db->get('order_item')->result();

		return $query;

	}
	function getOrderItemByStoreId($id) {
		$this->db->group_by('order_item.oi_id');
		$this->db->where('order_item.store_id', $id);
		$this->db->join('order_item_option', 'order_item_option.order_item_id = order_item.oi_id', 'left');
		$query = $this->db->get('order_item')->result();
		return $query;

	}
	function getOptionval($id) {
		$this->db->where('order_item_id', $id);
		$query = $this->db->get('order_item_option')->result();
		return $query;
	}
	public function getmerchantByOrder($order_id) {
		$this->db->select('merchant.username,store.store_id');
		$this->db->group_by('store.merchant_id');
		$this->db->join('store', 'store.store_id = order_store.store_id', 'left');
		$this->db->join('merchant', 'merchant.m_id = store.merchant_id', 'left');
		$this->db->where('o_id', $order_id);
		$merchant = $this->db->get('order_store')->result();
		
		return $merchant;
	}

}

/* End of file Checkout_model.php */
/* Location: ./application/models/Checkout_model.php */