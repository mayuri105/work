<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;
use App\NomineeDetailsModel;
use App\RegistrationPaymentModel;
use App\DiseaseModel;
use App\RegistrationUploadDocumentModel;
use App\AllBankEntryModel;
use App\RegionsModel;
use App\CouncilModel;
use App\DivisionModel;
use App\SamajZoneModel;
use App\YuvaMandalNumberModel;
use App\AchModel;
use App\LedgerAccountModel;
use App\FiftyYearModel;
use DateTime;
use Session;
use Input;
use Validator;
use Auth;
use Excel;
use PHPExcel;
use App\Exports\ExportUsers;
use App\Imports\ImportUsers;
class FiftyYearsController extends Controller
{
    public function __construct()
	{
		$this->middleware('checkLogin');
	}

    public function fiftyFiveYears($region=0 , $council=0,$startDate =0,$endDate=0,$division=0,$samajzone=0,$yuvamandal=0,$gender=0,$status1=1)
    {
        $getFiftyFiveYearsData = array();
        $regionData      = RegionsModel::where('status','1')->get();
        $councilData     = CouncilModel::where('status','1')->get();
        $divisionData    = DivisionModel::where('status','1')->get();
        $samajZone       = SamajZoneModel::where('status','1')->get();
        $yuvaMandal      = YuvaMandalNumberModel::where('status','1')->get();
        $accessData    = $this->getArray('55-years-old',Auth::user()->fk_role_id);
    	$todayDate = date('Y-m-d', strtotime('+3 month'));
    	$formDate = new DateTime($todayDate);
    	$allRegistrationData = RegistrationModel::where('status',$status1);
                    if($region>0){

                        $allRegistrationData->where('fk_region_id',$region);
                    }
                    if($council>0){

                        $allRegistrationData->where('fk_council_id',$council);
                    }
                    if($startDate>0){
                        $startDate1  = date('Y-m-d',strtotime($startDate));
                        $allRegistrationData->where('today_date','>=',$startDate1);
                    }
                    if($endDate>0){
                        $endDate1  = date('Y-m-d',strtotime($endDate));
                        $allRegistrationData->where('today_date','<=',$endDate1);
                    }
                    if($division>0){
                        $allRegistrationData->where('fk_division_id',$division);
                    }
                    if($samajzone>0){
                        $allRegistrationData->where('fk_samaj_zone_id',$samajzone);
                    }
                    if($yuvamandal>0){
                        $allRegistrationData->where('fk_yuva_mandal_id',$yuvamandal);
                    }

                    if($gender > 0){
                        if($gender == 1)
                        {
                            $gendername = 'Male';
                        }else{
                            $gendername =  'Female';
                        }
                        $allRegistrationData->where('registrations.gender',$gendername);

                    }
                   /* if($status1 != 10){
                        $allRegistrationData->where('registrations.status',$status1);
                    }*/

                   $allRegistrationData1 = $allRegistrationData->get()->toArray();
                   //dd($allRegistrationData1);
            	foreach ($allRegistrationData1 as $key => $value) {
            		$dateOfBirth = new DateTime($value['date_of_birth']);
            		$getAge = $dateOfBirth->diff($formDate)->y;

            		if ($dateOfBirth->diff($formDate)->y > 55 && $value['ysk_id'] > '5000') {
            			$getFiftyFiveYearsData[] = RegistrationModel::where('date_of_birth',$dateOfBirth)->where('status',$status1)->get();
            		}

            		if ($dateOfBirth->diff($formDate)->y > 60 && $value['ysk_id'] <= '5000') {
            			$getFiftyFiveYearsData[] = RegistrationModel::where('date_of_birth',$dateOfBirth)->where('status',$status1)->get();
            		}

            	}

    	if (count($getFiftyFiveYearsData) == '0') {
    		$pendingEntry = '0';
    	}
    	else{
    		$pendingEntry = count($getFiftyFiveYearsData);
    	}
    	$getYskMitra = RegistrationModel::where('status','7')->get()->toArray();
    	if (count($getYskMitra) == '0') {
    		$getTotalYskMitra = '0';
    	}
    	else{
    		$getTotalYskMitra = count($getYskMitra);
    	}

    	$getYskTransfer = RegistrationModel::where('status','8')->get()->toArray();
    	if (count($getYskTransfer) == '0') {
    		$getTotalYskTransfer = '0';
    	}
    	else{
    		$getTotalYskTransfer = count($getYskTransfer);
    	}
        if($startDate == 0){
            $startDate = '';
        }
        if($endDate == 0){
            $endDate = '';
        }
    	return view('admin.55_years_old')->with('getFiftyFiveYearsData',$getFiftyFiveYearsData)->with('pendingEntry',$pendingEntry)->with('getTotalYskMitra',$getTotalYskMitra)->with('getTotalYskTransfer',$getTotalYskTransfer)->with('accessData',$accessData)->with('regionData',$regionData)->with('samajZone',$samajZone)->with('yuvaMandal',$yuvaMandal)->with('councilData',$councilData)->with('divisionData',$divisionData)
        ->with(['region'=>$region,'council'=> $council,'startDate'=>$startDate,'endDate'=>$endDate,'division'=>$division,'samajzone'=>$samajzone,'yuvamandal'=>$yuvamandal,'gender'=>$gender,'status1'=>$status1]);
    }
     public function fiftyExportAll($region=0 , $council=0,$startDate =0,$endDate=0,$division=0,$samajzone=0,$yuvamandal=0,$gender=0,$status1=1)
    {

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
                    if($status1 == 1){
                            $allSearch[] = '-';
                    }else{
                        if($status1 == 8){
                            $allSearch[] = 'Transfer';
                        }
                        if($status1 == 7){
                            $allSearch[] = 'YSK Mitra';
                        }

                    }
                    /////////////////////////////////////////////////////////

                    $todayDate = date('Y-m-d', strtotime('+3 month'));
                    $formDate = new DateTime($todayDate);
                    $allRegistrationData = RegistrationModel::where('status',$status1);
                    if($region>0){

                        $allRegistrationData->where('fk_region_id',$region);
                    }
                    if($council>0){

                        $allRegistrationData->where('fk_council_id',$council);
                    }
                    if($startDate>0){
                        $startDate1  = date('Y-m-d',strtotime($startDate));
                        $allRegistrationData->where('today_date','>=',$startDate1);
                    }
                    if($endDate>0){
                        $endDate1  = date('Y-m-d',strtotime($endDate));
                        $allRegistrationData->where('today_date','<=',$endDate1);
                    }
                    if($division>0){
                        $allRegistrationData->where('fk_division_id',$division);
                    }
                    if($samajzone>0){
                        $allRegistrationData->where('fk_samaj_zone_id',$samajzone);
                    }
                    if($yuvamandal>0){
                        $allRegistrationData->where('fk_yuva_mandal_id',$yuvamandal);
                    }

                    if($gender > 0){
                        if($gender == 1)
                        {
                            $gendername = 'Male';
                        }else{
                            $gendername =  'Female';
                        }
                        $allRegistrationData->where('registrations.gender',$gendername);

                    }


                   $allRegistrationData1 = $allRegistrationData->get()->toArray();
                   //dd($allRegistrationData1);
                    foreach ($allRegistrationData1 as $key => $value) {
                        $dateOfBirth = new DateTime($value['date_of_birth']);
                        $getAge = $dateOfBirth->diff($formDate)->y;

                        if ($dateOfBirth->diff($formDate)->y > 55 && $value['ysk_id'] > '5000') {
                            $getFiftyFiveYearsData = RegistrationModel::where('date_of_birth',$dateOfBirth)->where('status',$status1)->select('registration_id')->get()->toArray();
                             //dd($getFiftyFiveYearsData[0]['registration_id']);
                            $id[] = $getFiftyFiveYearsData[0]['registration_id'];
                        }

                        if ($dateOfBirth->diff($formDate)->y > 60 && $value['ysk_id'] <= '5000') {
                            $getFiftyFiveYearsData = RegistrationModel::where('date_of_birth',$dateOfBirth)->where('status',$status1)->select('registration_id')->get()->toArray();
                             //dd($getFiftyFiveYearsData[0]['registration_id']);
                            $id[] = $getFiftyFiveYearsData[0]['registration_id'];
                        }

                    }

                     $users = implode( ',', $id);


                    $id = $users;
                return Excel::download(new ExportUsers($users,'3',$allSearch), '55_60_Years_old-'.date('d-m-Y').'.xlsx');
    }

