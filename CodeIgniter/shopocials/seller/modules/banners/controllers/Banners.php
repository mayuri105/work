<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banners extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('banner_model', 'banners');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
		
	}

	public function index()
	{
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
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->banners->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["banners"] = $this->banners->fetch_data($perpage ,(($page-1) * $perpage));
        
      
        
        $theme = $this->session->userdata('admin_theme');
        
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/banner/index')) {
			$this->load->view('themes/' . $theme . '/template/banner/index', $data);
		} else {
			$this->load->view('themes/default/template/banner/index', $data);
		}
	}
	public function addbanner() {
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/banner/add')) {
			$this->load->view('themes/' . $theme . '/template/banner/add', $data);
		} else {
			$this->load->view('themes/default/template/banner/add', $data);
		}

	}

public function edit($id = '') {
		if ('' == $id) {
			redirect('banners');
		}
		$data = array();
		$data['banner'] = $this->banners->getbannerbyid($id);
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/banner/edit')) {
			$this->load->view('themes/' . $theme . '/template/banner/edit', $data);
		} else {
			$this->load->view('themes/default/template/banner/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('link', 'link', 'required');
		//$this->form_validation->set_rules('testimonial', 'Testimonial ', 'required');
		

		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('banners/addbanner');
			}else{
				$mid = $this->session->userdata('m_id');
				$shopdata= $this->banners->getshopbymer($mid);
				$shop_id = $shopdata->shop_id;
				
	            $upload_path =  $this->config->item('upload_path').'/banners';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('fileinput')) {
                    $image = $this->upload->data();
                   	$data= array(
		        		'link'=>post('link'),
		        		'shop_id'=>$shop_id,
		        		'banner_image'=>$image['file_name'],
		        		
		        	);	
		        	$ret = $this->banners->insert($data);
		        	$this->session->set_flashdata('success','Banner Added');
	        		redirect('banners');
                }else{
                	$this->session->set_flashdata('error',$this->upload->display_errors());
					redirect('banners');
                }
	        	
	        }
		
	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('link', 'link', 'required');
		
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('banners/edit/' . post('banner_id') . '');
			} else {
				$mid = $this->session->userdata('m_id');
				$shopdata= $this->banners->getshopbymer($mid);
				$shop_id = $shopdata->shop_id;
				
				$upload_path =  $this->config->item('upload_path').'/banners';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('fileinput')) {
                    $image = $this->upload->data();
                   $data= array(
		        		'link'=>post('link'),
		        		'shop_id'=>$shop_id,
		        		'banner_image'=>$image['file_name'],
		        		
		        	);	
		        	$where = array('banner_id'=>post('banner_id'));
		        	$ret = $this->banners->update($data,$where);
		        	$this->session->set_flashdata('success', 'Banner Updated');
					redirect('banners');
                }else{
                	$data= array(
		        		'link'=>post('link'),
		        		'shop_id'=>$shop_id,
		        				        		
		        	);	
		        	$where = array('banner_id'=>post('banner_id'));
		        	$ret = $this->banners->update($data,$where);
                	
                	$this->session->set_flashdata('success', 'Banner Updated');
					redirect('banners');
                }
				
			}
		
	}
function bannerstatus($id){

	

			

			$ret = $this->banners->bannerupdatestatus($id);

			$this->output->set_content_type('application/json')->set_output(json_encode($ret));

			$this->session->set_flashdata('success', 'Update Successfully  ');

		}

		function bannerdelete($id) {



	$ret=$this->banners->bannerdelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}
}

/* End of file product.php */
/* Location: ./application/controllers/product.php */ ?>