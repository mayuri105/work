<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Input;
use App\RegionsModel;
use App\SamajZoneModel;
use Auth;
class SamajZoneController extends Controller{
	public function __construct()
    {
        $this->middleware('checkLogin');
    }

	/**
     * @author 
     * Date: 
     */
    public function samajZone(){
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('samaj-zone',Auth::user()->fk_role_id);
    	$samajZoneData = SamajZoneModel::where('samaj_zones.status','1')
                    ->select(
                        'samaj_zones.*',
                        'regions.region_name',
                        'regions.region_code',
                    )
                    ->leftJoin('regions', 'regions.region_id', '=', 'samaj_zones.fk_region_id')
                    ->orderBy('samaj_zones.samaj_zone_id','DESC')
                    ->get();
        //dd($samajZoneData);
        return view('admin.samaj_zones',['samajZoneData' => $samajZoneData,'accessData' => $accessData]);
	}


	/**
     * @author 
     * Date: 
     */
	public function addSmajZone(){
	    $accessData = $this->getArray('samaj-zone',Auth::user()->fk_role_id);
		$regionsData = RegionsModel::where('status',1)->get();
		return view('admin.samaj_zones_add',['regions_data' => $regionsData,'accessData' => $accessData]);
	}


	/**
     * @author 
     * Date: 
     */
	public function saveSmajZones(Request $request){
		$this->validate($request,[
			'samaj_zone_name' 	=> 'required|unique:samaj_zones,samaj_zone_name,3,status',
			'region_name' 		=> 'required',
		]);
		SamajZoneModel::create([
            'fk_region_id' 		=> Input::get('region_name'),
			'samaj_zone_name' 	=> strtoupper(Input::get('samaj_zone_name')),
			'created_by'     	=> Auth::user()->user_id,
        ]);
		return redirect()->route('samaj-zone')->with('success','Samaj zone has been added successfully');
	}


	/**
     * @author 
     * Date: 
     */
	public function editSamajZone(Request $request){
	    $accessData = $this->getArray('samaj-zone',Auth::user()->fk_role_id);
		$editSamajZoneData 	= SamajZoneModel::where('samaj_zone_id',$request->samaj_zone_id)->get();
		$regionsData 		= RegionsModel::where('status',1)->get();
		return view('admin.samaj_zones_edit',['editSamajZoneData' => $editSamajZoneData[0],'regions_data'=>$regionsData,'accessData' => $accessData]);
	}


	/**
     * @author 
     * Date: 
     */
	public function updateSamajZone(Request $request){
		$this->validate($request,[
			'samaj_zone_name' 	=> 'required|unique:samaj_zones,samaj_zone_name,'.$request->editId.',samaj_zone_id,status,1',
			'region_name' 		=> 'required',
		]);
		SamajZoneModel::where('samaj_zone_id', $request->editId)->update(array(
            'fk_region_id' 		=> Input::get('region_name'),
			'samaj_zone_name' 	=> strtoupper(Input::get('samaj_zone_name')),
			'updated_by'     	=> Auth::user()->user_id,
        ));
		return redirect()->route('samaj-zone')->with('success','Samaj zone has been updated successfully');
	}


	/**
     * @author 
     * Date: 
     */
	public function deleteSamajZone($id){

		SamajZoneModel::where('samaj_zones.status','1')->where('samaj_zones.samaj_zone_id',$id)
                        ->leftJoin('yuva_mandal_numbers','yuva_mandal_numbers.fk_samaj_zone_id','=','samaj_zones.samaj_zone_id')
                        ->update(array('samaj_zones.status' => '3','yuva_mandal_numbers.status' => '3'));
		return redirect()->route('samaj-zone')->with('success','Samaj zone has been deleted successfully');
	}

	
	/**
     * @author 
     * Date: 
     */
	public function multipleDeleteSamajZone(Request $request){
		
        SamajZoneModel::whereIn('samaj_zone_id',explode(",",$request->ids))->where('samaj_zones.status','1')
                        ->leftJoin('yuva_mandal_numbers','yuva_mandal_numbers.fk_samaj_zone_id','=','samaj_zones.samaj_zone_id')
                        ->update(array('samaj_zones.status' => '3','yuva_mandal_numbers.status' => '3'));
		Session::flash('success', 'Samaj zone has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Samaj zone deleted successfully."]);
	}
}
