<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class biddetail_models extends CI_Model {

	
public function allBid(){
   
        $this->db->select('bid.*,customer.*,property.property_title,property.feature_image,property.property_slug,property.cost,bid_dates_property.*', FALSE);
            
        //$this->db->order_by('date_time' as only_date, date('Y-m-d'));
        $this->db->group_by('bid.property_id');
        $this->db->order_by('date_time', 'desc');
        $this->db->like('date_time',  date('Y-m-d'));
        $this->db->join('customer', 'customer.c_id = bid.customer_id', 'left');
        $this->db->join('property', 'property.property_id = bid.property_id', 'left');
         $this->db->join('bid_dates_property', 'bid_dates_property.property_id = bid.property_id');
        $this->db->where('bid_dates_property.dates', date('Y-m-d'));
        $result = $this->db->get('bid')->result();
         //echo $this->db->last_query();
    return $result;
    }      
	
}


