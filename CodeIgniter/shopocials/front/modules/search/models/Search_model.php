<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search_model extends CI_Model {

    public function getstores($street_number = '', $city, $state, $zip, $type = '', $cusine = '', $orderby, $offset = '0') {
        $this->db->select('store.*,city.*,
			AVG(store_review.review_rating)as rating_avg, 
			GROUP_CONCAT(zipcode) as zips,
			if(store.ads_status = 1 && CURDATE() between store.ads_start_date AND store.ads_end_date,1,0 ) as q
		', FALSE);

        $this->db->order_by('q', 'desc');

        if ($orderby == 'name') {

            $this->db->order_by('store_name', 'asc');
        } elseif ($orderby == 'rating') {
            $this->db->order_by('rating_avg', 'desc');
        } else {
            $this->db->order_by('store_name', 'desc');
        }
        $this->db->group_by('store.store_id');


        $rating = $this->session->userdata('rating');
        if ($rating) {
            $rating == 5 ? $this->db->having('rating_avg', $rating) : $this->db->having('rating_avg >=', $rating);
        }
        $min = $this->session->userdata('min');
        if ($min) {
            $min == 1 ? $this->db->having('minorder', '0') : $this->db->having('minorder <= ', $min);
        }
        if ($type) {
            $this->db->where('type', $type);
        }
        if ($city) {
            $this->db->like('city_name', $city, 'both');
        }
        if ($state) {
            $this->db->where('state', $state);
        }
        if ($street_number) {
            $this->db->or_like('store_street', $street_number, 'both');
        }


        if ($zip) {
            $this->db->where_in('zipcode', $zip);
        }
        
        if ($cusine) {

            $this->db->join('store_cuisine_data', 'store_cuisine_data.s_id = store.store_id', 'left');
            $this->db->join('cusine_data', 'cusine_data.cu_id = store_cuisine_data.cuisine_id', 'left');
            $this->db->where('cusine_type', $cusine);
        }
        $keyword = cleanstring($this->input->get('keyword'));
        $this->db->like('store.store_name', $keyword, 'both');

        $this->db->join('city', 'city.city_id = store.store_city', 'left');
        $this->db->join('merchant_type', 'merchant_type.mt_id = store.store_type', 'left');
        $this->db->join('store_review', 'store_review.store_id = store.store_id', 'left');
        $this->db->join('store_delivery_zip', 'store_delivery_zip.store_id = store.store_id', 'left');
        $this->db->join('city_zipcode', 'city_zipcode.cz_id = store_delivery_zip.zip_code_id', 'left');
        $this->db->where('store.status', '1');
        $this->db->where('city_zipcode.enabled', '1');
        $query = $this->db->get('store', 10, $offset);


        if ($query->result()) {
            return $query->result();
        } else {
            return 0;
        }
    }

    public function gettotalstore($street_number, $city, $state, $zip, $type = '', $cusine = '', $orderby) {
        $this->db->select('store.*,city.*,
			AVG(store_review.review_rating)as rating_avg, 
			GROUP_CONCAT(zipcode) as zips,
			if(store.ads_status = 1 && CURDATE() between store.ads_start_date AND store.ads_end_date,1,0 ) as q
		', FALSE);

        $this->db->order_by('q', 'desc');

        if ($orderby == 'name') {

            $this->db->order_by('store_name', 'asc');
        } elseif ($orderby == 'rating') {
            $this->db->order_by('rating_avg', 'desc');
        } else {
            $this->db->order_by('store_name', 'desc');
        }
        $this->db->group_by('store.store_id');


        $rating = $this->session->userdata('rating');
        if ($rating) {
            $rating == 5 ? $this->db->having('rating_avg', $rating) : $this->db->having('rating_avg >=', $rating);
        }
        $min = $this->session->userdata('min');
        if ($min) {
            $min == 1 ? $this->db->having('minorder', '0') : $this->db->having('minorder <= ', $min);
        }
        if ($type) {
            $this->db->where('type', $type);
        }
        if ($city) {
            $this->db->like('city_name', $city, 'both');
        }
        if ($state) {
            $this->db->where('state', $state);
        }
        if ($street_number) {
            $this->db->or_like('store_street', $street_number, 'both');
        }


        if ($zip) {
            $this->db->where_in('zipcode', $zip);
        }
        
        if ($cusine) {

            $this->db->join('store_cuisine_data', 'store_cuisine_data.s_id = store.store_id', 'left');
            $this->db->join('cusine_data', 'cusine_data.cu_id = store_cuisine_data.cuisine_id', 'left');
            $this->db->where('cusine_type', $cusine);
        }
        $keyword = cleanstring($this->input->get('keyword'));
        $this->db->like('store.store_name', $keyword, 'both');

        $this->db->join('city', 'city.city_id = store.store_city', 'left');
        $this->db->join('merchant_type', 'merchant_type.mt_id = store.store_type', 'left');
        $this->db->join('store_review', 'store_review.store_id = store.store_id', 'left');
        $this->db->join('store_delivery_zip', 'store_delivery_zip.store_id = store.store_id', 'left');
        $this->db->join('city_zipcode', 'city_zipcode.cz_id = store_delivery_zip.zip_code_id', 'left');
        $this->db->where('store.status', '1');
        $this->db->where('city_zipcode.enabled', '1');
        $query = $this->db->get('store')->result();

        return count($query);
    }

    public function getcitybyname($city, $state) {
        $this->db->where('state', $state);
        $this->db->where('city_name', $city);
        $query = $this->db->get('city');

        if ($query->row()) {
            return $query->row();
        } else {
            return 0;
        }
    }

    public function getcityBystate($state) {
        $this->db->where('state', $state);
        $query = $this->db->get('city');
        if ($query->result()) {
            return $query->result();
        } else {
            return 0;
        }
    }

}

/* End of file Search_model.php */
/* Location: ./application/models/Search_model.php */