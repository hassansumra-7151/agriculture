<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{


     public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['index']]);
        $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:update role', ['only' => ['update','edit']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    
    public function create(){
    	return view('admin.role-permission.role.create');
    }

    public function list(){
    	$roles = Role::get();
    	return view('admin.role-permission.role.index' , compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
                'name' => 'required|string|unique:roles,name',
            ]);
        $data = [
            'name'=>$request->name,
        ];
       $create = Role::create($data);
	        return response()->json(['message' => 'Role Added successfully!']);
        
    }

    public function edit($id){
    	$role = Role::find($id);
    	return view('admin.role-permission.role.create' , compact('role'));
    }

    public function update(Request $request, $id)
	{
	    $request->validate([
	        'name' => 'required|string|unique:permissions,name,' . $id,
	    ]);
	    $role = Role::find($id);

	    if (!$role) {
	        return response()->json(['message' => 'Role not found.'], 404);
	    }

	    $role->name = $request->name;
	    $role->save();
	    return response()->json(['message' => 'Role Updated successfully!']);
	}
	public function destroy($id)
	{
	    $role = Role::find($id);

	    if ($role) {
	        $role->delete();
	        return response()->json(['message' => 'role deleted successfully!']);
	    }

	    return response()->json(['message' => 'role not found.'], 404);
	}

	public function addPermissionToRole($roleId) 
    {
       $permissions = Permission::all();
        $role = Role::findOrFail($roleId);
        $assignedPermissions = $role->permissions->pluck('id')->toArray();
        return view('admin.role-permission.role.add-permission', [
            'permissions' => $permissions,
            'assignedPermissions' => $assignedPermissions,
            'role' => $role,
        ]);
      
  }

  public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required|array',
        ]);

            $role = Role::findOrFail($roleId);
            $get = $role->syncPermissions($request->permission);
             return response()->json(['message' => 'Permission Updated successfully!']);
          
    }


	
}
