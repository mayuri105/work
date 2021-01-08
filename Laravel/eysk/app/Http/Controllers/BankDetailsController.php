<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankDetailsModel;
use App\BankNameModel;
use Input;
use Session;
class BankDetailsController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkLogin');
	}
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function bankDetails()
	{
	    Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$bankDetailsData = BankDetailsModel::where('bank_details.status','1')
						->select('bank_details.*',
							'bank_names.bank_name'
						)
						->leftJoin('bank_names','bank_names.bank_name_id','=','bank_details.fk_bank_name')
						->orderBy('bank_detail_id','DESC')->get();
		return view('admin.bank_details',['bankDetailsData' => $bankDetailsData]);
	}

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function defaultBankAccountStatus($id)
	{
		$defaultBankAccount = BankDetailsModel::where('bank_detail_id','!=',$id)->update(array('default_account' => '0'));
		$defaultBankAccountData = BankDetailsModel::where('bank_detail_id',$id)->update(array('default_account' => '1'));
		return redirect()->route('bank-details')->with('success','Status has been changed successfully');
	}

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function addBankDetails()
	{
		$bankName = BankNameModel::where('status','1')->get();
		return view('admin.bank_details_add')->with('bankName',$bankName);
	}

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function saveBankDetails(Request $request)
	{
		$this->validate($request,[
			'bank_name' 		  => 'required',
			'bank_account_type'   => 'required',
			'bank_branch' 		  => 'required',
			'bank_account_number' => 'required|alpha_num',
			'bank_ifsc_code'	  => 'required|alpha_num',
		]);
		BankDetailsModel::create([
			'fk_bank_name'		  => Input::get('bank_name'),
			'bank_account_type'	  => Input::get('bank_account_type'),
			'bank_branch' 		  => Input::get('bank_branch'),
			'bank_account_number' => Input::get('bank_account_number'),
			'bank_ifsc_code'	  => Input::get('bank_ifsc_code'),
		]);
		return redirect()->route('bank-details')->with('success','Bank details has been added successfully');
	}

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function editBankDetails(Request $request)
	{
		$bankName = BankNameModel::where('status','1')->get();
		$editBankDetailsData = BankDetailsModel::where('bank_detail_id',$request->bank_detail_id)->get();
		return view('admin.bank_details_edit')->with('editBankDetailsData',$editBankDetailsData[0])->with('bankName',$bankName);
	}

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function updateBankDeatils(Request $request)
	{
		$this->validate($request,[
			'bank_name' 		  => 'required',
			'bank_account_type'	  => 'required',
			'bank_branch'		  => 'required',
			'bank_account_number' => 'required|alpha_num',
			'bank_ifsc_code'	  => 'required|alpha_num',
		]);
		$updateBankDetailsData = BankDetailsModel::where('bank_detail_id',$request->editId)->update(array('status' => '0'));
		BankDetailsModel::create([
			'fk_bank_name' 		  => Input::get('bank_name'),
			'bank_account_type'   => Input::get('bank_account_type'),
			'bank_branch'		  => Input::get('bank_branch'),
			'bank_account_number' => Input::get('bank_account_number'),
			'bank_ifsc_code'	  => Input::get('bank_ifsc_code'),

		]);
		return redirect()->route('bank-details')->with('success','Bank details has been updated successfully');
	}

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function deleteBankDetails($id)
	{
		$deleteBankDetailsData = BankDetailsModel::where('bank_detail_id',$id)->update(array('status' => '3'));
		return redirect()->route('bank-details')->with('success','Bank details has been deleted successfully');
	}

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function multipleDeleteBankDetails(Request $request)
	{
		BankDetailsModel::whereIn('bank_detail_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Bank details deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Bank details deleted successfully."]);
	}
}
