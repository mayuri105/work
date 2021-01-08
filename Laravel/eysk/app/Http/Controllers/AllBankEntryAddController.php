<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankNameModel;
use App\BehalfOfPaymentModel;
use App\AllBankEntryDetailsModel;
use App\AllBankEntryModel;
use App\ExpenseTypeModel;
use App\RegistrationModel;
use Input;
use App\SuspenseAccountModel;
use App\CheckbounceModel;
use App\RepaymentModel;
use App\LockingPeriodModel;
use App\RepaymentAmountsModel;
use Session;
use DB;
use App\DivangatAmountModel;
use App\LedgerAccountModel;
use App\NomineeDetailsModel;
use App\RegistrationPaymentModel;
use App\RegistrationUploadDocumentModel;
use App\RegistrationDonationModel;
use App\RegistrationDevelopmentFundAmount;
use Auth;
use Mail;


class AllBankEntryAddController extends Controller
{
    
    public function __construct(){
        $this->middleware('checkLogin');
    }

    /**
     * @author Reshmi Das
     * Date: 
     */
    public function allBankEntry()
    {
        Session::forget('region_name');
        Session::forget('division_name');
        Session::forget('samaj_zone_name');
        $accessData = $this->getArray('all-bank-entry',Auth::user()->fk_role_id);
        $getAllBankEntry = AllBankEntryModel::where('all_bank_entry.status','1')
                           ->select('all_bank_entry.*',
                            'ledger_accounts.legder_name',
                            'registrations.ysk_id',
                            'registrations.pre_ysk_id',
                            'all_bank_entry_details.fk_behalf_of_payment_id',
                        )
                        ->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','all_bank_entry.fk_bank_id')
                        ->leftJoin('all_bank_entry_details','all_bank_entry_details.fk_all_bank_entry_id','=','all_bank_entry.all_bank_entry_id')
                        ->leftJoin('registrations','registrations.registration_id','=','all_bank_entry.ledger_account')
                        ->groupBy('all_bank_entry.all_bank_entry_id')
                        ->orderBy('all_bank_entry.all_bank_entry_id','DESC')
                        ->get();
        if (count($getAllBankEntry->toArray()) == '0') {
            $getTotalAmount = '0000';
        }
        else{
            foreach ($getAllBankEntry as $key) {
                $totalAmount[] = $key->amount;
            }
            $getTotalAmount = array_sum($totalAmount);
        }

        $sbiAmount = AllBankEntryModel::where('status','1')->where('fk_bank_id','14')->get()->toArray();
        if (count($sbiAmount) == '0') {
            $totalSbiAmount = '0000';
        }
        else{
            foreach ($sbiAmount as $key => $value) {
                $sbiMoney[]  = $value['amount'];
            }
            $totalSbiAmount = array_sum($sbiMoney);
        }
        
        $hdfcAmount = AllBankEntryModel::where('status','1')->where('fk_bank_id','23')->get()->toArray();
        if (count($hdfcAmount) == '0') {
            $totalHdfcAmount = '0000';
        }
        else{
            foreach ($hdfcAmount as $key => $value) {
                $hdfcMoney[] = $value['amount'];
            }
            $totalHdfcAmount = array_sum($hdfcMoney);
        }

        return view('admin.all_bank_entry')->with('getAllBankEntry',$getAllBankEntry)->with('accessData',$accessData);
    }


