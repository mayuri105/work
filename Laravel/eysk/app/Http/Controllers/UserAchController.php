<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AchModel;
use App\RegistrationModel;
use Input;
class UserAchController extends Controller
{
    public function userAch(Request $request)
    {
    	$id = $request->id;
    	$registrationData = RegistrationModel::where('registration_id',$id)->first();
    	$userAch = AchModel::where('fk_ysk_id',$registrationData['ysk_id'])->orWhere('fk_ysk_id',$registrationData['pre_ysk_id'])->first();
    	return view('admin.user_ach')->with('userAch',$userAch)->with('id',$id);
    }

    public function addUserAch(Request $request)
    {
    	$id = $request->id;
    	$registrationData = RegistrationModel::where('registration_id',$id)
    						->select('registrations.*',
    							'regions.region_name',
    							'regions.region_id',
    							'yuva_mandal_numbers.yuva_mandal_number_id',
    							'yuva_mandal_numbers.yuva_mandal_number',
    						)
    						->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
    						->leftJoin('yuva_mandal_numbers','yuva_mandal_numbers.yuva_mandal_number_id','=','registrations.fk_yuva_mandal_id')
    						->first();
    	if ($registrationData['ysk_id'] != '') {
    		$yskId = $registrationData['ysk_id'];
    	}elseif($registrationData['ysk_id'] == ''){
    		$yskId = $registrationData['pre_ysk_id'];
    	}
    	return view('admin.user_ach_add')->with('id',$id)->with('yskId',$yskId)->with('nameAsPerYuvaSanghOrg',$registrationData['name_as_per_yuva_sangh_org'])->with('regionName',$registrationData['region_name'])->with('regionId',$registrationData['region_id'])->with('yuvaMandalId',$registrationData['yuva_mandal_number_id'])->with('yuvaMandalName',$registrationData['yuva_mandal_number'])->with('cityName',$registrationData['fk_city_id'])->with('nameAsPerYuvaSangh',$registrationData['hidden_name_as_per_yuva_sangh_org'])->with('phoneNumberFirst',$registrationData['phone_number_first'])->with('email',$registrationData['email']);
    }

    public function saveUserAch(Request $request)
    {
    	//dd($request->id);
    	$this->validate($request,[
			'fk_ysk_id'                   => 'required',
            'fk_region_id'                => 'required',
            'yuva_mandal_number_id'       => 'required',
            'city_name'                   => 'required',
			'name_as_per_yuva_sangh_org'  => 'required',
            'phone_number'                => 'required',
            'apply_date'                  => 'required',
			'fk_bank_id'                  => 'required',
			'bank_account_number'         => 'required',
			'ifsc_code'                   => 'required',
		]);
		AchModel::create([
			'fk_ysk_id'           => Input::get('fk_ysk_id'),
            'fk_region_id'        => Input::get('fk_region_id'),
            'fk_yuva_mandal'      => Input::get('yuva_mandal_number_id'),
            'city_name'           => Input::get('city_name'),
            'email'               => Input::filled('email') ? Input::get('email') : '',
			'name_as_per_yuva_sangh_org' => Input::get('name_as_per_yuva_sangh_org'),
            'phone_number'        => Input::get('phone_number'),
            'apply_date'          => date('Y-m-d',strtotime(Input::get('apply_date'))),
			'fk_bank_id'		  => Input::get('fk_bank_id'),
			'bank_account_number' => Input::get('bank_account_number'),
			'ifsc_code'			  => Input::get('ifsc_code'),
			'micr_code'			  => Input::filled('micr_code') ? Input::get('micr_code') : '',
            'created_by_user'     => $request->id,
		]);
		return redirect()->route('user-ach',$request->id)->with('success','Ach has been added successfully');
    }

    public function viewUserAch(Request $request)
    {
    	$viewUserAch = AchModel::where('created_by_user',$request->id)
    				->select('achs.*',
    					'regions.region_name',
    					'regions.region_id',
    					'yuva_mandal_numbers.yuva_mandal_number_id',
    					'yuva_mandal_numbers.yuva_mandal_number',
    				)
    				->leftJoin('regions','regions.region_id','=','achs.fk_region_id')
    				->leftJoin('yuva_mandal_numbers','yuva_mandal_numbers.yuva_mandal_number_id','=','achs.fk_yuva_mandal')
    				->first();
    	return view('admin.user_ach_view')->with('viewUserAch',$viewUserAch)->with('id',$request->id);
    }
}
