<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Deals extends MX_Controller {



	public function __construct() {

		parent::__construct();

		$this->load->model('deals_models', 'deals');

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

		

		$base_url = "/deals/index?";

		$t = $this->input->get();

		unset($t['page']);

        $base_url .= http_build_query($t);

		

		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->deals->record_count());

		$data["pagination_helper"] = $this->pagination;

		$data["deals"] = $this->deals->fetch_data($perpage, (($page - 1) * $perpage));

		$data['deals_per'] = $this->deals->getdeal();

		

		$theme = $this->session->userdata('admin_theme');

		//load view

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/deal/index')) {

			$this->load->view('themes/' . $theme . '/template/deal/index', $data);

		} else {

			$this->load->view('themes/default/template/deal/index', $data);



		}

	}

	// add categories form page

	public function adddeal() {

		$data = array();

		$data['brands'] = $this->deals->getbrand();

		$data['categories'] = $this->deals->getcategory();

		$theme = $this->session->userdata('admin_theme');

		

		//load view

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/deal/add')) {

			$this->load->view('themes/' . $theme . '/template/deal/add', $data);

		} else {

			$this->load->view('themes/default/template/deal/add', $data);



		}



	}



	public function edit($id = '') {

		if ('' == $id) {

			redirect('carrers/index');

		}

		$data = array();

		$data['brands'] = $this->deals->getbrand();

		$data['categories'] = $this->deals->getcategory();

		$data['deals'] = $this->deals->getdealByid($id);

		$data['deals_par'] = $this->deals->getdeal();

		

		$theme = $this->session->userdata('admin_theme');

		//load view

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/deal/edit')) {

			$this->load->view('themes/' . $theme . '/template/deal/edit', $data);

		} else {

			$this->load->view('themes/default/template/deal/edit', $data);



		}

	}



	public function add() {

		$this->load->library('form_validation');

		$this->form_validation->set_rules('cat_id', 'category', 'required');

		$this->form_validation->set_rules('brand_id', 'brand', 'required');

		$this->form_validation->set_rules('title', 'title', 'required');

			$this->form_validation->set_rules('deal_url', 'url', 'required');

		

		if ($this->form_validation->run() == FALSE) {

				$this->session->set_flashdata('error', validation_errors());

				redirect('deals/adddeal/');

			} else {

		

			

				$data = array(

					'cat_id' => post('cat_id'),

					'brand_id'=>post('brand_id'),

					'title'=>post('title'),

					'deal_slug' =>$this->generatUnique(post('title')),

					

					'long_desc' => post('long_desc'),

					'orignal_price' => post('orignal_price'),

					'discount' => post('discount'),

					'total_price' => post('total_price'),

					'hotdeal' => post('hotdeal'),

					'deal_url' => post('deal_url'),				

				);



				$ret = $this->deals->insert($data);

				

				$upload_path =  $this->config->item('upload_path').'/dealsimages';



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

						$where = array('deal_id'=>$ret);

		        	 $this->deals->updateimages($data2,$where);

					}

				$this->session->set_flashdata('success', 'deals Added');

				redirect('deals');

				



			}

		

	}



	public function updatedeal() {

		$this->load->library('form_validation');

		$this->form_validation->set_rules('cat_id', 'category', 'required');

		$this->form_validation->set_rules('brand_id', 'brand', 'required');

		$this->form_validation->set_rules('title', 'title', 'required');

		$this->form_validation->set_rules('deal_url', 'url', 'required');

	

		

		

			if ($this->form_validation->run() == FALSE) {

				$this->session->set_flashdata('error', validation_errors());

				redirect('deals/edit/' . post('deal_id') . '');

			} else {

				$data = $this->input->post();

				$id  = $data['deal_id'];

				$this->deals->update($data);

				

	        	$upload_path =  $this->config->item('upload_path').'/dealsimages';



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

		        	$where = array('deal_id'=>$id);

		        	$ret = $this->deals->updateimages($data2,$where);

		        	

                }

	           

        		$this->session->set_flashdata('success', ' Successfully Updated');

        		redirect('deals');



			}

		

	}

	function delete($id) {



	$ret=$this->deals->delete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}



	function status($id){



		

		$ret = $this->deals->updatestatus($id);

		$this->output->set_content_type('application/json')->set_output(json_encode($ret));

		$this->session->set_flashdata('success', 'Update Successfully  ');

	}

	function generatUnique($string,$id=''){

		$this->load->helper('url');

		$string2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string);

		$slug =strtolower($string2);

		$slugrpc = str_replace(' ','-', $slug); // Replaces all spaces with hyphens.



		$last = preg_replace('/[^A-Za-z0-9\-]/',' ', $slugrpc); 

		$i = 1; $baseSlug = $last;



		if ($id=='') {

			while($this->exitcheck($last)){

				$last = $baseSlug.'-'.$i++;        

			}



			$mainstring =  $last;

			return url_title($mainstring);	

		}else{

			while($this->exitcheck($last,$id)){

				$last = $baseSlug.'-'.$i++;        

			}

			$mainstring =  $last;

			return url_title($mainstring);		

		}

	

	}

	public function exitcheck($deal,$id=''){

		if ($id) {

			$this->db->where('id !=',$id);

		}

		$this->db->where('deal_slug',$deal);

		$ret = $this->db->get('tbl_product_deal');

		$this->db->where('blog_slug',$deal);

		$ret = $this->db->get('tbl_blogs');



		if($ret->row()){

			return true;

		}else{

			return false;

		}

	}



}



/* End of file Categories.php */

/* categories: ./application/controllers/Categories.php */