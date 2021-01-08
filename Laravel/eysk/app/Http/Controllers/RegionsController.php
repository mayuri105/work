<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Input;
use App\RegionsModel;
use Auth;
class RegionsController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkLogin');
	}

	/**
     * @author 
     * Date: 
     */
    public function region(){
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData    = $this->getArray('region',Auth::user()->fk_role_id);
		$regionData = RegionsModel::where('status','1')->orderBy('region_id','DESC')->get();
		return view('admin.regions',['regionData' => $regionData, 'accessData' => $accessData]);
	}


	/**
     * @author 
     * Date: 
     */
	public function addRegion(){
	    $accessData    = $this->getArray('region',Auth::user()->fk_role_id);
		return view('admin.regions_add')->with('accessData',$accessData);
	}


	/**
     * @author 
     * Date: 
     */
	public function saveRegion(Request $request){
		$this->validate($request,[
			'region_name' => 'required|unique:regions,region_name,3,status',
			'region_code' => 'required|unique:regions,region_code,3,status',
		]);
		RegionsModel::create([
            'region_name' => strtoupper(Input::get('region_name')),
			'region_code' => strtoupper(Input::get('region_code')),
			'created_by'  => Auth::user()->user_id,
        ]);
		return redirect()->route('region')->with('success','Region has been added successfully');
	}


	/**
     * @author 
     * Date: 
     */
	public function editRegion(Request $request){
	    $accessData    = $this->getArray('region',Auth::user()->fk_role_id);
		$editRegionData = RegionsModel::where('region_id',$request->region_id)->get();
		return view('admin.regions_edit',['editRegionData' => $editRegionData[0],'accessData' => $accessData]);
	}


	/**
     * @author 
     * Date: 
     */
	public function updateRegion(Request $request){
		$this->validate($request,[
			'region_name' => 'required|unique:regions,region_name,'.$request->editId.',region_id,status,1',
			'region_code' => 'required|unique:regions,region_code,'.$request->editId.',region_id,status,1',
		]);
		RegionsModel::where('region_id', $request->editId)->update(array(
            'region_name' => strtoupper(Input::get('region_name')),
            'region_code' => strtoupper(Input::get('region_code')),
            'updated_by'  => Auth::user()->user_id,
        ));
		return redirect()->route('region')->with('success','Region has been updated successfully');
	}


	/**
     * @author 
     * Date: 
     */
	public function deleteRegion($id){

		RegionsModel::where('regions.status','1')->where('regions.region_id',$id)
						->leftJoin('divisions','divisions.fk_region_id','=','regions.region_id')
                        ->leftJoin('samaj_zones','samaj_zones.fk_region_id','=','regions.region_id')
                        ->leftJoin('yuva_mandal_numbers','yuva_mandal_numbers.fk_region_id','=','regions.region_id')
                        ->update(array('divisions.status' => '3','samaj_zones.status' => '3','regions.status' => '3','yuva_mandal_numbers.status' => '3')); 

		return redirect()->route('region')->with('success','Region has been deleted successfully');
	}


	/**
     * @author 
     * Date: 
     */
	public function multipleDeleteRegion(Request $request)
	{
		RegionsModel::whereIn('regions.region_id',explode(",",$request->ids))->where('regions.status','1')
						->leftJoin('divisions','divisions.fk_region_id','=','regions.region_id')
		    			->leftJoin('samaj_zones','samaj_zones.fk_region_id','=','regions.region_id')
            			->leftJoin('yuva_mandal_numbers','yuva_mandal_numbers.fk_region_id','=','regions.region_id')
            			->update(array('divisions.status' => '3','samaj_zones.status' => '3','regions.status' => '3','yuva_mandal_numbers.status' => '3'));
		Session::flash('success', 'Region has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Region has been deleted successfully."]);
	}
}
