<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('index_model', 'index');
		
	}
	public function index()
	{	
		$data =array();
		
		$theme = $this->session->userdata('admin_theme');
		$data['start'] = $this->input->get('start');
		$data['end'] = $this->input->get('end');
		$data['totalAgents'] = $this->index->totalAgents();
		$data['totalsalepro'] = $this->index->getPropertyForSale();
		$data['totalrentpro'] = $this->index->getPropertyForRent();
		$data['userActivity'] = $this->index->getuserActivity();
		$data['todaysappointment'] = $this->index->todaysappointment();
		$data['totalCust'] =  $this->index->getTotalCustomer();
		$data['totalsoldpro'] =  $this->index->getPropertySold();
		$data['totalProfit'] =  $this->index->totalProfit();
		$data['appointment'] =  $this->index->getAppointment();
		
        if (file_exists(APPPATH . 'views/themes/'.$theme.'/template/common/index')) {
            $this->load->view('themes/'.$theme.'/template/common/index', $data);
        }else{
            $this->load->view('themes/default/template/common/index', $data);
        }
	}

	

	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */ ?>