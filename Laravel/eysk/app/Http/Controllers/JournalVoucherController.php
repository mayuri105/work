<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JournalVoucherModel;
use App\JournalVoucherDetailModel;
use Input;
use Session;
use Auth;
use DB;
use Hash;

class JournalVoucherController extends Controller
{
    public function __construct()
	{
		$this->middleware('checkLogin');
	}
	
    public function JournalVoucher()
    {
        $journalvoucherData = JournalVoucherModel::where('status','1')->get();
        $accessData = $this->getArray('journal-voucher',Auth::user()->fk_role_id);
    	return view('admin.journalvoucher')->with('journalvoucherData',$journalvoucherData)->with('accessData',$accessData);
    }

    public function addJournalVoucher()
    {
        $accessData = $this->getArray('journal-voucher',Auth::user()->fk_role_id);
        
        $ledgeraccounts = DB::table('ledger_accounts')->where('status','1')->get();
        
        $registrationaccounts = DB::table('registrations')->where('status','1')->get();
                    
        $ledgeraccounts2 = DB::table('ledger_accounts')->where('status','1')->get();
        
        $getProcessingId   = JournalVoucherModel::get();
        foreach ($getProcessingId as $key => $value) {
            $journalvoucherNumber  = $value['journal_voucher_no'];
        }
        $journal_voucher_no = 0;
        if(isset($journalvoucherNumber))
        {
            $journal_voucher_no_start = substr($journalvoucherNumber, 0, 3);
            $journal_voucher_no = substr($journalvoucherNumber, 3);
        }
        $id     = $journal_voucher_no+1;
        
        $p = "Ju";

		$lanth=strlen($id);
		$journal_voucher_no='';
		switch ($lanth) 
		{
			case 1:
				$journal_voucher_no=$p."000".$id;
				break;
			case 2:
				$journal_voucher_no=$p."00".$id;
				break;
			case 3:
				$journal_voucher_no=$p."0".$id;
				break;
			case 4:
				$first=substr($id, 0,2) + 55;
				$last=substr($id, 2,2);
				$str = mb_convert_encoding($first, "ASCII", "auto");
				$ASCII = chr($str); //A
				$journal_voucher_no=$p."".$ASCII."".$last;
				break;	
		}
      
        
    	return view('admin.journal_voucher_add')->with('journal_voucher_no',$journal_voucher_no)->with('accessData',$accessData)->with('ledgeraccounts',$ledgeraccounts)->with('ledgeraccounts2',$ledgeraccounts2)->with('registrationaccounts',$registrationaccounts);
    }

