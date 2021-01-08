<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\EmployeeSalaryModel;

use App\EmployeeRegistrationModel;
use App\EmployeePaymentModel;
use App\User;

use DateTime;

use Input;

use Auth;

class EmployeeSalaryController extends Controller

{

    public function __construct()

	{

		$this->middleware('checkLogin');

	}

	public function InTimeSet(Request $request)

    {
        //dd(date('Y-m-d'));
       // dd((date('H:i:s'));
        $employeeRegistrationData = EmployeeRegistrationModel::where('employee_registration_id',Auth::user()->fk_employee_id)->get()->toArray();
        $getSameDate = EmployeeSalaryModel::where('today_date',date('Y-m-d'))->where('fk_employee_id',Auth::user()->fk_employee_id)->delete();

            $employeeRegistrationDataas = EmployeeSalaryModel::where('today_date',date('Y-m-d'))->where('fk_employee_id',Auth::user()->fk_employee_id)->get()->toArray();
            if(count($employeeRegistrationDataas)>0){

                EmployeeSalaryModel::where('today_date',date('Y-m-d'))->where('fk_employee_id',$employeeRegistrationData[0]['employee_registration_id'])->update([

                    'today_date'     => date('Y-m-d'),

                    'fk_employee_id' => $employeeRegistrationData[0]['employee_registration_id'],

                    'employee_name'  => $employeeRegistrationData[0]['employee_name'],

                    'intime'         => date('H:i:s'),

                    'created_by'     => Auth::user()->user_id,

                ]);
            }else{
                EmployeeSalaryModel::create([

                    'today_date'     => date('Y-m-d'),

                    'fk_employee_id' => $employeeRegistrationData[0]['employee_registration_id'],

                    'employee_name'  => $employeeRegistrationData[0]['employee_name'],

                    'intime'         => date('H:i:s'),

                    'created_by'     => Auth::user()->user_id,

                ]);
            }

           /* return redirect()->route('employee-salary')->with('success','Data has been added.');*/

        $responseData = array("success" => "1",'html_data' => date('g:i A'));

        echo json_encode($responseData);

        exit;


    }

    public function OutTimeSet(Request $request)

