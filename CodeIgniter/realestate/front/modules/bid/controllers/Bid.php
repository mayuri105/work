<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
class Bid extends MX_Controller{
	public function __construct() {
		parent::__construct();
		$this->load->model('bid_model', 'bid');
		
	}
	public function index(){
		!is_login() ? redirect('index') :''; 
		redirect('/','refresh');
		
	}
	public function property($slug){
		!is_login() ? redirect('index') :''; 
		if(!checkPackage(2)){
			redirect('index');
		}
		$return = $this->bid->checkbidtimeover();
		if(!$return){
			redirect('index');
		}
		$data = array();
		if ($slug) {
			$theme = $this->session->userdata('front_theme');
			$data['title'] = $this->setting->get('site_name');
			$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
			$data['meta_keywords'] = $this->setting->get('meta_keywords');
			$data['meta_titles'] = $this->setting->get('meta_titles');
			$data['property'] = $this->bid->getPropertyBySlug($slug);
			$data['customerOtherBids'] =$this->bid->getCustomerBids();

			if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/bid/property')) {
				$this->load->view('themes/' . $theme . '/template/bid/property', $data);
			} else {
				$this->load->view('themes/default/template/bid/property', $data);
			}	
		}else{
			redirect('index','refresh');
		}
	}
	public function getTimeSlotforbid(){
		// if(!checkPackage(2)){
		// 	exit;//redirect('index');
		// }
		$date = $this->input->get('date');
		$return = $this->bid->getTimeslot($date);
		$this->output->set_content_type('application/json')->set_output(json_encode($return));
	}
	public function bidsubmit()
	{


		$pro_id = post('property_id');
		$bid_last = $this->bid->getlastbids($pro_id);
	        	
    	$property = $this->bid->getPropertyDetails($pro_id);
    	if ($bid_last->amount) {
    		 $min_amount = $bid_last->amount + $property->bid_difference;

    	}else{
    		$min_amount = $property->bid_difference + $property->cost;
    	}

    	$this->load->library('form_validation');

		$this->form_validation->set_rules('property_id', 'property_id', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'numeric|required|greater_than['.$min_amount.']');
        
        if ($this->form_validation->run() == FALSE){
        	$return  = array('Type'=> 'error', 'Message' =>validation_errors());
            $this->output->set_content_type('application/json')->set_output(json_encode($return));
        }else{

        	if ($this->bid->checkBidTimeOver()) {
        		
	        	$pro_id = post('property_id');
	        	$amount = post('amount');

	        	
	        	$checkpro = $this->bid->checkAlreadyBided($pro_id);
	        	if ($checkpro) {

	        		$data = array(
		        		'property_id' =>$pro_id , 
		        		'customer_id' => $this->session->userdata('c_id'),
		        		'amount'=>$amount,
		        		'date_time'=> date('Y-m-d H:i:s')
		        	);

	        		$where = array('bid_id'=>$checkpro->bid_id);
					$ret = 	$this->bid->updatebid($data,$where);

	        	}else{

	        	$data = array(
	        		'property_id' =>$pro_id , 
	        		'customer_id' => $this->session->userdata('c_id'),
	        		'amount'=>$amount,
	        		'date_time'=> date('Y-m-d H:i:s')
	        	);
				$ret = 	$this->bid->insertBid($data);

				}
				if($ret){
					$return  = array('n' =>'1','Type'=> 'Success', 'Message' =>'Bid Successfully Placed' ,'last_bid' =>$amount,'amount'=>$property->bid_difference + $amount);
					$this->output->set_content_type('application/json')->set_output(json_encode($return));
	        	}else{
	        		$return  = array('Type'=> 'error', 'Message' =>'Error in placing bid', );
	        		$this->output->set_content_type('application/json')->set_output(json_encode($return));
			    }
        	
        	}else{
        		$return  = array('Type'=> 'error', 'Message' =>'Bid time is over now', );
	        	$this->output->set_content_type('application/json')->set_output(json_encode($return));        	
        	}
        }
	}

	public function  getCustomerBids()
	{
		!is_login() ? redirect('index') :''; 
		if(!checkPackage(2)){
			exit;//redirect('index');
		}
		$data = array();
		$theme = $this->session->userdata('front_theme');
		$data['customerOtherBids'] =$this->bid->getCustomerBids();
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/bid/otherbid')) {
			$this->load->view('themes/' . $theme . '/template/bid/otherbid', $data);
		} else {
			$this->load->view('themes/default/template/bid/otherbid', $data);
		}	

	}

	public function  bidover_property($slug){
		$data = array();
		if ($slug) {
			$theme = $this->session->userdata('front_theme');
			$data['title'] = $this->setting->get('site_name');
			$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
			$data['meta_keywords'] = $this->setting->get('meta_keywords');
			$data['meta_titles'] = $this->setting->get('meta_titles');
			$data['property'] = $this->bid->getlastbidders($slug);
			
			if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/bid/bidwinners')) {
				$this->load->view('themes/' . $theme . '/template/bid/bidwinners', $data);
			} else {
				$this->load->view('themes/default/template/bid/bidwinners', $data);
			}	
		}else{
			redirect('index','refresh');
		}		

	}

	public function checkBidtimeov(){

		$return = $this->bid->checkbidtimeover();
		if($return){

			$this->output->set_content_type('application/json')->set_output(json_encode($return));
		}else{
			$ret = array('response'=>0);
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}
		
	}

	public function  property_show($slug){
		$data = array();
		if ($slug) {
			$theme = $this->session->userdata('front_theme');
			$data['title'] = $this->setting->get('site_name');
			$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
			$data['meta_keywords'] = $this->setting->get('meta_keywords');
			$data['meta_titles'] = $this->setting->get('meta_titles');
			$data['property'] = $this->bid->getlastbidders($slug);
			
			if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/bid/property-show')) {
				$this->load->view('themes/' . $theme . '/template/bid/property-show', $data);
			} else {
				$this->load->view('themes/default/template/bid/property-show', $data);
			}	
		}else{
			redirect('index','refresh');
		}		

	}	
	public function getlastbid(){
		$property_id = $this->input->get('property_id');
		$ret = $this->bid->getlastbids($property_id);
		//print_r($ret);die;
		if ($ret->amount) {
			$result  = array('last_bid' =>$ret->amount,'amount'=>$ret->bid_difference + $ret->amount);
		}else{
			$property = $this->bid->getPropertyDetails($property_id);
			$amount = $property->cost + $property->bid_difference;
			echo $amount;
			$result  = array('last_bid' =>$property->cost,'amount'=>$amount);
		}		
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	

	public function getLatestMembers(){
		$data  = array();
		$property_id = $this->input->get('property_id');
		$members= $this->bid->latestBid($property_id); 
		$data['members'] = $members;
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/bid/lates-members')) {
			$this->load->view('themes/' . $theme . '/template/bid/lates-members', $data);
		} else {
			$this->load->view('themes/default/template/bid/lates-members', $data);
		}	


	}

}	