<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MhpController extends Controller
{
    function index(){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'VIEW_MHP')){
            return redirect()->back();
        }

        $mhps = User::where('is_mhp', 1)->paginate(5);

        return view('mhps.index')->with('mhps',$mhps);
    }

    function update(Request $request){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'UPDATE_MHP')){
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
        if(!user_is_authorized($permissions, 'DELETE_MHP')){
            return redirect()->back();
        }

        $user = User::find($request->user_id);
   
        if($user->delete()){
            return redirect()->route('mhps-home')->with('message',$user->first_name." ".$user->last_name.' deleted successfully!');
        } else {
            return redirect()->back();
        }
    }

    function show($id){
        $permissions = [];
        
        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'VIEW_MHP')){
            return redirect()->back();
        }

        $mhp = User::find($id);
        return view('mhps.detail')->with('mhp', $mhp);
    }
}
