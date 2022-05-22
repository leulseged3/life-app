<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EndUser;

class UserController extends Controller
{
    function index(){
        $users = EndUser::all();
        return view('users.index')->with('users',$users);
    }

    function update(Request $request){
        //send validation error via session or other way or $errors
        $user = EndUser::find($request->user_id);
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
            return redirect()->back()->with('message','User updates successfully!');
        } else {
            return redirect()->back()->with('message','Oops, something went wrong!');
        }
    }
}
