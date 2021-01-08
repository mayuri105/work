<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FixDepositModel;
use App\FixDepositDetailModel;
use Input;
use Session;
use Auth;
use DB;
use Hash;
use Illuminate\Support\Facades\Redirect;

class FixDepositController extends Controller
{
    public function __construct()
	{
		$this->middleware('checkLogin');
	}
	
    public function FixDeposit()
    {
        $fixdepositData = FixDepositModel::where('status','1')->get();
        
        $accessData = $this->getArray('fix-deposit',Auth::user()->fk_role_id);
    	return view('admin.fixdeposit')->with('fixdepositData',$fixdepositData)->with('accessData',$accessData);
    }

    public function addFixDeposit()
    {
        $accessData = $this->getArray('fix-deposit',Auth::user()->fk_role_id);
        
        $ledgeraccounts = DB::table('ledger_accounts')->where('status','1')->whereIn('fk_group_id', [14,21])
                    ->get();
        
        
        $getProcessingId   = FixDepositModel::get();
        foreach ($getProcessingId as $key => $value) {
            $fixdepositNumber  = $value['fix_deposit_no'];
        }
        $fix_deposit_no = 0;
        if(isset($fixdepositNumber))
        {
            $fix_deposit_no_start = substr($fixdepositNumber, 0, 3);
            $fix_deposit_no = substr($fixdepositNumber, 3);
        }
        $id     = $fix_deposit_no+1;
        
        $p = "FD";

		$lanth=strlen($id);
		$fix_deposit_no='';
		switch ($lanth) 
		{
			case 1:
				$fix_deposit_no=$p."000".$id;
				break;
			case 2:
				$fix_deposit_no=$p."00".$id;
				break;
			case 3:
				$fix_deposit_no=$p."0".$id;
				break;
			case 4:
				$first=substr($id, 0,2) + 55;
				$last=substr($id, 2,2);
				$str = mb_convert_encoding($first, "ASCII", "auto");
				$ASCII = chr($str); //A
				$fix_deposit_no=$p."".$ASCII."".$last;
				break;	
		}
      
        
    	return view('admin.fix_deposit_add')->with('fix_deposit_no',$fix_deposit_no)->with('accessData',$accessData)->with('ledgeraccounts',$ledgeraccounts);
    }

