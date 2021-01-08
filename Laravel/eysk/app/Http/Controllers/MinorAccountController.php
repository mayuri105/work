<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;
use App\NomineeDetailsModel;
use App\AllBankEntryDetailsModel;
use App\RegistrationUploadDocumentModel;
use App\RegistrationPaymentModel;
use App\LockingPeriodModel;
use DateTime;
use Session;
use Auth;
class MinorAccountController extends Controller
{
    public function __construct()
	{
		$this->middleware('checkLogin');
	}
	
    /**
     * @author Reshmi Das
     * Date: 
     */
    public function minorAccount()
    {
        Session::forget('region_name');
        Session::forget('division_name');
        Session::forget('samaj_zone_name');
        Session::forget('a');
        $accessData = $this->getArray('minor-account',Auth::user()->fk_role_id);
    	$minorAccountData = RegistrationModel::where([['registrations.status','!=','3'],['registrations.status','=','6']])
    						->select('registrations.*',
    							'regions.region_name',
    							'regions.region_code',
                                'all_bank_entry_details.amount',
                                'nominee_details.first_nominee_name',
                                'nominee_details.second_nominee_name',
    						)
    						->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
                            ->leftJoin('all_bank_entry_details','all_bank_entry_details.fk_registration_id','=','registrations.registration_id')
                            ->leftJoin('nominee_details','nominee_details.fk_registration_id','=','registrations.registration_id')
    						->orderBy('registration_id','DESC')
    						->groupBy('registrations.registration_id')
    						->get();
        $isProfilePhoto = array();
                    //dd(count($registration));
        foreach ($minorAccountData as $key => $value) {
            $documentDetails = RegistrationUploadDocumentModel::where('fk_registration_id',$value['registration_id'])->groupby('fk_registration_id','upload_registration_documnet_status')->where('status','!=','3')->get()->toArray();
            
            $i = 0;
            if (count($documentDetails) > 0) {
                foreach ($documentDetails as $key => $value1) {
                    $documentStatus = $value1['upload_registration_documnet_status'];
                    if ($documentStatus == '1') {
                        $i++;
                    }
                    if ($documentStatus == '3') {
                        $i++;
                        
                    }
                }
            }
            else{
                $i = 0;
            }
            $isProfilePhoto[] = $i;
        }
    	return view('admin.minor_account')->with('minorAccountData',$minorAccountData)->with('isProfilePhoto',$isProfilePhoto)->with('accessData',$accessData);
    }

