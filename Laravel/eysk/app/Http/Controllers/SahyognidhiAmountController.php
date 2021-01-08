<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SahyognidhiAmountModel;
use Input;
use Session;
use Auth;
class SahyognidhiAmountController extends Controller
{
	public function __construct()
    {
        $this->middleware('checkLogin');
    }
    /**
	 * @author Reshmi Das
	 * Date: 14/8/2019
	 */
    public function sahyognidhiAmount()
	{
	    Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData    = $this->getArray('death-type-amount',Auth::user()->fk_role_id);
		$sahyognidhiAmountData =  SahyognidhiAmountModel::where('status','1')->orderBy('sahyognidhi_amount_id', 'DESC')->get();
		return view('admin.sahyognidhi_amount',['sahyognidhiAmountData' => $sahyognidhiAmountData, 'accessData' => $accessData]);
	}

	/**
	 * @author Reshmi Das
	 * Date: 14/8/2019
	 */
	public function addSahyognidhiAmount()
	{
	    $accessData    = $this->getArray('death-type-amount',Auth::user()->fk_role_id);
		return view('admin.sahyognidhi_amount_add')->with('accessData',$accessData);
	}

	/**
	 * @author Reshmi Das
	 * Date: 14/8/2019
	 */
	public function saveSahyognidhiAmount(Request $request)
	{
		$this->validate($request,[
			'start_date'			     => 'required',
			'full_disability_percentage' => 'required|numeric|between:0,100.00',
			'half_disability_percentage' => 'required|numeric|between:0,100.00',
			'divangate_amount'		     => 'required|numeric',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		SahyognidhiAmountModel::create([
			'start_date'			 => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'				 => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'full_disability_percentage' => Input::get('full_disability_percentage'),
			'half_disability_percentage' => Input::get('half_disability_percentage'),
			'divangate_amount'		     => Input::get('divangate_amount'),
			'created_by'     			 => Auth::user()->user_id,
		]);
		return redirect()->route('sahyognidhi-amount')->with('success','Sahyognidhi Amount has been added successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 14/8/2019
	 */
	public function editSahyognidhiAmount($id)
	{
	    $accessData    = $this->getArray('death-type-amount',Auth::user()->fk_role_id);
		$editSahyognidhiAmounttData = SahyognidhiAmountModel::where('sahyognidhi_amount_id',$id)->get();
		return view('admin.sahyognidhi_amount_edit')->with('editSahyognidhiAmounttData',$editSahyognidhiAmounttData[0])->with('accessData',$accessData);
	}

	/**
	 * @author Reshmi Das
	 * Date: 14/8/2019
	 */
	public function updateSahyognidhiAmount(Request $request)
	{
    	$this->validate($request,[
			'start_date'			     => 'required',
			'full_disability_percentage' => 'required|numeric|between:0,100.00',
			'half_disability_percentage' => 'required|numeric|between:0,100.00',
			'divangate_amount'		     => 'required|numeric',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		$upSahyognidhiAmount = SahyognidhiAmountModel::where('sahyognidhi_amount_id',$request->editId)->update(array('status' => '0'));

		SahyognidhiAmountModel::create([
			'start_date'			     => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'				     => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'full_disability_percentage' => Input::get('full_disability_percentage'),
			'half_disability_percentage' => Input::get('half_disability_percentage'),
			'divangate_amount'		     => Input::get('divangate_amount'),
			'created_by'     			 => Auth::user()->user_id,
		]);
		return redirect()->route('sahyognidhi-amount')->with('success','Sahyognidhi Amount has been updated successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 14/8/2019
	 */
	public function deleteSahyognidhiAmount($id)
	{
		$deleteSahyognidhiAmount = SahyognidhiAmountModel::where('sahyognidhi_amount_id',$id)->update(array('status' => '3'));
		return redirect()->route('sahyognidhi-amount')->with('success','Sahyognidhi Amount has been deleted successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 14/8/2019
	 */
	public function multipleDeleteSahyognidhiAmount(Request $request)
	{
		SahyognidhiAmountModel::whereIn('sahyognidhi_amount_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Sahyognidhi Amount deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Death type Amount deleted successfully."]);
	}
}
