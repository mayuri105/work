<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('page_model', 'page');
	}

	public function show($url)
	{
		
		$page = $this->page->getpage($url);	
		if(empty($page)){
			redirect('/','refresh');
		}
		$data =array();
		$data['bodyclass'] ='page-repeat-orders';
		$data['page'] = $page;
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/index')) {
            $this->load->view('themes/' . $theme . '/template/page/index', $data);
        }else{
            $this->load->view('themes/default/template/page/index', $data);
        }	

	}

	public  function merchant()
	{
		$data['bodyclass'] ='page-merchant-signup';
		$data['state'] = getstate();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/merchant')) {
            $this->load->view('themes/' . $theme . '/template/page/merchant', $data);
        }else{
            $this->load->view('themes/default/template/page/merchant', $data);
        }
	}

	public function merchantsignup()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('BusinessName', 'BusinessName', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'required|numeric|max_length[6]');
		
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            redirect('page/merchant');
        }else{
        	$ret = $this->page->insertMerchant();
        	if($ret){
        		
        		$this->session->set_flashdata('success','Merchant Signup done we will shortly contact you for more information');
        		redirect('page/merchant');
        	}else{

	        	$this->session->set_flashdata('error','Error in signup');
	            redirect('page/merchant');
	        }
        }
	
	}
	public function getcitybystate($code){
		$return = $this->page->getCity($code);
		echo json_encode($return);
	}
}	

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */