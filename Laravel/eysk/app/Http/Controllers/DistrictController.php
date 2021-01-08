<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DistrictModel;
use Input;
use Session;
use App\DistrictAreasModel;
class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkLogin');
    }
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function district()
    {
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
    	$listDistrict = DistrictModel::where('status','1')->orderBy('district_id','DESC')->get();
    	return view('admin.districts',['listDistrict' => $listDistrict]);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function addDistrict()
    {
    	return view('admin.district_add');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function saveDistrict(Request $request)
    {
    	$this->validate($request,[
			'district_name' => 'required|unique:districts,district_name,3,status',
		]);
		DistrictModel::create([
            'district_name' => Input::get('district_name'),
			'created_by'    => '1'
        ]);
        return redirect()->route('district')->with('success','District has been added successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function editDistrict(Request $request)
    {
    	$editDistrict = DistrictModel::where('district_id',$request->district_id)->first();
    	return view('admin.district_edit',['editDistrict' => $editDistrict]);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function updateDistrict(Request $request)
    {
        $this->validate($request,[
            'district_name' => 'required|unique:districts,district_name,'.$request->editId.',district_id,status,1',
        ]);
    	DistrictModel::where('district_id',$request->editId)->update(array(
    		'district_name' => Input::get('district_name'),
    		'updated_by'    => '1'
    	));
    	return redirect()->route('district')->with('success','District has been updated successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function deleteDistrict($id)
    {
        $deleteDistrict = DistrictModel::where('districts.status','1')->where('districts.district_id',$id)
                        ->leftJoin('district_areas','district_areas.fk_district_id','=','districts.district_id')
                        ->update(array('district_areas.status' => '3','districts.status' => '3')); 
    	return redirect()->route('district')->with('success','District has been deleted successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function multipleDeleteDistrict(Request $request)
	{
		DistrictModel::whereIn('districts.district_id',explode(",",$request->ids))->where('districts.status','1')
                        ->leftJoin('district_areas','district_areas.fk_district_id','=','districts.district_id')
                        ->update(array('district_areas.status' => '3','districts.status' => '3'));
		Session::flash('success', 'District has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"District has been deleted successfully."]);		
	}
}
