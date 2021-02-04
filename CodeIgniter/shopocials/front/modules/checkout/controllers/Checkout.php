<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Checkout extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('index/index_model', 'index');
		$this->load->model('checkout_model', 'checkout');
		$this->load->model('paypal/paypal_model', 'paypal');
		$this->load->library('encrypt');
		$this->load->library('cart');
		$this->load->model('cart/cart_model', 'cart_model');
		!is_login() ? redirect('index') : '';
	}
	public function index() {
		$data = array();
		$type = $this->session->userdata('type');
		$store_id = $this->session->userdata('store_id');
		 

		if (!$this->cart->contents()) {
			redirect('/');
		}
		$minorder = $this->index->getminOrder($store_id);

		if ($this->cart->total() <= $minorder) {
			redirect('/');
		}

		if ($store_id) {
			$data['bodyclass'] = 'page-checkout';
			$data['type'] = $type;

			$data['category_data'] = $this->index->getcatbyname($type);
			$data['store_info'] = $this->checkout->getStoreDetailbyId($store_id);
			$data['customer_data'] = $this->checkout->getcustomerdata();
			$data['paymentmethod'] = $this->getPaymentMethod();
			$data['tip'] = $this->gettipamount();
			$data['state'] = getstate();
			$data['coupon'] = $this->getcoupon();
			$data['pointsvalue'] = $this->setting->get('redeem_points');
			$wallets = $this->checkout->getwallets();
			$data['wallets'] = $wallets;
			if ($wallets) {
				$data['wall'] = $this->session->userdata('wall') ? $this->session->userdata('wall') : $wallets->credit;
			}
			

			$data['stripe_enable'] = $this->setting->get('stripe_enable');
			$data['paypal_enable'] = $this->setting->get('paypal_enable');
			$data['cod_enable'] = $this->setting->get('cod_enable');
			$data['stripe_threshold_value'] = $this->setting->get('
				');
			$data['paypal_threshold_value'] = $this->setting->get('paypal_threshold_value');
			$data['cash_threshold_value'] = $this->setting->get('cash_threshold_value');
			$stripe_test_mode = $this->setting->get('stripe_test_mode');
			if ('true' == $stripe_test_mode) {
				$data['stripe_key_public'] = $this->setting->get('stripe_key_test_public');
			} else {
				$data['stripe_key_public'] = $this->setting->get('stripe_key_live_public');
			}
			$theme = $this->session->userdata('front_theme');
			if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/checkout/index')) {
				$this->load->view('themes/' . $theme . '/template/checkout/index', $data);
			} else {
				$this->load->view('themes/default/template/checkout/index', $data);
			}
		} else {
			show_404();
		}
	}
	public function getPaymentMethod() {
		if ($this->session->userdata('paymenttype')) {
			$paymenttype = $this->session->userdata('paymenttype');
		} else {
			$paymenttype = 'credit-and-other';
		}
		return $paymenttype;
	}
	public function setpaymenttype() {
		$result = array(
			'paymenttype' => post('paymenttype'),
		);
		$this->session->set_userdata($result);
		echo json_encode($result);
	}
	public function addorder() {
		$stripe_threshold_value = $this->setting->get('stripe_threshold_value');
		$paypal_threshold_value = $this->setting->get('paypal_threshold_value');
		$cash_threshold_value = $this->setting->get('cash_threshold_value');

		$paymenttype = $this->session->userdata('paymenttype');

		if (!$paymenttype) {
			$paymenttype = 'credit-and-other';
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('street', 'street', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('state', 'state', 'required');
		$this->form_validation->set_rules('zip', 'zip', 'required');
		$this->form_validation->set_rules('phone', 'phone', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('checkout');
		} else {
			// address update and insert
			$this->checkout->addressInsert();
			if ('credit-and-other' == $paymenttype) {
				if ($stripe_threshold_value <= $this->cart->total()) {
					$ret = $this->addorderDetInsert($paymenttype);
					$this->session->set_userdata(array('stripeToken' => post('stripeToken')));
					if ($ret) {
						redirect('stripepayment');
					} else {
						redirect('checkout/error');
					}
				} else {
					$this->session->set_flashdata('error', 'Your order amount is low for use this payment type');
					redirect('checkout');
				}

			} elseif ('paying-paypal' == $paymenttype) {
				if ($paypal_threshold_value <= $this->cart->total()) {
					$ret = $this->addorderDetInsert($paymenttype);
					if ($ret) {
						redirect('paypal');
					} else {
						redirect('checkout/error');
					}
				} else {
					$this->session->set_flashdata('error', 'Your order amount is low for use this payment type');
					redirect('checkout');
				}
			} else {
				if ($cash_threshold_value <= $this->cart->total()) {

					$ret = $this->addorderDetInsert($paymenttype);
					if ($ret) {
						redirect('checkout/cashfinal');
					} else {
						redirect('checkout/error');
					}
				} else {
					$this->session->set_flashdata('error', 'Your order amount is low for use this payment type');
					redirect('checkout');
				}
			}
		}
	}

	public function addorderDetInsert($paymenttype) {
		// order added
		$customer_id = $this->session->userdata('c_id');
		$date = date('Y-m-d', strtotime($this->session->userdata('date')));
		$time = date('H:i:s', strtotime($this->session->userdata('time')));
		$pickupdate = date('Y-m-d', strtotime($this->session->userdata('pickupdate')));
		$pickuptime = date('H:i:s', strtotime($this->session->userdata('pickuptime')));

		$pickup_datetime = $pickupdate . ' ' . $pickuptime;

		$dl = $this->session->userdata('pickordelivery') ? $this->session->userdata('pickordelivery') : 'delivery';
		$dt = $date . '' . $time;

		$tip = post('tipamount') > 100 ? 100 : post('tipamount');
		$prf = 'INV';
		$yr = date('y');
		$invoice_prefix = $prf . '-' . $yr . '-' . '00';

		$data = array(
			'delivery_option' => $dl,
			'order_status' => '0',
			'invoice_prefix' => $invoice_prefix,
			'customer_id' => $customer_id,
			'delivery_or_pic_datetime' => date('Y-m-d H:i:s', strtotime($dt)),
			'payment_method' => $paymenttype,
			'special_inst' => post('specialinstruction'),
			'tip_amount' => $tip,
			'first_name' => $this->session->first_name,
			'last_name' => $this->session->last_name,
			'payment_address' => post('street'),
			'shipping_address' => post('street'),
			'payment_apt_name' => post('apt_name'),
			'shipping_apt_name' => post('apt_name'),
			'payment_city' => post('city'),
			'shipping_city' => post('city'),
			'payment_state' => post('state'),
			'shipping_state' => post('state'),
			'payment_zip' => post('zip'),
			'shipping_zip' => post('zip'),
			'created_on' => date('Y-m-d'),
			'read_by_merchant'=>'0'
		);
		$orderid = $this->checkout->insert($data, 'orders');

		$setOrderid = array('order_id' => $orderid);

		$this->session->set_userdata($setOrderid);
		$productSessionData = $this->cart->contents();

		$storeidForcheck = 0;
		foreach ($productSessionData as $ps) {
			$product = $this->checkout->getPrductbyId($ps['id']);
			$discountPrice = $this->checkout->DiscountOnPrdoduct($ps['id']);

			if ($storeidForcheck != $product->store_id) {

				$checkForSuborder = $this->checkout->checkStoreSuborder($orderid, $product->store_id);

				if ($checkForSuborder) {

					$suborderid = $checkForSuborder;

				} else {
					$subOrder = array(
						'o_id' => $orderid,
						'store_id' => $product->store_id,
						'store_name' => $product->store_name,
						'delivery_option' => $dl,
						'order_status_id' => '0',
						'payment_status' => '0',
						'delivery_date_time' => date('Y-m-d H:i:s', strtotime($dt)),
						'pickup_datetime' => date('Y-m-d H:i:s', strtotime($pickup_datetime)),
						'comment' => post('specialinstruction'),
						'tip' => $tip,
						'payment_method' => $paymenttype,
						'date_added' => date('Y-m-d'),
					);
					$suborderid = $this->checkout->insert($subOrder, 'order_store');
				}

			}
			$dataInsert = array(
				'o_id' => $orderid,
				's_id' => $suborderid,
				'product_id' => $product->product_id,
				'product_name' => $product->product_name,
				'product_price' => $discountPrice,
				'pro_quantity' => $ps['qty'],
				'store_id' => $product->store_id,
				'store_name' => $product->store_name,

			);
			$order_item_id = $this->checkout->insert($dataInsert, 'order_item');

			if ($ps['rowid']) {
				$productOpt = $this->cart->product_options($ps['rowid']);
				if ($productOpt['product_option']) {
					foreach ($productOpt['product_option'] as $k) {
						$options_val_item = $this->cart_model->getOptionData($k);
						$dataItem = array(
							'order_item_id' => $order_item_id,
							'product_id' => $product->product_id,
							'option_name' => $options_val_item->option_name,
							'option_value' => $options_val_item->option_value,
							'option_id' => $options_val_item->option_id,
							'option_value_id' => $options_val_item->po_id,
							'price' => $options_val_item->price,
						);
						$order_item_value_id = $this->checkout->insert($dataItem, 'order_item_option');
					}
				}
				if ($productOpt['special_instruction']) {
					$dataForupdate = array(
						'special_inst' => $productOpt['special_instruction'],
					);
					$where = array('oi_id' => $order_item_id);
					$updateSpecial = $this->checkout->update($dataForupdate, $where, 'order_item');
				}

			}
			$storeidForcheck = $product->store_id;
		}
		return $orderid;
	}
	public function cashfinal() {
		// points insert here after successfull transaction
		$totalamt = $this->GetTotalAmt();
		$customer_id = $this->session->userdata('c_id');
		$order_id = $this->session->userdata('order_id');
		$CusFirstOrder = $this->checkout->CheckFirstOrderOfCust();
		if ($CusFirstOrder) {
			$getcustData = $this->checkout->getcustomerdata();
			if ($getcustData->customer_info->ref_by) {
				$minCreditOrder = $this->setting->get('minorder_for_credits');
				$credit = $this->setting->get('refbycredits');
				if ($totalamt >= $minCreditOrder) {
					$creditData = array(
						'customer_id' => $getcustData->customer_info->ref_by,
						'earn_credits' => $credit,
						'ref_customer_id' => $customer_id,
						'ref_order_id' => $order_id,
					);
					$this->checkout->insert($creditData, 'refer_credit_history');
					$getRefbydetail = $this->checkout->getRefCustomerWallet($getcustData->customer_info->ref_by);

					if ($getRefbydetail) {
						$cr = array(
							'credit' => $credit + $getRefbydetail->credit,
						);
						$this->db->update('wallet', $cr, array('customer_id' => $getcustData->customer_info->ref_by));

					} else {
						$cr = array(
							'credit' => $credit,
							'customer_id' => $getcustData->customer_info->ref_by,
						);
						$this->db->insert('wallet', $cr);
					}
				}
			}
		}
		$dataForupdate = array(
			'order_status' => 1,
			'total_amt' => $totalamt,
			'payment_status' => '0',
		);
		$where = array('o_id' => $this->session->userdata('order_id'));
		$ret = $this->checkout->update($dataForupdate, $where, 'orders');

		$pointMult = $this->setting->get('redeem_points');
		$points = $totalamt * $pointMult;

		$getRewardData = $this->checkout->getcustomerReward();

		if ($getRewardData) {
			$totalPoints = $getRewardData->points + $points;
			$dataforInsert = array(
				'points' => $totalPoints,
			);
			$where2 = array('customer_id' => $this->session->userdata('c_id'));
			$this->checkout->update($dataforInsert, $where2, 'customer_reward');

		} else {
			$dataforInsert = array(
				'customer_id' => $this->session->userdata('c_id'),
				'points' => $points,
			);
			$this->checkout->insert($dataforInsert, 'customer_reward');

		}
		$unsetSessiondata = array('date', 'time', 'coupon');
		$this->session->unset_userdata($unsetSessiondata);
		
		redirect('checkout/updateSubOrdertotal');

	}
	public function completed() {

		$data = array();
		$this->cart->destroy();
		$store_id = $this->session->userdata('store_id');

		$data['points'] = $this->checkout->getearnPoints();
		$data['store_info'] = $this->checkout->getStoreDetailbyId($store_id);
		$data['bodyclass'] = 'page-checkout';
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/checkout/success')) {
			$this->load->view('themes/' . $theme . '/template/checkout/success', $data);
		} else {
			$this->load->view('themes/default/template/checkout/success', $data);
		}
	}
	public function error() {
		$data = array();
		$store_id = $this->session->userdata('store_id');
		$data['store_info'] = $this->checkout->getStoreDetailbyId($store_id);
		$data['bodyclass'] = 'page-checkout';
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/checkout/error')) {
			$this->load->view('themes/' . $theme . '/template/checkout/error', $data);
		} else {
			$this->load->view('themes/default/template/checkout/error', $data);
		}
	}

	public function applaycoupon() {
		if (post('couponcode')) {
			$ret = $this->checkout->apcoupon();
			if ($ret) {
				$checkcoup = $this->checkout->checkCoupon($ret->c_id);

				if ($checkcoup) {
					$checkMinBal = $this->checkout->checkMinBal($ret->c_id);
					if ($checkMinBal) {
						echo json_encode(array('response' => 'Successfully applied coupon', 'response_id' => 1));
						$this->session->set_userdata('coupon', $ret->c_id);
					}else{
						echo json_encode(array('response' => 'Your total amount is low basd on coupon. ', 'response_id' => 0));
					}
				} else {
					echo json_encode(array('response' => 'Coupon is expired or you  already used this coupon', 'response_id' => 0));
				}

			} else {
				echo json_encode(array('response' => 'Coupon is not valid', 'response_id' => 0));
			}

		} else {
			echo json_encode(array('response' => 'Coupon code is empty', 'response_id' => 0));
		}

	}
	public function getcoupon() {
		if ($this->session->userdata('coupon')) {
			$data = $this->checkout->getCopuponData();
			if ($data) {
				if ('F' == $data->type) {
					return $data->discount;
				} else {
					$total = $this->cart->total();
					return $data->discount * $total / 100;
				}
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
	public function settipamount() {
		$data = array();
		if (post('tip') == 'cash') {
			$result = array(
				'tip' => 'cash',
			);
			$this->session->set_userdata($result);

		} else {
			$result = array(
				'tip' => post('tip'),
			);
			$this->session->set_userdata($result);

		}
		$wallets = $this->checkout->getwallets();
		$data['tip'] = $this->gettipamount();
		$data['coupon'] = $this->getcoupon();
		$data['wallets'] = $this->checkout->getwallets();
		$data['wall'] = $this->session->userdata('wall') ? $this->session->userdata('wall') : $wallets->credit;
		
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/checkout/cart')) {
			$this->load->view('themes/' . $theme . '/template/checkout/cart', $data);
		} else {
			$this->load->view('themes/default/template/checkout/cart', $data);
		}

	}
	public function gettipamount() {
		if ($this->session->tip) {
			$tip = $this->session->userdata('tip');
		} else {
			$tip = '15';
		}
		return $tip;
	}

	public function GetTotalAmt() {
		$order_id = $this->session->userdata('order_id');
		$productdata = $this->checkout->getOrderData($order_id);
		$totalamt = 0;
		foreach ($productdata as $pd) {
			$priceOfProduct = $pd->priceNew + $pd->product_price;
			$price = $pd->pro_quantity * $priceOfProduct;

			$totalamt = $totalamt + $price;
			$tipPer = $pd->tip_amount;
		}
		$tip = ($totalamt * $tipPer) / 100;
		$totalamt = $totalamt + $tip;

		return $totalamt;
	}

	public function updateSubOrdertotal() {
		$order_id = $this->session->userdata('order_id');

		$this->db->where('o_id', $order_id);
		$order_store = $this->db->get('order_store')->result();

		foreach ($order_store as $os) {
			$this->db->group_by('order_item.oi_id');
			$this->db->where('order_item.s_id', $os->so_id);
			$this->db->join('order_item_option', 'order_item_option.order_item_id = order_item.oi_id', 'left');
			$order_item = $this->db->get('order_item')->result();

			$total = 0;
			foreach ($order_item as $item) {
				$this->db->where('order_item_id', $item->oi_id);
				$getOptionValue = $this->db->get('order_item_option')->result();

				$tot = 0;
				foreach ($getOptionValue as $option) {
					$tot += $option->price;
				}
				$totalUnitPrice = $tot + $item->product_price;
				$price = $item->pro_quantity * $totalUnitPrice;
				$total += $price;
				$tip = ($total * $os->tip) / 100;
				$totalamt = $total + $tip;
			}
			$dataUpdate = array(
				'tip_in_currancy' => $tip,
				'total' => $totalamt,
				'order_status_id'=>1,
           		'payment_status'=>0
			);
			$where = array('so_id' => $os->so_id);
			$ret = $this->checkout->update($dataUpdate, $where, 'order_store');
		}

		$this->sendmailCustomer();
		$this->sendmailMerchant();
		redirect('checkout/completed');
	}

	public function sendmailCustomer() {
		// send mail to user
		$o_id = $this->session->userdata('order_id');
		$theme = $this->session->userdata('front_theme');
		$getcustData = $this->checkout->getcustomerdata();

		$to = $getcustData->customer_info->email;
		$email_address = $this->setting->get('email_address');
		$company_name = $this->setting->get('site_name');
		$subject = 'Your order_id details on' . $company_name;

		$data['username'] = $getcustData->customer_info->first_name . ' ' . $getcustData->customer_info->last_name;
		$data['address'] = $this->setting->get('address');
		$data['phone'] = $this->setting->get('phone');
		$data['email_address'] = $this->setting->get('email_address');

		$data['order'] = $this->checkout->getorder($o_id);

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/mailtemplate/order_details_customer')) {
			$message = $this->load->view('themes/' . $theme . '/template/mailtemplate/order_details_customer', $data, true);
		} else {
			$message = $this->load->view('themes/default/template/mailtemplate/order_details_customer', $data, true);
		}

		$this->sendmailconfig($to, $subject, $message);
		return true;
	}
	public function sendmailMerchant() {
		$order_id = $this->session->userdata('order_id');
		$theme = $this->session->userdata('front_theme');
		$merchant = $this->checkout->getmerchantByOrder($order_id);
		$data['order'] = $this->checkout->getorder($order_id);

		foreach ($merchant as $m) {
			$to = $m->username;
			$data['store_id']=$m->store_id;
			$data['order_item'] = $this->checkout->getOrderItemByStoreId($m->store_id);
			$subject = 'You have an order on your strore';
			if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/mailtemplate/order_details_merchant')) {
				$message = $this->load->view('themes/' . $theme . '/template/mailtemplate/order_details_merchant', $data, true);
			} else {
				$message = $this->load->view('themes/default/template/mailtemplate/order_details_merchant', $data, true);
			}
		}
		
		$this->sendmailconfig($to, $subject, $message);
		return true;
	}

	protected function sendmailconfig($to, $subject, $message) {
		$email_address = $this->setting->get('email_address');
		$company_name = $this->setting->get('site_name');
		$this->load->library('email');
		$config['protocol'] = $this->setting->get('mail_protocol'); //'smtp';
		$config['smtp_host'] = $this->setting->get('smtp_host'); //'ssl://smtp.gmail.com';
		$config['smtp_port'] = $this->setting->get('smtp_port'); //'465';
		$config['smtp_timeout'] = $this->setting->get('smtp_timeout'); //'7';
		$config['smtp_user'] = $this->setting->get('smtp_user'); //'mygmail@gmail.com';
		$config['smtp_pass'] = $this->setting->get('smtp_pass');
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from($email_address, $company_name);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
	}

	public function setwallet(){
		$data = array();
		
		$result = array(
			'wall' => post('wall'),
		);
		$this->session->set_userdata($result);
		$wallets = $this->checkout->getwallets();
		$data['tip'] = $this->gettipamount();
		$data['coupon'] = $this->getcoupon();
		$data['wallets'] = $wallets;
		$data['wall'] = post('wall');
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/checkout/cart')) {
			$this->load->view('themes/' . $theme . '/template/checkout/cart', $data);
		} else {
			$this->load->view('themes/default/template/checkout/cart', $data);
		}
	}
	public function setpaymentatype() {
		$result = array(
			'paymenttype' => post('paymenttype'),
		);
		$this->session->set_userdata($result);
		echo json_encode($result);
	}
}

/* End of file Checkout.php */
/* Location: ./application/controllers/Checkout.php */
