<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuspenseAccountModel;
use App\BankNameModel;
use App\ExpenseTypeModel;
use App\RegistrationModel;
use Input;
use DB;
use Session;
use App\BehalfOfPaymentModel;
use App\AllBankEntryDetailsModel;
use App\AllBankEntryModel;
use App\CheckbounceModel;
use App\RepaymentModel;
use App\DivangatAmountModel;
use App\LockingPeriodModel;
use App\NomineeDetailsModel;
use App\RegistrationPaymentModel;
use App\RegistrationUploadDocumentModel;
use App\RegistrationDonationModel;
use App\RegistrationDevelopmentFundAmount;
use Auth;
use Mail;
use App\LedgerAccountModel;
class SuspenseAccountController extends Controller
{
        public function __construct(){
            $this->middleware('checkLogin');
        }
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function suspenseAccount(Request $request)
    {
        Session::forget('region_name');
        Session::forget('division_name');
        Session::forget('samaj_zone_name');
        Session::forget('a');
        $accessData = $this->getArray('suspense-account',Auth::user()->fk_role_id);
        $suspenseAccount = SuspenseAccountModel::where('suspense_accounts.status','1')
                          ->select('suspense_accounts.*',
                             'ledger_accounts.legder_name',
                         )
                          ->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','suspense_accounts.fk_bank_id')
                          ->orderBy('suspense_accounts.suspense_account_id','DESC')
                          ->groupBy('suspense_accounts.suspense_account_id')
                          ->get();

         $sbiAmount = SuspenseAccountModel::where('suspense_accounts.status','1')->where('fk_bank_id','20')->get()->toArray();
    
        if (count($sbiAmount) == '0') {
            $totalSbiAmount = '0000';
        }
        else{
            foreach ($sbiAmount as $key => $value) {
                $sbiMoney[]  = $value['amount'];
            }
            $totalSbiAmount = array_sum($sbiMoney);
        }

        $hdfcAmount = SuspenseAccountModel::where('suspense_accounts.status','1')->where('fk_bank_id','19')->get()->toArray();

        if (count($hdfcAmount) == '0') {
            $totalHdfcAmount = '0000';
        }
        else{
            foreach ($hdfcAmount as $key => $value) {
                $hdfcMoney[] = $value['amount'];
            }
            $totalHdfcAmount = array_sum($hdfcMoney);
        }
        
        if (count($suspenseAccount->toArray()) == '0') {
            $bankTotalAmount = '0000';
            $pendingEntry    = '0';
        }
        else{
            foreach ($suspenseAccount as $key => $value) {
                $totalAmount[]     = $value['amount'];
                $entryPending[]    = $value['suspense_account_id'];
            }
            $bankTotalAmount = array_sum($totalAmount);
            $pendingEntry    = count($entryPending);
        }

        $getBehalfOfPayment  = BehalfOfPaymentModel::get();
        return view('admin.suspense_account')->with('bankTotalAmount',$bankTotalAmount)->with('pendingEntry',$pendingEntry)->with('totalSbiAmount',$totalSbiAmount)->with('totalHdfcAmount',$totalHdfcAmount)->with('suspenseAccount',$suspenseAccount)->with('getBehalfOfPayment',$getBehalfOfPayment)->with('accessData',$accessData);
        
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function getAmountByRegistrationId(Request $request)
    {
        if (Input::get('fk_behalf_of_payment_id') == '3') {

            $registrationAmount = RegistrationModel::where('status','!=','3')->where('registration_id',Input::get('fk_registration_id'))->first();
            
            $responseData = array("success" => "1","html_data" => $registrationAmount['registration_amount']);
        }

        elseif (Input::get('fk_behalf_of_payment_id') == '4') {

            $registrationAmount = RegistrationModel::where('status','!=','3')->where('registration_id',Input::get('fk_registration_id'))->first();
            $getCheckbounce = CheckbounceModel::where('fk_registration_id',Input::get('fk_registration_id'))->first();
            $registrationCheckbounce = $registrationAmount['registration_amount']+$getCheckbounce['checkbounce_amount'];
            $responseData = array("success" => "1","html_data" => $registrationCheckbounce);
        }

        elseif (Input::get('fk_behalf_of_payment_id') == '5') {

            $getRepayment = RepaymentModel::where('fk_registration_id',Input::get('fk_registration_id'))->first();
            $responseData = array("success" => "1","html_data" => $getRepayment['deposit_amount']);
        }

        elseif (Input::get('fk_behalf_of_payment_id') == '6') {

            $getRepayment = RepaymentModel::where('fk_registration_id',Input::get('fk_registration_id'))->first();
            $getCheckbounce = CheckbounceModel::where('fk_registration_id',Input::get('fk_registration_id'))->first();
            $getAmount = $getRepayment['deposit_amount']+$getCheckbounce['checkbounce_amount'];
            $responseData = array("success" => "1","html_data" => $getAmount);
        }

        else{
            dd(1);
        }
        echo json_encode($responseData);
        exit;
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function getDivangatAmountByRegistrationId()
    {
        $divangatAmount = DivangatAmountModel::where('status','1')->where('fk_registration_id',Input::get('fk_registration_id'))->first();
        $responseData = array('success' => '1', 'html_data' => $divangatAmount['divangat_amount']);
        echo json_encode($responseData);
        exit;
    }


     /**
     * @author Reshmi Das
     * Date: 
     */
    public function editSuspenseAccount(Request $request)
    {
        $accessData = $this->getArray('suspense-account',Auth::user()->fk_role_id);
    	$editSuspenseAccount =   SuspenseAccountModel::where('suspense_account_id',$request->suspense_account_id)->first();

        $allBankEntryDetails =  DB::table('all_bank_entry_details')->where('all_bank_entry_details.status','!=','3')
        ->select('registrations.registration_id')
        ->join('registrations','registrations.registration_id','=','all_bank_entry_details.fk_registration_id')
        ->groupBy('all_bank_entry_details.fk_registration_id')
        ->get();

        $registrationId = array();
        foreach ($allBankEntryDetails as $key) {
            $registrationId[] = $key->registration_id;
        }

        $registrationIdData = DB::table('registrations')
                                ->where([['registrations.status','!=','3'],['registrations.status','!=','6']])
                                ->select('registrations.*',
                                        'ysk_transfer.*',
                                        'regions.region_name',
                                        'regions.region_code',
                                        )
                                ->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
                                ->leftJoin('ysk_transfer','ysk_transfer.fk_registration_id','=','registrations.registration_id')
                                ->get();
        
        $sunCreaditorData = RegistrationModel::where('registrations.status','!=','3')
                            ->select('registrations.*',
                                'ysk_transfer.*',
                                'regions.region_name',
                                'regions.region_code',
                            )
                            ->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
                            ->leftJoin('ysk_transfer','ysk_transfer.fk_registration_id','=','registrations.registration_id')
                            ->get();
       // dd($sunCreaditorData);

    	$bankName   		 =   LedgerAccountModel::where('status','1')->where('fk_group_id','14')->get();
    	$expenseType 		 =   ExpenseTypeModel::where('status','1')->get();
        $behalfOfPayment     =   BehalfOfPaymentModel::get();
    	return view('admin.suspense_account_edit')->with('editSuspenseAccount',$editSuspenseAccount)->with('bankName',$bankName)->with('expenseType',$expenseType)->with('behalfOfPayment',$behalfOfPayment)->with('registrationIdData',$registrationIdData)->with('sunCreaditorData',$sunCreaditorData)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function updateSuspenseAccount(Request $request)
    {
    	$this->validate($request,[
            'today_date'     =>   'required',
            'fk_bank_id' 	 =>   'required',
            'payment_type' 	 =>   'required',
            'total_amount'   =>   'required',
            'payment_mode'   =>   'required',
            'fk_registration_id' => 'required',
        ]);

        AllBankEntryModel::create([
            'payment_date'   =>  date('Y-m-d',strtotime(Input::get('today_date'))),
            'fk_bank_id'     =>  Input::get('fk_bank_id'),
            'payment_type'   =>  Input::get('payment_type'),
            'ledger_account' =>  implode(',', Input::get('fk_registration_id')),
            'amount'         =>  Input::get('total_amount'),
            'cheque_number'  =>  Input::filled('cheque_number')? Input::get('cheque_number'):'',
            'transaction_id' =>  Input::filled('transaction_id')? Input::get('transaction_id'):'',
            'details'        =>  Input::filled('details')? strtoupper(Input::get('details')):'',
            'payment_mode'   =>  Input::get('payment_mode'),
            'created_by'     => Auth::user()->user_id,
        ]);
        $getId = AllBankEntryModel::get();
        foreach ($getId as $key => $value) {
            $getBankEntryId = $value['all_bank_entry_id'];
        }
        for ($i=0; $i < count(Input::get('fk_registration_id')) ; $i++) { 
            $creditInUser[] = array(
                'fk_all_bank_entry_id'    => $getBankEntryId,
                'fk_registration_id'      => Input::get('fk_registration_id')[$i],
                'ysk_entry'               => '0',
                'payment_type'            => Input::get('payment_type'),
                'amount'                  => Input::get('amount')[$i],
                'created_at'              => date('Y-m-d H:i:s'),
                'created_by'              => Auth::user()->user_id,
            );
            $debitFromUser[] = array(
                'fk_all_bank_entry_id'    => $getBankEntryId,
                'fk_registration_id'      => Input::get('fk_registration_id')[$i],
                'ysk_entry'               => '0',
                'payment_type'            => 'Debit',
                'amount'                  => Input::get('amount')[$i],
                'created_at'              => date('Y-m-d H:i:s'),
                'created_by'              => Auth::user()->user_id,
            );
        }
        $creditYsk[] = array(
           // 'fk_all_bank_entry_id'    => $getBankEntryId,
            'ysk_entry'               => '1',
            'payment_type'            => Input::get('payment_type'),
            'amount'                  => array_sum(Input::get('amount')),
            'created_at'              => date('Y-m-d H:i:s'),
            'created_by'              => Auth::user()->user_id,
        );

        if (Input::get('total_amount') == $creditYsk[0]['amount']) {
            $regDate = date('Y-m-d',strtotime(Input::get('today_date')));
            $regData = RegistrationModel::orderBy('pre_ysk_id','ASC')->get();
            foreach ($regData as $key => $value) {
                $preYsk  = $value['pre_ysk_id'];
            } 
            for ($i=0; $i < count(Input::get('fk_registration_id')); $i++) { 
                $registrationDate[] = RegistrationModel::where('status','!=','3')->where('registration_id',Input::get('fk_registration_id')[$i])->get()->toArray();
                $nomineeData[] = NomineeDetailsModel::where('fk_registration_id',Input::get('fk_registration_id'))->get()->toArray();   
                $profilePhoto[] = RegistrationUploadDocumentModel::where('fk_registration_id',Input::get('fk_registration_id')[$i])->where('upload_registration_documnet_status','1')->get()->toArray();
                $aadharPhoto[]  = RegistrationUploadDocumentModel::where('fk_registration_id',Input::get('fk_registration_id')[$i])->where('upload_registration_documnet_status','3')->get()->toArray();
    
                $profilePhoto1[] = array_pop($profilePhoto[$i]);
                
                $aadharPhoto1[] = array_pop($aadharPhoto[$i]);
                $regDatas[]     = array_pop($registrationDate[$i]);
                $nomineeData1[] = array_pop($nomineeData[$i]);

                if ($regDatas[$i]['status'] == '6' && $regDatas[$i]['ysk_date'] == '0000-00-00') {
                    if ($regDatas[$i]['family_id'] != '' && $regDatas[$i]['member'] != '' && $regDatas[$i]['name_as_per_yuva_sangh_org'] != '' && $aadharPhoto1[$i]['upload_registration_document'] != '' && $regDatas[$i]['date_of_birth'] != '' && $regDatas[$i]['age'] != '' && $regDatas[$i]['gender'] != '' && $regDatas[$i]['country'] != '' && ($regDatas[$i]['fk_state_id'] != '' && $regDatas[$i]['fk_district_id'] != '' && $regDatas[$i]['fk_city_id'] != '') || ($regDatas[$i]['overseas_state'] != '' && $regDatas[$i]['overseas_city'] != '') && $regDatas[$i]['pincode'] != '' && $regDatas[$i]['home_address'] != '' && $regDatas[$i]['registration_amount'] != '' && $regDatas[$i]['phone_number_first'] != '' && $regDatas[$i]['fk_region_id'] != '' && $regDatas[$i]['fk_samaj_zone_id'] != '' && $regDatas[$i]['fk_yuva_mandal_id'] != '' && $profilePhoto1[$i]['upload_registration_document'] != '' && $regDatas[$i]['aadhar_card_number'] != '' && $nomineeData1[$i]['first_nominee_name'] != '' && $nomineeData1[$i]['second_nominee_name'] != '') {
                            RegistrationModel::where('registration_id',Input::get('fk_registration_id')[$i])
                            ->update(array(
                                'ysk_date'   => $regDate,
                                'updated_by' => Auth::user()->user_id,
                            ));
                            $StaringDate = $regDatas[$i]['date_of_birth'];
                            $newEndingDate = date("d-m-Y", strtotime(date("d-m-Y", strtotime($StaringDate)) . " + 18year"));
                            //$this->sendSMS($regDatas[$i]['phone_number_first'],$regDatas[$i]['name_as_per_yuva_sangh_org'],'As you are Minor, YSK Membership will be activated on '.$newEndingDate);
                            if($regDatas[$i]['email'] != ''){
                                $user = $regDatas[$i]['email'];
                                $NameAsPerYuvaSangh = strtoupper($regDatas[$i]['name_as_per_yuva_sangh_org']);
                                Mail::send('emails.welcome1', ['user' => $user, 'newEndingDate' => $newEndingDate, 'NameAsPerYuvaSangh' => $NameAsPerYuvaSangh], function ($m) use ($user,$NameAsPerYuvaSangh,$newEndingDate) {
                                    //dd($NameAsPerYuvaSangh);
                                    $m->from('support@eysk.org', 'Minor Account');
                                    $m->to($user, Input::get('name_as_per_yuva_sangh_org'))->subject('Minor Account');
                                });
                            }
                    }
                }
                
                else{
                    if ($regDatas[$i]['ysk_confirmation_date'] == '0000-00-00' && $regDatas[$i]['ysk_date'] == '0000-00-00' && $regDatas[$i]['status'] != '6') {

                        if ($nomineeData1[$i]['first_nominee_name'] != '' && $nomineeData1[$i]['second_nominee_name'] != '' && $regDatas[$i]['family_id'] != '' && $regDatas[$i]['member'] != '' && $regDatas[$i]['name_as_per_yuva_sangh_org'] != '' && $aadharPhoto1[$i]['upload_registration_document'] != '' && $regDatas[$i]['date_of_birth'] != '' && $regDatas[$i]['age'] != '' && $regDatas[$i]['gender'] != '' && $regDatas[$i]['country'] != '' && ($regDatas[$i]['fk_state_id'] != '' && $regDatas[$i]['fk_district_id'] != '' && $regDatas[$i]['fk_city_id'] != '') || ($regDatas[$i]['overseas_state'] != '' && $regDatas[$i]['overseas_city'] != '') && $regDatas[$i]['pincode'] != '' && $regDatas[$i]['home_address'] != '' && $regDatas[$i]['registration_amount'] != '' && $regDatas[$i]['phone_number_first'] != '' && $regDatas[$i]['fk_region_id'] != '' && $regDatas[$i]['fk_samaj_zone_id'] != '' && $regDatas[$i]['fk_yuva_mandal_id'] != '' && $profilePhoto1[$i]['upload_registration_document'] != '' && $regDatas[$i]['aadhar_card_number'] != '') {

                            $lockingendDate = LockingPeriodModel::where('status','1')->where('end_date','=','0000-00-00')->get();
                            if ($regDate >= $lockingendDate[0]['start_date']) {
                                $lockingPeriodData = LockingPeriodModel::where('status','1')->where('end_date','=','0000-00-00')->first();
                            }
                            else{
                                $lockingPeriodData = LockingPeriodModel::where('status','1')->where('start_date','<=',$regDate)->where('end_date','>=',$regDate)->first();
                            }
                            if ($regDatas[$i]['fk_existing_disease'] == '') {
                                $lockingPeriodDays = date('Y-m-d', strtotime($regDate . '+ '.$lockingPeriodData['locking_days'].'days'));
                            }
                            else{
                                $lockingPeriodDays = date('Y-m-d', strtotime($regDate . '+ '.$lockingPeriodData['disease_days'].'days'));;
                            }
                            

                            if ($regDatas[$i]['ysk_id'] == '') {
                                if ($regDatas[$i]['age'] >= '18') {
                                    $preYskId = $preYsk+1;
                                    $confirmationDate = $lockingPeriodDays;
                                    RegistrationModel::where('registration_id',Input::get('fk_registration_id')[$i])
                                    ->update(array(
                                        'ysk_date'              => $regDate,
                                        'ysk_confirmation_date' => $lockingPeriodDays,
                                        'pre_ysk_id'            => $preYsk+1,
                                        'status'                => '1',
                                        'updated_by'            => Auth::user()->user_id,
                                    ));
                                    NomineeDetailsModel::where('fk_registration_id',Input::get('fk_registration_id')[$i])->update(array(
                                        'fk_registration_default_status' => '1',
                                        'updated_by'     => Auth::user()->user_id,
                                    ));
                                    RegistrationPaymentModel::where('fk_registration_id',Input::get('fk_registration_id')[$i])->update(array(
                                        'registration_payment_status' => '1',
                                        'updated_by'     => Auth::user()->user_id,
                                    ));
                                    
                                    //$this->sendSMS($regDatas[$i]['phone_number_first'],'Welcome to YSK Family, Your YSK ID is '.$preYskId,' Your risk cover will start after '.date('d-m-Y',strtotime($confirmationDate)));
                                    
                                    if($regDatas[$i]['email'] != ''){
                                        $user = $regDatas[$i]['email'];
                                        $NameAsPerYuvaSangh = strtoupper($regDatas[$i]['name_as_per_yuva_sangh_org']);
                                        Mail::send('emails.welcome2', ['user' => $user, 'preYskId' => $preYskId, 'NameAsPerYuvaSangh' => $NameAsPerYuvaSangh, 'confirmationDate' => date('d-m-Y',strtotime($confirmationDate))], function ($m) use ($user,$preYskId,$NameAsPerYuvaSangh,$confirmationDate) {
                                            //dd($NameAsPerYuvaSangh);
                                            $m->from('support@eysk.org', 'Ysk Confirmation Date');
                                            $m->to($user, Input::get('name_as_per_yuva_sangh_org'))->subject('Ysk Confirmation Date');
                                        });
                                    }
                                    
                                    
                                    $getRegistrationDevelopmentFund = RegistrationDonationModel::where('status','1')->where('start_date','<=',$regDatas[$i]['today_date'])->where('end_date','>=',$regDatas[$i]['today_date'])->get()->toArray();

                                    if ($getRegistrationDevelopmentFund == []) {
                                        $getRegistrationDevelopmentFund = RegistrationDonationModel::where('status','1')->where('end_date','0000-00-00')->get()->toArray();
                                    }
                                    $totalDevelopmentFundAmount = $getRegistrationDevelopmentFund[0]['region_registration_amount'] + $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'];

                                    for ($j=2009; $j <= date('Y') ; $j++) { 
                                        $startDay   = 1;
                                        $startMonth = 4;
                                        $startDate  = strftime("%F", strtotime($j."-".$startMonth."-".$startDay));
                                        $futureDate = date('Y-m-d', strtotime('+364 day', strtotime($startDate)) );
                                        if ($regDatas[$i]['today_date'] >= $startDate && $regDatas[$i]['today_date'] <= $futureDate) {
                                            $startYear = $startDate;
                                            $endYear = $futureDate;
                                        }
                                    }
            
                                    $getSameYearData = RegistrationDevelopmentFundAmount::where('start_year',$startYear)->where('end_year',$endYear)->where('fk_region_id',$regDatas[$i]['fk_region_id'])->where('fk_yuva_mandal_id',$regDatas[$i]['fk_yuva_mandal_id'])->get();
                                    if (count($getSameYearData) == 0) {
                                        $y = RegistrationDevelopmentFundAmount::create([
                                            'start_year'   => $startYear,
                                            'end_year'     => $endYear,
                                            'fk_region_id' => $regDatas[$i]['fk_region_id'],
                                            'fk_yuva_mandal_id' => $regDatas[$i]['fk_yuva_mandal_id'],
                                            'total_registration'=> 1,
                                            'total_amount' => $totalDevelopmentFundAmount,
                                            'region_development_amount' => $getRegistrationDevelopmentFund[0]['region_registration_amount'],
                                            'yuva_mandal_development_amount' => $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'],
                                            'created_by'     => Auth::user()->user_id,
                                        ]);
                                    }
                                    else{
                                        $getAmount = RegistrationDevelopmentFundAmount::where('start_year',$startYear)->where('end_year',$endYear)->where('fk_region_id',$regDatas[$i]['fk_region_id'])->where('fk_yuva_mandal_id',$regDatas[$i]['fk_yuva_mandal_id'])->first();
                                        $y = RegistrationDevelopmentFundAmount::where('start_year',$startYear)->where('end_year',$endYear)->where('fk_region_id',$regDatas[$i]['fk_region_id'])->where('fk_yuva_mandal_id',$regDatas[$i]['fk_yuva_mandal_id'])->update(array(
                                            'start_year'   => $startYear,
                                            'end_year'     => $endYear,
                                            'fk_region_id' => $regDatas[$i]['fk_region_id'],
                                            'fk_yuva_mandal_id' => $regDatas[$i]['fk_yuva_mandal_id'],
                                            'total_registration'=> $getAmount['total_registration'] + 1,
                                            'total_amount' => $getAmount['total_amount'] + $totalDevelopmentFundAmount,
                                            'region_development_amount' => $getRegistrationDevelopmentFund[0]['region_registration_amount'],
                                            'yuva_mandal_development_amount' => $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'],
                                            'updated_by'     => Auth::user()->user_id,
                                        ));
                                    }
                                }
                            }
                            else{
                                if ($regDatas[$i]['age'] >= '18') {
                                    RegistrationModel::where('registration_id',Input::get('fk_registration_id')[$i])
                                    ->update(array(
                                        'ysk_date'              => $regDate,
                                        'ysk_confirmation_date' => $lockingPeriodDays,
                                        'status'                => '1',
                                        'updated_by'     => Auth::user()->user_id,
                                    ));
                                    NomineeDetailsModel::where('fk_registration_id',Input::get('fk_registration_id')[$i])->update(array(
                                        'fk_registration_default_status' => '1',
                                        'updated_by'     => Auth::user()->user_id,
                                    ));
                                    RegistrationPaymentModel::where('fk_registration_id',Input::get('fk_registration_id')[$i])->update(array(
                                        'registration_payment_status' => '1',
                                        'updated_by'     => Auth::user()->user_id,
                                    ));
                                    //$this->sendSMS($regDatas[$i]['phone_number_first'],'Welcome to YSK Family, Your YSK ID is '.$regDatas[$i]['ysk_id'],' Your risk cover will start after '.date('d-m-Y',strtotime($confirmationDate)));
                                    
                                    if($regDatas[$i]['email'] != ''){
                                        $user = $regDatas[$i]['email'];
                                        $NameAsPerYuvaSangh = strtoupper($regDatas[$i]['name_as_per_yuva_sangh_org']);
                                        Mail::send('emails.welcome2', ['user' => $user, 'preYskId' => $regDatas[$i]['ysk_id'], 'NameAsPerYuvaSangh' => $NameAsPerYuvaSangh, 'confirmationDate' => date('d-m-Y',strtotime($confirmationDate))], function ($m) use ($user,$preYskId,$NameAsPerYuvaSangh,$confirmationDate) {
                                            //dd($NameAsPerYuvaSangh);
                                            $m->from('support@eysk.org', 'Ysk Confirmation Date');
                                            $m->to($user, Input::get('name_as_per_yuva_sangh_org'))->subject('Ysk Confirmation Date');
                                        });
                                    }
                                    
                                    
                                    
                                    $getRegistrationDevelopmentFund = RegistrationDonationModel::where('status','1')->where('start_date','<=',$regDatas[$i]['today_date'])->where('end_date','>=',$regDatas[$i]['today_date'])->get()->toArray();
                                    if ($getRegistrationDevelopmentFund == []) {
                                        $getRegistrationDevelopmentFund = RegistrationDonationModel::where('status','1')->where('end_date','0000-00-00')->get()->toArray();
                                    }
                                    $totalDevelopmentFundAmount = $getRegistrationDevelopmentFund[0]['region_registration_amount'] + $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'];
                                    for ($j=2009; $j <= date('Y') ; $j++) { 
                                        $startDay   = 1;
                                        $startMonth = 4;
                                        $startDate  = strftime("%F", strtotime($j."-".$startMonth."-".$startDay));
                                        $futureDate = date('Y-m-d', strtotime('+364 day', strtotime($startDate)) );
                                        if ($regDatas[$i]['today_date'] >= $startDate && $regDatas[$i]['today_date'] <= $futureDate) {
                                            $startYear = $startDate;
                                            $endYear = $futureDate;
                                        }
                                    }
                                    $getSameYearData = RegistrationDevelopmentFundAmount::where('start_year',$startYear)->where('end_year',$endYear)->where('fk_region_id',$regDatas[$i]['fk_region_id'])->where('fk_yuva_mandal_id',$regDatas[$i]['fk_yuva_mandal_id'])->get();
                                    if (count($getSameYearData) == 0) {
                                        $y = RegistrationDevelopmentFundAmount::create([
                                            'start_year'   => $startYear,
                                            'end_year'     => $endYear,
                                            'fk_region_id' => $regDatas[$i]['fk_region_id'],
                                            'fk_yuva_mandal_id' => $regDatas[$i]['fk_yuva_mandal_id'],
                                            'total_registration'=> 1,
                                            'total_amount' => $totalDevelopmentFundAmount,
                                            'region_development_amount' => $getRegistrationDevelopmentFund[0]['region_registration_amount'],
                                            'yuva_mandal_development_amount' => $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'],
                                            'created_by'     => Auth::user()->user_id,
                                        ]);
                                    }
                                    else{
                                        $getAmount = RegistrationDevelopmentFundAmount::where('start_year',$startYear)->where('end_year',$endYear)->where('fk_region_id',$regDatas[$i]['fk_region_id'])->where('fk_yuva_mandal_id',$regDatas[$i]['fk_yuva_mandal_id'])->first();
                                        $y = RegistrationDevelopmentFundAmount::where('start_year',$startYear)->where('end_year',$endYear)->where('fk_region_id',$regDatas[$i]['fk_region_id'])->where('fk_yuva_mandal_id',$regDatas[$i]['fk_yuva_mandal_id'])->update(array(
                                            'start_year'   => $startYear,
                                            'end_year'     => $endYear,
                                            'fk_region_id' => $regDatas[$i]['fk_region_id'],
                                            'fk_yuva_mandal_id' => $regDatas[$i]['fk_yuva_mandal_id'],
                                            'total_registration'=> $getAmount['total_registration'] + 1,
                                            'total_amount' => $getAmount['total_amount'] + $totalDevelopmentFundAmount,
                                            'region_development_amount' => $getRegistrationDevelopmentFund[0]['region_registration_amount'],
                                            'yuva_mandal_development_amount' => $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'],
                                            'updated_by'     => Auth::user()->user_id,
                                        ));
                                    }
                                }
                            }


                       } 

                    }
                }                 
            }     
            
            //dd($regDatas);
            AllBankEntryDetailsModel::insert($creditInUser);
            AllBankEntryDetailsModel::insert($debitFromUser);
            AllBankEntryDetailsModel::insert($creditYsk);
            SuspenseAccountModel::where('suspense_account_id',$request->editId)->update(array(
                'status' => '3'));
            return redirect()->route('suspense-account')->with('success','Suspense Account details is added to Bank Entry Details successfully.');
          }
          else{
               AllBankEntryModel::where('all_bank_entry_id',$getBankEntryId)->delete();
               return redirect()->route('edit-suspense-account',$request->editId)->with('error','Give Proper Amount.');
          } 
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function detailsSuspenseAccount(Request $request)
    {
        $accessData = $this->getArray('suspense-account',Auth::user()->fk_role_id);
    	$detailsSuspenseAccount = SuspenseAccountModel::where('suspense_account_id',$request->suspense_account_id)
                                ->where('suspense_accounts.status','1')
        						->select('suspense_accounts.*',
                                    'ledger_accounts.legder_name',
        					       )
        					    ->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','suspense_accounts.fk_bank_id')
        					    ->first();
    	return view('admin.suspense_account_view')->with('detailsSuspenseAccount',$detailsSuspenseAccount)->with('accessData',$accessData);
    }


    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function deleteSuspenseAccount(Request $request)
    {
    	SuspenseAccountModel::where('suspense_account_id',$request->suspense_account_id)->update(array('status' => '3'));
		return redirect()->route('suspense-account')->with('success','Suspense Account Details has been deleted successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function multipleDeleteSuspenseAccount(Request $request)
    {
    	SuspenseAccountModel::whereIn('suspense_account_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Suspense Account has been deleted successfully.');
        $response = array('success'=>"1",'message'=>"Suspense Account has been deleted successfully.");
        return json_encode($response);
        exit();
    }
}