    /**
     * @author Reshmi Das
     * Date: 
     */
    public function addAllBankEntry()
    {
        $accessData = $this->getArray('all-bank-entry',Auth::user()->fk_role_id);
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
                    ->whereNotIn('registration_id', $registrationId)
                    ->where('registrations.status','!=','3')
                    ->get();
        $a = 0;
        $bankName         = LedgerAccountModel::where('fk_group_id','14')->get();
        $ledgerAccount    = DB::table('groups')->where('group_name','<>','Suspense Account')->where('group_name','<>','Sundry Creditors')->where('status','1')->get();
       $sunCreaditorData = RegistrationModel::where([['registrations.status','!=','3'],['registrations.status','!=','7'],['registrations.status','!=','8']])
                            ->select('registrations.*',
                                'ysk_transfer.*',
                                'regions.region_name',
                                'regions.region_code',
                            )
                            ->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
                            ->leftJoin('ysk_transfer','ysk_transfer.fk_registration_id','=','registrations.registration_id')
                            ->get();
                       //  dd($sunCreaditorData);
        foreach ($sunCreaditorData as $key => $valueall) {
            $total = array();
            
            $RepaymentAmountsModel = RepaymentAmountsModel::where('fk_registration_id',$valueall['registration_id'])
            ->where('payment_completed',0)
            ->get();
            if(count($RepaymentAmountsModel)>0){

                foreach ($RepaymentAmountsModel as $key => $value) {

                    $total[] = $value['repayment_amount'] + $value['delay_charge'] ;
                }
                $finaltotal = array_sum($total);
                $finaltotall[] =$finaltotal + $RepaymentAmountsModel[0]['Cheque_bounce']+$RepaymentAmountsModel[0]['ach_bounce'];
            }else{
                $finaltotall[] = 0;
            }
            
        }
         //dd($finaltotall);
        $behalfOfPayment  = BehalfOfPaymentModel::get();
        return view('admin.all_bank_entry_add')->with('bankName',$bankName)->with('behalfOfPayment',$behalfOfPayment)->with('registrationIdData',$registrationIdData)->with('sunCreaditorData',$sunCreaditorData)->with('finaltotall',$finaltotall)->with('accessData',$accessData);
    }


    /**
     * @author Reshmi Das
     * Date: 
     */
    public function getRegistrationAmount(Request $request)
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
    public function getDivangatAmountByRedId()
    {
        $divangatAmount = DivangatAmountModel::where('status','1')->where('fk_registration_id',Input::get('fk_registration_id'))->first();
        $responseData = array('success' => '1','html_data' => $divangatAmount['divangat_amount']);
        echo json_encode($responseData);
        exit;
    }

