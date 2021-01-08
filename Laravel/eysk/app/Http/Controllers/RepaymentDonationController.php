<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RepaymentDonationModel;
use App\RegionsModel;
use Input;
use Session;
use Auth;
class RepaymentDonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkLogin');
    }
    /**
     * @author 
     * Date: 
     */
    public function repaymentDonation()
    {
        Session::forget('region_name');
        Session::forget('division_name');
        Session::forget('samaj_zone_name');
        Session::forget('a');
        $accessData = $this->getArray('repayment-donation',Auth::user()->fk_role_id);
    	$repaymentDonation = RepaymentDonationModel::where('repayment_donations.status','1')
    							->select(
    							'repayment_donations.*',
    							)
    							->orderBy('repayment_donations_id','DESC')
    							->get();
    	return view('admin.repayment_donation')->with('repaymentDonation',$repaymentDonation)->with('accessData',$accessData);
    }

    /**
     * @author 
     * Date: 
     */
    public function addRepaymentDonation()
    {
        $accessData = $this->getArray('repayment-donation',Auth::user()->fk_role_id);
    	return view('admin.repayment_donation_add')->with('accessData',$accessData);
    }

    /**
     * @author 
     * Date: 
     */
    public function saveRepaymentDonation(Request $request)
    {
    	$this->validate($request,[
			'start_date'                   => 'required',
			'region_repayment_amount'      => 'required',
			'yuva_mandal_repayment_amount' => 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		RepaymentDonationModel::create([
			'start_date'                      => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'                        => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'region_repayment_amount'         => Input::get('region_repayment_amount'),
			'yuva_mandal_repayment_amount'    => Input::get('yuva_mandal_repayment_amount'),
			'created_by'                      => Auth::user()->user_id,
		]);
		return redirect()->route('repayment-donation')->with('success','Repayment Donation has been added successfully');
    }

    /**
     * @author 
     * Date: 
     */
    public function editRepaymentDonation(Request $request)
    {
        $accessData = $this->getArray('repayment-donation',Auth::user()->fk_role_id);
    	$editRepaymentDonation = RepaymentDonationModel::where('repayment_donations_id',$request->repayment_donations_id)->first();
    	return view('admin.repayment_donation_edit')->with('editRepaymentDonation',$editRepaymentDonation)->with('accessData',$accessData);
    }

     /**
     * @author 
     * Date: 
     */
     public function updateRepaymentDonation(Request $request)
     {
     	$this->validate($request,[
			'start_date'                   => 'required',
			'region_repayment_amount'      => 'required',
			'yuva_mandal_repayment_amount' => 'required',
		]);
		if(Input::get('end_date') != ''){
		    $this->validate($request,[
			    'end_date'           => 'after:start_date'
		    ]);
		}
		RepaymentDonationModel::where('repayment_donations_id',$request->editId)->update(array('status' => '0'));
		RepaymentDonationModel::create([
			'start_date'                      => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date'                        => Input::filled('end_date')?date("Y-m-d", strtotime(Input::get('end_date'))):'',
			'region_repayment_amount'         => Input::get('region_repayment_amount'),
			'yuva_mandal_repayment_amount'    => Input::get('yuva_mandal_repayment_amount'),
			'updated_by'                      => Auth::user()->user_id,
		]);
		return redirect()->route('repayment-donation')->with('success','Repayment Donation has been updated successfully');
     }

     /**
     * @author 
     * Date: 
     */
     public function deleteRepaymentDonation(Request $request)
     {
     	RepaymentDonationModel::where('repayment_donations_id',$request->repayment_donations_id)->update(array('status' => '3'));
		return redirect()->route('repayment-donation')->with('success','Repayment Donation has been deleted successfully');
     }

     /**
     * @author 
     * Date: 
     */
     public function multipleDeleteRepaymentDonation(Request $request)
    {
        RepaymentDonationModel::whereIn('repayment_donations_id',explode(",",$request->ids))->update(array('status' => '3'));
        Session::flash('success', 'Repayment Donation has been deleted successfully.');
        return response()->json(['status'=>true,'message'=>"Repayment Donation has been deleted successfully."]);
    }
}
