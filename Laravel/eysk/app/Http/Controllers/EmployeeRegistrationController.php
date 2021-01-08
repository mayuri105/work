<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeRegistrationModel;
use App\EmployeeRegistrationDocumentUploadModel;
use App\EmployeePaymentModel;
use App\RolePermissionModel;
use App\ModuleModel;
use App\ModulePageModel;
use Input;
use Session;
use Auth;
use DB;
use App\User;
use Hash;

class EmployeeRegistrationController extends Controller
{
    public function __construct()
	{
		$this->middleware('checkLogin');
	}
	
    public function employeeRegistration()
    {
        $employeeRegistrationData = EmployeeRegistrationModel::where('status','0')->get();
        $accessData = $this->getArray('employee-registration',Auth::user()->fk_role_id);
    	return view('admin.employee_registration')->with('employeeRegistrationData',$employeeRegistrationData)->with('accessData',$accessData);
    }

    public function addEmployeeRegistration()
    {
        $accessData = $this->getArray('employee-registration',Auth::user()->fk_role_id);
        $roleData = DB::table('roles')
                    //->whereNotIn('role_id', $roleIdData)
        ->where('roles.status','1')
        ->get(); 
        $getProcessingId   = EmployeeRegistrationModel::get();
        foreach ($getProcessingId as $key => $value) {
            $employeeNumber  = $value['employee_number'];
        }
        $expldEmployeeId = explode('-', $employeeNumber);
        $autoIncrement     = $expldEmployeeId[1]+1;
    	return view('admin.employee_registration_add')->with('expldEmployeeId',$expldEmployeeId[0])->with('autoIncrement',$autoIncrement)->with('accessData',$accessData)->with('roleData',$roleData);
    }

    public function saveEmployeeRegistration(Request $request)
    {
        $this->validate($request,[
            'joining_date'                 => 'required',
            'employee_number'              => 'required',
            'employee_password'            => 'required',
            'employee_name'                => 'required',
            'employee_email'               => 'required',
            'employee_first_phone_number'  => 'required',
            'employee_address'             => 'required',
            'timing_am'                    => 'required',
            'timing_pm'                    => 'required',
            'salary'                       => 'required',
            'start_date'                   => 'required',
            'end_date'                     => 'required',
            'fk_role_id'                   => 'required',
        ]);
        EmployeeRegistrationModel::create([
            'joining_date'                 => date('Y-m-d',strtotime(Input::get('joining_date'))),
            'employee_number'              => Input::get('employee_number'),
            'employee_name'                => strtoupper(Input::get('employee_name')),
            'employee_email'               => Input::get('employee_email'),
            'employee_password'            => Input::get('employee_password'),
            'employee_first_phone_number'  => Input::get('employee_first_phone_number'),
            'employee_second_phone_number' => Input::filled('employee_second_phone_number') ? Input::get('employee_second_phone_number'): '',
            'employee_address'             => strtoupper(Input::get('employee_address')),
            'timing_am'                    => date(Input::get('timing_am')),
            'timing_pm'                    => date(Input::get('timing_pm')),
            'employee_details'             => Input::filled('employee_details') ? strtoupper(Input::get('employee_details')):'',
            'salary'                       => implode(',', Input::get('salary')),
            'start_date'                   => implode(',', Input::get('start_date')),
            'end_date'                     => implode(',', Input::get('end_date')),
            'fk_role_id'                   => Input::get('fk_role_id'),
            'completion_date'              => Input::filled('completion_date')?date('Y-m-d',strtotime(Input::get('completion_date'))):'',
            'created_by'                   => Auth::user()->user_id,
        ]);
        $getRegistrationId = EmployeeRegistrationModel::get();
        foreach ($getRegistrationId as $key => $value) {
            $registrationId = $value['employee_registration_id'];
        }


        $salary = $request->salary;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        for($count = 0; $count < count($salary); $count++)
        {
             $data = array(
                'fk_employee_id' => $registrationId,     
                'salary'      => $salary[$count],
                'start_date'  => date('Y-m-d',strtotime($start_date[$count])),
                'end_date'    => date('Y-m-d',strtotime($end_date[$count])),
            );
             $insert_data[] = $data; 
        }

        EmployeePaymentModel::insert($insert_data);

        $updateRole = Input::all();
        $updateRoleArray = array();
        $delRole = RolePermissionModel::where('fk_role_id',Input::get('fk_role_id'))->delete();
        foreach ($updateRole['page_slugs'] as $key => $value) {
            $updateRoleArray[] = array(
                "fk_role_id" => Input::get('fk_role_id'),
                "fk_page_id" => $value,
                "updated_by" => Auth::user()->user_id,
                "updated_at" => date('Y-m-d H:i:s'),
            );
        }
        $updateRoleData = RolePermissionModel::insert($updateRoleArray);
        User::create([
            "fk_role_id" => Input::get('fk_role_id'),
            "fk_employee_id" => $registrationId,
            "email"      => Input::get('employee_email'),
            "name"       => strtoupper(Input::get('*employee_name')),
            "password"   => Hash::make(Input::get('employee_password')),
        ]);

        if($request->hasfile('employee_govt_document'))
        {
            foreach($request->file('employee_govt_document') as $file)
            {
                $name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $file->move('assets/uploads/employee_govt_image/', $name);
                EmployeeRegistrationDocumentUploadModel::create([
                    'fk_employee_id'            => $registrationId,
                    'document_upload_status'    => '1',
                    'document_upload'           => $name,
                    'upload_document_extension' => $extension,
                    'created_by'                => Auth::user()->user_id,
                ]); 
            }
        }

        if($request->hasfile('employee_resume'))
        {
            foreach($request->file('employee_resume') as $file)
            {
                $name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $file->move('assets/uploads/employee_resume/', $name);
                EmployeeRegistrationDocumentUploadModel::create([
                    'fk_employee_id'            => $registrationId,
                    'document_upload_status'    => '2',
                    'document_upload'           => $name,
                    'upload_document_extension' => $extension,
                    'created_by'                => Auth::user()->user_id,
                ]); 
            }
        }

        if($request->hasfile('completion_document'))
        {
            foreach($request->file('completion_document') as $file)
            {
                $name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $file->move('assets/uploads/employee_completion_document/', $name);
                EmployeeRegistrationDocumentUploadModel::create([
                    'fk_employee_id'            => $registrationId,
                    'document_upload_status'    => '3',
                    'document_upload'           => $name,
                    'upload_document_extension' => $extension,
                    'created_by'                => Auth::user()->user_id,
                ]); 
            }
        }
        return redirect()->route('employee-registration')->with('success','Employee Registration has been added.');
    }

