<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Index extends MX_Controller {

	public function __construct() {
		parent::__construct();		
		$this->load->model('index_model', 'index');
	}
	public function index() {
		$data = array();
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		$data['title'] = $this->setting->get('site_name');

		$data['datetimebid'] = $this->index->nextbidtime();
		
		$data['properties'] = $this->index->getBidProperty();
		$data['upproperties'] = $this->index->getupBidProperty();
		
		$data['endprop'] = $this->index->getbidended();
		$data['todaysbidpro'] = $this->index->todaysbidpro();

		 $data['bid_dates']= $this->index->getBidDates();
$data['sidebar_ads'] = $this->setting->get('sidebar_ads');
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/bid')) {
			$this->load->view('themes/' . $theme . '/template/common/bid', $data);
		} else {
			$this->load->view('themes/default/template/common/bid', $data);
		}
	}
	
	public function last_10_sold(){
		$data = array();
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		$data['title'] = $this->setting->get('site_name');

		$data['properties'] = $this->index->getSoldProperty();
		
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/property/last-sold')) {
			$this->load->view('themes/' . $theme . '/template/property/last-sold', $data);
		} else {
			$this->load->view('themes/default/template/property/last-sold', $data);
		}

	}
	public function last_10_rent(){
		$data = array();
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		$data['title'] = $this->setting->get('site_name');

		$data['properties'] = $this->index->getRentProperty();
		
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/property/last-rent')) {
			$this->load->view('themes/' . $theme . '/template/property/last-rent', $data);
		} else {
			$this->load->view('themes/default/template/property/last-rent', $data);
		}

	}

	public function  last_10_bid_winners()
	{
		$data = array();
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		$data['title'] = $this->setting->get('site_name');
		$data['properties'] = $this->index->getRentProperty();
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/property/last-sold')) {
			$this->load->view('themes/' . $theme . '/template/property/last-sold', $data);
		} else {
			$this->load->view('themes/default/template/property/last-sold', $data);
		}
	}

	public function terms_and_conditions(){
		$data = array();
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		$data['company_name'] = $this->setting->get('company_name');
		$data['address'] = $this->setting->get('address');
		$data['phone'] = $this->setting->get('phone');
		$data['email_address'] = $this->setting->get('email_address');
		$data['facebook'] = $this->setting->get('facebook');
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/terms-and-conditions')) {
            $this->load->view('themes/' . $theme . '/template/page/terms-and-conditions', $data);
        }else{
            $this->load->view('themes/default/template/page/terms-and-conditions', $data);
        }	

	}

	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */


// 