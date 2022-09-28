<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index(){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'VIEW_USER')){
            return redirect()->back();
        }

        $users = User::where('is_mhp',0)->paginate(5);
        return view('users.index')->with('users',$users);
    }

    function update(Request $request){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'UPDATE_USER')){
            return redirect()->back();
        }

        if(!$request->first_name && !$request->last_name){
            return redirect()->back();
        }
        //send validation error via session or other way or $errors
        $user = User::find($request->user_id);
        if($request->first_name) {
            $user->first_name = $request->first_name;
        }
        if($request->last_name) {
            $user->last_name = $request->last_name;
        }
        if($request->email) {
            $user->email = $request->email;
        }
        if($request->username) {
            $user->username = $request->username;
        }
        if($request->mobile_number) {
            $user->mobile_number = $request->mobile_number;
        }
        if($user->save()) {
            return redirect()->back()->with('message',$user->first_name." ".$user->last_name.' info updated successfully!');
        } else {
            return redirect()->back();
        }
    }

    function delete(Request $request){
        $permissions = [];
        
        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'DELETE_USER')){
            return redirect()->back();
        }

        $user = User::find($request->user_id);
        if($user->delete()){
            return redirect()->route('users-home')->with('message',$user->first_name." ".$user->last_name.' deleted successfully!');
        } else {
            return redirect()->back();
        }
    }
}