    /**
     * @author Reshmi Das
     * Date: 
     */
    public function saveBankEntry(Request $request)
    {
        $this->validate($request,[
            'today_date'            =>   'required',
            'fk_bank_id'            =>   'required',
            'payment_type'          =>   'required',
            'amount'                =>   'required',
            'payment_mode'          =>   'required',
        ]); 
        if (Input::get('ledger_account_id') == 'Suspense Account') {
            SuspenseAccountModel::create([
                'date'           =>  date('Y-m-d',strtotime(Input::get('today_date'))),
                'fk_bank_id'     =>  Input::get('fk_bank_id'),
                'payment_type'   =>  Input::get('payment_type'),
                //'ledger_account' =>  Input::get('ledger_account'),
                'amount'         =>  Input::get('total_amount'),
                'cheque_number'  =>  Input::filled('cheque_number')? Input::get('cheque_number'):'',
                'transaction_id' =>  Input::filled('transaction_id')? Input::get('transaction_id'):'',
                'details'        =>  Input::filled('details')? strtoupper(Input::get('details')):'',
                'payment_mode'   =>  Input::get('payment_mode'),
                'created_by'     => Auth::user()->user_id,
            ]);
            return redirect()->route('add-all-bank-entry')->with('success','Bank Entry has been added to Suspense Account successfully.');
        }
        else{            
            Session::put('a', Input::get('fk_bank_id'));
            AllBankEntryModel::create([
                'payment_date'   =>  date('Y-m-d',strtotime(Input::get('today_date'))),
                'fk_bank_id'     =>  Input::get('fk_bank_id'),
                'payment_type'   =>  Input::get('payment_type'),
                'ledger_account' =>  Input::get('ledger_account_id'),
                'amount'         =>  Input::get('total_amount'),
                'cheque_number'  =>  Input::filled('cheque_number')? Input::get('cheque_number'):'',
                'transaction_id' =>  Input::filled('transaction_id')? Input::get('transaction_id'):'',
                'details'        =>  Input::filled('details')? strtoupper(Input::get('details')):'',
                'payment_mode'   =>  Input::get('payment_mode'),
                'created_by'     => Auth::user()->user_id,
            ]);
            $getId = AllBankEntryModel::get();
            foreach ($getId as $key => $value) {
                $getBankEntryId  = $value['all_bank_entry_id'];
                $registration_id = $value['ledger_account'];
            }
            $creditInUser[] = array(
                'fk_all_bank_entry_id'    => $getBankEntryId,
                'fk_registration_id'      => Input::get('ledger_account_id'),
                'ysk_entry'               => '0',
                'payment_type'            => Input::get('payment_type'),
                'amount'                  => Input::get('total_amount'),
                //'fk_behalf_of_payment_id' => Input::get('ledger_account_id'),
                'created_at'              => date('Y-m-d H:i:s'),
                'created_by'              => Auth::user()->user_id,
            );
            $debitFromUser[] = array(
                'fk_all_bank_entry_id'    => $getBankEntryId,
                'fk_registration_id'      => Input::get('ledger_account_id'),
                'ysk_entry'               => '0',
                'payment_type'            => 'Debit',
                'amount'                  => Input::get('total_amount'),
                //'fk_behalf_of_payment_id' => Input::get('ledger_account'),
                'created_at'              => date('Y-m-d H:i:s'),
                'created_by'              => Auth::user()->user_id,
            );
            $creditYsk[] = array(
                'fk_all_bank_entry_id'    => $getBankEntryId,
                'ysk_entry'               => '1',
                'payment_type'            => Input::get('payment_type'),
                'amount'                  => Input::get('total_amount'),
                //'fk_behalf_of_payment_id' => Input::get('ledger_account'),
                'created_at'              => date('Y-m-d H:i:s'),
                'created_by'              => Auth::user()->user_id,
            );
            $regDate = date('Y-m-d',strtotime(Input::get('today_date')));
            $registrationDate = RegistrationModel::where('status','!=','3')->where('registration_id',Input::get('ledger_account_id'))->first()->toArray();
            $nomineeData = NomineeDetailsModel::where('fk_registration_id',Input::get('ledger_account_id'))->first()->toArray(); 
            $regData = RegistrationModel::orderBy('pre_ysk_id','ASC')->get();
            foreach ($regData as $key => $value) {
                $preYsk  = $value['pre_ysk_id'];
            } 

             $RepaymentAmountsModel = RepaymentAmountsModel::where('fk_registration_id',Input::get('ledger_account_id'))
               ->where('payment_completed',0)
               ->get();
               $paymentStatus=0;
               foreach ($RepaymentAmountsModel as $key => $value) {
                    if(Input::get('payment_mode')=='Cash Deposit')
                    {
                       $paymentStatus = 4;  
                    }
                    if(Input::get('payment_mode')=='NEFT / RTGS')
                    {
                       $paymentStatus = 5;  
                    }
                    if(Input::get('payment_mode')=='Cheque')
                    {
                       $paymentStatus = 2;  
                    }
                    if(Input::get('payment_mode')=='Online')
                    {
                       $paymentStatus = 3;  
                    }

                    $data = RepaymentModel::where('repayment_id',$value['fk_repayment_id'])->update([
                        'payment_status'=> $paymentStatus,
                        'payment_completed'=> '1',
                        'status'=> '1',
                        'updated_by'          => Auth::user()->user_id,
                    ]);
                    

                    $RepaymentAmounts = RepaymentAmountsModel::where('repayment_amount_id',$value['repayment_amount_id'])->update([
                        'payment_status'    =>  $paymentStatus, 
                        'payment_completed'    =>  '1',
                        'updated_by'          => Auth::user()->user_id,
                       
                    ]);  
                }
            $profilePhoto = RegistrationUploadDocumentModel::where('fk_registration_id',$registration_id)->where('upload_registration_documnet_status','1')->first();
            $aadharPhoto  = RegistrationUploadDocumentModel::where('fk_registration_id',$registration_id)->where('upload_registration_documnet_status','3')->first();
            
            if ($registrationDate['status'] == '6' && $registrationDate['ysk_date'] == '0000-00-00') {
                if ($registrationDate['family_id'] != '' && $registrationDate['member'] != '' && $registrationDate['name_as_per_yuva_sangh_org'] != '' && $aadharPhoto != '' && $registrationDate['date_of_birth'] != '' && $registrationDate['age'] != '' && $registrationDate['gender'] != '' && $registrationDate['country'] != '' && ($registrationDate['fk_state_id'] != '' && $registrationDate['fk_district_id'] != '' && $registrationDate['fk_city_id'] != '') || ($registrationDate['overseas_state'] != '' && $registrationDate['overseas_city'] != '') && $registrationDate['pincode'] != '' && $registrationDate['home_address'] != '' && $registrationDate['registration_amount'] != '' && $registrationDate['phone_number_first'] != '' && $registrationDate['fk_region_id'] != '' && $registrationDate['fk_samaj_zone_id'] != '' && $registrationDate['fk_yuva_mandal_id'] != '' && $profilePhoto != '' && $registrationDate['aadhar_card_number'] != '' && $nomineeData['first_nominee_name'] != '' && $nomineeData['second_nominee_name'] != '') {
                        RegistrationModel::where('registration_id',Input::get('ledger_account_id'))->update(array(
                            'ysk_date'  => $regDate,
                            'updated_by'=> Auth::user()->user_id,
                        ));
                $StaringDate = $registrationDate['date_of_birth'];
                        $newEndingDate = date("d-m-Y", strtotime(date("d-m-Y", strtotime($StaringDate)) . " + 18year"));

                        //$this->sendSMS($registrationDate['phone_number_first'],'Hello '.$registrationDate['name_as_per_yuva_sangh_org'],'As you are Minor, YSK Membership will be activated on '.$newEndingDate);
                        
                        if($registrationDate['email'] != ''){
                            $user = $registrationDate['email'];
                            $NameAsPerYuvaSangh = strtoupper($registrationDate['name_as_per_yuva_sangh_org']);
                            Mail::send('emails.welcome1', ['user' => $user, 'newEndingDate' => $newEndingDate, 'NameAsPerYuvaSangh' => $NameAsPerYuvaSangh], function ($m) use ($user,$NameAsPerYuvaSangh,$newEndingDate) {
                                //dd($NameAsPerYuvaSangh);
                                $m->from('support@eysk.org', 'Minor Account');
                                $m->to($user, Input::get('name_as_per_yuva_sangh_org'))->subject('Minor Account');
                            });
                        }
                        
               
                }
            }
            else{
                if ($registrationDate['ysk_confirmation_date'] == '0000-00-00' && $registrationDate['ysk_date'] == '0000-00-00' && $registrationDate['status'] != '6') {
                    if ($nomineeData['second_nominee_name'] != '' && $nomineeData['first_nominee_name'] != '' && $registrationDate['family_id'] != '' && $registrationDate['member'] != '' && $registrationDate['name_as_per_yuva_sangh_org'] != '' && $aadharPhoto != '' && $registrationDate['date_of_birth'] != '' && $registrationDate['age'] != '' && $registrationDate['gender'] != '' && $registrationDate['country'] != '' && ($registrationDate['fk_state_id'] != '' && $registrationDate['fk_district_id'] != '' && $registrationDate['fk_city_id'] != '') || ($registrationDate['overseas_state'] != '' && $registrationDate['overseas_city'] != '') && $registrationDate['pincode'] != '' && $registrationDate['home_address'] != '' && $registrationDate['registration_amount'] != '' && $registrationDate['phone_number_first'] != '' && $registrationDate['fk_region_id'] != '' && $registrationDate['fk_samaj_zone_id'] != '' && $registrationDate['fk_yuva_mandal_id'] != '' && $profilePhoto != '' && $registrationDate['aadhar_card_number'] != '') {

                        $lockingendDate = LockingPeriodModel::where('status','1')->where('end_date','=','0000-00-00')->get();
                        if ($regDate >= $lockingendDate[0]['start_date']) {
                            $lockingPeriodData = LockingPeriodModel::where('status','1')->where('end_date','=','0000-00-00')->first();
                        }
                        else{
                            $lockingPeriodData = LockingPeriodModel::where('status','1')->where('start_date','<=',$regDate)->where('end_date','>=',$regDate)->first();
                        }
                        if ($registrationDate['fk_existing_disease'] == '') {
                            $lockingPeriodDays = date('Y-m-d', strtotime($regDate . '+ '.$lockingPeriodData['locking_days'].'days'));
                        }
                        else{
                            $lockingPeriodDays = date('Y-m-d', strtotime($regDate . '+ '.$lockingPeriodData['disease_days'].'days'));;
                        }
                        if ($registrationDate['age'] >= '18' && $registrationDate['ysk_id'] == '') {
                            $preYskId = $preYsk+1;
                            $confirmationDate = $lockingPeriodDays;
                            RegistrationModel::where('registration_id',Input::get('ledger_account_id'))->update(array(
                                'ysk_date'              => $regDate,
                                'ysk_confirmation_date' => $lockingPeriodDays,
                                'pre_ysk_id'            => $preYsk+1,
                                'status'                => '1',
                                'updated_by'          => Auth::user()->user_id,
                            ));
                            NomineeDetailsModel::where('fk_registration_id',Input::get('ledger_account_id'))->update(array(
                                'fk_registration_default_status' => '1',
                                'updated_by'          => Auth::user()->user_id,
                            ));
                            RegistrationPaymentModel::where('fk_registration_id',Input::get('ledger_account_id'))->update(array(
                                'registration_payment_status' => '1',
                                'updated_by'          => Auth::user()->user_id,
                            ));
                            
                            //$this->sendSMS($registrationDate['phone_number_first'],'Welcome to YSK Family, Your YSK ID is '.$preYskId,' Your risk cover will start after '.date('d-m-Y',strtotime($confirmationDate)));
                            
                            if($registrationDate['email'] != ''){
                                $user = $registrationDate['email'];
                                $NameAsPerYuvaSangh = strtoupper($registrationDate['name_as_per_yuva_sangh_org']);
                                Mail::send('emails.welcome2', ['user' => $user, 'preYskId' => $preYskId, 'NameAsPerYuvaSangh' => $NameAsPerYuvaSangh, 'confirmationDate' => date('d-m-Y',strtotime($confirmationDate))], function ($m) use ($user,$preYskId,$NameAsPerYuvaSangh,$confirmationDate) {
                                    //dd($NameAsPerYuvaSangh);
                                    $m->from('support@eysk.org', 'Ysk Confirmation Date');
                                    $m->to($user, Input::get('name_as_per_yuva_sangh_org'))->subject('Ysk Confirmation Date');
                                });
                            }
                            
                            
                            
                            $getRegistrationDevelopmentFund = RegistrationDonationModel::where('status','1')->where('start_date','<=',$registrationDate['today_date'])->where('end_date','>=',$registrationDate['today_date'])->get()->toArray();
                            if ($getRegistrationDevelopmentFund == []) {
                                $getRegistrationDevelopmentFund = RegistrationDonationModel::where('status','1')->where('end_date','0000-00-00')->get()->toArray();
                            }
                            $totalDevelopmentFundAmount = $getRegistrationDevelopmentFund[0]['region_registration_amount'] + $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'];
                            for ($i=2009; $i <= date('Y') ; $i++) { 
                                $startDay   = 1;
                                $startMonth = 4;
                                $startDate  = strftime("%F", strtotime($i."-".$startMonth."-".$startDay));
                                $futureDate = date('Y-m-d', strtotime('+364 day', strtotime($startDate)) );
                                if ($registrationDate['today_date'] >= $startDate && $registrationDate['today_date'] <= $futureDate) {
                                    $startYear = $startDate;
                                    $endYear = $futureDate;
                                }
                            }
                            $getSameYearData = RegistrationDevelopmentFundAmount::where('start_year',$startYear)->where('end_year',$endYear)->where('fk_region_id',$registrationDate['fk_region_id'])->where('fk_yuva_mandal_id',$registrationDate['fk_yuva_mandal_id'])->get();
                            if (count($getSameYearData) == 0) {
                                $y = RegistrationDevelopmentFundAmount::create([
                                    'start_year'   => $startYear,
                                    'end_year'     => $endYear,
                                    'total_amount' => $totalDevelopmentFundAmount,
                                    'fk_region_id' => $registrationDate['fk_region_id'],
                                    'fk_yuva_mandal_id' => $registrationDate['fk_yuva_mandal_id'],
                                    'total_registration'=> 1,
                                    'region_development_amount' => $getRegistrationDevelopmentFund[0]['region_registration_amount'],
                                    'yuva_mandal_development_amount' => $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'],
                                    'created_by'          => Auth::user()->user_id,
                                ]);
                            }
                            else{
                                $getAmount = RegistrationDevelopmentFundAmount::where('start_year',$startYear)->where('end_year',$endYear)->where('fk_region_id',$registrationDate['fk_region_id'])->where('fk_yuva_mandal_id',$registrationDate['fk_yuva_mandal_id'])->first();
                                $y = RegistrationDevelopmentFundAmount::where('start_year',$startYear)->where('end_year',$endYear)->where('fk_region_id',$registrationDate['fk_region_id'])->where('fk_yuva_mandal_id',$registrationDate['fk_yuva_mandal_id'])->update(array(
                                    'start_year'   => $startYear,
                                    'end_year'     => $endYear,
                                    'fk_region_id' => $registrationDate['fk_region_id'],
                                    'fk_yuva_mandal_id' => $registrationDate['fk_yuva_mandal_id'],
                                    'total_registration'=> $getAmount['total_registration'] + 1,
                                    'total_amount' => $getAmount['total_amount'] + $totalDevelopmentFundAmount,
                                    'region_development_amount' => $getRegistrationDevelopmentFund[0]['region_registration_amount'],
                                    'yuva_mandal_development_amount' => $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'],
                                    'updated_by'          => Auth::user()->user_id,
                                ));
                            }
                        }
                        if ($registrationDate['ysk_id'] != '') {
                            $confirmationDate = $lockingPeriodDays;
                            RegistrationModel::where('registration_id',Input::get('ledger_account_id'))->update(array(
                                'ysk_date'              => $regDate,
                                'ysk_confirmation_date' => $lockingPeriodDays,
                                'status'                => '1',
                                'updated_by'            => Auth::user()->user_id,
                            ));
                            NomineeDetailsModel::where('fk_registration_id',Input::get('ledger_account_id'))->update(array(
                                'fk_registration_default_status' => '1',
                                'updated_by'            => Auth::user()->user_id,
                            ));
                            RegistrationPaymentModel::where('fk_registration_id',Input::get('ledger_account_id'))->update(array(
                                'registration_payment_status' => '1',
                                'updated_by'            => Auth::user()->user_id,
                            ));
                            
                            //$this->sendSMS($registrationDate['phone_number_first'],'Welcome to YSK Family, Your YSK ID is '.$registrationDate['ysk_id'],' Your risk cover will start after '.date('d-m-Y',strtotime($confirmationDate)));
                            
                            if($registrationDate['email'] != ''){
                                $user = $registrationDate['email'];
                                $NameAsPerYuvaSangh = strtoupper($registrationDate['name_as_per_yuva_sangh_org']);
                                Mail::send('emails.welcome2', ['user' => $user, 'preYskId' => $registrationDate['ysk_id'], 'NameAsPerYuvaSangh' => $NameAsPerYuvaSangh, 'confirmationDate' => date('d-m-Y',strtotime($confirmationDate))], function ($m) use ($user,$preYskId,$NameAsPerYuvaSangh,$confirmationDate) {
                                    //dd($NameAsPerYuvaSangh);
                                    $m->from('support@eysk.org', 'Ysk Confirmation Date');
                                    $m->to($user, Input::get('name_as_per_yuva_sangh_org'))->subject('Ysk Confirmation Date');
                                });
                            }
                            
                            
                            $getRegistrationDevelopmentFund = RegistrationDonationModel::where('status','1')->where('start_date','<=',$registrationDate['today_date'])->where('end_date','>=',$registrationDate['today_date'])->get()->toArray();
                            if ($getRegistrationDevelopmentFund == []) {
                                $getRegistrationDevelopmentFund = RegistrationDonationModel::where('status','1')->where('end_date','0000-00-00')->get()->toArray();
                            }
                            $totalDevelopmentFundAmount = $getRegistrationDevelopmentFund[0]['region_registration_amount'] + $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'];
                            for ($i=2009; $i <= date('Y') ; $i++) { 
                                $startDay   = 1;
                                $startMonth = 4;
                                $startDate  = strftime("%F", strtotime($i."-".$startMonth."-".$startDay));
                                $futureDate = date('Y-m-d', strtotime('+364 day', strtotime($startDate)) );
                                if ($registrationDate['today_date'] >= $startDate && $registrationDate['today_date'] <= $futureDate) {
                                    $startYear = $startDate;
                                    $endYear = $futureDate;
                                }
                            }
                            $getSameYearData = RegistrationDevelopmentFundAmount::where('start_year',$startYear)->where('end_year',$endYear)->where('fk_region_id',$registrationDate['fk_region_id'])->where('fk_yuva_mandal_id',$registrationDate['fk_yuva_mandal_id'])->get();
                            if (count($getSameYearData) == 0) {
                                $y = RegistrationDevelopmentFundAmount::create([
                                    'start_year'   => $startYear,
                                    'end_year'     => $endYear,
                                    'fk_region_id' => $registrationDate['fk_region_id'],
                                    'fk_yuva_mandal_id' => $registrationDate['fk_yuva_mandal_id'],
                                    'total_registration'=> 1,
                                    'total_amount' => $totalDevelopmentFundAmount,
                                    'region_development_amount' => $getRegistrationDevelopmentFund[0]['region_registration_amount'],
                                    'yuva_mandal_development_amount' => $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'],
                                    'created_by'          => Auth::user()->user_id,
                                ]);
                            }
                            else{
                                $getAmount = RegistrationDevelopmentFundAmount::where('start_year',$startYear)->where('end_year',$endYear)->where('fk_region_id',$registrationDate['fk_region_id'])->where('fk_yuva_mandal_id',$registrationDate['fk_yuva_mandal_id'])->first();
                                $y = RegistrationDevelopmentFundAmount::where('start_year',$startYear)->where('end_year',$endYear)->where('fk_region_id',$registrationDate['fk_region_id'])->where('fk_yuva_mandal_id',$registrationDate['fk_yuva_mandal_id'])->update(array(
                                    'start_year'   => $startYear,
                                    'end_year'     => $endYear,
                                    'fk_region_id' => $registrationDate['fk_region_id'],
                                    'fk_yuva_mandal_id' => $registrationDate['fk_yuva_mandal_id'],
                                    'total_registration'=> $getAmount['total_registration'] + 1,
                                    'total_amount' => $getAmount['total_amount'] + $totalDevelopmentFundAmount,
                                    'region_development_amount' => $getRegistrationDevelopmentFund[0]['region_registration_amount'],
                                    'yuva_mandal_development_amount' => $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'],
                                    'updated_by'          => Auth::user()->user_id,
                                ));
                            }
                        }
                    }
                }
            }
                
            AllBankEntryDetailsModel::insert($creditInUser);
            AllBankEntryDetailsModel::insert($debitFromUser);
            AllBankEntryDetailsModel::insert($creditYsk);

         return redirect()->route('add-all-bank-entry')->with('success','Bank Entry has been added successfully.');     
        }
    }


