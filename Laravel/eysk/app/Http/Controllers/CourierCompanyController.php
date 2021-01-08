<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourierCompanyModel;
use Input;
use Session;
use Auth;
class CourierCompanyController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkLogin');
	}
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function courierCompanyDetails()
    {
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
    	$listCourierCompany = CourierCompanyModel::where('status','1')->orderBy('courier_company_id','DESC')->get();
    	return view('admin.courier_company')->with('listCourierCompany',$listCourierCompany);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function addCourierCompanyDetails()
    {
    	return view('admin.courier_company_add');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function saveCourierComapnyDetails(Request $request)
    {
    	$this->validate($request,[
			'courier_company_name' => 'required|unique:courier_companys,courier_company_name,3,status',
			'company_address' 	   => 'required',
			'contact_person_name'  => 'required',
			'contact_no'		   => 'required|unique:courier_companys,contact_no,3,status',
		]);
		CourierCompanyModel::create([
			'courier_company_name' => Input::get('courier_company_name'),
			'company_address'	   => Input::get('company_address'),
			'contact_person_name'  => Input::get('contact_person_name'),
			'contact_no'		   => Input::get('contact_no'),
			'created_by'           => Auth::user()->user_id,
		]);
		return redirect()->route('courier-company')->with('success','Courier Company Details has been added successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function editCourierCompanyDetails(Request $request)
    {
    	$editCourierDetails = CourierCompanyModel::where('courier_company_id',$request->courier_company_id)->first();
    	return view('admin.courier_company_edit')->with('editCourierDetails',$editCourierDetails);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function updateCourierCompanyDetails(Request $request)
    {
    	$this->validate($request,[
			'courier_company_name' => 'required|unique:courier_companys,courier_company_name,'.$request->editId.',courier_company_id,status,1',
			'company_address' 	   => 'required',
			'contact_person_name'  => 'required',
			'contact_no' 		   => 'required|unique:courier_companys,contact_no,'.$request->editId.',courier_company_id,status,1',
		]);
		
		CourierCompanyModel::where('courier_company_id',$request->editId)->update(array(
			'courier_company_name' => Input::get('courier_company_name'),
			'company_address'	   => Input::get('company_address'),
			'contact_person_name'  => Input::get('contact_person_name'),
			'contact_no'		   => Input::get('contact_no'),
			'updated_by'           => Auth::user()->user_id,
		));
		return redirect()->route('courier-company')->with('success','Courier Company Details has been updated successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function changeDefaltCourierStatus($id)
    {
		CourierCompanyModel::where('courier_company_id',$id)->update(array('default_status' => '1'));
		return redirect()->route('courier-company');
    }
    
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function deactiveStatus($id)
    {
    	CourierCompanyModel::where('courier_company_id','=',$id)->update(array('default_status' => '0'));
    	return redirect()->route('courier-company');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function deleteCourierCompanyDetails(Request $request)
    {
		CourierCompanyModel::where('courier_company_id',$request->courier_company_id)->update(array('status'=>'3'));
		return redirect()->route('courier-company')->with('success','Courier Company Details has been deleted successfully');

    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function multipleDeleteCourierCompanyDetails(Request $request)
    {
    	CourierCompanyModel::whereIn('courier_company_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Courier Company details deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Courier Company details deleted successfully."]);
    }
}
