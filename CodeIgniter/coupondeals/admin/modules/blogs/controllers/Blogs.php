<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogs extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('blogs_models', 'blogs');
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
		
		$base_url = "/blogs/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->blogs->record_count());
		$data["pagination_helper"] = $this->pagination;
		$data["blogs"] = $this->blogs->fetch_data($perpage, (($page - 1) * $perpage));
		$data['blogs_par'] = $this->blogs->getblog();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/blog/index')) {
			$this->load->view('themes/' . $theme . '/template/blog/index', $data);
		} else {
			$this->load->view('themes/default/template/blog/index', $data);

		}
	}
	// add categories form page
	public function addblog() {
		$data = array();
		$data['categories'] = $this->blogs->getcategory();
		$theme = $this->session->userdata('admin_theme');
		
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/blog/add')) {
			$this->load->view('themes/' . $theme . '/template/blog/add', $data);
		} else {
			$this->load->view('themes/default/template/blog/add', $data);

		}

	}
	
	public function edit($id = '') {
		if ('' == $id) {
			redirect('blogs');
		}
		$data = array();
		$data['blogs'] = $this->blogs->getblogByid($id);
		$data['blogs_par'] = $this->blogs->getblog();
		$data['categories'] = $this->blogs->getcategory();
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/blog/edit')) {
			$this->load->view('themes/' . $theme . '/template/blog/edit', $data);
		} else {
			$this->load->view('themes/default/template/blog/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cat_slug', 'category', 'required');
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('short_desc', 'Short Description', 'required');
		$this->form_validation->set_rules('long_desc', 'Long Description', 'required');
		$this->form_validation->set_rules('author', 'author', 'required');
		if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('blogs/addblog/');
			} else {
		
			
				$data = array(
					'cat_slug' => post('cat_slug'),
					'title' => post('title'),
					'blog_slug' =>$this->generatUnique(post('title')),
					'short_desc'=>post('short_desc'),
					'long_desc' => post('long_desc'),
					'author' => post('author'),
					'feature' => post('feature'),
					
				);

				$ret = $this->blogs->insert($data);
				
				$upload_path =  $this->config->item('upload_path').'/blogsimages';

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
		        	$where = array('blog_id'=>$ret);
		        	$ret = $this->blogs->updateimages($data2,$where);
		        	
                }
	           
        		$this->session->set_flashdata('success', ' Successfully Updated');
        		redirect('blogs');


			}
		
	}

	public function updateblog() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cat_slug', 'category', 'required');
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('short_desc', 'short description', 'required');
		$this->form_validation->set_rules('long_desc', 'long description', 'required');
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('blogs/edit/' . post('blog_id') . '');
			} else {
				$data = $this->input->post();
				$id  = $data['blog_id'];
				$this->blogs->update($data);
				
	        	$upload_path =  $this->config->item('upload_path').'/blogsimages';

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
		        	$where = array('blog_id'=>$id);
		        	$ret = $this->blogs->updateimages($data2,$where);
		        	
                }
	           
        		$this->session->set_flashdata('success', ' Successfully Updated');
        		redirect('blogs');

			}
		
	}
			
	function delete($id) {

	$ret=$this->blogs->delete($id);
	$this->output->set_content_type('application/json')->set_output(json_encode($ret));
	$this->session->set_flashdata('success', 'Deleted Successfully  ');
	}

function status($id){

		
		$ret = $this->blogs->updatestatus($id);
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
	public function exitcheck($blog,$id=''){
		if ($id) {
			$this->db->where('blog_id !=',$id);
		}
		$this->db->where('blog_slug',$blog);
		$ret = $this->db->get('tbl_blogs');
		$this->db->where('deal_slug',$blog);
		$ret = $this->db->get('tbl_product_deal');

		if($ret->row()){
			return true;
		}else{
			return false;
		}
	}
}

/* End of file Categories.php */
/* categories: ./application/controllers/Categories.php */