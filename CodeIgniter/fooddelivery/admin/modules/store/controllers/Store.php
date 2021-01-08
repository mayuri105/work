<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Store_model', 'store');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
		
	}

	public function index()
	{
		$perpage = $this->setting->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		$base_url = "/store/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
        
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->store->record_count());
		$data["pagination_helper"]   = $this->pagination;
		$data["stores"] = $this->store->fetch_data($perpage ,(($page-1) * $perpage));
		
		$data['name'] = $this->input->get('name');
        $data['merchant'] = $this->input->get('merchant');
        $data['enable'] = $this->input->get('enable');
        $data['cuisine'] = $this->input->get('cuisine');
        $data['date_added'] = date('m-d-Y',strtotime($this->input->get('date_added')));
        $data['city'] = $this->input->get('city');
		$theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/index')) {
			$this->load->view('themes/' . $theme . '/template/store/index', $data);
		} else {
			$this->load->view('themes/default/template/store/index', $data);
		}
	}
	

	public function add()
	{
		$data = array();
		$data['state'] = getstate();
		$data['merchant_type'] =$this->store->getmerchanttype();
		$data['merchant'] =$this->store->getmerchant(); 
		$data['cusine_data'] =$this->store->getcusine_data(); 
		$data['city'] = $this->store->getcity();
		$theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/add')) {
			$this->load->view('themes/' . $theme . '/template/store/add', $data);
		} else {
			$this->load->view('themes/default/template/store/add', $data);
		}

	}
	public function edit($id='')
	{
		
		if($id==''){
			redirect('store');
		}

		if(checkmerchant()){
			$dat =  $this->store->getmerchant_wise_store(); 
			if(!in_array($id,$dat)){
				redirect('store');
			}
		}

		$data = array();
		$store  = $this->store->getstorebyid($id);
		$data['store'] = $store;
		$data['orders'] = $this->store->getOrderbystore($id);
		
		$data['store_review'] = $this->store->getStoreReview($id);
		$data['merchant_type'] =$this->store->getmerchanttype();
		$data['merchant'] =$this->store->getmerchant(); 
		$data['state'] = getstate();
		$data['city'] = $this->store->getcity();
		$data['cusine_data'] =$this->store->getcusine_data(); 
		$data['category'] = $this->store->getcategory($id);
		if ($store->store_info->store_city) {
			$data['zipcode'] = $this->store->getzipOfcity($store->store_info->store_city);
		}else{
			$data['zipcode'] = '';
		}
		
		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/edit')) {
			$this->load->view('themes/' . $theme . '/template/store/edit', $data);
		} else {
			$this->load->view('themes/default/template/store/edit', $data);
			
		}
	}
	public function addstore(){
		if(checkModification()){
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('store_name', 'Store Name', 'required');
			$this->form_validation->set_rules('merchant_id','merchant', 'required');
			$this->form_validation->set_rules('store_type','store_type','required');
			$this->form_validation->set_rules('store_commission','store commission', 'required|max_length[100]');
			$this->form_validation->set_rules('store_type');
			$this->form_validation->set_rules('phone');
			$this->form_validation->set_rules('store_street');
			$this->form_validation->set_rules('store_city');
			$this->form_validation->set_rules('store_zip');
			$phone = post('phone');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				$theme = $this->session->userdata('admin_theme');
				$data = array();
				$data['state'] = getstate();
				$data['merchant_type'] =$this->store->getmerchanttype();
				$data['merchant'] =$this->store->getmerchant(); 
				$data['cusine_data'] =$this->store->getcusine_data(); 
				$data['city'] = $this->store->getcity();
				if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/add')) {
					$this->load->view('themes/' . $theme . '/template/store/add', $data);
				} else {
					$this->load->view('themes/default/template/store/add', $data);
					
				}
			}else{
				$upload_path =  $this->config->item('upload_path').'/store';

				if (!file_exists($upload_path)) {
					mkdir($upload_path, 0777, true);
				}
				$c_upload['upload_path']    =  $upload_path;
				$c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
				$this->load->library('upload', $c_upload);
				
				$store_uniquename = $this->generatUnique(post('store_name'));
				$image1 = 0;
				$image2 =0;
				if($this->upload->do_upload('fileinput')){
					$image1 = $this->upload->data();	
				}
				if($this->upload->do_upload('fileinput2')){
					$image2 = $this->upload->data();	
				}

				if($image1 && $image2){
					$data= array(
						'store_name'=>post('store_name'),
						'status'=>post('status'),
						'store_type'=>post('store_type'),
						'store_street'=>post('store_street'),
						'store_city'=>post('store_city'),
						'store_zip'=>post('store_zip'),
						'merchant_id'=>post('merchant_id'),
						'store_logo'=>$image1['file_name'],
						'store_banner'=>$image2['file_name'],
						'store_phone'=> preg_replace("/[^0-9]/","",$phone),
						'unique_alias'=> $store_uniquename,
						'store_commission'=>post('store_commission'),
					);	
					$ret = $this->store->insert($data);
					addactivity('Store Created');
					$this->session->set_flashdata('success','Store Created');
					redirect('store/add');
				}else{
					$this->session->set_flashdata('error',$this->upload->display_errors());
					$theme = $this->session->userdata('admin_theme');
					$data = array();
					$data['state'] = getstate();
					$data['merchant_type'] =$this->store->getmerchanttype();
					$data['merchant'] =$this->store->getmerchant(); 
					$data['cusine_data'] =$this->store->getcusine_data(); 
					$data['city'] = $this->store->getcity();
					if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/add')) {
						$this->load->view('themes/' . $theme . '/template/store/add', $data);
					} else {
						$this->load->view('themes/default/template/store/add', $data);
						
					}	
				}
			}
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			redirect('store/add');
		}

	}

	public function updatestore(){
		if(checkModification()){
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('store_name', 'Store Name', 'required');
			$this->form_validation->set_rules('merchant_id','merchant', 'required');
			$this->form_validation->set_rules('store_type','store_type','required');
			$this->form_validation->set_rules('store_commission','store commission', 'required|max_length[100]');
			$this->form_validation->set_rules('store_type');
			$this->form_validation->set_rules('phone');
			$this->form_validation->set_rules('store_street');
			$this->form_validation->set_rules('store_city');
			$this->form_validation->set_rules('store_zip');
			$phone = post('phone');
			$phone2 = preg_replace("/[^0-9]/","", $phone );

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('store/edit/'.post('store_id').'');
			}else{
				$image = '';
				$upload_path =  $this->config->item('upload_path').'/store';

				if (!file_exists($upload_path)) {
					mkdir($upload_path, 0777, true);
				}
				$c_upload['upload_path']    =  $upload_path;
				$c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
				$this->load->library('upload', $c_upload);
				$store_uniquename = $this->generatUnique(post('store_name'),post('store_id'));
				
				$image1 = 0;
				$image2 =0;
				if($this->upload->do_upload('fileinput')){
					$image1 = $this->upload->data();	
					$where =  array('store_id'=>post('store_id'));
					$data = array(
						'store_logo'=>$image1['file_name']
					);
					$ret = $this->store->update($data,$where);
				}
				if($this->upload->do_upload('fileinput2')){
					$image2 = $this->upload->data();

					$where =  array('store_id'=>post('store_id'));
					$data = array(
						'store_banner'=>$image2['file_name']
					);
					$ret = $this->store->update($data,$where);	
				}

				$data= array(
					'store_name'=>post('store_name'),
					'status'=>post('status'),
					'store_type'=>post('store_type'),
					'meta_title'=>post('meta_title'),
					'meta_keyword'=>post('meta_keyword'),
					'meta_description'=>post('meta_description'),
					'store_street'=>post('store_street'),
					'store_city'=>post('store_city'),
					'store_zip'=>post('store_zip'),
					'merchant_id'=>post('merchant_id'),
					'deliveryoption'=>post('deliveryoption'),
					'unique_alias'=> $store_uniquename,
					'sunday'=>post('sunday'),
					'monday'=>post('monday'),
					'tuesday'=>post('tuesday'),
					'wednesday'=>post('wednesday'),
					'thursday'=>post('thursday'),
					'friday'=>post('friday'),
					'saturday'=>post('saturday'),
					'time_from'=> date('H:i:s',strtotime(post('time_from'))),
					'time_to'=>date('H:i:s',strtotime(post('time_to'))),
					'notice'=>post('notice'),
					'notice_start_date'=>date('Y-m-d',strtotime(post('notice_start_date'))),
					'notice_end_date'=>date('Y-m-d',strtotime(post('notice_end_date'))),
					'store_commission'=>post('store_commission'),
					'minorder'=>post('minorder'),
					'delivery_fee'=>post('delivery_fee'),
					'store_phone'=>$phone2,
					'delivery_periods'=>post('delivery_periods')
				);	
				$where =  array('store_id'=>post('store_id'));
				$ret = $this->store->update($data,$where);
				
				$id = post('store_id');
				if(post('store_type')=='1'){
					$this->store->store_cuisine_data_update($id);
				}

				$store_id = post('store_id');
				$this->store->deletezips($store_id);
				$count = count($this->input->post('deliveryzips'));
				for ($i=0; $i < $count; $i++){ 
					$data2 = array(
						'store_id'=>post('store_id'),
						'zip_code_id'  => $this->input->post('deliveryzips')[$i]
					);
					$this->store->insertzipcode($data2);
				}
				addactivity('Store Updated');
				$this->session->set_flashdata('success','Store Updated');
				redirect('store/edit/'.post('store_id').'');


			}

		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			redirect('store');
		}
	}


	public function search(){

		$data = array();
		$data["stores"] = $this->store->fetch_data_bysearch();
		$theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/search')) {
			$this->load->view('themes/' . $theme . '/template/store/search', $data);
		} else {
			$this->load->view('themes/default/template/store/search', $data);
			
		}
	}
	public function viewstore($id='',$page=1){
		
		if($id==''){
			redirect('store');
		}
		
		if(checkmerchant()){
			$dat =  $this->store->getmerchant_wise_store(); 
			if(!in_array($id,$dat)){
				redirect('store');
			}
		}
		$data = array();
		$theme = $this->session->userdata('theme');
		$perpage = $this->getperpage();
		
		$pagingConfig   = $this->paginationlib->initPagination("/store/viewstore/".$id."",$perpage,$this->store->countproducts($id));
		
		$data['store'] = $this->store->getstorebyid($id);
		$data['category'] = $this->store->getcategory($id);
		$data['notice'] = $this->store->getnotice($id);
		$data['discounts'] = $this->store->getDiscount($id);
		$data["pagination_helper"]   = $this->pagination;
		$data["products"] = $this->store->fetch_products($id,$perpage ,(($page-1) * $perpage));

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/view')) {
			$this->load->view('themes/' . $theme . '/template/store/view', $data);
		} else {
			$this->load->view('themes/default/template/store/view', $data);
			
		}
	}
	
	function generatUnique($string,$id=''){
		$this->load->helper('url');
		$string2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string);

		$slug =strtolower($string2);

		$slugrpc = str_replace(' ','-', $slug); // Replaces all spaces with hyphens.

		$last = preg_replace('/[^A-Za-z0-9\-]/',' ', $slugrpc); 
		$i = 1; $baseSlug = $last;

		if ($id=='') {
			while($this->store_exist($last)){
				$last = $baseSlug.'-'.$i++;        
			}

			$mainstring =  $last;
			return url_title($mainstring);	
		}else{
			while($this->store_exist($last,$id)){
				$last = $baseSlug.'-'.$i++;        
			}

			$mainstring =  $last;
			return url_title($mainstring);		
		}
	
	}
	public function store_exist($store,$id=''){
		if ($id) {
			$this->db->where('store_id !=',$id);
		}
		$this->db->where('unique_alias',$store);
		$ret = $this->db->get('store');

		if($ret->row()){
			return true;
		}else{
			return false;
		}
	}

	public function deletemultiple(){
		if(checkModification()){
			foreach ($this->input->post('delete') as $u) {
				$this->session->set_flashdata('success','Deleted Successfully  ');
				$ret =  $this->store->delete($u);

			}
			echo json_encode($ret);
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	       	echo json_encode('1');
		}
	}

	

	public function addproduct(){
		$this->load->model('products/product_model', 'product');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('product_name', 'product Name', 'required');
		$this->form_validation->set_rules('merchant_id','merchant_id','required');
		$this->form_validation->set_rules('store_id','store_id', 'required');

		if(checkModification()){
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
			}else{
				$data= array(
					'product_name'=>post('product_name'),
					'merchant_id'=>post('merchant_id'),
					'store_id'=>post('store_id'),
					'price'=>post('price'),
					'small_desc'=>post('small_product_description'),
				);	
				$ret = $this->product->insert($data);
				$data2 = array(
					'product_id'=>$ret,
					'category_id'=>post('category_id'),
				);
				$this->product->insertpro_cat($data2);
				if($ret){
					$id = post('store_id');
					$data['store_id']= post('store_id');
					$data['store_data']= $this->store->getstorebyid($id);
					$data['category'] = $this->store->getcategory($id);
					$theme = $this->session->userdata('theme');
					//load view 
					if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/category')) {
						$this->load->view('themes/' . $theme . '/template/store/category', $data);
					} else {
						$this->load->view('themes/default/template/store/category', $data);
						
					}
				}
			}
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			
		} 
	}

	public function addcategory(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('category_name', 'category Name', 'required');
		$this->form_validation->set_rules('store_id','store_id', 'required');

		if(checkModification()){
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
			}else{
				$data= array(
					'category'=>post('category_name'),
					'status'=>post('category_status'),
					'store_id'=>post('store_id'),
				);	
				$ret = $this->store->insertCategory($data);
				
				if($ret){
					$id = post('store_id');
					$data['store_id']= post('store_id');
					$data['category'] = $this->store->getcategory($id);
					$data['store_data']= $this->store->getstorebyid($id);
					$theme = $this->session->userdata('theme');
					//load view 
					if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/category')) {
						$this->load->view('themes/' . $theme . '/template/store/category', $data);
					} else {
						$this->load->view('themes/default/template/store/category', $data);
						
					}
				}else{

				}

			}
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			
		} 
	}
	public function addsubcategory(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('category_name', 'category Name', 'required');
		$this->form_validation->set_rules('store_id','store_id', 'required');

		if(checkModification()){
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
			}else{
				$data= array(
					'category'=>post('category_name'),
					'status'=>post('category_status'),
					'store_id'=>post('store_id'),
					'parent_category'=>post('main_cat_id'),
				);	
				$ret = $this->store->insertCategory($data);
				
				if($ret){
					$id = post('store_id');
					$data['store_id']= post('store_id');
					$data['store_data']= $this->store->getstorebyid($id);
					$data['category'] = $this->store->getcategory($id);
					$theme = $this->session->userdata('theme');
					//load view 
					if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/category')) {
						$this->load->view('themes/' . $theme . '/template/store/category', $data);
					} else {
						$this->load->view('themes/default/template/store/category', $data);
						
					}
				}else{
					
				}

			}
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			
		} 
	}


	public function deleteproduct(){
		if(checkModification()){
			$id = post('product_id');
			$ret =  $this->store->deleteproduct($id);
			if($ret){
					$id = post('store_id');
					$data['store_id']= post('store_id');
					$data['category'] = $this->store->getcategory($id);
					$data['store_data']= $this->store->getstorebyid($id);
					$theme = $this->session->userdata('theme');
					//load view 
					if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/category')) {
						$this->load->view('themes/' . $theme . '/template/store/category', $data);
					} else {
						$this->load->view('themes/default/template/store/category', $data);
						
					}
				}
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			
		}
	}

	public function deletecategory(){
		if(checkModification()){
			$id = post('category_id');
			$ret =  $this->store->deletecategory($id);
			$id = post('store_id');
			$data['store_data']= $this->store->getstorebyid($id);
			$data['store_id']= post('store_id');
			$data['category'] = $this->store->getcategory($id);
			$theme = $this->session->userdata('theme');
			//load view 
			if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/category')) {
				$this->load->view('themes/' . $theme . '/template/store/category', $data);
			} else {
				$this->load->view('themes/default/template/store/category', $data);
				
			}
				
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			
		}
	}
	public function updatecategory(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('edit_category_name', 'category Name', 'required');
		$this->form_validation->set_rules('store_id','store_id', 'required');

		if(checkModification()){
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
			}else{
				$data= array(
					'category'=>post('edit_category_name'),
					'status'=>post('edit_category_status'),
					'store_id'=>post('store_id'),
					'discount'=>post('cat_discount'),
					'start_time'=>date('Y-m-d',strtotime(post('cat_dis_start_date'))),
					'end_time'=>date('Y-m-d',strtotime(post('cat_dis_end_date'))),

				);	
				$where = array('cat_id'=>post('edit_category_id'));
				$ret = $this->store->updateCategory($data,$where);
				
				if($ret){
					$id = post('store_id');
					$data['store_id']= post('store_id');
					$data['category'] = $this->store->getcategory($id);
					$data['store_data']= $this->store->getstorebyid($id);
					$theme = $this->session->userdata('theme');
					//load view 
					if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/category')) {
						$this->load->view('themes/' . $theme . '/template/store/category', $data);
					} else {
						$this->load->view('themes/default/template/store/category', $data);
						
					}
				}else{

				}

			}
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			
		} 
	}
	public function getcategorydata(){
		$id = post('category_id');

		$ret = $this->store->getcatdata($id);

		echo json_encode($ret);
	}

	public function editproduct($id=''){
		$data = array();
		$product = $this->store->getproduct($id);	
		if ($id=='' || !$product) {
			redirect('store');
		}

		$data['product'] = $product;
		$data['category'] = $this->store->getcategory($id);
		$data['optiongroup'] = $this->store->getoptionGroup($id);
		$theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/editproduct')) {
			$this->load->view('themes/' . $theme . '/template/store/editproduct', $data);
		} else {
			$this->load->view('themes/default/template/store/editproduct', $data);
			
		}
	}

	public function updateproduct(){
		$this->load->model('products/product_model', 'product');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('product_name', 'product Name', 'required');
		
		if(checkModification()){
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
			}else{
				$data= array(
					'product_name'=>preg_replace("/&#?[a-z0-9]+;/i","",post('product_name')),
					'price'=>post('price'),
					'status'=>post('status'),
					'discount'=>post('discount'),
					'start_time'=>date('Y-m-d',strtotime(post('start_time'))),
					'end_time'=>date('Y-m-d',strtotime(post('end_time'))),
				);	
				$where = array('product_id'=>post('product_id'));
				$ret = $this->product->update($data,$where);
				if($ret){
					redirect('store/editproduct/'.post('product_id').'');
				}else{
					redirect('store/editproduct/'.post('product_id').'');
				}
			}
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			
		} 
	}

	function getoptiondataofgroup(){
		$id = post('id');
		$ret =  $this->store->getoptiondatabyid($id);
		echo  json_encode($ret);
		exit;
	}
	function deleteoption($id =''){
		$ret =  $this->store->deleteoption($id);
		if($ret){
			echo 'success';
		}else{
			echo 'error';
		}
	}
	function deleteoptiongroup($id =''){
		$ret =  $this->store->deleteoptiongroup($id);
		if($ret){
			echo 'success';
		}else{
			echo 'error';
		}
	}
	public function updateoption(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('option_value', 'Option Name', 'required');
		
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			redirect('store/editproduct/'.post('product_id').'');
		}else{
			$data= array(
				'option_value'=>post('option_value'),
				'option_group_id'=>post('option_group_id'),
				'price'=>post('price')
			);	
			$where = array('po_id'=>post('po_id'));
			$ret = $this->store->updateOption($data,$where);
			if($ret){
				$this->session->set_flashdata('success','Product Option Updated');
				redirect('store/editproduct/'.post('product_id').'');
			}else{
				$this->session->set_flashdata('error','Error in insert');
			   redirect('store/editproduct/'.post('product_id').'');
			}
		}
	}
	function getoptiondata(){
		$id = post('id');
		$ret =  $this->store->getoptiongroupbyid($id);
		echo  json_encode($ret);
		
	}
	function approvedreview($id){
		if ($id) {
			$ret =  $this->store->storerReviewApproved($id);
			echo  json_encode($ret);
		}
		
	}
	function deletereview($id){
		if ($id) {
			$ret =  $this->store->storerReviewDelete($id);
			echo  json_encode($ret);
		}
		
	}
	public function updategroup(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('option_name', 'Group option Name', 'required');
		
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			redirect('store/editproduct/'.post('product_id').'');
		}else{
			$data= array(
				'option_name'=>post('option_name'),
				'required'=>post('required'),
				'multiple'=>post('multiple'),
			);	

			$ret = $this->store->updateProductOptioGr($data,post('option_id'));
			if($ret){
				$this->session->set_flashdata('success','Product Option Group Updated');
				redirect('store/editproduct/'.post('product_id').'');
			}else{
				$this->session->set_flashdata('error','Error in insert');
			   redirect('store/editproduct/'.post('product_id').'');
			}
		}
	}
	public function addgroup(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('option_name', 'Group option Name', 'required');
		$this->form_validation->set_rules('product_id', 'product_id', 'required');
		
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			redirect('store/editproduct/'.post('product_id').'');
		}else{
			
			$data= array(
				'option_name'=>post('option_name'),
				'product_id'=>post('product_id'),
				'required'=>post('required'),
				'multiple'=>post('multiple'),
			);	

			$ret = $this->store->insertProductOptioGr($data);
			if($ret){
				$this->session->set_flashdata('success','Product Option Group Created');
				redirect('store/editproduct/'.post('product_id').'');
			}else{
				$this->session->set_flashdata('error','Error in insert');
			   redirect('store/editproduct/'.post('product_id').'');
			}
		}
	}
	public function addgroupoption(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('option_value', 'Option Name', 'required');
		
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			redirect('store/editproduct/'.post('product_id').'');
		}else{
			$data= array(
				'option_value'=>post('option_value'),
				'option_group_id'=>post('option_group_id'),
				'price'=>post('price')
			);	
			
			$ret = $this->store->insertOption($data);
			if($ret){
				$this->session->set_flashdata('success','Option Added');
				redirect('store/editproduct/'.post('product_id').'');
			}else{
				$this->session->set_flashdata('error','Error in insert');
			   redirect('store/editproduct/'.post('product_id').'');
			}
		}
	}

	public function updatecatbypro(){
		if(post('ajax')){
			$ret = $this->store->updateCatofProduct();
			echo json_encode($ret);
		}
	}
}

/* End of file Store.php */
/* Location: ./application/controllers/Store.php */ ?>