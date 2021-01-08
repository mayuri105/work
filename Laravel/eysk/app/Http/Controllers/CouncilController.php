<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegionsModel;
use App\CouncilModel;
use Input;
use Session;
use DB;
use Auth;
class CouncilController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkLogin');
	}
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function council()
    {
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('council',Auth::user()->fk_role_id);
        $council = DB::table("councils")
        ->select("councils.*",DB::raw("GROUP_CONCAT(regions.region_name) as tagsname"),DB::raw("GROUP_CONCAT(regions.region_code) as tagscode"))
        ->leftjoin("regions",DB::raw("FIND_IN_SET(regions.region_id,councils.fk_region)"),">",DB::raw("'0'"))
        ->groupBy("councils.council_id")
        ->where('councils.status','1')
        ->get();

        //dd($council);
    	return view('admin.council')->with('council',$council)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function addCouncil()
    {
        $accessData = $this->getArray('council',Auth::user()->fk_role_id);
    	$region = RegionsModel::where('status','1')->get();
    	return view('admin.council_add')->with('region',$region)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function saveCouncil(Request $request)
    {
    	$this->validate($request,[
			'name' 		  => 'required',
			'code'   	  => 'required',
			'fk_region'   => 'required',
		]);
		CouncilModel::create([
			'name' 		  => strtoupper(Input::get('name')),
			'code'   	  => Input::get('code'),
			'fk_region'   => implode(',', Input::get('fk_region')),
			'created_by'  => Auth::user()->user_id,
		]);
		return redirect()->route('council')->with('success','Council has been added successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function editCouncil(Request $request)
    {
        $accessData = $this->getArray('council',Auth::user()->fk_role_id);
    	$region      = RegionsModel::where('status','1')->get();
    	$editCouncil = CouncilModel::where('council_id',$request->council_id)->first();
    	return view('admin.council_edit')->with('editCouncil',$editCouncil)->with('region',$region)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function updateCouncil(Request $request)
    {
    	$this->validate($request,[
			'name' 		  => 'required',
			'code'   	  => 'required',
			'fk_region'   => 'required',
		]);
		CouncilModel::where('council_id',$request->editId)->update(array(
			'name' 		  => strtoupper(Input::get('name')),
			'code'   	  => Input::get('code'),
			'fk_region'   => implode(',', Input::get('fk_region')),
			'updated_by'  => Auth::user()->user_id,
		));
		return redirect()->route('council')->with('success','Council has been updated successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function deleteCouncil(Request $request)
    {
    	CouncilModel::where('council_id',$request->council_id)->update(array('status' => '3'));
		return redirect()->route('council')->with('success','Council has been deleted successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function multipleDeleteCouncil(Request $request)
    {
    	CouncilModel::whereIn('council_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Council has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Council has been deleted successfully."]);
    }
}