    {
        //dd(date('Y-m-d'));fk_employee_id
        $employeeRegistrationData = EmployeeRegistrationModel::where('employee_registration_id',Auth::user()->fk_employee_id)->get()->toArray();
        $employeeRegistrationDataas = EmployeeSalaryModel::where('today_date',date('Y-m-d'))->where('fk_employee_id',Auth::user()->fk_employee_id)->get()->toArray();
        
                $currentDate = date('Y-m-01');

                $lastDate = date("Y-m-t", strtotime($currentDate));

                $begin  = new DateTime($currentDate);

                $end    = new DateTime($lastDate);

                while ($begin <= $end) 

                {

                    if($begin->format("D") == "Sun") 

                    {

                        $countSun[] = $begin->format("Y-m-d") . "<br>";

                    }



                     $begin->modify('+1 day');

                }

                $workingDay = date('t') - count($countSun);

                //dd($workingDay*8);

                $todayDate = date('d-m-Y');

                    $employeeWorkingHours = EmployeeSalaryModel::where('fk_employee_id',$employeeRegistrationData[0]['employee_registration_id'])->whereBetween('today_date',[$currentDate,$lastDate])->get();

                    if (count($employeeWorkingHours) > 0) {

                        foreach ($employeeWorkingHours as $key => $value) {

                            $time[] = date("g:i", strtotime($value['employee_total_hours_monthly']));

                        }

                        $sum = strtotime('00:00:00');

                        $totaltime = 0; 

                        foreach( $time as $element ) { 

                    // Converting the time into seconds 

                            $timeinsec = strtotime($element) - $sum; 

                    // Sum the time with previous value 

                            $totaltime = $totaltime + $timeinsec; 

                        } 

                        $h = intval($totaltime / 3600);

                        $totaltime = $totaltime - ($h * 3600); 

                        $m = intval($totaltime / 60);

                        if ($m <= '9') {

                            $totalTimeForEmployee = $h.':'.'0'.$m;

                        }

                        else{

                            $totalTimeForEmployee = $h.':'.$m;

                        }

                        $s = $totaltime - ($m * 60);

                    }

                    else{

                        $totalTimeForEmployee = '0';

                    }
                    $employeeName = EmployeePaymentModel::where('fk_employee_id',$employeeRegistrationData[0]['employee_registration_id'])->first();
                    if(count($employeeRegistrationDataas)>0){
                        $intimeshowyes = $employeeRegistrationDataas[0]['intime'];
                            EmployeeSalaryModel::where('today_date',date('Y-m-d'))->where('fk_employee_id',$employeeRegistrationData[0]['employee_registration_id'])->update([

                                'outtime'        => date('H:i:s'),

                                //'total_time'     => Input::get('totaltime'),

                               // 'over_time'      => Input::filled('overtime') ? Input::get('overtime'):'',

                               'total_hours_monthly'          => $workingDay*8,

                                //'employee_total_hours_monthly' => Input::get('employee_total_hours_monthly'),

                                'actual_salary'  => $employeeName['salary'],
                            ]);
                    }else{
                         $intimeshowyes = '00:00:00';
                        EmployeeSalaryModel::create([

                                'outtime'        => date('H:i:s'),

                                //'total_time'     => Input::get('totaltime'),

                               // 'over_time'      => Input::filled('overtime') ? Input::get('overtime'):'',

                               'total_hours_monthly'          => $workingDay*8,

                                //'employee_total_hours_monthly' => Input::get('employee_total_hours_monthly'),

                                'actual_salary'  => $employeeName['salary'],
                                'today_date'     => date('Y-m-d'),

                                'fk_employee_id' => $employeeRegistrationData[0]['employee_registration_id'],

                                'employee_name'  => $employeeRegistrationData[0]['employee_name'],

                                'intime'         => '00:00:00',

                                'created_by'     => Auth::user()->user_id,
                            ]);

                    }        

                $response = array("success" => 1,"html_data" => date('g:i A'),"intimeshowyes" => $intimeshowyes);
        
        return json_encode($response);

        exit; 
}

    public function OverTimeSet(Request $request){
        $employeeRegistrationData = EmployeeRegistrationModel::where('employee_registration_id',Auth::user()->fk_employee_id)->get()->toArray();
        $employeeRegistrationDataas = EmployeeSalaryModel::where('today_date',date('Y-m-d'))->where('fk_employee_id',Auth::user()->fk_employee_id)->get()->toArray();
        EmployeeSalaryModel::where('today_date',date('Y-m-d'))->where('fk_employee_id',$employeeRegistrationData[0]['employee_registration_id'])->update([

                'total_time'     => $request->totalTime,
                'over_time'      => $request->overTime,
                'employee_total_hours_monthly' => $request->totalTime,

                
            ]);

    }

    public function employeeSalary()

    {

    	$employeeRegistrationData = EmployeeRegistrationModel::where('status','0')->get();

    	$accessData = $this->getArray('employee-salary',Auth::user()->fk_role_id);

    	return view('admin.employee_salary')->with('employeeRegistrationData',$employeeRegistrationData)->with('accessData',$accessData);

    }



    public function getDataByEmployee(Request $request)

