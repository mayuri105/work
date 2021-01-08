<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankChargesModel;
use Input;
use Auth;
use Session;
class BankChargeController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkLogin');
	}
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function bankCharges()
	{
	    Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('bank-ach-charges',Auth::user()->fk_role_id);
		$bankChargesData = BankChargesModel::where('status','1')->orderBy('bank_charges_id','DESC')->get();
		return view('admin.bank_charges',['bankChargesData' => $bankChargesData, 'accessData' => $accessData]);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function addBankCharges()
	{
	    $accessData = $this->getArray('bank-ach-charges',Auth::user()->fk_role_id);
		return view('admin.bank_charges_add')->with('accessData',$accessData);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function saveBankCharges(Request $request)
	{
		$this->validate($request,[
			'bank_charges_amount' => 'required',
			'start_date'		  => 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		BankChargesModel::create([
			'bank_charges_amount' => Input::get('bank_charges_amount'),
			'start_date'		  => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'			  => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'created_by'          => Auth::user()->user_id,
		]);
		return redirect()->route('bank-charge')->with('success','Bank charge amount has been added successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function editBankCharge(Request $request)
	{
	    $accessData = $this->getArray('bank-ach-charges',Auth::user()->fk_role_id);
		$editBankChargedata = BankChargesModel::where('bank_charges_id',$request->bank_charges_id)->get();
		return view('admin.bank_charges_edit',['editBankChargedata' => $editBankChargedata[0],'accessData' => $accessData]);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function updateBankCharge(Request $request)
	{
		$this->validate($request,[
			'bank_charges_amount' => 'required',
			'start_date'		  => 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		$updateBankChargeData = BankChargesModel::where('bank_charges_id',$request->editId)->update(array('status' => '0'));
		BankChargesModel::create([
			'bank_charges_amount' => Input::get('bank_charges_amount'),
			'start_date'          => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'			  => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'updated_by'          => Auth::user()->user_id,
		]);
		return redirect()->route('bank-charge')->with('success','Bank charge amount has been updated successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function deleteBankCharge($id)
	{
		$deleteBankDetailsData = BankChargesModel::where('bank_charges_id',$id)->update(array('status' => '3'));
		return redirect()->route('bank-charge')->with('success','Bank charge amount has been deleted successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function multipleDeleteBankCharge(Request $request)
	{
		BankChargesModel::whereIn('bank_charges_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Bank charge amount has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Bank charge amount deleted successfully."]);
	}
}
