<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Index_model extends CI_Model {





     public function record_countusers() {
		
		
		$query = $this->db->get('tbl_users')->result();

		return count($query);
	}  

         
 public function record_countdeals() {
		
		
		$query = $this->db->get('tbl_product_deal')->result();

		return count($query);
	}  

  	

	

}



/* End of file Index_model.php */

/* Location: ./application/models/Index_model.php */