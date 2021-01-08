<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('index/index_model', 'index');
		$this->load->model('search_model', 'search');
	}

	public function index()
	{	
		$data = array();
		$address = array(
			'address'=>array(
				'street_number'=>$this->input->get('street_number'),
				'city'=>$this->input->get('city'),
				'state'=>$this->input->get('state'),
				'zip'=>$this->input->get('zip'),
			)
		);
		
		$this->session->set_userdata($address);

		$data['bodyclass'] ='page-merchants';
		$theme = $this->session->userdata('front_theme');
		$ct = cleanstring($this->input->get('city'));
		$state = cleanstring($this->input->get('state'));
		$zip = cleanstring($this->input->get('zip'));
		$store_street = cleanstring($this->input->get('street_number'));
		


		$type  = cleanstring($this->input->get('type'));
		$keyword =  cleanstring($this->input->get('keyword'));
		if($type){
			$userdata = array(
			'type'=>$type
			);
			$this->session->set_userdata($userdata);
		}
		$cusine = $this->input->get('cusine');
		$city_data = $this->search->getcitybyname($ct,$state);
		$countCuisine =$this->index->totaldata();

		$data['store_street'] = $this->input->get('store_street');
		$data['ct'] = $this->input->get('city');
		$data['state'] = $this->input->get('state');
		$data['zip'] = $this->input->get('zip');
		$data['cusine'] = $this->input->get('cusine');
		$data['rating'] = $this->input->get('rat');
		$data['min'] = $this->input->get('min');
		$data['type'] =$this->session->userdata('type');


       	$data['city_data'] = $city_data;
       	$data['cities_data'] = $this->search->getcityBystate($state);
   		$data['cuisine_data'] = $this->index->getcuisine('0',$countCuisine->cusine_data);
   		$data['get']  = $this->input->get();
       	if(!empty($city_data)){
       		$address = $this->session->userdata('address');

       		$data['address']= $address; 
       		$orderby = $this->getOrderby();
       		$data['orderby'] = $orderby;
       		$data['totalstore'] = $this->search->gettotalstore($store_street,$ct,$state,$zip,$type,$cusine,$orderby);
       		$data['offset'] = '0';
			$data['store_list'] = $this->search->getstores($store_street,$ct,$state,$zip,$type,$cusine,$orderby);

			if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/search/index')) {

            $this->load->view('themes/' . $theme . '/template/search/index', $data);
	        }else{
	            $this->load->view('themes/default/template/search/index', $data);
	        }
		}else{
			if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/search/notfoundaddress')) {

            $this->load->view('themes/' . $theme . '/template/search/notfoundaddress', $data);
	        }else{
	            $this->load->view('themes/default/template/search/notfoundaddress', $data);
	        }
		}

		
	}

	public function setOrderby(){
		$orderby  = post('orderby');	
		$userdata = array(
			'orderby'=>$orderby
		);
		$this->session->set_userdata($userdata);
		return $userdata;
	}
	public function getOrderby(){
		if($this->session->userdata('orderby')){
			return $this->session->userdata('orderby');
		}else{
			return 'rating';
		}
	}

	public function clearfilter($arg){
		$get = $this->input->get();
		unset($get[$arg]);
		$query = http_build_query($get);
		$base = site_url('search/').'?'.$query;
		redirect($base);
	}
	public function loadmorestore(){
		$theme = $this->session->userdata('front_theme');
		
		$street_number = $this->input->get('street_number');
		

		$ct = $this->input->get('ct');
		
		$state = $this->input->get('state');
		$zip = $this->input->get('zip');
		$type = $this->input->get('type');
		$offset = $this->input->get('offset');
		$cusine = $this->input->get('cusine');
		$orderby = $this->input->get('orderby');
			

		$data['store_list'] = $this->search->getstores($street_number,$ct,$state,$zip,$type,$cusine,$orderby,$offset);
		$data['type'] = $type;
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/search/nextresult')) {
			$this->load->view('themes/' . $theme . '/template/search/nextresult', $data);
		}else{
			$this->load->view('themes/default/template/search/nextresult', $data);
		}
		
	}	
}

/* End of file Search.php */
/* Location: ./application/controllers/Search.php */ ?>