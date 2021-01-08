<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseTypeModel;
use Input;
use Session;
class ExpenseTypeController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkLogin');
	}
	
	/**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function expenseType()
	{
	    Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$expenseTypeData = ExpenseTypeModel::where('status','1')->orderBy('expense_type_id','DESC')->get();
		return view('admin.expense_type',['expenseTypeData' => $expenseTypeData]);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function addExpenseType()
	{
		return view('admin.expense_type_add');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function saveExpenseType(Request $request)
	{
		$this->validate($request,[
			'expense_type' => 'required',
		]);
		ExpenseTypeModel::create([
			'expense_type' => Input::get('expense_type'),
		]);
		return redirect()->route('expense-type')->with('success','Expense type has been added successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function editExpenseType(Request $request)
	{
		$editExpenseType = ExpenseTypeModel::where('expense_type_id',$request->expense_type_id)->get();
		return view('admin.expense_type_edit',['editExpenseType' => $editExpenseType[0]]);
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function updateExpenseType(Request $request)
	{
		$this->validate($request,[
			'expense_type' => 'required',
		]);
		$upExpenseType = ExpenseTypeModel::where('expense_type_id',$request->editId)->update(array('expense_type' => Input::get('expense_type')));
		return redirect()->route('expense-type')->with('success','Expense type data has been updated successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function deleteExpenseType($id)
	{
		$deleteExpenseTypeData = ExpenseTypeModel::where('expense_type_id',$id)->update(array('status' => '3'));
		return redirect()->route('expense-type')->with('success','Expense type has been deleted successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
	public function multipleDeleteExpenseType(Request $request)
	{
		ExpenseTypeModel::whereIn('expense_type_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Expense Type deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Expense type deleted successfully."]);
	}
}