    /**
     * @author Reshmi Das
     * Date: 
     */
    public function viewAllBankEntry(Request $request)
    {
        $accessData = $this->getArray('all-bank-entry',Auth::user()->fk_role_id);
        $getAllBankEntry = AllBankEntryModel::where('all_bank_entry_id',$request->all_bank_entry_id)
            ->where('all_bank_entry.status','1')
            ->select('all_bank_entry.*',
                'all_bank_entry_details.fk_registration_id',
                'all_bank_entry_details.fk_behalf_of_payment_id',
                'all_bank_entry_details.ysk_entry',
                'ledger_accounts.legder_name',
            )
            ->leftJoin('all_bank_entry_details','all_bank_entry_details.fk_all_bank_entry_id','=','all_bank_entry.all_bank_entry_id')
            ->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','all_bank_entry.fk_bank_id')
            ->first();

            $getAllBankEntryDetails = AllBankEntryDetailsModel::where('all_bank_entry_details.status','1')->where('all_bank_entry_details.fk_all_bank_entry_id',$request->all_bank_entry_id)
            ->select('all_bank_entry_details.*',
                'registrations.name_as_per_yuva_sangh_org',
                'registrations.pre_ysk_id',
                'registrations.ysk_id',
            )
            ->leftJoin('registrations','registrations.registration_id','=','all_bank_entry_details.fk_registration_id')
            ->get();
            $getAllBankEntryDetails1 = AllBankEntryDetailsModel::where('all_bank_entry_details.status','1')->where('all_bank_entry_details.fk_all_bank_entry_id',$request->all_bank_entry_id)
            ->select('all_bank_entry_details.*',
                'registrations.name_as_per_yuva_sangh_org',
                'registrations.pre_ysk_id',
                'registrations.ysk_id',
            )
            ->leftJoin('registrations','registrations.registration_id','=','all_bank_entry_details.fk_registration_id')
            ->groupBy('registrations.pre_ysk_id','registrations.ysk_id')
            ->get();
        return view('admin.all_bank_entry_view')->with('getAllBankEntry',$getAllBankEntry)->with('getAllBankEntryDetails',$getAllBankEntryDetails)->with('getAllBankEntryDetails1',$getAllBankEntryDetails1)->with('accessData',$accessData);
    }

    /**
     * @author Reshmi Das
     * Date: 
     */
    public function deleteAllBankEntry(Request $request)
    {
       AllBankEntryModel::where('all_bank_entry_id',$request->all_bank_entry_id)->delete();
       AllBankEntryDetailsModel::where('fk_all_bank_entry_id',$request->all_bank_entry_id)->delete();
       return redirect()->route('all-bank-entry')->with('success','Bank Entry has been deleted successfully.');
    }

    /**
     * @author Reshmi Das
     * Date: 
     */
    public function multipleDeleteAllBankEntry(Request $request)
    {
        AllBankEntryModel::whereIn('all_bank_entry_id',explode(",",$request->ids))->delete();
        AllBankEntryDetailsModel::whereIn('fk_all_bank_entry_id',explode(",",$request->ids))->delete();

        Session::flash('success', 'Bank Entries have been deleted successfully.');
        $response = array('success'=>"1",'message'=>"Bank Entries have been deleted successfully.");
        return json_encode($response);
        exit();
    }

    public function sessionDestroy()
    {
        Session::forget('a');
        return redirect()->route('all-bank-entry');
    }

}
