<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('city_model', 'city');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		
		
	}

	public function index()
	{
		$perpage = $this->setting->get('per_page');
		$data = array();
		$data["state"] = getstate(); 
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/city/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->city->record_count());
		$data["pagination_helper"]   = $this->pagination;
		$data["citys"] = $this->city->fetch_data($perpage ,(($page-1) * $perpage));
		$theme = $this->session->userdata('admin_theme');
		
		$data['city'] = $this->input->get('city');
        $data['state'] = $this->input->get('state');
        $data['enable'] = $this->input->get('enable');
        $data['zipcode'] = $this->input->get('zipcode');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/city/index')) {
			$this->load->view('themes/' . $theme . '/template/city/index', $data);
		} else {
			$this->load->view('themes/default/template/city/index', $data);
		}

	}

	// add new city Method view page
	public function addnew(){
		//load view
		$data = array();
		$data["state"] = getstate(); 
		 $theme = $this->session->userdata('admin_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/city/add')) {
			$this->load->view('themes/' . $theme . '/template/city/add', $data);
		} else {
			$this->load->view('themes/default/template/city/add', $data);
		}
	}
	// edit city view page
	public function edit($id=''){
		if ($id=='') {
			redirect('city');
		}
		$data = array();
		$data["state"] = getstate();
		$data['city'] = $this->city->getcitybyid($id); 
		$theme = $this->session->userdata('admin_theme');

		if (file_exists(APPPATH . 'views/themes/'.$theme.'/template/city/edit')) {
			$this->load->view('themes/' . $theme . '/template/city/edit', $data);
		} else {
			$this->load->view('themes/default/template/city/edit', $data);
		}
	}

	// add city submit method
	public function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('city_name', 'city_name', 'required');
		$this->form_validation->set_rules('state', 'state', 'required');
		if(checkModification()){
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				$data = array();
				$data["state"] = getstate(); 
				 $theme = $this->session->userdata('admin_theme');
				if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/city/add')) {
					$this->load->view('themes/' . $theme . '/template/city/add', $data);
				} else {
					$this->load->view('themes/default/template/city/add', $data);
				}
			}else{
				$image = '';
				$upload_path =  $this->config->item('upload_path').'/city';

				if (!file_exists($upload_path)) {
					mkdir($upload_path, 0777, true);
				}

				$newthumb = $upload_path.'/large';
				if (!file_exists($newthumb)) {
					mkdir($newthumb, 0777, true);
				}
				$small = $upload_path.'/small';
				if (!file_exists($small)) {
					mkdir($small, 0777, true);
				}
				$c_upload['upload_path']    =  $upload_path;
				$c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
				$this->load->library('upload', $c_upload);

				if($this->upload->do_upload('fileinput')){
					$image = $this->upload->data();
						
					$this->load->library('image_moo');

					$ret = $this->image_moo->load($upload_path.'/'.$image['file_name'])->resize_crop(780,260)->save($newthumb.'/'.$image['file_name']);

					$ret = $this->image_moo->load($upload_path.'/'.$image['file_name'])->resize_crop(380,237)->save($small.'/'.$image['file_name']);



					if ($this->upload->do_upload('fileinput2')) {
						$image2 = $this->upload->data();

						

						$data= array(
							'city_name'=>post('city_name'),
							'state'=>post('state'),
							'city_image_url'=>$image['file_name'],
							'city_banner_image'=>$image2['file_name'],
							'feature_city'=>post('feature_city'),
							'status'=>post('status'),
						);	
						$ret = $this->city->insert($data);

						$lenght = count($this->input->post('zipcode'));
						for ($i=0; $i<$lenght;$i++) { 
							$data2 = array(
								'city_id'=>$ret,
								'zipcode'=>post('zipcode')[$i],
								'enabled'=>post('zip_status')[$i],
							);
							$this->city->insertZips($data2);
						}

					} else {
					  $this->session->set_flashdata('error',$this->upload->display_errors());
					  redirect('city');
					}

				}else{
					
					if ($this->upload->do_upload('fileinput2')) {
						$image = $this->upload->data();
						$data= array(
							'city_name'=>post('city_name'),
							'state'=>post('state'),
							'city_banner_image'=>$image['file_name'],
							'feature_city'=>post('feature_city'),
							'status'=>post('status'),
						);	
						$ret = $this->city->insert($data);
					}else{
						$this->session->set_flashdata('error',$this->upload->display_errors());
						redirect('city');
					}

				}
				addactivity('City Added');

				$this->session->set_flashdata('success','City Added');

				redirect('city');
			
			}
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			redirect('city');
		}
	}
	// update city 
	public function update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('city_name', 'city_name', 'required');
		$this->form_validation->set_rules('state', 'state', 'required');
		if(checkModification()){
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				redirect('city');
			}else{
				$image = '';
				$upload_path =  $this->config->item('upload_path').'/city';

				if (!file_exists($upload_path)) {
					mkdir($upload_path, 0777, true);
				}

				$newthumb = $upload_path.'/large';
				if (!file_exists($newthumb)) {
					mkdir($newthumb, 0777, true);
				}
				$small = $upload_path.'/small';
				if (!file_exists($small)) {
					mkdir($small, 0777, true);
				}
				$c_upload['upload_path']    =  $upload_path;
				$c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
				$this->load->library('upload', $c_upload);
				$image1 = 0;
				$image2 =0;
				if($this->upload->do_upload('fileinput')){


					$image1 = $this->upload->data();	
					$this->load->library('image_moo');

					$ret = $this->image_moo->load($upload_path.'/'.$image1['file_name'])->resize_crop(780,260)->save($newthumb.'/'.$image1['file_name']);

					$ret = $this->image_moo->load($upload_path.'/'.$image1['file_name'])->resize_crop(380,237)->save($small.'/'.$image1['file_name']);


					$where =  array('city_id'=>post('city_id'));
					$data = array(
						'city_image_url'=>$image1['file_name']
					);
					$ret = $this->city->update($data,$where);
					
				}
				if($this->upload->do_upload('fileinput2')){
					$image2 = $this->upload->data();

					$where =  array('city_id'=>post('city_id'));
					$data = array(
						'city_banner_image'=>$image2['file_name']
					);
					$ret = $this->city->update($data,$where);	
				}
				$data= array(
					'city_name'=>post('city_name'),
					'state'=>post('state'),
					'feature_city'=>post('feature_city'),
					'status'=>post('status'),
				);	
				$where = array('city_id'=>post('city_id'));		
				$ret = $this->city->update($data,$where );	
				addactivity('City Updated');
				$this->session->set_flashdata('success','City Updated');
				redirect('city');
				
			}
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
			redirect('city');
		}
	}
	// get city method json
	function getcity(){
		$id = post('id');
		$ret =  $this->city->getcitybyid($id);
		echo  json_encode($ret);
		exit;
	}
	
	// add zipcode by city
	public function addnewzips(){
		if(checkModification()){	
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('zipcode', 'Zip code', 'required|integer|max_length[6]');
			
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				redirect('city/edit/'.post('city_id').'');
			}else{
				$checkzip = $this->city->chckingZip(post('city_id'),post('zipcode'));
				if ($checkzip) {
					$data2 = array(
						'city_id'=>post('city_id'),
						'zipcode'=>post('zipcode'),
						'enabled'=>post('zip_status'),
					);
					$ret= $this->city->insertZips($data2);
					
					$this->session->set_flashdata('success','Zipcode inserted');
					redirect('city/edit/'.post('city_id').'');
				}else{
					$this->session->set_flashdata('error','Zipcode is already in database');
					redirect('city/edit/'.post('city_id').'');
				}
				
				

			}
			
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('city/edit/'.post('city_id').'');
		}	
	}
	// update zipcode 
	public function updatezips(){
		if(checkModification()){	
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('zipcode', 'zipcode', 'required|max_length[6]');
			
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				redirect('city/edit/'.post('city_id').'');
			}else{

				$checkzip = $this->city->chckingZip(post('city_id'),post('zipcode'));
				if ($checkzip) {
					$data2 = array(
						'zipcode'=>post('zipcode'),
						'enabled'=>post('zip_status'),
					);
					$where = array('cz_id'=>post('cz_id'));
					$ret= $this->city->updateZips($data2,$where);
					$this->session->set_flashdata('success','Zipcode inserted');
					redirect('city/edit/'.post('city_id').'');
				}else{
					$this->session->set_flashdata('error','Zipcode is already in database');
					redirect('city/edit/'.post('city_id').'');
				}	

			}
			
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('city/edit/'.post('city_id').'');
		}	
	}
	// delete zips
	public function deletezips($id){
		$ret =  $this->city->deletezips($id);
		if($ret){
			echo 'success';
		}else{
			echo 'error';
		}
	}
	// get zips all
	public function getzips(){
		$id = post('id');
		$ret =  $this->city->getzip($id);
		echo  json_encode($ret);
		exit;
	}
	// delete multiple  city
	function deletemultiple(){
		if(checkModification()){
			foreach ($this->input->post('delete') as $u) {
					$ret =  $this->city->delete($u);
			}
			if($ret){
				$this->session->set_flashdata('success','Deleted Successfully  ');
				echo json_encode($ret);
			}else{
				$this->session->set_flashdata('error','Item Currently being used');
				echo json_encode($ret);
			}
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	        echo json_encode('1');
		}
	}
}	

/* End of file city.php */
/* Location: ./application/controllers/city.php */