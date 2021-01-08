<?php if (!defined('BASEPATH')) {

	exit('No direct script access allowed');

}



class Home extends MX_Controller {



	public function __construct() {

		parent::__construct();		

		$this->load->model('index_model', 'index');

		$this->load->helper('date');

			$this->load->helper('url');

		$this->load->library('Pagination');

		$this->load->library('Paginationlib');

		

	}

	public function index() {

		$perpage = $this->setting->get('dealper_page');

		

		if($this->input->get('page'))	{

			$page = $this->input->get('page');

		}else{

			$page=1;

		}

		

		$base_url = "/home?";

		$t = $this->input->get();

		unset($t['page']);

        $base_url .= http_build_query($t);

		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->index->record_count());

		$data = array();

        $data["pagination_helper"]   = $this->pagination;

		//print_r($data["pagination_helper"]);

        $data['category'] = $this->input->get('category');

        $data['category_search'] = $this->input->get('category_search');

        

        

		$data["alldeal"] = $this->index->fetch_data($perpage ,(($page-1) * $perpage));

		//$data = array();

		//$data['alldeal']= $this->index->getdeal();

		$data['allpopulardeal']= $this->index->getpopulardeal();

		$data['allfeaturebrands']= $this->index->getfeaturebrand();

		$data['categories']= $this->index->getcategory();

		$theme = $this->session->userdata('front_theme');

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/home/home')) {

			$this->load->view('themes/' . $theme . '/template/home/home',$data);

		} else {

			$this->load->view('themes/default/template/home/home',$data);

		}

	}

	

	

	public function show($slug)

	{

		

		

		$page = $this->index->getdealbyurl($slug);	

		if(empty($page)){

			redirect('/','refresh');

		}

		$data =array();

		$data['deals'] =  $this->index->getdealbyurl($slug);

		

		$theme = $this->session->userdata('front_theme');

        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/deal/deal-view')) {

            $this->load->view('themes/' . $theme . '/template/deal/deal-view', $data);

        }else{

            $this->load->view('themes/default/template/deal/deal-view', $data);

        }	



	}

		public function dealbrand($id)

	{

		

		

		

		$data =array();

		$data['dealsbrand'] =  $this->index->getdealbrand($id);

		

		$theme = $this->session->userdata('front_theme');

        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/deal/brand-deal')) {

            $this->load->view('themes/' . $theme . '/template/deal/brand-deal', $data);

        }else{

            $this->load->view('themes/default/template/deal/brand-deal', $data);

        }	



	}

}



/* End of file index.php */

/* Location: ./application/controllers/index.php */





// 