    /**
     * @author Reshmi Das
     * Date: 
     */
    public function changeMinorAccount()
    {
    	$registrationsData = RegistrationModel::where([['registrations.status','!=','3'],['registrations.status','=','6']])->get()->toArray();
    	$htmlData = '';
    	$htmlStatus = '';/*'2020-12-13'*/
    	$htmlStatuss = '';
    	if ($registrationsData != []) {
    		for ($i=0; $i < count($registrationsData); $i++) { 
    			$from       = new DateTime($registrationsData[$i]['date_of_birth']);
    			$today      = new DateTime(date('Y-m-d'));
    			$findAge  = $from->diff($today)->y;
    			
    			$regData = array();
    			if ($findAge >= '18') {
    				$regData[] = RegistrationModel::where('registrations.status','=','6')->where('date_of_birth','=', $registrationsData[$i]['date_of_birth'])->get();
    			}
    			else{
    				$regData = array();
    			}
    		}
           // dd($regData);
    		if ($regData != []) {
    			$actualRegData = array_pop($regData);
    			$totalRegData = count($actualRegData);
                $regDate = date('Y-m-d');
                $regData = RegistrationModel::orderBy('pre_ysk_id','ASC')->get();
                foreach ($regData as $key => $value) {
                    $preYsk  = $value['pre_ysk_id'];
                }
    			$htmlData .= '<span class="btn btn-label-primary btn-sm btn-bold btn-font-md">'.$totalRegData.' new</span>';
    			for ($i=0; $i < count($actualRegData); $i++) { 

                    $from       = new DateTime($actualRegData[$i]['date_of_birth']);
                    $today      = new DateTime(date('Y-m-d'));
                    
    				$nomineeData[] = NomineeDetailsModel::where('fk_registration_default_status','=','6')->where('fk_registration_id',$actualRegData[$i]['registration_id'])->first();
    				$paymentAmount[] = AllBankEntryDetailsModel::where('fk_registration_id',$actualRegData[$i]['registration_id'])->where('payment_type','Debit')->first();
                    $documentOfProfilePhoto[] = RegistrationUploadDocumentModel::where('fk_registration_id',$actualRegData[$i]['registration_id'])->where('upload_registration_documnet_status','1')->first();
                    $documentOfAadharPhoto[] = RegistrationUploadDocumentModel::where('fk_registration_id',$actualRegData[$i]['registration_id'])->where('upload_registration_documnet_status','3')->first();

    				if ($actualRegData[$i]['family_id'] != '' && $actualRegData[$i]['member'] != '' && $actualRegData[$i]['name_as_per_yuva_sangh_org'] != '' && $actualRegData[$i]['aadhar_card_number'] != '' && $actualRegData[$i]['date_of_birth'] != '' && $actualRegData[$i]['age'] != '' && $actualRegData[$i]['gender'] != '' && $actualRegData[$i]['country'] != '' && (($actualRegData[$i]['fk_state_id'] != '' && $actualRegData[$i]['fk_district_id'] != '' && $actualRegData[$i]['fk_city_id'] != '') || ($actualRegData[$i]['overseas_state'] != '' && $actualRegData[$i]['overseas_city'] != '')) && $actualRegData[$i]['pincode'] != '' && $actualRegData[$i]['home_address'] != '' && $actualRegData[$i]['registration_amount'] != '' && $actualRegData[$i]['phone_number_first'] != '' && $actualRegData[$i]['fk_region_id'] != '' && $actualRegData[$i]['fk_samaj_zone_id'] != '' && $actualRegData[$i]['fk_yuva_mandal_id'] != '' && $nomineeData[$i]['first_nominee_name'] != '' && $nomineeData[$i]['second_nominee_name'] != '' && $paymentAmount[$i]['amount'] != '' && $documentOfProfilePhoto[$i]['upload_registration_document'] != '' && $documentOfAadharPhoto[$i]['upload_registration_document'] != '') {
                        dd($paymentAmount[$i]['amount']);
                        $lockingendDate = LockingPeriodModel::where('status','1')->where('end_date','=','0000-00-00')->first();
                        //dd($lockingendDate['start_date']);
                        if ($lockingendDate['start_date'] == '' || $regDate <= $lockingendDate['start_date']) {
                            $lockingPeriodData = LockingPeriodModel::where('status','1')->where('start_date','<=',$regDate)->where('end_date','>=',$regDate)->first();
                        }
                        elseif($regDate >= $lockingendDate['start_date']){
                            $lockingPeriodData = LockingPeriodModel::where('status','1')->where('end_date','=','0000-00-00')->first();
                        }
                        if ($actualRegData[$i]['fk_existing_disease'] == '') {
                            $lockingPeriodDays = date('Y-m-d', strtotime($regDate . '+ '.$lockingPeriodData['locking_days'].'days'));
                        }
                        else{
                            $lockingPeriodDays = date('Y-m-d', strtotime($regDate . '+ '.$lockingPeriodData['disease_days'].'days'));;
                        }
                        if ($actualRegData[$i]['pre_ysk_id'] == '') {
                            RegistrationModel::where('registration_id',$actualRegData[$i]['registration_id'])->update(array(
                                'age'                   => $from->diff($today)->y,
                                'ysk_confirmation_date' => $lockingPeriodDays,
                                'pre_ysk_id'            => $preYsk+1,
                                'status'                => '1',
                                'updated_by'            => Auth::user()->user_id,
                            ));
                            NomineeDetailsModel::where('fk_registration_default_status','=','6')->where('fk_registration_id',$actualRegData[$i]['registration_id'])->update(array(
                                'fk_registration_default_status' => '1',
                                'updated_by'     => Auth::user()->user_id,
                                ));
                            RegistrationPaymentModel::where('registration_payment_status','=','6')->where('fk_registration_id',$actualRegData[$i]['registration_id'])->update(array(
                                'registration_payment_status' => '1',
                                'updated_by'     => Auth::user()->user_id,
                                ));
                        }
                        elseif($registrationDate['ysk_id'] != ''){
                            RegistrationModel::where('registration_id',$actualRegData[$i]['registration_id'])->update(array(
                                'age'                   => $from->diff($today)->y,
                                'ysk_confirmation_date' => $lockingPeriodDays,
                                'status'                => '1',
                                'updated_by'     => Auth::user()->user_id,
                            ));
                            NomineeDetailsModel::where('fk_registration_default_status','=','6')->where('fk_registration_id',$actualRegData[$i]['registration_id'])->update(array(
                                'fk_registration_default_status' => '1',
                                'updated_by'     => Auth::user()->user_id,
                                ));
                            RegistrationPaymentModel::where('registration_payment_status','=','6')->where('fk_registration_id',$actualRegData[$i]['registration_id'])->update(array(
                                'registration_payment_status' => '1',
                                'updated_by'     => Auth::user()->user_id,
                                ));
                        }

                        /*RegistrationModel::where('status','=','6')->where('registration_id',$actualRegData[$i]['registration_id'])->update(array(
                            'status' => '1',
                            'age'    => $from->diff($today)->y,
                        ));*/
                        

    					$htmlStatuss .= '<div class="kt-notification__item-title">'.$actualRegData[$i]['hidden_name_as_per_yuva_sangh_org'].' age is 18 and all document and payment is verified.</div> '; 

    				}
    				else{
                        RegistrationModel::where('status','!=','3')->where('status','=','6')->where('registration_id',$actualRegData[$i]['registration_id'])->update(array(
                            'status' => '0',
                            'age'    => $from->diff($today)->y,
                            'updated_by'     => Auth::user()->user_id,
                        ));
                        NomineeDetailsModel::where('fk_registration_default_status','=','6')->where('fk_registration_id',$actualRegData[$i]['registration_id'])->update(array(
                            'fk_registration_default_status' => '0',
                            'updated_by'     => Auth::user()->user_id,
                            ));
                        RegistrationPaymentModel::where('registration_payment_status','=','6')->where('fk_registration_id',$actualRegData[$i]['registration_id'])->update(array(
                            'registration_payment_status' => '0',
                            'updated_by'     => Auth::user()->user_id,
                            ));

    					$htmlStatus .= '<div class="kt-notification__item-title">'.$actualRegData[$i]['hidden_name_as_per_yuva_sangh_org'].' age is 18 but all document and payment is not verified.</div>'; 
    				}
    				$response = array("success"=>"1","total_notification"=>$totalRegData,"html_data"=>$htmlData,"html_statuss" => $htmlStatuss, "html_status" => $htmlStatus);
    			}
    		}
    		else{
    			$totalRegData = '0';
    			$htmlData .= '<span class="btn btn-label-primary btn-sm btn-bold btn-font-md">'.$totalRegData.' New</span>';
    			$htmlStatus .= '<div class="kt-notification__item-title">None</div>'; 
    			$response = array("success"=>"0","total_notification"=>$totalRegData,"html_data"=>$htmlData,"html_status" => $htmlStatus);
    		}
    	}
    	else{
    		$totalRegData = '0';
    		$htmlData .= '<span class="btn btn-label-primary btn-sm btn-bold btn-font-md">'.$totalRegData.' new</span>';
    		$htmlStatus .= '<div class="kt-notification__item-title">None</div>'; 
    		$response = array("success"=>"0","total_notification"=>$totalRegData,"html_data"=>$htmlData,"html_status" => $htmlStatus);
    	}
        //dd($response);
    	echo json_encode($response);
		exit;
    }

    /**
     * @author Reshmi Das
     * Date: 
     */
    public function deleteMinorAccount(Request $request)
    {
        RegistrationModel::where('registration_id',$request->registration_id)->update(array('status' => '3'));
        NomineeDetailsModel::where('fk_registration_id',$request->registration_id)->update(array('fk_registration_default_status' => '3'));
        RegistrationPaymentModel::where('fk_registration_id',$request->registration_id)->update(array('registration_payment_status' => '3'));
        return redirect()->route('minor-account')->with('success','Minor Account has been deleted successfully');
    }

    /**
     * @author Reshmi Das
     * Date: 
     */
    public function multipleDeleteMinorAccount(Request $request)
    {
        RegistrationModel::whereIn('registration_id',explode(",",$request->ids))->update(array('status' => '3'));
        NomineeDetailsModel::whereIn('fk_registration_id',explode(",", $request->ids))->update(array('fk_registration_default_status' => '3'));
        RegistrationPaymentModel::where('fk_registration_id',explode(",", $request->ids))->update(array('registration_payment_status' => '3'));
        Session::flash('success', 'Minor Account has been deleted successfully.');
        return response()->json(['status'=>true,'message'=>"Minor Account has been deleted successfully."]);
    }
}