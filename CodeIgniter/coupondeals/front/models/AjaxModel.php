<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class AjaxModel extends CI_Model {

	function __construct() {
	}
	
	public function userfollow($data = array()){
		 $this->db->select('tbl_brand_follow.follow_id');
        $this->db->where('brand_id',$data['brand_id']);
		$this->db->where('user_id',$data['user_id']);
       // $this->db->where(array('brand_id'=>$data['brand_id'],'user_id'=>$data['user_id']));
        $prevQuery = $this->db->get('tbl_brand_follow');
        $prevCheck = $prevQuery->num_rows();
        
        if($prevCheck > 0){
			 $prevResult = $prevQuery->row_array();
			// echo $prevResult
		
           $sql = "update tbl_brand_follow set follow_status = case when follow_status = 1 then 0 else 1 end
	    where user_id ='".$data['user_id']."' and brand_id ='".$data['brand_id']."'";
	    $ret = $this->db->query($sql);
		return $ret;
	    
        }else{
           
            $insert = $this->db->insert('tbl_brand_follow',$data);
			 $ret = $this->db->insert_id();
			 return $ret;
			
        }

      return $ret;  
    }
	
	
public function insertsub($data){
		if ($this->db->insert('tbl_subscribe_user',$data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}	
	
}
       