   public function fiftyExport($id,$region=0 , $council=0,$startDate =0,$endDate=0,$division=0,$samajzone=0,$yuvamandal=0,$gender=0,$status1=1){
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
                    if($status1 == 1){
                            $allSearch[] = '-';
                    }else{
                        if($status1 == 8){
                            $allSearch[] = 'Transfer';
                        }
                        if($status1 == 7){
                            $allSearch[] = 'YSK Mitra';
                        }

                    }
        /////////////////////////////////////////////////////////
            return Excel::download(new ExportUsers($id,'3',$allSearch), '55_60_Years_old-'.date('d-m-Y').'.xlsx');
    }

    public function addFiftyFiveYears(Request $request)
    {
        $id=$request->id;
       // echo $id;die;
        $accessData    = $this->getArray('55-years-old',Auth::user()->fk_role_id);
       // echo "<pre>";print_r($accessData);die;
    	$get55YearsPersonData = RegistrationModel::where('registrations.status','1')->where('registrations.registration_id',$request->id)
    							->select('registrations.*','regions.*')
    							->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
    							->first();
    	//echo "<pre>";print_r($get55YearsPersonData);die;
    	//echo"hello";die;
    	$regionData		 = RegionsModel::where('status','1')->get();
       // echo "<pre>";print_r($regionData);die;
    	$councilData     = CouncilModel::where('status','1')->get();
       // echo "<pre>";print_r($councilData);die;
    	$divisionData    = DivisionModel::where('status','1')->get();
       // echo "<pre>";print_r($divisionData);die;
    	$samajZone 		 = SamajZoneModel::where('status','1')->get();
      //  echo "<pre>";print_r($samajZone);die;
    	$yuvaMandal      = YuvaMandalNumberModel::where('status','1')->get();
       // echo "<pre>";print_r($yuvaMandal);die;
    	$existingDisease = DiseaseModel::where('status','1')->get();
       // echo "<pre>";print_r($existingDisease);die;
    	$bankName        = LedgerAccountModel::where('fk_group_id','14')->get();
        //echo "<pre>";print_r($bankName);die;
    	//dd($get55YearsPersonData->toArray());
    	return view('admin.55_years_old_add')->with('get55YearsPersonData',$get55YearsPersonData)->with('regionData',$regionData)->with('councilData',$councilData)->with('divisionData',$divisionData)->with('samajZone',$samajZone)->with('yuvaMandal',$yuvaMandal)->with('existingDisease',$existingDisease)->with('bankName',$bankName)->with('accessData',$accessData)->with('id',$id);
    }

