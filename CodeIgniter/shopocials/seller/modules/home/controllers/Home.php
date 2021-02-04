<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('index_model', 'index');

	}

	public function index()
	{
		$data =array();

		$theme = $this->session->userdata('admin_theme');
		
		//$data['total_order'] = $this->index->orderdata();
		//$data['totalAmount'] = $this->index->totalAmount();
		//$data['totalcustomer'] = $this->index->totalcustomer();
		//$data['totalStore'] = $this->index->totalStore();
		//$data['orders'] =$this->index->getorders();
		

		//$orders = $this->index->getorderdata();
		//$customer = $this->index->getCustomerData();
		/*$res = array();
		foreach ($orders as $r) {
			$res[] = array(strtotime($r->created_on) * 1000, (int)$r->cd);
		}
		$data['chartdata'] = json_encode($res);
		
		$cus = array();
		foreach ($customer as $c) {
			$cus[] = array(strtotime($c->created_on) * 1000, (int)$c->cd);
		}
		$data['chartdatacust'] = json_encode($cus);*/
		$theme = $this->session->userdata('admin_theme');
        if (file_exists(APPPATH . 'views/themes/'.$theme.'/template/common/merchant-index')) {
            $this->load->view('themes/'.$theme .'/template/common/merchant-index', $data);
        }else{
            $this->load->view('themes/default/template/common/merchant-index', $data);
        }
	}

	public function profilesetting(){
		$data =array();
		$this->load->library('encrypt');
		$data['state'] = getstate();

		$id = $this->session->m_id;
    	$data['merchant'] = $this->index->getmerchant($id);
		$data['orders'] = $this->index->getordersByMer($id);
		$data['stores'] = $this->index->getstoresByMer($id);

		$theme = $this->session->userdata('admin_theme');
        if (file_exists(APPPATH . 'views/themes/'.$theme.'/template/common/profilesetting')) {
            $this->load->view('themes/'.$theme .'/template/common/profilesetting',$data);
        }else{
            $this->load->view('themes/default/template/common/profilesetting',$data);
        }
	}
	public function updateprofile(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('business_name', 'Business Name', 'required');
		$this->form_validation->set_rules('physical_street', 'Physical street', 'required');
		$this->form_validation->set_rules('physical_city', 'Physical city', 'required');
		$this->form_validation->set_rules('physical_zipcode', 'Physical Zipcode', 'required');
		$this->form_validation->set_rules('frequency', 'frequency', 'required');
		$this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required');
		if ($this->form_validation->run() == FALSE){
			    $this->session->set_flashdata('error', validation_errors());
			    redirect('index/profilesetting');
			}else{
			    $ret =  $this->index->merchantupdate(); 	
			     if($ret){
			     		$this->session->set_flashdata('success','Updated successfully');
			      		redirect('index/profilesetting');
			      	}else{

						$this->session->set_flashdata('error','Error In Updated');
						redirect('index/profilesetting');
			       }
			}
	}
	
	public function getcity($state){

		$ret =  $this->index->getcityOfstate($state);
		echo  json_encode($ret);
		exit;
	}
	public function getzipofcity($city){
		$ret =  $this->index->getzipofcity($city);
		echo  json_encode($ret);
		exit;

	}
	// set date filter
	public function setFilter(){

		$setFil = array('startdate'=>$this->input->post('startdate'));
		$this->session->set_userdata($setFil);
		return true;

	}
	// get date filter value;
	public function getFilter(){
		if(empty($this->session->userdata('startdate'))){
			return 0;
		}else{
			return $this->session->userdata('startdate');
		}
	}
}	

/* End of file index.php */
/* Location: ./application/controllers/index.php */ ?>