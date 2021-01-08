<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LockingPeriodModel;
use Input;
use Session;
use Auth;
class LockingPeriodController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkLogin');
	}
     /**
	 * @author Reshmi Das
	 * Date: 
	 */
	 public function lockingPeriod()
	 {
	    Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('locking-period',Auth::user()->fk_role_id);
	 	$lockingPeriod = LockingPeriodModel::where('status','1')->orderBy('locking_period_id','DESC')->get();
	 	return view('admin.locking_period')->with('lockingPeriod',$lockingPeriod)->with('accessData',$accessData);
	 }

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	 public function addLockingPeriod()
	 {
	    $accessData = $this->getArray('locking-period',Auth::user()->fk_role_id);
	 	return view('admin.locking_period_add')->with('accessData',$accessData);
	 }

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	 public function saveLockingPeriod(Request $request)
	 {
	 	$this->validate($request,[
			'start_date' 		 => 'required',
			'locking_days'	     => 'required',
			'disease_days'	     => 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		LockingPeriodModel::create([
			'start_date'		 => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'			 => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'locking_days'		 => Input::get('locking_days'),
			'disease_days'		 => Input::get('disease_days'),
			'created_by'         => Auth::user()->user_id,
		]);
		return redirect()->route('locking-period')->with('success','Locking Period has been added successfully');
	 }

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	 public function editLockingPeriod(Request $request)
	 {
	    $accessData = $this->getArray('locking-period',Auth::user()->fk_role_id);
	 	$editLockingPeriod = LockingPeriodModel::where('locking_period_id',$request->locking_period_id)->first();
	 	return view('admin.locking_period_edit')->with('editLockingPeriod',$editLockingPeriod)->with('accessData',$accessData);
	 }

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	 public function updateLockingPeriod(Request $request)
	 {
	 	$this->validate($request,[
			'start_date' 		 => 'required',
			'locking_days'		 => 'required',
			'disease_days'		 => 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		LockingPeriodModel::where('locking_period_id',$request->editId)->update(array('status' => '0'));
		LockingPeriodModel::create([
			'start_date'		 => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'			 => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'locking_days'		 => Input::get('locking_days'),
			'disease_days'		 => Input::get('disease_days'),
			'updated_by'         => Auth::user()->user_id,
		]);
		return redirect()->route('locking-period')->with('success','Locking Period has been updated successfully');
	 }

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	 public function deleteLockingPeriod(Request $request)
	 {
		LockingPeriodModel::where('locking_period_id',$request->locking_period_id)->update(array('status' => '3'));
		return redirect()->route('locking-period')->with('success','Locking Period has been deleted successfully');
	 }

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	 public function multipleDeleteLockingPeriod(Request $request)
	 {
	 	LockingPeriodModel::whereIn('locking_period_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Locking Period has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Locking Period has been deleted successfully."]);
	 }
}