    public function saveFixDeposit(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'fix_deposit_no' => 'required',
            'fk_ledger_account_id' => 'required',
            'amount_main' => 'required',
            'fd_certificate_no'  => 'required',
            'fd_amount' => 'required',
            'fd_percentage'  => 'required',
            'fd_maturity_date'  => 'required',
            'fd_maturity_amount'  => 'required',
            'narration' => 'required',
        ]);
        
        $amount_main = Input::get('amount_main');
        
        $fd_amount_total = 0;
        for($count = 0; $count < count($request->fd_amount); $count++)
        {
            $fd_amount_total += $request->fd_amount[$count];
        }
        
        if($amount_main < $fd_amount_total)
        {
            return Redirect::back()->with('msg', 'Please Add Fix Deposit Amount 
            Total Less than Main Amount');
        }

        FixDepositModel::create([
            'date'  => date('Y-m-d',strtotime(Input::get('date'))),
            'fix_deposit_no' => Input::get('fix_deposit_no'),
            'fk_ledger_account_id' => Input::get('fk_ledger_account_id'),
            'amount_main' => Input::get('amount_main'),
            'created_by' => Auth::user()->user_id,
        ]);
        $getFixDepositId = FixDepositModel::get();
        foreach ($getFixDepositId as $key => $value) {
            $FixDepositId = $value['fix_deposit_id'];
        }


        $fk_fix_deposit_id = $request->fk_fix_deposit_id;
        $fd_certificate_no = $request->fd_certificate_no;
        $fd_amount = $request->fd_amount;
        $fd_percentage = $request->fd_percentage;
        $fd_maturity_date = $request->fd_maturity_date;
        $fd_maturity_amount = $request->fd_maturity_amount;
        $narration = $request->narration;
        for($count = 0; $count < count($fd_certificate_no); $count++)
        {
            
            
            $count1 = $count + 1;
            $data = array(
                'fk_fix_deposit_id' => $FixDepositId,     
                'fd_certificate_no' => $fd_certificate_no[$count],
                'narration'      => $narration[$count],
                'fd_amount'      => $fd_amount[$count],
                'fd_percentage'      => $fd_percentage[$count],
                'fd_maturity_date'      => date('Y-m-d',strtotime($fd_maturity_date[$count])),
                'fd_maturity_amount'      => $fd_maturity_amount[$count],
                'narration'      => $narration[$count],
                'created_by' => Auth::user()->user_id,
            );
           
             $insert_data[] = $data; 
        }
      
        FixDepositDetailModel::insert($insert_data);

        return redirect()->route('fix-deposit')->with('success','Fix Deposit has been added.');
    }

    public function editFixDeposit(Request $request)
    {
        
        $accessData = $this->getArray('fix-deposit',Auth::user()->fk_role_id);
        
        $ledgeraccounts = DB::table('ledger_accounts')->where('status','1')->whereIn('fk_group_id', [14,21])
                    ->get();
                    
        $editFixDepositData = FixDepositModel::where('fix_deposit_id',$request->id)->first();
        
    	$FixDepositdetail = FixDepositDetailModel::where('fk_fix_deposit_id',$request->id)->get();
    	
    	return view('admin.fix_deposit_edit')->with('editFixDepositData',$editFixDepositData)->with('FixDepositdetail',$FixDepositdetail)->with('ledgeraccounts',$ledgeraccounts)->with('accessData',$accessData);
    }

    public function updateFixDeposit(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'fix_deposit_no' => 'required',
            'fk_ledger_account_id' => 'required',
            'amount_main' => 'required',
            'fd_certificate_no'  => 'required',
            'fd_amount' => 'required',
            'fd_percentage'  => 'required',
            'fd_maturity_date'  => 'required',
            'fd_maturity_amount'  => 'required',
            'narration' => 'required',
        ]);
        
        $amount_main = Input::get('amount_main');
        
        $fd_amount_total = 0;
        for($count = 0; $count < count($request->fd_amount); $count++)
        {
            $fd_amount_total += $request->fd_amount[$count];
        }
        
        if($amount_main < $fd_amount_total)
        {
            return Redirect::back()->with('msg', 'Please Add Fix Deposit Amount 
            Total Less than Main Amount');
        }
        
        FixDepositModel::where('fix_deposit_id',$request->editId)->update(array('date'  => date('Y-m-d',strtotime(Input::get('date'))),
            'fix_deposit_no' => Input::get('fix_deposit_no'),
            'fk_ledger_account_id' => Input::get('fk_ledger_account_id'),
            'amount_main' => Input::get('amount_main'),
            'updated_by' => Auth::user()->user_id,));

        FixDepositDetailModel::where('fk_fix_deposit_id',$request->editId)->delete();
        

        $fk_fix_deposit_id = $request->fk_fix_deposit_id;
        $fd_certificate_no = $request->fd_certificate_no;
        $fd_amount = $request->fd_amount;
        $fd_percentage = $request->fd_percentage;
        $fd_maturity_date =  $request->fd_maturity_date;
        $fd_maturity_amount = $request->fd_maturity_amount;
        $narration = $request->narration;
        
        for($count = 0; $count < count($fd_certificate_no); $count++)
        {
            
            $count1 = $count + 1;
            $data = array(
                'fk_fix_deposit_id' => $request->editId,     
                'fd_certificate_no'      => $fd_certificate_no[$count],
                'fd_amount'      => $fd_amount[$count],
                'fd_percentage'      => $fd_percentage[$count],
                'fd_maturity_date'      =>  date('Y-m-d',strtotime($fd_maturity_date[$count])),
                'fd_maturity_amount'      => $fd_maturity_amount[$count],
                'narration'      => $narration[$count],
                'created_by' => Auth::user()->user_id,
            );
           
             $insert_data[] = $data; 
        }
      
        FixDepositDetailModel::insert($insert_data);

        
        return redirect()->route('fix-deposit')->with('success','Fix Deposit has benn updated successfully.');
    }

    public function viewFixDeposit(Request $request)
    {
       
        $accessData = $this->getArray('fix-deposit',Auth::user()->fk_role_id);
       
        $viewFixDepositData = FixDepositModel::where('status','1')->where('fix_deposit_id',$request->id)->first();
        
        $viewFixDepositDataDetails = FixDepositDetailModel::where('status','1')->where('fk_fix_deposit_id',$request->id)->get();
        
       
        return view('admin.fix_deposit_view')->with('viewFixDepositData',$viewFixDepositData)->with('viewFixDepositDataDetails',$viewFixDepositDataDetails)->with('accessData',$accessData);
    }

    public function deleteFixDeposit(Request $request)
    {
       FixDepositModel::where('fix_deposit_id',$request->id)->update(array(
            'status' => '3',
       ));
       FixDepositDetailModel::where('fk_fix_deposit_id',$request->id)->update(array(
            'status' => '3',
       ));

       return redirect()->route('fix-deposit')->with('success','Fix Deposit has been deleted.');
    }

    public function multipleDeleteFixDeposit(Request $request)
    {

        FixDepositModel::whereIn('fix_deposit_id',explode(",",$request->ids))->update(array('status' => '3'));
        FixDepositDetailModel::whereIn('fk_fix_deposit_id',explode(",", $request->ids))->update(array('status' => '3'));
       
      
        Session::flash('success', 'Fix Deposit has been deleted successfully.');
        return response()->json(['status'=>true,'message'=>"Fix Deposit has been deleted successfully."]);
    }

    

}
