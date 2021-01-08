<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiseaseModel;
use Input;
use Session;
use Auth;
class DiseaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkLogin');
    }
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function disease()
    {
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('disease',Auth::user()->fk_role_id);
    	$listDisease = DiseaseModel::where('status','1')->orderBy('disease_id','DESC')->get();
    	return view('admin.disease')->with('listDisease',$listDisease)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function addDisease()
    {
        $accessData = $this->getArray('disease',Auth::user()->fk_role_id);
    	return view('admin.disease_add')->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function saveDisease(Request $request)
    {
    	$this->validate($request,[
			'disease_name' => 'required|unique:diseases,disease_name,3,status',
		]);
		DiseaseModel::create([
			'disease_name' => strtoupper(Input::get('disease_name')),
			'created_by'   => Auth::user()->user_id,
		]);
		return redirect()->route('disease')->with('success','Disease has been added successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function editDisease(Request $request)
    {
        $accessData = $this->getArray('disease',Auth::user()->fk_role_id);
    	$editDisease = DiseaseModel::where('disease_id',$request->disease_id)->first();
    	return view('admin.disease_edit')->with('editDisease',$editDisease)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function updateDisease(Request $request)
    {
    	$this->validate($request,[
			'disease_name' => 'required|unique:diseases,disease_name,'.$request->editId.',disease_id,status,1',
		]);
		DiseaseModel::where('disease_id',$request->editId)->update(array(
			'disease_name' => strtoupper(Input::get('disease_name')),
			'updated_by'   => Auth::user()->user_id,
		));
		return redirect()->route('disease')->with('success','Disease has been updated successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function deleteDisease(Request $request)
    {
    	DiseaseModel::where('disease_id',$request->disease_id)->update(array('status' => '3'));
		return redirect()->route('disease')->with('success','Disease has been deleted successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function multipleDeleteDisease(Request $request)
    {
    	DiseaseModel::whereIn('disease_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Disease deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Disease deleted successfully."]);
    }
}
