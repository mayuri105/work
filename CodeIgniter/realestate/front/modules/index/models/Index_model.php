<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Index_model extends CI_Model {



    public function getpage() {
        $this->db->where( 'show_on_menu', '1' );
        $ret = $this->db->get( 'page' );
        return $ret->result();
    }
    public function getTestimonial() {
        $ret = $this->db->get( 'testimonial' );
        return $ret->result();
    }
    public function getClientImages() {
        $ret = $this->db->get( 'client_images' );
        return $ret->result();
    }

    
    public function getLocation(){
        $this->db->where( 'enabled', '1' );
        $ret = $this->db->get( 'area' );
        return $ret->result();
    }
   

    public function getImagesList( $property_id ) {
        $this->db->where( 'property_id', $property_id );
        $images = $this->db->get( 'property_images' )->result();
        return $images;

    }
    public function getAmenityList( $property_id ) {
        $this->db->where( 'property_id', $property_id );
        $this->db->join( 'amenities_to_property', 'amenities_to_property.amenities_id = amenities.amenities_id', 'left' );
        $amentiy = $this->db->get( 'amenities' )->result();
        return $amentiy;

    }
    public function getAddtionalList($property_id ){
        $this->db->where( 'property_id', $property_id );
        $this->db->join( 'property_attributes', 'property_attributes.attributes_id = specification_attributes.sa_id', 'left' );
        $this->db->join( 'attributes_groups', 'attributes_groups.ag_id = specification_attributes.attributes_group_id', 'left' );
        $amentiy = $this->db->get( 'specification_attributes' )->result();
        return $amentiy;
    }
    
    
    public function getBidProperty(){
        $current = date('H:i:s');
        $this->db->group_by('property.property_id');
        $this->db->where('start_time <=',  $current);
        $this->db->where('end_time >=',  $current);
        $this->db->where( 'property.approved','1');
        $this->db->where('bid_dates_property.dates', date('Y-m-d'));
        $this->db->where('open_for_bid', '1');
        $this->db->join('category', 'category.cat_id = property.property_type', 'left');
        $this->db->join('bid_dates_property', 'bid_dates_property.property_id = property.property_id', 'left');
        
        $this->db->join('bid_time_table', 'bid_time_table.date = bid_dates_property.dates');
        $property = $this->db->get( 'property' )->result();
        
       // echo $this->db->last_query();
        if ( $property ) {
            foreach ( $property as $pr ) {
                $return[$pr->property_id] = $pr;
                $return[$pr->property_id]->sold = $this->getSoldProp( $pr->property_id );
                $return[$pr->property_id]->bid = $this->getBidList($pr->property_id);
            }
            return $return;
        }else {
           return 0;
        }
    }
 public function getupBidProperty(){
        $current = date('H:i:s');
        $this->db->group_by('property.property_id');
        //$this->db->where('start_time <=',  $current);
        //$this->db->where('end_time >=',  $current);
        $this->db->where( 'property.approved','1');
        //$this->db->where('bid_dates_property.dates', date('Y-m-d'));
        $this->db->where('open_for_bid', '1');
        $this->db->join('category', 'category.cat_id = property.property_type', 'left');
        $this->db->join('bid_dates_property', 'bid_dates_property.property_id = property.property_id', 'left');
        
        $this->db->join('bid_time_table', 'bid_time_table.date = bid_dates_property.dates');
        $property = $this->db->get( 'property' )->result();
        
      $this->db->last_query();
        if ( $property ) {
            foreach ( $property as $pr ) {
                $return[$pr->property_id] = $pr;
                $return[$pr->property_id]->sold = $this->getSoldProp( $pr->property_id );
                $return[$pr->property_id]->bid = $this->getBidList($pr->property_id);
            }
            return $return;
        }else {
           return 0;
        }
    }
    public function  getbidended(){
        
        $this->db->group_by('property.property_id');
        $this->db->where( 'property.approved','1');
        $this->db->where('open_for_bid', '1');
        $current = date('H:i:s');
        $this->db->group_by('property.property_id');
        $this->db->where('end_time <=',  $current);
        $this->db->where('bid_dates_property.dates =', date('Y-m-d'));
        $this->db->join('bid_dates_property', 'bid_dates_property.property_id = property.property_id', 'left');
        $this->db->join('bid_time_table', 'bid_time_table.date = bid_dates_property.dates');
        $this->db->join('category', 'category.cat_id = property.property_type', 'left');
       
        $property = $this->db->get( 'property' )->result();
        
       // echo $this->db->last_query();
        if ( $property ) {
            foreach ( $property as $pr ) {
                $return[$pr->property_id] = $pr;
                $return[$pr->property_id]->sold = $this->getSoldProp( $pr->property_id );
                $return[$pr->property_id]->bid = $this->getBidList($pr->property_id);
            }
            return $return;
        }else {
           return 0;
        }

    }
    
    public function  todaysbidpro(){
        
        $this->db->group_by('property.property_id');
        $this->db->where( 'property.approved','1');
        $this->db->where('open_for_bid', '1');
        $this->db->group_by('property.property_id');
        $this->db->where('bid_dates_property.dates =', date('Y-m-d'));
        $this->db->join('bid_dates_property', 'bid_dates_property.property_id = property.property_id', 'left');
        $this->db->join('bid_time_table', 'bid_time_table.date = bid_dates_property.dates');
        $this->db->join('category', 'category.cat_id = property.property_type', 'left');
        $property = $this->db->get( 'property' )->result();
        //echo $this->db->last_query();
        if ( $property ) {
            foreach ( $property as $pr ) {
                $return[$pr->property_id] = $pr;
                $return[$pr->property_id]->sold = $this->getSoldProp( $pr->property_id );
                $return[$pr->property_id]->bid = $this->getBidList($pr->property_id);
            }
            return $return;
        }else {
           return 0;
        }

    }
     public function getSoldProperty(){
        $this->db->group_by('property.property_id');
        $this->db->limit(10);
        $this->db->join('property', 'property.property_id = sale_property.property_id', 'left');
        $this->db->join('customer', 'customer.c_id = sale_property.customer_id', 'left');
        $this->db->join('category', 'category.cat_id = property.property_type', 'left');
        $ret = $this->db->get('sale_property')->result();
        return $ret;

    }
    public function getRentProperty(){
        $this->db->group_by('property.property_id');
        $this->db->limit(10);
        $this->db->join('property', 'property.property_id = rented_propety.property_id', 'left');
        $this->db->join('customer', 'customer.c_id = rented_propety.customer_id', 'left');
        $this->db->join('category', 'category.cat_id = property.property_type', 'left');
        $ret = $this->db->get('rented_propety')->result();
        return $ret;
    }
    public function  getBidList($property_id){
        $this->db->order_by('bid_id', 'desc');
        $this->db->where('property_id', $property_id);
        $images = $this->db->get('bid')->row();
        return $images;
    }
    public function getSoldProp($property_id){
        $this->db->where('property_id',$property_id);
        $this->db->join('customer', 'customer.c_id = sale_property.customer_id', 'left');
        $ret = $this->db->get('sale_property')->row();
        return $ret;
    }

    public function nextbidtime(){
        $currnt = date('Y-m-d');
        $this->db->order_by('date');
        $this->db->limit('1');
        $this->db->where('date >=',$currnt);
        $ret = $this->db->get('bid_time_table')->row();
        //$this->db->last_query();
        return $ret;
    }
    public function getBidDates(){
        $currnt = date('Y-m-d');
        $this->db->order_by('date');
        $this->db->where('date >=',$currnt);
        $ret =  $this->db->get('bid_time_table')->result();
        return $ret;
    }
}
?>
