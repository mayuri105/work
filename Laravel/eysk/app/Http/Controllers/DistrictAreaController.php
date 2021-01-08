<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DistrictAreasModel;
use App\DistrictModel;
use Input;
use Session;

class DistrictAreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkLogin');
    }
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function districtArea()
    {
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
    	$listDistrictArea = DistrictAreasModel::where('district_areas.status','1')
    						->select(
    							'district_areas.*',
    							'districts.district_name',
    					)
    					->leftJoin('districts','districts.district_id','=','district_areas.fk_district_id')
    					->orderBy('district_areas.area_id','DESC')
    					->get();
    	return view('admin.district_area',['listDistrictArea' => $listDistrictArea]);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function addDistrictArea()
    {
    	$districtData = DistrictModel::where('status','1')->get();
    	return view('admin.district_areas_add',['districtData' => $districtData]);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function saveDistrictArea(Request $request)
    {
    	$this->validate($request,[
			'district_name' => 'required',
			'area_name'     => 'required|unique:district_areas,area_name,3,status',
		]);
		DistrictAreasModel::create([
			'fk_district_id' => Input::get('district_name'),
			'area_name'      => Input::get('area_name'),
		]);
		return redirect()->route('district-area')->with('success','District Area has been added successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function editDistrictArea(Request $request)
    {
    	$editDistrictArea = DistrictAreasModel::where('area_id',$request->area_id)->first();
    	$district = DistrictModel::where('status','1')->get();
    	return view('admin.district_areas_edit')->with('editDistrictArea',$editDistrictArea)->with('district',$district);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function updateDistrictArea(Request $request)
    {
    	$this->validate($request,[
			'district_name'          => 'required',
			'area_name' 	         => 'required|unique:district_areas,area_name,'.$request->editId.',area_id,status,1',
		]);
    	DistrictAreasModel::where('area_id',$request->editId)->update([
    				'fk_district_id' => Input::get('district_name'),
    				'area_name'      => Input::get('area_name'),
    			]);
		return redirect()->route('district-area')->with('success','District Area has been updated successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function deleteDistrictArea($id)
    {
    	$deleteDistrictArea = DistrictAreasModel::where('area_id',$id)->update(array('status' => '3'));
    	return redirect()->route('district-area')->with('success','District Area has been deleted successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function multipleDeleteDistrictArea(Request $request)
    {
		DistrictAreasModel::whereIn('area_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'District Area has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"District has been deleted successfully."]);		
    }
}
