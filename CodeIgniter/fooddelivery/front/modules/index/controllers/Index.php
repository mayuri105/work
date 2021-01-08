<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MX_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('index_model', 'index');
		$this->load->model('cart/cart_model', 'cart_model');
		$this->load->library('cart');
		
	}

	public function index(){
		
		$data =array();
		$data['bodyclass'] ='page-home';
		$type = $this->getType();
		$theme = $this->session->userdata('front_theme');
		if($type=='food'){
       		$data['cuisine'] = $this->index->getcuisine();
       	}

       	$data['city'] = $this->index->getcityBycategory($type);
       	$data['citylist'] = $this->index->getcityBycategory($type);
       	$data['cuisinelist'] = $this->index->getcuisine();
       	$data['categories'] = $this->index->getcategory();
       	$data['type'] = $type;
       	$data['pickordelivery'] =$this->getpicOrdelopt();
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/index')) {
            $this->load->view('themes/' . $theme . '/template/common/index', $data);
        }else{
            $this->load->view('themes/default/template/common/index', $data);
        }
   	}
   	
   	

	public function food($cuisine='',$city='',$state=''){
		$data =array();
		$type = 'food';
		$data['bodyclass']= 'page-seotags seo-page';
		$data['pickordelivery'] =$this->getpicOrdelopt();
		$theme = $this->session->userdata('front_theme');
       	$data['cuisine'] = $this->index->getcuisine();
       	$data['city'] = $this->index->getcityBycategory($type);
       	$data['categories'] = $this->index->getcategory();
       	$ct = cleanstring($city);
		$state = cleanstring($state );
	    // For just food city and cusine data page
		$data['food_data'] = $this->index->getfoodinfo();
		$data['food_city'] = $this->index->getfoodcity($cuisine);
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/index/index')) {
        $this->load->view('themes/' . $theme . '/template/index/index', $data);
        }else{
            $this->load->view('themes/default/template/index/index', $data);
        }
		
	}

	public function category($type=''){

		$data =array();
		if($type){
			$userdata = array(
				'type'=>$type
			);
			$this->session->set_userdata($userdata);
		}
		$theme = $this->session->userdata('front_theme');
		$type = cleanstring($type);
		$data['bodyclass']= 'page-seotags seo-page';
		$data['category_data'] = $this->index->getcatbyname($type);
		$data['pickordelivery'] =$this->getpicOrdelopt();
       	$data['city'] = $this->index->getcityBycategory($type);
		if (file_exists(APPPATH . 'views/themes/'.$theme.'/template/index/category')) {
        	$this->load->view('themes/' . $theme . '/template/index/category', $data);
        }else{
            $this->load->view('themes/default/template/index/category', $data);
        }
	}
	public function cities($city='',$state='',$type='',$storename=''){
		$data =array();
		$theme = $this->session->userdata('front_theme');
		$ct = cleanstring($city);
		$state = cleanstring($state);
		$tp = cleanstring($type);
		if($type){
			$userdata = array(
				'type'=>$type
			);
			$this->session->set_userdata($userdata);
		}
		
		$data['categories'] = $this->index->getcategory();
		
		$data['pickordelivery'] =$this->getpicOrdelopt();
		$city_data = $this->index->getcitybyname($ct,$state);
       	$data['city_data'] = $city_data; 
       	$data['clearcart'] = 0;	
       	$data['bodyclass']= 'page-merchant restaurant active-tab-menu';	
       	$data['type'] = $this->session->userdata('type');
       	if($city_data){
			if($storename){

				$unique_alias = $storename;
				$store = $this->index->getproductByStoredetail($city_data->city_id,$unique_alias,$tp);
				$data['store_info'] =  $store; 
				
				// points multiplication value 
				$data['pointsvalue'] = $this->setting->get('redeem_points');
				// for other store clear cart if already data cart is created
				if ($this->setting->get('multiple_store_order')=='no'){
						if($this->session->userdata('store_id')){
						$store_id =$this->session->userdata('store_id');
						if($store->store_data->store_id != $store_id){
							if($this->cart->contents()){
								$data['minorder'] = $this->index->getminOrder($store_id);
								$data['clearcart'] = 1;
							}
						}
					}
				}
				// end of store clear cart code.
	       		$data['date_time_detail'] =$this->getDatetime();
	       		$data['date_time_detail_laundry'] =$this->getDatetimeLaundry();
	       		$data['pickordelivery'] =$this->getpicOrdelopt();
	       		$data['times'] = $this->getTimesArray($store->store_data->time_from,$store->store_data->time_to);
	       		$data['timesForLaundry'] = $this->getTimesArrayForLaundry($store->store_data->time_from,$store->store_data->time_to);
	       		$data['store_review_cust'] = $this->index->store_review_cust($store->store_data->store_id);
				if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/store')) {
	            $this->load->view('themes/' . $theme . '/template/store/store', $data);
		        }else{
		            $this->load->view('themes/default/template/store/store', $data);
		        }
				

	       	}else{
	       		
	       		$data['totalstore'] = $this->index->num_stores($city_data->city_id,$tp);
	       		$data['offset'] = '0';
	       			
	       		$data['store_list'] = $this->index->getstorebycity($city_data->city_id,$tp);
	       		$countCuisine =$this->index->totaldata();
	       		$data['cities_data'] = $this->index->getcityBystate($state);
	       		$data['cuisine_data'] = $this->index->getcuisine('0',$countCuisine->cusine_data);
	       		$data['bodyclass']= 'page-merchants seo-page';
	       		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/index/list')) {
	            $this->load->view('themes/' . $theme . '/template/index/list', $data);
		        }else{
		            $this->load->view('themes/default/template/index/list', $data);
		        }
	       	}
	       	
	    }else{
	    	show_404();
	    }
	}
	public function loadmorestore($city_id,$type,$offset){
		$theme = $this->session->userdata('front_theme');
		$city_data = $this->index->getCityByid($city_id);
		$data['type'] = $type;
       	$data['city_data'] = $city_data; 
		$data['store_list'] =$this->index->getstorebycity($city_id,$type,$offset);
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/index/loadstore')) {
			$this->load->view('themes/' . $theme . '/template/index/loadstore', $data);
		}else{
			$this->load->view('themes/default/template/index/loadstore', $data);
		}
		
	}	

	public function searchprduct()
		{
			$store_id = post('store_id');
			$search = post('search');
			if(empty($search)){
				exit;
			}
			$data['store_info'] =  $this->index->getproductBySearch($store_id,$search);
	        $theme = $this->session->userdata('front_theme');
			//load view 
			if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/searchresult')) {
				$this->load->view('themes/' . $theme . '/template/store/searchresult',$data);
			}else{
				$this->load->view('themes/default/template/store/searchresult',$data);
			}
		}
	public function updateDatetime(){
		$result = array(
			'date'=>date('l m/d/Y',strtotime(post('date'))),
			'time'=>date('g:i a',strtotime(post('time'))),
		);
		$this->session->set_userdata($result);
	 	echo json_encode($result);
		
	}

	public function updateDatetimeLaundry(){

		$result = array(
			'pickupdate'=>date('l m/d/Y',strtotime(post('pickupdate'))),
			'pickuptime'=>date('g:i a',strtotime(post('pickuptime'))),
			'date'=>date('l m/d/Y',strtotime(post('deliverydate'))),
			'time'=>date('g:i a',strtotime(post('deliverytime'))),
		);
		$this->session->set_userdata($result);

	 	echo json_encode($result);
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
	public function setOptiondelorpic(){
		
		if(post('pickordelivery')=='true'){
			$data = 'pickup';
		}else{
			$data = 'delivery';
		}

		$result = array(
			'pickordelivery'=>$data
		);
		$this->session->set_userdata($result);
	 	echo json_encode($result);
	}
	public function getpicOrdelopt(){
		if($this->session->userdata('pickordelivery')){
			$data = array(
				'pickordelivery'=>$this->session->userdata('pickordelivery'),
			);
			return $data['pickordelivery'];
		}else{
			$data = array(
				'pickordelivery'=>'delivery'
			);
			return $data['pickordelivery'];
		}
	}
	public function getDatetime(){
		if($this->session->userdata('date') && $this->session->userdata('time')){
			$data = array(
				'date'=>date('Y-m-d',strtotime($this->session->userdata('date'))),
				'time'=>date('H:i:s',strtotime($this->session->userdata('time'))),
			);
			return $data;
		}
	}

	

	public function setType(){
		$type  = post('type');	
		$userdata = array(
			'type'=>$type
		);
		$this->session->set_userdata($userdata);
		
		$theme = $this->session->userdata('front_theme');
		if($type=='food'){
       		$data['cuisine'] = $this->index->getcuisine();
       	}

       	$data['city'] = $this->index->getcityBycategory($type);
       	$data['citylist'] = $this->index->getcityBycategory($type);
       	$data['cuisinelist'] = $this->index->getcuisine();
       	$data['categories'] = $this->index->getcategory();
       	$data['type'] = $type;
       	$data['pickordelivery'] =$this->getpicOrdelopt();
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/cat-result')) {
            $this->load->view('themes/' . $theme . '/template/common/cat-result', $data);
        }else{
            $this->load->view('themes/default/template/common/cat-result', $data);
        }

	}
	public function getType(){
   		if(!$this->session->userdata('type'))
		{
			$userdata = array(
				'type'=>'food'
			);
			$this->session->set_userdata($userdata);
			return $this->session->userdata('type');
		}else{
			return $this->session->userdata('type');
		}
   	}
   	public function clearCart(){
   		if (post('is_post')) {
   			$ret = $this->cart->destroy();
	   		echo $ret;
	   		exit;
   		}else{
   			exit;
   		}
   		
   	}
   	public function share(){
   		$ref_code = $this->input->get('code');
   		if($ref_code){
   			$ret = $this->index->getCustomerByRef($ref_code);
   			if ($ret) {
				$this->session->set_userdata('ref_code',$ret->c_id);
   				redirect('account/register/?sharer='.$ref_code.'');
			}else{
				redirect('/');
			}
   			
   		}else{
   			redirect('/');
   		}
   	}
   	public function checkloginForcheckout(){
		$is_login = $this->session->userdata('is_login');
		if(post('is_ajax')){
		 	if($is_login){

		 		$data = array('store_id'=>post('store_id'));
		 		$this->session->set_userdata($data);
		 		
			 	$result = array('response'=>$is_login);
			 	echo json_encode($result);
			 }else{
			 	$result = array('response'=>'0');
			 	echo json_encode($result);
			 }
		}else{
			exit();
		}
	}

	public function getTimesArray($time_from,$time_to)
	{
		$times = create_time_range($time_from, $time_to, '15 mins'); 
		$dateoftoday = date('g:i a');
		$s='00:00:00'; 
		$sp = date("g:i a", strtotime($s));
		$removetimes = create_time_range($sp,$dateoftoday,'15 mins'); 
		foreach ($removetimes as $key => $t) { 
		    $removetimes[$key] = date('g:i a', $t); 
		}
	  	foreach ($times as $key => $time) { 
	  		$times[$key] = date('g:i a', $time); 
		}
		$lastArray = array_diff($times,$removetimes);
		return $lastArray;

	}
	public function getTimesArrayForLaundry($time_from,$time_to)
	{
		$times = create_time_range($time_from, $time_to, '60 mins'); 
		
	  	foreach ($times as $key => $time) { 
	  		$times[$key] = date('g:i a', $time); 
		}
		
		return $times;
	}

	public function get_timeperiods(){
		if(post('is_ajax')) {
			$store_id = post('store_id');
			$dater =date('Y-m-d ',strtotime(post('date')));
			$store_time = $this->index->getstoreDataByid($store_id);
			$period = $store_time->delivery_periods;
			$dayarray = array(
				'monday' => $store_time->monday, 
				'tuesday' => $store_time->tuesday, 
				'wednesday' => $store_time->wednesday, 
				'thursday' => $store_time->thursday, 
				'friday' => $store_time->friday, 
				'saturday' => $store_time->saturday, 
				'sunday' => $store_time->sunday, 
			);
			$day = strtolower(date("l"));
			$daycheck = $dayarray[$day];
			$nextupd = $store_time->delivery_periods + 7;
			$start        = new DateTime(date('Y-m-d H:i:s', strtotime($dater. ' + '.$store_time->delivery_periods.'days')));
			$end 	      = new DateTime(date('Y-m-d H:i:s',strtotime($dater.'+'.$nextupd.'day')));
			$interval     = new DateInterval('P1D');
			$pickuptime   = new DatePeriod($start, $interval, $end);
			$ans = array();
			foreach ($pickuptime as $dt){
				$dayc =  strtolower($dt->format("l"));
				if ($dayarray[$dayc]) {
						$ans[] = $dt->format("l M-d-y");
				}
			}
			echo json_encode($ans);
			
		}
	}
	public function getProductByCategory(){
		$cat_id   	= post('cat_id');
		$store_id 	= post('store_id');
		$is_ajax 	= post('is_ajax');
		if ($is_ajax) {

			$data['product'] = $this->index->getproductdata($cat_id);
			$store = $this->index->getProductBycategory($store_id);
			$data['store_info'] =  $store; 
			$category_data = $this->index->getCategoryData($cat_id);
	        $data['category_data'] = $category_data;
	        $data['category_parent'] = $this->index->getCategoryData($category_data->parent_category);
	        $theme = $this->session->userdata('front_theme');
			//load view 
			if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/store-menu')) {
				$this->load->view('themes/' . $theme . '/template/store/store-menu',$data);
			}else{
				$this->load->view('themes/default/template/store/store-menu',$data);
			}
		}
	}
	public function getSubcategoryByCategory(){
		$cat_id   	= post('cat_id');
		$store_id 	= post('store_id');
		$is_ajax 	= post('is_ajax');
		if ($is_ajax) {
				
				$data['subcategory'] = $this->index->getSubCategoryData($cat_id);
				$store = $this->index->getProductBycategory($store_id);
				$data['store_info'] =  $store; 
		        $data['category_data'] = $this->index->getCategoryData($cat_id);

		        $theme = $this->session->userdata('front_theme');
				//load view 
				if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/store-subcategory')) {
					$this->load->view('themes/' . $theme . '/template/store/store-subcategory',$data);
				}else{
					$this->load->view('themes/default/template/store/store-subcategory',$data);
				}
		}
	}
	public function getCategoryOnProduct(){

			$store_id   	= post('store_id');
			$is_ajax 	= post('is_ajax');
			if ($is_ajax) {
				$store = $this->index->getProductBycategory($store_id);
				$data['store_info'] =  $store; 
		        $theme = $this->session->userdata('front_theme');
				//load view 
				if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/store-category')) {
					$this->load->view('themes/' . $theme . '/template/store/store-category',$data);
				}else{
					$this->load->view('themes/default/template/store/store-category',$data);
				}
			}
	}


	public function addReview(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('review', 'Review', 'required');
		$this->form_validation->set_rules('customer_id', 'customer_id', 'required');
		$this->form_validation->set_rules('score', 'Review Rating', 'required');
		
        if ($this->form_validation->run() == FALSE){
           
            $response = array('res'=> validation_errors(),'code'=>'0');
            echo json_encode($response);
	    }else{
				$data= array(
					'review'=>post('review'),
	        		'review_by'=>post('customer_id'),
	        		'review_on	'=>date('Y-m-d H:i:s'),
	        		'review_rating'=>post('score'),
	        		'store_id'=>post('store_id'),
        		);	
        	$ret = $this->index->inserReview($data);
	        if($ret){
	        	$response = array('res'=> 'Review Under approval','code'=>'1');
            	echo json_encode($response);
			}else{
				$response = array('res'=> "Error in adding Review",'code'=>'0');
            	echo json_encode($response);
			}
        }
	 		
	}
	public function delivery_points(){
		$data =array();
		$this->load->model('account/account_model', 'account');
		$data['bodyclass'] ='page-points';	
		$data['points'] = $this->account->getTotalEarnpoints();
		$data['points50'] =$this->account->getbucketBypoint();
		
		$theme = $this->session->userdata('front_theme');
		$data['pointValue']  = $this->setting->get('redeem_points');
       
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/points')) {
            $this->load->view('themes/' . $theme . '/template/account/points', $data);
        }else{
            $this->load->view('themes/default/template/account/points', $data);
        }
	}

}	

/* End of file index.php */
/* Location: ./application/controllers/index.php */ 
