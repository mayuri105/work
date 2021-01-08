<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentModel;
use App\PaymentDetailModel;
use Input;
use Session;
use Auth;
use DB;
use Hash;
use Illuminate\Support\Facades\Redirect;


class PaymentController extends Controller
{
    public function __construct()
	{
		$this->middleware('checkLogin');
	}
	
    public function Payment()
    {
       // $paymentData = PaymentModel::where('status','1')->get();
        
        $paymentData = PaymentDetailModel::where('payment_detail.status','1')
    					->select('payment.*',
    						'ledger_accounts.legder_name','payment_detail.amount','payment_detail.type_account','payment_detail.fk_ledger_account_id'
    					)
    					->leftJoin('payment','payment.payment_id','=','payment_detail.fk_payment_id')
    					->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','payment_detail.fk_ledger_account_id')
    					->leftJoin('registrations','registrations.registration_id','=','payment_detail.fk_ledger_account_id')
    					->where('payment.status','1')
    					->orderBy('payment_detail.payment_detail_id','DESC')
    					->get();
        
        
        $accessData = $this->getArray('payment',Auth::user()->fk_role_id);
    	return view('admin.payment')->with('paymentData',$paymentData)->with('accessData',$accessData);
    }

    public function addPayment()
    {
        $accessData = $this->getArray('payment',Auth::user()->fk_role_id);
       
        
        $ledgeraccounts = DB::table('ledger_accounts')->where('status','1')->get();
        
        $registrationaccounts = DB::table('registrations')->where('status','1')->get();
                    
        $ledgeraccounts2 = DB::table('ledger_accounts')->where('status','1')->get();
        
        $getProcessingId   = PaymentModel::get();
        foreach ($getProcessingId as $key => $value) {
            $paymentNumber  = $value['payment_no'];
        }
        $payment_no = 0;
        if(isset($paymentNumber))
        {
            $payment_no_start = substr($paymentNumber, 0, 3);
            $payment_no = substr($paymentNumber, 3);
        }
        $id     = $payment_no+1;
        
        $p = "Pay";

		$lanth=strlen($id);
		$payment_no='';
		switch ($lanth) 
		{
			case 1:
				$payment_no=$p."000".$id;
				break;
			case 2:
				$payment_no=$p."00".$id;
				break;
			case 3:
				$payment_no=$p."0".$id;
				break;
			case 4:
				$first=substr($id, 0,2) + 55;
				$last=substr($id, 2,2);
				$str = mb_convert_encoding($first, "ASCII", "auto");
				$ASCII = chr($str); //A
				$payment_no=$p."".$ASCII."".$last;
				break;	
		}
      
        
    	return view('admin.payment_add')->with('payment_no',$payment_no)->with('accessData',$accessData)->with('ledgeraccounts',$ledgeraccounts)->with('ledgeraccounts2',$ledgeraccounts2)->with('registrationaccounts',$registrationaccounts);
    }

