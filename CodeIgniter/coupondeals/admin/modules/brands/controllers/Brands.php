<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Brands extends MX_Controller {



	public function __construct() {

		parent::__construct();

		$this->load->model('brands_models', 'brands');

		$this->load->library('pagination');

		$this->load->library('paginationlib');

		$this->load->helper('form');

		$this->load->helper('url');

	}



	public function index() {

		$data = array();

		$perpage = $this->setting->get('per_page');

		

		if($this->input->get('page'))	{

			$page = $this->input->get('page');

		}else{

			$page=1;

		}

		

		$base_url = "/brands/index?";

		$t = $this->input->get();

		unset($t['page']);

        $base_url .= http_build_query($t);

		

		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->brands->record_count());

		$data["pagination_helper"] = $this->pagination;

		$data["brands"] = $this->brands->fetch_data($perpage, (($page - 1) * $perpage));

		$data['brands_par'] = $this->brands->getBrand();

		

		$theme = $this->session->userdata('admin_theme');

		//load view

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/brand/index')) {

			$this->load->view('themes/' . $theme . '/template/brand/index', $data);

		} else {

			$this->load->view('themes/default/template/brand/index', $data);



		}

	}

	// add categories form page

	public function addbrands() {

		$data = array();



		$theme = $this->session->userdata('admin_theme');

		$data['categories_par'] = $this->brands->getBrand();

		

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/brand/add')) {

			$this->load->view('themes/' . $theme . '/template/brand/add', $data);

		} else {

			$this->load->view('themes/default/template/brand/add', $data);



		}



	}

	// edit categories form page

	public function edit($id = '') {

		if ('' == $id) {

			redirect('brands');

		}

		$data = array();

		$data['brands'] = $this->brands->getbrandByid($id);

		$data['brands_par'] = $this->brands->getBrand();

		

		$theme = $this->session->userdata('admin_theme');

		//load view

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/brand/edit')) {

			$this->load->view('themes/' . $theme . '/template/brand/edit', $data);

		} else {

			$this->load->view('themes/default/template/brand/edit', $data);



		}

	}



	public function add() {

		$this->load->library('form_validation');

		$this->form_validation->set_rules('brand_name', 'name', 'required');

		



		

			if ($this->form_validation->run() == FALSE) {

				$this->session->set_flashdata('error', validation_errors());

				redirect('brands/addbrands');

			} else {

				$data = array(

					'brand_name' => post('brand_name'),

					'brand_link' => post('brand_link'),

					'feature' => post('feature'),

					



				);



				$ret = $this->brands->insert($data);

				$upload_path =  $this->config->item('upload_path').'/brandsimages';



	            if (!file_exists($upload_path)) {

				    mkdir($upload_path, 0777, true);

				}

	            $c_upload['upload_path']    =  $upload_path;

	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';

	            $this->load->library('upload', $c_upload);

					if ($this->upload->do_upload('img_name')) {

						$image = $this->upload->data();



						$data2= array(

						'img_name'=>$image['file_name'],



						);	

						$where = array('brand_id'=>$ret);

		        	 $this->brands->updateimages($data2,$where);

					}

				$this->session->set_flashdata('success', 'brands Added');

				redirect('brands');

				

				

				

		}

			

		

	}



	

	public function updatebrand() {

		$this->load->library('form_validation');

		$this->form_validation->set_rules('brand_name', 'name', 'required');

		//$this->form_validation->set_rules('img_name', 'Image ', 'required');

		

		

			if ($this->form_validation->run() == FALSE) {

				$this->session->set_flashdata('error', validation_errors());

				redirect('brands/edit/' . post('brand_id') . '');

			} else {

				$data = $this->input->post();

				$id  = $data['brand_id'];

				$this->brands->update($data);

				

	        	$upload_path =  $this->config->item('upload_path').'/brandsimages';



	            if (!file_exists($upload_path)) {

				    mkdir($upload_path, 0777, true);

				}

	            $c_upload['upload_path']    =  $upload_path;

	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';

	            $this->load->library('upload', $c_upload);

	        	if ($this->upload->do_upload('img_name')) {

                    $image = $this->upload->data();

                   	$data2= array(

		        		'img_name'=>$image['file_name'],

		        		

		        	);	

		        	$where = array('brand_id'=>$id);

		        	$ret = $this->brands->updateimages($data2,$where);

		        	

                }

	           

        		$this->session->set_flashdata('success', ' Successfully Updated');

        		redirect('brands');



			}

		

	}

			

	function delete($id) {



	$ret=$this->brands->delete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}



	

}



/* End of file Categories.php */

/* categories: ./application/controllers/Categories.php */