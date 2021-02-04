<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stripepayment extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('strip_model', 'strip_m');
		$this->load->model('checkout/checkout_model','checkout');
		$this->load->library('cart');
		$this->load->library('init');
		
		!is_login() ? redirect('index') : '';

		$stripe_test_mode = $this->setting->get('stripe_test_mode');  
       	$stripe_verify_ssl = $this->setting->get('stripe_verify_ssl');  
        $stripe_key_test_public = $this->setting->get('stripe_key_test_public');  
       	$stripe_key_test_secret = $this->setting->get('stripe_key_test_secret');  
        $stripe_key_live_public = $this->setting->get('stripe_key_live_public');  
        $stripe_key_live_secret = $this->setting->get('stripe_key_live_secret');  
        if($stripe_test_mode=='true'){
        	\Stripe\Stripe::setApiKey($stripe_key_test_secret);
    	}else{
    		\Stripe\Stripe::setApiKey($stripe_key_live_secret);
    	}
	}

	public function index()
	{
		$customer = getActiveCustomerInfo();
		$stripe_currency_code = $this->setting->get('stripe_currency_code');

		$token = $this->session->userdata('stripeToken');
		$amount = $this->GetTotalAmt()*100;// amount in cents so multiply by 100

		if( !$customer->stripe_cust_id ) {
 
			// create a new customer if our current user doesn't have one
			$Retcustomer = \Stripe\Customer::create(array(
					'card' => $token,
					'email' =>$customer->email
				)
			);
		 
			$customer_id = $Retcustomer->id;
		 	$dataFcustUpdate = array(
		 		'stripe_cust_id'=>$customer_id
		 	);
		 	$where = array('c_id'=>$customer->c_id);
		 	$update = $this->checkout->update($dataFcustUpdate,$where,'customer');

		 	if($update){
		 		$charge = \Stripe\Charge::create(
					array(
					'amount' => $amount, // amount in cents
					'currency' => $stripe_currency_code,
					'customer' => $customer_id
					)
				);
		 		if($charge->paid){
		 			
		 			$this->session->set_flashdata('msg',$charge->status);
		 			redirect('stripepayment/success');
		 		}else{
		 			$this->session->set_flashdata('msg',$charge->status);
		 			redirect('checkout/error');
		 		}
		 	}else{
		 		$this->session->set_flashdata('msg','Error in transaction');
		 		redirect('checkout/error');
		 	}
		}


		if(!is_null($customer->stripe_cust_id)){
			

			$customers = \Stripe\Customer::retrieve($customer->stripe_cust_id);
			$customers->sources->create(array("source" => $token ));


			$charge = \Stripe\Charge::create(
				array(
				'amount' =>$amount, // amount in cents
				'currency' => $stripe_currency_code,
				'customer' => $customer->stripe_cust_id
				)
			);
			if($charge->paid){
				
				$this->session->set_flashdata('msg',$charge->status);
	 			redirect('stripepayment/success');
	 		}else{
	 			$this->session->set_flashdata('msg',$charge->status);
	 			redirect('checkout/error');
	 		}

		}else{
			$this->session->set_flashdata('msg','Error in transaction');	
			redirect('checkout/error');
		}	

	}
	
	function success(){
		// main order update 
		$totalamt = $this->GetTotalAmt();
		$customer_id = $this->session->userdata('c_id');
		$order_id = $this->session->userdata('order_id');
		$CusFirstOrder = $this->checkout->CheckFirstOrderOfCust();
		if ($CusFirstOrder) {
			$getcustData = $this->checkout->getcustomerdata();
			if($getcustData->customer_info->ref_by){
				$minCreditOrder = $this->setting->get('minorder_for_credits');
				$credit = $this->setting->get('refbycredits');
				if($totalamt >= $minCreditOrder){
					$creditData = array(
						'customer_id'=>$getcustData->customer_info->ref_by,
						'earn_credits'=>$credit,
						'ref_customer_id'=>$customer_id,
						'ref_order_id'=>$order_id,
					);
					$this->checkout->insert($creditData,'refer_credit_history');
					$getRefbydetail = $this->checkout->getRefCustomerWallet($getcustData->customer_info->ref_by);
					
					if ($getRefbydetail) {
						$cr = array(
							'credit'=> $credit + $getRefbydetail->credit,
						);
						$this->db->update('wallet', $cr, array('customer_id'=>$getcustData->customer_info->ref_by));

					}else{
						$cr = array(
							'credit'=> $credit,
							'customer_id'=>$getcustData->customer_info->ref_by
						);
						$this->checkout->insert($cr,'wallet');
					}
				}
			}
		}
		$dataForupdate = array(
            'order_status'=>1,
            'total_amt'=>$this->GetTotalAmtWithoutWallet()
        );
        $where = array('o_id'=>$order_id);
        $ret = $this->checkout->update($dataForupdate,$where,'orders');
        // suborder update

        $subOrderData = array(
            'order_status_id'=>1,
            'payment_status'=>0
        );
        $where = array('o_id'=>$order_id);
        $updateStore = $this->checkout->update($subOrderData,$where,'order_store');

        // insert wallet and coupon history 
        $wallets = $this->checkout->getwallets();
        $customer_id = $this->session->userdata('c_id');
        $usedWalletCredit = $this->session->userdata('wall');
        $totalAmount = $this->GetTotalAmt();
        if($wallets->credit !='0.00'){
        	 $remainCredit = $wallets->credit - $usedWalletCredit;
	        $wallethistroy =array(
	            'order_id' => $order_id,
	            'customer_id'=>$customer_id, 
	            'credit_used'=>$remainCredit,
	            'date_added' =>date('Y-m-d'),
	        );
	        $this->checkout->insert($wallethistroy,'wallet_history');
	        $datawallet = array(
	            'credit'=> $remainCredit,
	            );
	        $this->db->update('wallet', $datawallet, array('customer_id'=>$customer_id));
	       
	    }
        if($this->session->userdata('coupon')) {
            $data =  $this->checkout->getCopuponData();
            if($data){
            	$dataForIn = array(
                    'coupon_id'=>$data->c_id,
                    'coupon_name'=>$data->coupon_name,
                    'coupon_code'=>$data->coupon_code,
                    'type'=>$data->type,
                    'discount'=>$data->discount,
                    'customer_id'=>$customer_id,
                    'order_id'=>$order_id,
                     'added_date' =>date('Y-m-d')
                );
                $this->checkout->insert($dataForIn,'coupons_histroy');
             }
        }

        // points insert here after successfull transaction
        $pointMult = $this->setting->get('redeem_points');
        $points = $totalAmount * $pointMult;
        $getRewardData= $this->checkout->getcustomerReward();
		if ($getRewardData) {
            $totalPoints = $getRewardData->points + $points;
            $dataforInsert = array(
                'points'=>$totalPoints,
            );
             $where2 = array('customer_id'=>$this->session->userdata('c_id'));
            $this->checkout->update($dataforInsert,$where2,'customer_reward');
		}else{
            $dataforInsert = array(
                'customer_id'=>$this->session->userdata('c_id'),
                'points'=>$points,
            );
            $this->checkout->insert($dataforInsert,'customer_reward');
        }
        $this->checkout->insert($dataforInsert,'customer_reward');
        
        // unset some variable for next checkout
        $unsetSessiondata = array('date','time','coupon','paymenttype');
        $this->session->unset_userdata($unsetSessiondata);   
        redirect('checkout/updateSubOrdertotal');
	}

	public function GetTotalAmt(){
        $order_id = $this->session->userdata('order_id'); 
        $customer_id = $this->session->userdata('customer_id'); 
        $productdata = $this->checkout->getOrderData($order_id);
        $totalamt=0;

        foreach ($productdata as $pd) {
            $priceOfProduct = $pd->priceNew + $pd->product_price;
            $price = $pd->pro_quantity * $priceOfProduct;
            $totalamt = $totalamt +$price;
            $tipPer =$pd->tip_amount; 
        }
        $tip = ($totalamt * $tipPer )/100;
        $totalamt = $totalamt + $tip;
        // Wallet code 
        $wallets = $this->checkout->getwallets();
        if($wallets){
        	$wall = $this->session->wall;
        	$totalamt = $totalamt - $wall;
        }
        // coupon code
        
		if($this->session->userdata('coupon')) {
			$data =  $this->checkout->getCopuponData();
			if($data){
				if ($data->type=='F') {
					$totalamt = $totalamt - $data->discount;
				}else{
					$total = $this->cart->total();
					$dis=  $data->discount * $total /100;
					$totalamt = $totalamt -$dis;
				}
			}
		}

        
        return $totalamt;
    }
    public function GetTotalAmtWithoutWallet(){
    	$order_id = $this->session->userdata('order_id'); 
        $customer_id = $this->session->userdata('customer_id'); 
        $productdata = $this->checkout->getOrderData($order_id);
        $totalamt=0;

        foreach ($productdata as $pd) {
            $priceOfProduct = $pd->priceNew + $pd->product_price;
            $price = $pd->pro_quantity * $priceOfProduct;
            $totalamt = $totalamt +$price;
            $tipPer =$pd->tip_amount; 
        }
        $tip = ($totalamt * $tipPer )/100;
        $totalamt = $totalamt + $tip;
       
        // coupon code
        
		if($this->session->userdata('coupon')) {
			$data =  $this->checkout->getCopuponData();
			if($data){
				if ($data->type=='F') {
					$totalamt = $totalamt - $data->discount;
				}else{
					$total = $this->cart->total();
					$dis=  $data->discount * $total /100;
					$totalamt = $totalamt -$dis;
				}
			}
		}

        
        return $totalamt;
    }
    
}

/* End of file Stripe.php */
/* Location: ./application/controllers/Stripe.php */