    public function saveJournalVoucher(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'journal_voucher_no' => 'required',
            'fk_ledger_account_id_main' => 'required',
            'transaction_type_main' => 'required',
            'amount_main' => 'required',
            'narration_main'  => 'required',
            'fk_ledger_account_id' => 'required',
            'transaction_type'  => 'required',
            'amount'  => 'required',
            'narration' => 'required',
        ]);
        

        $fk_ledger_account_id_main1 = explode(",", Input::get('fk_ledger_account_id_main'));
        $fk_ledger_account_id_main = $fk_ledger_account_id_main1[0];
        $type_account_main = $fk_ledger_account_id_main1[1];
        

        JournalVoucherModel::create([
            'date'  => date('Y-m-d',strtotime(Input::get('date'))),
            'journal_voucher_no' => Input::get('journal_voucher_no'),
            'fk_ledger_account_id_main' => $fk_ledger_account_id_main,
            'transaction_type_main' => Input::get('transaction_type_main'),
            'amount_main' => Input::get('amount_main'),
            'narration_main' => Input::get('narration_main'),
            'type_account_main' => $type_account_main,
            'created_by' => Auth::user()->user_id,
        ]);
        $getJournalVoucherId = JournalVoucherModel::get();
        foreach ($getJournalVoucherId as $key => $value) {
            $journalVoucherId = $value['journal_voucher_id'];
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
                'fk_journal_voucher_id' => $journalVoucherId,     
                'fk_ledger_account_id'      => $fk_ledger_account_id2,
                'transaction_type'      => $transaction_type[$count1][0],
                'amount'      => $amount[$count],
                'narration'      => $narration[$count],
                'type_account' => $type_account,
                'created_by' => Auth::user()->user_id,
            );
           
             $insert_data[] = $data; 
        }
      
        JournalVoucherDetailModel::insert($insert_data);

        return redirect()->route('journal-voucher')->with('success','Journal Voucher has been added.');
    }

    public function editJournalVoucher(Request $request)
    {
        
        $accessData = $this->getArray('journal-voucher',Auth::user()->fk_role_id);
        
        $ledgeraccounts = DB::table('ledger_accounts')->where('status','1')
                    ->get();
                    
        $ledgeraccounts2 = DB::table('ledger_accounts')->where('status','1')
                    ->get();
                    
        $registrationaccounts = DB::table('registrations')->where('status','1')->get();
                    
        $editJournalVoucherData = JournalVoucherModel::where('journal_voucher_id',$request->id)->first();
        
    	$JournalVoucherdetail = JournalVoucherDetailModel::where('fk_journal_voucher_id',$request->id)->get();
    	
    	return view('admin.journal_voucher_edit')->with('editJournalVoucherData',$editJournalVoucherData)->with('JournalVoucherdetail',$JournalVoucherdetail)->with('ledgeraccounts',$ledgeraccounts)->with('ledgeraccounts2',$ledgeraccounts2)->with('registrationaccounts',$registrationaccounts)->with('accessData',$accessData);
    }

    public function updateJournalVoucher(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'journal_voucher_no' => 'required',
            'fk_ledger_account_id_main' => 'required',
            'transaction_type_main' => 'required',
            'amount_main' => 'required',
            'narration_main'  => 'required',
            'fk_ledger_account_id' => 'required',
            'transaction_type'  => 'required',
            'amount'  => 'required',
            'narration' => 'required',
        ]);
        
        $fk_ledger_account_id_main1 = explode(",", Input::get('fk_ledger_account_id_main'));
        $fk_ledger_account_id_main = $fk_ledger_account_id_main1[0];
        $type_account_main = $fk_ledger_account_id_main1[1];
        
        JournalVoucherModel::where('journal_voucher_id',$request->editId)->update(array('date'  => date('Y-m-d',strtotime(Input::get('date'))),
            'journal_voucher_no' => Input::get('journal_voucher_no'),
            'fk_ledger_account_id_main' => $fk_ledger_account_id_main,
            'transaction_type_main' => Input::get('transaction_type_main'),
            'amount_main' => Input::get('amount_main'),
            'narration_main' => Input::get('narration_main'),
            'type_account_main' => $type_account_main,
            'updated_by' => Auth::user()->user_id,));

        JournalVoucherDetailModel::where('fk_journal_voucher_id',$request->editId)->delete();
        

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
                'fk_journal_voucher_id' => $request->editId,     
                'fk_ledger_account_id'      => $fk_ledger_account_id2,
                'transaction_type'      => $transaction_type[$count1][0],
                'amount'      => $amount[$count],
                'narration'      => $narration[$count],
                'type_account'      => $type_account,
                'created_by' => Auth::user()->user_id,
            );
           
             $insert_data[] = $data; 
        }
      
        JournalVoucherDetailModel::insert($insert_data);

        
        return redirect()->route('journal-voucher')->with('success','Journal Voucher has benn updated successfully.');
    }

    public function viewJournalVoucher(Request $request)
    {
       
        $accessData = $this->getArray('journal-voucher',Auth::user()->fk_role_id);
       
        $viewJournalVoucherData = JournalVoucherModel::where('status','1')->where('journal_voucher_id',$request->id)->first();
        
        $viewJournalVoucherDataDetails = JournalVoucherDetailModel::where('status','1')->where('fk_journal_voucher_id',$request->id)->get();
        
       
        return view('admin.journal_voucher_view')->with('viewJournalVoucherData',$viewJournalVoucherData)->with('viewJournalVoucherDataDetails',$viewJournalVoucherDataDetails)->with('accessData',$accessData);
    }

    public function deleteJournalVoucher(Request $request)
    {
       JournalVoucherModel::where('journal_voucher_id',$request->id)->update(array(
            'status' => '3',
       ));
       JournalVoucherDetailModel::where('fk_journal_voucher_id',$request->id)->update(array(
            'status' => '3',
       ));

       return redirect()->route('journal-voucher')->with('success','Journal Voucher has been deleted.');
    }

    public function multipleDeleteJournalVoucher(Request $request)
    {

        JournalVoucherModel::whereIn('journal_voucher_id',explode(",",$request->ids))->update(array('status' => '3'));
        JournalVoucherDetailModel::whereIn('fk_journal_voucher_id',explode(",", $request->ids))->update(array('status' => '3'));
       
      
        Session::flash('success', 'Journal Voucher has been deleted successfully.');
        return response()->json(['status'=>true,'message'=>"Journal Voucher has been deleted successfully."]);
    }

    

}