    public function editEmployeeRegistration(Request $request)
    {
        $accessData = $this->getArray('employee-registration',Auth::user()->fk_role_id);
        $editEmployeeRegistrationData = EmployeeRegistrationModel::where('employee_registration_id',$request->id)
        ->select('employee_registrations.*',
            'roles.name',
        )
        ->leftJoin('roles','roles.role_id','=','employee_registrations.fk_role_id')->first();
        $employeeSalaryDetails = EmployeePaymentModel::where('fk_employee_id',$request->id)->get();
        $rolePermissionData = RolePermissionModel::where('fk_role_id',$editEmployeeRegistrationData['fk_role_id'])->get();
        $role_fk_page_id = array();
        foreach ($rolePermissionData as $key => $rolePermissionDataValue) {
            $role_fk_page_id[] = $rolePermissionDataValue['fk_page_id'];
        }

        $rolePermissionRoleId = DB::table('role_permissions')
                                ->select('roles.role_id')
                                ->join('roles','roles.role_id','=','role_permissions.fk_role_id')
                                ->groupBy('role_permissions.fk_role_id')
                                ->get();

        $moduleData = ModuleModel::where('status','1')->get();
        $modulePage = array();
        foreach ($moduleData as $moduleDatas) {
            $modulePageData = ModulePageModel::where('status','1')->where('fk_module_id',$moduleDatas->module_id)->get();
            foreach ($modulePageData as $modulePageDatas) {
                $modulePage[$moduleDatas->name][] = array(
                    "page_id" => $modulePageDatas->page_id,
                    "page_slug" => $modulePageDatas->page_slug,
                    "parent_page_id" => $modulePageDatas->parent_page_id,
                    "page_title" => $modulePageDatas->page_title
                );
            }
        }
        $govtDocument = EmployeeRegistrationDocumentUploadModel::where('fk_employee_id',$request->id)->where('document_upload_status','1')->get()->toArray();
        $resumeDocument = EmployeeRegistrationDocumentUploadModel::where('fk_employee_id',$request->id)->where('document_upload_status','2')->get()->toArray();
        $completionDocument = EmployeeRegistrationDocumentUploadModel::where('fk_employee_id',$request->id)->where('document_upload_status','3')->get()->toArray();
    	return view('admin.employee_registration_edit')->with('accessData',$accessData)->with('editEmployeeRegistrationData',$editEmployeeRegistrationData)->with('govtDocument',$govtDocument)->with('employeeSalaryDetails',$employeeSalaryDetails)->with('resumeDocument',$resumeDocument)->with('completionDocument',$completionDocument)->with('modulePage',$modulePage)->with(['currentPageId'=>$role_fk_page_id,'role_id'=>$editEmployeeRegistrationData['fk_role_id'],'modulePage'=>$modulePage]);
    }

