<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seo extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('setting_models', 'setting');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index() {
		
		
		$data = array();
		/*$perpage = $this->setting->get('per_page');
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/deals/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->careers->record_count());
		$data["pagination_helper"] = $this->pagination;
		$data["careers"] = $this->careers->fetch_data($perpage, (($page - 1) * $perpage));
		$data['careers_par'] = $this->careers->getcareer();
		*/
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/setting/seo')) {
			$this->load->view('themes/' . $theme . '/template/setting/seo', $data);
		} else {
			$this->load->view('themes/default/template/setting/seo', $data);

		}
	}
	// add categories form page
	/*
	public function addbanner() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/banners/add')) {
			$this->load->view('themes/' . $theme . '/template/banners/add', $data);
		} else {
			$this->load->view('themes/default/template/banners/add', $data);

		}

	}
	
	public function edit($id = '') {
		if ('' == $id) {
			redirect('carrers/index');
		}
		$data = array();
		$data['careers'] = $this->careers->getcareersByid($id);
		$data['careers_par'] = $this->careers->getcareer();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/career/edit')) {
			$this->load->view('themes/' . $theme . '/template/career/edit', $data);
		} else {
			$this->load->view('themes/default/template/career/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('post_title', 'Post', 'required');
		$this->form_validation->set_rules('img_class', 'Icon Class', 'required');
		if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('careers/addcareers/');
			} else {
		
			
				$data = array(
					'post_title' => post('post_title'),
					'post_desc'=>post('post_desc'),
					'img_class' => post('img_class'),
					
				);

				$ret = $this->careers->insert($data);
				
				$upload_path =  $this->config->item('upload_path').'/careerfile';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'pdf|docs';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('req_file')) {
                    $image = $this->upload->data();
                   	$data2= array(
		        		'req_file'=>$image['file_name'],
		        		
		        	);	
		        	$where = array('id'=>$ret);
		        	$ret = $this->careers->updatefile($data2,$where);
                }else{

                		$this->session->set_flashdata('error', 'file not upload');
                }
               

				$this->session->set_flashdata('success', 'carrers Added');
				redirect('careers/index');
				

			}
		
	}

	public function updatecareer() {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('post_title', 'Post', 'required');
		$this->form_validation->set_rules('img_class', 'Icon Class', 'required');
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('careers/edit/' . post('id') . '');
			} else {
				$data = $this->input->post();
				$id  = $data['id'];
				$this->careers->update($data);
				
	        	$upload_path =  $this->config->item('upload_path').'/careerfile';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'pdf|docs';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('req_file')) {
                    $image = $this->upload->data();
                   	$data2= array(
		        		'req_file'=>$image['file_name'],
		        		
		        	);	
		        	$where = array('id'=>$id);
		        	$ret = $this->careers->updatefile($data2,$where);
		        	
                }
	           
        		$this->session->set_flashdata('success', ' Successfully Updated');
        		redirect('careers/index');

			}
		
	}
			
	function delete($id) {

	$ret=$this->careers->delete($id);
	$this->output->set_content_type('application/json')->set_output(json_encode($ret));
	$this->session->set_flashdata('success', 'Deleted Successfully  ');
	}*/

	

}

/* End of file Categories.php */
/* categories: ./application/controllers/Categories.php */