<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminMail;

class AccountController extends Controller
{
    public function index(){
        $accounts = Admin::where('id','!=', Auth::user()->id)->paginate(5);
        // dd($accounts);
        return view('accounts.index')->with('accounts', $accounts);
    }

    public function create(Request $request){
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'role' => 'required|numeric'
        ])->validate();

        $generatedPassword = $this->generateRandomString();

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($generatedPassword);
        $admin->save();

        $admin->roles()->attach($request->role);
        $newAdmin = [];

        $newAdmin['name'] = $request->name;
        $newAdmin['email'] = $request->email;
        $newAdmin['password'] = $generatedPassword;
        $newAdmin['roles'] = $admin->roles;

        Mail::to($admin->email)->send(new AdminMail($newAdmin));

        return redirect()->back()->with('message', 'Admin created Successfully');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function delete(Request $request) {
        $account = Admin::find($request->account_id);

        if($account) {
            $account->delete();
            return redirect()->back()->with('message', 'Account is deleted successfully');
        }
        return redirect()->back();
    }

    public function update(Request $request){
        Validator::make($request->all(), [
            'account_id' => 'required|numeric',
            'role' => 'required|numeric'
        ])->validate();
        $admin = Admin::find($request->account_id);

        if($admin) {
            if(count($admin->roles)){
                $admin->roles()->detach($admin->roles[0]->id);
            }
            $admin->roles()->attach($request->role);

            return redirect()->back()->with('message','Role is changed Successfully');
        }

        return redirect()->back();
    }
}