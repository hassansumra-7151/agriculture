<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{


	 public function __construct()
    {
        $this->middleware('permission:view permission', ['only' => ['index']]);
        $this->middleware('permission:create permission', ['only' => ['create','store']]);
        $this->middleware('permission:update permission', ['only' => ['update','edit']]);
        $this->middleware('permission:delete permission', ['only' => ['destroy']]);
    }
    
    public function create(){
    	return view('admin.role-permission.permission.create');
    }
    public function store(Request $request)
    {
        $request->validate([
                'name' => 'required|string|unique:permissions,name',
            ]);

       $data = [
            'name'=>$request->name,
        ];
       $create = Permission::create($data);
	        return response()->json(['message' => 'Permission Added successfully!']);
        
     }
     public function index(){
    	$permissions = Permission::get();
    	return view('admin.role-permission.permission.index' ,compact('permissions'));
    }
   public function edit($id)
	{
	    $permission = Permission::find($id);
	    if (!$permission) {
	        return redirect()->route('permission.index')->with('error', 'Permission not found');
	    }

	    return view('admin.role-permission.permission.create', compact('permission'));
	}
	public function update(Request $request, $id)
	{
	    $request->validate([
	        'name' => 'required|string|unique:permissions,name,' . $id,
	    ]);
	    $permission = Permission::find($id);

	    if (!$permission) {
	        return response()->json(['message' => 'Permission not found.'], 404);
	    }

	    $permission->name = $request->name;
	    $permission->save();
	    return response()->json(['message' => 'Permission Updated successfully!']);
	}
	public function destroy($id)
	{
	    $permission = Permission::find($id);

	    if ($permission) {
	        $permission->delete();
	        return response()->json(['message' => 'Permission deleted successfully!']);
	    }

	    return response()->json(['message' => 'Permission not found.'], 404);
	}

   
}
