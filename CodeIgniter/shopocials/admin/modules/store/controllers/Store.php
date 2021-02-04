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

	
	public function manage()
	{
		$perpage = $this->setting->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		$base_url = "/store/manage?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
        
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->store->record_count_allstore());
		$data["pagination_helper"]   = $this->pagination;
		$data["stores"] = $this->store->fetch_data_allstore($perpage ,(($page-1) * $perpage));
		
		$data['name'] = $this->input->get('name');
        $data['merchant'] = $this->input->get('merchant');
       
       
        $data['date_added'] = date('dd-mm-yy',strtotime($this->input->get('date_added')));
       
		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/manage')) {
			$this->load->view('themes/' . $theme . '/template/store/manage', $data);
		} else {
			$this->load->view('themes/default/template/store/manage', $data);
		}
	}
	
public function edit($id) {

		
		$data = array();
		//$store  = $this->store->getstorebyid($id);
		$data['store'] = $this->store->getstorebyid($id);		
		
		$data['shopcategory'] = $this->store->getcategory();
		$data['state'] = $this->store->getstate();
		//$data['city'] = $this->store->getcity();
		$data['getcountry'] = $this->store->getcountry();		
		$data['zipcode'] = $this->store->getzipOfcity();
		$data['zip'] = $this->store->getstorebyzip($id);
		$theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/store/edit')) {
			$this->load->view('themes/' . $theme . '/template/store/edit', $data);
		} else {
			$this->load->view('themes/default/template/store/edit', $data);
		}
	}

	function storedelete($id) {



	$ret=$this->store->storedelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}    	

	public function updatestore(){
		
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('shop_name', 'Shop Name', 'required');
			$this->form_validation->set_rules('shop_type','Shop type','required');
			
			$this->form_validation->set_rules('shop_zip','Shop Zip','required');
			
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('store/edit/'.post('shop_id').'');
			}else{
				$image = '';
				$upload_path =  $this->config->item('upload_path').'/shop';

				if (!file_exists($upload_path)) {
					mkdir($upload_path, 0777, true);
				}
				$c_upload['upload_path']    =  $upload_path;
				$c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
				$this->load->library('upload', $c_upload);
				$store_uniquename = $this->generatUnique(post('shop_name'),post('shop_id'));
				
				$image1 = 0;
				$image2 = 0;
				if($this->upload->do_upload('fileinput')){
					$image1 = $this->upload->data();	
					$where =  array('shop_id'=>post('shop_id'));
					$data = array(
						'shop_logo'=>$image1['file_name']
					);
					$ret = $this->store->update($data,$where);
				}
				if($this->upload->do_upload('fileinput2')){
					$image2 = $this->upload->data();

					$where =  array('shop_id'=>post('shop_id'));
					$data = array(
						'footer_logo'=>$image2['file_name']
					);
					$ret = $this->store->update($data,$where);	
				}

				$data= array(
					'shop_name'=>post('shop_name'),
					'shop_type'=>post('shop_type'),
					'meta_title'=>post('meta_title'),
					'meta_keyword'=>post('meta_keyword'),
					'meta_description'=>post('meta_description'),
					'shop_street'=>post('shop_street'),
					'shop_country'=>post('shop_country'),
					'shop_state'=>post('shop_state'),
					'shop_city'=>post('shop_city'),
					'shop_zip'=>post('shop_zip'),
					'about_shop'=>post('about_shop'),
					'tagline'=>post('tagline'),
					'fb_link'=>post('fb_link'),
					'go_link'=>post('go_link'),
					'blog_link'=>post('blog_link'),
					'domain_name'=> $store_uniquename,
					'duration_from'=> post('duration_from'),
					'time_from'=> post('time_from'),
					'time_to'=>post('time_to'),
					'shop_phone'=>post('shop_phone')
				);	
				$where =  array('shop_id'=>post('shop_id'));
				$ret = $this->store->update($data,$where);
				

				$store_id = post('shop_id');
				$this->store->deletezips($store_id);
				$count = count($this->input->post('deliveryzips'));
				for ($i=0; $i < $count; $i++){ 
					$data2 = array(
						'shop_id'=>post('shop_id'),
						'zip_code_id'  => $this->input->post('deliveryzips')[$i]
					);
					$this->store->insertzipcode($data2);
				}
				
				$this->session->set_flashdata('success','Store Updated');
				redirect('store/manage');


			}
		
	}
		public function status($id) {
					$ret=$this->store->status($id);

					$this->output->set_content_type('application/json')->set_output(json_encode($ret));

					$this->session->set_flashdata('success', 'Changed Successfully');

			     }
function generatUnique($string,$id=''){
		$this->load->helper('url');
		$string2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string);

		$slug =strtolower($string2);

		$slugrpc = str_replace(' ','', $slug); // Replaces all spaces with hyphens.

		$last = preg_replace('/[^A-Za-z0-9\-]/',' ', $slugrpc); 
		$i = 1; $baseSlug = $last;

		if ($id=='') {
			while($this->store_exist($last)){
				$last = $baseSlug.''.$i++;        
			}

			$mainstring =  $last;
			return url_title($mainstring);	
		}else{
			while($this->store_exist($last,$id)){
				$last = $baseSlug.''.$i++;        
			}

			$mainstring =  $last;
			return url_title($mainstring);	
		}
	
	}
	public function store_exist($store,$id=''){
		if ($id) {
			$this->db->where('shop_id !=',$id);
		}
		$this->db->where('domain_name',$store);
		$ret = $this->db->get('shop');

		if($ret->row()){
			return true;
		}else{
			return false;
		}
	}

}

/* End of file Store.php */
/* Location: ./application/controllers/Store.php */ ?>