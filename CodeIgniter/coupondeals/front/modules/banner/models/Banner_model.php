<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Banner_model extends CI_Model {
    
      public function getBanner(){
    	
        $query=  $this->db->get('tbl_banner')->result();
        return $query;
    }

}