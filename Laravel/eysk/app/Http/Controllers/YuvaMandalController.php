<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Input;
use App\RegionsModel;
use App\SamajZoneModel;
use App\YuvaMandalNumberModel;
use App\DivisionModel;
use App;
use Auth;
class YuvaMandalController extends Controller
{
	public function __construct()
    {
        $this->middleware('checkLogin');
    }
    
	/**
     * @author 
     * Date: 
     */
	public function yuvaMandalNumber(){
		Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('yuva-mandal-number',Auth::user()->fk_role_id);
		$yuvaMandalNumberData = YuvaMandalNumberModel::where('yuva_mandal_numbers.status','1')
                    ->select(
                        'yuva_mandal_numbers.*',
                        'regions.region_name',
                        'regions.region_code',
                        'samaj_zones.samaj_zone_name',
                    )
                    ->leftJoin('regions', 'regions.region_id', '=', 'yuva_mandal_numbers.fk_region_id')
                    ->leftJoin('samaj_zones', 'samaj_zones.samaj_zone_id', '=', 'yuva_mandal_numbers.fk_samaj_zone_id')
                    ->orderBy('yuva_mandal_numbers.yuva_mandal_number_id','DESC')
                    ->get();
        //dd($yuvaMandalNumberData);
        return view('admin.yuva_mandal_number',['yuvaMandalNumberData' => $yuvaMandalNumberData, 'accessData' => $accessData]);
	}


	/**
     * @author 
     * Date: 
     */
	public function addYuvaMandalNumber(){
	    $accessData = $this->getArray('yuva-mandal-number',Auth::user()->fk_role_id);
		$regionsData = RegionsModel::where('status',1)->get();
		return view('admin.yuva_mandal_number_add',['regions_data' => $regionsData,'accessData' => $accessData]);
	}


	/**
     * @author 
     * Date: 
     */
	public function saveYuvaMandalNumber(Request $request){
		$this->validate($request,[
			'yuva_mandal_number' 	=> 'required|unique:yuva_mandal_numbers,yuva_mandal_number,3,status',
			'yuva_mandal_code' 		=> 'required|unique:yuva_mandal_numbers,yuva_mandal_code,3,status',
			'region_name' 			=> 'required',
			'samaj_zone_name' 		=> 'required',
			'division_name' 		=> 'required',
		]);
		Session::put('region_name', Input::get('region_name'));
		Session::put('division_name', Input::get('division_name'));
		Session::put('samaj_zone_name', Input::get('samaj_zone_name'));
		YuvaMandalNumberModel::create([
            'fk_region_id' 			=> Input::get('region_name'),
            'division_name'			=> Input::get('division_name'),
			'fk_samaj_zone_id' 		=> Input::get('samaj_zone_name'),
			'yuva_mandal_number' 	=> strtoupper(Input::get('yuva_mandal_number')),
			'yuva_mandal_code' 		=> Input::get('yuva_mandal_code'),
			'created_by'            => Auth::user()->user_id,
        ]);
		return redirect()->route('add-yuva-mandal-number')->with('success','Yuva mandal has been added successfully');
	}


	/**
     * @author 
     * Date: 
     */
	public function editYuvaMandalNumber(Request $request)
	{
	    $accessData = $this->getArray('yuva-mandal-number',Auth::user()->fk_role_id);
		$regionsData = RegionsModel::where('status',1)->get();
		$editYuvaMandalNumberData = YuvaMandalNumberModel::where('yuva_mandal_number_id',$request->yuva_mandal_number_id)->get();
		$samajZoneData = SamajZoneModel::where('status','1')->where('fk_region_id',$editYuvaMandalNumberData['0']->fk_region_id)->get();
		$divisionData = DivisionModel::where('status','1')->where('fk_region_id',$editYuvaMandalNumberData['0']->fk_region_id)->get();
		//dd($divisionData->toArray());
		return view('admin.yuva_mandal_number_edit',['editYuvaMandalNumberData' => $editYuvaMandalNumberData[0],'regions_data' => $regionsData,'samaj_zone_data' => $samajZoneData,'divisionData' => $divisionData,'accessData' => $accessData]);
	}


