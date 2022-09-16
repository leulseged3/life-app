<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        return view('profile.index');
    }

    public function update(Request $request){
        Validator::make($request->all(), [
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => 'nullable|email',
            'old_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed|min:6',
            "new_password_confirmation" => "nullable|string|min:6",
            'profile_pic' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ])->validate();

        $admin = Admin::find(Auth::user()->id);

        if($request->first_name) {
            $admin->first_name = $request->first_name;
        }
        
        if($request->last_name) {
            $admin->last_name = $request->last_name;
        }

        if($request->file('profile_pic')){

            if($admin->profile_pic) {
                Storage::delete('public/profile_pics/'.$admin->profile_pic);
            }

            $path = $request->file('profile_pic')->store('public/profile_pics');

            $profile_pic_name = explode("/", $path)[2];
            $admin->profile_pic = $profile_pic_name;
        }
       
        if($request->email) {
            $admin->email = $request->email;
        }

        if($request->new_password) {
            $admin->password = Hash::make($request->new_password);
        }
        if($admin->save()){
            return redirect()->back()->with('message', 'Admin updated successfully!');
        }
    }
}
