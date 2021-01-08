<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegionsModel;
use App\RegistrationDonationModel;
use Input;
use Session;
use Auth;
class RegistrationDonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkLogin');
    }
    /**
     * @author 
     * Date: 
     */
    public function registrationDonation()
    {
        Session::forget('region_name');
        Session::forget('division_name');
        Session::forget('samaj_zone_name');
        Session::forget('a');
        $accessData = $this->getArray('registration-donation',Auth::user()->fk_role_id);
    	$registrationDonation = RegistrationDonationModel::where('registration_donations.status','1')
    							->select(
    							'registration_donations.*',
    							)
    							->orderBy('registration_donation_id','DESC')
    							->get();
    	return view('admin.registration_donation')->with('registrationDonation',$registrationDonation)->with('accessData',$accessData);
    }

    /**
     * @author 
     * Date: 
     */
    public function addRegistrationDonation()
    {
        $accessData = $this->getArray('registration-donation',Auth::user()->fk_role_id);
    	return view('admin.registration_donation_add')->with('accessData',$accessData);
    }

    /**
     * @author 
     * Date: 
     */
    public function saveRegistrationDonation(Request $request)
    {
    	$this->validate($request,[
			'start_date'                      => 'required',
			'region_registration_amount'      => 'required',
			'yuva_mandal_registration_amount' => 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		RegistrationDonationModel::create([
			'start_date'                      => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'                        => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'region_registration_amount'      => Input::get('region_registration_amount'),
			'yuva_mandal_registration_amount' => Input::get('yuva_mandal_registration_amount'),
			'created_by'                      => Auth::user()->user_id,
		]);
		return redirect()->route('registration-donation')->with('success','Registration Donation has been added successfully');
    }

    /**
     * @author 
     * Date: 
     */
    public function editRegistrationDonation(Request $request)
    {
        $accessData = $this->getArray('registration-donation',Auth::user()->fk_role_id);
    	$editRegistrationDonation = RegistrationDonationModel::where('registration_donation_id',$request->registration_donation_id)->first();
    	return view('admin.registration_donation_edit')->with('editRegistrationDonation',$editRegistrationDonation)->with('accessData',$accessData);
    }

     /**
     * @author 
     * Date: 
     */
     public function updateRegistrationDonation(Request $request)
     {
     	$this->validate($request,[
			'start_date'                      => 'required',
			'region_registration_amount'      => 'required',
			'yuva_mandal_registration_amount' => 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		RegistrationDonationModel::where('registration_donation_id',$request->editId)->update(array('status' => '0'));
		RegistrationDonationModel::create([
			'start_date'                      => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'                        => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'region_registration_amount'      => Input::get('region_registration_amount'),
			'yuva_mandal_registration_amount' => Input::get('yuva_mandal_registration_amount'),
			'updated_by'                      => Auth::user()->user_id,
		]);
		return redirect()->route('registration-donation')->with('success','Registration Donation has been updated successfully');
     }

     /**
     * @author 
     * Date: 
     */
     public function deleteRegistrationDonation(Request $request)
     {
     	RegistrationDonationModel::where('registration_donation_id',$request->registration_donation_id)->update(array('status' => '3'));
		return redirect()->route('registration-donation')->with('success','Registration Donation has been deleted successfully');
     }

     /**
     * @author 
     * Date: 
     */
     public function multipleDeleteRegistrationDonation(Request $request)
    {
        RegistrationDonationModel::whereIn('registration_donation_id',explode(",",$request->ids))->update(array('status' => '3'));
        Session::flash('success', 'Registration Donation has been deleted successfully.');
        return response()->json(['status'=>true,'message'=>"Registration Donation has been deleted successfully."]);
    }

}
