<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('store_model', 'store');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->helper('form');


	}


	public function index()
	{



		$data = array();

		$data['shop'] = $this->store->getstorebyid();

		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/edit')) {
			$this->load->view('themes/' . $theme . '/template/store/edit', $data);
		} else {
			$this->load->view('themes/default/template/store/edit', $data);

		}
	}


	public function updatestore(){

			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('shop_name', 'Shop Name', 'required');


			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('store');
			}else{
				$store_uniquename = $this->generatUnique(post('shop_name'),post('shop_id'));


				$upload_path =  $this->config->item('upload_path').'/shop';

				if (!file_exists($upload_path)) {
					mkdir($upload_path, 0777, true);
				}
				$c_upload['upload_path']    =  $upload_path;
				$c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
				$this->load->library('upload', $c_upload);


				$image1 = 0;
				$image2 = 0;
				if($this->upload->do_upload('fileinput')){
					$image1 = $this->upload->data();
					$where =  array('shop_id'=>post('shop_id'));
					$data = array(
						'shop_logo'=>$image1['file_name']
					);
					$ret = $this->store->update($data,$where);
				}
				if($this->upload->do_upload('fileinput2')){
					$image2 = $this->upload->data();

					$where =  array('shop_id'=>post('shop_id'));
					$data = array(
						'footer_logo'=>$image2['file_name']
					);
					$ret = $this->store->update($data,$where);
				}

				$data= array(
					'shop_name'=>post('shop_name'),
					'about_shop'=>post('about_shop'),
					'tagline'=>post('tagline'),
					'domain_name'=> $store_uniquename,
					'shop_phone'=>post('shop_phone')
				);
				$where =  array('shop_id'=>post('shop_id'));
				 $this->store->update($data,$where);
				$this->session->set_flashdata('success','Store Updated');
				redirect('store');


			}

	}

function generatUnique($string,$id=''){
		$this->load->helper('url');
		$string2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string);

		$slug =strtolower($string2);

		$slugrpc = str_replace(' ','', $slug); // Replaces all spaces with hyphens.

		$last = preg_replace('/[^A-Za-z0-9\-]/',' ', $slugrpc);
		$i = 1; $baseSlug = $last;

		if ($id=='') {
			while($this->store_exist($last)){
				$last = $baseSlug.''.$i++;
			}

			$mainstring =  $last;
			return url_title($mainstring);
		}else{
			while($this->store_exist($last,$id)){
				$last = $baseSlug.''.$i++;
			}

			$mainstring =  $last;
			return url_title($mainstring);
		}

	}
	public function store_exist($store,$id=''){
		if ($id) {
			$this->db->where('shop_id !=',$id);
		}
		$this->db->where('domain_name',$store);
		$ret = $this->db->get('shop');

		if($ret->row()){
			return true;
		}else{
			return false;
		}
	}





}

/* End of file Store.php */
/* Location: ./application/controllers/Store.php */ ?>