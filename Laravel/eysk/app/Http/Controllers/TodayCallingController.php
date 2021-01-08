<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourierModel;
use App\AchModel;
use App\RegistrationModel;
use App\SahyognidhiRequestModel;
use App\RepaymentModel;
use Session;
use Auth;
use DateTime;
class TodayCallingController extends Controller
{
	public function __construct()
    {
        $this->middleware('checkLogin');
    }
    
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function getDataTodayCalling(Request $request)
    {
    	Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('council',Auth::user()->fk_role_id);
		$yskMember = RegistrationModel::where([['status','!=','3'],['status','!=','5']])->get();
		
		$getCourierData = "";
    	/*$getCourierData = CourierModel::where('couriers.status','1')
	    				->select('couriers.*',
	    					//'registrations.name_as_per_yuva_sangh_org',
	    					//'registrations.name_as_per_ysk_submission_form',
	    					//'registrations.ysk_id',
	    					//'courier_documents.document_title',
	    					'courier_companys.courier_company_name'
	    				)
	    				//->leftJoin('registrations', 'registrations.ysk_id', '=', 'couriers.fk_ysk_id')
	    				//->leftJoin('courier_documents', 'courier_documents.document_id', '=', 'couriers.fk_document_id')
	    				->leftJoin('courier_companys', 'courier_companys.courier_company_id', '=', 'couriers.fk_company_name')
	    				->orderBy('couriers.courier_id','DESC')
	    				->groupBy('couriers.courier_id')
	    				->get();*/
	    				
	    				
	    $getAchData = "";				

	    /*$getAchData   =  AchModel::where('achs.status','1')
	    				->select('achs.*',
	    					//'registrations.name_as_per_yuva_sangh_org',
	    					//'registrations.name_as_per_ysk_submission_form',
	    					'regions.region_name',
	    					'regions.region_code'
	    				)
	    				//->leftJoin('registrations','registrations.ysk_id','=','achs.fk_ysk_id')
	    				->leftJoin('regions','regions.region_id','=','achs.fk_region_id')
	    				->orderBy('achs.ach_id','DESC')
	    				->get();
*/

    
        $days = '5';
	    $getRegistrationData  =  RegistrationModel::whereRaw('registrations.today_date < NOW() - INTERVAL ? DAY', [$days])->where('registrations.status', '!=' ,'3')->select('registrations.*',
	    							'regions.region_name',
	    							'regions.region_code'
	    						)
	    						->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
	    						->orderBy('registrations.registration_id','DESC')
	    						->where('registrations.ysk_id','=','')
	    						->get();
	    						
	   /* $sahyognidhiRequest = SahyognidhiRequestModel::whereRaw('sahyognidhi_requests.sahyognidhi_date < NOW() - INTERVAL ? DAY', [$days])->where('sahyognidhi_requests.status','!=','3')->whereIn('sahyognidhi_payments.payment_status',['0','1'])
							->select('sahyognidhi_requests.*',
								'registrations.ysk_id'
							)
							->leftJoin('registrations', 'registrations.ysk_id', '=', 'sahyognidhi_requests.fk_ysk_id')
							->leftJoin('sahyognidhi_payments', 'sahyognidhi_payments.fk_sahyognidhi_id', '=', 'sahyognidhi_requests.sahyognidhi_id')
							->groupBy('sahyognidhi_requests.sahyognidhi_id')
							->orderBy('sahyognidhi_requests.sahyognidhi_id','DESC')->get();*/
							
		 $sahyognidhiRequest = SahyognidhiRequestModel::whereRaw('sahyognidhi_requests.sahyognidhi_date < NOW() - INTERVAL ? DAY', [$days])->where('sahyognidhi_requests.status','!=','3')->whereIn('sahyognidhi_payments.payment_status',['0','1'])->select('sahyognidhi_requests.*',
								'registrations.ysk_id','sahyognidhi_payments.sahyognidhi_amount'
							)
							->leftJoin('registrations', 'registrations.ysk_id', '=', 'sahyognidhi_requests.fk_ysk_id')
							->leftJoin('sahyognidhi_payments', 'sahyognidhi_payments.fk_sahyognidhi_id', '=', 'sahyognidhi_requests.sahyognidhi_id')
							->groupBy('sahyognidhi_requests.sahyognidhi_id')
							->orderBy('sahyognidhi_requests.sahyognidhi_id','DESC')->get();
							
		$sahyognidhiRequest_count = 0;	
		foreach($sahyognidhiRequest as $sahyognidhiRequests)  
		{								
			$GetDocumentUploadSahyognidhi_medical = (new \App\Helpers\Helper)->GetDocumentUploadSahyognidhi($sahyognidhiRequests->sahyognidhi_id,1);
											
			$GetDocumentUploadSahyognidhi_death = (new \App\Helpers\Helper)->GetDocumentUploadSahyognidhi($sahyognidhiRequests->sahyognidhi_id,2);			
			
			if($sahyognidhiRequests->sahyognidhi_request == 'Devantage')
			{								
				if($GetDocumentUploadSahyognidhi_medical == '0' || $GetDocumentUploadSahyognidhi_death == '0')
				{				    
				    $sahyognidhiRequest_count++;
				}
			}
			else
			{								
				if($GetDocumentUploadSahyognidhi_medical == '0')
				{
				    $sahyognidhiRequest_count++;
				}							    
			}
		}
		
		
		$todayDate = date('Y-m-d', strtotime('+3 month'));
    	$formDate = new DateTime($todayDate);
    	$allRegistrationData = RegistrationModel::where('status','1');
		
		$allRegistrationData1 = $allRegistrationData->get()->toArray();
		
		foreach ($allRegistrationData1 as $key => $value) {
            $dateOfBirth = new DateTime($value['date_of_birth']);
            $getAge = $dateOfBirth->diff($formDate)->y;
            		
            if ($dateOfBirth->diff($formDate)->y > 55 && $value['ysk_id'] > '5000') {
            	$getFiftyFiveYearsData[] = RegistrationModel::where('date_of_birth',$dateOfBirth)->whereRaw('date_of_birth < NOW() - INTERVAL ? DAY', [$days])->where('status','1')->get();
            }
            		
            if ($dateOfBirth->diff($formDate)->y > 60 && $value['ysk_id'] <= '5000') {
            	$getFiftyFiveYearsData[] = RegistrationModel::where('date_of_birth',$dateOfBirth)->whereRaw('date_of_birth < NOW() - INTERVAL ? DAY', [$days])->where('status','1')->get();
            }
            		
        }
		
		$getFiftyFiveYearsData_count = count($getFiftyFiveYearsData);
		
		
		$RepaymentModel = RepaymentModel::select('repayments.*',
                        'regions.region_name',
                        'regions.region_code')
                    ->leftJoin('registrations', 'registrations.registration_id', '=', 'repayments.fk_registration_id')
                    ->leftJoin('regions','regions.region_id','=','repayments.fk_region_id')
                    ->leftJoin('repayment_amounts','repayment_amounts.fk_repayment_id','=','repayments.repayment_id')
                    ->groupBy('repayments.fk_registration_id')
                    ->orderBy('repayments.repayment_id','ASC');
		
		$RepaymentModel->where('repayments.status','0');
		$RepaymentModel->whereRaw('repayment_amounts.ach_bounce_date < NOW() - INTERVAL ? DAY', [$days]);
		$RepaymentModel->orwhereRaw('repayment_amounts.cheque_bounce_date < NOW() - INTERVAL ? DAY', [$days]);
	    $RepaymentModel->whereIn('repayments.bounce_status',['1','2']);
		$RepaymentModel = $RepaymentModel->get();
		
		$RepaymentModel_count = count($RepaymentModel);
		
		
		
	/*	$registrationData_courier = RegistrationModel::where('status','1')->where('courier_id','0')->whereRaw('today_date < NOW() - INTERVAL ? DAY', [$days])->get();*/
		
		 $registrationData_courier = RegistrationModel::where('registrations.status','1')->where('registrations.courier_id','0')->whereRaw('registrations.today_date < NOW() - INTERVAL ? DAY', [$days])->select('registrations.*',
	    							'regions.region_name',
	    							'regions.region_code'
	    						)
	    						->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
	    						->get();
        
        $sahyognidhiData_courier  = SahyognidhiRequestModel::where('status','0')->whereRaw('sahyognidhi_requests.sahyognidhi_date < NOW() - INTERVAL ? DAY', [$days])->where('sahyognidhiError1','')->where('courier_id','0')->get();

        $todayDate1 = date('Y-m-d', strtotime('+3 month'));
        $formDate1 = new DateTime($todayDate1);
        $allRegistrationData1 = RegistrationModel::where('status','1')->whereRaw('today_date < NOW() - INTERVAL ? DAY', [$days])->get();
        foreach ($allRegistrationData1 as $key => $value1) {
            $dateOfBirth1 = new DateTime($value1['date_of_birth']);
            $getAge1 = $dateOfBirth1->diff($formDate1)->y;
            if ($dateOfBirth1->diff($formDate1)->y >= 30) {
                
                $getFiftyFiveYearsData_courier[] = RegistrationModel::where('registrations.status','1')->where('registrations.date_of_birth',$dateOfBirth1)->select('registrations.*',
	    							'regions.region_name',
	    							'regions.region_code'
	    						)
	    						->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
	    						->get();
                
            }
        }
        
       
        $registrationData_courier_count = count($registrationData_courier);
        $sahyognidhiData_courier_count = count($sahyognidhiData_courier);
        $getFiftyFiveYearsData_courier_count = count($getFiftyFiveYearsData_courier);
        
        $courier_count = $registrationData_courier_count + $sahyognidhiData_courier_count + $getFiftyFiveYearsData_courier_count;

        
	    						
    	return view('admin.today_calling')->with('getCourierData',$getCourierData)->with('getAchData',$getAchData)->with('getRegistrationData',$getRegistrationData)->with('yskMember',$yskMember)->with('sahyognidhiRequest',$sahyognidhiRequest)->with('sahyognidhiRequest_count',$sahyognidhiRequest_count)->with('getFiftyFiveYearsData',$getFiftyFiveYearsData)->with('getFiftyFiveYearsData_count',$getFiftyFiveYearsData_count)->with('RepaymentModel',$RepaymentModel)->with('RepaymentModel_count',$RepaymentModel_count)->with('registrationData_courier',$registrationData_courier)->with('sahyognidhiData_courier',$sahyognidhiData_courier)->with('getFiftyFiveYearsData_courier',$getFiftyFiveYearsData_courier)->with('courier_count',$courier_count)->with('accessData',$accessData);
    }
}
