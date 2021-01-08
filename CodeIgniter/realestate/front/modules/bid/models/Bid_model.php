<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Bid_model extends CI_Model {

	
    public function getPropertyBySlug($slug) {

		$prop_slug = str_replace('_', '-', $slug);
		$this->db->where('property.approved', '1');
		$this->db->where('property.property_slug', $prop_slug);
		$current = date('H:i:s');
        $this->db->where('start_time <=',  $current);
        $this->db->where('end_time >=',  $current);
        $this->db->where('bid_dates_property.dates', date('Y-m-d'));
        $this->db->where('open_for_bid', '1');
        $this->db->join('bid_dates_property', 'bid_dates_property.property_id = property.property_id', 'left');
        $this->db->join('bid_time_table', 'bid_time_table.date = bid_dates_property.dates');
        $this->db->join('category', 'category.cat_id = property.property_type', 'left');
       
		$property = $this->db->get('property')->result();
		if ($property) {
			foreach ($property as $pr) {
				$return[$pr->property_id] = $pr;
				$return[$pr->property_id]->images = $this->getImagesList($pr->property_id);
				$return[$pr->property_id]->amenity = $this->getAmenityList($pr->property_id);
				$return[$pr->property_id]->addtional = $this->getAddtionalList($pr->property_id);
				$return[$pr->property_id]->bid = $this->getBidList($pr->property_id);
				
			}
			return $return;
		} else {
			return 0;
		}

	}



	public function  getBidList($property_id){
		$this->db->order_by('bid_id', 'desc');
		$this->db->where('property_id', $property_id);
		$images = $this->db->get('bid')->row();
		return $images;
	}
	
	public function  getPropertyDetails($property_id){
		$this->db->where('property_id', $property_id);
		$images = $this->db->get('property')->row();
		return $images;
	}
	public function getImagesList($property_id) {
		$this->db->where('property_id', $property_id);
		$images = $this->db->get('property_images')->result();
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
    
    public function getTimeslot($date){
        
        $this->db->where('date',date('Y-m-d',strtotime($date)));
        $occupieds =  $this->db->get('bid_time_table')->row();

        if ($occupieds) {
        	
         	$return = array(
                'start_time' => date('g:i:a',strtotime($occupieds->start_time)),
                'end_time' =>date('g:i:a',strtotime($occupieds->end_time)),
            );
            return $return;
        }else{
        	return 0;
        }
    }
    public function getCustomerBids()
    {	
    	$customer_id = $this->session->userdata('c_id');
    	$this->db->group_by('bid.property_id');
    	$this->db->select('MAX(`amount`) AS `amt`, bid.*,property.*');
    	$this->db->join('property', 'property.property_id = bid.property_id', 'left');
		$this->db->where('`bid.property_id` IN(SELECT `property_id` FROM `bid` WHERE `customer_id` = '.$customer_id.')',NULL);
		$result = $this->db->get('bid')->result();
		//echo $this->db->last_query();
		return $result;
    }

    public function  insertBid(array $data){
    	if ($this->db->insert('bid', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
    }

    public function getlastbidders($slug){
    	$prop_slug = str_replace('_', '-', $slug);
		$this->db->where('property.approved', '1');
		$this->db->where('property.property_slug', $prop_slug);
		$this->db->where('open_for_bid', '1');
		$this->db->join('category', 'category.cat_id = property.property_type', 'left');
       
		$property = $this->db->get('property')->result();
		if ($property) {
			foreach ($property as $pr) {
				$return[$pr->property_id] = $pr;
				$return[$pr->property_id]->images = $this->getImagesList($pr->property_id);
				$return[$pr->property_id]->bid = $this->getBidWinner($pr->property_id);
			}
			return $return;
		} else {
			return 0;
		}

    }
    public function getBidWinner($property_id){

    	$this->db->limit(5);
    	$this->db->select(' bid.*,customer.*', FALSE);
    	$this->db->order_by('amount', 'desc');
    	$this->db->where('bid.property_id',$property_id);
    	$this->db->join('customer', 'customer.c_id = bid.customer_id', 'left');
    	$result = $this->db->get('bid')->result();
    	return $result;
    }


    public function checkbidtimeover(){
    		
    	$current = date('H:i:s');
        $this->db->where('start_time <=',  $current);
        $this->db->where('end_time >=',  $current);
      	$this->db->where('bid_time_table.date', date('Y-m-d'));
        $ret = $this->db->get('bid_time_table')->row();
        return $ret;	
    }
    public function checkAlreadyBided($property_id){
    	$customer_id = $this->session->userdata('c_id');
    	$this->db->where('customer_id',$customer_id, FALSE);
    	$this->db->where('property_id',$property_id, FALSE);
    	$result = $this->db->get('bid')->row();
    	return $result;
    }

   
    public function updatebid(Array $data, $where = array()) {
        if (!is_array($where)) {
            $where = array('bid_id' => $where);
        }
        $this->db->update('bid', $data, $where);
        return $this->db->affected_rows();
    }

    public function getlastbids($property_id){
    	$this->db->select(' bid.*,property.*', FALSE);
    	$this->db->select_max('amount');
    	$this->db->where('bid.property_id',$property_id);
    	$this->db->join('property', 'property.property_id = bid.property_id', 'left');
    	$result = $this->db->get('bid')->row();
    	return $result;
    }

     public function latestBid($property_id){
        $this->db->select('bid.*,customer.*,property.property_title', FALSE);
        $this->db->order_by('amount', 'desc');
        $this->db->where('bid.property_id',$property_id);
        $this->db->join('customer', 'customer.c_id = bid.customer_id', 'left');
        $this->db->join('property', 'property.property_id = bid.property_id', 'left');
        $result = $this->db->get('bid')->result();
        return $result;
    }       
}