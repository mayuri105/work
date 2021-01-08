<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Input;
use App\RegistrationFeesModel;
use Auth;
class RegistrationFeesController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkLogin');
	}
	/**
	 * @author Purvesh Patel
	 * Date: 5 August 2019 11:00 AM
	 */
    public function registrationFees(){
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData    = $this->getArray('registration-fees',Auth::user()->fk_role_id);
		$registrationFeesData = RegistrationFeesModel::where('status','1')->orderBy('registration_fees_id','DESC')->get();
		return view('admin.registration_fees',['registrationFeesData' => $registrationFeesData, 'accessData' =>$accessData]);
	}


	/**
	 * @author Purvesh Patel
	 * Date: 5 August 2019 11:15 AM
	 */
	public function addRegistrationFees(){
	    $accessData    = $this->getArray('registration-fees',Auth::user()->fk_role_id);
		return view('admin.registration_fees_add')->with('accessData',$accessData);
	}


	/**
	 * @author Purvesh Patel
	 * Date: 5 August 2019 11:25 AM 
	 */
	public function saveRegistrationFees(Request $request){
		$this->validate($request,[
			'start_date' 	=> 'required|date',
			'end_date' 		=> 'required|date',
			'start_age1' 	=> 'required|numeric',
			'end_age1' 		=> 'required|numeric|gt:start_age1',
			'fees_amount1' 	=> 'required|regex:/^\d+(\.\d{1,2})?$/',
			'start_age2' 	=> 'required|numeric|gt:end_age1',
			'end_age2' 		=> 'required|numeric|gt:start_age2',
			'fees_amount2' 	=> 'required|regex:/^\d+(\.\d{1,2})?$/',
			'start_age3' 	=> 'required|numeric|gt:end_age2',
			'end_age3' 		=> 'required|numeric|gt:start_age3',
			'fees_amount3' 	=> 'required|regex:/^\d+(\.\d{1,2})?$/',
			'start_age4' 	=> 'required|numeric|gt:end_age3',
			'end_age4' 		=> 'required|numeric|gt:start_age4',
			'fees_amount4' 	=> 'required|regex:/^\d+(\.\d{1,2})?$/',
		]);
		RegistrationFeesModel::create([
            'start_date' 	=> date("Y-m-d",strtotime(Input::get('start_date'))),
			'end_date' 		=> date("Y-m-d",strtotime(Input::get('end_date'))),
			'start_age1' 	=> Input::get('start_age1'),
			'end_age1' 		=> Input::get('end_age1'),
			'fees_amount1' 	=> Input::get('fees_amount1'),
			'start_age2' 	=> Input::get('start_age2'),
			'end_age2' 		=> Input::get('end_age2'),
			'fees_amount2' 	=> Input::get('fees_amount2'),
			'start_age3' 	=> Input::get('start_age3'),
			'end_age3' 		=> Input::get('end_age3'),
			'fees_amount3' 	=> Input::get('fees_amount3'),
			'start_age4' 	=> Input::get('start_age4'),
			'end_age4' 		=> Input::get('end_age4'),
			'fees_amount4' 	=> Input::get('fees_amount4'),
			'created_by' 	=> Auth::user()->user_id,
        ]);
		return redirect()->route('registration-fees')->with('success','Registration fees has been added successfully');
	}


	/**
	 * @author Purvesh Patel
	 * Date: 5 August 2019 12:45 PM
	 */
	public function editRegistrationFees(Request $request){
	    $accessData    = $this->getArray('registration-fees',Auth::user()->fk_role_id);
		$editRegistrationFeesData = RegistrationFeesModel::where('registration_fees_id',$request->registration_fees_id)->get();
		return view('admin.registration_fees_edit',['editRegistrationFeesData' => $editRegistrationFeesData[0],'accessData' => $accessData]);
	}


	/**
	 * @author Purvesh Patel
	 * Date: 5 August 2019 11:25 AM
	 */
	public function updateRegistrationFees(Request $request)
	{
		$this->validate($request,[
			'start_date' 	=> 'required|date',
			'end_date' 		=> 'required|date',
			'start_age1' 	=> 'required|numeric',
			'end_age1' 		=> 'required|numeric|gt:start_age1',
			'fees_amount1' 	=> 'required|regex:/^\d+(\.\d{1,2})?$/',
			'start_age2' 	=> 'required|numeric|gt:end_age1',
			'end_age2' 		=> 'required|numeric|gt:start_age2',
			'fees_amount2' 	=> 'required|regex:/^\d+(\.\d{1,2})?$/',
			'start_age3' 	=> 'required|numeric|gt:end_age2',
			'end_age3' 		=> 'required|numeric|gt:start_age3',
			'fees_amount3' 	=> 'required|regex:/^\d+(\.\d{1,2})?$/',
			'start_age4' 	=> 'required|numeric|gt:end_age3',
			'end_age4' 		=> 'required|numeric|gt:start_age4',
			'fees_amount4' 	=> 'required|regex:/^\d+(\.\d{1,2})?$/',
		]);
		RegistrationFeesModel::where('registration_fees_id', $request->editId)->update(array(
            'start_date' 	=> date("Y-m-d",strtotime(Input::get('start_date'))),
			'end_date' 		=> date("Y-m-d",strtotime(Input::get('end_date'))),
			'start_age1' 	=> Input::get('start_age1'),
			'end_age1' 		=> Input::get('end_age1'),
			'fees_amount1' 	=> Input::get('fees_amount1'),
			'start_age2' 	=> Input::get('start_age2'),
			'end_age2' 		=> Input::get('end_age2'),
			'fees_amount2' 	=> Input::get('fees_amount2'),
			'start_age3' 	=> Input::get('start_age3'),
			'end_age3' 		=> Input::get('end_age3'),
			'fees_amount3' 	=> Input::get('fees_amount3'),
			'start_age4' 	=> Input::get('start_age4'),
			'end_age4' 		=> Input::get('end_age4'),
			'fees_amount4' 	=> Input::get('fees_amount4'),
			'updated_by' 	=> Auth::user()->user_id,
        ));
		return redirect()->route('registration-fees')->with('success','Registration fees has been updated successfully');
	}


	/**
	 * @author Purvesh Patel
	 * Date: 5 August 2019 2:00 PM
	 */
	public function deleteRegistrationFees($id)
	{
		$deleteRegistrationFeesData = RegistrationFeesModel::where('registration_fees_id',$id)->update(array('status' => '3'));
		return redirect()->route('registration-fees')->with('success','Registration fees has been deleted successfully');
	}


	/**
	 * @author Purvesh Patel
	 * Date: 5 August 2019 2:10 PM
	 */
	public function multipleDeleteRegistrationFees(Request $request){
		$ids = $request->ids;
        //dd($ids);
		RegistrationFeesModel::whereIn('registration_fees_id',explode(",",$ids))->update(array('status' => '3'));
		Session::flash('success', 'Registration fees deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Registration fees deleted successfully."]);
	}


	/**
	 * @author Purvesh Patel
	 * Date: 5 August 2019 2:26 PM
	 */
	public function detailsRegistrationFees($id){
	    $accessData    = $this->getArray('registration-fees',Auth::user()->fk_role_id);
		$editRegistrationFeesData = RegistrationFeesModel::where('registration_fees_id',$id)->get();
		return view('admin.registration_fees_details',['editRegistrationFeesData' => $editRegistrationFeesData[0],'accessData' => $accessData]);
	}
}
