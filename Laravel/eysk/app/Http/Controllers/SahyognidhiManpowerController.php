<?php



namespace App\Http\Controllers;



use App\RepaymentModel;
use Illuminate\Http\Request;

use App\SahyognidhiManpowerModel;

use App\SahyognidhiRequestModel;

use App\RegistrationModel;

use App\SahyognidhiAmountModel;

use App\ReservedFundsModel;

use App\LedgerAccountModel;

use App\SahyognidhiManpowerLedgerModel;

use App\RegistrationFeesModel;

use App\SahyognidhiManpowerRefundpaymentAmounts;

use App\SahyognidhiManpowerFinalRefundamounts;

use DB;

use Input;

use Auth;

class SahyognidhiManpowerController extends Controller

{

	 public function __construct(){

        $this->middleware('checkLogin');

    }



public function sahyognidhiManpower()

{

    $accessData = $this->getArray('sahyognidhi-manpower',Auth::user()->fk_role_id);

	$incomeLedgerAccount = LedgerAccountModel::where('fk_group_id','12')->get();

	return view('admin.sahyognidhi_manpower')->with('incomeLedgerAccount',$incomeLedgerAccount)->with('accessData',$accessData);

}



public function viewSahyognidhiManpower()

{

    $accessData = $this->getArray('sahyognidhi-manpower',Auth::user()->fk_role_id);

	//$getLastYearAmount = SahyognidhiManpowerModel::get();
	$getLastYearAmount = SahyognidhiManpowerModel::select('sahyognidhi_manpowers.sahyognidhi_manpower_id as sahyognidhi_manpower_id','sahyognidhi_manpowers.drop_ratio_percentage as drop_ratio_percentage','sahyognidhi_manpowers.reserve_fund_amount as reserve_fund_amount','sahyognidhi_manpowers.created_at as created_at1','sahyognidhi_manpower_refundpayment_amounts.admin_charge as admin_charge1','sahyognidhi_manpowers.start_year as start_year','sahyognidhi_manpowers.end_year as end_year','sahyognidhi_manpowers.status as status1')
	->leftJoin('sahyognidhi_manpower_refundpayment_amounts','sahyognidhi_manpower_refundpayment_amounts.fk_sahyognidhi_manpower_id','=','sahyognidhi_manpowers.sahyognidhi_manpower_id')

		->get();

			//dd($getLastYearAmount);

	return view('admin.sahyognidhi_manpower_view')->with('getLastYearAmount',$getLastYearAmount)->with('accessData',$accessData);

}





public function viewSahyognidhiManpowerData($id)

{
  // echo $id;die;
    $accessData = $this->getArray('sahyognidhi-manpower',Auth::user()->fk_role_id);
   //  echo"<pre>";print_r($accessData);die;


	$getLastYearAmount = SahyognidhiManpowerModel::where('sahyognidhi_manpower_id','=',$id)->get();
   // echo"<pre>";print_r($getLastYearAmount);die;
	$RegistrationFee =  RegistrationFeesModel::orderBy('registration_fees_id','DESC')->take(1)->get();
   // echo"<pre>";print_r($RegistrationFee);die;
	$incomeLedgerAccount = LedgerAccountModel::where('fk_group_id','12')->get();
  //  echo"<pre>";print_r($incomeLedgerAccount);die;
	$LedgerModel = DB::table('sahyognidhi_manpower_ledger_account')->where('fk_sahyognidhi_manpower_id','=',$id)->select('*')->get();
   //echo"<pre>";print_r($legderincomeAccount);die;
   // echo $LedgerModel->reduct_amount; die;
	$RefundpaymentAmounts = SahyognidhiManpowerRefundpaymentAmounts::where('fk_sahyognidhi_manpower_id','=',$id)->get();
   // echo"<pre>";print_r($RefundpaymentAmounts);die;
	$RefundpaymentAmountsFinal = SahyognidhiManpowerFinalRefundamounts::where('fk_sahyognidhi_manpower_id','=',$id)->get();
	                    $amountfinals=DB::table('sahyognidhi_manpower_final_refundamounts')->where('fk_sahyognidhi_manpower_id','=',$id)->select('*')->first();
    //echo"<pre>";print_r($amountfinals);die;
   // echo $amountfinals->group1;die;
	$startYear = $getLastYearAmount[0]['start_year'];

	$total48To55Ysk = $getLastYearAmount[0]['total_group4_people'] + $getLastYearAmount[0]['total_group5_people'];

	$EndYear = $getLastYearAmount[0]['end_year'];

	$refundpayment = $this->RefundPayment($getLastYearAmount[0]['total_group1_people'],$getLastYearAmount[0]['total_group2_people'],$getLastYearAmount[0]['total_group3_people'],$total48To55Ysk,$getLastYearAmount[0]['total_amount']);
    //echo"<pre>";print_r($refundpayment);die;


	/////////////////////////////////////Month//////////////////////////////////

		/*$start = -9;

		$end = 2;

		for($i=$start; $i<=$end;$i++) {

		    $month_name[] = date('F', strtotime("$i months"));

		}*/

	///////////////////////////////////Join Member ///////////////////////////////////

			$aprilStartRegister = array();

			$TotalRegistered = array();

			$MonthData = array();

			$month_name = array();

			$ExpectedData = array();

			$TotalRegistered = array();

			$get18To30Total = array();

			$get31To37Total = array();

			$get38To47Total = array();

			$get48To55Total = array();

			$ExpectedTotal = array();

			$RealTotal = array();

			$diffTotal = array();



			$monthcount = 12;

			$k=0;

			for ($i=4; $i <= 12; $i++) {



				$startRegister   = strftime("%F", strtotime($startYear."-".$i));

				$startYearRegisterDate   = date("Y-m-t", strtotime($startRegister));

				$newRegistrationAprilToDecember = RegistrationModel::where('status','1')->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();



				$newRegistrationAprilToDecember1 = RegistrationModel::where('status','7')->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();



				$month_name[] = date("F", strtotime($startRegister));

				$RegistrationFee =  RegistrationFeesModel::orderBy('registration_fees_id','DESC')->take(1)->get()->toArray();

				//dd($RegistrationFee[0]['end_age1']);

				if(count($RegistrationFee) >0 ){



					$new18To30Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age1'])->where('age','<=',$RegistrationFee[0]['end_age1'])->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();



					$new31To37Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age2'])->where('age','<=',$RegistrationFee[0]['end_age2'])->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();



					$new38To47Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age3'])->where('age','<=',$RegistrationFee[0]['end_age3'])->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();



					$new48To55Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age4'])->where('age','<=',$RegistrationFee[0]['end_age4'])->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();

					$new55To60Register1 = RegistrationModel::where('status','1')->where('age','>','55')->where('age','<=','60')->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->whereBetween('ysk_id', [1, 5000])->get()->toArray();



					$newYskMitra1 = RegistrationModel::where('status','7')->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();

				}

			    $new48To55Register1 = count($new48To55Register1) + count($new55To60Register1);


				$ExpectedData[] = $this->ExpectedData($refundpayment[0],$refundpayment[1],$refundpayment[2],$refundpayment[3],count($new18To30Register1),count($new31To37Register1),count($new38To47Register1),$new48To55Register1,count($newYskMitra1),$monthcount);



				$TotalRegistered[] = count($newRegistrationAprilToDecember)+count($newRegistrationAprilToDecember1);



				$MonthData[] = [count($new18To30Register1),count($new31To37Register1),count($new38To47Register1),$new48To55Register1,count($newYskMitra1)];



				$monthcount--;



				$get18To30Total[] = $MonthData[$k][0];

				$get31To37Total[] = $MonthData[$k][1];

				$get38To47Total[] = $MonthData[$k][2];

				$get48To55Total[] = $MonthData[$k][3];

				$getYskMitra1[]   = $MonthData[$k][4];



				$ExpectedTotal[] = $ExpectedData[$k][0];

				$RealTotal[] = $ExpectedData[$k][1];

				$diffTotal[] = $ExpectedData[$k][2];

				$k++;

			}

			$monthcount = $monthcount;

			$k=$k;

			for ($i=1; $i < 4; $i++) {



				$endRegister   = strftime("%F", strtotime($EndYear."-".$i));

				$endYearRegisterDate   = date("Y-m-t", strtotime($endRegister));

				$newRegistrationJanuaryToMarch = RegistrationModel::where('status','1')->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();

				$newRegistrationJanuaryToMarch1 = RegistrationModel::where('status','7')->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();

				$month_name[] = date("F", strtotime($endRegister));

				$RegistrationFee =  RegistrationFeesModel::orderBy('registration_fees_id','DESC')->take(1)->get()->toArray();

				//dd($RegistrationFee[0]['end_age1']);

				if(count($RegistrationFee) >0 ){





					$new18To30Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age1'])->where('age','<=',$RegistrationFee[0]['end_age1'])->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();



					$new31To37Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age2'])->where('age','<=',$RegistrationFee[0]['end_age2'])->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();



					$new38To47Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age3'])->where('age','<=',$RegistrationFee[0]['end_age3'])->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();



					$new48To55Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age4'])->where('age','<=',$RegistrationFee[0]['end_age4'])->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();

                    $new55To60Register1 = RegistrationModel::where('status','1')->where('age','>','55')->where('age','<=','60')->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->whereBetween('ysk_id', [1, 5000])->get()->toArray();


					$newYskMitra1 = RegistrationModel::where('status','7')->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();

				}





				$TotalRegistered[] = count($newRegistrationJanuaryToMarch)+count($newRegistrationJanuaryToMarch1);

				$new48To55Register1 = count($new48To55Register1) + count($new55To60Register1);


				$MonthData[] = [count($new18To30Register1),count($new31To37Register1),count($new38To47Register1),$new48To55Register1,count($newYskMitra1)];

				$ExpectedData[] = $this->ExpectedData($refundpayment[0],$refundpayment[1],$refundpayment[2],$refundpayment[3],count($new18To30Register1),count($new31To37Register1),count($new38To47Register1),$new48To55Register1,count($newYskMitra1),$monthcount);

				$monthcount--;

				$get18To30Total[] = $MonthData[$k][0];

				$get31To37Total[] = $MonthData[$k][1];

				$get38To47Total[] = $MonthData[$k][2];

				$get48To55Total[] = $MonthData[$k][3];

				$getYskMitra1[]   = $MonthData[$k][4];



				$ExpectedTotal[] = $ExpectedData[$k][0];

				$RealTotal[] = $ExpectedData[$k][1];

				$diffTotal[] = $ExpectedData[$k][2];

				$k++;

			}

			$total48To55Ysk = array_sum($get48To55Total) + array_sum($getYskMitra1);

			$refundpaymentSecond = $this->RefundPayment(array_sum($get18To30Total),array_sum($get31To37Total),array_sum($get38To47Total),$total48To55Ysk,array_sum($diffTotal));



	return view('admin.sahyognidhi_manpower_view_data')->with('getLastYearAmount',$getLastYearAmount)->with('RegistrationFee',$RegistrationFee)->with('incomeLedgerAccount',$incomeLedgerAccount)->with('LedgerModel',$LedgerModel)->with('RefundpaymentAmounts',$RefundpaymentAmounts)->with('RefundpaymentAmountsFinal',$RefundpaymentAmountsFinal)->with('refundpayment',$refundpayment)->with('month_name',$month_name)->with('TotalRegistered',$TotalRegistered)->with('ExpectedData',$ExpectedData)->with('TotalRegistered',$TotalRegistered)->with('ExpectedTotal',$ExpectedTotal)->with('RealTotal',$RealTotal)->with('diffTotal',$diffTotal)->with('refundpaymentSecond',$refundpaymentSecond)->with('MonthData',$MonthData)->with('accessData',$accessData)->with('amountfinals',$amountfinals);

}



public function getData(Request $request)

{



	$this->validate($request,[

		'start_year'   => 'required',

		'end_year' 	   => 'required',

	]);

	if ($request->start_year == $request->end_year) {

		$errorMsg = 'Starting year and Ending year cannot be same.';

		$responseData = array("success" => "2","errorMsg" => $errorMsg);

	}

	elseif ($request->end_year < $request->start_year) {

		$errorMsg = 'Ending year always be greater.';

		$responseData = array("success" => "0","errorMsg" => $errorMsg);

	}

	else{ 	$month_name 		= array();

			$ExpectedData 		= array();

			$TotalRegistered 	= array();

			$get18To30Total 	= array();

			$get31To37Total 	= array();

			$get38To47Total 	= array();

			$get48To55Total 	= array();

			$ExpectedTotal 		= array();

			$RealTotal 			= array();

			$diffTotal 			= array();

			$countSahyognidhiRequest = array();

			$divangat 			= array();

			$registrationData 	= array();

			$totalAmount 		= array();





			$startYear = $request->start_year;

			$startDay = 1;

			$startMonth = 4;

			$startDate = strftime("%F", strtotime($startYear."-".$startMonth."-".$startDay));

			$EndYear = $request->end_year;

			$endDay = 1;

			$endMonth = 4;

			$endDate = strftime("%F", strtotime($EndYear."-".$endMonth."-".$endDay));

			$sahyognidhiData = SahyognidhiRequestModel::where('status','!=','3')->get();



			$previousYear = $startYear - 1;

			$getPreviousYear = strftime("%F", strtotime($previousYear."-".$startMonth."-".$startDay));

			$getLastYearAmount = SahyognidhiManpowerModel::where('start_year',$getPreviousYear)->first();



			$reserveFundPercentage = ReservedFundsModel::where('status','1')->where('start_date','<=',$startDate)->where('end_date','>=',$endDate)->get()->toArray();

			if (count($reserveFundPercentage) == 0){

				$reserveFundPercentage = ReservedFundsModel::where('status','1')->where('end_date','0000-00-00')->get()->toArray();

			}



			foreach ($sahyognidhiData as $key => $value) {

			if ($value['sahyognidhi_date'] >= $startDate && $value['sahyognidhi_date'] <= $endDate) {

				$countSahyognidhiRequest[] = SahyognidhiRequestModel::where('status','!=','3')->where('sahyognidhi_date',$value['sahyognidhi_date'])->get()->toArray();

				$divangatAmount = SahyognidhiRequestModel::where('status','!=','3')->where('sahyognidhi_date',$value['sahyognidhi_date'])->first();

				$divangat[] = $divangatAmount['sahyognidhi_request'];

				$registration = RegistrationModel::where('status','!=','3')->where('ysk_id',$divangatAmount['fk_ysk_id'])->orWhere('pre_ysk_id',$divangatAmount['fk_ysk_id'])->get()->toArray();

				$registrationData[] = array_pop($registration);

				$getAmount = SahyognidhiAmountModel::where('status','1')->where('start_date','<=',$value['sahyognidhi_date'])->where('end_date','>=',$value['sahyognidhi_date'])->get()->toArray();

				if (count($getAmount) == '0'){

				$getAmount = SahyognidhiAmountModel::where('status','1')->where('start_date','<=',$value['sahyognidhi_date'])->where('end_date','0000-00-00')->get()->toArray();

			}

			}

		}

		/*for ($i=0; $i < count($registrationData); $i++) {

			$getAmount = SahyognidhiAmountModel::where('status','1')->where('start_date','<=',$registrationData[$i]['today_date'])->where('end_date','>=',$registrationData[$i]['today_date'])->get()->toArray();

			if (count($getAmount) == '0'){

				$getAmount = SahyognidhiAmountModel::where('status','1')->where('start_date','<=',$registrationData[$i]['today_date'])->where('end_date','0000-00-00')->get()->toArray();

			}

		}*/

		for ($i=0; $i < count($divangat); $i++) {

			if ($divangat[$i] == 'Devantage') {

				$totalAmount[] = $getAmount[0]['divangate_amount'];

			}

			if ($divangat[$i] == 'Half Disability') {

				$totalAmount[] = ($getAmount[0]['divangate_amount'])/2;

			}

			if ($divangat[$i] == 'Full Disability') {

				$totalAmount[] = $getAmount[0]['divangate_amount'];

			}

		}

		$sum = array();

		$sum = $sum + $totalAmount;

		$RegistrationFee =  RegistrationFeesModel::orderBy('registration_fees_id','DESC')->take(1)->get()->toArray();

		//dd($RegistrationFee[0]['end_age1']);

		if(count($RegistrationFee) >0 ){

			/*foreach ($RegistrationFee as $key => $RegistrationFeevalue) {*/



				$getgroup1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age1'])->where('age','<=',$RegistrationFee[0]['end_age1'])->get();



				$getgroup2 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age2'])->where('age','<=',$RegistrationFee[0]['end_age2'])->get();



				$getgroup3 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age3'])->where('age','<=',$RegistrationFee[0]['end_age3'])->get();



				$getgroup4 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age4'])->where('age','<=',$RegistrationFee[0]['end_age4'])->get();

				/*---------------------------------- Age 55 to 60 ------------- */

				$getgroup55_60 = RegistrationModel::where('status','1')->where('age','>','55')->where('age','<=','60')->whereBetween('ysk_id', [1, 5000])->get();

				$getgroup4 = count($getgroup4) + count($getgroup55_60);


				$getgroup5 = RegistrationModel::where('status','7')->get();

		}



		$totalReserveFundAmount = (array_sum($sum)*$reserveFundPercentage[0]['percentage'])/100;

		$html = '';

			$html .='<div class="row" ><div class="col-sm-3">

					<span class="kt-portlet__head-title">'.$RegistrationFee[0]['start_age1'].' to '.$RegistrationFee[0]['end_age1'].'</span>

					<p ><input type="text" id="getgroup1" name="getgroup1" value="'.count($getgroup1).'" readonly style="width: 30px; border: none"></p>

				</div>



				<div class="col-sm-3">

					<span class="kt-portlet__head-title">'.$RegistrationFee[0]['start_age2'].' to '.$RegistrationFee[0]['end_age2'].'</span>

					<p ><input type="text" id="getgroup2" name="getgroup2" value="'.count($getgroup2).'" readonly style="width: 30px; border: none"></p>

				</div>

				<div class="col-sm-2">

					<span class="kt-portlet__head-title">'.$RegistrationFee[0]['start_age3'].' to '.$RegistrationFee[0]['end_age3'].'</span>

					<p ><input type="text" id="getgroup3" name="getgroup3" value="'.count($getgroup3).'" readonly style="width: 30px; border: none"></p>

				</div>

				<div class="col-sm-2">

					<span class="kt-portlet__head-title">'.$RegistrationFee[0]['start_age4'].' to '.$RegistrationFee[0]['end_age4'].'</span>


					<p ><input type="text" id="getgroup4" name="getgroup4" value="'.$getgroup4.'" readonly style="width: 30px; border: none"></p>

				</div>

				<div class="col-sm-2">

					<span class="kt-portlet__head-title">YSK Mitra</span>

					<p ><input type="text" id="getgroup5" name="getgroup5" value="'.count($getgroup5).'" readonly style="width: 30px; border: none"></p>

				</div>

				</div>';



		$responseData = array("success" => "1","countSahyognidhiRequest" => count($countSahyognidhiRequest),"totalSahyognidhiAmount" => array_sum($sum),"reserveFundPercentage" => $reserveFundPercentage[0]['percentage'],"totalReserveFundAmount" => $totalReserveFundAmount,"lastYearReserveFund" => $getLastYearAmount['reserve_fund_amount'],"agetype" => $html);



		}

	echo json_encode($responseData);

	exit;

}



