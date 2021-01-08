<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IncomeTypeModel;
use Input;
use Session;
class IncomeTypeController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkLogin');
	}
	/**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function incomeType()
	{
	    Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$incomeTypeData = IncomeTypeModel::where('status','1')->orderBy('income_type_id','DESC')->get();
		return view('admin.income_types',['incomeTypeData' => $incomeTypeData]);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function addIncomeType()
	{
		return view('admin.income_type_add');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function saveIncomeType( Request $request)
	{
		$this->validate($request,[
			'income_type' => 'required',
		]);
		IncomeTypeModel::create([
			'income_type' => Input::get('income_type'),
		]);
		return redirect()->route('income-type')->with('success','Income type has been added successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function editIncomeType(Request $request)
	{
		$editIncomeTypeData = IncomeTypeModel::where('income_type_id',$request->income_type_id)->get();
		return view('admin.income_type_edit',['editIncomeTypeData' => $editIncomeTypeData[0]]);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function updateIncomeType(Request $request)
	{
		$this->validate($request,[
			'income_type' => 'required',
		]);
		$upIncomeType = IncomeTypeModel::where('income_type_id',$request->editId)->update(array('status' => '0'));
		IncomeTypeModel::create([
			'income_type' => Input::get('income_type'),
		]);
		return redirect()->route('income-type')->with('success','Income type has been updated successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function deleteIncomeType($id)
	{
		$deleteIncomeTypeData = IncomeTypeModel::where('income_type_id',$id)->update(array('status' => '3'));
		return redirect()->route('income-type')->with('success','Income type has been deleted successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function multipleDeleteIncomeType(Request $request)
	{
		IncomeTypeModel::whereIn('income_type_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Income Type deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Income type deleted successfully."]);
	}
}
