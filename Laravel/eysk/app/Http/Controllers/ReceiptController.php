<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReceiptModel;
use App\ReceiptDetailModel;
use Input;
use Session;
use Auth;
use DB;
use Hash;
use Illuminate\Support\Facades\Redirect;


class ReceiptController extends Controller
{
    public function __construct()
	{
		$this->middleware('checkLogin');
	}
	
    public function Receipt()
    {
        //$receiptData = ReceiptModel::where('status','1')->get();
       /* $receiptData = ReceiptModel::where('receipt.status','1')
    					->select('receipt.*',
    						'ledger_accounts.legder_name'
    					)
    					->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','receipt.fk_ledger_account_id_main')
    					->orderBy('receipt.receipt_id','DESC')
    					->get();*/
    					
    	$receiptData = ReceiptDetailModel::where('receipt_detail.status','1')
    					->select('receipt.*',
    						'ledger_accounts.legder_name','receipt_detail.amount'
    					)
    					->leftJoin('receipt','receipt.receipt_id','=','receipt_detail.fk_receipt_id')
    					->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','receipt_detail.fk_ledger_account_id')
    					->where('receipt.status','1')
    					->orderBy('receipt_detail.receipt_detail_id','DESC')
    					->get();
        
        
        $accessData = $this->getArray('receipt',Auth::user()->fk_role_id);
    	return view('admin.receipt')->with('receiptData',$receiptData)->with('accessData',$accessData);
    }

    public function addReceipt()
    {
        $accessData = $this->getArray('receipt',Auth::user()->fk_role_id);
       
        
        $ledgeraccounts = DB::table('ledger_accounts')->where('status','1')->whereIn('fk_group_id', [14,21])
                    ->get();
                    
        $ledgeraccounts2 = DB::table('ledger_accounts')->where('status','1')->whereNotIn('fk_group_id', [14,21])
                    ->get();
        
        $getProcessingId   = ReceiptModel::get();
        foreach ($getProcessingId as $key => $value) {
            $receiptNumber  = $value['receipt_voucher_no'];
        }
        $receipt_no = 0;
        if(isset($receiptNumber))
        {
            $receipt_no_start = substr($receiptNumber, 0, 3);
            $receipt_no = substr($receiptNumber, 3);
        }
        $id     = $receipt_no+1;
        
        $p = "Rec";

		$lanth=strlen($id);
		$receipt_no='';
		switch ($lanth) 
		{
			case 1:
				$receipt_no=$p."000".$id;
				break;
			case 2:
				$receipt_no=$p."00".$id;
				break;
			case 3:
				$receipt_no=$p."0".$id;
				break;
			case 4:
				$first=substr($id, 0,2) + 55;
				$last=substr($id, 2,2);
				$str = mb_convert_encoding($first, "ASCII", "auto");
				$ASCII = chr($str); //A
				$receipt_no=$p."".$ASCII."".$last;
				break;	
		}
      
        
    	return view('admin.receipt_add')->with('receipt_no',$receipt_no)->with('accessData',$accessData)->with('ledgeraccounts',$ledgeraccounts)->with('ledgeraccounts2',$ledgeraccounts2);
    }

    public function saveReceipt(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'receipt_voucher_no' => 'required',
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
        
      
        ReceiptModel::create([
            'date'  => date('Y-m-d',strtotime(Input::get('date'))),
            'receipt_voucher_no' => Input::get('receipt_voucher_no'),
            'fk_ledger_account_id_main' => Input::get('fk_ledger_account_id_main'),
            'transaction_type_main' => Input::get('transaction_type_main'),
            'amount_main' => Input::get('amount_main'),
            'narration_main' => Input::get('narration_main'),
            'created_by' => Auth::user()->user_id,
        ]);
        $getReceiptId = ReceiptModel::get();
        foreach ($getReceiptId as $key => $value) {
            $receiptId = $value['receipt_id'];
        }


        $fk_ledger_account_id = $request->fk_ledger_account_id;
        $transaction_type = $request->transaction_type;
     /*  print_r($transaction_type);
       exit();*/
        $amount = $request->amount;
        $narration = $request->narration;
        for($count = 0; $count < count($fk_ledger_account_id); $count++)
        {
            
            $count1 = $count + 1;
            $data = array(
                'fk_receipt_id' => $receiptId,     
                'fk_ledger_account_id'      => $fk_ledger_account_id[$count],
                'transaction_type'      => $transaction_type[$count1][0],
                'amount'      => $amount[$count],
                'created_by' => Auth::user()->user_id,
            );
           
             $insert_data[] = $data; 
        }
      
        ReceiptDetailModel::insert($insert_data);

        return redirect()->route('receipt')->with('success','Receipt has been added.');
    }

