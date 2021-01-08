<?php 

class Google extends Model{
        
    //call after return from google auth
    public function google_returned(){
    
        $this->load->library('openid');
        
        $this->openid = new Openid;
        
        if($this->openid->mode){            
            if($this->openid->validate()) {
                
                $data = $this->openid->getAttributes();    

                $email = $data['contact/email'];

                //check db for existanse 
                $customer_from_db = $this->db->query('select * from customer` WHERE email="'.$email.'"')->row;

                //insert to db if not exists
                if(!$customer_from_db){

                    $this->load->model('account/customer');
                    
                        $customer_info = array(
                            'first_name' => $data['namePerson/first'],
                            'last_name' => $data['namePerson/last'],
                            'email' => $email,
                            'phone' => '',
                            'password' => '',
                            'created_on' => date('Y-m-d H:i:s'),
                            'enabled' => '1'
                        );

                        $customer_id = $this->loginModel->insert($customer_info);
                        
                }else{
                    $customer_id = $customer_from_db['c_id'];
                }

                $dat2 = array(
                    'c_id' => $customer_id,
                    'is_login' => 1,
                    'is_admin' => 0,
                );
                
                $this->session->set_userdata($dat2);

                return true;

            } else {
                $this->session->data['warning'] = "Error: Google Validation Not Completed Successfully!";
                return false;
            }
        } else {
            $this->session->data['warning'] = "Error: Google Validation Not Completed Successfully!";
            return false;
        }
    }    
}