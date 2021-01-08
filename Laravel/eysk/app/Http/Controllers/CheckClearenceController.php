<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationPaymentModel;
use App\BankChargesModel;
use App\SahyognidhiPaymentModel;
use App\RepaymentModel;
use App\RepaymentAchsModel;
use App\RepaymentAmountsModel;
use Input;
use Session;
use Auth;
use App\RegistrationModel;
use Mail;
class CheckClearenceController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkLogin');
    }


/**
    * @author Reshmi Das

     * Date:

     */

    public function checkClearence()

    {

        Session::forget('region_name');

        Session::forget('division_name');

        Session::forget('samaj_zone_name');

        Session::forget('a');

        $accessData = $this->getArray('check-clearence',Auth::user()->fk_role_id);

        $getCheckClearence = RegistrationPaymentModel::where('registration_payment_details.registration_payment_status','!=','3')

                            ->where('registration_payment_details.registration_payment_status','!=','1')

                             ->select('registration_payment_details.*',

                                'ledger_accounts.legder_name',

                                'registrations.hidden_name_as_per_yuva_sangh_org'

                            )

                             ->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','registration_payment_details.fk_reg_bank_name')

                             ->leftJoin('registrations','registrations.registration_id','=','registration_payment_details.fk_registration_id')

                             ->where('registration_payment_details.fk_reg_bank_name','!=','0')

                              ->where('registration_payment_details.status','=','0')

                             ->orderBy('registration_payment_details.registration_payment_detail_id','DESC')

                             ->get();

        $getCheckClearenceOfSahyognidhi = SahyognidhiPaymentModel::where([['sahyognidhi_payments.status','!=','3'],['sahyognidhi_payments.status','!=','1']])

                                        ->select('sahyognidhi_payments.*',

                                            'ledger_accounts.legder_name',

                                        )

                                        ->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','sahyognidhi_payments.fk_bank_id')

                                         ->orderBy('sahyognidhi_payments.sahyognidhi_payment_id','DESC')

                                        ->get();

        //dd($getCheckClearenceOfSahyognidhi->toArray());



        return view('admin.check_clearence')->with('getCheckClearence',$getCheckClearence)->with('getCheckClearenceOfSahyognidhi',$getCheckClearenceOfSahyognidhi)->with('accessData',$accessData);

    }



    /**

     * @author Reshmi Das

     * Date:

     */

    public function saveCheckClearence()

    {

        $clearenceDate = date('Y-m-d',strtotime(Input::get('check_clear_date')));

        $bankChargeDate = BankChargesModel::where('status','1')->where('end_date','0000-00-00')->first();

        if (Input::get('submit') == 'Accept') {

            if (Input::get('transaction_id') != '' && Input::get('check_clear_date') != '') {
                RegistrationPaymentModel::where('fk_registration_id',Input::get('registration_id'))->where('registration_payment_detail_id',Input::get('payment_details_id'))->update(array(
                    'registration_payment_status' => '1',

                    'check_clear_date'            => $clearenceDate,

                    'transaction_id'              => Input::get('transaction_id'),

                    'updated_by'          => Auth::user()->user_id,

                ));

                $RepaymentAmountsModel = RepaymentAmountsModel::where('fk_registration_id',Input::get('registration_id'))

               ->where('payment_completed',0)

               ->get();

               foreach ($RepaymentAmountsModel as $key => $value) {



                    $data = RepaymentModel::where('repayment_id',$value['fk_repayment_id'])->update([

                        'payment_status'=> '2',

                        'payment_completed'=> '1',

                        'status'=> '1',

                    ]);

                    $insertId  = $data['repayment_id'];



                    $RepaymentAmounts = RepaymentAmountsModel::where('repayment_amount_id',$value['repayment_amount_id'])->update([
                        'payment_status'                    =>  '2',
                        'payment_completed'                 =>  '1',
                        'cheque_clear_date'                 => $clearenceDate,
                        'fk_registration_payment_detail_id' => Input::get('payment_details_id'),
                    ]);

                }

            return redirect()->route('check-clearence')->with('success','Your check is accepted');

            }

            else{

                return redirect()->route('check-clearence')->with('error','Give all data');

            }

        }

        else{



            if ($clearenceDate >= $bankChargeDate['start_date']) {

                $bankChargeData = BankChargesModel::where('status','1')->where('end_date','=','0000-00-00')->first();

            }

            elseif($bankChargeDate['start_date'] == '' || $clearenceDate <= $bankChargeDate['start_date']){

                $bankChargeData = BankChargesModel::where('status','1')->where('start_date','<=',$clearenceDate)->where('end_date','>=',$clearenceDate)->first();

            }

            $RegistrationPaymentModelam =   RegistrationPaymentModel::where('fk_registration_id',Input::get('registration_id'))->where('registration_payment_detail_id',Input::get('payment_details_id'))->get();
            // dd( $RegistrationPaymentModelam);
                if(count($RegistrationPaymentModelam)>0){
                    $totalamountcheq =  $RegistrationPaymentModelam[0]['bank_amount'] + $bankChargeData['bank_charges_amount'];
                }
            RegistrationPaymentModel::where('fk_registration_id',Input::get('registration_id'))->where('registration_payment_detail_id',Input::get('payment_details_id'))->update(array(
                'check_bounce_amount' => $bankChargeData['bank_charges_amount'],
                'bank_amount'         => $totalamountcheq,


            ));

            $totalAmountToPay = $getRegData['registration_amount'] + $bankChargeData['bank_charges_amount'];

            $this->sendSMS1($getRegData['phone_number_first'],$getRegData['name_as_per_yuva_sangh_org'],' Your Cheque has bounced. Charges '.$bankChargeAmount,' debited.Pls pay '.$totalAmountToPay,'If any query please contact YSK Office on 7575898989');

            $user = $getRegData['email'];

            $NameAsPerYuvaSangh = strtoupper($getRegData['name_as_per_yuva_sangh_org']);

            Mail::send('emails.welcome6', ['user' => $user, 'processingId' => $processingId, 'NameAsPerYuvaSangh' => $NameAsPerYuvaSangh, 'bankChargeAmount' => $bankChargeAmount,'totalAmountToPay' => $totalAmountToPay], function ($m) use ($user,$processingId,$NameAsPerYuvaSangh,$bankChargeAmount,$totalAmountToPay) {

                    //dd($NameAsPerYuvaSangh);

                $m->from('support@yskyuvasangh.org', 'Cheque Bounce');

                $m->to($user, Input::get('name_as_per_yuva_sangh_org'))->subject('Cheque Bounce');

            });



            $RepaymentAmountsModel = RepaymentAmountsModel::where('fk_registration_id',Input::get('registration_id'))

               ->where('payment_completed',0)

               ->get();

               foreach ($RepaymentAmountsModel as $key => $value) {



                    $data = RepaymentModel::where('repayment_id',$value['fk_repayment_id'])->update([
                        'payment_status'        => '2',
                        'bounce_status'         => '2',
                        'payment_completed'     => '0',

                    ]);

                    $insertId  = $data['repayment_id'];

                    $allchequeBouns = $bankChargeData['bank_charges_amount'] +$value['Cheque_bounce'];

                    $RepaymentAmounts = RepaymentAmountsModel::where('repayment_amount_id',$value['repayment_amount_id'])->update([

                        'payment_status'    =>  '2',

                        'bounce_status'    =>  '2',

                        'payment_completed'    =>  '0',

                        'Cheque_bounce'    => $allchequeBouns,
                        'cheque_bounce_date'=> date('Y-m-d H:i:s'),
                        'fk_registration_payment_detail_id' => Input::get('payment_details_id'),

                    ]);

                }

            return redirect()->route('check-clearence')->with('error','Your check is rejected');

        }

    }



    /**

     * @author Reshmi Das

     * Date:

     */

    public function saveSahyognidhiCheckClearence()

    {

        $clearenceDate = date('Y-m-d',strtotime(Input::get('check_clear_date')));
        $transactionid = Input::get('transactionid');

        $bankChargeDate = BankChargesModel::where('status','1')->where('end_date','0000-00-00')->first();

        /*if (Input::get('submit') == 'Accept') {*/

            if (Input::get('check_clear_date') != '') {

                SahyognidhiPaymentModel::where('fk_sahyognidhi_id',Input::get('sahyognidhi_id'))->update(array(

                    'status'                => '1',

                    'cheque_clearence_date' => $clearenceDate,

                    'updated_by'          => Auth::user()->user_id,
                    'transaction_id'      => $transactionid,
                    //'transaction_id'      => Input::get('transaction_id'),

                ));

            return redirect()->route('check-clearence')->with('success','Your check is accepted');

            }

            else{

                return redirect()->route('check-clearence')->with('error','Give date');

            }

        /*}

        else{

            if ($clearenceDate >= $bankChargeDate['start_date']) {

                $bankChargeData = BankChargesModel::where('status','1')->where('end_date','=','0000-00-00')->first();

            }

            elseif($bankChargeDate['start_date'] == '' || $clearenceDate <= $bankChargeDate['start_date']){

                $bankChargeData = BankChargesModel::where('status','1')->where('start_date','<=',$clearenceDate)->where('end_date','>=',$clearenceDate)->first();

            }

            SahyognidhiPaymentModel::where('fk_sahyognidhi_id',Input::get('sahyognidhi_id'))->update(array(

                'check_bounce_amount' => $bankChargeData['bank_charges_amount'],

            ));

            return redirect()->route('check-clearence')->with('error','Your check is rejected');

        }*/

    }



    public function CheckClearanceData(Request $Request)

    {   $html = '';

        $status = Input::get('value');

        //dd($status);

        if($status == 'Registration'){

            $getCheckClearence = RegistrationPaymentModel::where('registration_payment_details.registration_payment_status','!=','3')

                            ->where('registration_payment_details.registration_payment_status','!=','1')

                             ->select('registration_payment_details.*',

                                'ledger_accounts.legder_name',

                                'registrations.hidden_name_as_per_yuva_sangh_org'

                            )

                             ->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','registration_payment_details.fk_reg_bank_name')

                             ->leftJoin('registrations','registrations.registration_id','=','registration_payment_details.fk_registration_id')

                             ->where('registration_payment_details.fk_reg_bank_name','!=','0')

                             ->where('registration_payment_details.status','=','0')

                             ->orderBy('registration_payment_details.registration_payment_detail_id','DESC')

                             ->get();



                            //dd($getCheckClearence);

            if(count($getCheckClearence)>0){

                foreach($getCheckClearence as $getCheckClearences) {

                    $html .= '<tr role="row" class="odd">

                            <td>'.$getCheckClearences->hidden_name_as_per_yuva_sangh_org .'</td>

                            <td>'.$getCheckClearences->ysk_member_bank_name .'</td>

                            <td><i class="la la-inr"></i>'.$getCheckClearences->bank_amount .'</td>

                            <td>'.$getCheckClearences->branch_name .'</td>

                            <td>'.$getCheckClearences->cheque_number.'</td>

                            <td>';

                                 $string = strip_tags($getCheckClearences->narration);

                                    if (strlen($string) > 10) {

                                        $stringCut = substr($string, 0, 10);

                                        $endPoint = strrpos($stringCut, ' ');

                                        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);

                                        $string .= '...<br/> <a href="#" title ="'.$getCheckClearences->narration.'" onclick="openModelOne()">Read More</a>';

                                    }

                                     $string;



                             $html .= ' '.$string.' <input type="hidden" id="hiddenNarration" name="hiddenNarration" value="'.$getCheckClearences->narration .'">

                                </td>

                            <td>'.$getCheckClearences->legder_name .'</td>

                            <td>';

                            if($getCheckClearences->created_at != "0000-00-00 00:00:00" && $getCheckClearences->created_at != NULL) {



                               $date =  date("d-m-Y",strtotime($getCheckClearences->created_at));



                            }

                         $html .= '  '. $date.' </td>

                            <td nowrap="" style="text-align: center;">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" onclick="openModel('.$getCheckClearences->fk_registration_id .','. $getCheckClearences->registration_payment_detail_id.')" title="Genrate YSK ID">
                                    <i class="la la-external-link"></i>

                                </a>

                            </td>

                        </tr>    ';

                }

            }

        }

        elseif($status == 'Repayment'){

            $getCheckClearence = RegistrationPaymentModel::where('registration_payment_details.registration_payment_status','!=','3')

                            ->where('registration_payment_details.registration_payment_status','!=','1')

                             ->select('registration_payment_details.*',

                                'ledger_accounts.legder_name',

                                'registrations.hidden_name_as_per_yuva_sangh_org'

                            )

                             ->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','registration_payment_details.fk_reg_bank_name')

                             ->leftJoin('registrations','registrations.registration_id','=','registration_payment_details.fk_registration_id')

                                ->where('registration_payment_details.fk_reg_bank_name','!=','0')

                             ->where('registration_payment_details.status','=','1')

                             ->orderBy('registration_payment_details.registration_payment_detail_id','DESC')

                             ->get();

                            // dd('rep');

                    if(count($getCheckClearence)>0){

                        foreach($getCheckClearence as $getCheckClearences) {

                            $html .= '<tr role="row" class="odd">

                                    <td>'.$getCheckClearences->hidden_name_as_per_yuva_sangh_org .'</td>

                                    <td>'.$getCheckClearences->ysk_member_bank_name .'</td>

                                    <td><i class="la la-inr"></i>'.$getCheckClearences->bank_amount .'</td>

                                    <td>'.$getCheckClearences->branch_name .'</td>

                                    <td>'.$getCheckClearences->cheque_number.'</td>

                                    <td>';

                                         $string = strip_tags($getCheckClearences->narration);

                                            if (strlen($string) > 10) {

                                                $stringCut = substr($string, 0, 10);

                                                $endPoint = strrpos($stringCut, ' ');

                                                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);

                                                $string .= '...<br/> <a href="#" title ="'.$getCheckClearences->narration.'" onclick="openModelOne()">Read More</a>';

                                            }

                                             $string;



                                     $html .= ' '.$string.'<input type="hidden" id="hiddenNarration" name="hiddenNarration" value="'.$getCheckClearences->narration .'">

                                        </td>

                                    <td>'.$getCheckClearences->legder_name .'</td>

                                    <td>';

                                    if($getCheckClearences->created_at != "0000-00-00 00:00:00" && $getCheckClearences->created_at != NULL) {



                                       $date =  date("d-m-Y",strtotime($getCheckClearences->created_at));



                                    }

                                 $html .= '  '. $date.' </td>

                                    <td nowrap="" style="text-align: center;">
                                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" onclick="openModel('.$getCheckClearences->fk_registration_id .','. $getCheckClearences->registration_payment_detail_id.')" title="Genrate YSK ID">
                                            <i class="la la-external-link"></i>

                                        </a>

                                    </td>

                                </tr>';

                        }

                    }

             }else{

                 $getCheckClearenceOfSahyognidhi = SahyognidhiPaymentModel::where([['sahyognidhi_payments.status','!=','3'],['sahyognidhi_payments.status','!=','1']])

                            ->select('sahyognidhi_payments.*',

                                'ledger_accounts.legder_name',

                            )

                            ->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','sahyognidhi_payments.fk_bank_id')

                             ->orderBy('sahyognidhi_payments.sahyognidhi_payment_id','DESC')

                            ->get();

                        if(count($getCheckClearenceOfSahyognidhi)>0){

                            foreach($getCheckClearenceOfSahyognidhi as $getCheckClearenceOfSahyognidhis) {

                                $html .= '<tr role="row" class="odd">

                                        <td>'. $getCheckClearenceOfSahyognidhis->payment_give_nominee_name .'</td>

                                        <td>'. $getCheckClearenceOfSahyognidhis->nominee_ysk_id .'</td>

                                        <td><i class="la la-inr"></i>'. $getCheckClearenceOfSahyognidhis->sahyognidhi_amount .'</td>

                                        <td></td>

                                        <td></td>

                                        <td>Sahyognidhi Payment</td>

                                        <td>'. $getCheckClearenceOfSahyognidhis->legder_name .'</td>

                                        <td> ';

                                        if($getCheckClearenceOfSahyognidhis->created_at != "0000-00-00 00:00:00" && $getCheckClearenceOfSahyognidhis->created_at != NULL){

                                             $date = date("d-m-Y",strtotime($getCheckClearenceOfSahyognidhis->created_at));

                                    }

                                    $html .=' '.$date.'</td>

                                        <td nowrap="" style="text-align: center;">

                                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" onclick="openModelForSahyognidhi('. $getCheckClearenceOfSahyognidhis->fk_sahyognidhi_id .')" title="Genrate YSK ID">

                                                <i class="la la-external-link"></i>

                                            </a>

                                        </td>

                                    </tr>';

                                }

                            }

                        }



           $responseData = array("success" => "1",'html'=>$html);



            echo json_encode($responseData);

            exit;

    }

}

