<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('property_models', 'property');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index() {
		$perpage = $this->setting->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/property/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->property->record_count());
		$data["pagination_helper"] = $this->pagination;
		
		$data['propertys'] = $this->input->get('property');
		$data['status'] = $this->input->get('status');
		$data['property_type'] = $this->input->get('property_type');
		$data['property_action'] = $this->input->get('property_action');
		$data['state'] = $this->input->get('state');
		$data['city'] = $this->input->get('city');
		$data["property"] = $this->property->fetch_data($perpage, (($page - 1) * $perpage));
		$data['types'] = $this->property->getTypes();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/'.$theme.'/template/property/index')) {
			$this->load->view('themes/'.$theme.'/template/property/index', $data);
		} else {
			$this->load->view('themes/default/template/property/index', $data);

		}
	}
	// add property form page
	public function addproperty() {
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$data['user'] = $this->property->getUsers();
		$data['areas'] = $this->property->getAreas();
		$data['attr'] = $this->property->getAttributes();
		$data['amenities'] = $this->property->getAmenities();
		$data['user'] = $this->property->getUsers();
		$data['types'] = $this->property->getTypes();
		
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/property/add')) {
			$this->load->view('themes/' . $theme . '/template/property/add', $data);
		} else {
			$this->load->view('themes/default/template/property/add', $data);
		}

	}
	// edit property form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('property');
		}
		$data = array();
		$data['property'] = $this->property->getpropertyByid($id);
		$data['property_images'] = $this->property->getProImages($id);
		$data['pro_attributes'] = $this->property->getProAttributes($id);
		$data['bid_dates'] = $this->property->getBidDates($id);
		$data['roitable'] = $this->property->getRoiTable($id);
		$data['bidingdata'] = $this->property->getBidonproperty($id);
		$data['rent'] = $this->property->getRentproperty($id);
		$data['sold'] = $this->property->getSoldproperty($id);
		

		$data['attr'] = $this->property->getAttributes();
		$data['amenities'] = $this->property->getAmenities();
		$data['user'] = $this->property->getUsers();
		$data['areas'] = $this->property->getAreas();
		$data['types'] = $this->property->getTypes();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/property/edit')) {
			$this->load->view('themes/' . $theme . '/template/property/edit', $data);
		} else {
			$this->load->view('themes/default/template/property/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('property_title', 'Property_title', 'required');
		$this->form_validation->set_rules('property_type', 'Property type', 'required');
		$this->form_validation->set_rules('property_action', 'Property action', 'required');
		$this->form_validation->set_rules('approved', 'approved', 'required');
		$this->form_validation->set_rules('property_action', 'Property action', 'required');
		$this->form_validation->set_rules('property_type', 'Property type', 'required');
		$this->form_validation->set_rules('property_action', 'Property action', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('property/addproperty');
			} else {
				$user_id = $this->session->userdata('u_id');
				$data = array(
					'property_title' => post('property_title'),
					'property_slug' =>$this->generatUnique(post('property_title')),
					'status'=>post('property_status'),
					'property_small_desc'=>post('property_small_desc'),
					'property_content' => post('property_content'),
					'property_type' => post('property_type'),
					'property_action' => post('property_action'),
					'beds' => post('beds'),
					'bathrums' => post('bathrums'),
					'landmark' => post('landmark'),
					'area' => post('area'),
					'built_up_area' => post('built_up_area'),
					'carpet_area' => post('carpet_area'),
					'property_owner' => post('property_owner'),
					'property_owner_phone' => post('property_owner_phone'),
					
					'cost' => post('cost'),
					
					'posted_by_id' =>$user_id,
					'open_for_bid'=>post('open_for_bid'),
					'bid_difference'=>post('bid_difference'),
					'approved'=>post('approved'),
					'set_as_feature'=>post('set_as_feature'),
					'set_in_slider_img'=>post('set_in_slider_img'),
					
					'added_on'=>date('Y-m-d'),
								
				);
				$ret = $this->property->insert($data);
				// update attributes
				if ($this->input->post('attributes')) {
					$this->property->insertPrAttrAdd($this->input->post('attributes'),$ret);
				}
	        	// update images
	        	if ($this->input->post('attachment')) {
	        		$this->property->insertPrImageAdd($this->input->post('attachment'),$ret);	
	        	}
	        	// update amenities
	        	if ($this->input->post('amenities')) {
	        		$this->property->insertPrAmenitiesAdd($this->input->post('amenities'),$ret);	
	        	}
        		if ($this->input->post('dates')) {
	        		$this->property->insertPrBidDates($this->input->post('dates'),$ret);	
	        	}
        		if ($this->input->post('roi')) {
	        		$this->property->insertPrRoiInvestments($this->input->post('roi'),$ret);	
	        	}	
        		
        		$upload_path =  $this->config->item('upload_path').'/property';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('fileinput')) {
                    $image = $this->upload->data();
                   	$data2= array(
		        		'feature_image'=>$image['file_name'],
		        		
		        	);	
		        	$where = array('property_id'=>$ret);
		        	$ret = $this->property->updateProp($data2,$where);
                }

               
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('fileinput2')) {
                    $image = $this->upload->data();
                   	$data2= array(
		        		'slider_image'=>$image['file_name'],
		        	);	
		        	$where = array('property_id'=>$ret);
		        	$ret = $this->property->updateProp($data2,$where);
                }
                
				addactivty('Property Added');
				$this->session->set_flashdata('success', 'Property Added');
				redirect('property/addproperty');
				

			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('property/addproperty');
		}
	}

	public function upload_attachment(){ 
	 	$upload_path =  $this->config->item('upload_path').'/property/';
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


	

	public function editchange() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('property_title', 'Property_title', 'required');
		$this->form_validation->set_rules('property_type', 'Property type', 'required');
		$this->form_validation->set_rules('property_action', 'Property action', 'required');
			
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('property/edit/' . post('property_id') . '');
			} else {
				$data = $this->input->post();
				$proid  = $data['property_id'];
				$this->property->update($data);
				if ($this->input->post('attributes')) {
					$this->property->detetePrAtt($proid);
					$this->property->insertPrAttrAdd($this->input->post('attributes'),$proid);
				}
	        	// update images
	        	if ($this->input->post('attachment')) {
	        		$this->property->detetePrImag($proid);
	        		$this->property->insertPrImage($data);	
	        	}
	        	// update amenities
	        	if ($this->input->post('amenities')) {
	        		$this->property->detetePrAmenities($proid);
	        		$this->property->insertPrAmenitiesAdd($this->input->post('amenities'),$proid);	
	        	}
        		if ($this->input->post('dates')) {
        			$this->property->detetePrBidDates($proid);
	        		$this->property->insertPrBidDates($this->input->post('dates'),$proid);	
	        	}	
	        	if ($this->input->post('roi')) {
	        		$this->property->detetePrRoiTable($proid);
	        		$this->property->insertPrRoiInvestments($this->input->post('roi'),$proid);	
	        	}	

	        	$upload_path =  $this->config->item('upload_path').'/property';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('fileinput')) {
                    $image = $this->upload->data();
                   	$data2= array(
		        		'feature_image'=>$image['file_name'],
		        		
		        	);	
		        	$where = array('property_id'=>$proid);
		        	$ret = $this->property->updateProp($data2,$where);
		        	
                }
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('fileinput2')) {
                    $image = $this->upload->data();
                   	$data2= array(
		        		'slider_image'=>$image['file_name'],
		        		
		        	);	
		        	$where = array('property_id'=>$proid);
		        	$ret = $this->property->updateProp($data2,$where);
		        	
                }
                




        		$this->session->set_flashdata('success', 'Property Successfully Updated');
        		redirect('property/edit/' . post('property_id') . '');

			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('property/addproperty');
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
			while($this->exitcheck($last)){
				$last = $baseSlug.'-'.$i++;        
			}

			$mainstring =  $last;
			return url_title($mainstring);	
		}else{
			while($this->exitcheck($last,$id)){
				$last = $baseSlug.'-'.$i++;        
			}
			$mainstring =  $last;
			return url_title($mainstring);		
		}
	
	}
	public function exitcheck($store,$id=''){
		if ($id) {
			$this->db->where('property_id !=',$id);
		}
		$this->db->where('property_slug',$store);
		$ret = $this->db->get('property');

		if($ret->row()){
			return true;
		}else{
			return false;
		}
	}

	function deletemultiple() {

		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success', 'Deleted Successfully  ');
			$ret = $this->property->delete($u);
			$this->property->detetePrAmenities($u);
			$this->property->detetePrAtt($u);
			$this->property->detetePrImag($u);
			$this->property->detetePrBidDates($u);
			
			addactivty('Property Deleted');
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}
	function aprvdisapprove(){
		$id = post('id');
		$ret = $this->property->setAprvdisapprove($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	}
}

/* End of file .php */
/* property: ./application/controllers/Property.php */