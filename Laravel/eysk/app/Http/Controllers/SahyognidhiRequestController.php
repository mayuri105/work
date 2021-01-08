<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Session;
use App\SahyognidhiRequestModel;
use App\RegistrationModel;
use App\SahyognidhiAmountModel;
use App\BankNameModel;
use App\NomineeDetailsModel;
use App\DiseaseModel;
use App\RepaymentModel;
use App\SahyognidhiPaymentModel;
use App\DeathTypeModel;
use App\LedgerAccountModel;
use App\SahyognidhiUploadDocument;
use App\SahyognidhiNomineeModel;
use App\KaryakartaModel;
use App\RegionsModel;
use App\CouncilModel;
use App\DivisionModel;
use App\SamajZoneModel;
use App\YuvaMandalNumberModel;
use App\RegistrationFeesModel;
use DateTime;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Excel;
use PHPExcel;
use App\Exports\ExportUsers;
use App\Imports\ImportUsers;
use Auth;
class SahyognidhiRequestController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkLogin');
	}
	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function sahyognidhiRequest($region=0 , $council=0,$startDate =0,$endDate=0,$division=0,$samajzone=0,$yuvamandal=0,$agegroup=0,$gender=0,$statuslock=0,$statuslock2=0)
	{	
		$regionData        = RegionsModel::where('status','1')->get();
        $councilData     = CouncilModel::where('status','1')->get();
        $divisionData    = DivisionModel::where('status','1')->get();
        $samajZone       = SamajZoneModel::where('status','1')->get();
        $yuvaMandal      = YuvaMandalNumberModel::where('status','1')->get();
        if($statuslock > 0){
        	if($statuslock == 1){
        		$ststus1Name = 'Locking Period';
        	}
        	if($statuslock == 2){
        		$ststus1Name = 'Sucide';
        	}
        	if($statuslock == 3){
        		$ststus1Name = 'Repayment Not Paid';
        	}
        	if($statuslock == 4){
        		$ststus1Name = 'Other Reason';
        	}
        	if($statuslock == 5){
        		$ststus1Name = 'Eligible Paid';
        	}
        	if($statuslock == 6){
        		$ststus1Name = 'Eligible Pending';
        	}
		}
        if($statuslock2 >0){
        	if($statuslock2 == 1){
        		$ststus2Name = 'Half Disability';
        	}
        	if($statuslock2 == 2){
        		$ststus2Name = 'Full Disability';
        	}
        	if($statuslock2 == 3){
        		$ststus2Name = 'Devantage';
        	}
        	
        }
       
        if($agegroup > 0){
            //dd($agegroup);
            $agegroup1  = $agegroup;
            $pieces = explode("-", $agegroup1);
            //dd ($pieces[0]); 
            $startAge = $pieces[0];
            $endAge = $pieces[1];
        }
		Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('sahyognidhi-request',Auth::user()->fk_role_id);
		/*$sahyognidhiRequest = SahyognidhiRequestModel::where('sahyognidhi_requests.status','!=','3')
							->select('sahyognidhi_requests.*',
								'registrations.ysk_id'
							)
							->leftJoin('registrations', 'registrations.ysk_id', '=', 'sahyognidhi_requests.fk_ysk_id')
							->groupBy('sahyognidhi_requests.sahyognidhi_id')
							->orderBy('sahyognidhi_requests.sahyognidhi_id','DESC')
							->get();
							dd($sahyognidhiRequest);*/
		$sahyognidhiRequest = SahyognidhiRequestModel::where('sahyognidhi_requests.status','!=','3')
							->select('sahyognidhi_requests.*',
								'registrations.ysk_id'
							)
							->leftJoin('registrations', 'registrations.ysk_id', '=', 'sahyognidhi_requests.fk_ysk_id')
							->leftJoin('sahyognidhi_payments', 'sahyognidhi_payments.fk_sahyognidhi_id', '=', 'sahyognidhi_requests.sahyognidhi_id')
							->groupBy('sahyognidhi_requests.sahyognidhi_id')
							->orderBy('sahyognidhi_requests.sahyognidhi_id','DESC');
							
					if($region>0){
						/*$regionData1        = RegionsModel::where('region_id',$region)->get();
						if(count($regionData1)>0){*/
							$sahyognidhiRequest->where('registrations.fk_region_id',$region);
							//$registration
						/*}*/
                        
                    }
					if($council>0){
                    	$sahyognidhiRequest->where('registrations.fk_council_id',$council);
                    }
                    if($startDate>0){
                        $startDate1       = date('Y-m-d',strtotime($startDate));
                        $sahyognidhiRequest->where('sahyognidhi_date','>=',$startDate1);
                    }
                    if($endDate>0){
                        $endDate1       = date('Y-m-d',strtotime($endDate));
                        $sahyognidhiRequest->where('sahyognidhi_date','<=',$endDate1);
                    }
                   if($division>0){
                         $sahyognidhiRequest->where('registrations.fk_division_id',$division);
                    }
                    if($samajzone>0){
                         $sahyognidhiRequest->where('registrations.fk_samaj_zone_id',$samajzone) ;
                    }
                    if($yuvamandal>0){
                         $sahyognidhiRequest->where('registrations.fk_yuva_mandal_id',$yuvamandal);
                    }
                    if($agegroup > 0){
                         $sahyognidhiRequest->where('sahyognidhi_requests.age','>=',$startAge)->where('sahyognidhi_requests.age','<=',$endAge);
                    }
                    if($gender > 0){
                        if($gender == 1)
                        {
                            $gendername = 'Male';
                        }else{
                            $gendername =  'Female';
                        }
                        $sahyognidhiRequest->where('sahyognidhi_requests.gender',$gendername);
                        
                    }
                    if($statuslock > 0){
                    	if($ststus1Name=='Eligible Paid'){
                    		$sahyognidhiRequest->where('sahyognidhi_requests.status','1');
                    	}elseif($ststus1Name=='Eligible Pending'){
                    		$sahyognidhiRequest->where('sahyognidhi_requests.status','0');
                    	}else{

                        	$sahyognidhiRequest->where('sahyognidhi_payments.reason_selection',$ststus1Name);
                    	}
                    }
                   	if($statuslock2 > 0){
                        $sahyognidhiRequest->where('sahyognidhi_requests.sahyognidhi_request',$ststus2Name);
                    }
                   $sahyognidhiRequest = $sahyognidhiRequest->get();
                // $sahyognidhiRequest1 = $sahyognidhiRequest;  

		//dd($sahyognidhiRequest);
		$pendingSahyognidhiRequest = SahyognidhiRequestModel::where('status','0')->get()->toArray();
		if ($pendingSahyognidhiRequest == [] ) {
			$totalPendingSahyognidhiRequest = '0';
		}
		else{
			$totalPendingSahyognidhiRequest = count($pendingSahyognidhiRequest);
		}
		$paymentStatus = array();
		$paymentStatus1 = array();		
		foreach ($sahyognidhiRequest as $key => $value) {
			//dd($value['sahyognidhi_id']);
			$sahyognidhiPaymentStatus = SahyognidhiPaymentModel::where('fk_sahyognidhi_id',$value['sahyognidhi_id'])->where('status','!=','3')->get()->toArray();
			$i = 0;
			$a = 0;
			if (count($sahyognidhiPaymentStatus) > 0) {
				foreach ($sahyognidhiPaymentStatus as $key => $value1) {
					$status = $value1['payment_status'];
					$status1 = $value1['after_half_disiability'];
					if ($status == '1') {
						$i++;
					}
					if ($status1 == '2') {
						$a++;

					}
				}
			}
			$paymentStatus[] = $i;
			$paymentStatus1[] = $a;
		}					
		//dd($paymentStatus);
		$devangatMember  = SahyognidhiRequestModel::where('status','!=','3')->where('sahyognidhi_request','Devantage')->get()->toArray();
		if ($devangatMember == []) {
			$totalDevangatMember = '0';
		}
		else{
			$totalDevangatMember = count($devangatMember);
		}

		$devangatAccident = SahyognidhiRequestModel::where('status','!=','3')->where('cause_of_death','4')->get()->toArray();
		if ($devangatAccident == []) {
			$totalDevangatAccident = '0';
		}
		else{
			$totalDevangatAccident = count($devangatAccident);
		}

		$devangatNatural = SahyognidhiRequestModel::where('status','!=','3')->where('cause_of_death','8')->get()->toArray();
		if ($devangatNatural == []) {
			$totalDevangatNatural = '0';
		}
		else{
			$totalDevangatNatural = count($devangatNatural);
		}
		$devangatNatural = SahyognidhiRequestModel::where('status','!=','3')->where('cause_of_death','8')->get()->toArray();
		if ($devangatNatural == []) {
			$totalDevangatNatural = '0';
		}
		else{
			$totalDevangatNatural = count($devangatNatural);
		}

		$fullDisiability  = SahyognidhiRequestModel::where('status','!=','3')->where('sahyognidhi_request','Full Disability')->get()->toArray();
		//dd($fullDisiability);
		if ($fullDisiability == []) {
			$totalFullDisiabilityMember = '0';
		}
		else{
			$totalFullDisiabilityMember = count($fullDisiability);
		}

		$halfDisiability  = SahyognidhiRequestModel::where('status','!=','3')->where('sahyognidhi_request','Half Disability')->get()->toArray();
		//dd($halfDisiability);
		if ($halfDisiability == []) {
			$totalHalfDisiabilityMember = '0';
		}
		else{
			$totalHalfDisiabilityMember = count($halfDisiability);
		}

		$pendingEligableMember = SahyognidhiRequestModel::where('sahyognidhi_requests.status','!=','3')
								->leftJoin('sahyognidhi_payments','sahyognidhi_payments.fk_sahyognidhi_id','=','sahyognidhi_requests.sahyognidhi_id')
								->where('sahyognidhi_payments.payment_status','1')
								->orWhere('sahyognidhi_requests.status','0')
								->groupBy('sahyognidhi_requests.sahyognidhi_id')
								->get()->toArray();
		if ($pendingEligableMember == []) {
			$pendingButEligableMember = '0';
		}
		else{
			$pendingButEligableMember = count($pendingEligableMember);
		}

		$paidEligableMember = SahyognidhiRequestModel::where('status','1')->get()->toArray();
		if ($paidEligableMember == []) {
			$paidButEligableMember = '0';
		}
		else{
			$paidButEligableMember = count($paidEligableMember);
		}
		$lockingPeriodData = SahyognidhiPaymentModel::where('payment_status','=','3')->where('reason_selection','Locking Period')->get()->toArray();
		if ($lockingPeriodData == []) {
			$totalLockingPeriodMember = '0';
		}
		else{
			$totalLockingPeriodMember = count($lockingPeriodData);
		}

		$sucideData = SahyognidhiPaymentModel::where('payment_status','=','3')->where('reason_selection','Sucide')->get()->toArray();
		if ($sucideData == []) {
			$totalSucidePeriodMember = '0';
		}
		else{
			$totalSucidePeriodMember = count($sucideData);
		}

		$sucideData = SahyognidhiPaymentModel::where('payment_status','=','3')->where('reason_selection','Sucide')->get()->toArray();
		if ($sucideData == []) {
			$totalSucidePeriodMember = '0';
		}
		else{
			$totalSucidePeriodMember = count($sucideData);
		}

		$repaymentNtPaid = SahyognidhiPaymentModel::where('payment_status','=','3')->where('reason_selection','Repayment Not Paid')->get()->toArray();
		if ($repaymentNtPaid == []) {
			$repaymentNtPaidMember = '0';
		}
		else{
			$repaymentNtPaidMember = count($repaymentNtPaid);
		}

		$otherReason = SahyognidhiPaymentModel::where('payment_status','=','3')->where('reason_selection','Other Reason')->get()->toArray();
		if ($otherReason == []) {
			$otherReasonMember = '0';
		}
		else{
			$otherReasonMember = count($otherReason);
		}
		$RegistrationFee =  RegistrationFeesModel::orderBy('registration_fees_id','DESC')->take(1)->get();
		$bankName  =  BankNameModel::where('status','1')->get();
		if($startDate == 0){
			 $startDate = '';
		}
		if($endDate == 0){
			 $endDate = '';
		}
		return view('admin.sahyognidhi_request')->with('paymentStatus1',$paymentStatus1)->with('sahyognidhiRequest',$sahyognidhiRequest)->with('bankName',$bankName)->with('totalDevangatMember',$totalDevangatMember)->with('totalDevangatAccident',$totalDevangatAccident)->with('totalDevangatNatural',$totalDevangatNatural)->with('paymentStatus',$paymentStatus)->with('totalPendingSahyognidhiRequest',$totalPendingSahyognidhiRequest)->with('accessData',$accessData)->with('totalFullDisiabilityMember',$totalFullDisiabilityMember)->with('totalHalfDisiabilityMember',$totalHalfDisiabilityMember)->with('pendingButEligableMember',$pendingButEligableMember)->with('paidButEligableMember',$paidButEligableMember)->with('totalLockingPeriodMember',$totalLockingPeriodMember)->with('totalSucidePeriodMember',$totalSucidePeriodMember)->with('repaymentNtPaidMember',$repaymentNtPaidMember)->with('otherReasonMember',$otherReasonMember)->with('regionData',$regionData)->with('councilData',$councilData)->with('divisionData',$divisionData)->with('samajZone',$samajZone)->with('yuvaMandal',$yuvaMandal)->with('RegistrationFee',$RegistrationFee)->with(['region' => $region , 'council'=> $council ,'startDate' => $startDate,'endDate' => $endDate ,'division'=> $division,'samajzone' => $samajzone,'yuvamandal'=> $yuvamandal,'agegroup'=> $agegroup,'gender' => $gender,'statuslock'=> $statuslock,'statuslock2' => $statuslock2]);
	}
	 public function SayognidhiExcelAll($region=0 , $council=0,$startDate =0,$endDate=0,$division=0,$samajzone=0,$yuvamandal=0,$agegroup=0,$gender=0,$statuslock=0,$statuslock2=0){

       
                if($startDate == 0){
                    $allSearch[] = '-'; 
                }else{
                    $allSearch[] = $startDate; 
                }
        			/////////////////////////////////////////////////////
                if($endDate == 0){
                    $allSearch[] = '-'; 
                }else{
                    $allSearch[] = $endDate; 
                }
        		///////////////////////////////////////////////////////////
                if($council == 0){
                    $allSearch[] = '-'; 
                }else{
                    $councilData     = CouncilModel::where('council_id',$council)->get();
                    $allSearch[] = $councilData[0]['name']; 
                }
        		//////////////////////////////////////////////////////////
                if($samajzone == 0){
                    $allSearch[] = '-'; 
                }else{
                    $samajZonedb       = SamajZoneModel::where('samaj_zone_id',$samajzone)->get();
                    $allSearch[] = $samajZonedb[0]['samaj_zone_name']; 
                }        
        		//////////////////////////////////////////////////////////
                if($region == 0){
                    $allSearch[] = '-'; 
                }else{
                    $regionData        = RegionsModel::where('region_id',$region)->get();
                    $allSearch[] = $regionData[0]['region_name']; 
                }
        		//////////////////////////////////////////////////////////
                if($division == 0){
                    $allSearch[] = '-'; 
                }else{
                    $divisionData    = DivisionModel::where('division_id',$division)->get();
                    $allSearch[] = $divisionData[0]['division_name']; 
                }
        		//////////////////////////////////////////////////////////
                if($yuvamandal == 0){
                    $allSearch[] = '-'; 
                }else{
                    $yuvaMandaldb      = YuvaMandalNumberModel::where('yuva_mandal_number_id',$yuvamandal)->get();
                    $allSearch[] = $yuvaMandaldb[0]['yuva_mandal_number']; 
                }
        		/////////////////////////////////////////////////////////// 
                if($agegroup == 0){
                        $allSearch[] = '-'; 
                    }else{
                        $allSearch[] = $agegroup; 
                }      
        		////////////////////////////////////////////////////////////   
                if($gender == 0){
                        $allSearch[] = '-'; 
                    }else{
                        if($gender == 1)
                        {
                            $gendername = 'Male';
                        }else{
                            $gendername =  'Female';
                        }
                        $allSearch[] = $gendername; 
                } 
                //////////////////////////////////////////////////////////
                if($statuslock > 0){
		        	if($statuslock == 1){
		        		$ststus1Name = 'Locking Period';
		        		$allSearch[] = 'Locking Period';
		        	}
		        	if($statuslock == 2){
		        		$ststus1Name = 'Sucide';
		        		$allSearch[] = 'Sucide';
		        	}
		        	if($statuslock == 3){
		        		$ststus1Name = 'Repayment Not Paid';
		        		$allSearch[] = 'Repayment Not Paid';
		        	}
		        	if($statuslock == 4){
		        		$ststus1Name = 'Other Reason';
		        		$allSearch[] = 'Other Reason';
		        	}
		        	if($statuslock == 5){
		        		$ststus1Name = 'Eligible Paid';
		        		$allSearch[] = 'Eligible Paid';
		        	}
		        	if($statuslock == 6){
		        		$ststus1Name = 'Eligible Pending';
		        		$allSearch[] = 'Eligible Pending';
		        	}
				}else{
					$allSearch[] = '-';
				}
		        if($statuslock2 >0){
		        	if($statuslock2 == 1){
		        		$ststus2Name = 'Half Disability';
		        		$allSearch[] = 'Half Disability';
		        	}
		        	if($statuslock2 == 2){
		        		$ststus2Name = 'Full Disability';
		        		$allSearch[] = 'Full Disability';
		        	}
		        	if($statuslock2 == 3){
		        		$ststus2Name = 'Devantage';
		        		$allSearch[] = 'Devantage';
		        	}
		        	
		        }else{
					$allSearch[] = '-';
				}
                
        		/////////////////////////////////////////////////////////                 
		        if($agegroup > 0){
		            //dd($agegroup);
		            $agegroup1  = $agegroup;
		            $pieces = explode("-", $agegroup1);
		            //dd ($pieces[0]); 
		            $startAge = $pieces[0];
		            $endAge = $pieces[1];
		        }
		        //  ->select(DB::raw('group_concat(DISTINCT registrations.registration_id) as status_doc '))
		       $sahyognidhiRequest = SahyognidhiRequestModel::where('sahyognidhi_requests.status','!=','3')
		       ->leftJoin('registrations', 'registrations.ysk_id', '=', 'sahyognidhi_requests.fk_ysk_id')
		       ->leftJoin('sahyognidhi_payments', 'sahyognidhi_payments.fk_sahyognidhi_id', '=', 'sahyognidhi_requests.sahyognidhi_id')
							->groupBy('sahyognidhi_requests.sahyognidhi_id')
							->orderBy('sahyognidhi_requests.sahyognidhi_id','DESC');
							
					if($region>0){
						/*$regionData1        = RegionsModel::where('region_id',$region)->get();
						if(count($regionData1)>0){*/
							$sahyognidhiRequest->where('registrations.fk_region_id',$region);
							//$registration
						/*}*/
                        
                    }
					if($council>0){
                    	$sahyognidhiRequest->where('registrations.fk_council_id',$council);
                    }
                    if($startDate>0){
                        $startDate1       = date('Y-m-d',strtotime($startDate));
                        $sahyognidhiRequest->where('sahyognidhi_date','>=',$startDate1);
                    }
                    if($endDate>0){
                        $endDate1       = date('Y-m-d',strtotime($endDate));
                       where('sahyognidhi_date','<=',$endDate1);
                    }
                   /*if($division>0){
                        $registration->where('registrations.fk_division_id',$division);
                    }*/
                    if($samajzone>0){
                         $sahyognidhiRequest->where('registrations.fk_samaj_zone_id',$samajzone) ;
                    }
                    if($yuvamandal>0){
                         $sahyognidhiRequest->where('registrations.fk_yuva_mandal_id',$yuvamandal);
                    }
                    if($agegroup > 0){
                         $sahyognidhiRequest->where('sahyognidhi_requests.age','>=',$startAge)->where('sahyognidhi_requests.age','<=',$endAge);
                    }
                    if($gender > 0){
                        if($gender == 1)
                        {
                            $gendername = 'Male';
                        }else{
                            $gendername =  'Female';
                        }
                        $sahyognidhiRequest->where('sahyognidhi_requests.gender',$gendername);
                        
                    }
                   if($statuslock > 0){
                    	if($ststus1Name=='Eligible Paid'){
                    		$sahyognidhiRequest->where('sahyognidhi_requests.status','1');
                    	}elseif($ststus1Name=='Eligible Pending'){
                    		$sahyognidhiRequest->where('sahyognidhi_requests.status','0');
                    	}else{

                        	$sahyognidhiRequest->where('sahyognidhi_payments.reason_selection',$ststus1Name);
                    	}
                    }
                    if($statuslock2 > 0){
                        $sahyognidhiRequest->where('sahyognidhi_requests.sahyognidhi_request',$ststus2Name);
                    }
                   
                  // $sahyognidhiRequest = $sahyognidhiRequest->get();
		                 $test = $sahyognidhiRequest->pluck('sahyognidhi_requests.sahyognidhi_id')->toArray();
		                // $test = $registration->pluck('registrations.registration_id')->toArray();
		                 /*$users = RegistrationModel::select(DB::raw('group_concat(DISTINCT registrations.registration_id) as status_doc '))->whereIn('registration_id', $test)->get();*/
		                 //dd($test);
		                 $users = implode( ',', $test);
		                // dd($user);
		                //dd($users);
		                $id = $users;
		            return Excel::download(new ExportUsers($id,'4',$allSearch), 'SahyognidhiRequest-'.date('d-m-Y').'.xlsx');
    }
    public function SayognidhiExcel($id,$region=0 , $council=0,$startDate =0,$endDate=0,$division=0,$samajzone=0,$yuvamandal=0,$agegroup=0,$gender=0,$statuslock=0,$statuslock2=0){
        //dd('region');
        		
        if($startDate == 0){
                    $allSearch[] = '-'; 
                }else{
                    $allSearch[] = $startDate; 
                }
        /////////////////////////////////////////////////////
                if($endDate == 0){
                    $allSearch[] = '-'; 
                }else{
                    $allSearch[] = $endDate; 
                }
        ///////////////////////////////////////////////////////////
                if($council == 0){
                    $allSearch[] = '-'; 
                }else{
                    $councilData     = CouncilModel::where('council_id',$council)->get();
                    $allSearch[] = $councilData[0]['name']; 
                }
        //////////////////////////////////////////////////////////
                if($samajzone == 0){
                    $allSearch[] = '-'; 
                }else{
                    $samajZonedb       = SamajZoneModel::where('samaj_zone_id',$samajzone)->get();
                    $allSearch[] = $samajZonedb[0]['samaj_zone_name']; 
                }        
        //////////////////////////////////////////////////////////
                if($region == 0){
                    $allSearch[] = '-'; 
                }else{
                    $regionData        = RegionsModel::where('region_id',$region)->get();
                    $allSearch[] = $regionData[0]['region_name']; 
                }
        //////////////////////////////////////////////////////////
                if($division == 0){
                    $allSearch[] = '-'; 
                }else{
                    $divisionData    = DivisionModel::where('division_id',$division)->get();
                    $allSearch[] = $divisionData[0]['division_name']; 
                }
        //////////////////////////////////////////////////////////
                if($yuvamandal == 0){
                    $allSearch[] = '-'; 
                }else{
                    $yuvaMandaldb      = YuvaMandalNumberModel::where('yuva_mandal_number_id',$yuvamandal)->get();
                    $allSearch[] = $yuvaMandaldb[0]['yuva_mandal_number']; 
                }
        /////////////////////////////////////////////////////////// 
                if($agegroup == 0){
                        $allSearch[] = '-'; 
                    }else{
                        $allSearch[] = $agegroup; 
                }      
        ////////////////////////////////////////////////////////////   
                if($gender == 0){
                        $allSearch[] = '-'; 
                    }else{
                        if($gender == 1)
                        {
                            $gendername = 'Male';
                        }else{
                            $gendername =  'Female';
                        }
                        $allSearch[] = $gendername; 
                } 
                 if($statuslock > 0){
		        	if($statuslock == 1){
		        		$ststus1Name = 'Locking Period';
		        		$allSearch[] = 'Locking Period';
		        	}
		        	if($statuslock == 2){
		        		$ststus1Name = 'Sucide';
		        		$allSearch[] = 'Sucide';
		        	}
		        	if($statuslock == 3){
		        		$ststus1Name = 'Repayment Not Paid';
		        		$allSearch[] = 'Repayment Not Paid';
		        	}
		        	if($statuslock == 4){
		        		$ststus1Name = 'Other Reason';
		        		$allSearch[] = 'Other Reason';
		        	}
		        	if($statuslock == 5){
		        		$ststus1Name = 'Eligible Paid';
		        		$allSearch[] = 'Eligible Paid';
		        	}
		        	if($statuslock == 6){
		        		$ststus1Name = 'Eligible Pending';
		        		$allSearch[] = 'Eligible Pending';
		        	}
				}else{
					$allSearch[] = '-';
				}
		        if($statuslock2 >0){
		        	if($statuslock2 == 1){
		        		$ststus2Name = 'Half Disability';
		        		$allSearch[] = 'Half Disability';
		        	}
		        	if($statuslock2 == 2){
		        		$ststus2Name = 'Full Disability';
		        		$allSearch[] = 'Full Disability';
		        	}
		        	if($statuslock2 == 3){
		        		$ststus2Name = 'Devantage';
		        		$allSearch[] = 'Devantage';
		        	}
		        	
		        }else{
					$allSearch[] = '-';
				}
                
        ///////////////////////////////////////////////////////// 
               //dd($id);
            return Excel::download(new ExportUsers($id,'4',$allSearch), 'SahyognidhiRequest-'.date('d-m-Y').'.xlsx');
    }

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function addSahyognidhiRequest()
	{
		//$yskMember = RegistrationModel::where('status','1')->get();
		$accessData = $this->getArray('sahyognidhi-request',Auth::user()->fk_role_id);
		$sahyognidhiMember = SahyognidhiRequestModel::where('status','!=','3')->get();
		$fkYskId = array();
		foreach ($sahyognidhiMember as $key) {
			$fkYskId[] = $key->fk_ysk_id;
		}
		$yskMember = RegistrationModel::
				     whereNotIn('ysk_id', $fkYskId)
				    ->whereNotIn('pre_ysk_id',$fkYskId)
				    ->where('status','1')
					->get();
		$informerName = KaryakartaModel::where('karyakartas.status','!=','3')
						->select('karyakartas.name_as_per_yuva_sangh_org',
							'karyakartas.karyakarta_id',
							'roles.name'
						)
						->leftJoin('roles','roles.role_id','=','karyakartas.fk_role_id')
						->get();
		//dd($yskMember->toArray());
		$deathType  = DeathTypeModel::where('status','1')->get();
		$getBankName  =  BankNameModel::where('status','1')->get();
		return view('admin.sahyognidhi_request_add')->with('yskMember',$yskMember)->with('getBankName',$getBankName)->with('deathType',$deathType)->with('accessData',$accessData)->with('informerName',$informerName);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function getDataByYskId()
	{
		$getData = RegistrationModel::where('registrations.status','1')
					->where('registrations.ysk_id',Input::get('fk_ysk_id'))
					->orWhere('registrations.pre_ysk_id',Input::get('fk_ysk_id'))
					->select('registrations.*',
						'nominee_details.first_nominee_name',
						'nominee_details.first_nominee_member_id',
						'nominee_details.first_nominee_relation',
						'nominee_details.second_nominee_name',
						'nominee_details.second_nominee_member_id',
						'nominee_details.second_nominee_relation',
						'regions.region_name',
						'councils.name',
						'councils.code',
						'samaj_zones.samaj_zone_name',
						'yuva_mandal_numbers.yuva_mandal_number',
						'yuva_mandal_numbers.yuva_mandal_code',
						'cities.city_name'
				)
				->leftJoin('nominee_details','nominee_details.fk_registration_id','=','registrations.registration_id')
				->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
				->leftJoin('councils','councils.council_id','=','registrations.fk_council_id')
				->leftJoin('samaj_zones','samaj_zones.samaj_zone_id','=','registrations.fk_samaj_zone_id')
				->leftJoin('yuva_mandal_numbers','yuva_mandal_numbers.yuva_mandal_number_id','=','registrations.fk_yuva_mandal_id')
				->leftJoin('cities','cities.city_id','=','registrations.fk_city_id')
				->where('nominee_details.fk_registration_default_status','1')
				->get()->toArray();
				//dd($getData);

				/*$paymentDetails  = RepaymentModel::where('repayments.status','1')
								 ->where('fk_registration_id',$getData[0]['registration_id'])
								 ->select('repayments.*',
									'bank_names.bank_name',
								 )
								 ->leftJoin('bank_names','bank_names.bank_name_id','=','repayments.fk_bank_name')
								 ->first();*/

				$existingDisease = DiseaseModel::where('status','1')->get();
				
				$val = [];
				foreach ($existingDisease as $existingDiseases) {
					if(in_array($existingDiseases->disease_id, explode(',', $getData[0]['fk_existing_disease']))){
						 $val[] = $existingDiseases->disease_name ;
					}
				}
				$existingDiseaseAll = implode(',', $val);
				//dd($existingDiseaseAll);
				
				foreach ($getData as $key => $value) {
					$yskConfirmationDate        =  date('Y-m-d',strtotime($value['ysk_confirmation_date']));
					$familyId 					=  $value['family_id'];
					$memberId                   =  $value['member'];
					$ysk_id                   =  $value['ysk_id'];
					$nameAsPerYuvaSanghOrg 		=  $value['name_as_per_yuva_sangh_org'];
					//$nameAsPerYskSubmissionForm =  $value['name_as_per_ysk_submission_form'];
					$regionName 				=  $value['region_name'];
					$councilName 				=  $value['name'];
					$samajZoneName 			    =  $value['samaj_zone_name'];
					$yuvaMandalName 			=  $value['yuva_mandal_number'];
					$cityName 					=  $value['fk_city_id'];
					$email 						=  $value['email'];
					$aadharCardNumber			=  $value['aadhar_card_number'];
					$gender 					=  $value['gender'];
					$pincode 					=  $value['pincode'];
					$phoneNumber1 				=  $value['phone_number_first'];
					$phoneNumber2 				=  $value['phone_number_second'];
					$otherDocument 				=  $value['other_document_number'];
					//$profilePhoto               =  $value['profile_photo'];
					$dateOfBirth 				=  date('d-m-Y',strtotime($value['date_of_birth']));
					$age 						=  $value['age'];
					$firstNomineeName   		=  $value['first_nominee_name'];
					$firstNomineeMemberId       =  $value['first_nominee_member_id'];
					$firstNomineeRelation       =  $value['first_nominee_relation'];
					$secondNomineeName		    =  $value['second_nominee_name'];
					$secondNomineeMemberId      =  $value['second_nominee_member_id'];
					$secondNomineeRelation      =  $value['second_nominee_relation'];  				 
				}
				$from          =  new DateTime($dateOfBirth);
				$today         =  new DateTime(date('d-m-Y'));
				$findAge       =  $from->diff($today)->y;
				
				if($ysk_id <= '5000' && ($findAge > '55' && $findAge <= '60'))
				{
				    
				    $sahyognidhiNotPosible = "0";
				}
				else if($findAge > '55' && $ysk_id > '5000')
				{
				    $sahyognidhiNotPosible = "1";
				}
				else
				{
				    $sahyognidhiNotPosible = "0";
				}
				
				

				$detailsForFirstNominee  = RegistrationModel::where('member',$firstNomineeMemberId)->first();
				$detailsForSecondNominee = RegistrationModel::where('member',$secondNomineeMemberId)->first();

				$todayDate = date('Y-m-d');
				if ($todayDate > $yskConfirmationDate) {
				 $response = array("success" => 1,"message" => "","familyId" => $familyId,"memberId" => $memberId,"nameAsPerYuvaSanghOrg" => strtoupper($nameAsPerYuvaSanghOrg),"regionName" => $regionName,"councilName" => $councilName,"samajZoneName" => $samajZoneName,"yuvaMandalName" => $yuvaMandalName,"cityName" => $cityName,"email" => $email,"aadharCardNumber" => $aadharCardNumber,"Gender" => $gender,"pincode" => $pincode,"phoneNumber1" => $phoneNumber1,"phoneNumber2" => $phoneNumber2,"existingDiseaseAll" => $existingDiseaseAll,"otherDocument" => $otherDocument,"dateOfBirth" => $dateOfBirth,"age" => $findAge,"firstNomineeName" => $firstNomineeName,"firstNomineeMemberId" => $firstNomineeMemberId,"firstNomineeRelation" => $firstNomineeRelation,"secondNomineeName" => $secondNomineeName,"secondNomineeMemberId" => $secondNomineeMemberId,"secondNomineeRelation" => $secondNomineeRelation,"firstNomineePhoneNumber" => $detailsForFirstNominee['phone_number_first'],"firstNomineeEmail" => $detailsForFirstNominee['email'],"secondNomineePhoneNumber" => $detailsForSecondNominee['phone_number_first'],"secondNomineeEmail" => $detailsForSecondNominee['email'],"sahyognidhiNotPosible" => $sahyognidhiNotPosible);
				}
				else{
					$response = array("success" => 0,"message" => "You are in locking period.","familyId" => $familyId,"memberId" => $memberId,"nameAsPerYuvaSanghOrg" => strtoupper($nameAsPerYuvaSanghOrg),"regionName" => $regionName,"councilName" => $councilName,"samajZoneName" => $samajZoneName,"yuvaMandalName" => $yuvaMandalName,"cityName" => $cityName,"email" => $email,"aadharCardNumber" => $aadharCardNumber,"Gender" => $gender,"pincode" => $pincode,"phoneNumber1" => $phoneNumber1,"phoneNumber2" => $phoneNumber2,"existingDiseaseAll" => $existingDiseaseAll,"otherDocument" => $otherDocument,"dateOfBirth" => $dateOfBirth,"age" => $findAge,"firstNomineeName" => $firstNomineeName,"firstNomineeMemberId" => $firstNomineeMemberId,"firstNomineeRelation" => $firstNomineeRelation,"secondNomineeName" => $secondNomineeName,"secondNomineeMemberId" => $secondNomineeMemberId,"secondNomineeRelation" => $secondNomineeRelation,"firstNomineePhoneNumber" => $detailsForFirstNominee['phone_number_first'],"firstNomineeEmail" => $detailsForFirstNominee['email'],"secondNomineePhoneNumber" => $detailsForSecondNominee['phone_number_first'],"secondNomineeEmail" => $detailsForSecondNominee['email'],"sahyognidhiNotPosible" => $sahyognidhiNotPosible);
				}	

				return json_encode($response);
				exit;   			
	}



	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function saveSahyognidhiRequest(Request $request)
	{    
		$this->validate($request,[
			'sahyognidhi_date'      =>   'required',
			'inform_date'           =>   'required',
			'informer_name'         =>   'required',
			'informer_mobile'       =>   'required',
		]);

		SahyognidhiRequestModel::create([
			'sahyognidhi_request' 	=> 	 Input::get('sahyognidhi_request'),
			'sahyognidhiError1'		=>	 Input::filled('sahyognidhiError') ? Input::get('sahyognidhiError') : '',
			'sahyognidhi_date'      =>   date("Y-m-d",strtotime(Input::get('sahyognidhi_date'))),
			'fk_ysk_id' 			=> 	 Input::get('fk_ysk_id'),
			'family_id'				=>   Input::get('family_id'),
			'name_as_per_yuvasangh_org'       => Input::get('name_as_per_yuvasangh_org'),
			//'name_as_per_ysk_submission_form' => Input::get('name_as_per_ysk_submission_form'),
			'region_name'			=>   Input::get('region_name'),
			'council_name'			=>   Input::filled('council_name') ? Input::get('council_name'):'',
			'samaj_zone_name'		=>   Input::get('samaj_zone_name'),
			'yuva_mandal_name'		=>   Input::get('yuva_mandal_name'),
			'city_name' 			=> 	 Input::filled('city_name') ? Input::get('city_name'):'',
			'email'					=>   Input::filled('email') ? Input::get('email'):'',
			'aadhar_card_number'	=>   Input::get('aadhar_card_number'),
			'date_of_birth'         =>   date("Y-m-d",strtotime(Input::get('date_of_birth'))),
			'first_phone_number'	=>   Input::get('first_phone_number'),
			'second_phone_number'   =>   Input::filled('second_phone_number')?Input::get('second_phone_number'):'',
			'existing_disease'      =>   Input::filled('existing_disease') ? Input::get('existing_disease'):'',
			'other_document_number' =>   Input::filled('other_document_number')?Input::get('other_document_number'):'',
			'age'					=>   Input::get('age'),
			'cause_of_death'		=>   Input::filled('cause_of_death') ? Input::get('cause_of_death') : '',
			'death_description'     =>   Input::filled('death_description') ? Input::get('death_description') : '',
			'death_date'			=>   Input::filled('death_date') ? date('Y-m-d',strtotime(Input::get('death_date'))) : '',
			'disability_date'       =>   Input::filled('disability_date') ? Input::get('disability_date') : '',
			'inform_date' 			=> 	 date("Y-m-d", strtotime(Input::get('inform_date'))),
			'informer_name' 		=> 	 Input::get('informer_name'),
			'informer_mobile'       =>   Input::get('informer_mobile'),
			'designation'			=>   Input::filled('designation')?Input::get('designation'):'',
			'description'			=>   Input::filled('description')?Input::get('description'):'',
			'created_by'            => Auth::user()->user_id,
		]);
		$sahyognidhiData = SahyognidhiRequestModel::where('status','!=','3')->get();
		foreach ($sahyognidhiData as $key => $value) {
			$sahyognidhiId = $value['sahyognidhi_id'];
		}
		SahyognidhiNomineeModel::create([
			'fk_sahyognidhi_id'               =>  $sahyognidhiId,
			'first_nominee_name'              =>  Input::get('first_nominee_name'),
			'hidden_first_nominee_member_id'  =>  Input::get('hidden_first_nominee_member_id'),
			'first_nominee_relation'          =>  Input::filled('first_nominee_relation') ? Input::get('first_nominee_relation'):'',
			'first_nominee_contact_number'    =>  Input::filled('first_nominee_contact_number') ? Input::get('first_nominee_contact_number'):'',
			'first_nominee_email'             =>  Input::filled('first_nominee_email') ? Input::get('first_nominee_email'):'',
			'second_nominee_name'             =>  Input::get('second_nominee_name'),
			'hidden_second_nominee_member_id' =>  Input::get('hidden_second_nominee_member_id'),
			'second_nominee_relation'         =>  Input::filled('second_nominee_relation') ? Input::get('second_nominee_relation'):'',
			'second_nominee_contact_number'   =>  Input::filled('second_nominee_contact_number') ? Input::get('second_nominee_contact_number'):'',
			'second_nominee_email'            =>  Input::filled('second_nominee_email') ? Input::get('second_nominee_email'):'',
			'ask_first_nominee_family_id'     =>  Input::filled('ask_first_nominee_family_id') ? Input::get('ask_first_nominee_family_id') : '',
			'ask_first_nominee_member_id'     =>  Input::filled('ask_first_nominee_member_id') ? Input::get('ask_first_nominee_member_id') : '',
			'ask_first_nominee_name'          =>  Input::filled('ask_first_nominee_name') ? Input::get('ask_first_nominee_name') : '',
			'ask_first_nominee_relation'      =>  Input::filled('ask_first_nominee_relation') ? Input::get('ask_first_nominee_relation') : '',
			'ask_first_nominee_contact_number'=>  Input::filled('ask_first_nominee_contact_number') ? Input::get('ask_first_nominee_contact_number') : '',
			'ask_first_nominee_email'         =>  Input::filled('ask_first_nominee_email') ? Input::get('ask_first_nominee_email') : '',
			'ask_second_nominee_family_id'    =>  Input::filled('ask_second_nominee_family_id') ? Input::get('ask_second_nominee_family_id') : '',
			'ask_second_nominee_member_id'    =>  Input::filled('ask_second_nominee_member_id') ? Input::get('ask_second_nominee_member_id') : '',
			'ask_second_nominee_name'         =>  Input::filled('ask_second_nominee_name') ? Input::get('ask_second_nominee_name') : '',
			'ask_second_nominee_relation'     =>  Input::filled('ask_second_nominee_relation') ? Input::get('ask_second_nominee_relation') : '',
			'ask_second_nominee_contact_number' =>  Input::filled('ask_second_nominee_contact_number') ? Input::get('ask_second_nominee_contact_number') : '',
			'ask_second_nominee_email'        =>  Input::filled('ask_second_nominee_email') ? Input::get('ask_second_nominee_email') : '',
			'created_by'                      => Auth::user()->user_id,
			
		]);
		if($request->hasfile('divangat_upload_image'))
		 {
			foreach($request->file('divangat_upload_image') as $file)
			{
				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension();
				$file->move('assets/uploads/divangat_image/', $name);
				SahyognidhiUploadDocument::create([
					'fk_sahyognidhi_id' => $sahyognidhiId,
					'sahyognidhi_type'  => Input::get('sahyognidhi_request'),
					'upload_document_status' => '1',
					'document_extension' => $extension,
					'upload_document' => $name,
					'created_by'      => Auth::user()->user_id,
				]); 
			}
		 }

		 if($request->hasfile('death_certificate_document'))
		 {
			foreach($request->file('death_certificate_document') as $file)
			{
				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension();
				$file->move('assets/uploads/divangat_image/', $name);
				SahyognidhiUploadDocument::create([
					'fk_sahyognidhi_id' => $sahyognidhiId,
					'sahyognidhi_type'  => Input::get('sahyognidhi_request'),
					'upload_document_status' => '2',
					'document_extension' => $extension,
					'upload_document' => $name,
					'created_by'      => Auth::user()->user_id,
				]); 
			}
		 }   

		 if($request->hasfile('disability_document'))
		 {
			foreach($request->file('disability_document') as $file)
			{
				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension();
				$file->move('assets/uploads/divangat_image/', $name);
				SahyognidhiUploadDocument::create([
					'fk_sahyognidhi_id' => $sahyognidhiId,
					'sahyognidhi_type'  => Input::get('sahyognidhi_request'),
					'upload_document_status' => '3',
					'document_extension' => $extension,
					'upload_document' => $name,
					'created_by'      => Auth::user()->user_id,
				]); 
			}
		 }
		 /*SahyognidhiPaymentModel::create([
			'fk_sahyognidhi_id' => $sahyognidhiId,
		 ]);*/

		return redirect()->route('sahyognidhi-request')->with('success','Sahyognidhi Request details has been completed successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function editSahyognidhiRequest(Request $request)
	{
	    $accessData = $this->getArray('sahyognidhi-request',Auth::user()->fk_role_id);
		$getBankName  =  BankNameModel::where('status','1')->get();

		$editSahyognidhiRequest = SahyognidhiRequestModel::where('sahyognidhi_id',$request->sahyognidhi_id)
								->select('sahyognidhi_requests.*',
									'sahyognidhi_nominee_details.*',
									'registrations.name_as_per_yuva_sangh_org',
									'registrations.family_id',
									'registrations.registration_id'
								)
								->leftJoin('registrations', 'registrations.ysk_id', '=', 'sahyognidhi_requests.fk_ysk_id')
								->leftJoin('death_types','death_types.death_type_id','=','sahyognidhi_requests.cause_of_death')
								->leftJoin('sahyognidhi_nominee_details','sahyognidhi_nominee_details.fk_sahyognidhi_id','=','sahyognidhi_requests.sahyognidhi_id')
								->first();
		$sahyognidhiDocument1   = SahyognidhiUploadDocument::where('fk_sahyognidhi_id',$request->sahyognidhi_id)->where('upload_document_status','1')->get();
		$sahyognidhiDocument2   = SahyognidhiUploadDocument::where('fk_sahyognidhi_id',$request->sahyognidhi_id)->where('upload_document_status','2')->get();
		$sahyognidhiDocument3   = SahyognidhiUploadDocument::where('fk_sahyognidhi_id',$request->sahyognidhi_id)->where('upload_document_status','3')->get();
		//dd($request->sahyognidhi_id);

		/*$lastpayment = RepaymentModel::where('repayments.status','1')
						->select('repayments.*',
							'bank_names.bank_name',
						)
						->leftJoin('registrations','registrations.registration_id','=','repayments.fk_registration_id')
						->leftJoin('bank_names','bank_names.bank_name_id','=','repayments.fk_bank_name')
						->where('repayments.fk_registration_id',$editSahyognidhiRequest['registration_id'])
						->first();*/

		$deathType  = DeathTypeModel::where('status','1')->get();
		$informerName = KaryakartaModel::where('karyakartas.status','!=','3')
						->select('karyakartas.name_as_per_yuva_sangh_org',
							'karyakartas.karyakarta_id',
							'roles.name'
						)
						->leftJoin('roles','roles.role_id','=','karyakartas.fk_role_id')
						->get();

		return view('admin.sahyognidhi_request_edit')->with('editSahyognidhiRequest',$editSahyognidhiRequest)->with('getBankName',$getBankName)->with('deathType',$deathType)->with('sahyognidhiDocument1',$sahyognidhiDocument1)->with('sahyognidhiDocument2',$sahyognidhiDocument2)->with('sahyognidhiDocument3',$sahyognidhiDocument3)->with('accessData',$accessData)->with('informerName',$informerName);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function updateSahyognidhiRequest(Request $request)
	{        
		$this->validate($request,[
			'sahyognidhi_date'      =>   'required',
			'inform_date'           =>   'required',
			'informer_name'         =>   'required',
			'informer_mobile'       =>   'required',
		]);

		SahyognidhiRequestModel::where('sahyognidhi_id',$request->editId)->update(array(
			'cause_of_death'        =>   Input::filled('cause_of_death') ? Input::get('cause_of_death') : '',
			'death_description'     =>   Input::filled('death_description') ? Input::get('death_description') : '',
			'death_date'			=>   Input::filled('death_date') ? date('Y-m-d',strtotime(Input::get('death_date'))) : '',
			'disability_date'       =>   Input::filled('disability_date') ? Input::get('disability_date') : '',
			'inform_date'           =>   date("Y-m-d", strtotime(Input::get('inform_date'))),
			'informer_name'         =>   Input::get('informer_name'),
			'informer_mobile'       =>   Input::get('informer_mobile'),
			'designation'           =>   Input::filled('designation')?Input::get('designation'):'',
			'description'           =>   Input::filled('description')?Input::get('description'):'',
			'updated_by'            => Auth::user()->user_id,
		));
		SahyognidhiNomineeModel::where('fk_sahyognidhi_id',$request->editId)->update(array(
			'ask_first_nominee_family_id'     =>  Input::filled('ask_first_nominee_family_id') ? Input::get('ask_first_nominee_family_id') : '',
			'ask_first_nominee_member_id'     =>  Input::filled('ask_first_nominee_member_id') ? Input::get('ask_first_nominee_member_id') : '',
			'ask_first_nominee_name'          =>  Input::filled('ask_first_nominee_name') ? Input::get('ask_first_nominee_name') : '',
			'ask_first_nominee_relation'      =>  Input::filled('ask_first_nominee_relation') ? Input::get('ask_first_nominee_relation') : '',
			'ask_first_nominee_contact_number'=>  Input::filled('ask_first_nominee_contact_number') ? Input::get('ask_first_nominee_contact_number') : '',
			'ask_first_nominee_email'         =>  Input::filled('ask_first_nominee_email') ? Input::get('ask_first_nominee_email') : '',
			'ask_second_nominee_family_id'    =>  Input::filled('ask_second_nominee_family_id') ? Input::get('ask_second_nominee_family_id') : '',
			'ask_second_nominee_member_id'    =>  Input::filled('ask_second_nominee_member_id') ? Input::get('ask_second_nominee_member_id') : '',
			'ask_second_nominee_name'         =>  Input::filled('ask_second_nominee_name') ? Input::get('ask_second_nominee_name') : '',
			'ask_second_nominee_relation'     =>  Input::filled('ask_second_nominee_relation') ? Input::get('ask_second_nominee_relation') : '',
			'ask_second_nominee_contact_number' =>  Input::filled('ask_second_nominee_contact_number') ? Input::get('ask_second_nominee_contact_number') : '',
			'ask_second_nominee_email'        =>  Input::filled('ask_second_nominee_email') ? Input::get('ask_second_nominee_email') : '',
			'updated_by'                      => Auth::user()->user_id,
		));
		if($request->hasfile('divangat_upload_image'))
		 {
			foreach($request->file('divangat_upload_image') as $file)
			{
				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension();
				$file->move('assets/uploads/divangat_image/', $name);
				SahyognidhiUploadDocument::create([
					'fk_sahyognidhi_id' => $request->editId,
					'sahyognidhi_type'  => Input::get('sahyognidhi_request'),
					'upload_document_status' => '1',
					'document_extension' => $extension,
					'upload_document' => $name,
					'updated_by'      => Auth::user()->user_id,
				]); 
			}
		 }
		
		 if($request->hasfile('death_certificate_document'))
		 {
			foreach($request->file('death_certificate_document') as $file)
			{
				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension();
				$file->move('assets/uploads/divangat_image/', $name);
				SahyognidhiUploadDocument::create([
					'fk_sahyognidhi_id' => $request->editId,
					'sahyognidhi_type'  => Input::get('sahyognidhi_request'),
					'upload_document_status' => '2',
					'document_extension' => $extension,
					'upload_document' => $name,
					'updated_by'      => Auth::user()->user_id,
				]); 
			}
		 }

		 if($request->hasfile('disability_document'))
		 {
			foreach($request->file('disability_document') as $file)
			{
				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension();
				$file->move('assets/uploads/divangat_image/', $name);
				SahyognidhiUploadDocument::create([
					'fk_sahyognidhi_id' => $request->editId,
					'sahyognidhi_type'  => Input::get('sahyognidhi_request'),
					'upload_document_status' => '3',
					'document_extension' => $extension,
					'upload_document' => $name,
					'updated_by'      => Auth::user()->user_id,
				]); 
			}
		 }

		return redirect()->route('sahyognidhi-request')->with('success','Sahyognidhi Request details has been updated successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function deleteImage(Request $request)
	{
		SahyognidhiUploadDocument::where('sahyognidhi_upload_document_id',$request->id)->delete();
		$responseData = array("success" => "1");
		echo json_encode($responseData);
		exit;
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function deleteSahyognidhiRequest(Request $request)
	{
		SahyognidhiRequestModel::where('sahyognidhi_id',$request->sahyognidhi_id)->update(array('status' => '3'));
		SahyognidhiPaymentModel::where('fk_sahyognidhi_id',$request->sahyognidhi_id)->update(array('status' => '3'));
		SahyognidhiNomineeModel::where('fk_sahyognidhi_id',$request->sahyognidhi_id)->update(array('status' => '3'));        
		SahyognidhiUploadDocument::where('fk_sahyognidhi_id',$request->sahyognidhi_id)->delete();        
		return redirect()->route('sahyognidhi-request')->with('success','Sahyognidhi Request details has been deleted successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function multipleDeleteSahyognidhiRequest(Request $request)
	{
		SahyognidhiRequestModel::whereIn('sahyognidhi_id',explode(",",$request->ids))->update(array('status' => '3'));
		SahyognidhiPaymentModel::whereIn('fk_sahyognidhi_id',explode(",", $request->ids))->update(array('status' => '3'));
		SahyognidhiNomineeModel::whereIn('fk_sahyognidhi_id',explode(",", $request->ids))->update(array('status' => '3'));
		SahyognidhiUploadDocument::whereIn('fk_sahyognidhi_id',explode(",", $request->ids))->delete();
		Session::flash('success', 'Sahyognidhi Request deatils has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Sahyognidhi Request deatils has been deleted successfully."]);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function getNomineeYskId()
	{
		$yskId = RegistrationModel::where('member',Input::get('nominee_name'))->first();
		$responseData = array("success" => "1","pre_ysk_id" => $yskId['pre_ysk_id'],"ysk_id" => $yskId['ysk_id'],"name" => $yskId['hidden_name_as_per_yuva_sangh_org']);
		echo json_encode($responseData);
		exit;
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function sahyognidhiPaymentDetails(Request $request)
	{
	    $accessData = $this->getArray('sahyognidhi-request',Auth::user()->fk_role_id);
		$bankName = LedgerAccountModel::where('fk_group_id','14')->get();
		$nomineeName = SahyognidhiNomineeModel::where('fk_sahyognidhi_id',$request->sahyognidhi_id)->get();
		$sahyognidhiPaymentDetails = SahyognidhiPaymentModel::where('payment_status','!=','4')->where('fk_sahyognidhi_id',$request->sahyognidhi_id)
								->select('sahyognidhi_payments.*',
									'ledger_accounts.legder_name'
								)
								->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','sahyognidhi_payments.fk_bank_id')
								->get();
		$sahyognidhiPaymentDetails1 = SahyognidhiPaymentModel::where('fk_sahyognidhi_id',$request->sahyognidhi_id)->first();
								//dd($sahyognidhiPaymentDetails1['close_reason']);
		return view('admin.sahyognidhi_request_payment_details')->with('bankName',$bankName)->with('nomineeName',$nomineeName)->with('sahyognidhiPaymentDetails',$sahyognidhiPaymentDetails)->with('sahyognidhiPaymentDetails1',$sahyognidhiPaymentDetails1)->with('accessData',$accessData);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function saveSahyognidhiPayment(Request $request)
	{
		$this->validate($request,[
			'nominee_member_id'         => 'required',
		    //'payment_give_nominee_name' => 'required',
			//'nominee_ysk_id'            => 'required',
			'sahyognidhi_payment_date'  => 'required',
			'sahyognidhi_amount'        => 'required',
			'fk_bank_id'                => 'required',
		]);

		$sahyognidhiRequest = SahyognidhiRequestModel::where('sahyognidhi_id',$request->editId)->first(); 
		$sahyognidhiUpload = SahyognidhiUploadDocument::where('fk_sahyognidhi_id',$request->editId)->where('upload_document_status','2')->first(); 

		$sahyognidhiDisiabilityUpload = SahyognidhiUploadDocument::where('fk_sahyognidhi_id',$request->editId)->where('upload_document_status','3')->first(); 
		
		$getYskId = RegistrationModel::where('ysk_id',$sahyognidhiRequest['fk_ysk_id'])->orWhere('pre_ysk_id',$sahyognidhiRequest['fk_ysk_id'])->first();

		$sahyognidhiAmount = SahyognidhiAmountModel::where('status','1')->where('start_date','<=',date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))))->where('end_date','>=',date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))))->first();
		 if($sahyognidhiAmount != ''){
		    $getAmount = $sahyognidhiAmount['divangate_amount'];
		 }
		 else{
		    $sahyognidhiAmount = SahyognidhiAmountModel::where('status','1')->where('end_date','0000-00-00')->first();
		    $getAmount = $sahyognidhiAmount['divangate_amount'];
		 }
		
		//dd($getAmount/2);
			if ($sahyognidhiRequest['for_devangat'] == '2') {
				$totalAmount = $getAmount/2;
			}
			elseif ($sahyognidhiRequest['sahyognidhi_request'] == 'Full Disability') {
				$totalAmount = $getAmount;
			}
			elseif ($sahyognidhiRequest['sahyognidhi_request'] == 'Half Disability') {
				$totalAmount = $getAmount/2;
			}
			elseif ($sahyognidhiRequest['sahyognidhi_request'] == 'Devantage') {
				$totalAmount = $getAmount;
			}
			
			else{
				$totalAmount = '0';
			}

			if ($sahyognidhiRequest['for_devangat'] == '2') {
				$a = SahyognidhiPaymentModel::where('fk_sahyognidhi_id',$request->editId)->where('after_half_disiability','2')->get();
				$amount = 0;
				foreach ($a as $key => $value) {
					$givenSahyognidhiAmount[] = $value['sahyognidhi_amount'];
					$amount = array_sum($givenSahyognidhiAmount);
				}
				$actualAmount = $totalAmount - $amount;
				if (count($a) > 0) {
					if ($totalAmount == $amount) {
						return redirect()->route('sahyognidhi-request')->with('error','All amount is given.');
					}

					if ($sahyognidhiRequest['sahyognidhi_request'] == 'Devantage') {
						if ($actualAmount >= Input::get('sahyognidhi_amount') && $sahyognidhiUpload['upload_document'] != '') {
							$b = $actualAmount - Input::get('sahyognidhi_amount');
							if ($b == '0.0') {
								SahyognidhiPaymentModel::create([
									'fk_sahyognidhi_id'         => $request->editId,    
									'nominee_member_id'         => Input::get('nominee_member_id'),
									'payment_give_nominee_name' => Input::filled('payment_give_nominee_name') ? Input::get('payment_give_nominee_name'):'',
									'nominee_ysk_id'            => Input::filled('nominee_ysk_id') ? Input::get('nominee_ysk_id'):'',
									'sahyognidhi_payment_date'  => date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))),
									'sahyognidhi_amount'        => Input::get('sahyognidhi_amount'),
									'fk_bank_id'                => Input::get('fk_bank_id'),
									'after_half_disiability'	=> '2',
									//'payment_status'            => '2',
									//'status'                    => '1',
									'created_by'     			=> Auth::user()->user_id,
								]);

								SahyognidhiRequestModel::where('sahyognidhi_id',$request->editId)->update(array(
									'status' => '1',
									'updated_by'     => Auth::user()->user_id,
								));
								SahyognidhiPaymentModel::where('fk_sahyognidhi_id',$request->editId)->update(array(
									'status' => '1',
									'payment_status' => '2',
									'updated_by'     => Auth::user()->user_id,
								));
							}
							else{
								SahyognidhiPaymentModel::create([
									'fk_sahyognidhi_id'         => $request->editId,    
									'nominee_member_id'         => Input::get('nominee_member_id'),
									'payment_give_nominee_name' => Input::filled('payment_give_nominee_name') ? Input::get('payment_give_nominee_name'):'',
									'nominee_ysk_id'            => Input::filled('nominee_ysk_id') ? Input::get('nominee_ysk_id'):'',
									'sahyognidhi_payment_date'  => date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))),
									'sahyognidhi_amount'        => Input::get('sahyognidhi_amount'),
									'fk_bank_id'                => Input::get('fk_bank_id'),
									'after_half_disiability'    => '2',
									//'payment_status'            => '2',
									//'status'                    => '1',
									'created_by'     			=> Auth::user()->user_id,
								]);
							}
							return redirect()->route('sahyognidhi-request')->with('success','Sahyognidhi Payment details has been added successfully');
						}
						else{
							return redirect()->route('sahyognidhi-request')->with('error','For further payment Death Certificate is mandatory or give amount less.'.$actualAmount);
						}

					}

					if ($sahyognidhiRequest['sahyognidhi_request'] == 'Full Disability') {
						if ($actualAmount >= Input::get('sahyognidhi_amount') && $sahyognidhiDisiabilityUpload['upload_document'] != '') {
							$b = $actualAmount - Input::get('sahyognidhi_amount');
							if ($b == '0.0') {
								SahyognidhiPaymentModel::create([
									'fk_sahyognidhi_id'         => $request->editId,    
									'nominee_member_id'         => Input::get('nominee_member_id'),
									'payment_give_nominee_name' => Input::filled('payment_give_nominee_name') ? Input::get('payment_give_nominee_name'):'',
									'nominee_ysk_id'            => Input::filled('nominee_ysk_id') ? Input::get('nominee_ysk_id'):'',
									'sahyognidhi_payment_date'  => date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))),
									'sahyognidhi_amount'        => Input::get('sahyognidhi_amount'),
									'fk_bank_id'                => Input::get('fk_bank_id'),
									'after_half_disiability'    => '2',
								    //'payment_status'			=> '1',
									'created_by'     			=> Auth::user()->user_id,
								]);
								SahyognidhiRequestModel::where('sahyognidhi_id',$request->editId)->update(array(
									'status' => '1',
									'updated_by'     => Auth::user()->user_id,
								));
								SahyognidhiPaymentModel::where('fk_sahyognidhi_id',$request->editId)->update(array(
									'status' => '1',
									'payment_status' => '2',
									'updated_by'     => Auth::user()->user_id,
								));
							}
							else{
								SahyognidhiPaymentModel::create([
									'fk_sahyognidhi_id'         => $request->editId,    
									'nominee_member_id'         => Input::get('nominee_member_id'),
									'payment_give_nominee_name' => Input::filled('payment_give_nominee_name') ? Input::get('payment_give_nominee_name'):'',
									'nominee_ysk_id'            => Input::filled('nominee_ysk_id') ? Input::get('nominee_ysk_id'):'',
									'sahyognidhi_payment_date'  => date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))),
									'sahyognidhi_amount'        => Input::get('sahyognidhi_amount'),
									'fk_bank_id'                => Input::get('fk_bank_id'),
									'after_half_disiability'	=> '2',
									//'payment_status'			=> '1',
									'created_by'     			=> Auth::user()->user_id,
								]);
							}

							return redirect()->route('sahyognidhi-request')->with('success','Sahyognidhi Payment details has been added successfully');
						}
						else{
							return redirect()->route('sahyognidhi-request')->with('error','For further payment Disiability Document is mandatory or You can make payment upto Rs.'.$actualAmount);
						}
					}
				}
				else{
					if ($actualAmount > Input::get('sahyognidhi_amount')) {
						SahyognidhiPaymentModel::create([
							'fk_sahyognidhi_id'         => $request->editId,    
							'nominee_member_id'         => Input::get('nominee_member_id'),
							'payment_give_nominee_name' => Input::filled('payment_give_nominee_name') ? Input::get('payment_give_nominee_name'):'',
							'nominee_ysk_id'            => Input::filled('nominee_ysk_id') ? Input::get('nominee_ysk_id'):'',
							'sahyognidhi_payment_date'  => date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))),
							'sahyognidhi_amount'        => Input::get('sahyognidhi_amount'),
							'fk_bank_id'                => Input::get('fk_bank_id'),
							'payment_status'			=> '1',
							'after_half_disiability'	=> '2',
							'created_by'     			=> Auth::user()->user_id,
						]);
						return redirect()->route('sahyognidhi-request')->with('success','Sahyognidhi Payment details has been added successfully');
					}
					else{
						return redirect()->route('sahyognidhi-request')->with('error','You can make payment less Rs.'.$actualAmount);
					}
				}
				
			}
			else{
				$a = SahyognidhiPaymentModel::where('payment_status','!=','4')->where('fk_sahyognidhi_id',$request->editId)->get();
				$amount = 0;
				foreach ($a as $key => $value) {
					$givenSahyognidhiAmount[] = $value['sahyognidhi_amount'];
					$amount = array_sum($givenSahyognidhiAmount);
				}
				$actualAmount = $totalAmount - $amount;
				//dd($amount);
				if (count($a) > 0) {
					if ($totalAmount == $amount) {
						return redirect()->route('sahyognidhi-request')->with('error','All amount is given.');
					}

					if ($sahyognidhiRequest['sahyognidhi_request'] == 'Devantage') {
						if ($actualAmount >= Input::get('sahyognidhi_amount') && $sahyognidhiUpload['upload_document'] != '') {
							$b = $actualAmount - Input::get('sahyognidhi_amount');
							if ($b == '0.0') {
								SahyognidhiPaymentModel::create([
									'fk_sahyognidhi_id'         => $request->editId,    
									'nominee_member_id'         => Input::get('nominee_member_id'),
									'payment_give_nominee_name' => Input::filled('payment_give_nominee_name') ? Input::get('payment_give_nominee_name'):'',
									'nominee_ysk_id'            => Input::filled('nominee_ysk_id') ? Input::get('nominee_ysk_id'):'',
									'sahyognidhi_payment_date'  => date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))),
									'sahyognidhi_amount'        => Input::get('sahyognidhi_amount'),
									'fk_bank_id'                => Input::get('fk_bank_id'),
									//'payment_status'            => '2',
									//'status'                    => '1',
									'created_by'     			=> Auth::user()->user_id,
								]);

								SahyognidhiRequestModel::where('sahyognidhi_id',$request->editId)->update(array(
									'status' => '1',
									'updated_by'     => Auth::user()->user_id,
								));
								SahyognidhiPaymentModel::where('payment_status','!=','4')->where('fk_sahyognidhi_id',$request->editId)->update(array(
									'status' => '1',
									'payment_status' => '2',
									'updated_by'     => Auth::user()->user_id,
								));
							}
							else{
								SahyognidhiPaymentModel::create([
									'fk_sahyognidhi_id'         => $request->editId,    
									'nominee_member_id'         => Input::get('nominee_member_id'),
									'payment_give_nominee_name' => Input::filled('payment_give_nominee_name') ? Input::get('payment_give_nominee_name'):'',
									'nominee_ysk_id'            => Input::filled('nominee_ysk_id') ? Input::get('nominee_ysk_id'):'',
									'sahyognidhi_payment_date'  => date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))),
									'sahyognidhi_amount'        => Input::get('sahyognidhi_amount'),
									'fk_bank_id'                => Input::get('fk_bank_id'),
									//'payment_status'            => '2',
									//'status'                    => '1',
									'created_by'     			=> Auth::user()->user_id,
								]);
							}
							return redirect()->route('sahyognidhi-request')->with('success','Sahyognidhi Payment details has been added successfully');
						}
						else{
							return redirect()->route('sahyognidhi-request')->with('error','For further payment Death Certificate is mandatory or give amount upto.'.$actualAmount);
						}


					}

					if ($sahyognidhiRequest['sahyognidhi_request'] == 'Full Disability') {
						if ($actualAmount >= Input::get('sahyognidhi_amount') && $sahyognidhiDisiabilityUpload['upload_document'] != '') {
							$b = $actualAmount - Input::get('sahyognidhi_amount');
							if ($b == '0.0') {
								SahyognidhiPaymentModel::create([
									'fk_sahyognidhi_id'         => $request->editId,    
									'nominee_member_id'         => Input::get('nominee_member_id'),
									'payment_give_nominee_name' => Input::filled('payment_give_nominee_name') ? Input::get('payment_give_nominee_name'):'',
									'nominee_ysk_id'            => Input::filled('nominee_ysk_id') ? Input::get('nominee_ysk_id'):'',
									'sahyognidhi_payment_date'  => date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))),
									'sahyognidhi_amount'        => Input::get('sahyognidhi_amount'),
									'fk_bank_id'                => Input::get('fk_bank_id'),
									//'payment_status'			=> '1',
									'created_by'     			=> Auth::user()->user_id,
								]);
								SahyognidhiRequestModel::where('sahyognidhi_id',$request->editId)->update(array(
									'status' => '1',
									'updated_by'     => Auth::user()->user_id,
								));
								SahyognidhiPaymentModel::where('payment_status','!=','4')->where('fk_sahyognidhi_id',$request->editId)->update(array(
									'status' => '1',
									'payment_status' => '2',
									'updated_by'     => Auth::user()->user_id,
								));
							}
							else{
								SahyognidhiPaymentModel::create([
									'fk_sahyognidhi_id'         => $request->editId,    
									'nominee_member_id'         => Input::get('nominee_member_id'),
									'payment_give_nominee_name' => Input::filled('payment_give_nominee_name') ? Input::get('payment_give_nominee_name'):'',
									'nominee_ysk_id'            => Input::filled('nominee_ysk_id') ? Input::get('nominee_ysk_id'):'',
									'sahyognidhi_payment_date'  => date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))),
									'sahyognidhi_amount'        => Input::get('sahyognidhi_amount'),
									'fk_bank_id'                => Input::get('fk_bank_id'),
									//'payment_status'			=> '1',
									'created_by'     			=> Auth::user()->user_id,
								]);
							}

							return redirect()->route('sahyognidhi-request')->with('success','Sahyognidhi Payment details has been added successfully');
						}
						else{
							return redirect()->route('sahyognidhi-request')->with('error','For further payment Disiability Document is mandatory or You can make payment upto Rs.'.$actualAmount);
						}
					}

					if ($sahyognidhiRequest['sahyognidhi_request'] == 'Half Disability') {
						if ($actualAmount >= Input::get('sahyognidhi_amount') && $sahyognidhiDisiabilityUpload['upload_document'] != '') {
							$b = $actualAmount - Input::get('sahyognidhi_amount');
							if ($b == '0.0') {
								SahyognidhiPaymentModel::create([
									'fk_sahyognidhi_id'         => $request->editId,    
									'nominee_member_id'         => Input::get('nominee_member_id'),
									'payment_give_nominee_name' => Input::filled('payment_give_nominee_name') ? Input::get('payment_give_nominee_name'):'',
									'nominee_ysk_id'            => Input::filled('nominee_ysk_id') ? Input::get('nominee_ysk_id'):'',
									'sahyognidhi_payment_date'  => date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))),
									'sahyognidhi_amount'        => Input::get('sahyognidhi_amount'),
									'fk_bank_id'                => Input::get('fk_bank_id'),
									//'payment_status'			=> '1',
									'created_by'     			=> Auth::user()->user_id,
								]);
								SahyognidhiRequestModel::where('sahyognidhi_id',$request->editId)->update(array(
									'status' => '1',
									'updated_by'     => Auth::user()->user_id,
								));
								SahyognidhiPaymentModel::where('payment_status','!=','4')->where('fk_sahyognidhi_id',$request->editId)->update(array(
									'status' => '1',
									'payment_status' => '2',
									'updated_by'     => Auth::user()->user_id,
								));
							}
							else{
								SahyognidhiPaymentModel::create([
									'fk_sahyognidhi_id'         => $request->editId,    
									'nominee_member_id'         => Input::get('nominee_member_id'),
									'payment_give_nominee_name' => Input::filled('payment_give_nominee_name') ? Input::get('payment_give_nominee_name'):'',
									'nominee_ysk_id'            => Input::filled('nominee_ysk_id') ? Input::get('nominee_ysk_id'):'',
									'sahyognidhi_payment_date'  => date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))),
									'sahyognidhi_amount'        => Input::get('sahyognidhi_amount'),
									'fk_bank_id'                => Input::get('fk_bank_id'),
									//'payment_status'			=> '1',
									'created_by'     			=> Auth::user()->user_id,
								]);
							}

							return redirect()->route('sahyognidhi-request')->with('success','Sahyognidhi Payment details has been added successfully');
						}
						else{
							return redirect()->route('sahyognidhi-request')->with('error','For further payment Disiability Document is mandatory or You can make payment upto Rs.'.$actualAmount);
						}

					}           

				}
				else{
					if ($actualAmount > Input::get('sahyognidhi_amount')) {
						SahyognidhiPaymentModel::create([
							'fk_sahyognidhi_id'         => $request->editId,    
							'nominee_member_id'         => Input::get('nominee_member_id'),
							'payment_give_nominee_name' => Input::filled('payment_give_nominee_name') ? Input::get('payment_give_nominee_name'):'',
							'nominee_ysk_id'            => Input::filled('nominee_ysk_id') ? Input::get('nominee_ysk_id'):'',
							'sahyognidhi_payment_date'  => date('Y-m-d',strtotime(Input::get('sahyognidhi_payment_date'))),
							'sahyognidhi_amount'        => Input::get('sahyognidhi_amount'),
							'fk_bank_id'                => Input::get('fk_bank_id'),
							'payment_status'			=> '1',
							'created_by'     			=> Auth::user()->user_id,
						]);
						return redirect()->route('sahyognidhi-request')->with('success','Sahyognidhi Payment details has been added successfully');
					}
					else{
						return redirect()->route('sahyognidhi-request')->with('error','You can make payment less Rs.'.$actualAmount);
					}
				}
			}
								
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function getDataBySahyognidhi()
	{
	   $getDataBySahyognidhiId = SahyognidhiRequestModel::where('status','1')->where('sahyognidhi_id',Input::get('sahyognidhi_payment_id'))->first()->toArray();

		$getAmount = SahyognidhiAmountModel::where('status','1')->get();
		foreach ($getAmount as $key => $value) {
			$getFullDiasabilityAmount = $value['full_disability_amount'];
			$getHalfDiasabilityAmount = $value['half_disability_amount'];
			$getDivangateAmount       = $value['divangate_amount'];
		}

		if ($getDataBySahyognidhiId['sahyognidhi_request'] == 'Full Disability') {
			$totalAmount = $getFullDiasabilityAmount;
		}
		elseif ($getDataBySahyognidhiId['sahyognidhi_request'] == 'Half Disability') {
			$totalAmount = $getHalfDiasabilityAmount;
		}
		elseif ($getDataBySahyognidhiId['sahyognidhi_request'] == 'Devantage') {
			$totalAmount = $getDivangateAmount;
		}
		else{
			$totalAmount = '0';
		}

		$getPayment = SahyognidhiPaymentModel::where('status','1')->where('fk_sahyognidhi_id',Input::get('sahyognidhi_payment_id'))->get()->toArray();

	   if ($getPayment != []) {

		foreach ($getPayment as $key => $value) {
			$giveMoney[] = $value['total_amount'];
		}
		if (array_sum($giveMoney) == $totalAmount) {
			$htmlData = '';
		}
		else{
			$htmlData = '';
			$htmlData ='<select class="form-control kt-select2" id="kt_select2_3_validate" name="param" style="width: 100%">
			<option value="" selected disabled>Select a Nominee</option>';
			if(is_array($getDataBySahyognidhiId) && count($getDataBySahyognidhiId) > 0){
			   $htmlData .='<option value="'.$getDataBySahyognidhiId['first_nominee_name'].'">'.$getDataBySahyognidhiId['first_nominee_name'].'</option>';
			   $htmlData .='<option value="'.$getDataBySahyognidhiId['second_nominee_name'].'">'.$getDataBySahyognidhiId['second_nominee_name'].'</option>';
		   }
			$htmlData .= '</select>';
		}

	   }        
		else{
			$htmlData = '';
			$htmlData ='<select class="form-control kt-select2" id="kt_select2_3_validate" name="param" style="width: 100%">
			<option value="" selected disabled>Select a Nominee</option>';
			if(is_array($getDataBySahyognidhiId) && count($getDataBySahyognidhiId) > 0){
			   $htmlData .='<option value="'.$getDataBySahyognidhiId['first_nominee_name'].'">'.$getDataBySahyognidhiId['first_nominee_name'].'</option>';
			   $htmlData .='<option value="'.$getDataBySahyognidhiId['second_nominee_name'].'">'.$getDataBySahyognidhiId['second_nominee_name'].'</option>';
			}
			$htmlData .= '</select>';
		}
	   
		$responseData = array("success" => "1","html_data" => $htmlData);
		echo json_encode($responseData);
		exit;
	   
	}

	public function getNomineeRelation()
	{
		$getFirstNomineerelation = SahyognidhiRequestModel::where('status','1')->where('first_nominee_name',Input::get('nominee_name'))->first();

		$getSecondNomineerelation = SahyognidhiRequestModel::where('status','1')->where('second_nominee_name',Input::get('nominee_name'))->first();

		if ($getFirstNomineerelation != '') {
			$nomineeRelation = $getFirstNomineerelation['first_nominee_relation'];
		}
		else{
			$nomineeRelation = $getSecondNomineerelation['second_nominee_relation']; 
		}
		 $responseData = array("success" => "1","NomineeRelation" => $nomineeRelation);
		echo json_encode($responseData);
		exit;
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function dataByFirstNomineeFamilyId()
	{
		if(Input::get('ask_first_nominee_family_id'))
		{
			$FamilyID = Input::get('ask_first_nominee_family_id');
			$APIURL   = 'https://www.yuvasangh.org/checklogin.aspx?UserID=yuva&Password=yuva&FamilyID='.$FamilyID;

			$curl     = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL            => $APIURL,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING       => "",
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 30,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => "GET"
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			$htmlData = "";
			$jsonData = "";
			if ($err) {
				$response1 = array("success" => 0,"message" => $err,"html_data" => $htmlData,"data" => $jsonData);
			}
			else {
				$jsonData  = json_decode($response, true);
				if ($jsonData == 0) {
					$response1 = array("success" =>0,"message" => "Please Enter Correct Family Id","html_data" => $htmlData,"data" => $jsonData);
				}
				else{
					
					$htmlData .='<option value="" selected="selected" disabled>Select Nominee</option>';
					foreach ($jsonData["DATA"] as $key => $value) {
						$htmlData .='<option value="'.$value["MemberID"].'">'.$value["Name"].'</option>';
					}
					$response1 = array("success" => 1,"message" => "","html_data" => $htmlData,"data" => $jsonData);
				}
			}
			return json_encode($response1);exit;
		}
	}


	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function dataBySecondNomineeFamilyId()
	{
		if(Input::get('ask_second_nominee_family_id'))
		{
			$FamilyID = Input::get('ask_second_nominee_family_id');
			$APIURL   = 'https://www.yuvasangh.org/checklogin.aspx?UserID=yuva&Password=yuva&FamilyID='.$FamilyID;

			$curl     = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL            => $APIURL,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING       => "",
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 30,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => "GET"
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			$htmlData = "";
			$jsonData = "";
			if ($err) {
				$response1 = array("success" => 0,"message" => $err,"html_data" => $htmlData,"data" => $jsonData);
			}
			else {
				$jsonData  = json_decode($response, true);
				if ($jsonData == 0) {
					$response1 = array("success" =>0,"message" => "Please Enter Correct Family Id","html_data" => $htmlData,"data" => $jsonData);
				}
				else{
					
					$htmlData .='<option value="" selected="selected" disabled>Select Nominee</option>';
					foreach ($jsonData["DATA"] as $key => $value) {
						$htmlData .='<option value="'.$value["MemberID"].'">'.$value["Name"].'</option>';
					}
					$response1 = array("success" => 1,"message" => "","html_data" => $htmlData,"data" => $jsonData);
				}
			}
			return json_encode($response1);exit;
		}
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function getFirstNomineeDataByFamilyId()
	{
		$FamilyID = Input::get('ask_first_nominee_family_id');
			$APIURL = 'https://www.yuvasangh.org/checklogin.aspx?UserID=yuva&Password=yuva&FamilyID='.$FamilyID;

			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL            => $APIURL,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING       => "",
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 30,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => "GET"
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			$htmlData   = "";
			$jsonData   = "";
			$Name       = "";
			if ($err) {
				$response1 = array("success" => 0,"message" => $err,"html_data" => $htmlData,"data" => $jsonData);
			}
			else {
				$jsonData = json_decode($response, true);
				if ($jsonData == 0) {
					$response1 = array("success" => 0,"message" => "Please enter correct family id","html_data" => $htmlData,"data" => $jsonData);
				}
				else{
					
					foreach ($jsonData["DATA"] as $key => $value) {
						if ($value["MemberID"] == Input::get('ask_first_nominee_member_id')) {
							$Name      = $value["Name"];                            
						}
					}
					$MemberID          = Input::get('member_id');                          
					$firstNomineeId    = Input::get('ask_first_nominee_member_id');
					$response1 = array("success" => 1,"message" => "","Name" => $Name,"MemberID" => $MemberID,"firstNomineeId" => $firstNomineeId,"data" => $jsonData);
				}
			}
		return json_encode($response1);exit;
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function getSecondNomineeDataByFamilyId()
	{
		$FamilyID = Input::get('ask_second_nominee_family_id');
			$APIURL = 'https://www.yuvasangh.org/checklogin.aspx?UserID=yuva&Password=yuva&FamilyID='.$FamilyID;

			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL            => $APIURL,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING       => "",
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 30,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => "GET"
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			$htmlData   = "";
			$jsonData   = "";
			$Name       = "";
			if ($err) {
				$response1 = array("success" => 0,"message" => $err,"html_data" => $htmlData,"data" => $jsonData);
			}
			else {
				$jsonData = json_decode($response, true);
				if ($jsonData == 0) {
					$response1 = array("success" => 0,"message" => "Please enter correct family id","html_data" => $htmlData,"data" => $jsonData);
				}
				else{
					
					foreach ($jsonData["DATA"] as $key => $value) {
						if ($value["MemberID"] == Input::get('ask_second_nominee_member_id')) {
							$Name      = $value["Name"];                            
						}
					}
					$MemberID          = Input::get('member_id');                          
					$firstNomineeId    = Input::get('ask_second_nominee_member_id');
					$response1 = array("success" => 1,"message" => "","Name" => $Name,"MemberID" => $MemberID,"firstNomineeId" => $firstNomineeId,"data" => $jsonData);
				}
			}
		return json_encode($response1);exit;
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function viewSahyognidhiRequest(Request $request)
	{
	    $accessData = $this->getArray('sahyognidhi-request',Auth::user()->fk_role_id);
		$viewSahyognidhiRequest = SahyognidhiRequestModel::where('sahyognidhi_requests.sahyognidhi_id',$request->sahyognidhi_id)
								->select('sahyognidhi_requests.*',
									'death_types.title'
								)
								->leftJoin('death_types','death_types.death_type_id','=','sahyognidhi_requests.cause_of_death')
								->first();
		$dieaseData =   DiseaseModel::whereIn('disease_id', explode(',', $viewSahyognidhiRequest['existing_disease']))->get()->toArray();
			if ($dieaseData == []) {
				$diseaseName = '';
			}
			else{
				for ($i=0; $i <count($dieaseData) ; $i++) { 
					$diseaseName1[] = $dieaseData[$i]['disease_name'];
					$diseaseName = implode(',', $diseaseName1);
				}
			}      
		$getAmount = SahyognidhiAmountModel::where('status','1')->get();

		foreach ($getAmount as $key => $value) {
			$getFullDiasabilityAmount = $value['full_disability_amount'];
			$getHalfDiasabilityAmount = $value['half_disability_amount'];
		}

		if ($viewSahyognidhiRequest['sahyognidhi_request'] == 'Full Disability') {
			$totalAmount = $getFullDiasabilityAmount;
		}
		elseif ($viewSahyognidhiRequest['sahyognidhi_request'] == 'Half Disability') {
			$totalAmount = $getHalfDiasabilityAmount;
		}
		elseif ($viewSahyognidhiRequest['sahyognidhi_request'] == 'Devantage') {
			$totalAmount = $getFullDiasabilityAmount;
		}
		else{
			$totalAmount = '0';
		}

		$nomineeDetails = SahyognidhiPaymentModel::where('status','1')->where('fk_sahyognidhi_id',$request->sahyognidhi_id)->get()->toArray();

		$getMedicalDocument  = SahyognidhiUploadDocument::where('fk_sahyognidhi_id',$request->sahyognidhi_id)->where('upload_document_status','1')->get()->toArray();
		$getDeathCertificate = SahyognidhiUploadDocument::where('fk_sahyognidhi_id',$request->sahyognidhi_id)->where('upload_document_status','2')->get()->toArray();
		$getDisiabilityDocument = SahyognidhiUploadDocument::where('fk_sahyognidhi_id',$request->sahyognidhi_id)->where('upload_document_status','3')->get()->toArray();
		$sahyognidhiNominee = SahyognidhiNomineeModel::where('fk_sahyognidhi_id',$request->sahyognidhi_id)->where('status','!=','3')->first();
		return view('admin.sahyognidhi_request_view')->with('viewSahyognidhiRequest',$viewSahyognidhiRequest)->with('totalAmount',$totalAmount)->with('nomineeDetails',$nomineeDetails)->with('diseaseName',$diseaseName)->with('getMedicalDocument',$getMedicalDocument)->with('getDeathCertificate',$getDeathCertificate)->with('getDisiabilityDocument',$getDisiabilityDocument)->with('sahyognidhiNominee',$sahyognidhiNominee)->with('accessData',$accessData);
	}

	public function closeAccount(Request $request)
	{
		$isData = SahyognidhiPaymentModel::where('fk_sahyognidhi_id',$request->id)->first();
		if ($isData == '' && $request->status_selection == 'Deactive') {
			SahyognidhiPaymentModel::create([
				'fk_sahyognidhi_id' => $request->id,
				'close_reason'      => Input::get('close_reason'),
				'reason_selection'  => Input::get('reason_selection'),
				'payment_status'    => '3',
				'status'            => '4',
				'created_by'     	=> Auth::user()->user_id,
			]);
			SahyognidhiNomineeModel::where('fk_sahyognidhi_id',$request->id)->update(array(
				'status' => '1',
				'updated_by'     => Auth::user()->user_id,
			));
			SahyognidhiRequestModel::where('sahyognidhi_id',$request->id)->update(array(
				'sahyognidhiError1' => Input::get('reason_selection'),
				'status' => '4',
				'updated_by'     => Auth::user()->user_id,
			));		
			Session::flash('success', 'Account has been closed successfully.');
			$response = array('success'=>"1",'message'=>"Account has been closed successfully.");
		}
		elseif($isData != '' && $request->status_selection == 'Active'){
			SahyognidhiPaymentModel::where('fk_sahyognidhi_id',$request->id)->update(array(
				'fk_sahyognidhi_id' => $request->id,
				'close_reason'      => Input::get('close_reason'),
				'reason_selection'  => Input::get('reason_selection'),
				'payment_status'    => '4',
				'status'            => '0',
				'created_by'     	=> Auth::user()->user_id,
			));
			
			SahyognidhiNomineeModel::where('fk_sahyognidhi_id',$request->id)->update(array(
				'status' => '0',
				'updated_by'     => Auth::user()->user_id,
			));
			SahyognidhiRequestModel::where('sahyognidhi_id',$request->id)->update(array(
				'sahyognidhiError1' => '',
				'status' => '0',
				'updated_by'     => Auth::user()->user_id,
			));
			Session::flash('success', 'Account has been active successfully.');
			$response = array('success'=>"1",'message'=>"Account has been active successfully.");
		}
		
        return json_encode($response);
        exit();
	}
	
	public function devangatAfterHalfDisiability(Request $request)
	{
	    $accessData = $this->getArray('sahyognidhi-request',Auth::user()->fk_role_id);
		$deathType  = DeathTypeModel::where('status','1')->get();
		$sahyognidhiData = SahyognidhiRequestModel::where('sahyognidhi_id',$request->id)->first();
		$informerName = KaryakartaModel::where('karyakartas.status','!=','3')
						->select('karyakartas.name_as_per_yuva_sangh_org',
							'karyakartas.karyakarta_id',
							'roles.name'
						)
						->leftJoin('roles','roles.role_id','=','karyakartas.fk_role_id')
						->get();
		return view('admin.sahyognidhi_request_devangat')->with('deathType',$deathType)->with('sahyognidhiData',$sahyognidhiData)->with('accessData',$accessData)->with('informerName',$informerName);
	}

	public function saveDevangatAfterHalfDisiability(Request $request)
	{	
	    $this->validate($request,[
	        'cause_of_death'   => 'required',
	        'sahyognidhi_date' => 'required',
	        'inform_date'      => 'required',
	        'informer_name'    => 'required',
	        'informer_mobile'  => 'required',
	        'designation'      => 'required',
	    ]);
		SahyognidhiRequestModel::where('sahyognidhi_id',$request->editId)->update(array(
			'sahyognidhi_request' => Input::get('sahyognidhi_request'),
			'sahyognidhi_date'	  => date('Y-m-d',strtotime(Input::get('sahyognidhi_date'))),
			'cause_of_death'	  => Input::get('cause_of_death'),
			'death_description'   => Input::filled('death_description') ? Input::get('death_description') : '',
			'inform_date'		  => date('Y-m-d',strtotime(Input::get('inform_date'))),
			'informer_name'		  => Input::get('informer_name'),
			'informer_mobile'	  => Input::get('informer_mobile'),
			'designation'		  => Input::get('designation'),
			'status' 			  => '0',
			'for_devangat'		  => '2',
		));


		$sahyognidhiData = SahyognidhiRequestModel::where('status','!=','3')->get();
		foreach ($sahyognidhiData as $key => $value) {
			$sahyognidhiId = $value['sahyognidhi_id'];
		}
		if($request->hasfile('divangat_upload_image'))
		 {
			foreach($request->file('divangat_upload_image') as $file)
			{
				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension();
				$file->move('assets/uploads/divangat_image/', $name);
				SahyognidhiUploadDocument::create([
					'fk_sahyognidhi_id' => $sahyognidhiId,
					'sahyognidhi_type'  => Input::get('sahyognidhi_request'),
					'upload_document_status' => '1',
					'document_extension' => $extension,
					'upload_document' => $name,
					'created_by'      => Auth::user()->user_id,
				]); 
			}
		 }

		 if($request->hasfile('death_certificate_document'))
		 {
			foreach($request->file('death_certificate_document') as $file)
			{
				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension();
				$file->move('assets/uploads/divangat_image/', $name);
				SahyognidhiUploadDocument::create([
					'fk_sahyognidhi_id' => $sahyognidhiId,
					'sahyognidhi_type'  => Input::get('sahyognidhi_request'),
					'upload_document_status' => '2',
					'document_extension' => $extension,
					'upload_document' => $name,
					'created_by'      => Auth::user()->user_id,
				]); 
			}
		 } 
		return redirect()->route('sahyognidhi-request')->with('Devangat has been added successfully.');
	}
}
