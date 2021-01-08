<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimonial extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('testimonial_models', 'testimonial');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index() {
		$perpage = $this->setting->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/testimonial/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->testimonial->record_count());
		$data["pagination_helper"] = $this->pagination;
		
		$data['cate'] = $this->input->get('testimonial');
		$data["testimonial"] = $this->testimonial->fetch_data($perpage, (($page - 1) * $perpage));
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/testimonial/index')) {
			$this->load->view('themes/' . $theme . '/template/testimonial/index', $data);
		} else {
			$this->load->view('themes/default/template/testimonial/index', $data);

		}
	}
	// add testimonial form page
	public function addtestimonial() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/testimonial/add')) {
			$this->load->view('themes/' . $theme . '/template/testimonial/add', $data);
		} else {
			$this->load->view('themes/default/template/testimonial/add', $data);

		}

	}
	// edit testimonial form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('testimonial');
		}
		$data = array();
		$data['testimonial'] = $this->testimonial->gettestimonialByid($id);
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/testimonial/edit')) {
			$this->load->view('themes/' . $theme . '/template/testimonial/edit', $data);
		} else {
			$this->load->view('themes/default/template/testimonial/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('testimonial_name', 'Testimonial name', 'required');
		$this->form_validation->set_rules('testimonial', 'Testimonial ', 'required');
		$this->form_validation->set_rules('user_position', 'User Position', 'required');

		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('testimonial/addtestimonial');
			}else{

	            $upload_path =  $this->config->item('upload_path').'/testimonial';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('fileinput')) {
                    $image = $this->upload->data();
                   	$data= array(
		        		'testimonial_name'=>post('testimonial_name'),
		        		'testimonial'=>post('testimonial'),
		        		'user_position'=>post('user_position'),
		        		'user_image'=>$image['file_name'],
		        		'added_date'=>date('Y-m-d'),
		        	);	
		        	$ret = $this->testimonial->insert($data);
		        	$this->session->set_flashdata('success','Testimonial Added');
	        		redirect('testimonial/addtestimonial');
                }else{
                	$this->session->set_flashdata('error',$this->upload->display_errors());
					redirect('testimonial/addtestimonial');
                }
	        	
	        }
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('testimonial/addtestimonial');
		}
	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('testimonial_name', 'testimonial name', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('testimonial/edit/' . post('testimonial_id') . '');
			} else {
				$upload_path =  $this->config->item('upload_path').'/testimonial';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('fileinput')) {
                    $image = $this->upload->data();
                   	$data= array(
		        		'testimonial_name'=>post('testimonial_name'),
		        		'testimonial'=>post('testimonial'),
		        		'user_position'=>post('user_position'),
		        		'user_image'=>$image['file_name'],
		        		
		        	);	
		        	$where = array('testimonial_id'=>post('testimonial_id'));
		        	$ret = $this->testimonial->update($data,$where);
		        	$this->session->set_flashdata('success', 'Testimonial Updated');
					redirect('testimonial/edit/' . post('testimonial_id') . '');
                }else{
                	$data= array(
		        		'testimonial_name'=>post('testimonial_name'),
		        		'testimonial'=>post('testimonial'),
		        		'user_position'=>post('user_position'),
		        		
		        	);	
		        	$where = array('testimonial_id'=>post('testimonial_id'));
		        	$ret = $this->testimonial->update($data,$where);
                	
                	$this->session->set_flashdata('success', 'Testimonial Updated');
					redirect('testimonial/edit/' . post('testimonial_id') . '');
                }
				
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('testimonial/addtestimonial');
		}
	}

	function deletemultiple() {

		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success', 'Deleted Successfully  ');
			$ret = $this->testimonial->delete($u);
			addactivty('testimonial Deleted');
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}

}

/* End of file Testimonial.php */
/* testimonial: ./application/controllers/Testimonial.php */