    public function viewFiftyFiveYears()
    {
    	return view('admin.55_years_old_view');
    }

    public function changeStatusYskMitra($id)
    {   //dd($id);
    	RegistrationModel::where('registration_id',$id)->update(array(
    		'status'     => '7',
    		'updated_by' => Auth::user()->user_id,
    	));
    	NomineeDetailsModel::where('fk_registration_id',$id)->update(array(
    		'fk_registration_default_status' => '7',
    		'updated_by'                     => Auth::user()->user_id,
    	));
    	RegistrationPaymentModel::where('fk_registration_id',$id)->update(array(
    		'registration_payment_status' => '7',
    		'updated_by'                  => Auth::user()->user_id,
    	));
    	return redirect()->route('55-years-old')->with('success','Your account is in YSK Mitra.');
    }

    public function detailsYSKMitra(Request $request)
    {
        $accessData    = $this->getArray('55-years-old',Auth::user()->fk_role_id);
    	$detailsRegistration = RegistrationModel::where('registration_id',$request->id)->where('registrations.status', '!=' ,'3')
    		->select(
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
                        'nominee_details.second_nominee_relation'
                    )
    		->leftJoin('councils', 'councils.council_id', '=', 'registrations.fk_council_id')
    		->leftJoin('regions', 'regions.region_id', '=', 'registrations.fk_region_id')
    		->leftJoin('samaj_zones', 'samaj_zones.samaj_zone_id', '=', 'registrations.fk_samaj_zone_id')
    		->leftJoin('yuva_mandal_numbers', 'yuva_mandal_numbers.yuva_mandal_number_id', '=', 'registrations.fk_yuva_mandal_id')
    		->leftJoin('nominee_details','nominee_details.fk_registration_id', '=', 'registrations.registration_id')
    		->first();
    		$from          =  new DateTime($detailsRegistration['date_of_birth']);
		    $today         =  new DateTime(date('Y-m-d'));
		    $findAge       =  $from->diff($today)->y;
    		//dd($findAge);
    		$dieaseData	= 	DiseaseModel::whereIn('disease_id', explode(',', $detailsRegistration['fk_existing_disease']))->get()->toArray();
    		if ($dieaseData == []) {
    			$diseaseName = '';
    		}
    		else{
    			for ($i=0; $i <count($dieaseData) ; $i++) {
    				$diseaseName[] = $dieaseData[$i]['disease_name'];
    			}
    		}

    		$registerPayment = RegistrationPaymentModel::where('registration_payment_details.registration_payment_status','!=','3')
    			->where('registration_payment_details.fk_registration_id',$request->id)
    			->select('registration_payment_details.*',
    				'ledger_accounts.legder_name'
    			)
    			->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','registration_payment_details.fk_reg_bank_name')
    			->first();
    		$pendingAmount = $registerPayment['bank_amount'] + $registerPayment['check_bounce_amount'];
    		$profilePhoto = RegistrationUploadDocumentModel::where('fk_registration_id',$request->id)->where('upload_registration_documnet_status','1')->get()->toArray();
    		$aadharPhoto = RegistrationUploadDocumentModel::where('fk_registration_id',$request->id)->where('upload_registration_documnet_status','3')->get()->toArray();

    		$paymentDetails = AllBankEntryModel::where('ledger_account',$request->id)
    						->select('all_bank_entry.*',
    							'ledger_accounts.legder_name'
    						)
    						->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','all_bank_entry.fk_bank_id')
    						->get();
    		//dd(paymentDetails);
    		$getRegisterFamilyId = RegistrationModel::where('registration_id',$request->id)->first();
    		$getOtherMemberDetails = RegistrationModel::where('family_id',$getRegisterFamilyId['family_id'])->get()->toArray();
    		$umrnNumber = AchModel::where('fk_ysk_id',$detailsRegistration['ysk_id'])->orWhere('fk_ysk_id',$detailsRegistration['pre_ysk_id'])->first();
    		//dd($umrnNumber->toArray());
    	return view('admin.registration_view')->with('findAge',$findAge)->with('detailsRegistration',$detailsRegistration)->with('registerPayment',$registerPayment)->with('diseaseName',$diseaseName)->with('pendingAmount',$pendingAmount)->with('profilePhoto',$profilePhoto)->with('paymentDetails',$paymentDetails)->with('aadharPhoto',$aadharPhoto)->with('getOtherMemberDetails',$getOtherMemberDetails)->with('umrnNumber',$umrnNumber)->with('accessData',$accessData);
    }