 public function saveSahyognidhiManpower(Request $request)

{  $month_name = array();

	$ExpectedData = array();

	$TotalRegistered = array();

	$get18To30Total = array();

	$get31To37Total = array();

	$get38To47Total = array();

	$get48To55Total = array();

	$ExpectedTotal = array();

	$RealTotal = array();

	$diffTotal = array();

	$countSahyognidhiRequest = array();

	$divangat = array();

	$registrationData = array();

	$totalAmount = array();

	$getgroup1 = Input::get('getgroup1');

	$getgroup2 = Input::get('getgroup2');

	$getgroup3 = Input::get('getgroup3');

	$getgroup4 = Input::get('getgroup4');

	$getgroup5 = Input::get('getgroup5');

	$totalAmount = Input::get('total_amount');

	$totalyskandgroup4 = $getgroup4 + $getgroup5;

	$refundpayment = $this->RefundPayment($getgroup1,$getgroup2,$getgroup3,$totalyskandgroup4,$totalAmount);



	$startYear = Input::get('hidden_start_year');

	$startDay = 1;

	$startMonth = 4;

	$startDate = strftime("%F", strtotime($startYear."-".$startMonth."-".$startDay));

	$EndYear = Input::get('hidden_end_year');

	$endDay = 1;

	$endMonth = 4;

	$endDate = strftime("%F", strtotime($EndYear."-".$endMonth."-".$endDay));



	/////////////////////////////////////Month//////////////////////////////////

		/*$start = -9;

		$end = 2;

		for($i=$start; $i<=$end;$i++) {

		    $month_name[] = date('F', strtotime("$i months"));

		}*/

	///////////////////////////////////Join Member ///////////////////////////////////

			$aprilStartRegister = array();

			$TotalRegistered = array();

			$MonthData = array();

			$monthcount = 12;

			$k=0;

			for ($i=4; $i <= 12; $i++) {



				$startRegister   = strftime("%F", strtotime($startYear."-".$i));

				$startYearRegisterDate   = date("Y-m-t", strtotime($startRegister));

				$newRegistrationAprilToDecember = RegistrationModel::where('status','1')->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();

				$newRegistrationAprilToDecember1 = RegistrationModel::where('status','7')->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();

				$month_name[] = date("F", strtotime($startRegister));

				$RegistrationFee =  RegistrationFeesModel::orderBy('registration_fees_id','DESC')->take(1)->get()->toArray();

				//dd($RegistrationFee[0]['end_age1']);

				if(count($RegistrationFee) >0 ){



					$new18To30Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age1'])->where('age','<=',$RegistrationFee[0]['end_age1'])->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();



					$new31To37Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age2'])->where('age','<=',$RegistrationFee[0]['end_age2'])->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();



					$new38To47Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age3'])->where('age','<=',$RegistrationFee[0]['end_age3'])->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();



					$new48To55Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age4'])->where('age','<=',$RegistrationFee[0]['end_age4'])->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();


					$new55To60Register1 = RegistrationModel::where('status','1')->where('age','>','55')->where('age','<=','60')->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->whereBetween('ysk_id', [1, 5000])->get()->toArray();



					$newYskMitra1 = RegistrationModel::where('status','7')->where('today_date','>=',$startRegister)->where('today_date','<=',$startYearRegisterDate)->get()->toArray();

				}

				$new48To55Register1 = count($new48To55Register1) + count($new55To60Register1);

				$ExpectedData[] = $this->ExpectedData($refundpayment[0],$refundpayment[1],$refundpayment[2],$refundpayment[3],count($new18To30Register1),count($new31To37Register1),count($new38To47Register1),$new48To55Register1,count($newYskMitra1),$monthcount);



				$TotalRegistered[] = count($newRegistrationAprilToDecember)+count($newRegistrationAprilToDecember1);



				$MonthData[] = [count($new18To30Register1),count($new31To37Register1),count($new38To47Register1),$new48To55Register1,count($newYskMitra1)];



				$monthcount--;



				$get18To30Total[] = $MonthData[$k][0];

				$get31To37Total[] = $MonthData[$k][1];

				$get38To47Total[] = $MonthData[$k][2];

				$get48To55Total[] = $MonthData[$k][3];

				$getYskMitra1[]   = $MonthData[$k][4];



				$ExpectedTotal[] = $ExpectedData[$k][0];

				$RealTotal[] = $ExpectedData[$k][1];

				$diffTotal[] = $ExpectedData[$k][2];

				$k++;

			}

			$monthcount = $monthcount;

			$k=$k;

			for ($i=1; $i < 4; $i++) {



				$endRegister   = strftime("%F", strtotime($EndYear."-".$i));

				$endYearRegisterDate   = date("Y-m-t", strtotime($endRegister));



				$endRegister1[]   = $endRegister;

				$endYearRegisterDate1[]   = $endYearRegisterDate;



				$newRegistrationJanuaryToMarch = RegistrationModel::where('status','1')->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();

				$newRegistrationJanuaryToMarch1 = RegistrationModel::where('status','7')->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();

				$RegistrationFee =  RegistrationFeesModel::orderBy('registration_fees_id','DESC')->take(1)->get()->toArray();

				$month_name[] = date("F", strtotime($endRegister));

				//dd($RegistrationFee[0]['end_age1']);

				if(count($RegistrationFee) >0 ){





					$new18To30Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age1'])->where('age','<=',$RegistrationFee[0]['end_age1'])->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();



					$new31To37Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age2'])->where('age','<=',$RegistrationFee[0]['end_age2'])->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();



					$new38To47Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age3'])->where('age','<=',$RegistrationFee[0]['end_age3'])->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();



					$new48To55Register1 = RegistrationModel::where('status','1')->where('age','>=',$RegistrationFee[0]['start_age4'])->where('age','<=',$RegistrationFee[0]['end_age4'])->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();

					$new55To60Register1 = RegistrationModel::where('status','1')->where('age','>','55')->where('age','<=','60')->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->whereBetween('ysk_id', [1, 5000])->get()->toArray();

				}

				$newYskMitra1 = RegistrationModel::where('status','7')->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();

				$newYskMitra2[] = RegistrationModel::where('status','7')->where('today_date','>=',$endRegister)->where('today_date','<=',$endYearRegisterDate)->get()->toArray();



				$TotalRegistered[] = count($newRegistrationJanuaryToMarch)+count($newRegistrationJanuaryToMarch1);

				$new48To55Register1 = count($new48To55Register1) + count($new55To60Register1);

				$MonthData[] = [count($new18To30Register1),count($new31To37Register1),count($new38To47Register1),$new48To55Register1,count($newYskMitra1)];

				$ExpectedData[] = $this->ExpectedData($refundpayment[0],$refundpayment[1],$refundpayment[2],$refundpayment[3],count($new18To30Register1),count($new31To37Register1),count($new38To47Register1),$new48To55Register1,count($newYskMitra1),$monthcount);

				$monthcount--;

				$get18To30Total[] = $MonthData[$k][0];

				$get31To37Total[] = $MonthData[$k][1];

				$get38To47Total[] = $MonthData[$k][2];

				$get48To55Total[] = $MonthData[$k][3];

				$getYskMitra1[]   = $MonthData[$k][4];



				$ExpectedTotal[] = $ExpectedData[$k][0];

				$RealTotal[] = $ExpectedData[$k][1];

				$diffTotal[] = $ExpectedData[$k][2];

				$k++;

			}

			//dd($TotalRegistered);

			$total48To55Ysk = array_sum($get48To55Total) + array_sum($getYskMitra1);

			$refundpaymentSecond = $this->RefundPayment(array_sum($get18To30Total),array_sum($get31To37Total),array_sum($get38To47Total),$total48To55Ysk,array_sum($diffTotal));

			////////////////////////////////Insert Data/////////////////////////////////////////////

			$checkData = SahyognidhiManpowerModel::where('start_year',$startYear)->where('end_year',$EndYear)->get();

			//dd($checkData);

			if(count($checkData)>0){

				 SahyognidhiManpowerLedgerModel::where('fk_sahyognidhi_manpower_id',$checkData[0]['sahyognidhi_manpower_id'])->delete();

				 SahyognidhiManpowerRefundpaymentAmounts::where('fk_sahyognidhi_manpower_id',$checkData[0]['sahyognidhi_manpower_id'])->delete();

				 SahyognidhiManpowerModel::where('sahyognidhi_manpower_id',$checkData[0]['sahyognidhi_manpower_id'])->delete();

				 SahyognidhiManpowerFinalRefundamounts::where('fk_sahyognidhi_manpower_id',$checkData[0]['sahyognidhi_manpower_id'])->delete();

			}

			$data = SahyognidhiManpowerModel::create([

				'start_year' 					=> $startYear,

				'end_year' 						=> $EndYear,

				'total_sahyognidhi_request' 	=> Input::get('total_sahyognidhi_request'),

				'total_group1_people' 			=> $getgroup1,

				'total_group2_people' 			=> $getgroup2,

				'total_group3_people' 			=> $getgroup3,

				'total_group4_people' 			=> $getgroup4,

				'total_group5_people' 			=> $getgroup5,

				'total_sahyognidhi_amount' 		=> Input::get('total_sahyognidhi_amount'),

				'reserve_fund_percentage' => Input::get('reserve_fund_percentage'),

				'reserve_fund_amount'     => Input::get('reserve_fund_amount'),

				'last_year_reserve_fund_amount' => Input::filled('last_year_reserve_fund_amount') ? Input::get('last_year_reserve_fund_amount'):'',

				'drop_ratio_percentage' => Input::get('drop_ratio_percentage'),

				'round_up_drop_ratio_amount' => Input::get('round_up_drop_ratio_amount'),

				'actual_drop_ratio_amount' => Input::filled('actual_drop_ratio_amount') ? Input::get('actual_drop_ratio_amount'):'',

				'total_amount' => Input::get('total_amount'),

				'created_by'     => Auth::user()->user_id,

			]);

			$insertId           = $data['sahyognidhi_manpower_id'];



			if (Input::get('fk_ledger_account_id') != '')

			{

				for ($i=0; $i < count(Input::get('design_id')); $i++) {

					SahyognidhiManpowerLedgerModel::create([

						'fk_sahyognidhi_manpower_id' => $insertId,

						'fk_ledger_account_id' => Input::get('fk_ledger_account_id')[$i],

						'reduct_amount' => Input::get('reduct_amount')[$i],

						'created_by'     => Auth::user()->user_id,

					]);

				}

			}



			SahyognidhiManpowerRefundpaymentAmounts::create([

				'fk_sahyognidhi_manpower_id'=> $insertId,

				'first_total_amount' 		=> Input::get('total_amount'),

				'second_total_amount' 		=> array_sum($diffTotal),

				'first_amount_group1' 		=> $refundpayment[0],

				'first_amount_group2' 		=> $refundpayment[1],

				'first_amount_group3' 		=> $refundpayment[2],

				'first_amount_group4' 		=> $refundpayment[3],

				'first_amount_group5' 		=> $refundpayment[3],

				'second_amount_group1' 		=> $refundpaymentSecond[0],

				'second_amount_group2' 		=> $refundpaymentSecond[1],

				'second_amount_group3' 		=> $refundpaymentSecond[2],

				'second_amount_group4' 		=> $refundpaymentSecond[3],

				'second_amount_group5' 		=> $refundpaymentSecond[3],

				'created_by'				=> Auth::user()->user_id,

			]);





			///////////////////////////////////////////////////////////////////////////////////////



	$html = '';

	$html .= '

		<div class="kt-portlet__body">

			<div class="kt-form__section kt-form__section--first">

				<h4>Age Group</h4>

				<div class="form-group row">

					<div class="col-xl-2 col-lg-2 col-sm-3 col-md-3">

						<span class="col-lg-1 col-form-label">'.$RegistrationFee[0]['start_age1'].' to '.$RegistrationFee[0]['end_age1'].'</span>

						<p class="col-lg-2 col-form-label" id="amountGiven18To30">'.number_format($refundpayment[0],2).'</p>

					</div>

					<div class="col-xl-2 col-lg-2 col-sm-3 col-md-3">

						<span class="col-lg-1 col-form-label">'.$RegistrationFee[0]['start_age2'].' to '.$RegistrationFee[0]['end_age2'].'</span>

						<p class="col-lg-2 col-form-label" id="amountGiven31To37">'.number_format($refundpayment[1],2).'</p>

					</div>

					<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">

						<span class="col-lg-1 col-form-label">'.$RegistrationFee[0]['start_age3'].' to '.$RegistrationFee[0]['end_age3'].'</span>

						<p class="col-lg-1 col-form-label" id="amountGiven38To47">'.number_format($refundpayment[2],2).'</p>

					</div>

					<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">

						<span class="col-lg-1 col-form-label">'.$RegistrationFee[0]['start_age4'].' to '.$RegistrationFee[0]['end_age4'].'</span>

						<p class="col-lg-1 col-form-label" id="amountGiven48To55">'.number_format($refundpayment[3],2).'</p>

					</div>

					<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">

						<span class="col-lg-1 col-form-label">YSK Mitra</span>

						<p class="col-lg-1 col-form-label" id="amountGiven48To55">'.number_format($refundpayment[3],2).'</p>

					</div>

				</div>

					<div class="form-group row" >

						<div id="MonthData"></div>

						<div class="col-xl-3 col-lg-3 col-sm-3 col-md-3">

							<span class="col-lg-3 col-form-label" style="font-weight: bold;">Registration Month</span>';

							foreach ($month_name as $key => $monthnamevalue) {

								$html .='<p class="col-lg-3 col-form-label">'.$monthnamevalue.'</p>';



							}

						$html .='

						</div>

						<div class="col-xl-3 col-lg-3 col-sm-3 col-md-3">

							<p class="col-lg-3 col-form-label" style="font-weight: bold;">Join Member</p>';

							foreach ($TotalRegistered as $key => $TotalRegisteredvalue) {

								$html .='

									<span class="col-lg-3 col-form-label" id="newRegistrationApril">'.$TotalRegisteredvalue.'&nbsp;&nbsp;&nbsp;<i class="fa fa-question-circle" title="18 to 30 - '.$MonthData[$key][0].' ,31 to 37 - '.$MonthData[$key][1].',38 to 47 - '.$MonthData[$key][2].',48 to 55 - '.$MonthData[$key][3].',YskMitra - '.$MonthData[$key][4].'" style="color: red;"></i></span>

									<br><br>';

							}

							$html .='

						</div>

						<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">

							<span class="col-lg-2 col-form-label" style="font-weight: bold;">Expected Amount</span>';

							 foreach ($ExpectedData as $key => $ExpectedDatavalue) {

								$html .='	<p class="col-lg-2 col-form-label" id="monthRepaymentOfApril">'.number_format($ExpectedDatavalue[0],2).'</p>';

							}

						$html .='

						</div>

						<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">

							<span class="col-lg-2 col-form-label" style="font-weight: bold;">Received Amount</span>';

							foreach ($ExpectedData as $key => $ExpectedDatavalue) {

								$html .='	<p class="col-lg-2 col-form-label" id="monthRepaymentOfApril">'.number_format($ExpectedDatavalue[1],2).'</p>';

							}

						$html .='

						</div>

						<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">

							<span class="col-lg-2 col-form-label" style="font-weight: bold;">Difference Amount</span>';

							foreach ($ExpectedData as $key => $ExpectedDatavalue) {

								$html .='	<p class="col-lg-2 col-form-label" id="monthRepaymentOfApril">'.number_format($ExpectedDatavalue[2],2).'</p>';

							}

						$html .='

						</div>

					</div>

					<div class="kt-portlet__foot">

						<div class="kt-form__actions">

							<div class="row">

								<div class="col-lg-3" style="font-weight: bold;">Total</div>

								<div class="col-lg-3" style="font-weight: bold;"><span>'.array_sum($TotalRegistered).'</span></div>

								<div class="col-lg-2" style="font-weight: bold;"><span>'.number_format(array_sum($ExpectedTotal),2).'</span></div>

								<div class="col-lg-2" style="font-weight: bold;"><span>'.number_format(array_sum($RealTotal),2).'</span></div>

								<div class="col-lg-2" style="font-weight: bold;"><span>'.number_format(array_sum($diffTotal),2).'</span></div>

							</div>

						</div>

					</div>

					<h4>Age Group</h4>

					<div class="form-group row">

						<div class="col-xl-2 col-lg-2 col-sm-3 col-md-3">

							<span class="col-lg-1 col-form-label">18 to 30</span>

							<p class="col-lg-2 col-form-label">'.number_format($refundpaymentSecond[0],2).'</p>

						</div>

						<div class="col-xl-2 col-lg-2 col-sm-3 col-md-3">

							<span class="col-lg-1 col-form-label">31 to 37</span>

							<p class="col-lg-2 col-form-label">'.number_format($refundpaymentSecond[1],2).'</p>

						</div>

						<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">

							<span class="col-lg-1 col-form-label">38 to 47</span>

							<p class="col-lg-1 col-form-label">'.number_format($refundpaymentSecond[2],2).'</p>

						</div>

						<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">

							<span class="col-lg-1 col-form-label">48 to 55</span>

							<p class="col-lg-1 col-form-label">'.number_format($refundpaymentSecond[3],2).'</p>

						</div>

						<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">

							<span class="col-lg-1 col-form-label">YskMitra</span>

							<p class="col-lg-1 col-form-label">'.number_format($refundpaymentSecond[3],2).'</p>

						</div>

					</div>

					<div class="form-group row">

						<label class="col-lg-2 col-form-label">Admin Charge<span class="text-required">*</span></label>

						<div class="col-xl-5 col-lg-5 col-sm-6 col-md-6">

							<input type="text" class="form-control" name="admin_charge" placeholder="Enter Admin Charge" value="" id="admin_charge" required>

						</div>

					</div>

				</div>

			</div>

					<div class="kt-portlet__foot">

						<div class="kt-form__actions">

							<div class="row">

								<div class="col-lg-2"></div>

								<div class="col-lg-10">

									<input type="submit" class="btn btn-success" value="Submit" style="float: right;" onclick="submitadmincharge();">

								</div>



							</div>

						</div>

					</div>

					';

			$responseData = array("success" => "1",'html'=>$html);



		echo json_encode($responseData);

		exit;



}



public function AdminChargeAdd(Request $Request){

	$startYear = Input::get('start_year');

	$EndYear = Input::get('end_year');

	$AdminCharge = Input::get('admin_charge');

	$checkData = SahyognidhiManpowerModel::where('start_year',$startYear)->where('end_year',$EndYear)->get();

	if(count($checkData)>0){

		$repaymentData = SahyognidhiManpowerRefundpaymentAmounts::where('fk_sahyognidhi_manpower_id',$checkData[0]['sahyognidhi_manpower_id'])->get();

		SahyognidhiManpowerRefundpaymentAmounts::where('sahyognidhi_manpower_refundpayment_amount_id',$repaymentData[0]['sahyognidhi_manpower_refundpayment_amount_id'])->update(array(

			'admin_charge' 		  	=> $AdminCharge,

			'updated_by'            => Auth::user()->user_id,

		));



	}

	$RegistrationFee =  RegistrationFeesModel::orderBy('registration_fees_id','DESC')->take(1)->get()->toArray();

	$agegroup1finalData = $repaymentData[0]['first_amount_group1'] + $repaymentData[0]['second_amount_group1'] + $AdminCharge;

	$agegroup2finalData = $repaymentData[0]['first_amount_group2'] + $repaymentData[0]['second_amount_group2'] + $AdminCharge;

	$agegroup3finalData = $repaymentData[0]['first_amount_group3'] + $repaymentData[0]['second_amount_group3'] + $AdminCharge;

	$agegroup4finalData = $repaymentData[0]['first_amount_group4'] + $repaymentData[0]['second_amount_group4'] + $AdminCharge;

	$agegroup5finalData = $repaymentData[0]['first_amount_group5'] + $repaymentData[0]['second_amount_group5'] + $AdminCharge;



	if(count($checkData)>0){

		$data = SahyognidhiManpowerFinalRefundamounts::create([

				'fk_sahyognidhi_manpower_id' 	=> $checkData[0]['sahyognidhi_manpower_id'],

				'group1' 						=> $agegroup1finalData,

				'group2'						=> $agegroup2finalData,

				'group3' 						=> $agegroup3finalData,

				'group4'						=> $agegroup4finalData,

				'group5'						=> $agegroup5finalData,

				'created_by'					=> Auth::user()->user_id,



			]);

	}

	$html = '';

	$html .='

			<input type="hidden" name="_token" value="{{csrf_token()}}">

		<div class="kt-portlet__body">

			<div class="kt-form__section kt-form__section--first">

				<h4>Age Group</h4>

				<div class="form-group row">

					<div class="col-xl-3 col-lg-3 col-sm-3 col-md-3">

						<span class="col-lg-1 col-form-label">'.$RegistrationFee[0]['start_age1'].' to '.$RegistrationFee[0]['end_age1'].'</span>

						<p class="col-lg-2 col-form-label">'.$agegroup1finalData.'</p>

						<input type="text" class="form-control" name="group1roudup" id="group1roudup" placeholder="Enter Round Off Amount" value="">



					</div>

					<div class="col-xl-3 col-lg-3 col-sm-3 col-md-3">

						<span class="col-lg-1 col-form-label">'.$RegistrationFee[0]['start_age2'].' to '.$RegistrationFee[0]['end_age2'].'</span>

						<p class="col-lg-2 col-form-label">'.$agegroup2finalData.'</p>

						<input type="text" class="form-control" name="group2roudup" id="group2roudup" placeholder="Enter Round Off Amount" value="">



					</div>

					<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">

						<span class="col-lg-1 col-form-label">'.$RegistrationFee[0]['start_age3'].' to '.$RegistrationFee[0]['end_age3'].'</span>

						<p class="col-lg-1 col-form-label">'.$agegroup3finalData.'</p>

						<input type="text" class="form-control" name="group3roudup" id="group3roudup" placeholder="Enter Round Off Amount" value="">



					</div>

					<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">

						<span class="col-lg-1 col-form-label">'.$RegistrationFee[0]['start_age4'].' to '.$RegistrationFee[0]['end_age4'].'</span>

						<p class="col-lg-1 col-form-label">'.$agegroup4finalData.'</p>

						<input type="text" class="form-control" name="group4roudup" id="group4roudup" placeholder="Enter Round Off Amount" value="">



					</div>

					<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">

						<span class="col-lg-1 col-form-label">YskMitra</span>

						<p class="col-lg-1 col-form-label">'.$agegroup5finalData.'</p>

						<input type="text" class="form-control" name="group5roudup" id="group5roudup" placeholder="Enter Round Off Amount" value="">



					</div>

				</div>

			</div>

		</div>

		<div class="kt-portlet__foot">

			<div class="kt-form__actions">

				<div class="row">

					<div class="col-lg-2"></div>

					<div class="col-lg-10">
 <form class="kt-form" action="" method="POST" style="margin-top: -5px;">
<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="button" class="btn btn-success" value="Submit" onclick="submitfinalrepayment();" style="float: right;">
</form>
					</div>



				</div>

			</div>

		</div>

	';

	$responseData = array("success" => "1",'html'=>$html);



		echo json_encode($responseData);


}



