<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Menu_m extends CI_Model {
    
    function getFullListFromDB($parent_id = '0') {
         
        $this->db->order_by('nav.m_order', 'asc');
       
        $this->db->where('nav.parent_id',$parent_id);
       
        $result  = $this->db->get('nav')->result_array();

        foreach($result as &$value) {

            $subresult = $this->getFullListFromDB($value["id"]);

            if (count($subresult) > 0) {
                $value['children'] = $subresult;
            }
        }
        //unset($value);
       // echo $this->db->last_query();
        return $result;
    }

}