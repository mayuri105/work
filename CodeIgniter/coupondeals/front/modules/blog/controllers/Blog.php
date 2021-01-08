<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Blog extends MX_Controller {

	public function __construct() {
		parent::__construct();		
		$this->load->model('blog_model', 'blog');
		$this->load->helper('date');
			$this->load->helper('url');
		$this->load->library('Pagination');
		$this->load->library('Paginationlib');
		
	}
	public function index() {
		
		//print_r($data["pagination_helper"]);
       
		$data["allblog"] = $this->blog->fetch_data();
		$data["mblog"] = $this->blog->getmobblog();
		$data["nblog"] = $this->blog->getnewsblog();
		$data["fblog"] = $this->blog->getfoodblog();
		$data["tblog"] = $this->blog->getipblog();
		$data["hblog"] = $this->blog->gethalblog();
		$data["sblog"] = $this->blog->getsablog();
		$data["lblog"] = $this->blog->getlablog();
		$data["fsblog"] = $this->blog->getfablog();
		$data["thblog"] = $this->blog->getehblog();
		$data["enblog"] = $this->blog->getenblog();
		$data['topblog']= $this->blog->gettopblog();
		$data['allletestblog']= $this->blog->getlatestblog();
		$data['allfeaturebrands']= $this->blog->getfeaturebrand();
		$data['allletestblog']= $this->blog->getlatestblog();
		$data['allfeaturebrands']= $this->blog->getfeaturebrand();
		$data['allletesdeal']= $this->blog->getlatestdeal();
		//$data['categories']= $this->blog->getcategory();
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/blog/blog')) {
			$this->load->view('themes/' . $theme . '/template/blog/blog',$data);
		} else {
			$this->load->view('themes/default/template/blog/blog',$data);
		}
	}
	
	
	public function show($slug)
	{
		
		
		$page = $this->blog->getblogbyurl($slug);	
		if(empty($page)){
			redirect('/','refresh');
		}
		$data =array();
		$data['blogs'] =  $this->blog->getblogbyurl($slug);
		$data['posts'] =  $this->blog->getpost($slug);
		$data['allletestblog']= $this->blog->getlatestblog();
		$data['allfeaturebrands']= $this->blog->getfeaturebrand();
		$data['allletesdeal']= $this->blog->getlatestdeal();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/blog/blog-view')) {
            $this->load->view('themes/' . $theme . '/template/blog/blog-view', $data);
        }else{
            $this->load->view('themes/default/template/blog/blog-view', $data);
        }	

	}
	
	public function blogcat($slug)
	{
		$page = $this->blog->getblogcat($slug);	
		if(empty($page)){
			redirect('/','refresh');
		}
		
		$data =array();
		$data['blogscat'] =  $this->blog->getblogcat($slug);
		$data['allfeatureblog']= $this->blog->getfeatureblog();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/blog/blogcat')) {
            $this->load->view('themes/' . $theme . '/template/blog/blogcat', $data);
        }else{
            $this->load->view('themes/default/template/blog/blogcat', $data);
        }	

	}
	
	
	public function sidebar()
	{
		$data = array();
		//load view 
		$data['allletestblog']= $this->blog->getlatestblog();
		$data['allfeaturebrands']= $this->blog->getfeaturebrand();
		$theme = $this->session->userdata('front_theme');
		
		//$data['menus']= $this->menus->getFullListFromDB();

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/rightbar')) {
			$this->load->view('themes/' . $theme . '/template/common/rightbar', $data);
		} else {
			$this->load->view('themes/default/template/common/rightbar', $data);
		}
	}
	
	public function comment()
	{
		$data = array();
		//load view 
		//$data['allletestblog']= $this->blog->getlatestblog();
		//$data['allfeaturebrands']= $this->blog->getfeaturebrand();
		$theme = $this->session->userdata('front_theme');
		
		//$data['menus']= $this->menus->getFullListFromDB();

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/blog/blog-comment')) {
			$this->load->view('themes/' . $theme . '/template/blog/blog-comment', $data);
		} else {
			$this->load->view('themes/default/template/blog/blog-comment', $data);
		}
	}
	
	public function add() {
				$this->load->library('form_validation');
			
         /* Set validation rule for name field in the form */ 
        
           $this->form_validation->set_rules('blog_id', 'blog_id', 'required'); 
		    $this->form_validation->set_rules('username', 'please login', 'required');
             $this->form_validation->set_rules('blog_slug', 'blog', 'required'); 
			  $this->form_validation->set_rules('message', 'message', 'required'); 
               
		if($this->form_validation->run() == FALSE){
       		$return = array('Type'=>'Error','Message'=> validation_errors());
            $this->output->set_content_type('application/json')->set_output(json_encode($return));
        }else{
        		
		     
		
		$data = array(
					'blog_id' => post('blog_id'),
					'blog_slug' => post('blog_slug'),
					'username' => post('username'),
					'message' =>post('message'),
					
					
				);
				$ret = $this->blog->insert($data);
				$return = array('n'=>1,'Type'=>'Success','Message'=>'Your comment Successfully post');
				$this->output->set_content_type('application/json')->set_output(json_encode($return));

        }

		
	}
	
	
	/*	public function blogbrand($id)
	{
		
		
		
		$data =array();
		$data['dealsbrand'] =  $this->blog->getdealbrand($id);
		
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/deal/brand-deal')) {
            $this->load->view('themes/' . $theme . '/template/deal/brand-deal', $data);
        }else{
            $this->load->view('themes/default/template/deal/brand-deal', $data);
        }	

	}*/
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */


// 