	public function FinalRepaymentAdd(Request $Request){



		$startYear 		= Input::get('start_year');

		$EndYear 		= Input::get('end_year');

		$AdminCharge 	= Input::get('admin_charge');

		$group1roudup 	= Input::get('group1roudup');

		$group2roudup 	= Input::get('group2roudup');

		$group3roudup 	= Input::get('group3roudup');

		$group4roudup 	= Input::get('group4roudup');

		$group5roudup 	= Input::get('group5roudup');

		$checkData = SahyognidhiManpowerModel::where('start_year',$startYear)->where('end_year',$EndYear)->get();
        // echo"<pre>";print_r($checkData);die;
		if(count($checkData)>0){

			$repaymentData = SahyognidhiManpowerFinalRefundamounts::where('fk_sahyognidhi_manpower_id',$checkData[0]['sahyognidhi_manpower_id'])->get();

			SahyognidhiManpowerFinalRefundamounts::where('sahyognidhi_manpower_final_refundamount_id',$repaymentData[0]['sahyognidhi_manpower_final_refundamount_id'])->update(array(

				'group1roudup' 		  	=> $group1roudup,

				'group2roudup' 		  	=> $group2roudup,

				'group3roudup' 		  	=> $group3roudup,

				'group4roudup' 		  	=> $group4roudup,

				'group5roudup' 		  	=> $group5roudup,

				'updated_by'            => Auth::user()->user_id,

			));



		}

		$responseData = array("success" => "0");



			echo json_encode($responseData);

			exit;

		//return redirect()->route('sahyognidhi-manpower-view')->with('success','Sahyognidhi Manpower added successfully');

	}





