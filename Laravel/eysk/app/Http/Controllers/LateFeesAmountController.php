<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LateFeesAmountModel;
use Input;
use Session;
use Auth;
class LateFeesAmountController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkLogin');
	}
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function lateFeesAmount()
    {
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('late-fees-amount',Auth::user()->fk_role_id);
    	$lateFeesAmount = LateFeesAmountModel::where('status','1')->orderBy('late_fees_amount_id','DESC')->get();
    	return view('admin.late_fees_amount')->with('lateFeesAmount',$lateFeesAmount)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function addLateFeesAmount()
    {
        $accessData = $this->getArray('late-fees-amount',Auth::user()->fk_role_id);
    	return view('admin.late_fees_amount_add')->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function saveLateFeesAmount(Request $request)
    {
    	$this->validate($request,[
			'start_date' 			=> 'required',
			'late_fees_days' 		=> 'required',
			'late_fees_charges' 	=> 'required',
			'grace_days' 			=> 'required',
			'grace_period_charges' 	=> 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		LateFeesAmountModel::create([
			'start_date'		 	=> date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'			 	=> Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'late_fees_days'		=> Input::get('late_fees_days'),
			'late_fees_charges'		=> Input::get('late_fees_charges'),
			'grace_days'			=> Input::get('grace_days'),
			'grace_period_charges'	=> Input::get('grace_period_charges'),
			'created_by'            => Auth::user()->user_id,
		]);
		return redirect()->route('late-fees-amount')->with('success','Late Fees Amount has been added successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function editLateFeesAmount(Request $request)
    {
        $accessData = $this->getArray('late-fees-amount',Auth::user()->fk_role_id);
    	$editLateFeesAmount = LateFeesAmountModel::where('late_fees_amount_id',$request->late_fees_amount_id)->first();
    	return view('admin.late_fees_amount_edit')->with('editLateFeesAmount',$editLateFeesAmount)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function updateLateFeesAmount(Request $request)
    {
    	$this->validate($request,[
			'start_date' 			=> 'required',
			'late_fees_days' 		=> 'required',
			'late_fees_charges' 	=> 'required',
			'grace_days' 			=> 'required',
			'grace_period_charges' 	=> 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		LateFeesAmountModel::where('late_fees_amount_id',$request->editId)->update(array('status' => '0'));
		LateFeesAmountModel::create([
			'start_date'		 	=> date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'			 	=> Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'late_fees_days'		=> Input::get('late_fees_days'),
			'late_fees_charges'		=> Input::get('late_fees_charges'),
			'grace_days'			=> Input::get('grace_days'),
			'grace_period_charges'	=> Input::get('grace_period_charges'),
			'updated_by'            => Auth::user()->user_id,
		]);
		return redirect()->route('late-fees-amount')->with('success','Late Fees Amount has been updated successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function deleteLateFeesAmount(Request $request)
    {
		LateFeesAmountModel::where('late_fees_amount_id',$request->late_fees_amount_id)->update(array('status' => '3'));
		return redirect()->route('late-fees-amount')->with('success','Late Fees Amount has been deleted successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function multipleDeleteLateFeesAmount(Request $request)
    {
    	LateFeesAmountModel::whereIn('late_fees_amount_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Late Fees Amount has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Late Fees Amount has been deleted successfully."]);
    }

}
