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
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/notification/mail')) {
			$this->load->view('themes/' . $theme . '/template/notification/mail', $data);
		} else {
			$this->load->view('themes/default/template/notification/mail', $data);
		}
	}
	public function editmailtemplates($id = '') {
		if ('' == $id) {
			redirect('notification');
		}
		$data = array();
		$shopid =  $this->note->getmerchant_wise_store(); 
		$data['shop_id'] =  $this->note->getmerchant_wise_store(); 
		$data['shopmail'] = $this->note->getMailTempByshopid($id,$shopid);
		$data['mail'] = $this->note->getMailTempByid($id);
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/notification/editmail')) {
			$this->load->view('themes/' . $theme . '/template/notification/editmail', $data);
		} else {
			$this->load->view('themes/default/template/notification/editmail', $data);
		}
	}
	
	public function updatemailtemp() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('mail_content', 'Mail Content', 'required');

		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('notification/editmailtemplates/' . post('mail_id') . '');
			} else {
				$data = array(
					'mail_content' => post('mail_content'),
					'mail_id' => post('mail_id'),
					'shop_id' => post('shop_id'),
					
				);

				
				$this->note->updateMail($data);
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
                   			'shop_id'=>post('shop_id'),
		        		'mail_id'=>post('mt_id'),
	        		'mail_content'=>post('mail_content'),
	        		
		        		
		        	);	
		        	$ret = $this->note->insert($data);
		        	$this->session->set_flashdata('success','Notification Update');
	        		redirect('notification');
                }
	        	
	        }
	        	
	        	

	}


/* End of file product.php */
/* Location: ./application/controllers/product.php */ ?>