    {

    	$currentDate = date('Y-m-01');

    	$lastDate = date("Y-m-t", strtotime($currentDate));

    	$begin  = new DateTime($currentDate);

        $end    = new DateTime($lastDate);

        while ($begin <= $end) 

        {

		    if($begin->format("D") == "Sun") 

		    {

		    	$countSun[] = $begin->format("Y-m-d") . "<br>";

		    }



		     $begin->modify('+1 day');

		}

		$workingDay = date('t') - count($countSun);

    	//dd($workingDay*8);

    	$todayDate = date('d-m-Y');

            $employeeWorkingHours = EmployeeSalaryModel::where('fk_employee_id',$request->fk_employee_id)->whereBetween('today_date',[$currentDate,$lastDate])->get();

            if (count($employeeWorkingHours) > 0) {

                foreach ($employeeWorkingHours as $key => $value) {
                    if($value['employee_total_hours_monthly']== '00:00:00'){
                        $time[] = '00:00:00';
                    }else{

                        $time[] = date("g:i", strtotime($value['employee_total_hours_monthly']));
                    }

                }

                $sum = strtotime('00:00:00');

                $totaltime = 0; 

                foreach( $time as $element ) { 

            // Converting the time into seconds 

                    $timeinsec = strtotime($element) - $sum; 

            // Sum the time with previous value 

                    $totaltime = $totaltime + $timeinsec; 

                } 

                $h = intval($totaltime / 3600);

                $totaltime = $totaltime - ($h * 3600); 

                $m = intval($totaltime / 60);

                if ($m <= '9') {

                    $totalTimeForEmployee = $h.':'.'0'.$m;

                }

                else{

                    $totalTimeForEmployee = $h.':'.$m;

                }

                $s = $totaltime - ($m * 60);

            }

            else{

                $totalTimeForEmployee = '0';

            }

            

       // dd($totalTimeForEmployee);
        if($totalTimeForEmployee == '0:00')
        {
            $totalTimeForEmployee = '0:00';
        }
    	$employeeName = EmployeePaymentModel::where('fk_employee_id',$request->fk_employee_id)->first();
        $employeeNameData = EmployeeSalaryModel::where('fk_employee_id',$request->fk_employee_id)->where('today_date',date('Y-m-d'))->get();
        $employeeRegistrationData = EmployeeRegistrationModel::where('employee_registration_id',$request->fk_employee_id)->get();
        if(count($employeeNameData)>0){
                if($employeeNameData[0]['intime'] == '00:00:00')
                {
                    $intime = '00:00:00';
                }else{
                    
                    $intime =  date("H:i",strtotime($employeeNameData[0]['intime']));
                }
                if($employeeNameData[0]['outtime'] == '00:00:00')
                {
                    $outtime = '00:00:00';
                }else{
                    
                   
                    $outtime = date("H:i",strtotime($employeeNameData[0]['outtime']));
                }
                if($employeeNameData[0]['total_time'] == '00:00:00')
                {
                    $total_time = '00:00:00';
                }else{
                    $total_time = date("g:i",strtotime($employeeNameData[0]['total_time']));
                }
                if($employeeNameData[0]['over_time'] == '00:00:00')
                {
                    $over_time = '00:00:00';
                }else{
                    
                    $over_time = date("g:i",strtotime($employeeNameData[0]['over_time']));
                }
        }else{
            $intime = '00:00:00';
            $outtime = '00:00:00';
            $total_time = '00:00:00';
            $over_time = '00:00:00';
        }
        //dd($employeeRegistrationData);
    	$response = array("success" => 1,"message" => "","employeeName" => $employeeRegistrationData[0]['employee_name'],"todayDate" => $todayDate,"totalHoursMonthly" => $workingDay*8,"salary" => $employeeName['salary'],"totalTimeForEmployee" => $totalTimeForEmployee,"intime"=>$intime,"outtime"=>$outtime,"total_time"=>$total_time,"over_time"=>$over_time);

    	return json_encode($response);

		exit; 

    }

        public function getDataByEmployeeChanges(Request $request)