    public function updateEmployeeRegistration(Request $request)
    {
        $this->validate($request,[
            'joining_date'                 => 'required',
            'employee_number'              => 'required',
            'employee_password'            => 'required',
            'employee_name'                => 'required',
            'employee_email'               => 'required',
            'employee_first_phone_number'  => 'required',
            'employee_address'             => 'required',
            'timing_am'                    => 'required',
            'timing_pm'                    => 'required',
            'salary'                       => 'required',
            'start_date'                   => 'required',
            'end_date'                     => 'required',
            'fk_role_id'                   => 'required',
        ]);
        EmployeeRegistrationModel::where('employee_registration_id',$request->editId)->update(array(
            'joining_date'                 => date('Y-m-d',strtotime(Input::get('joining_date'))),
            'employee_number'              => Input::get('employee_number'),
            'employee_name'                => strtoupper(Input::get('employee_name')),
            'employee_email'               => Input::get('employee_email'),
            'employee_password'            => Input::get('employee_password'),
            'employee_first_phone_number'  => Input::get('employee_first_phone_number'),
            'employee_second_phone_number' => Input::filled('employee_second_phone_number') ? Input::get('employee_second_phone_number') : '',
            'employee_address'             => strtoupper(Input::get('employee_address')),
            'timing_am'                    => date(Input::get('timing_am')),
            'timing_pm'                    => date(Input::get('timing_pm')),
            'employee_details'             => Input::filled('employee_details') ? strtoupper(Input::get('employee_details')):'',
            'fk_role_id'                   => Input::get('fk_role_id'),
            'completion_date'              => Input::filled('completion_date')?date('Y-m-d',strtotime(Input::get('completion_date'))):'',
            'updated_by'                   => Auth::user()->user_id,
        ));

        EmployeePaymentModel::where('fk_employee_id',$request->editId)->delete();
        $salary = $request->salary;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        for($count = 0; $count < count($salary); $count++)
        {
             $data = array(
                'fk_employee_id' => $request->editId,     
                'salary'      => $salary[$count],
                'start_date'  => date('Y-m-d',strtotime($start_date[$count])),
                'end_date'    => date('Y-m-d',strtotime($end_date[$count])),
            );
             $insert_data[] = $data; 
        }

        EmployeePaymentModel::insert($insert_data);

        $updateRole = Input::all();
        $updateRoleArray = array();
        $delRole = RolePermissionModel::where('fk_role_id',Input::get('fk_role_id'))->delete();
        foreach ($updateRole['page_slugs'] as $key => $value) {
            $updateRoleArray[] = array(
                "fk_role_id" => Input::get('fk_role_id'),
                "fk_page_id" => $value,
                "updated_by" => Auth::user()->user_id,
                "updated_at" => date('Y-m-d H:i:s'),
            );
        }
        $updateRoleData = RolePermissionModel::insert($updateRoleArray);

        User::where('fk_employee_id',$request->editId)->update(array(
            "email"      => Input::get('employee_email'),
            "password"   => Hash::make(Input::get('employee_password')),
        ));

        if($request->hasfile('employee_govt_document'))
        {
            foreach($request->file('employee_govt_document') as $file)
            {
                $name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $file->move('assets/uploads/employee_govt_image/', $name);
                EmployeeRegistrationDocumentUploadModel::create([
                    'fk_employee_id'            => $request->editId,
                    'document_upload_status'    => '1',
                    'document_upload'           => $name,
                    'upload_document_extension' => $extension,
                    'updated_by'                => Auth::user()->user_id,
                ]); 
            }
        }

        if($request->hasfile('employee_resume'))
        {
            foreach($request->file('employee_resume') as $file)
            {
                $name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $file->move('assets/uploads/employee_resume/', $name);
                EmployeeRegistrationDocumentUploadModel::create([
                    'fk_employee_id'            => $request->editId,
                    'document_upload_status'    => '2',
                    'document_upload'           => $name,
                    'upload_document_extension' => $extension,
                    'updated_by'                => Auth::user()->user_id,
                ]); 
            }
        }
        if($request->hasfile('completion_document'))
        {
            foreach($request->file('completion_document') as $file)
            {
                $name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $file->move('assets/uploads/employee_completion_document/', $name);
                EmployeeRegistrationDocumentUploadModel::create([
                    'fk_employee_id'            => $request->editId,
                    'document_upload_status'    => '3',
                    'document_upload'           => $name,
                    'upload_document_extension' => $extension,
                    'updated_by'                => Auth::user()->user_id,
                ]); 
            }
        }
        return redirect()->route('employee-registration')->with('success','Employee Registration has benn updated successfully.');
    }

