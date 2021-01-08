<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\RolePermissionModel;
use App\RoleModel;
use App\ModuleModel;
use App\ModulePageModel;
use Illuminate\Support\Facades\Input;
use Auth;
class RolePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkLogin');
    }
    /**
     * @author 
     * Date: 
     */
    public function listRolePermission(){
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('role-permission',Auth::user()->fk_role_id);
        $rolePermissionData =  DB::table('role_permissions')
                ->select('role_permissions.role_permissions_id','role_permissions.fk_role_id','role_permissions.fk_page_id','role_permissions.created_at','roles.role_id','roles.name')
                ->join('roles','roles.role_id','=','role_permissions.fk_role_id')
                ->groupBy('role_permissions.fk_role_id')
                ->orderBy('role_permissions_id', 'DESC')
                ->get();
        return view('admin.role_permission',['rolePermissionData' => $rolePermissionData,'accessData' => $accessData]);
    }

    /**
     * @author 
     * Date: 
     */
    public function addRolePermission(){
        $accessData = $this->getArray('role-permission',Auth::user()->fk_role_id);
        $rolePermissionData =  DB::table('role_permissions')
                ->select('roles.role_id')
                ->join('roles','roles.role_id','=','role_permissions.fk_role_id')
                ->groupBy('role_permissions.fk_role_id')
                ->get();
        
        $roleIdData = array();
        foreach ($rolePermissionData as $row) {
            $roleIdData[] = $row->role_id;
        }
        
        $roleData = DB::table('roles')
                    ->whereNotIn('role_id', $roleIdData)
                    ->where('roles.status','1')
                    ->get();
        
        $listRoleData = RoleModel::where('status','1')->get();
        $moduleData = ModuleModel::where('status','1')->get();
        
        $modulePage = array();
        foreach ($moduleData as $moduleDatas) {
            $modulePageData = ModulePageModel::where(['status' => '1','fk_module_id' => $moduleDatas->module_id])->get();
            foreach ($modulePageData as $modulePageDatas) {
                $modulePage[$moduleDatas->name][] = array(
                    'page_id' => $modulePageDatas->page_id,
                    'parent_page_id' => $modulePageDatas->parent_page_id,
                    'page_title' => $modulePageDatas->page_title,
                    'page_slug' => $modulePageDatas->page_slug
                );
            }
        }
       // dd($modulePageData);
        return view('admin.role_permission_add')->with('roleData',$roleData)->with('listRoleData',$listRoleData)->with('modulePage',$modulePage)->with('accessData',$accessData);
    }    


    /**
     * @author 
     * Date: 
     */
    public function saveRolePermission(Request $request)
    {
        $this->validate($request,[
            'role_type' => 'required',
            'page_slugs' => 'required',
        ]);
        
        $saveRolePermissionData = Input::all();
        $rolePermissionArray = array();
        foreach ($saveRolePermissionData['page_slugs'] as $key => $value) {
            $rolePermissionArray[] = array(
                "fk_role_id" => $saveRolePermissionData['role_type'],
                "fk_page_id" => $value,
                "created_by" => '1',
                "updated_by" => '1',
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => Auth::user()->user_id,
            );
        }
        $insertRole = RolePermissionModel::insert($rolePermissionArray);
        return redirect()->route('list-role-permission')->with("success","Role Permission has been added successfully.");
    }


    /**
     * @author 
     * Date: 
     */
    public function editRolePermission($id)
    {
        $accessData = $this->getArray('role-permission',Auth::user()->fk_role_id);
        $listRoleData = RoleModel::where('role_id',$id)->get();
        $rolePermissionData = RolePermissionModel::where('fk_role_id',$id)->get();
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
        return view('admin.role_permission_edit')->with('listRoleData',$listRoleData[0])->with(['currentPageId'=>$role_fk_page_id,'role_id'=>$id,'modulePage'=>$modulePage,'accessData' => $accessData]);
    }


    /**
     * @author 
     * Date: 
     */
    public function updateRolePermission(Request $request)
    {
        $this->validate($request,[
            'role_type' => 'required',
            'page_slugs' => 'required',
        ]);
        $updateRole = Input::all();
        $updateRoleArray = array();
        $delRole = RolePermissionModel::where('fk_role_id',$updateRole['role_type'])->delete();
        foreach ($updateRole['page_slugs'] as $key => $value) {
            $updateRoleArray[] = array(
                "fk_role_id" => $updateRole['role_type'],
                "fk_page_id" => $value,
                "created_by" => '1',
                "updated_by" => '1',
                "updated_by" => Auth::user()->user_id,
                "updated_at" => date('Y-m-d H:i:s'),
            );
        }
        $updateRoleData = RolePermissionModel::insert($updateRoleArray);
        return redirect()->route('list-role-permission')->with("success","Role Permission has been updated successfully.");
    }

    /**
     * @author 
     * Date: 
     */
    public function deleteRolePermission($id)
    {
        $deleteRolePermissionData = RolePermissionModel::where('fk_role_id',$id)->delete();
        return redirect()->route('list-role-permission')->with("success","Role Permission has been deleted successfully.");
    }

    /**
     * @author 
     * Date: 
     */
    public function multipleDeleteRolePermission(Request $request)
    {
        RolePermissionModel::whereIn('fk_role_id',explode(",",$request->ids))->delete();
        Session::flash('success', 'Role Permission has been deleted successfully.');
        return response()->json(['status'=>true,'message'=>"Role Permission deleted successfully."]);   
    }
}
