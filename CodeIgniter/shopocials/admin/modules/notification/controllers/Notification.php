<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
		$this->load->model('noti_model', 'note');
		
	}

	public function index()
	{
		$data = array();
		$data['mailtemplates'] = $this->note->getMailTemp();
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/notification/index')) {
			$this->load->view('themes/' . $theme . '/template/notification/index', $data);
		} else {
			$this->load->view('themes/default/template/notification/index', $data);
		}
	}

		public function add() {
		
		$data = array();
		
		
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/notification/add')) {
			$this->load->view('themes/' . $theme . '/template/notification/add', $data);
		} else {
			$this->load->view('themes/default/template/notification/add', $data);
		}
	}
	public function edit($id = '') {
		if ('' == $id) {
			redirect('notification');
		}
		$data = array();
		
		$data['mail'] = $this->note->getMailTempByid($id);
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/notification/edit')) {
			$this->load->view('themes/' . $theme . '/template/notification/edit', $data);
		} else {
			$this->load->view('themes/default/template/notification/edit', $data);
		}
	}
	
	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('mail_content', 'Mail Content', 'required');

		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('notification/editmailtemplates/' . post('mail_id') . '');
			} else {
				$data = array(
					'mail_content' => post('mail_content'),
					
					
				);

				
				$where = array('mt_id'=>post('mt_id'));
		        	$ret = $this->note->update($data,$where);
					$this->session->set_flashdata('success','Notification Update');
	        		redirect('notification');
				
			}
		
	}

	public function addemailtemplate(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		
        $this->form_validation->set_rules('mail_content', 'content', 'required');
       
     

       
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	           redirect('notification');
	        }else{
	        	
			
				
	           
                   	$data= array(
                   		'name'=>post('name'),
	        		'mail_title'=>post('mail_title'),
	        		'mail_content'=>post('mail_content'),
		        		
		        	);	
		        	$ret = $this->note->insert($data);
		        	$this->session->set_flashdata('success','Notification Insert');
	        		redirect('notification');
                }
	        	
	        }
	        	
	    function notedelete($id) {



	$ret=$this->note->notedelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}    	

	}


/* End of file product.php */
/* Location: ./application/controllers/product.php */ ?>