    public function editReceipt(Request $request)
    {
        $accessData = $this->getArray('receipt',Auth::user()->fk_role_id);
        
        $ledgeraccounts = DB::table('ledger_accounts')->where('status','1')->whereIn('fk_group_id', [14,21])
                    ->get();
                    
        $ledgeraccounts2 = DB::table('ledger_accounts')->where('status','1')->whereNotIn('fk_group_id', [14,21])
                    ->get();
                    
        $editReceiptData = ReceiptModel::where('receipt_id',$request->id)->first();
        
    	$receiptdetail = ReceiptDetailModel::where('fk_receipt_id',$request->id)->get();
    	
    	return view('admin.receipt_edit')->with('editReceiptData',$editReceiptData)->with('receiptdetail',$receiptdetail)->with('ledgeraccounts',$ledgeraccounts)->with('ledgeraccounts2',$ledgeraccounts2)->with('accessData',$accessData);
    }

    public function updateReceipt(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'receipt_voucher_no' => 'required',
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
        
        ReceiptModel::where('receipt_id',$request->editId)->update(array('date'  => date('Y-m-d',strtotime(Input::get('date'))),
            'receipt_voucher_no' => Input::get('receipt_voucher_no'),
            'fk_ledger_account_id_main' => Input::get('fk_ledger_account_id_main'),
            'transaction_type_main' => Input::get('transaction_type_main'),
            'amount_main' => Input::get('amount_main'),
            'narration_main' => Input::get('narration_main'),
            'updated_by'  => Auth::user()->user_id));

        ReceiptDetailModel::where('fk_receipt_id',$request->editId)->delete();
        

        $fk_ledger_account_id = $request->fk_ledger_account_id;
        $transaction_type = $request->transaction_type;
     
        $amount = $request->amount;
        $narration = $request->narration;
        for($count = 0; $count < count($fk_ledger_account_id); $count++)
        {
            
            $count1 = $count + 1;
            $data = array(
                'fk_receipt_id' => $request->editId,     
                'fk_ledger_account_id'      => $fk_ledger_account_id[$count],
                'transaction_type'      => $transaction_type[$count1][0],
                'amount'      => $amount[$count],
                'created_by' => Auth::user()->user_id,
            );
           
             $insert_data[] = $data; 
        }
      
        ReceiptDetailModel::insert($insert_data);

        
        return redirect()->route('receipt')->with('success','Receipt has benn updated successfully.');
    }

    public function viewReceipt(Request $request)
    {
        $accessData = $this->getArray('receipt',Auth::user()->fk_role_id);
       /* $viewReceiptData = ReceiptModel::where('receipt_id',$request->id)->first();*/
        
        $viewReceiptData = ReceiptModel::where('receipt.status','1')
    					->select('receipt.*',
    						'ledger_accounts.legder_name'
    					)
    					->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','receipt.fk_ledger_account_id_main')
    					->where('receipt.receipt_id',$request->id)
    					->orderBy('receipt.receipt_id','DESC')
    					->first();
        
        //$viewReceiptDataDetails = ReceiptDetailModel::where('fk_receipt_id',$request->id)->get();
        
        $viewReceiptDataDetails = ReceiptDetailModel::where('receipt_detail.status','1')
    					->select('receipt_detail.*',
    						'ledger_accounts.legder_name'
    					)
    					->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','receipt_detail.fk_ledger_account_id')
    					->where('receipt_detail.fk_receipt_id',$request->id)
    					->orderBy('receipt_detail.receipt_detail_id','DESC')
    					->get();
        
        return view('admin.receipt_view')->with('viewReceiptData',$viewReceiptData)->with('viewReceiptDataDetails',$viewReceiptDataDetails)->with('accessData',$accessData);
    }

    public function deleteReceipt(Request $request)
    {
       ReceiptModel::where('receipt_id',$request->id)->update(array(
            'status' => '3',
       ));
       ReceiptDetailModel::where('fk_receipt_id',$request->id)->update(array(
            'status' => '3',
       ));

       return redirect()->route('receipt')->with('success','Receipt has been deleted.');
    }

    public function multipleDeleteReceipt(Request $request)
    {
        ReceiptModel::whereIn('receipt_id',explode(",",$request->ids))->update(array('status' => '3'));
        ReceiptDetailModel::whereIn('fk_receipt_id',explode(",", $request->ids))->update(array('status' => '3'));
       
      
        Session::flash('success', 'Receipt has been deleted successfully.');
        return response()->json(['status'=>true,'message'=>"Receipt has been deleted successfully."]);
    }

    
}