	/**
     * @author 
     * Date: 
     */
	public function updateYuvaMandalNumber(Request $request){
	    $this->validate($request,[
			'yuva_mandal_number' 	=> 'required|unique:yuva_mandal_numbers,yuva_mandal_number,'.$request->editId.',yuva_mandal_number_id,status,1',
			'yuva_mandal_code' 		=> 'required|unique:yuva_mandal_numbers,yuva_mandal_code,'.$request->editId.',yuva_mandal_number_id,status,1',
			'region_name' 			=> 'required',
			'samaj_zone_name' 		=> 'required',
			'division_name' 		=> 'required',
		]);
		
		YuvaMandalNumberModel::where('yuva_mandal_number_id', $request->editId)->update(array(
            'fk_region_id' 		 => Input::get('region_name'),
            'division_name'	     => Input::get('division_name'),
			'fk_samaj_zone_id' 	 => Input::get('samaj_zone_name'),
			'yuva_mandal_number' => strtoupper(Input::get('yuva_mandal_number')),
			'yuva_mandal_code' 	 => Input::get('yuva_mandal_code'),
			'updated_by'         => Auth::user()->user_id,
        ));
		return redirect()->route('yuva-mandal-number')->with('success','Yuva mandal has been updated successfully');
	}


	/**
     * @author 
     * Date: 
     */
	public function deleteYuvaMandalNumber($id)
	{
		$deleteYuvaMandalNumberData = YuvaMandalNumberModel::where('yuva_mandal_number_id',$id)->update(array('status' => '3'));
		return redirect()->route('yuva-mandal-number')->with('success','Yuva mandal has been deleted successfully');
	}


	/**
     * @author 
     * Date: 
     */
	public function multipleYuvaMandalNumber(Request $request)
	{
		$ids = $request->ids;
        //dd($ids);
		YuvaMandalNumberModel::whereIn('yuva_mandal_number_id',explode(",",$ids))->update(array('status' => '3'));
		Session::flash('success', 'Yuva mandal has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Yuva mandal deleted successfully."]);
	}


	/**
     * @author 
     * Date: 
     */
	public function getSamajZoneDataByRegionID(Request $request){
		$regionId 		= Input::get('region_id');
		$divisionData 	= DivisionModel::where([['status','=',1],['fk_region_id','=',$regionId]])->get()->toArray();
		//dd();
		$samajZoneData 	= SamajZoneModel::where([['status','=',1],['fk_region_id','=',$regionId]])->get()->toArray();

		$htmlData = '<select class="form-control m-input" name="samaj_zone_name" id="samaj_zone_name">
		<option value="" selected="selected">SELECT SAMAJ ZONE</option>';
		if(is_array($samajZoneData) && count($samajZoneData) > 0){
			foreach ($samajZoneData as $key => $valueSamajZone) {
				$selected = '';
				if (Session::get('samaj_zone_name') == $valueSamajZone['samaj_zone_id']) {
					$selected = 'selected';
				}
				$htmlData .= '<option value="'.$valueSamajZone['samaj_zone_id'].'"'.$selected.'>'.$valueSamajZone['samaj_zone_name'].'</option>';
			}
		}
		$htmlData .= '</select>';

		//$expl = explode(',', $divisionData[0]['division_name']);
		//dd(count($expl));
		$htmlDivData = '<select class="form-control m-input" name="division_name" id="division_name">
		<option value="" selected="selected">SELECT DIVISION</option>';
		if(is_array($divisionData) && count($divisionData) > 0){
			foreach ($divisionData as $key => $valueDivision) {
				$selected = '';
				if (Session::get('division_name') == $valueDivision['division_name']) {
					$selected = 'selected';
				}
				$htmlDivData .= '<option value="'.$valueDivision['division_name'].'" '.$selected.'>'.$valueDivision['division_name'].'</option>';
			}
		}
		$htmlDivData .= '</select>';
		$responseData = array("success"=>"1","message"=>$samajZoneData,"html_data"=>$htmlData,"html_div_data"=>$htmlDivData);
		//dd($htmlDivData);
		echo json_encode($responseData);
		exit;
	}
}
