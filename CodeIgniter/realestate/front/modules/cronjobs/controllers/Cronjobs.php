<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Cronjobs extends MX_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->model('cronjobs_models', 'cronjob');
		
	}

	public function subscriptionexpriycheck(){
		$customerData =  $this->cronjob->getExpireSubscription();
		if ( $customerData) {
            foreach ($customerData as $c) {
    				$this->sendmail($c);
    				$this->sendmsg($c);
    		}
    		return true;
        }
	}

    public function reminderAppointment(){

        $customerData =  $this->cronjob->getNextHourAppointment();
        if ( $customerData) {
            foreach ($customerData as $c) {
                    $this->sendRemmail($c);
                    $this->sendRemmsg($c);
            }
            return true;
        }
    }

    public function getTodaysBidwinner(){
        $customerData =  $this->cronjob->runOnBidover();
        if ( $customerData) {
           
            foreach ($customerData as $c) {
                    $this->sendWinmail($c);
                    $this->sendWinmsg($c);
                    $this->updateNotification();
            }

        }
        return true;
    }
    protected function sendWinmail($c){
        $email_address = $this->setting->get('email_address');
        $congratulation_bid_winner = $this->setting->getMail('congratulation_bid_winner');
        // variables
        $company_name = $this->setting->get('site_name');
        $username = $c->first_name.' '.$c->last_name;
        $to = $c->email;
        $property_id  =  $c->property_id;
        $link =  site_url('appointment/bidwinner/?id='.$property_id);
        $search  = array('{username}','{link}');
        $replace = array($username,$link);
        $message = str_replace($search, $replace, $congratulation_bid_winner);
        
        $subject = 'Congratulation You are in top bidders-"'.$company_name.'"';
        //mail library
        $this->load->library('email');
        $config['protocol']     = $this->setting->get('mail_protocol');//'smtp';
        $config['smtp_host']    = $this->setting->get('smtp_host');//'ssl://smtp.gmail.com';
        $config['smtp_port']    = $this->setting->get('smtp_port');//'465';
        $config['smtp_timeout'] = $this->setting->get('smtp_timeout');//'7';
        $config['smtp_user']    = $this->setting->get('smtp_user');//'mygmail@gmail.com';
        $config['smtp_pass']    = $this->setting->get('smtp_pass');
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['mailtype']     = 'html';
        $this->email->initialize($config);
        $this->email->from($email_address, $company_name);
        $this->email->to($to); 
        $this->email->subject($subject);
        $this->email->message($message);    
        $this->email->send();
        return true;        

    }
    protected function sendWinmsg($c){

        
        $company_name = $this->setting->get('site_name');
        $congratulation_bid_winner = $this->setting->getMsg('congratulation_bid_winner');
        // variables
        
        $username = $c->first_name.' '.$c->last_name;
        $mobile = $c->phone;
        $search  = array('{username}');
        $replace = array($username);
        $message = str_replace($search, $replace, $congratulation_bid_winner);
        
        send_msg($mobile,$message);
        
    }

    protected function updateNotification(){
         $this->cronjob->updateNotification();
         return true;
    }
	protected function sendmail($c){
		$email_address = $this->setting->get('email_address');
        $package_expiry = $this->setting->getMail('package_expiry');
        // variables
    	$company_name = $this->setting->get('site_name');
    	$date = date('d-m-Y',strtotime($c->package_end_date));
    	$username = $c->first_name.' '.$c->last_name;
    	$to = $c->email;
        $search  = array('{username}','{date}');
        $replace = array($username, $date);
        $message = str_replace($search, $replace, $package_expiry);
        $subject = 'Your Package Details-"'.$company_name.'"';
        //mail library
        $this->load->library('email');
        $config['protocol']     = $this->setting->get('mail_protocol');//'smtp';
        $config['smtp_host']    = $this->setting->get('smtp_host');//'ssl://smtp.gmail.com';
        $config['smtp_port']    = $this->setting->get('smtp_port');//'465';
        $config['smtp_timeout'] = $this->setting->get('smtp_timeout');//'7';
        $config['smtp_user']    = $this->setting->get('smtp_user');//'mygmail@gmail.com';
        $config['smtp_pass']    = $this->setting->get('smtp_pass');
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['mailtype']     = 'html';
        $this->email->initialize($config);

		$this->email->from($email_address, $company_name);
		$this->email->to($to); 
		$this->email->subject($subject);
		$this->email->message($message);	
		$this->email->send();
		return true;		

	}
	protected function sendmsg($c){

		
		$company_name = $this->setting->get('site_name');
		$package_expiry = $this->setting->getMsg('package_expiry');
    	// variables
    	$company_name = $this->setting->get('site_name');
    	$date = date('d-m-Y',strtotime($c->package_end_date));
    	$username = $c->first_name.' '.$c->last_name;
    	$mobile = $c->phone;
        $search  = array('{username}','{date}');
        $replace = array($username, $date);
        $message = str_replace($search, $replace, $package_expiry);
        
        send_msg($mobile,$message);
		
	}
	
	protected function sendRemmail($c){
		$email_address = $this->setting->get('email_address');
        $reminder_appointment = $this->setting->getMail('reminder_appointment');
        // variables
       	
    	$company_name = $this->setting->get('site_name');
    	$time = date('g:i a',strtotime($c->start_time)).'-'.date('g:i a',strtotime($c->end_time));
    	$username = $c->first_name.' '.$c->last_name;
    	$to = $c->email;
        $search  = array('{username}','{time}','{companyname}');
        $replace = array($username, $time,$company_name);
        $message = str_replace($search, $replace, $reminder_appointment);
        $subject = 'Your Appointment Remainder-"'.$company_name.'"';

        //mail library
        $this->load->library('email');
        $config['protocol']     = $this->setting->get('mail_protocol');//'smtp';
        $config['smtp_host']    = $this->setting->get('smtp_host');//'ssl://smtp.gmail.com';
        $config['smtp_port']    = $this->setting->get('smtp_port');//'465';
        $config['smtp_timeout'] = $this->setting->get('smtp_timeout');//'7';
        $config['smtp_user']    = $this->setting->get('smtp_user');//'mygmail@gmail.com';
        $config['smtp_pass']    = $this->setting->get('smtp_pass');
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['mailtype']     = 'html';
        $this->email->initialize($config);

		$this->email->from($email_address, $company_name);
		$this->email->to($to); 
		$this->email->subject($subject);
		$this->email->message($message);	
		$this->email->send();

		return true;		    

	}
	protected function sendRemmsg($c){

		$reminder_appointment = $this->setting->getMsg('reminder_appointment');
		$company_name = $this->setting->get('site_name');
		
    	// variables
    	$company_name = $this->setting->get('site_name');
    	$time = date('g:i a',strtotime($c->start_time)).'-'.date('g:i a',strtotime($c->end_time));
    	$username = $c->first_name.' '.$c->last_name;
    	$mobile = $c->phone;
        $search  = array('{username}','{time}','{companyname}');
        $replace = array($username, $time,$company_name);
        $message = str_replace($search, $replace, $reminder_appointment);
        send_msg($mobile,$message);
		
	}

    // public function send_msg(){
    //     $ret = send_msg();
    //     print_r($ret);
    // }

    

}	