<?php

//load theme name from db to session['theme']

class Theme {
    
    var $CI;
    
    public function __construct(){
        
        $this->CI =& get_instance();
        
        $theme = $this->CI->db->query("SELECT value FROM settings where `set_key`='admin_theme'")->row()->value;        
        $this->CI->session->set_userdata('admin_theme',$theme);        
    }    
}