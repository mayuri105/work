<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoleModel;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use App\RolePermissionModel;
use Auth;
class RoleController extends Controller{

    public function __construct()
    {
        $this->middleware('checkLogin');
    }
	/**
	 * @author 
	 * Date: 
	 */
    public function role(){
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('role',Auth::user()->fk_role_id);
        $listRoleData = RoleModel::where('status','1')->orderBy('role_id','DESC')->get();
        return view('admin.role')->with('listRoleData',$listRoleData)->with('accessData',$accessData);
    }


    /**
     * @author 
     * Date: 
     */
    public function addRole(){
        $accessData = $this->getArray('role',Auth::user()->fk_role_id);
        return view('admin.role_add')->with('accessData',$accessData);
    }


    /**
     * @author 
     * Date: 
     */
	public function saveRoleData(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:roles,name,3,status',
        ]);

        RoleModel::create([
            'name' => strtoupper(Input::get('name')),
            'created_by' => Auth::user()->user_id,
        ]);
    	return redirect('role-list')->with("success","Role has been added successfully.");
    }
    

    /**
     * @author 
     * Date: 
     */
    public function editRole(Request $request){
        $accessData = $this->getArray('role',Auth::user()->fk_role_id);
        $editRoleData = RoleModel::where('role_id',$request->role_id)->first();
        return view('admin.role_edit',['editRoleData' => $editRoleData,'accessData' => $accessData]);
    }


    /**
     * @author 
     * Date: 
     */
    public function updateRole(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$request->editId.',role_id,status,1',
        ]);
        RoleModel::where('role_id', $request->editId)->update(array(
            'name' => strtoupper(Input::get('name')),
            'updated_by' => Auth::user()->user_id,
        ));
        return redirect('role-list')->with("success","Role has been updated successfully.");

    }

    /**
     * @author 
     * Date: 
     */
    public function deleteRole(Request $request){
        $deleteRoleData = RoleModel::where('roles.status','1')->where('roles.role_id',$request->role_id)
                        ->update(array('roles.status' => '3'));
        RolePermissionModel::where('role_permissions.fk_role_id',$request->role_id)->delete();
        Session::flash('success', 'Role has been deleted successfully.');
        return redirect('role-list');
    }


    /**
     * @author 
     * Date: 
     */
    public function multipleDeleteRole(Request $request)
    {   
        RoleModel::whereIn('role_id',explode(",",$request->ids))->update(array('status' => '3'));
         RolePermissionModel::whereIn('fk_role_id',explode(",", $request->ids))->delete();
        Session::flash('success', 'Roles has been deleted successfully.');
        return response()->json(['status'=>true,'message'=>"Role has been deleted successfully."]);   
    }

}
