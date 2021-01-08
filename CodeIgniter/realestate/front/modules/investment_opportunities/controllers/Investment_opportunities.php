<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Investment_opportunities extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('investment_models', 'investment');
		
	}
	public function index(){

		$data = array();
		$theme = $this->session->userdata('front_theme');
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		$data['testimonial'] = $this->investment->getTestimonial();
		$data['user'] = getActiveCustomerInfo();
		$data['clients'] = $this->investment->getClientImages();
		$data['property'] = $this->investment->getProperty();
		$data['loc'] = $this->investment->getLocation();
		$data['type'] = $this->investment->getType();
		$data['sliderpro'] = $this->investment->sliderproperty();
			
		//
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/investment-opportunities/index')) {
			$this->load->view('themes/' . $theme . '/template/investment-opportunities/index', $data);
		} else {
			$this->load->view('themes/default/template/investment-opportunities/index', $data);
		}

	}

	public function search($page=1){
		$data = array();
		$theme = $this->session->userdata('front_theme');
		$this->load->library('pagination');
		
		$this->load->model('index/index_model', 'index');
		
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');

		$config = array();
		$config["base_url"] = base_url() . "investment-opportunities/search/";
		$config["total_rows"] = $this->investment->recrdTotProp();
		$config["per_page"] = 12;
		$config['use_page_numbers']  = true;
		$config['full_tag_open'] = '<div class="pagination pagination-centered"><ul class="page_test">'; 
		$config['full_tag_close'] = '</ul></div><!--pagination-->';
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li ><a href="" class="active">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$data['page'] = $page;
		$data["properties"] = $this->investment->getProperties($config["per_page"], (($page - 1) * $config["per_page"]));
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );
		$data['keyword'] = $this->input->get('keyword');
		$data['area'] = $this->input->get('area');
		$data['type']= $this->input->get('type');
		$data['actions'] = $this->input->get('actions');
		$data['status'] = $this->input->get('status');
		$data['min_price'] = $this->input->get('min-price');
		$data['max_price']= $this->input->get('max-price');
		$data['min_area'] = $this->input->get('min-area');
		$data['max_area']= $this->input->get('max-area');
		$data['loc'] = $this->index->getLocation();
		$data['type'] = $this->investment->getType();
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/investment-opportunities/search')) {
			$this->load->view('themes/' . $theme . '/template/investment-opportunities/search', $data);
		} else {
			$this->load->view('themes/default/template/investment-opportunities/search', $data);
		}
	}
	public function property($slug){
		if(!checkPackage(3)){
			redirect('index');
		}
		if ($slug) {
			$data = array();
			$theme = $this->session->userdata('front_theme');
			$data['title'] = $this->setting->get('site_name');
			$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
			$data['meta_keywords'] = $this->setting->get('meta_keywords');
			$data['meta_titles'] = $this->setting->get('meta_titles');

			$data['property'] = $this->investment->getPropertyBySlug($slug);
			if(!$data['property']){
				show_404();
			}
			$data['loc'] = $this->investment->getLocation();
			$data['types'] = $this->investment->getType();
				
			$data['feature_property'] =  $this->investment->getProperty();
			//
			
			if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/investment-opportunities/property')) {
				$this->load->view('themes/' . $theme . '/template/investment-opportunities/property', $data);
			} else {
				$this->load->view('themes/default/template/investment-opportunities/property', $data);
			}	
		}else{
			redirect('index','refresh');
		}
	}

}