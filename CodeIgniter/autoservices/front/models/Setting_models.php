<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting_models extends CI_Model {


	function get($key = false){
		if (!$key)
            return $this->db->get('settings')->result_array();
        else
            $result = $this->db->get_where('settings', array('set_key' => $key))->row_array();
        return $result['value'];
	}

	public function update($name, $value) {
        $data = array(
            'value' => $value,
        );

        $this->db->where('set_key', $name);
        $this->db->update('settings', $data);
        return $this->db->affected_rows();
    }
    
}

