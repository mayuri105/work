<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReservedFundsModel;
use Input;
use Session;
use Auth;
class ReservedFundsController extends Controller
{
	public function __construct()
    {
        $this->middleware('checkLogin');
    }
	/**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function reserveFunds()
	{
	    Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData    = $this->getArray('reserved-funds',Auth::user()->fk_role_id);
		$reserveFundsData = ReservedFundsModel::where('status','1')->orderBy('reserved_fund_id','DESC')->get();
		return view('admin.reserved_funds',['reserveFundsData' => $reserveFundsData, 'accessData' => $accessData]);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function addReserveFunds()
	{
	    $accessData    = $this->getArray('reserved-funds',Auth::user()->fk_role_id);
		return view('admin.reserved_funds_add')->with('accessData',$accessData);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function saveReserveFunds(Request $request)
	{
		$this->validate($request,[
			'percentage' => 'required|numeric|between:0,100.00',
			'start_date' => 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		ReservedFundsModel::create([
			'percentage' => Input::get('percentage'),
			'start_date' => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'   => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'created_by' => Auth::user()->user_id,
		]);
		return redirect()->route('reserve-funds')->with('success','Reserve fund has been added successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function editReserveFunds(Request $request)
	{
	    $accessData    = $this->getArray('reserved-funds',Auth::user()->fk_role_id);
		$editReserveFundsData = ReservedFundsModel::where('reserved_fund_id',$request->reserved_fund_id)->get();
		return view('admin.reserved_funds_edit',['editReserveFundsData' => $editReserveFundsData[0],'accessData' => $accessData]);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function updateReserveFunds(Request $request)
	{
		$this->validate($request,[
			'percentage' => 'required|numeric|between:0,100.00',
			'start_date' => 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		$updateReserveFundsData = ReservedFundsModel::where('reserved_fund_id',$request->editId)->update(array('status' => '0'));
		ReservedFundsModel::create([
			'percentage' => Input::get('percentage'),
			'start_date' => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'   => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'created_by' => Auth::user()->user_id,
		]);
		return redirect()->route('reserve-funds')->with('success','Reserve fund has been added successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function deleteReserveFunds($id)
	{
		$deleteAchChargeData = ReservedFundsModel::where('reserved_fund_id',$id)->update(array('status' => '3'));
		return redirect()->route('reserve-funds')->with('success','Reserve fund has been deleted successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function multipleDeleteReserveFunds(Request $request)
	{
		ReservedFundsModel::whereIn('reserved_fund_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Reserve Funds deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Reserve fund deleted successfully."]);
	}
}
