<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('reports_model', 'reports');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
	}

	public function index()
	{
		redirect('reports/rental');
	}

	public function rental(){
		$data = array();
		
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		$data['group'] = $this->input->get('group');
		$data['rental'] = $this->reports->getRental();
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/reports/rental-report')) {
			$this->load->view('themes/' . $theme . '/template/reports/rental-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/rental-report', $data);
			
		}
	}

	public function sold_property(){
		$data = array();
		
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		$data['group'] = $this->input->get('group');
		$data['sold'] = $this->reports->getSold();
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/reports/sold-report')) {
			$this->load->view('themes/' . $theme . '/template/reports/sold-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/sold-report', $data);
			
		}
	}

	public function subscription(){
		$data = array();
		
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		$data['group'] = $this->input->get('group');
		$data['sold'] = $this->reports->getSubscribe();
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/reports/subscription-report')) {
			$this->load->view('themes/' . $theme . '/template/reports/subscription-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/subscription-report', $data);
		}
	}

	public function property(){
		$data = array();
		
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		
		$saleData = $this->reports->getSaleData();
		$rentData= $this->reports->getRentData();
		$investmentData = $this->reports->getInvestmentData();
		$biddata = $this->reports->getBidData();
		$data['property'] = array(
			'sale' => $saleData->tot,
			'rent' => $rentData->tot,
			'invesetment' => $investmentData->tot,
			'bid' => $biddata->tot,
		);
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/reports/property-reports')) {
			$this->load->view('themes/' . $theme . '/template/reports/property-reports', $data);
		} else {
			$this->load->view('themes/default/template/reports/property-reports', $data);
		}

	}
}

/* End of file Reports.php */
/* Location: ./application/controllers/Reports.php */