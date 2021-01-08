<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Investment_models extends CI_Model {

	public function getTestimonial() {
		$ret = $this->db->get('testimonial');
		return $ret->result();
	}
	public function getClientImages() {
		$ret = $this->db->get('client_images');
		return $ret->result();
	}

	public function getProperty() {
		$this->db->limit(3);
		// / $this->db->group_by('property.property_id');
        $this->db->join('category', 'category.cat_id = property.property_type', 'left');
       
        $this->db->where('property_action', 'investments');
		$this->db->where('set_as_feature', '1');
		$property = $this->db->get('property')->result();
		return $property;
	}
    public function sliderproperty(){

        $this->db->where('set_in_slider_img', '1');
        $this->db->where('property_action =', 'investments');
        $property = $this->db->get('property')->result();
        return $property;

    }
	public function getSoldProp($property_id) {
		$this->db->where('property_id', $property_id);
        $this->db->join('category', 'category.cat_id = property.property_type', 'left');
       
		$this->db->join('customer', 'customer.c_id = sale_property.customer_id', 'left');
		$ret = $this->db->get('sale_property')->row();
		return $ret;
	}


	public function getProperties($limit, $start) {
        $keyword = $this->input->get('keyword');
        $area = $this->input->get('area');
        $type = $this->input->get('type');
        $actions = $this->input->get('actions');
        $min_price = $this->input->get('min-price');
        $max_price = $this->input->get('max-price');
        $min_area = $this->input->get('min-area');
        $max_area = $this->input->get('max-area');
        
        $status = $this->input->get('status');
        if ($keyword) {
            $this->db->like('property_title', $keyword, 'both');
        }
        if ($area) {
            $this->db->where('area', $area);
        }
        if ($type) {
            $this->db->where('property_type', $type);
        }
        
        if($min_price){
            $this->db->where('cost >= ',$min_price);
        }
        if($max_price){
            $this->db->where('cost <=', $max_price);
        }
        if($min_area){
            $this->db->where('built_up_area >= ',$min_area);
        }
        if($max_area){
            $this->db->where('built_up_area <=', $max_area);
        }
        if($status){
            $this->db->where('status', $status);
        }   

		$this->db->where('property.approved', '1');
         $this->db->where('property_action', 'investments');
         $this->db->join('category', 'category.cat_id = property.property_type', 'left');
       
		$this->db->limit($limit, $start);
		$property = $this->db->get('property')->result();
		if ($property) {
            foreach ($property as $pr) {
                $return[$pr->property_id] = $pr;
                $return[$pr->property_id]->sold = $this->getSoldProp($pr->property_id);

            }
            return $return;
        } else {
            return 0;
        }

	}

	public function recrdTotProp() {
		$keyword = $this->input->get('keyword');
        $area = $this->input->get('area');
        $type = $this->input->get('type');
        $actions = $this->input->get('actions');
        $min_price = $this->input->get('min-price');
        $max_price = $this->input->get('max-price');
        $status = $this->input->get('status');
        $min_area = $this->input->get('min-area');
        $max_area = $this->input->get('max-area');
                       
        if ($keyword) {
            $this->db->like('property_title', $keyword, 'both');
        }
        if ($area) {
            $this->db->where('area', $area);
        }
        if ($type) {
            $this->db->where('property_type', $type);
        }
        
        if($min_price){
            $this->db->where('cost >= ',$min_price);
        }
        if($max_price){
            $this->db->where('cost <=', $max_price);
        }
        if($min_area){
            $this->db->where('built_up_area >= ',$min_area);
        }
        if($max_area){
            $this->db->where('built_up_area <=', $max_area);
        }
        if($status){
            $this->db->where('status', $status);
        }   
        $this->db->where('property_action', 'investments');
        $this->db->where('property.approved', '1');
		return $this->db->count_all_results('property');
	}
    public function getPropertyBySlug($slug) {

		$prop_slug = str_replace('_', '-', $slug);

		$this->db->where('property.approved', '1');

		$this->db->where('property.property_slug', $prop_slug);
        $this->db->join('category', 'category.cat_id = property.property_type', 'left');
       
        $this->db->join('area', 'area.area_id = property.area', 'left');
		$property = $this->db->get('property')->result();

		if ($property) {
			foreach ($property as $pr) {
				$return[$pr->property_id] = $pr;
				$return[$pr->property_id]->images = $this->getImagesList($pr->property_id);
				$return[$pr->property_id]->amenity = $this->getAmenityList($pr->property_id);
				$return[$pr->property_id]->addtional = $this->getAddtionalList($pr->property_id);
                $return[$pr->property_id]->roitable = $this->getRoiTable($pr->property_id);
                
	       }    
           return $return;
		} else {
			return 0;
		}
        
	}

	public function getImagesList($property_id) {
		$this->db->where('property_id', $property_id);
		$images = $this->db->get('property_images')->result();
		return $images;
	}
    public function getRoiTable($property_id) {
        $this->db->where('property_id', $property_id);
        $images = $this->db->get('roi_table')->result();
        return $images;

    }
	public function getAmenityList($property_id) {
		$this->db->where('property_id', $property_id);
		$this->db->join('amenities_to_property', 'amenities_to_property.amenities_id = amenities.amenities_id', 'left');
		$amentiy = $this->db->get('amenities')->result();
		return $amentiy;

	}
	public function getAddtionalList($property_id) {
		$this->db->where('property_id', $property_id);
		$this->db->join('property_attributes', 'property_attributes.attributes_id = specification_attributes.sa_id', 'left');
		$this->db->join('attributes_groups', 'attributes_groups.ag_id = specification_attributes.attributes_group_id', 'left');
		$amentiy = $this->db->get('specification_attributes')->result();
		return $amentiy;
	}

	public function getLocation() {
		$this->db->where('enabled', '1');
		$ret = $this->db->get('area');
		return $ret->result();
	}

    public function getType() {
        $this->db->where('enabled', '1');
        $ret = $this->db->get('category');
        return $ret->result();
    }
    

}