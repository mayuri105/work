<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_model extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
		
	}

	
    public function  getRental(){
        
        $start_date = $this->input->get('date_start');
        $end_date = $this->input->get('date_end');
        $group = $this->input->get('group');
        

        $this->db->select('sum(rent) as total, MIN(added_date) AS date_start, MAX(added_date) AS date_end, COUNT(*) AS `cases`');
            
        if ($start_date) {
            $this->db->where('added_date >=',date('Y-m-d',strtotime($start_date)));
        }
        if ($end_date) {
            $this->db->where('added_date <=',date('Y-m-d',strtotime($end_date)));
        }

        if ($group) {
            $checkGroup = $group;
        } else {
            $checkGroup = 'week';
        }
        switch ($checkGroup) {
            case 'day';
                $this->db->group_by('YEAR(added_date), MONTH(added_date),DAY(added_date)');
                break;
            default:
            case 'week':
                $this->db->group_by('YEAR(added_date), WEEK(added_date)');
                break;
            case 'month':
                $this->db->group_by('YEAR(added_date),MONTH(added_date)');
                break;
            case 'year':
                $this->db->group_by('YEAR(added_date)');
                break;
        }
        $ret = $this->db->get('rented_propety')->result();
        return $ret;

    }
    public function  getSold(){
        
        $start_date = $this->input->get('date_start');
        $end_date = $this->input->get('date_end');
        $group = $this->input->get('group');
        

        $this->db->select('sum(amount) as total, MIN(date_added) AS date_start, MAX(date_added) AS date_end, COUNT(*) AS `cases`');
            
        if ($start_date) {
            $this->db->where('date_added >=',date('Y-m-d',strtotime($start_date)));
        }
        if ($end_date) {
            $this->db->where('date_added <=',date('Y-m-d',strtotime($end_date)));
        }

        if ($group) {
            $checkGroup = $group;
        } else {
            $checkGroup = 'week';
        }
        switch ($checkGroup) {
            case 'day';
                $this->db->group_by('YEAR(date_added), MONTH(date_added),DAY(date_added)');
                break;
            default:
            case 'week':
                $this->db->group_by('YEAR(date_added), WEEK(date_added)');
                break;
            case 'month':
                $this->db->group_by('YEAR(date_added),MONTH(date_added)');
                break;
            case 'year':
                $this->db->group_by('YEAR(date_added)');
                break;
        }
        $ret = $this->db->get('sale_property')->result();
        return $ret;

    }

     public function  getSubscribe(){
        
        $start_date = $this->input->get('date_start');
        $end_date = $this->input->get('date_end');
        $group = $this->input->get('group');
        

        $this->db->select('sum(totalamt) as total, MIN(added_date) AS date_start, MAX(added_date) AS date_end, COUNT(*) AS `cases`');
            
        if ($start_date) {
            $this->db->where('added_date >=',date('Y-m-d',strtotime($start_date)));
        }
        if ($end_date) {
            $this->db->where('added_date <=',date('Y-m-d',strtotime($end_date)));
        }

        if ($group) {
            $checkGroup = $group;
        } else {
            $checkGroup = 'week';
        }
        switch ($checkGroup) {
            case 'day';
                $this->db->group_by('YEAR(added_date), MONTH(added_date),DAY(added_date)');
                break;
            default:
            case 'week':
                $this->db->group_by('YEAR(added_date), WEEK(added_date)');
                break;
            case 'month':
                $this->db->group_by('YEAR(added_date),MONTH(added_date)');
                break;
            case 'year':
                $this->db->group_by('YEAR(added_date)');
                break;
        }
        $ret = $this->db->get('customer_buy_package')->result();
        return $ret;

    }
    public function getSaleData(){
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        if ($start_date) {
            $this->db->where('date_added >=',date('Y-m-d',strtotime($start_date)));
        }
        if ($end_date) {
            $this->db->where('date_added <=',date('Y-m-d',strtotime($end_date)));
        }

        $this->db->select('count(*) as tot', FALSE);
        $sale = $this->db->get('sale_property')->row();
        return $sale;
    }
    public function getRentData(){
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        if ($start_date) {
            $this->db->where('added_date >=',date('Y-m-d',strtotime($start_date)));
        }
        if ($end_date) {
            $this->db->where('added_date <=',date('Y-m-d',strtotime($end_date)));
        }

        $this->db->select('count(*) as tot', FALSE);
        $sale = $this->db->get('rented_propety')->row();
        return $sale;
    }
    public function getInvestmentData(){
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        if ($start_date) {
            $this->db->where('added_on >=',date('Y-m-d',strtotime($start_date)));
        }
        if ($end_date) {
            $this->db->where('added_on <=',date('Y-m-d',strtotime($end_date)));
        }
        $this->db->select('count(*) as tot', FALSE);
        $this->db->where('property_action', 'investments');
        $sale = $this->db->get('property')->row();
        return $sale;
    }

    public function getBidData(){
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        if ($start_date) {
            $this->db->where('date_time >=',date('Y-m-d',strtotime($start_date)));
        }
        if ($end_date) {
            $this->db->where('date_time <=',date('Y-m-d',strtotime($end_date)));
        }
        $this->db->select('count(*) as tot', FALSE);
        $this->db->group_by('property_id');
        $sale = $this->db->get('bid')->row();
        return $sale;
    }
}

/* End of file Reports_model.php */
/* Location: ./application/models/Reports_model.php */