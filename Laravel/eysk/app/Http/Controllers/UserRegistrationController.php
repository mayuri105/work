<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;
use App\DiseaseModel;
use App\RegistrationPaymentModel;
use App\RegistrationUploadDocumentModel;
use App\AllBankEntryModel;
use App\AchModel;
use Input;
class UserRegistrationController extends Controller
{
    public function userRegistration(Request $request)
    {
    	$id = $request->id;
    	$registrationData = RegistrationModel::where('registration_id',$id)->select(
                        'registrations.*',
                        'councils.name',
                        'councils.code',
                        'regions.region_name',
                        'regions.region_code',
                        'samaj_zones.samaj_zone_name',
                        'yuva_mandal_numbers.yuva_mandal_number',
                        'nominee_details.first_nominee_family_id',
                        'nominee_details.first_nominee_name',
                        'nominee_details.first_nominee_relation',
                        'nominee_details.second_nominee_family_id',
                        'nominee_details.second_nominee_name',
                        'nominee_details.second_nominee_relation',
                    )
    		->leftJoin('councils', 'councils.council_id', '=', 'registrations.fk_council_id')
    		->leftJoin('regions', 'regions.region_id', '=', 'registrations.fk_region_id')
    		->leftJoin('samaj_zones', 'samaj_zones.samaj_zone_id', '=', 'registrations.fk_samaj_zone_id')
    		->leftJoin('yuva_mandal_numbers', 'yuva_mandal_numbers.yuva_mandal_number_id', '=', 'registrations.fk_yuva_mandal_id')
    		->leftJoin('nominee_details','nominee_details.fk_registration_id', '=', 'registrations.registration_id')
    		->first();
    		$dieaseData	= 	DiseaseModel::whereIn('disease_id', explode(',', $registrationData['fk_existing_disease']))->get()->toArray();
    		if ($dieaseData == []) {
    			$diseaseName = '';
    		}
    		else{
    			for ($i=0; $i <count($dieaseData) ; $i++) { 
    				$diseaseName[] = $dieaseData[$i]['disease_name'];
    			}
    		}

    		$registerPayment = RegistrationPaymentModel::where('registration_payment_details.registration_payment_status','!=','3')
    			->where('registration_payment_details.fk_registration_id',$id)
    			->select('registration_payment_details.*',
    				'ledger_accounts.legder_name',
    			)
    			->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','registration_payment_details.fk_reg_bank_name')
    			->first();   
    		$pendingAmount = $registerPayment['bank_amount'] + $registerPayment['check_bounce_amount'];	
    		$profilePhoto = RegistrationUploadDocumentModel::where('fk_registration_id',$id)->where('upload_registration_documnet_status','1')->get()->toArray();
    		$aadharPhoto = RegistrationUploadDocumentModel::where('fk_registration_id',$id)->where('upload_registration_documnet_status','3')->get()->toArray();

    		$paymentDetails = AllBankEntryModel::where('ledger_account',$id)
    						->select('all_bank_entry.*',
    							'ledger_accounts.legder_name',
    						)
    						->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','all_bank_entry.fk_bank_id')
    						->get();
    		//dd(paymentDetails);
    		$getRegisterFamilyId = RegistrationModel::where('registration_id',$id)->first();
    		$getOtherMemberDetails = RegistrationModel::where('family_id',$getRegisterFamilyId['family_id'])->get()->toArray();
    		$umrnNumber = AchModel::where('fk_ysk_id',$registrationData['ysk_id'])->orWhere('fk_ysk_id',$registrationData['pre_ysk_id'])->first();
    				//dd($umrnNumber);
    	return view('admin.user_registration')->with('id',$id)->with('registrationData',$registrationData)->with('umrnNumber',$umrnNumber)->with('getOtherMemberDetails',$getOtherMemberDetails)->with('registerPayment',$registerPayment)->with('profilePhoto',$profilePhoto)->with('aadharPhoto',$aadharPhoto)->with('diseaseName',$diseaseName)->with('paymentDetails',$paymentDetails);
    }

    public function updateUserRegistration(Request $request)
    {
    	RegistrationModel::where('registration_id',$request->id)->update(array(
    		'phone_number_first'  => Input::get('phone_number_first'),
    		'phone_number_second' => Input::get('phone_number_second'),
    		'email'               => Input::get('email'),
    	));
    	return redirect()->route('user-registration',$request->id)->with('success','Your data has been updated.');
    	//dd($request->id);
    }
}
