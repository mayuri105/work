<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DivisionModel;
use App\RegionsModel;
use Input;
use Session;
use Auth;
class DivisionController extends Controller
{
    public function __construct()
	{
		$this->middleware('checkLogin');
	}
	
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function division()
    {
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('division',Auth::user()->fk_role_id);
    	$divisionData = DivisionModel::where('divisions.status','1')
    					->select('divisions.*',
    						'regions.region_name',
    						'regions.region_code',
    					)
    					->leftJoin('regions','regions.region_id','=','divisions.fk_region_id')
    					->orderBy('divisions.division_id','DESC')
    	 			    ->get();
    	return view('admin.division')->with('divisionData',$divisionData)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function addDivision()
    {
        $accessData = $this->getArray('division',Auth::user()->fk_role_id);
    	$regionData = RegionsModel::where('status','1')->get();
    	return view('admin.division_add')->with('regionData',$regionData)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function saveDivision(Request $request)
    {
    	$this->validate($request,[
    		'fk_region_id'  => 'required',
    		'division_name'  => 'required',
		]);

    	DivisionModel::create([
    		'fk_region_id'  => Input::get('fk_region_id'),
    		'division_name' => strtoupper(implode(',', Input::get('division_name'))),
    		'created_by'    => Auth::user()->user_id,
    	]);
    	return redirect()->route('division')->with('success','Division has been added successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function editDivision(Request $request)
    {
        $accessData = $this->getArray('division',Auth::user()->fk_role_id);
    	$editDivisionData = DivisionModel::where('division_id',$request->division_id)->first();
    	$regionData       = RegionsModel::where('status','1')->get();
    	return view('admin.division_edit')->with('editDivisionData',$editDivisionData)->with('regionData',$regionData)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function updateDivision(Request $request)
    {
    	$this->validate($request,[
    		'fk_region_id'  => 'required',
    		'division_name'  => 'required',
		]);
		DivisionModel::where('division_id',$request->editId)->update(array(
			'fk_region_id'  => Input::get('fk_region_id'),
    		'division_name' => strtoupper(implode(',', Input::get('division_name'))),
    		'updated_by'    => Auth::user()->user_id,
		));
		return redirect()->route('division')->with('success','Division has been updated successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function deleteDivision(Request $request)
    {
    	DivisionModel::where('division_id',$request->division_id)->update(array(
    		'status' => '3',
    	));
    	return redirect()->route('division')->with('success','Division has been deleted successfully');
    }

	 /**
	 * @author Reshmi Das
	 * Date: 
	 */
	 public function multipleDeleteDivision(Request $request)
	 {
	 	DivisionModel::whereIn('division_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Divisions have been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Division have been deleted successfully."]);
	 }
}
