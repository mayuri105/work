<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Cart extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('cart_model', 'cart_model');
	}

	function getproductoption() {
		$product_option = $this->cart_model->getProductOption();
		if ($this->setting->get('multiple_store_order') == 'no') {
			if ($this->session->userdata('store_id')) {
				$store_id = $this->session->userdata('store_id');
				if ($product_option->products->store_id != $store_id) {
					$this->cart->destroy();
				}
			}
		}

		$data['products'] = $product_option;
		$data['pointsvalue'] = $this->setting->get('redeem_points');
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cart/model')) {
			$this->load->view('themes/' . $theme . '/template/cart/model', $data);
		} else {
			$this->load->view('themes/default/template/cart/model', $data);
		}

	}

	function addcartdata() {
		$total = 0;
		$option_id = array();
		$option_value_id = array();
		if ($this->input->post('option')) {
			foreach ($this->input->post('option') as $key) {
				$option = $this->cart_model->getOptionData($key);
				$option_id[] = $option->option_group_id;
				$option_value_id[] = $option->po_id;
				$total = $total + $option->price;
			}
		}
		$totalprice = $total + $this->input->post('price');
		$data = array(
			'id' => $this->input->post('product_id'),
			'qty' => $this->input->post('qty'),
			'price' => $totalprice,
			'name' => $this->input->post('product_name'),
			'options' => array(
				'product_option' => $this->input->post('option'),
				'special_instruction' => post('special_instruction'),
			),
			'store_id' => post('store_id'),

		);
		$this->cart->insert($data);
		// set store id
		$this->session->set_userdata('store_id', post('store_id'));
		$store_id = post('store_id');
		$data['min_order'] = $this->cart_model->getminOrder($store_id);
		$data['pointsvalue'] = $this->setting->get('redeem_points');
		$data['date_time_detail'] = $this->getDatetime();

	    $data['date_time_detail_laundry'] =$this->getDatetimeLaundry();
		$theme = $this->session->userdata('front_theme');

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cart/cart')) {
			$this->load->view('themes/' . $theme . '/template/cart/cart', $data);
		} else {
			$this->load->view('themes/default/template/cart/cart', $data);
		}

	}
	public function editCart() {
		$data['products'] = $this->cart_model->getProductOption();
		$data['product_cart'] = $this->cart_model->getProductCart();
		$data['pointsvalue'] = $this->setting->get('redeem_points');
		$data['date_time_detail'] = $this->getDatetime();
		$data['date_time_detail_laundry'] =$this->getDatetimeLaundry();
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cart/editmodeldata')) {
			$this->load->view('themes/' . $theme . '/template/cart/editmodeldata', $data);
		} else {
			$this->load->view('themes/default/template/cart/editmodeldata', $data);
		}
	}
	public function updateCart() {
		$data = array(
			'rowid' => post('rowid'),
			'qty' => 0,
		);
		$this->cart->update($data);
		$total = 0;
		$option_id = array();
		$option_value_id = array();
		if ($this->input->post('option')) {
			foreach ($this->input->post('option') as $key) {
				$option = $this->cart_model->getOptionData($key);
				$option_id[] = $option->option_group_id;
				$option_value_id[] = $option->po_id;
				$total = $total + $option->price;
			}

		}
		$totalprice = $total + $this->input->post('price');
		$data = array(
			'id' => $this->input->post('product_id'),
			'qty' => $this->input->post('qty'),
			'price' => $totalprice,
			'name' => $this->input->post('product_name'),
			'options' => array(
				'product_option' => $this->input->post('option'),
				'special_instruction' => post('special_instruction'),
			),
			'store_id' => post('store_id'),

		);
		$this->cart->insert($data);
		// set store id
		$this->session->set_userdata('store_id', post('store_id'));
		$store_id = post('store_id');
		$data['min_order'] = $this->cart_model->getminOrder($store_id);
		$data['date_time_detail'] = $this->getDatetime();
		$data['date_time_detail_laundry'] =$this->getDatetimeLaundry();
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cart/cart')) {
			$this->load->view('themes/' . $theme . '/template/cart/cart', $data);
		} else {
			$this->load->view('themes/default/template/cart/cart', $data);
		}

	}
	function removeCart() {
		$data = array(
			'rowid' => post('rowid'),
			'qty' => 0,
		);
		$this->cart->update($data);

		$store_id = $this->session->userdata('store_id');
		$data['min_order'] = $this->cart_model->getminOrder($store_id);
		$data['date_time_detail'] = $this->getDatetime();
		$data['date_time_detail_laundry'] =$this->getDatetimeLaundry();
		$data['pointsvalue'] = $this->setting->get('redeem_points');
		$data['totalcart'] = $this->cart->total();
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cart/cart')) {
			$this->load->view('themes/' . $theme . '/template/cart/cart', $data);
		} else {
			$this->load->view('themes/default/template/cart/cart', $data);
		}

	}

	public function getDatetime() {
		if ($this->session->userdata('date') && $this->session->userdata('time')) {
			$data = array(
				'date' => date('Y-m-d', strtotime($this->session->userdata('date'))),
				'time' => date('H:i:s', strtotime($this->session->userdata('time'))),
			);
			return $data;
		}
	}
	public function getDatetimeLaundry(){
		if($this->session->userdata('pickupdate') && $this->session->userdata('pickuptime') && $this->session->userdata('deliverydate') && $this->session->userdata('deliverytime')){
			$data = array(
				'pickupdate'=>date('Y-m-d',strtotime($this->session->userdata('pickupdate'))),
				'pickuptime'=>date('H:i:s',strtotime($this->session->userdata('pickuptime'))),
				'date'=>date('Y-m-d',strtotime($this->session->userdata('deliverydate'))),
				'time'=>date('H:i:s',strtotime($this->session->userdata('deliverytime'))),
			);
			return $data;
		}

		
	}
}

/* End of file Cart.php */
/* Location: ./application/controllers/Cart.php */