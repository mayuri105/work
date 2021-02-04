<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		 $this->load->helper('text');
		 $this->load->model('paypal_model','paypal');
         $this->load->model('checkout/checkout_model','checkout');
         $this->load->library('cart');
		 !is_login() ? redirect('index') : '';
	}

	public function index()
	{
		    $is_sandbox = $this->setting->get('paypal_test');
            $order_id = $this->session->userdata('order_id'); 
            $productdata = $this->checkout->getOrderData($order_id);
            $totalamt = $this->GetTotalAmt();

            $data = array(
				'METHOD' => 'SetExpressCheckout',
				'RETURNURL' => site_url('paypal/expressComplete'),
				'CANCELURL' => site_url('checkout'),
				'REQCONFIRMSHIPPING' => 0,
				'NOSHIPPING' => 1,
				'LOCALECODE' => 'EN',
				'LANDINGPAGE'=> 'Login',
				'ALLOWNOTE' => 1,
				'PAYMENTREQUEST_0_SHIPPINGAMT' => '',
				'PAYMENTREQUEST_0_CURRENCYCODE' => $this->setting->get('currency'),
				'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale' ,
				'PAYMENTREQUEST_0_ITEMAMT'  =>  number_format($totalamt, 2, '.', ''),
				'PAYMENTREQUEST_0_AMT'  =>  number_format($totalamt, 2, '.', ''),

			);

            $i= 0;
            foreach ($productdata as $r) {
                $totalprice = $r->product_price + $r->priceNew;
                $data['L_PAYMENTREQUEST_0_NAME'.$i.''] = word_limiter($r->product_name, 3);
                $data['L_PAYMENTREQUEST_0_AMT'.$i.'']  = number_format($totalprice, 2, '.', '');
                $data['L_PAYMENTREQUEST_0_QTY'.$i.'']  = $r->pro_quantity;
                $data['L_PAYMENTREQUEST_0_ITEMURL'.$i.''] = site_url('checkout');  
                $i++;
                $tip = $r->tip_amount;

            }

            if($tip){
                $tips = ($this->cart->total() * $tip )/100;
               
                $data['L_PAYMENTREQUEST_0_NUMBER'.$i.''] = 'Tip';
                $data['L_PAYMENTREQUEST_0_NAME'.$i.''] = 'Tip';
                $data['L_PAYMENTREQUEST_0_AMT'.$i.''] = $tips;
                $data['L_PAYMENTREQUEST_0_QTY'.$i.''] = 1;
                $data['L_PAYMENTREQUEST_0_ITEMURL'.$i.''] = site_url('checkout');  
                 $i++;
            }

            $wallets = $this->checkout->getwallets(); 
            if($wallets){
                $wall = $this->session->wall;
                $data['L_PAYMENTREQUEST_0_NUMBER'.$i.''] = 'wallets';
                $data['L_PAYMENTREQUEST_0_NAME'.$i.''] = 'wallets';
                $data['L_PAYMENTREQUEST_0_AMT'.$i.''] = -$wall ;
                $data['L_PAYMENTREQUEST_0_QTY'.$i.''] = 1;
                $data['L_PAYMENTREQUEST_0_ITEMURL'.$i.''] = site_url('checkout');  
                 $i++;
            }
            
            $coupon =  $this->checkout->getCopuponData();
            if($coupon){
                if ($coupon->type=='F') {
                    $cp = $coupon->discount;
                }else{
                    $total = $this->cart->total();
                    $cp=  $coupon->discount * $total /100;
                }

                $data['L_PAYMENTREQUEST_0_NUMBER'.$i.''] = 'Coupons';
                $data['L_PAYMENTREQUEST_0_NAME'.$i.''] = 'Coupons';
                $data['L_PAYMENTREQUEST_0_AMT'.$i.''] = -$cp;
                $data['L_PAYMENTREQUEST_0_QTY'.$i.''] = 1;
                $data['L_PAYMENTREQUEST_0_ITEMURL'.$i.''] = site_url('checkout');  
            }

            
            $result = $this->paypal->call($data);
            
            /**
			 * If a failed PayPal setup happens, handle it.
			 */
			if(!isset($result['TOKEN'])) {
				$this->session->set_flashdata('msg', 'Error: Invalid Token!');
				$this->session->set_flashdata('xml', $result);
				//redirect('checkout/error');
			}

			$paypal['TOKEN'] = $result['TOKEN'];

			$this->session->set_userdata('paypal',$paypal);

			if($is_sandbox){
				redirect('https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $result['TOKEN']);
			}else{
				redirect('https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $result['TOKEN']);                    
			}
	}
	public function expressComplete() {

        $is_sandbox = $this->setting->get('paypal_test');

        $paypal = $this->session->userdata('paypal');
        
        $data = array(
            'METHOD' => 'GetExpressCheckoutDetails',
            'TOKEN' => $paypal['TOKEN'],
        );
        
        $result = $this->paypal->call($data);            

        $paypal['payerid']   = $result['PAYERID'];
        $paypal['result']    = $result;
        $this->session->set_userdata('paypal', $paypal);

        

        if(isset($result['PAYMENTREQUEST_0_NOTETEXT'])) {
            $this->session->set_userdata('comment', $result['PAYMENTREQUEST_0_NOTETEXT']);
        }

        $paypal_data = array(
            'TOKEN' => $paypal['TOKEN'],
            'PAYERID' => $paypal['payerid'],
            'METHOD' => 'DoExpressCheckoutPayment',
            'PAYMENTREQUEST_0_NOTIFYURL' => '',//ipn url
            'RETURNFMFDETAILS' => 1,
        );

        $paypal_data = array_merge($paypal_data, $this->paypal->paymentRequestInfo());

        $result = $this->paypal->call($paypal_data);

        
        if($result['ACK'] == 'Success') {

            
            //success redirect 
            $this->session->set_flashdata('success','paypal_success_msg');
           
            
            //add transaction to paypal transaction table 
            $paypal_transaction_data = array(
                'customer_id' => $this->session->userdata('c_id'),
                'order_id' =>  $this->session->userdata('order_id'),
                'transaction_id' => $result['PAYMENTINFO_0_TRANSACTIONID'],
                'parent_transaction_id' => '',
                'note' => '',
                'msgsubid' => '',
                'receipt_id' => (isset($result['PAYMENTINFO_0_RECEIPTID']) ? $result['PAYMENTINFO_0_RECEIPTID'] : ''),
                'payment_type' => $result['PAYMENTINFO_0_PAYMENTTYPE'],
                'payment_status' => $result['PAYMENTINFO_0_PAYMENTSTATUS'],
                'pending_reason' => $result['PAYMENTINFO_0_PENDINGREASON'],
                'transaction_entity' => 'Sale',
                'amount' => $result['PAYMENTINFO_0_AMT'],
                'debug_data' => json_encode($result),
            );
            $this->db->insert('paypal_transaction_history', $paypal_transaction_data);            

            redirect('paypal/success/');
            

        } else {
            if ($result['L_ERRORCODE0'] == '10486') {
                if (isset($this->session->userdata['paypal_redirect_count'])) {

                    if ($this->session->userdata['paypal_redirect_count'] == 2) {
                            $this->session->set_userdata('paypal_redirect_count', 0);
                            $this->session->set_flashdata('msg','Error: too many failure');

                            redirect('paypal/error');

                    } else {
                            $this->session->userdata['paypal_redirect_count']++;
                    }
                } else {
                    $this->session->userdata['paypal_redirect_count'] = 1;
                }

                if ($is_sandbox) {
                    $this->redirect('https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $this->session->userdata['paypal']['token']);
                } else {
                    $this->redirect('https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $this->session->userdata['paypal']['token']);
                }
            }

            $this->session->set_flashdata('msg',$result['L_LONGMESSAGE0']);

            redirect('paypal/error');
        }
    } 

     public function error(){

        $data['msg'] = $this->session->flashdata('msg');
        $data['xml'] = $this->session->flashdata('xml');
        
        $this->load->view('error', $data);
    }

    public function success(){
        $totalamt = $this->GetTotalAmt();
        $order_id=$this->session->userdata('order_id');  
        $customer_id = $this->session->userdata('c_id');
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
                        $this->db->insert('wallet', $cr);
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

        $subOrderData = array(
            'order_status_id'=>1,
            'payment_status'=>0
        );

        $where = array('o_id'=>$order_id);
        $ret = $this->checkout->update($subOrderData,$where,'order_store');


        // insert wallet and coupon history 
        $wallets = $this->checkout->getwallets();
        $customer_id = $this->session->userdata('c_id');
        $usedWalletCredit = $this->session->userdata('wall');
        
        if($wallets){
            $remainCredit = $wallets->credit - $usedWalletCredit;
            $wallethistroy =array(
                'order_id' => $order_id,
                'customer_id'=>$customer_id, 
                'credit_used'=>$usedWalletCredit,
                'date_added' =>date('Y-m-d'),
            );
            $this->checkout->insert($wallethistroy,'wallet_history');
            $datawallet = array(
                'credit'=>$remainCredit,
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
        $points = $totalamt * $pointMult;
        
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
        

        $unsetSessiondata = array('date','time','coupon');
        $this->session->unset_userdata($unsetSessiondata);    
          
        redirect('checkout/updateSubOrdertotal');
        

    }
    
    public function GetTotalAmt(){
        $order_id = $this->session->userdata('order_id'); 
        $productdata = $this->checkout->getOrderData($order_id );
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

/* End of file Paypal.php */
/* Location: ./application/controllers/Paypal.php */