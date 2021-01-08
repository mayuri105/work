<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeathTypeModel;
use Input;
use Session;
use Auth;
class DeathTypeController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkLogin');
	}
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function deathType()
    {
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData    = $this->getArray('death-type',Auth::user()->fk_role_id);
    	$listDeathType = DeathTypeModel::where('status','1')->orderBy('death_type_id','DESC')->get();
    	return view('admin.death_type',['listDeathType' => $listDeathType, 'accessData' => $accessData]);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function addDeathType()
    {
        $accessData    = $this->getArray('death-type',Auth::user()->fk_role_id);
    	return view('admin.death_type_add')->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function saveDeathType(Request $request)
    {
    	$this->validate($request,[
			'title' 		=> 'required',
			'description' 	=> 'required',
		]);
		DeathTypeModel::create([
			'title' 		=> strtoupper(Input::get('title')),
			'description'	=> strtoupper(Input::get('description')),
			'created_by'    => Auth::user()->user_id,
		]);
		return redirect()->route('death-type')->with('success','Death Type has been added successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function editDeathType(Request $request)
    {
        $accessData    = $this->getArray('death-type',Auth::user()->fk_role_id);
    	$editDeathType = DeathTypeModel::where('death_type_id',$request->death_type_id)->first();
    	return view('admin.death_type_edit',['editDeathType' => $editDeathType,'accessData' => $accessData]);
    }
    public function updateDeathType(Request $request)
    {
    	$this->validate($request,[
			'title' 		=> 'required',
			'description' 	=> 'required',
		]);
		DeathTypeModel::where('death_type_id',$request->editId)->update(array(
			'title' 		=> strtoupper(Input::get('title')),
			'description'   => strtoupper(Input::get('description')),
			'updated_by'    => Auth::user()->user_id,
		));
		return redirect()->route('death-type')->with('success','Death Type has been updated successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function deleteDeathType($id)
    {
    	$deleteDeathType = DeathTypeModel::where('death_type_id',$id)->update(array('status' => '3'));
		return redirect()->route('death-type')->with('success','Death Type has been deleted successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function multipleDeleteDeathType(Request $request)
    {
		DeathTypeModel::whereIn('death_type_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Region has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Death Type has been deleted successfully."]);
	}

}
