<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cat_model', 'cat');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->helper('form');
	}

	// main page
	public function index()
	{

		$perpage = $this->setting->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		$base_url = "/category/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);

		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->cat->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["categories"] = $this->cat->fetch_data($perpage ,(($page-1) * $perpage));
        //$data["scategories"] = $this->cat->get_categories();

	//print_r($data);die;
        //$data['list'] = $this->cat->getFullListFromDB();
        //print_r($data['list']);die;
        $theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/category/index')) {
			$this->load->view('themes/' . $theme . '/template/category/index', $data);
		} else {
			$this->load->view('themes/default/template/category/index', $data);

		}

	}
	// add page
	public function add()
	{

		$data = array();
		$data['categories'] = $this->cat->get_category_by_shop();
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/category/add')) {
			$this->load->view('themes/' . $theme . '/template/category/add', $data);
		} else {
			$this->load->view('themes/default/template/category/add', $data);

		}

	}
	// edit page
	public function edit($id='')
	{
		if($id=='') redirect('category');

		$data = array();
		$data['cate'] = $this->cat->get($id);
        $data['categories'] = $this->cat->get_category_by_shop();
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/category/edit')) {
			$this->load->view('themes/' . $theme . '/template/category/edit', $data);
		} else {
			$this->load->view('themes/default/template/category/edit', $data);

		}

	}

	public function addcategory(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('categoryn', 'category ', 'required');
		$mid = $this->session->userdata('m_id');
       $shopdata= $this->cat->getshopbymer($mid);
				$shop_id = $shopdata->shop_id;
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('category/add');
	        }else{

                   	$data= array(
		        		'category'=>post('categoryn'),
	        		'parent_category'=>post('parent_category'),
		        	'tax_rate'=>post('tax_rate'),
					'market_comm_rate'=>post('market_comm_rate'),

		        	);
		        	$ret = $this->cat->insert($data);
		        	$this->session->set_flashdata('success','category Added');
	        		redirect('category');


	        }



	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('category', 'category', 'required');



			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('category/edit/' . post('cat_id') . '');
			} else {
				//$mid = $this->session->userdata('m_id');
      // $shopdata= $this->cat->getshopbymer($mid);
				//	$shop_id = $shopdata->shop_id;
				$data= array(
		        		'category'=>post('category'),
	        		    'parent_category'=>post('parent_category'),
						'tax_rate'=>post('tax_rate'),
					    'market_comm_rate'=>post('market_comm_rate'),



		        	);
		        	$where = array('cat_id'=>post('cat_id'));
		        	$ret = $this->cat->update($data,$where);

                	$this->session->set_flashdata('success', 'category Updated');
					redirect('category');
                }

			}




function catdelete($id) {

	$ret=$this->cat->catdelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}


}

/* End of file category.php */
/* Location: ./application/controllers/category.php */