    public function multipleDelete55Years(Request $request)
    {
    	//dd($request->ids);
    	RegistrationModel::whereIn('registration_id',explode(",",$request->ids))->update(array('status' => '3'));
    	NomineeDetailsModel::whereIn('fk_registration_id',explode(",", $request->ids))->update(array('fk_registration_default_status' => '3'));
    	RegistrationPaymentModel::where('fk_registration_id',explode(",", $request->ids))->update(array('registration_payment_status' => '3'));
		Session::flash('success', '55Year People has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"55Year People has been deleted successfully."]);
    }

    public function saveYskTransferToRegistration(Request $request)
    {
    	$this->validate($request,[
	        'family_id' 				       =>   'required',
	        'member'    				       =>   'required|unique:registrations,member,3,status',
	        'aadhar_card_number'			   =>   'unique:registrations,aadhar_card_number,3,status',
	        'name_as_per_yuva_sangh_org'       =>   'required',
			'date_of_birth' 			       =>   'required',
			'age'							   => 	'required',
			'gender' 				           =>   'required',
			'country'						   => 	'required',
			'home_address' 				       =>   'required',
			'pincode'						   => 	'required',
			'registration_amount' 	           =>   'required',
			'phone_number_first' 			   =>   'required|numeric',
			'fk_region_id' 				       =>   'required',
			'fk_samaj_zone_id' 			       =>   'required',
			'fk_yuva_mandal_id' 		       =>   'required',
	    ]);
    	$getProcessingId   = RegistrationModel::get();
    	foreach ($getProcessingId as $key => $value) {
    		$processingId  = $value['processing_id'];
    	}
    	$expldProcessingId = explode('-', $processingId);
    	$autoIncrement     = $expldProcessingId[1]+1;

    	$stateValue    =  "";
    	$districtValue =  "";
    	$cityValue     =  "";
    	$overseaState  =  "";
    	$overseaCity   =  "";
    	$givenCountry  = Input::get('country');
    	if ($givenCountry == 'India') {
    		$this->validate($request,[
    			'india_state' 	  =>   'required',
    			'fk_district_id'  =>   'required',
    			'fk_city_id' 	  =>   'required',
    		]);
    		$stateValue    =  Input::get('india_state');
    		$districtValue =  Input::get('fk_district_id');
    		$cityValue     =  Input::get('fk_city_id');
    	}
    	else{
    		$this->validate($request,[
    			'overseas_state'  =>   'required',
    			'overseas_city'   =>   'required',
    		]);
    		$overseaState  =  Input::get('overseas_state');
    		$overseaCity   =  Input::get('overseas_city');
    	}
    	if (Input::get('age') > 18) {
    		RegistrationModel::create([
    			'processing_id' 	  	=> $expldProcessingId[0].'-'.$autoIncrement,
    			'today_date'			=> date('Y-m-d',strtotime(Input::get('today_date'))),
    			'ysk_id'                => Input::filled('ysk_id') ? Input::get('ysk_id'):'',
					//'pre_ysk_id'			=> Input::get('pre_ysk_id'),
    			'family_id' 		  	=> Input::get('family_id'),
    			'member' 			  	=> Input::get('member'),
    			'name_as_per_yuva_sangh_org' => Input::get('name_as_per_yuva_sangh_org'),
    			'hidden_name_as_per_yuva_sangh_org' => Input::get('hidden_name_as_per_yuva_sangh_org'),
    			'aadhar_card_number'  	=> Input::filled('aadhar_card_number') ? Input::get('aadhar_card_number'):'',
    			'other_document_number' => Input::filled('other_document_number') ? Input::get('other_document_number'):'',
    			'date_of_birth'		  	=> date("Y-m-d", strtotime(Input::get('date_of_birth'))),
    			'age'					=> Input::get('age'),
    			'gender'			  	=> Input::get('gender'),
    			'country'			  	=> Input::get('country'),
    			'fk_state_id'		  	=> $stateValue,
    			'fk_district_id'	  	=> $districtValue,
    			'fk_city_id' 		  	=> $cityValue,
    			'overseas_state' 		=> $overseaState,
    			'overseas_city' 		=> $overseaCity,
    			'home_address'		  	=> Input::get('home_address'),
    			'fk_existing_disease' 	=> Input::filled('fk_existing_disease') ? implode(',', Input::get('fk_existing_disease')) : '',
    			'pincode'               => Input::get('pincode'),
    			'registration_amount'   => Input::get('registration_amount'),
    			'email' 				=> Input::filled('email') ? Input::get('email'):'',
    			'phone_number_first'    => Input::get('phone_number_first'),
    			'phone_number_second'   => Input::filled('phone_number_second') ? Input::get('phone_number_second'):'',
    			'fk_region_id'			=> Input::get('fk_region_id'),
    			'fk_council_id'			=> Input::filled('fk_council_id') ? Input::get('fk_council_id'):'',
    			'fk_division_id'	    => Input::filled('fk_division_id') ? Input::get('fk_division_id'):'',
    			'fk_samaj_zone_id'		=> Input::get('fk_samaj_zone_id'),
    			'fk_yuva_mandal_id'		=> Input::get('fk_yuva_mandal_id'),
    			'created_by'            => Auth::user()->user_id,
    		]);
    		$getRegistrationId = RegistrationModel::get();
    		foreach ($getRegistrationId as $key => $value) {
    			$registrationId = $value['registration_id'];
    		}
    		NomineeDetailsModel::create([
    			'fk_registration_id'		=>  $registrationId,
    			'first_nominee_family_id'   =>  Input::filled('first_nominee_family_id') ? Input::get('first_nominee_family_id'):'',
    			'first_nominee_member_id'   =>  Input::filled('first_nominee_member_id') ? Input::get('first_nominee_member_id'):'',
    			'first_nominee_name'        =>  Input::filled('first_nominee_name') ? Input::get('first_nominee_name'):'',
    			'first_nominee_relation'    =>  Input::filled('first_nominee_relation') ? Input::get('first_nominee_relation'):'',
    			'second_nominee_family_id'  =>  Input::filled('second_nominee_family_id') ? Input::get('second_nominee_family_id'):'',
    			'second_nominee_member_id'  =>  Input::filled('second_nominee_member_id') ? Input::get('second_nominee_member_id'):'',
    			'second_nominee_name'       =>  Input::filled('second_nominee_name') ? Input::get('second_nominee_name'):'',
    			'second_nominee_relation'   =>  Input::filled('second_nominee_relation') ? Input::get('second_nominee_relation'):'',
    			'created_by'                => Auth::user()->user_id,
    		]);
    		RegistrationPaymentModel::create([
    			'fk_registration_id'        => $registrationId,
    			'fk_reg_bank_name'			=> Input::filled('reg_bank_name') ? Input::get('reg_bank_name'):'',
    			'bank_amount'			    => Input::get('bank_amount'),
    			'ysk_member_bank_name'		=> Input::filled('ysk_member_bank_name') ? Input::get('ysk_member_bank_name'):'',
    			'branch_name'			    => Input::filled('branch_name') ? Input::get('branch_name'):'',
    			'cheque_number'			    => Input::filled('cheque_number') ? Input::get('cheque_number'):'',
    			'narration'			        => Input::filled('narration') ? Input::get('narration'):'',
    			'created_by'                => Auth::user()->user_id,
    		]);
    		if($request->hasfile('photo'))
    		{
    			foreach($request->file('photo') as $file)
    			{
    				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
    				$extension = $file->getClientOriginalExtension();
    				$file->move('assets/uploads/user_image/', $name);
    				RegistrationUploadDocumentModel::create([
    					'fk_registration_id'                  => $registrationId,
    					'upload_registration_documnet_status' => '1',
    					'upload_document_extension'           => $extension,
    					'upload_registration_document'        => $name,
    					'created_by'                          => Auth::user()->user_id,
    				]);
    			}
    		}

    		if($request->hasfile('yskregistrationimage'))
    		{
    			foreach($request->file('yskregistrationimage') as $file)
    			{
    				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
    				$extension = $file->getClientOriginalExtension();
    				$file->move('assets/uploads/ysk_registration_image/', $name);
    				RegistrationUploadDocumentModel::create([
    					'fk_registration_id'                  => $registrationId,
    					'upload_registration_documnet_status' => '2',
    					'upload_document_extension'           => $extension,
    					'upload_registration_document'        => $name,
    					'created_by'                          => Auth::user()->user_id,
    				]);
    			}
    		}

    		if($request->hasfile('aadhar_card_photo'))
    		{
    			foreach($request->file('aadhar_card_photo') as $file)
    			{
    				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
    				$extension = $file->getClientOriginalExtension();
    				$file->move('assets/uploads/aadhar_image/', $name);
    				RegistrationUploadDocumentModel::create([
    					'fk_registration_id'                  => $registrationId,
    					'upload_registration_documnet_status' => '3',
    					'upload_document_extension'           => $extension,
    					'upload_registration_document'        => $name,
    					'created_by'                          => Auth::user()->user_id,
    				]);
    			}
    		}

    		if($request->hasfile('other_document_photo'))
    		{
    			foreach($request->file('other_document_photo') as $file)
    			{
    				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
    				$extension = $file->getClientOriginalExtension();
    				$file->move('assets/uploads/proof_image/', $name);
    				RegistrationUploadDocumentModel::create([
    					'fk_registration_id'                  => $registrationId,
    					'upload_registration_documnet_status' => '4',
    					'upload_document_extension'           => $extension,
    					'upload_registration_document'        => $name,
    					'created_by'                          => Auth::user()->user_id,
    				]);
    			}
    		}

    		FiftyYearModel::create([
    			'fk_registration_id'            => $registrationId,
    			'old_member_name'               => Input::get('old_member_name'),
    			'old_member_ysk_id'             => Input::get('old_member_ysk_id'),
    			'fk_old_member_region_id'       => Input::get('fk_old_member_region_id'),
    			'old_member_registration_fees'  => Input::get('old_member_registration_fees'),
    			'new_member_name'               => Input::get('new_member_name'),
    			'new_member_ysk_id'             => Input::filled('new_member_ysk_id') ? Input::get('new_member_ysk_id') : '',
    			'fk_new_member_region_id'       => Input::get('fk_new_member_region_id'),
    			'new_member_registartion_fees'  => Input::get('new_member_registartion_fees'),
    			'difference_amount'             => Input::filled('difference_amount') ? Input::get('difference_amount') : '',
    			'created_by'                    => Auth::user()->user_id,
    		]);
    		RegistrationModel::where('registration_id',Input::get('original_registration_id'))->update(array(
    			'status'     => '8',
    			'updated_by' => Auth::user()->user_id,
    		));
    		NomineeDetailsModel::where('fk_registration_id',Input::get('original_registration_id'))->update(array(
    			'fk_registration_default_status' => '8',
    			'updated_by'                     => Auth::user()->user_id,
    		));
    		RegistrationPaymentModel::where('fk_registration_id',Input::get('original_registration_id'))->update(array(
    			'registration_payment_status' => '8',
    			'updated_by'                  => Auth::user()->user_id,
    		));

    	}
    	else{
    		RegistrationModel::create([
    			'processing_id' 	  	=> $expldProcessingId[0].'-'.$autoIncrement,
    			'today_date'			=> date('Y-m-d',strtotime(Input::get('today_date'))),
    			'ysk_id'                => Input::filled('ysk_id') ? Input::get('ysk_id'):'',
					//'pre_ysk_id'			=> Input::get('pre_ysk_id'),
    			'family_id' 		  	=> Input::get('family_id'),
    			'member' 			  	=> Input::get('member'),
    			'name_as_per_yuva_sangh_org' => Input::get('name_as_per_yuva_sangh_org'),
    			'hidden_name_as_per_yuva_sangh_org' => Input::get('hidden_name_as_per_yuva_sangh_org'),
    			'aadhar_card_number'  	=> Input::filled('aadhar_card_number') ? Input::get('aadhar_card_number'):'',
    			'other_document_number' => Input::filled('other_document_number') ? Input::get('other_document_number'):'',
    			'date_of_birth'		  	=> date("Y-m-d", strtotime(Input::get('date_of_birth'))),
    			'age'					=> Input::get('age'),
    			'gender'			  	=> Input::get('gender'),
    			'country'			  	=> Input::get('country'),
    			'fk_state_id'		  	=> $stateValue,
    			'fk_district_id'	  	=> $districtValue,
    			'fk_city_id' 		  	=> $cityValue,
    			'overseas_state' 		=> $overseaState,
    			'overseas_city' 		=> $overseaCity,
    			'home_address'		  	=> Input::get('home_address'),
    			'fk_existing_disease' 	=> Input::filled('fk_existing_disease') ? implode(',', Input::get('fk_existing_disease')) : '',
    			'pincode'               => Input::get('pincode'),
    			'registration_amount'   => Input::get('registration_amount'),
    			'email' 				=> Input::filled('email') ? Input::get('email'):'',
    			'phone_number_first'    => Input::get('phone_number_first'),
    			'phone_number_second'   => Input::filled('phone_number_second') ? Input::get('phone_number_second'):'',
    			'fk_region_id'			=> Input::get('fk_region_id'),
    			'fk_council_id'			=> Input::filled('fk_council_id') ? Input::get('fk_council_id'):'',
    			'fk_division_id'	    => Input::filled('fk_division_name') ? Input::get('fk_division_name'):'',
    			'fk_samaj_zone_id'		=> Input::get('fk_samaj_zone_id'),
    			'fk_yuva_mandal_id'		=> Input::get('fk_yuva_mandal_id'),
    			'status'				=> '6',
    			'created_by'            => Auth::user()->user_id,
    		]);
    		$getRegistrationId = RegistrationModel::get();
    		foreach ($getRegistrationId as $key => $value) {
    			$registrationId = $value['registration_id'];
    		}
    		NomineeDetailsModel::create([
    			'fk_registration_id'		=>  $registrationId,
    			'first_nominee_family_id'   =>  Input::filled('first_nominee_family_id') ? Input::get('first_nominee_family_id'):'',
    			'first_nominee_member_id'   =>  Input::filled('first_nominee_member_id') ? Input::get('first_nominee_member_id'):'',
    			'first_nominee_name'        =>  Input::filled('first_nominee_name') ? Input::get('first_nominee_name'):'',
    			'first_nominee_relation'    =>  Input::filled('first_nominee_relation') ? Input::get('first_nominee_relation'):'',
    			'second_nominee_family_id'  =>  Input::filled('second_nominee_family_id') ? Input::get('second_nominee_family_id'):'',
    			'second_nominee_member_id'  =>  Input::filled('second_nominee_member_id') ? Input::get('second_nominee_member_id'):'',
    			'second_nominee_name'       =>  Input::filled('second_nominee_name') ? Input::get('second_nominee_name'):'',
    			'second_nominee_relation'   =>  Input::filled('second_nominee_relation') ? Input::get('second_nominee_relation'):'',
    			'fk_registration_default_status' => '6',
    			'created_by'                     => Auth::user()->user_id,
    		]);
    		RegistrationPaymentModel::create([
    			'fk_registration_id'        => $registrationId,
    			'fk_reg_bank_name'			=> Input::filled('reg_bank_name') ? Input::get('reg_bank_name'):'',
    			'bank_amount'			    => Input::get('bank_amount'),
    			'ysk_member_bank_name'		=> Input::filled('ysk_member_bank_name') ? Input::get('ysk_member_bank_name'):'',
    			'branch_name'			    => Input::filled('branch_name') ? Input::get('branch_name'):'',
    			'cheque_number'			    => Input::filled('cheque_number') ? Input::get('cheque_number'):'',
    			'narration'			        => Input::filled('narration') ? Input::get('narration'):'',
    			'registration_payment_status' => '6',
    			'created_by'                  => Auth::user()->user_id,
    		]);

    		if($request->hasfile('photo'))
    		{
    			foreach($request->file('photo') as $file)
    			{
    				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
    				$extension = $file->getClientOriginalExtension();
    				$file->move('assets/uploads/user_image/', $name);
    				RegistrationUploadDocumentModel::create([
    					'fk_registration_id'                  => $registrationId,
    					'upload_registration_documnet_status' => '1',
    					'upload_document_extension'           => $extension,
    					'upload_registration_document'        => $name,
    					'created_by'                          => Auth::user()->user_id,
    				]);
    			}
    		}

    		if($request->hasfile('yskregistrationimage'))
    		{
    			foreach($request->file('yskregistrationimage') as $file)
    			{
    				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
    				$extension = $file->getClientOriginalExtension();
    				$file->move('assets/uploads/ysk_registration_image/', $name);
    				RegistrationUploadDocumentModel::create([
    					'fk_registration_id'                  => $registrationId,
    					'upload_registration_documnet_status' => '2',
    					'upload_document_extension'           => $extension,
    					'upload_registration_document'        => $name,
    					'created_by'                          => Auth::user()->user_id,
    				]);
    			}
    		}

    		if($request->hasfile('aadhar_card_photo'))
    		{
    			foreach($request->file('aadhar_card_photo') as $file)
    			{
    				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
    				$extension = $file->getClientOriginalExtension();
    				$file->move('assets/uploads/aadhar_image/', $name);
    				RegistrationUploadDocumentModel::create([
    					'fk_registration_id'                  => $registrationId,
    					'upload_registration_documnet_status' => '3',
    					'upload_document_extension'           => $extension,
    					'upload_registration_document'        => $name,
    					'created_by'                          => Auth::user()->user_id,
    				]);
    			}
    		}

    		if($request->hasfile('other_document_photo'))
    		{
    			foreach($request->file('other_document_photo') as $file)
    			{
    				$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
    				$extension = $file->getClientOriginalExtension();
    				$file->move('assets/uploads/proof_image/', $name);
    				RegistrationUploadDocumentModel::create([
    					'fk_registration_id'                  => $registrationId,
    					'upload_registration_documnet_status' => '4',
    					'upload_document_extension'           => $extension,
    					'upload_registration_document'        => $name,
    					'created_by'                          => Auth::user()->user_id,
    				]);
    			}
    		}
    		FiftyYearModel::create([
    			'fk_registration_id'            => $registrationId,
    			'old_member_name'               => Input::get('old_member_name'),
    			'old_member_ysk_id'             => Input::get('old_member_ysk_id'),
    			'fk_old_member_region_id'       => Input::get('fk_old_member_region_id'),
    			'old_member_registration_fees'  => Input::get('old_member_registration_fees'),
    			'new_member_name'               => Input::get('new_member_name'),
    			'new_member_ysk_id'             => Input::filled('new_member_ysk_id') ? Input::get('new_member_ysk_id') : '',
    			'fk_new_member_region_id'       => Input::get('fk_new_member_region_id'),
    			'new_member_registartion_fees'  => Input::get('new_member_registartion_fees'),
    			'difference_amount'             => Input::filled('difference_amount') ? Input::get('difference_amount') : '',
    			'created_by'                    => Auth::user()->user_id,
    		]);

    		RegistrationModel::where('registration_id',Input::get('original_registration_id'))->update(array(
    			'status'     => '8',
    			'updated_by' => Auth::user()->user_id,
    		));
    		NomineeDetailsModel::where('fk_registration_id',Input::get('original_registration_id'))->update(array(
    			'fk_registration_default_status' => '8',
    			'updated_by'                     => Auth::user()->user_id,
    		));
    		RegistrationPaymentModel::where('fk_registration_id',Input::get('original_registration_id'))->update(array(
    			'registration_payment_status' => '8',
    			'updated_by'                  => Auth::user()->user_id,
    		));

    	}
    	return redirect()->route('55-years-old')->with('success','YSK Transfer has been completed successfully');
    }
}