    public function viewEmployeeRegistration(Request $request)
    {
        $accessData = $this->getArray('employee-registration',Auth::user()->fk_role_id);
        $viewEmployeeRegistrationData = EmployeeRegistrationModel::where('employee_registration_id',$request->id)->first();
        $employeeSalaryDetails = EmployeePaymentModel::where('fk_employee_id',$request->id)->get();
        $govtDocument = EmployeeRegistrationDocumentUploadModel::where('fk_employee_id',$request->id)->where('document_upload_status','1')->get()->toArray();
        $resumeDocument = EmployeeRegistrationDocumentUploadModel::where('fk_employee_id',$request->id)->where('document_upload_status','2')->get()->toArray();
        $completionDocument = EmployeeRegistrationDocumentUploadModel::where('fk_employee_id',$request->id)->where('document_upload_status','3')->get()->toArray();
        return view('admin.employee_registration_view')->with('viewEmployeeRegistrationData',$viewEmployeeRegistrationData)->with('govtDocument',$govtDocument)->with('resumeDocument',$resumeDocument)->with('completionDocument',$completionDocument)->with('employeeSalaryDetails',$employeeSalaryDetails)->with('accessData',$accessData);
    }

    public function deleteEmployeeRegistration(Request $request)
    {
       EmployeeRegistrationModel::where('employee_registration_id',$request->id)->update(array(
            'status' => '3',
       ));
       EmployeeRegistrationDocumentUploadModel::where('fk_employee_id',$request->id)->update(array(
            'status' => '3',
       ));
       EmployeePaymentModel::where('fk_employee_id',$request->id)->delete();
       User::where('fk_employee_id',$request->id)->delete();
       return redirect()->route('employee-registration')->with('success','Employee Registration has been deleted.');
    }

    public function multipleDeleteEmployeeRegistration(Request $request)
    {
        EmployeeRegistrationModel::whereIn('employee_registration_id',explode(",",$request->ids))->update(array('status' => '3'));
        EmployeeRegistrationDocumentUploadModel::whereIn('fk_employee_id',explode(",", $request->ids))->update(array('status' => '3'));
        EmployeePaymentModel::whereIn('fk_employee_id',explode(",", $request->ids))->delete();
        User::whereIn('fk_employee_id',explode(",", $request->ids))->delete();
        Session::flash('success', 'Employee Registration has been deleted successfully.');
        return response()->json(['status'=>true,'message'=>"Employee Registration has been deleted successfully."]);
    }

    public function deleteUploadEmployeeDocument(Request $request)
    {
        $deleteDocument = EmployeeRegistrationDocumentUploadModel::where('employee_registration_document_upload_id',$request->id)->delete();
        //dd($deleteDocument);
        $responseData = array("success" => "1");
        echo json_encode($responseData);
        exit;
    }
}
