<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\EmployeeSalaryModel;

use App\EmployeeRegistrationModel;
use App\User;

use Session;

use Auth;



class DashboardController extends Controller{



	public function __construct()

	{

		$this->middleware('checkLogin');

	}

    /**

	 * @author Purvesh Patel

	 * Date: 22 July 2019 5:06 PM

	 */

	public function dashboard(){

	    $accessData = $this->getArray('dashboard',Auth::user()->fk_role_id);
	    $employeeRegistrationData = EmployeeRegistrationModel::where('employee_registration_id',Auth::user()->fk_employee_id)->get();
	    if(count($employeeRegistrationData)>0){
	    	$employeedetails = '1';
		    $getSameDate = EmployeeSalaryModel::where('today_date',date('Y-m-d'))->where('fk_employee_id',Auth::user()->fk_employee_id)->get();

			if(count($getSameDate)>0){
				if($getSameDate[0]['intime'] == '00:00:00'){

					$intimefinal =  date("H:i ",strtotime($getSameDate[0]['intime']));
				}else{
					$intimefinal =  date("g:i A",strtotime($getSameDate[0]['intime']));
				}
				if($getSameDate[0]['outtime'] == '00:00:00'){
	        		$outtimefinal = date("H:i ",strtotime($getSameDate[0]['outtime']));
	        	}else{
	        		$outtimefinal = date("g:i A",strtotime($getSameDate[0]['outtime']));
	        	}
			}else{
				$intimefinal =  '00:00';
	        	$outtimefinal = '00:00';
	        }
		}else{
			$intimefinal =  '00:00';
	        $outtimefinal = '00:00';
	        $employeedetails = '0';
		}
		return view('admin.dashboard')->with('accessData',$accessData)->with(['intimefinal' => $intimefinal,'outtimefinal' => $outtimefinal,'employeedetails'=>$employeedetails]);

	}



	/**

	 * @author Purvesh Patel

	 * Date: 23 July 2019 11:27 AM

	 */

	public function dashboard1(){

		return view('admin.dashboard2');

	}

}

