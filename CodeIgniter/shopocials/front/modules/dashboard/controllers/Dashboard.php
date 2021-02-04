<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	
	 function Dashboard()
    {
        
         
        $subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2);
        $subdomain_name = $subdomain_arr[0];
         
         
        $this->db->from('shop')->where('domain_name', $subdomain_name);
        $query = $this->db->get();
         
        if($query->num_rows() < 1)
        {
        redirect ('error');
        }
 
    }
 
    function index()
    {
        $subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2);
        $subdomain_name = $subdomain_arr[0];
         
        $this->db->from('shop')->where('domain_name', $subdomain_name);
        $query = $this->db->get();
         
        $subdomain_info = $query->row();
        $data['shop_name'] = $subdomain_info->shop_name;
       $theme = $this->session->userdata('front_theme');
		
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/dashboard')) {
            $this->load->view('themes/' . $theme . '/template/common/dashboard', $data);
        }else{
            $this->load->view('themes/default/template/common/dashboard', $data);
        }
       
    }
   	

	

}	

/* End of file index.php */
/* Location: ./application/controllers/index.php */ 
