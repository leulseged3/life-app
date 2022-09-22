<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index(){
        if (!Auth::user()->is_super_admin) return redirect()->back();

        $roles = Role::paginate(5);

        return view('roles.index')->with('roles', $roles);
    }

    public function create(Request $request){
        if (!Auth::user()->is_super_admin) return redirect()->back();

        Validator::make($request->all(), [
            'name' => 'required|string|unique:roles',
            "permissions"    => "required|array|min:1",
            "permissions.*"  => "required|string|distinct|min:1",
        ])->validate();
        
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        $role->permissions()->attach($request->permissions);

        return redirect()->back()->with('message', 'Role is created successfully!');
    }

    public function delete(Request $request) {
        if (!Auth::user()->is_super_admin) return redirect()->back();

       $role = Role::find($request->role_id);

       if($role) {
        $role->delete();
        return redirect()->route('roles-home')->with('message', 'Role is deleted successfully');
       }
       return redirect()->back();
    }
}