	public function deleteSahyognidhiManpower($id)

    {

    	try{

			SahyognidhiManpowerLedgerModel::where('fk_sahyognidhi_manpower_id',$id)->delete();

			SahyognidhiManpowerRefundpaymentAmounts::where('fk_sahyognidhi_manpower_id',$id)->delete();

			SahyognidhiManpowerModel::where('sahyognidhi_manpower_id',$id)->delete();

			SahyognidhiManpowerFinalRefundamounts::where('fk_sahyognidhi_manpower_id',$id)->delete();

            return redirect()->route('sahyognidhi-manpower-view')->with('success','Sahyognidhi Manpower deleted succesfully');

            }

            catch (\Illuminate\Database\QueryException $e){

            return redirect()->route('sahyognidhi-manpower-view')->with('error', 'Unable to delete Sahyognidhi Manpower.');

           }

    }

    function getsendsms(Request $Request){

        $Repayment =DB::table('repayments')->pluck('phone_number_first')->toArray();
       // return view ('admin.sahyognidhi-manpower-view');
       // return json_encode($Repayment);
        foreach($Repayment as $phonenumber){
			$message='Hi i am testing on generating bill ';
            $curl = curl_init();
         $url = "http://sms.mobileadz.in/api/push.json?apikey=5ce64d9ed4ab4&route=Transactional&sender=YSKYSK&mobileno=8733009843&text=Generatingbill";
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/json",
                ),
            ));

            $response 	= curl_exec($curl);
            $err 		= curl_error($curl);

            curl_close($curl);
            return json_encode($url);

        }

}

}

