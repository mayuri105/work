<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Others extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('other_models', 'other');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
	}

	public function index(){
		redirect('subscribed_package','refresh');
	}
	public function subscribed_package(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$perpage = $this->setting->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/others/subscribed_package?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->other->record_countBuyPac());
		$data["pagination_helper"] = $this->pagination;
		
		$data['property_title'] = $this->input->get('property_title');
		$data["package"] = $this->other->getBuyPacakge($perpage, (($page - 1) * $perpage));

		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/others/sub_detail_package')) {
			$this->load->view('themes/' . $theme . '/template/others/sub_detail_package', $data);
		} else {
			$this->load->view('themes/default/template/others/sub_detail_package', $data);
			
		}
	}

	public function addsubscriptionpackage(){
		$data = array();
		$this->load->model('appointment/appointment_models', 'appointment');
		$data['cust'] = $this->appointment->getCust();
		$data['package'] = $this->other->getPackage();
		
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/others/add_subscibepackage')) {
			$this->load->view('themes/' . $theme . '/template/others/add_subscibepackage', $data);
		} else {
			$this->load->view('themes/default/template/others/add_subscibepackage', $data);
			
		}
	}
	public function editsubscriptionpackage($id){
		$data = array();
		$this->load->model('appointment/appointment_models', 'appointment');
		$data['cust'] = $this->appointment->getCust();
		$data['package'] = $this->other->getPackage();
		$data['subpack'] = $this->other->getSubPacakge($id);
		
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/others/edit_subscibepackage')) {
			$this->load->view('themes/' . $theme . '/template/others/edit_subscibepackage', $data);
		} else {
			$this->load->view('themes/default/template/others/edit_subscibepackage', $data);
			
		}
	}

	public function addsubpackageSubmit(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('customer', 'Customer name', 'required');
		$this->form_validation->set_rules('package_name', 'Package name', 'required');
		$this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				$data = array();
				$this->load->model('appointment/appointment_models', 'appointment');
				$data['cust'] = $this->appointment->getCust();
				$data['package'] = $this->other->getPackage();
				
				$theme = $this->session->userdata('admin_theme');
				if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/others/add_subscibepackage')) {
					$this->load->view('themes/' . $theme . '/template/others/add_subscibepackage', $data);
				} else {
					$this->load->view('themes/default/template/others/add_subscibepackage', $data);
				}
			} else {
				$pack =$this->other->getPackageDetail(post('package_name'));
				$data = array(
					'customer_id' => post('customer'),
					'package_id'=>$pack['package_id'],
					'package_name'=>$pack['package_name'],
					'package_price' =>$pack['package_price'],
					'package_start_date'=>date('Y-m-d'),
					'package_end_date'=>date('Y-m-d',strtotime($pack['package_end_date'])),
					'totalamt'=>$pack['package_price'],
					'payment_done'=>'1',	
					'payment_method'=>post('payment_method'),
					'added_date'=>date('Y-m-d')
				);

				$ret = $this->other->insertSubPak($data);
				addactivty('Subscription Package successfully added');
				$this->session->set_flashdata('success', 'Subscription Package successfully added');
				redirect('others/addsubscriptionpackage');
				
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('others/addsubscriptionpackage');
		}
	}
	public function updatesubpackageSubmit(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('customer', 'Customer name', 'required');
		$this->form_validation->set_rules('package_name', 'Package name', 'required');
		$this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('others/editsubscriptionpackage/'.post('cp_id').'','refresh');
			} else {
				$pack =$this->other->getPackageDetail(post('package_name'));
				$data = array(
					'customer_id' => post('customer'),
					'package_id'=>$pack['package_id'],
					'package_name'=>$pack['package_name'],
					'package_price' =>$pack['package_price'],
					'package_start_date'=>date('Y-m-d'),
					'package_end_date'=>date('Y-m-d',strtotime($pack['package_end_date'])),
					'totalamt'=>$pack['package_price'],
					'payment_done'=>'1',	
					'payment_method'=>post('payment_method'),
					
				);
				$where = array('cp_id'=>post('cp_id'));
				$ret = $this->other->updateSubPak($data,$where);
				addactivty('Subscription Package successfully update');
				$this->session->set_flashdata('success', 'Subscription Package successfully update');
				redirect('others/editsubscriptionpackage/'.post('cp_id').'','refresh');
				
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('others/editsubscriptionpackage/'.post('cp_id').'','refresh');
		}
	}
	public function getPackageDetail(){
		$id = $this->input->get('id');
		$result = $this->other->getPackageDetail($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));	
	}

	public function rentaproperty(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$perpage = $this->setting->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/others/rentaproperty?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->other->record_countRentProp());
		$data["pagination_helper"] = $this->pagination;
		
		$data['are'] = $this->input->get('package');
		$data["property"] = $this->other->getRentProp($perpage, (($page - 1) * $perpage));

		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/others/rentaproperty')) {
			$this->load->view('themes/' . $theme . '/template/others/rentaproperty', $data);
		} else {
			$this->load->view('themes/default/template/others/rentaproperty', $data);
			
		}
	}
	
	public function saleaproperty(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$perpage = $this->setting->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/others/saleaproperty?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->other->record_countRentProp());
		$data["pagination_helper"] = $this->pagination;
		
		$data['are'] = $this->input->get('package');
		$data["property"] = $this->other->getSaleProp($perpage, (($page - 1) * $perpage));

		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/others/sale_property')) {
			$this->load->view('themes/' . $theme . '/template/others/sale_property', $data);
		} else {
			$this->load->view('themes/default/template/others/sale_property', $data);
			
		}
	}	
	public function addrentaproperty(){
		$data = array();
		$this->load->model('appointment/appointment_models', 'appointment');
		$data['cust'] = $this->appointment->getCust();
		
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/others/add_rentaproperty')) {
			$this->load->view('themes/' . $theme . '/template/others/add_rentaproperty', $data);
		} else {
			$this->load->view('themes/default/template/others/add_rentaproperty', $data);
			
		}
	}
	public function addsaleaproperty(){
		$data = array();
		$this->load->model('appointment/appointment_models', 'appointment');
		$data['cust'] = $this->appointment->getCust();
		
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/others/add_sale_property')) {
			$this->load->view('themes/' . $theme . '/template/others/add_sale_property', $data);
		} else {
			$this->load->view('themes/default/template/others/add_sale_property', $data);
			
		}
	}
	public function editrentaproperty($id){
		$data = array();
		$this->load->model('appointment/appointment_models', 'appointment');
		$data['cust'] = $this->appointment->getCust();
		$data['package'] = $this->other->getPackage();
		$data['custprop'] = $this->other->getCustprop($id);
		
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/others/edit_rentaproperty')) {
			$this->load->view('themes/' . $theme . '/template/others/edit_rentaproperty', $data);
		} else {
			$this->load->view('themes/default/template/others/edit_rentaproperty', $data);
			
		}
	}
	public function editsaleaproperty($id){
		$data = array();
		$this->load->model('appointment/appointment_models', 'appointment');
		$data['cust'] = $this->appointment->getCust();
		$data['package'] = $this->other->getPackage();
		$data['property'] = $this->other->getSoldCustprop($id);
		
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/others/edit_sale_property')) {
			$this->load->view('themes/' . $theme . '/template/others/edit_sale_property', $data);
		} else {
			$this->load->view('themes/default/template/others/edit_sale_property', $data);
			
		}
	}
	public function addrentapropertySubmit(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('customer', 'Customer name', 'required');
		$this->form_validation->set_rules('property_id', 'property name', 'required');
		$this->form_validation->set_rules('start_date', 'start_date', 'required');
		$this->form_validation->set_rules('end_date', 'end_date', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				$data = array();
				$this->load->model('appointment/appointment_models', 'appointment');
				$data['cust'] = $this->appointment->getCust();
				
				$theme = $this->session->userdata('admin_theme');
				if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/others/add_rentaproperty')) {
					$this->load->view('themes/' . $theme . '/template/others/add_rentaproperty', $data);
				} else {
					$this->load->view('themes/default/template/others/add_rentaproperty', $data);
				}
			} else {
				$data = array(
					'customer_id' => post('customer'),
					'property_id'=>post('property_id'),
					'start_date'=>date('Y-m-d',strtotime(post('start_date'))),
					'end_date'=>date('Y-m-d',strtotime(post('end_date'))),
					'rent'=>post('rent'),
					'added_date'=>date('Y-m-d')
				);

				$ret = $this->other->insertRentPro($data);
				addactivty('Rent a property successfully added');
				$this->session->set_flashdata('success', 'Rent a property successfully added');
				redirect('others/rentaproperty');
				
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('others/rentaproperty');
		}
	}
	public function addsalepropertySubmit(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('customer', 'Customer name', 'required');
		$this->form_validation->set_rules('property_id', 'property name', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				$data = array();
				$this->load->model('appointment/appointment_models', 'appointment');
				$data['cust'] = $this->appointment->getCust();
				
				$theme = $this->session->userdata('admin_theme');
				if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/others/add_sale_property')) {
					$this->load->view('themes/' . $theme . '/template/others/add_sale_property', $data);
				} else {
					$this->load->view('themes/default/template/others/add_sale_property', $data);
				}
			} else {
				$data = array(
					'customer_id' => post('customer'),
					'property_id'=>post('property_id'),
					'amount'=>post('amount'),
					'date_added'=>date('Y-m-d')
				);

				$ret = $this->other->insertSalePro($data);
				
				$this->session->set_flashdata('success', 'Sale Property successfully added');
				redirect('others/saleaproperty');
				
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('others/saleaproperty');
		}
	}
	public function editrentapropertySubmit(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('customer', 'Customer name', 'required');
		$this->form_validation->set_rules('property_id', 'property name', 'required');
		$this->form_validation->set_rules('start_date', 'start_date', 'required');
		$this->form_validation->set_rules('end_date', 'end_date', 'required');
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('others/editrentaproperty/'.post('rp_id').'','refresh');
			} else {
				$data = array(
					'customer_id' => post('customer'),
					'property_id'=>post('property_id'),
					'start_date'=>date('Y-m-d',strtotime(post('start_date'))),
					'end_date'=>date('Y-m-d',strtotime(post('end_date'))),
					'rent'=>post('rent'),	
				);

				$where = array('rp_id'=>post('rp_id'));
				$ret = $this->other->updateRentPro($data,$where);
				addactivty('Rent a property successfully Updated');
				$this->session->set_flashdata('success', 'Rent a property successfully Updated');
				redirect('others/editrentaproperty/'.post('rp_id').'','refresh');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('others/editrentaproperty/'.post('rp_id').'','refresh');
		}
	}
	public function editSaleapropertySubmit(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('customer', 'Customer name', 'required');
		$this->form_validation->set_rules('property_id', 'property name', 'required');
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('others/editsaleaproperty/'.post('sale_property_id').'','refresh');
			} else {
				$data = array(
					'customer_id' => post('customer'),
					'property_id'=>post('property_id'),
					'amount'=>post('amount'),	
				);

				$where = array('sale_property_id'=>post('sale_property_id'));
				$ret = $this->other->updateSalePro($data,$where);
				$this->session->set_flashdata('success', 'Sale a property successfully Updated');
				redirect('others/editsaleaproperty/'.post('sale_property_id').'','refresh');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('others/editsaleaproperty/'.post('sale_property_id').'','refresh');
		}
	}

	function deletemultiplePack() {
		if (checkModification()) {
			foreach ($this->input->post('delete') as $u) {
				$this->session->set_flashdata('success', 'Deleted Successfully  ');
				$ret = $this->other->deletePack($u);
				$this->output->set_content_type('application/json')->set_output(json_encode($ret));
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			$ret = 1;
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}

	function deletemultipleRenPro() {
		if (checkModification()) {
			foreach ($this->input->post('delete') as $u) {
				$this->session->set_flashdata('success', 'Deleted Successfully  ');
				$ret = $this->other->deleteRenPro($u);
				$this->output->set_content_type('application/json')->set_output(json_encode($ret));
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			$ret = 1;
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}
	function deletemultipleSalePro() {
		if (checkModification()) {
			foreach ($this->input->post('delete') as $u) {
				$this->session->set_flashdata('success', 'Deleted Successfully  ');
				$ret = $this->other->deleteSalePro($u);
				$this->output->set_content_type('application/json')->set_output(json_encode($ret));
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			$ret = 1;
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}
	public function clients(){
		$data = array();
		$this->load->model('appointment/appointment_models', 'appointment');
		$data['client_images'] =$this->other->getClientsImage();
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/others/clients')) {
			$this->load->view('themes/' . $theme . '/template/others/clients', $data);
		} else {
			$this->load->view('themes/default/template/others/clients', $data);
			
		}
	}

	 public function upload_attachment(){ 
	 	$upload_path =  $this->config->item('upload_path').'/clients/';
	 	 if (!file_exists($upload_path)) {
		    mkdir($upload_path, 0777, true);
		}
        $c_upload['upload_path']   =  $upload_path;
        $c_upload['encrypt_name']  = false;
        $c_upload['allowed_types'] = 'gif|jpg|png|jpeg|x-png';
        $this->load->library('upload', $c_upload);
        foreach ($_FILES as $key => $value) {
	        if (!empty($value['name'])) {
	            $this->load->library('upload', $c_upload);
	            if (!$this->upload->do_multi_upload($key)) {
					                      
	            }else {
	                $files[$key] = $this->upload->data();
	                $total =  count($files);
                   	$data = array();
                   	for ($i=0; $i <$total; $i++) { 
                   		 $data[] = array(
                   		 	"url" => $upload_path.$value['name'][$i],
                        	"name" => $value['name'][$i],
	                        "size" => 879394,
	                        "type" => "dummy",
	                        "thumbnailUrl" =>$upload_path.$value['name'][$i],
	                        "deleteUrl" => $upload_path.$value['name'][$i],
	                        "deleteType" => "DELETE"
                        );
                   	}

	               	          
	            }
	        }
	    }
	    $result = array(
            'files'=> $data                      
        );          
       $this->output->set_content_type('application/json')->set_output(json_encode($result));		
          
    }

    public function saveClientImage(){
    	if ($this->input->post('attachment')) {
	    	$data = $this->input->post();
	    	$this->other->deleteImg();
	    	$ret = $this->other->insertClientImage($data);
	    	//echo $ret;
	    	$this->session->set_flashdata('success', 'You successfully uploaded files');
	    	redirect('others/clients','refresh');
    	}else{
    		$this->session->set_flashdata('Error', 'Error in uploading files');
    		redirect('others/clients','refresh');
    	}
    }

    

}

/* End of file Others.php */
/* Location: ./application/controllers/Others.php */