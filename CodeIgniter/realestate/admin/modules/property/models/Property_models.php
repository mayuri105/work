<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property_models extends CI_Model {

	
	/**
	 * @name string TABLE_NAME Holds the name of the table in use by this model
	 */
	const TABLE_NAME = 'property';

	/**
	 * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	 */
	const PRI_INDEX = 'property.property_id';

	public function record_count() {
		$property = $this->input->get('property');
		$status = $this->input->get('status');
		$property_type = $this->input->get('property_type');
		$property_action = $this->input->get('property_action');
		
		
		if ($property) {
			$this->db->like('property_title', $property);
		}
		if ($status) {
			$this->db->where('status', $status);
		}
		if ($property_type) {
			$this->db->where('property_type', $property_type);
		}
		if ($property_action) {
			$this->db->where('property_action', $property_action);
		}

		$this->db->order_by(self::PRI_INDEX, 'desc');
		$query = $this->db->get(self::TABLE_NAME)->result();
		return count($query);
	}

	public function fetch_data($limit, $start) {
		$property = $this->input->get('property');
		$status = $this->input->get('status');
		$property_type = $this->input->get('property_type');
		$property_action = $this->input->get('property_action');
		
		if ($property) {
			$this->db->like('property_title', $property);
		}
		if ($status) {
			$this->db->where('status', $status);
		}
		if ($property_type) {
			$this->db->where('property_type', $property_type);
		}
		if ($property_action) {
			$this->db->where('property_action', $property_action);
		}

		$this->db->limit($limit, $start);
		$this->db->order_by(self::PRI_INDEX, 'desc');
		$this->db->join('category', 'category.cat_id = property.property_type', 'left');
		$query = $this->db->get(self::TABLE_NAME);
		return $query->result();
	}

	public function insert(Array $data) {
		if ($this->db->insert(self::TABLE_NAME, $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function update(Array $data, $where = array()) {
		$data2  = array(

			'property_title' => $data['property_title'],
			'property_slug' =>$this->generatUnique($data['property_title'],$data['property_id']),
			'property_small_desc'=>$data['property_small_desc'],
			'status'=>$data['property_status'],
			'property_content' => $data['property_content'],
			'property_type' => $data['property_type'],
			'property_action' => $data['property_action'],
			'beds' => $data['beds'],
			'bathrums' => $data['bathrums'],
			'landmark' => $data['landmark'],
			'area' => $data['area'],
			'built_up_area' => $data['built_up_area'],
			'property_owner' => $data['property_owner'],
			'property_owner_phone' => $data['property_owner_phone'],
			'carpet_area' => post('carpet_area'),
			'cost' => $data['cost'],
			'bid_difference'=> $data['bid_difference'],
			'open_for_bid'=>$data['open_for_bid'],
			'set_in_slider_img'=>$data['set_in_slider_img'],
			'set_as_feature'=>$data['set_as_feature'],
		);
		$where = array('property_id'=>$data['property_id']);
		$this->db->update(self::TABLE_NAME, $data2, $where);
		return $this->db->affected_rows();
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
	public function updateProp(Array $data, $where = array()){
		if (!is_array($where)) {
			$where = array(self::PRI_INDEX => $where);
		}
		$this->db->update(self::TABLE_NAME, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete($id) {
		$this->db->where(self::PRI_INDEX, $id);
		$this->db->delete(self::TABLE_NAME);
		return $this->db->affected_rows();
	}

	

	public function getpropertyByid($id){
		$this->db->select('property.*,GROUP_CONCAT(amenities_id) as at,user.username', FALSE);
        $this->db->where(self::PRI_INDEX, $id);
        $this->db->join('amenities_to_property', 'amenities_to_property.property_id = property.property_id', 'left');
        $this->db->join('user', 'user.u_id = property.posted_by_id', 'left');
		$query=  $this->db->get(self::TABLE_NAME)->row();
        return $query;
    }
    public function getBidonproperty($id){
    	$this->db->where('property_id', $id, FALSE);
    	$this->db->join('customer', 'customer.c_id = bid.customer_id', 'left');
    	$query=  $this->db->get('bid')->result();
        return $query;
    }
    public function getRentproperty($id){
    	$this->db->where('property_id', $id, FALSE);
    	$this->db->join('customer', 'customer.c_id = rented_propety.customer_id', 'left');
    	$query=  $this->db->get('rented_propety')->row();
        return $query;
    }
    public function getSoldproperty($id){
    	$this->db->where('property_id', $id, FALSE);
    	$this->db->join('customer', 'customer.c_id = sale_property.customer_id', 'left');
    	$query=  $this->db->get('sale_property')->row();
        return $query;
    }
    
   	

   	public function getProImages($id){
        $this->db->where('property_id', $id);
        $query=  $this->db->get('property_images')->result();
        return $query;
    }
 	 	
 	public function getRoiTable($id){
        $this->db->where('property_id', $id);
        $query=  $this->db->get('roi_table')->result();
        return $query;
    }
    public function insertPrAttr(array $data){
    	foreach($data['attributes'] as $attribute){
    		$attribute['property_id'] = $data['property_id'];
    		$ret = 	$this->db->insert('property_attributes', $attribute);
    	}	
    	
    }
   
    
    public function getAttributes(){
    	$this->db->order_by('attributes_groups.ag_id', 'asc');
    	 $grups= $this->db->get('attributes_groups')->result();
        foreach ($grups as $g)
        {
            $return[$g->ag_id] = $g;
            $return[$g->ag_id]->attribute = $this->getAttributesBygrup($g->ag_id); // Get the categories sub categories
        }
        return $return;

    }

     public function getAttributesBygrup($attributes_group_id){
        $this->db->where('specification_attributes.attributes_group_id', $attributes_group_id);
        $att= $this->db->get('specification_attributes')->result();
        return $att;
    }
    public function getProAttributes($id){
        $this->db->where('property_id', $id);
        $query=  $this->db->get('property_attributes')->result();
        return $query;
    }
    public function getBidDates($id){
        $this->db->where('property_id', $id);
        $query=  $this->db->get('bid_dates_property')->result();
        return $query;
    }


    public function getAmenities(){
		$query=  $this->db->get('amenities')->result();
		return $query;
    }
    
    public function detetePrAtt($id) {
		$this->db->where('property_id', $id);
		$this->db->delete('property_attributes');
		return $this->db->affected_rows();
	}

	
    public function detetePrImag($id) {
		$this->db->where('property_id', $id);
		$this->db->delete('property_images');
		return $this->db->affected_rows();
	}	
	
	public function detetePrBidDates($id) {
		$this->db->where('property_id', $id);
		$this->db->delete('bid_dates_property');
		return $this->db->affected_rows();
	}
	public function detetePrRoiTable($id) {
		$this->db->where('property_id', $id);
		$this->db->delete('roi_table');
		return $this->db->affected_rows();
	}	
	public function insertPrImage(array $data){

    	$total = count($data['attachment']);
    	for ($i=0; $i < $total ; $i++) { 
    		$data2['property_id'] = $data['property_id'];
    		$data2['image_name'] = $data['attachment'][$i];
    		$this->db->insert('property_images', $data2);
    	}	
    }


    
   		
    public function detetePrAmenities($id) {
		$this->db->where('property_id', $id);
		$this->db->delete('amenities_to_property');
		return $this->db->affected_rows();
	}
    public function insertPrAmenities(array $data){
    	$total = count($data['amenities']);
    	for ($i=0; $i < $total ; $i++) { 
    		$data2['property_id'] = $data['property_id'];
    		$data2['amenities_id'] = $data['amenities'][$i];
    		$this->db->insert('amenities_to_property', $data2);
    	}	
    }
    
    public function setAprvdisapprove($id){
    	$result = $this->getpropertyByid($id);
    	$data = array(
    		'approved'=>$result->approved ? '0' : '1'
    	);
    	$where = array('property_id'=>$id);
    	$ret = $this->db->update(self::TABLE_NAME, $data, $where);
    	return $ret;
    }
    public function getUsers(){
    	$this->db->where('status', '1');
    	$query=  $this->db->get('user')->result();
		return $query;
    }
    public function getAreas(){
    	$this->db->where('enabled', '1');
    	$query=  $this->db->get('area')->result();
		return $query;
    }


    public function getTypes(){
    	$this->db->where('enabled', '1');
    	$query=  $this->db->get('category')->result();
		return $query;
    }
    public function insertPrBidDates(array $data,$proid){
		foreach ($data as $key) {
			
			$data2['property_id'] = $proid;
    		$data2['dates'] = date('Y-m-d',strtotime($key['value']));
			$this->db->insert('bid_dates_property', $data2);
			// echo $this->db->last_query();
			// die;
		}
    } 
     public function insertPrRoiInvestments(array $data,$proid){
		foreach ($data as $key) {
			
			$data2['property_id'] = $proid;
    		$data2['year'] = $key['year'];
    		$data2['return_of_investment'] = $key['return_of_investment'];
			$this->db->insert('roi_table', $data2);
			// echo $this->db->last_query();
			// die;
		}
    }


    public function insertPrAmenitiesAdd(array $data,$proid){
    		
    	foreach ($data as $key) {
			$data2['property_id'] = $proid;
    		$data2['amenities_id'] = $key['amenities'];
			$this->db->insert('amenities_to_property', $data2);
		}
    }
    public function insertPrImageAdd(array $data,$proid){
    	foreach ($data as $key) {
			$data2['property_id'] = $proid;
    		$data2['image_name'] = $key['image_name'];
			$this->db->insert('property_images', $data2);
		}

    }
    public function insertPrAttrAdd(array $data,$prid){
    	foreach($data as $attribute){
    		$attribute['property_id'] = $prid;
    		$ret = 	$this->db->insert('property_attributes', $attribute);
    	}	
    }



}

/* End of file Area_models.php */
/* property: ./application/models/Area_models.php */