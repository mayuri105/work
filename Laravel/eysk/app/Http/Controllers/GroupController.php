<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupModel;
use Input;
use Session;
use Auth;
class GroupController extends Controller
{
    public function __construct()
	{
		$this->middleware('checkLogin');
	}
    
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function group()
    {
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('group',Auth::user()->fk_role_id);
    	$getSubGroupName = GroupModel::where(['groups.status'=>1])
		->select(
			'groups.*',
			'groups_new.group_name as parent_menu_title'
		)
		->leftJoin('groups as groups_new', 'groups.fk_group_id', '=', 'groups_new.group_id')
		->where('groups.fk_group_id', '!=', 'groups_new.group_id')
		->orderBy('groups.group_id','DESC')->get();
		return view('admin.group')->with('getSubGroupName',$getSubGroupName)->with('accessData',$accessData);
    }
    
	/**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function addGroup()
    {
        $accessData = $this->getArray('group',Auth::user()->fk_role_id);
    	$getGroupName = GroupModel::where(['groups.status'=>1])
		->select(
			'groups.*',
			'groups_new.group_name as parent_menu_title'
		)
		->leftJoin('groups as groups_new', 'groups.fk_group_id', '=', 'groups_new.group_id')
		->where('groups.fk_group_id', '=', '0')
		->get();

		$getSubGroupName = GroupModel::where(['groups.status'=>1])
		->select(
			'groups.*',
			'groups_new.group_name as parent_menu_title'
		)
		->leftJoin('groups as groups_new', 'groups.fk_group_id', '=', 'groups_new.group_id')
		->where('groups.fk_group_id', '!=', 'groups_new.group_id')
		->get();

    	return view('admin.group_add')->with('getGroupName',$getGroupName)->with('getSubGroupName',$getSubGroupName)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function saveGroup(Request $request)
    {
    	$getGroup = GroupModel::where('status','1')->where('group_id',Input::get('fk_group_id'))->first();

    	$this->validate($request,[
			'group_name' => 'required|unique:groups,group_name,3,status',
			'fk_group_id' => 'required',
		]);

    	GroupModel::create([
    		'group_name'     => strtoupper(Input::get('group_name')),
    		'fk_group_id'    => Input::get('fk_group_id'),
    		'group_sheet'    => $getGroup['group_sheet'],
    		'group_division' => $getGroup['group_division'],
    		'group_type'     => '2',
    		'status'	     => $getGroup['status'],
    		'created_by'     => Auth::user()->user_id,
    	]);
    	return redirect()->route('group')->with('success','Group has been added successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function editGroup(Request $request)
    {
        $accessData = $this->getArray('group',Auth::user()->fk_role_id);
    	$getGroupName = GroupModel::where(['groups.status'=>1])
		->select(
			'groups.*',
			'groups_new.group_name as parent_menu_title'
		)
		->leftJoin('groups as groups_new', 'groups.fk_group_id', '=', 'groups_new.group_id')
		->where('groups.fk_group_id', '=', '0')
		->get();

		$getSubGroupName = GroupModel::where(['groups.status'=>1])
		->where('groups.group_id','!=',$request->group_id)
		->select(
			'groups.*',
			'groups_new.group_name as parent_menu_title'
		)
		->leftJoin('groups as groups_new', 'groups.fk_group_id', '=', 'groups_new.group_id')
		->where('groups.fk_group_id', '!=', 'groups_new.group_id')
		//->where('groups_new.group_id','<>',$request->group_id)
		->get();
		//dd($getSubGroupName->toArray());
		$editGroup = GroupModel::where('status','1')->where('group_id',$request->group_id)->first();

		return view('admin.group_edit')->with('getGroupName',$getGroupName)->with('getSubGroupName',$getSubGroupName)->with('editGroup',$editGroup)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function updateGroup(Request $request)
    {
    	$getGroup = GroupModel::where('status','1')->where('group_id',Input::get('fk_group_id'))->first();

    	$this->validate($request,[
			'group_name' => 'required|unique:groups,group_name,'.$request->editId.',group_id,status,1',
		]);

    	GroupModel::where('group_id',$request->editId)->update(array(
    		'group_name'     => strtoupper(Input::get('group_name')),
    		'fk_group_id'    => Input::get('fk_group_id'),
    		'group_sheet'    => $getGroup['group_sheet'],
    		'group_division' => $getGroup['group_division'],
    		'group_type'     => '2',
    		'status'	     => $getGroup['status'],
    		'updated_by'     => Auth::user()->user_id,
    	));
    	return redirect()->route('group')->with('success','Group has been updated successfully');
    }


}