    {
        $enterDate = date("Y-m-d", strtotime($request->dateas));
        $currentDate = date('Y-m-01');

        $lastDate = date("Y-m-t", strtotime($currentDate));

        $begin  = new DateTime($currentDate);

        $end    = new DateTime($lastDate);

        while ($begin <= $end) 

        {

            if($begin->format("D") == "Sun") 

            {

                $countSun[] = $begin->format("Y-m-d") . "<br>";

            }



             $begin->modify('+1 day');

        }

        $workingDay = date('t') - count($countSun);

        //dd($workingDay*8);

        $todayDate = date("d-m-Y", strtotime($request->dateas));

            $employeeWorkingHours = EmployeeSalaryModel::where('fk_employee_id',$request->fk_employee_id)->whereBetween('today_date',[$currentDate,$lastDate])->get();

            if (count($employeeWorkingHours) > 0) {

                foreach ($employeeWorkingHours as $key => $value) {
                    if($value['employee_total_hours_monthly']== '00:00:00'){
                        $time[] = '00:00:00';
                    }else{

                        $time[] = date("g:i", strtotime($value['employee_total_hours_monthly']));
                    }

                }

                $sum = strtotime('00:00:00');

                $totaltime = 0; 

                foreach( $time as $element ) { 

            // Converting the time into seconds 

                    $timeinsec = strtotime($element) - $sum; 

            // Sum the time with previous value 

                    $totaltime = $totaltime + $timeinsec; 

                } 

                $h = intval($totaltime / 3600);

                $totaltime = $totaltime - ($h * 3600); 

                $m = intval($totaltime / 60);

                if ($m <= '9') {

                    $totalTimeForEmployee = $h.':'.'0'.$m;

                }

                else{

                    $totalTimeForEmployee = $h.':'.$m;

                }

                $s = $totaltime - ($m * 60);

            }

            else{

                $totalTimeForEmployee = '0';

            }

            

       // dd($totalTimeForEmployee);
        if($totalTimeForEmployee == '0:00')
        {
            $totalTimeForEmployee = '0:00';
        }
        $employeeName = EmployeePaymentModel::where('fk_employee_id',$request->fk_employee_id)->first();
        $employeeNameData = EmployeeSalaryModel::where('fk_employee_id',$request->fk_employee_id)->where('today_date',$enterDate)->get();
        $employeeRegistrationData = EmployeeRegistrationModel::where('employee_registration_id',$request->fk_employee_id)->get();
        if(count($employeeNameData)>0){
                if($employeeNameData[0]['intime'] == '00:00:00')
                {
                    $intime = '00:00:00';
                }else{
                    
                    $intime =  date("H:i",strtotime($employeeNameData[0]['intime']));
                }
                if($employeeNameData[0]['outtime'] == '00:00:00')
                {
                    $outtime = '00:00:00';
                }else{
                    
                   
                    $outtime = date("H:i",strtotime($employeeNameData[0]['outtime']));
                }
                if($employeeNameData[0]['total_time'] == '00:00:00')
                {
                    $total_time = '00:00:00';
                }else{
                    $total_time = date("g:i",strtotime($employeeNameData[0]['total_time']));
                }
                if($employeeNameData[0]['over_time'] == '00:00:00')
                {
                    $over_time = '00:00:00';
                }else{
                    
                    $over_time = date("g:i",strtotime($employeeNameData[0]['over_time']));
                }
        }else{
            $intime = '00:00:00';
            $outtime = '00:00:00';
            $total_time = '00:00:00';
            $over_time = '00:00:00';
        }
        //dd($employeeRegistrationData);
        $response = array("success" => 1,"message" => "","employeeName" => $employeeRegistrationData[0]['employee_name'],"todayDate" => $todayDate,"totalHoursMonthly" => $workingDay*8,"salary" => $employeeName['salary'],"totalTimeForEmployee" => $totalTimeForEmployee,"intime"=>$intime,"outtime"=>$outtime,"total_time"=>$total_time,"over_time"=>$over_time);

        return json_encode($response);

        exit; 

    }


    public function saveEmployeeSalary(Request $request)

