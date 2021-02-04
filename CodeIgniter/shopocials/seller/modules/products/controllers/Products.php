<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model', 'product');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->helper('form');

	}

	public function index()
	{
		$data = array();
		$perpage = $this->setting->get('per_page');

		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		$base_url = "/products/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->product->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["products"] = $this->product->fetch_data($perpage ,(($page-1) * $perpage));

        $data['name'] = $this->input->get('name');
        $data['stock'] = $this->input->get('stock');

        $data['date_added'] = date('m-d-Y',strtotime($this->input->get('date_added')));

        $theme = $this->session->userdata('admin_theme');

		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/product/index')) {
			$this->load->view('themes/' . $theme . '/template/product/index', $data);
		} else {
			$this->load->view('themes/default/template/product/index', $data);
		}
	}
	public function addproduct() {
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$data['gst'] = $this->setting->get('gst');
		$data['shipping_fee'] = $this->setting->get('shipping_fee');
		$data['cod_charge'] = $this->setting->get('cod_charge');
		$data['tcs_fee'] = $this->setting->get('tcs_fee');
		$data['brands'] = $this->product->get_brand_by_shop();
		$data['categories'] = $this->product->get_category_by_shop();


		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/product/add')) {
			$this->load->view('themes/' . $theme . '/template/product/add', $data);
		} else {
			$this->load->view('themes/default/template/product/add', $data);
		}

	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('product_name', 'product Name', 'required');
		$this->form_validation->set_rules('stock', 'stock', 'required');
		$this->form_validation->set_rules('small_desc', 'Product Description', 'required');
		$this->form_validation->set_rules('brand_id', 'Brand', 'required');
		$this->form_validation->set_rules('cat_id', 'Category', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');



			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('products/addproduct');
			} else {
				$mid = $this->session->userdata('m_id');
				$shopdata= $this->product->getshopbymer($mid);
				$shop_id = $shopdata->shop_id;

				$data = array(
					'product_name' => post('product_name'),
					'product_slug' =>$this->generatUnique(post('product_name')),
					'stock'=>post('stock'),
					'small_desc'=>post('small_desc'),
					'brand_id' => post('brand_id'),
					'product_cat_id' => post('cat_id'),
					'price' => post('price'),
					'merchant_id'=> post('merchant_id'),
					'shop_id'=> $shop_id,
					'qty'=> post('qty'),
					'total_price' => post('total_amt'),
					'is_popular'=> post('is_popular'),

				);
				$ret = $this->product->insert($data);
				// update attributes

	        	// update images
	        	$data2 = $this->input->post();
	        	if ($this->input->post('attachment')) {
	        		$this->product->insertPrImage($data2 ,$ret,$shop_id);
	        	}
	        	// update amenities


        		$upload_path =  $this->config->item('upload_path').'/product';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('fileinput2')) {
                    $image = $this->upload->data();
                   	$data2= array(
		        		'product_image'=>$image['file_name'],

		        	);
		        	$where = array('product_id'=>$ret);
		        	$ret = $this->product->updateProd($data2,$where);
                }




				$this->session->set_flashdata('success', 'Product Added');
				redirect('products');



		}
	}

public function upload_attachment(){
	 	$upload_path =  $this->config->item('upload_path').'/product/';
	 	//echo $upload_path;
	 	//die;
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
                   		$data = array();
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

    public function edit($id = '') {
		if ('' == $id) {
			redirect('products');
		}
		$data = array();
		$data['shipping_fee'] = $this->setting->get('shipping_fee');
		$data['cod_charge'] = $this->setting->get('cod_charge');
		$data['tcs_fee'] = $this->setting->get('tcs_fee');
		$data['product'] = $this->product->getproductByid($id);
		$data['product_images'] = $this->product->getProdImages($id);
		$data['brands'] = $this->product->get_brand_by_shop();
		$data['categories'] = $this->product->get_category_by_shop();
		//$data['gst'] = $this->settings->get('gst');
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/product/edit')) {
			$this->load->view('themes/' . $theme . '/template/product/edit', $data);
		} else {
			$this->load->view('themes/default/template/product/edit', $data);

		}
	}
public function editchange() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('product_name', 'product Name', 'required');
		$this->form_validation->set_rules('stock', 'stock', 'required');
		$this->form_validation->set_rules('small_desc', 'Product Description', 'required');
		$this->form_validation->set_rules('brand_id', 'Brand', 'required');
		$this->form_validation->set_rules('product_cat_id', 'Category', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');



			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('products/edit/' . post('product_id') . '');
			} else {

				$mid = $this->session->userdata('m_id');
				$data = $this->input->post();
				$proid  = $data['product_id'];
				$shopdata= $this->product->getshopbymer($mid);
				$shop_id = $shopdata->shop_id;
				$this->product->update($data);
				if ($this->input->post('attachment')) {
	        		$this->product->deletePrImage($proid,$shop_id);
	        		$this->product->insertPrImage($data,$proid,$shop_id);
	        	}
				$data = $this->input->post();
				$this->product->update($data);
				//$data = $this->input->post();


	        	// update images

	        	// update amenities

	        	$upload_path =  $this->config->item('upload_path').'/product';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('fileinput2')) {
                    $image = $this->upload->data();
                   	$data2= array(
		        		'product_image'=>$image['file_name'],

		        	);
		        	$where = array('product_id'=>$proid);
		        	$ret = $this->product->updateProd($data2,$where);

                }






        		$this->session->set_flashdata('success', 'Product Successfully Updated');
        		redirect('products');

			}

	}
function productstatus($id){





			$ret = $this->product->productupdatestatus($id);

			$this->output->set_content_type('application/json')->set_output(json_encode($ret));

			$this->session->set_flashdata('success', 'Update Successfully  ');

		}

		function productdelete($id) {



	$ret=$this->product->productdelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

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
			$this->db->where('product_id !=',$id);
		}
		$this->db->where('product_slug',$store);
		$ret = $this->db->get('products');

		if($ret->row()){
			return true;
		}else{
			return false;
		}
	}
	public function gettaxrate(){
		$cat_id = $this->input->post('cat_id');
		$ret = $this->product->gettaxrate($cat_id);
		echo json_encode(array('taxrate'=>$ret->tax_rate));

	}
	public function getmarketrate(){
		$cat_id = $this->input->post('cat_id');
		$ret = $this->product->getmarketrate($cat_id);
		echo json_encode(array('marketrate1'=>$ret->market_comm_rate));

	}


 }

/* End of file product.php */
/* Location: ./application/controllers/product.php */ ?>