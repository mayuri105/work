<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class bid_detail extends MX_Controller { 
	
	public function __construct() {
		parent::__construct();
		$this->load->model('bid_detail/biddetail_models', 'biddetail');

		if(!is_login()){
            $this->load->helper('url');
            $this->session->set_userdata('last_page', current_url());
            redirect('index'); 
        }else{

        } 
	}
	public function index() {
		
		
		$data = array();
		$theme = $this->session->userdata('front_theme');
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		$open_day  = $this->setting->get('open_day');
		$data['open_day'] = explode(',', $open_day);
       	
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/bid_detail/lbid_detail')) {
			$this->load->view('themes/' . $theme . '/template/bid_detail/lbid_detail', $data);
		} else {
			$this->load->view('themes/default/template/bid_detail/lbid_detail', $data);
		}
		
        

	}
public function getlivebid(){
		$data  = array();
		$allbid= $this->biddetail->allBid(); 
        $data['allbid'] = $allbid;
        $theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/bid_detail/bid_detail')) {
			$this->load->view('themes/' . $theme . '/template/bid_detail/bid_detail', $data);
		} else {
			$this->load->view('themes/default/template/bid_detail/bid_detail', $data);
		}	

    }
	
}