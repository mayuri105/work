<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Rent_sale extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('rent_sale_model', 'rent_sale');
		
	}
	public function index(){

		$data = array();
		$theme = $this->session->userdata('front_theme');
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		$data['testimonial'] = $this->rent_sale->getTestimonial();
		$data['user'] = getActiveCustomerInfo();
		$data['clients'] = $this->rent_sale->getClientImages();
		$data['property'] = $this->rent_sale->getProperty();
		$data['loc'] = $this->rent_sale->getLocation();
		$data['types'] = $this->rent_sale->getType();
		$data['sliderpro'] = $this->rent_sale->sliderproperty();
			
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/rent-sale/index')) {
			$this->load->view('themes/' . $theme . '/template/rent-sale/index', $data);
		} else {
			$this->load->view('themes/default/template/rent-sale/index', $data);
		}

	}

	public function search($page=1){
		$data = array();
		$theme = $this->session->userdata('front_theme');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->model('index/index_model', 'index');
		
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');

		$config = array();
		$config["base_url"] = base_url() . "rent-sale/search/";
		$config["total_rows"] = $this->rent_sale->recrdTotProp();
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
		$data["properties"] = $this->rent_sale->getProperties($config["per_page"], (($page - 1) * $config["per_page"]));
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
		
		$data['loc'] = $this->rent_sale->getLocation();
		$data['types'] = $this->rent_sale->getType();
			
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/rent-sale/search')) {
			$this->load->view('themes/' . $theme . '/template/rent-sale/search', $data);
		} else {
			$this->load->view('themes/default/template/rent-sale/search', $data);
		}
	}

	public function property($slug){
		if(!checkPackage(1)){
			redirect('index');
		}
		if ($slug) {
			$data = array();
			$theme = $this->session->userdata('front_theme');
			$data['title'] = $this->setting->get('site_name');
			$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
			$data['meta_keywords'] = $this->setting->get('meta_keywords');
			$data['meta_titles'] = $this->setting->get('meta_titles');

			$data['property'] = $this->rent_sale->getPropertyBySlug($slug);
			if(!$data['property']){
				show_404();
			}
			$data['loc'] = $this->rent_sale->getLocation();
			$data['type'] = $this->rent_sale->getType();
				
			$data['feature_property'] =  $this->rent_sale->getProperty();
			//
			
			if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/rent-sale/property')) {
				$this->load->view('themes/' . $theme . '/template/rent-sale/property', $data);
			} else {
				$this->load->view('themes/default/template/rent-sale/property', $data);
			}	
		}else{
			redirect('index','refresh');
		}
	}


}