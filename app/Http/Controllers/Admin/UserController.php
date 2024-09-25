<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

	
	public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create','store']]);
        $this->middleware('permission:update user', ['only' => ['update','edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }
    public function create()
    {
    	$roles = Role::pluck('name','name')->all();
    	return view('admin.role-permission.user.create',[
        	'roles' => $roles
       ]);
    }

    public function store(Request $request)
	{
		$request->validate([
		'name' =>'required|string|max:550',
		'email' =>'required|email|max:550|unique:users,email',
		'password' =>'required|string|min:6|max:12',
		'roles' =>'required',
		]);

		$user = User::create([
		'name' => $request->name,
		'email' => $request->email,
		'password' => Hash::make($request->password),
		]);
		$user->syncRoles($request->roles);
		return response()->json(['message' => 'User Added successfully!']);
	}

	public function list()
    {
        $users = User::all();
        return view('admin.role-permission.user.index',[
        	'users' => $users

        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();

        return view('admin.role-permission.user.create', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }
     public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|max:12',
            'roles' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        $user->syncRoles($request->roles);
        
        return response()->json(['message' => 'User Updated successfully!']);
    }

     public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully!']);
    }
}
