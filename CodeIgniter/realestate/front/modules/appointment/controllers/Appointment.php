<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Appointment extends MX_Controller { 
	
	public function __construct() {
		parent::__construct();
		$this->load->model('appointment/appointment_models', 'appointment');

		if(!is_login()){
            $this->load->helper('url');
            $this->session->set_userdata('last_page', current_url());
            redirect('index'); 
        }else{

        } 
	}
	public function index() {
		
		
		$data = array();
		$theme = $this->session->userdata('front_theme');
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		$open_day  = $this->setting->get('open_day');
		$data['open_day'] = explode(',', $open_day);
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/appointment/index')) {
			$this->load->view('themes/' . $theme . '/template/appointment/index', $data);
		} else {
			$this->load->view('themes/default/template/appointment/index', $data);
		}

	}
	public function scheduleAppointment(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('appointment_date', 'Appointment date', 'required');
       	$this->form_validation->set_rules('appointment_time', 'Appointment time', 'required');
       	$this->form_validation->set_rules('appointment_for', 'Appointment for', 'required');
        $this->form_validation->set_rules('property_id', 'property is not found', 'required');
        
        if ($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('error', validation_errors());
            redirect('appointment');
        }else{
        	$cust = getActiveCustomerInfo();
			$data = array(
        		'customer_id'=>$cust->c_id,
                'property_id'=>post('property_id'),
        		'appointment_for'=>post('appointment_for'),
        		'appointment_date'=>date('Y-m-d',strtotime(post('appointment_date'))),
        		'appointment_time'	=>post('appointment_time'),
        		'appointment_note'=>post('appointment_note'),
				'added_date'=>date('Y-m-d'),
				'appointment_status'=>'1',	
        	);
        	$ret = $this->appointment->addAppointment($data);
        	//send mail and msg
        	$this->sendAppointmentMail($ret,$cust->first_name,$cust->email);
        	$this->sendAppointmentMsg($ret,$cust->first_name,$cust->phone);
        	redirect('account','refresh');

        }
	}
	protected function sendAppointmentMail($appointment_id,$customername,$to){

		$email_address = $this->setting->get('email_address');
        $schedule_appointment = $this->setting->getMail('schedule_appointment');
        // variables
    	$company_name = $this->setting->get('site_name');
    	$appointment = $this->appointment->getAppointmentDet($appointment_id);
    	$date = date('d-m-Y',strtotime($appointment->appointment_date));
    	$time_slot = date('g:i a',strtotime($appointment->start_time)).'-'.date('g:i a',strtotime($appointment->end_time));

        $search  = array('{username}','{time_slot}','{date}','{company_name}');
        $replace = array($customername, $time_slot, $date,$company_name);
        $message = str_replace($search, $replace, $schedule_appointment);
        $subject = 'Appointment Details-"'.$company_name.'"';
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
	protected function sendAppointmentMsg($appointment_id,$customername,$mobile){
		$schedule_appointment = $this->setting->getMsg('schedule_appointment');
		$company_name = $this->setting->get('site_name');
    	$appointment = $this->appointment->getAppointmentDet($appointment_id);
    	$date = date('d-m-Y',strtotime($appointment->appointment_date));
    	$time_slot = date('g:i a',strtotime($appointment->start_time)).'-'.date('g:i a',strtotime($appointment->end_time));

        $search  = array('{username}','{time_slot}','{date}','{company_name}');
        $replace = array($customername, $time_slot, $date,$company_name);
        $message = str_replace($search, $replace, $schedule_appointment);
        send_msg($mobile,$message);
	}


	public function getTimeSlotAvailable(){
		$date = $this->input->get('date');
		$return = $this->appointment->getTimeslot($date);
		$this->output->set_content_type('application/json')->set_output(json_encode($return));

	}
	public function rescheduleAppointment(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('appointment_date', 'Appointment date', 'required');
       	$this->form_validation->set_rules('appointment_time', 'Appointment time', 'required');
       
        if ($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('error', validation_errors());
            redirect('account');
        }else{
        	$cust = getActiveCustomerInfo();
			$data = array(
        		'appointment_date'=>date('Y-m-d',strtotime(post('appointment_date'))),
        		'appointment_time'	=>date('H:i:s',strtotime(post('appointment_time'))),
        		
        	);
			$where = array('appointment_id'=>post('appointment_id'));
        	$ret = $this->appointment->update($data,$where);
        	$this->session->set_flashdata('success','Appointment Reschedule Successfully');
        	redirect('account','refresh');

        }
	}
	public function getAppointmentDet(){
		$id = $this->input->get('id');
		$result = $this->appointment->getAppointmentDet($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));

	}

    public function bidwinner(){
        $data = array();
        $propety_id = $this->input->get('id');
        $ret = $this->appointment->checkbidwinner($propety_id);
        if($ret ){
            redirect('index');
        }
        $theme = $this->session->userdata('front_theme');
        $data['title'] = $this->setting->get('site_name');
        $data['meta_descriptions'] = $this->setting->get('meta_descriptions');
        $data['meta_keywords'] = $this->setting->get('meta_keywords');
        $data['meta_titles'] = $this->setting->get('meta_titles');
        $open_day  = $this->setting->get('open_day');
        $data['open_day'] = explode(',', $open_day);
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/appointment/bidwinner')) {
            $this->load->view('themes/' . $theme . '/template/appointment/bidwinner', $data);
        } else {
            $this->load->view('themes/default/template/appointment/bidwinner', $data);
        }
    }
    public function scheduleAppointmentBidWinner(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('appointment_date', 'Appointment date', 'required');
        $this->form_validation->set_rules('appointment_time', 'Appointment time', 'required');
        $this->form_validation->set_rules('appointment_for', 'Appointment for', 'required');
        $this->form_validation->set_rules('property_id', 'property is not found', 'required');
        
        $checkbidwinner = $this->appointment->checkbidwinner();
        
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            redirect('appointment/bidwinner');
        }else{
            $cust = getActiveCustomerInfo();
            $data = array(
                'customer_id'=>$cust->c_id,
                'appointment_for'=>post('appointment_for'),
                'appointment_date'=>date('Y-m-d',strtotime(post('appointment_date'))),
                'appointment_time'  =>post('appointment_time'),
                'appointment_note'=>post('appointment_note'),
                'added_date'=>date('Y-m-d'),
                'appointment_status'=>'1',  
            );
            $ret = $this->appointment->addAppointment($data);
            //send mail and msg
            $this->sendAppointmentMail($ret,$cust->first_name,$cust->email);
            $this->sendAppointmentMsg($ret,$cust->first_name,$cust->phone);
            redirect('account','refresh');
        }
        
    }
}