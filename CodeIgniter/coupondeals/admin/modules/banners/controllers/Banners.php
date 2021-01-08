<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banners extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('banners_models', 'banners');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('image_lib');
	}

	public function index() {
		$data = array();
		$perpage = $this->setting->get('per_page');
		
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/banners/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->banners->record_count());
		$data["pagination_helper"] = $this->pagination;
		$data["banners"] = $this->banners->fetch_data($perpage, (($page - 1) * $perpage));
		$data['banners_par'] = $this->banners->getBanner();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/banners/index')) {
			$this->load->view('themes/' . $theme . '/template/banners/index', $data);
		} else {
			$this->load->view('themes/default/template/banners/index', $data);

		}
	}
	// add categories form page
	public function addBanners() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/banners/add')) {
			$this->load->view('themes/' . $theme . '/template/banners/add', $data);
		} else {
			$this->load->view('themes/default/template/banners/add', $data);

		}

	}
	// edit categories form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('banners');
		}
		$data = array();
		$data['banners'] = $this->banners->getbannerByid($id);
		$data['banners_par'] = $this->banners->getBanner();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/banners/edit')) {
			$this->load->view('themes/' . $theme . '/template/banners/edit', $data);
		} else {
			$this->load->view('themes/default/template/banners/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');
		

		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('brands/addbrands');
			} else {
				$data = array(
					'name' => post('name'),
					'script_desc' => post('script_desc'),
					'banner_link' => post('banner_link'),
				
					

				);

				$ret = $this->banners->insert($data);
				$upload_path =  $this->config->item('upload_path').'/bannersimages';

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
						$where = array('banner_id'=>$ret);
		        	 $this->banners->updateimages($data2,$where);
					}
				$this->session->set_flashdata('success', 'banners Added');
				redirect('banners');
				
				
				
		}
			
		
	}

	
	public function updatebanner() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');
		//$this->form_validation->set_rules('img_name', 'Image ', 'required');
		
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('banners/edit/' . post('banner_id') . '');
			} else {
				$data = $this->input->post();
				$id  = $data['banner_id'];
				$this->banners->update($data);
				
	        	$upload_path =  $this->config->item('upload_path').'/brandsimages';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('img_name')) {
                    $image = $this->upload->data();
					$img_array = array();
        $img_array['image_library'] = 'gd2';
        $img_array['maintain_ratio'] = TRUE;
        $img_array['create_thumb'] = FALSE;
		$img_array['overwrite'] = TRUE;
        
        $img_array['source_image'] = $image['full_path'];
		
		$img_array['thumb_marker'] = None;
        $img_array['width'] = 250;
        $img_array['height'] = 212;
		$img_array['new_image']= $image['file_name'];

        $this->image_lib->clear(); 
        $this->image_lib->initialize($img_array);
        $this->image_lib->resize();
                   	$data2= array(
		        		'img_name'=>$image['file_name'],
		        		
		        	);	
		        	$where = array('banner_id'=>$id);
		        	$ret = $this->banners->updateimages($data2,$where);
		        	
                }
	           
        		$this->session->set_flashdata('success', ' Successfully Updated');
        		redirect('banners');

			}
		
	}
			
	function delete($id) {

	$ret=$this->banners->delete($id);
	$this->output->set_content_type('application/json')->set_output(json_encode($ret));
	$this->session->set_flashdata('success', 'Deleted Successfully  ');
	}

	function status($id){

		
		$ret = $this->banners->updatestatus($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		$this->session->set_flashdata('success', 'Update Successfully  ');
	}

}

/* End of file Categories.php */
/* categories: ./application/controllers/Categories.php */