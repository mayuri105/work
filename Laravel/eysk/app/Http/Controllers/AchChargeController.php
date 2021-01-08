<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AchChargeModel;
use Input;
use Session;
use Auth;
class AchChargeController extends Controller
{
	public function __construct(){
        $this->middleware('checkLogin');
    }
	/**
	 * @author Reshmi Das
	 * Date:10/8/2019 
	 */
    public function achCharges()
	{
	    Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$achChargesAmountData = AchChargeModel::where('status','1')->orderBy('ach_charge_id','DESC')->get();
		return view('admin.ach_charges',['achChargesAmountData' => $achChargesAmountData]);
	}

	/**
	 * @author Reshmi Das
	 * Date: 10/8/2019
	 */
	public function addAchCharges()
	{
		return view('admin.ach_charges_add');
	}

	/**
	 * @author Reshmi Das
	 * Date: 10/8/2019
	 */
	public function saveAchChargeAmount(Request $request)
	{
		$this->validate($request,[
			'ach_charges_amount' => 'required',
			'start_date' 		 => 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			 'end_date'           => 'after:start_date'
		    ]);
		    
		}
		AchChargeModel::create([
			'ach_charges_amount' => Input::get('ach_charges_amount'),
			'start_date'		 => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'			 => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'created_by'         => Auth::user()->user_id,
		]);
		return redirect()->route('ach-charges')->with('success','Ach charge amount has been added successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 10/8/2019
	 */
	public function editAchCharge(Request $request)
	{
		$editAchChargeAmountData = 	AchChargeModel::where('ach_charge_id',$request->ach_charge_id)->get();
		return view('admin.ach_charges_edit',['editAchChargeAmountData' => $editAchChargeAmountData[0]]);
	}

	/**
	 * @author Reshmi Das
	 * Date: 10/8/2019
	 */
	public function updateAchCharge(Request $request)
	{
		$this->validate($request,[
			'ach_charges_amount' => 'required',
			'start_date'		 => 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		$updateAchChargeData = AchChargeModel::where('ach_charge_id',$request->editId)->update(array('status' => '0'));
		AchChargeModel::create([
			'ach_charges_amount' => Input::get('ach_charges_amount'),
			'start_date' 		 => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'			 => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'updated_by'         => Auth::user()->user_id,
		]);
		return redirect()->route('ach-charges')->with('success','Ach charge amount has been updated successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 10/8/2019
	 */
	public function deleteAchCharge($id)
	{
		$deleteAchChargeData = AchChargeModel::where('ach_charge_id',$id)->update(array('status' => '3'));
		return redirect()->route('ach-charges')->with('success','Ach charge amount has been deleted successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 10/8/2019
	 */
	public function multipleDeleteAchCharge(Request $request)
	{
		AchChargeModel::whereIn('ach_charge_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Ach Charge Amount deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Ach charge amount deleted successfully."]);
	}
}