    public function savePayment(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'payment_no' => 'required',
            'fk_ledger_account_id_main' => 'required',
            'transaction_type_main' => 'required',
            'amount_main' => 'required',
            'narration_main'  => 'required',
            'fk_ledger_account_id' => 'required',
            'transaction_type'  => 'required',
            'amount'  => 'required',
        ]);
        
        $amount_main = Input::get('amount_main');
        
        $amount_total = 0;
        for($count = 0; $count < count($request->amount); $count++)
        {
            $amount_total += $request->amount[$count];
        }
        
        if($amount_main < $amount_total)
        {
            return Redirect::back()->with('msg', 'Please Add Amount 
            Total Less than Main Amount');
        }
        

        $fk_ledger_account_id_main1 = explode(",", Input::get('fk_ledger_account_id_main'));
        $fk_ledger_account_id_main = $fk_ledger_account_id_main1[0];
        $type_account_main = $fk_ledger_account_id_main1[1];
        

        PaymentModel::create([
            'date'  => date('Y-m-d',strtotime(Input::get('date'))),
            'payment_no' => Input::get('payment_no'),
            'fk_ledger_account_id_main' => $fk_ledger_account_id_main,
            'transaction_type_main' => Input::get('transaction_type_main'),
            'amount_main' => Input::get('amount_main'),
            'narration_main' => Input::get('narration_main'),
            'type_account_main' => $type_account_main,
            'created_by' => Auth::user()->user_id,
        ]);
        $getPaymentId = PaymentModel::get();
        foreach ($getPaymentId as $key => $value) {
            $paymentId = $value['payment_id'];
        }


        $fk_ledger_account_id = $request->fk_ledger_account_id;
        $transaction_type = $request->transaction_type;
        $amount = $request->amount;
        $narration = $request->narration;
        for($count = 0; $count < count($transaction_type); $count++)
        {
            
            $fk_ledger_account_id2 = substr($fk_ledger_account_id[$count], 0, -2);
            
            $fk_ledger_account_id1 = explode(",", $fk_ledger_account_id[$count]);
            
            //print_r($fk_ledger_account_id1);
            
            $type_account = $fk_ledger_account_id1[1];
            
            $count1 = $count + 1;
            $data = array(
                'fk_payment_id' => $paymentId,     
                'fk_ledger_account_id'      => $fk_ledger_account_id2,
                'transaction_type'      => $transaction_type[$count1][0],
                'amount'      => $amount[$count],
                'type_account' => $type_account,
                'created_by' => Auth::user()->user_id,
            );
           
             $insert_data[] = $data; 
        }
      
        PaymentDetailModel::insert($insert_data);

        return redirect()->route('payment')->with('success','Payment has been added.');
    }

    public function editPayment(Request $request)
    {
        $accessData = $this->getArray('payment',Auth::user()->fk_role_id);
        
        $ledgeraccounts = DB::table('ledger_accounts')->where('status','1')
                    ->get();
                    
        $ledgeraccounts2 = DB::table('ledger_accounts')->where('status','1')
                    ->get();
                    
        $registrationaccounts = DB::table('registrations')->where('status','1')->get();
                    
        $editPaymentData = PaymentModel::where('payment_id',$request->id)->first();
        
    	$paymentdetail = PaymentDetailModel::where('fk_payment_id',$request->id)->get();
    	
    	return view('admin.payment_edit')->with('editPaymentData',$editPaymentData)->with('paymentdetail',$paymentdetail)->with('ledgeraccounts',$ledgeraccounts)->with('ledgeraccounts2',$ledgeraccounts2)->with('registrationaccounts',$registrationaccounts)->with('accessData',$accessData);
    }

    public function updatePayment(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'payment_no' => 'required',
            'fk_ledger_account_id_main' => 'required',
            'transaction_type_main' => 'required',
            'amount_main' => 'required',
            'narration_main'  => 'required',
            'fk_ledger_account_id' => 'required',
            'transaction_type'  => 'required',
            'amount'  => 'required',
        ]);
        
        
        $amount_main = Input::get('amount_main');
        
        $amount_total = 0;
        for($count = 0; $count < count($request->amount); $count++)
        {
            $amount_total += $request->amount[$count];
        }
        
        if($amount_main < $amount_total)
        {
            return Redirect::back()->with('msg', 'Please Add Amount 
            Total Less than Main Amount');
        }
        
        
        $fk_ledger_account_id_main1 = explode(",", Input::get('fk_ledger_account_id_main'));
        $fk_ledger_account_id_main = $fk_ledger_account_id_main1[0];
        $type_account_main = $fk_ledger_account_id_main1[1];
        
        PaymentModel::where('payment_id',$request->editId)->update(array('date'  => date('Y-m-d',strtotime(Input::get('date'))),
            'payment_no' => Input::get('payment_no'),
            'fk_ledger_account_id_main' => $fk_ledger_account_id_main,
            'transaction_type_main' => Input::get('transaction_type_main'),
            'amount_main' => Input::get('amount_main'),
            'narration_main' => Input::get('narration_main'),
            'type_account_main' => $type_account_main,
            'updated_by' => Auth::user()->user_id,));

        PaymentDetailModel::where('fk_payment_id',$request->editId)->delete();
        

        $fk_ledger_account_id = $request->fk_ledger_account_id;
        $transaction_type = $request->transaction_type;
     
        $amount = $request->amount;
        $narration = $request->narration;
        for($count = 0; $count < count($fk_ledger_account_id); $count++)
        {
            
            $fk_ledger_account_id2 = substr($fk_ledger_account_id[$count], 0, -2);
            
            $fk_ledger_account_id1 = explode(",", $fk_ledger_account_id[$count]);
            
            //print_r($fk_ledger_account_id1);
            
            $type_account = $fk_ledger_account_id1[1];
            
            
            $count1 = $count + 1;
            $data = array(
                'fk_payment_id' => $request->editId,     
                'fk_ledger_account_id'      => $fk_ledger_account_id2,
                'transaction_type'      => $transaction_type[$count1][0],
                'amount'      => $amount[$count],
                'type_account'      => $type_account,
                'created_by' => Auth::user()->user_id,
            );
           
             $insert_data[] = $data; 
        }
      
        PaymentDetailModel::insert($insert_data);

        
        return redirect()->route('payment')->with('success','Payment has benn updated successfully.');
    }

    public function viewPayment(Request $request)
    {
        $accessData = $this->getArray('payment',Auth::user()->fk_role_id);
       
        $viewPaymentData = PaymentModel::where('status','1')->where('payment_id',$request->id)->first();
        
        $viewPaymentDataDetails = PaymentDetailModel::where('status','1')->where('fk_payment_id',$request->id)->get();
        
       
        return view('admin.payment_view')->with('viewPaymentData',$viewPaymentData)->with('viewPaymentDataDetails',$viewPaymentDataDetails)->with('accessData',$accessData);
    }

    public function deletePayment(Request $request)
    {
       PaymentModel::where('payment_id',$request->id)->update(array(
            'status' => '3',
       ));
       PaymentDetailModel::where('fk_payment_id',$request->id)->update(array(
            'status' => '3',
       ));

       return redirect()->route('payment')->with('success','Payment has been deleted.');
    }

    public function multipleDeletePayment(Request $request)
    {
        PaymentModel::whereIn('payment_id',explode(",",$request->ids))->update(array('status' => '3'));
        PaymentDetailModel::whereIn('fk_payment_id',explode(",", $request->ids))->update(array('status' => '3'));
       
      
        Session::flash('success', 'Payment has been deleted successfully.');
        return response()->json(['status'=>true,'message'=>"Payment has been deleted successfully."]);
    }

    
}
