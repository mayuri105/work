<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;
use App\RepaymentAmountsModel;
use App\RepaymentModel;

class UserRepaymentController extends Controller
{
   public function userRepayment(Request $request)
   {
   		$id = $request->id;
   		$yskId = RegistrationModel::where('registration_id',$request->id)->first();
   		if ($yskId['ysk_id'] != '') {
   			$yskId = $yskId['ysk_id'];
   		}
   		elseif($yskId['ysk_id'] == ''){
   			$yskId = $yskId['pre_ysk_id'];
   		}
   		else{
   			dd(1);
   		}
   		$RepaymentModel = RepaymentModel::select('repayments.*','regions.region_name','regions.region_code')
                    ->leftJoin('regions','regions.region_id','=','repayments.fk_region_id')
                    ->leftJoin('repayment_amounts','repayment_amounts.ysk_id','=','repayments.ysk_id')
                    ->where('repayments.ysk_id',$yskId)
                    ->get();

        $RepaymentAmountsModel = RepaymentAmountsModel::where('ysk_id',$yskId)->where('payment_completed','0')->get();
        $RepaymentAmountsPaid = RepaymentAmountsModel::where('ysk_id',$yskId)->where('payment_completed','1')->get();
        $RepaymentAmountsHistory = RepaymentAmountsModel::where('ysk_id',$yskId)
                    ->where('payment_completed','!=','3')
                    ->select('repayment_amounts.*','registration_payment_details.*','ledger_accounts.legder_name'
                        )
                    ->leftJoin('registration_payment_details','registration_payment_details.registration_payment_detail_id','=','repayment_amounts.fk_registration_payment_detail_id')
                    ->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','repayment_amounts.fk_bank_id')
                    ->get();
        
            $registration = RegistrationModel::where('registrations.ysk_id',$yskId)
                    ->orWhere('registrations.pre_ysk_id',$yskId)
                    ->select('registrations.*',
                        'regions.region_name',
                        'regions.region_code',
                        )
                    ->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
                    ->get();
        
         //dd($RepaymentAmountsModel);
                  
         return view('admin.user_repayment')->with(['RepaymentModel' =>$RepaymentModel,'RepaymentAmountsModel' =>$RepaymentAmountsModel,'registration'=>$registration,'RepaymentAmountsPaid'=> $RepaymentAmountsPaid,'RepaymentAmountsHistory'=>$RepaymentAmountsHistory,'id' => $id]);
   		//return view('admin.user_repayment');
   }
}
