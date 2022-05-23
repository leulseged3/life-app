<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enduser;

class MhpController extends Controller
{
    function index(){
        $mhps = Enduser::where('is_mhp', 1)->get();

        return view('mhps.index')->with('mhps',$mhps);
    }

    function update(Request $request){
        //send validation error via session or other way or $errors
        $user = Enduser::find($request->user_id);
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
}
