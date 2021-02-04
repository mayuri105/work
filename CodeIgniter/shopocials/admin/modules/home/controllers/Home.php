<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('index_model', 'index');
		
	}
	public function index()
	{	
		$data =array();
		
		$theme = $this->session->userdata('admin_theme');
		
		/*$data['total_order'] = $this->index->orderdata();
		$data['totalAmount'] = $this->index->totalAmount();
		$data['totalcustomer'] = $this->index->totalcustomer();
		$data['totalProducts'] = $this->index->totalProducts();
		$data['totalMerchant'] = $this->index->totalMerchant();
		$data['totalStore'] = $this->index->totalStore();
		$data['totalcommison'] = $this->index->totalcommison();
		$data['totalAdRevenue'] = $this->index->totalAdRevenue();
		
		$data['couponAmount'] = $this->index->totalcouponAmount();
		
		$data['orders'] =$this->index->getorders();
		$data['userActivity'] =$this->index->getuserActivity();

		$orders = $this->index->getorderdata();
		$customer = $this->index->getCustomerData();
		$res = array();
		foreach ($orders as $r) {
			$res[] = array(strtotime($r->created_on) * 1000, (int)$r->cd);
		}
		$data['chartdata'] = json_encode($res);
		
		$cus = array();
		foreach ($customer as $c) {
			$cus[] = array(strtotime($c->created_on) * 1000, (int)$c->cd);
		}
		$data['chartdatacust'] = json_encode($cus);
		*/
        if (file_exists(APPPATH . 'views/themes/'.$theme.'/template/common/index')) {
            $this->load->view('themes/'.$theme.'/template/common/index', $data);
        }else{
            $this->load->view('themes/default/template/common/index', $data);
        }
	}

	


	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */ ?>