    {

        if (Input::get('submit') == 'Search') {

            if (Input::get('start_date') == '' && Input::get('end_date') == '') {

                $accessData = $this->getArray('employee-salary',Auth::user()->fk_role_id);

                $currentDate = date('Y-m-01');

                $lastDate = date("Y-m-t", strtotime($currentDate));

                $getDataOfEmployee = EmployeeSalaryModel::where('fk_employee_id',Input::get('fk_employee_id'))->where('today_date','>=',$currentDate)->where('today_date','<=',$lastDate)->get()->toArray();

                if ($getDataOfEmployee != []) {

                    foreach ($getDataOfEmployee as $key => $value) {

                        $currentSalary = $value['total_amount'];

                        $time[] = date("g:i", strtotime($value['employee_total_hours_monthly']));

                    }

                    $sum = strtotime('00:00:00');

                    $totaltime = 0; 

                    foreach( $time as $element ) { 

                // Converting the time into seconds 

                        $timeinsec = strtotime($element) - $sum; 

                // Sum the time with previous value 

                        $totaltime = $totaltime + $timeinsec; 

                    } 

                    $h = intval($totaltime / 3600);

                    $totaltime = $totaltime - ($h * 3600); 

                    $m = intval($totaltime / 60);

                    if ($m <= '9') {

                        $totalTimeForEmployee = $h.':'.'0'.$m;

                    }

                    else{

                        $totalTimeForEmployee = $h.':'.$m;

                    }

                }

                else{

                    $currentSalary = '0';

                    $totalTimeForEmployee = '0';

                }

                 

            }

            else{

                $getDataOfEmployee = EmployeeSalaryModel::where('fk_employee_id',Input::get('fk_employee_id'))->where('today_date','>=',date('Y-m-d',strtotime(Input::get('start_date'))))->where('today_date','<=',date('Y-m-d',strtotime(Input::get('end_date'))))->get()->toArray();

                if ($getDataOfEmployee != []) {

                    foreach ($getDataOfEmployee as $key => $value) {

                        $currentSalary = $value['total_amount'];

                        $time[] = date("g:i", strtotime($value['employee_total_hours_monthly']));

                    }

                    $sum = strtotime('00:00:00');

                    $totaltime = 0; 

                    foreach( $time as $element ) { 

                // Converting the time into seconds 

                        $timeinsec = strtotime($element) - $sum; 

                // Sum the time with previous value 

                        $totaltime = $totaltime + $timeinsec; 

                    } 

                    $h = intval($totaltime / 3600);

                    $totaltime = $totaltime - ($h * 3600); 

                    $m = intval($totaltime / 60);

                    if ($m <= '9') {

                        $totalTimeForEmployee = $h.':'.'0'.$m;

                    }

                    else{

                        $totalTimeForEmployee = $h.':'.$m;

                    }

                }

                else{

                    $currentSalary = '0';

                    $totalTimeForEmployee = '0';

                }               



            }

            

            

            return view('admin.employee_salary_view')->with('getDataOfEmployee',$getDataOfEmployee)->with('currentSalary',$currentSalary)->with('totalTimeForEmployee',$totalTimeForEmployee)->with('accessData',$accessData);

        }

        else{
            
            $EnterDate = date("Y-m-d", strtotime($request->today_date));
            $getSameDate = EmployeeSalaryModel::where('today_date',$EnterDate)->where('fk_employee_id',Input::get('fk_employee_id'))->delete();

            $totalAmount = Input::get('current_salary') + Input::get('bonus_amount');

            //dd(Input::get('totaltime'));

            EmployeeSalaryModel::create([

                'today_date'     => $EnterDate,

                'fk_employee_id' => Input::get('fk_employee_id'),

                'employee_name'  => Input::get('employee_name'),

                'intime'         => Input::get('intime'),

                'outtime'        => Input::get('outtime'),

                'total_time'     => Input::get('totaltime'),

                'over_time'      => Input::filled('overtime') ? Input::get('overtime'):'',

                'total_hours_monthly'          => Input::get('total_hours_monthly'),

                'employee_total_hours_monthly' => Input::get('employee_total_hours_monthly'),

                'actual_salary'  => Input::get('actual_salary'),

                'current_salary' => Input::filled('current_salary') ? Input::get('current_salary') : '',

                'bonus_occasion' => Input::filled('narration_or_festival') ? Input::get('narration_or_festival') : '',

                'bonus_amount'   => Input::filled('bonus_amount') ? Input::get('bonus_amount') : '',

                'total_amount'   => $totalAmount,

                'created_by'     => Auth::user()->user_id,

            ]);

            return redirect()->route('employee-salary')->with('success','Data has been added.');

        }

    }

}

