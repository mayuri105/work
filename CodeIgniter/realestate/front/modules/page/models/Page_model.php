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

	public function insertContact(array $data){
		if ($this->db->insert('contact', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
}

/* End of file Page_model.php */
/* Location: ./application/models/Page_model.php */