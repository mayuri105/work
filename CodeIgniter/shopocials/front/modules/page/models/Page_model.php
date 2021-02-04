<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
		
	}

	public function getpage($url)
	{
		$url_alias =  str_replace('_', '-',$url);
		$this->db->where('unique_alias', $url_alias);
		$ret = $this->db->get('page');
		return $ret->row();
	}
	public  function getCity($code){
        $state = $code;
        $this->db->where('state',$state);
        $ret = $this->db->get('city')->result();
        return $ret;
    }


    public  function insertMerchant()
    {
    	$data  = array(
			'username' =>post('email'),
			'business_name' =>post('BusinessName'),
			'physical_street' =>post('streetaddress'),
			'physical_city' =>post('city'),
			'physical_state' =>post('state'),
			'physical_zip_code' =>post('zipcode'),
			'created_on'=>date('Y-m-d'),
			'phone'=>post('phone')
				 
		);
    	$ret = $this->db->insert('merchant', $data);
    	return $ret;
    }
public function insertcontact(Array $data) {
        if ($this->db->insert('contact', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
}

/* End of file Page_model.php */
/* Location: ./application/models/Page_model.php */