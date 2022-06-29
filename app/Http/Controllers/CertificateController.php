<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CertificateController extends Controller
{
    public function index(){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'VIEW_CERTIFICATE')){
            return redirect()->back();
        }
        $mhps = User::where('is_mhp', 1)->paginate(5);

        return view('certificates.index')->with('mhps',$mhps);
    }

    public function open($file){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'VIEW_CERTIFICATE')){
            return redirect()->back();
        }

        return response()->file('storage/certificate/'.$file);
    }

    public function action(Request $request) {
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }

        if(!user_is_authorized($permissions, 'APPROVE_REJECT_CERTIFICATE')){
            return redirect()->back();
        }

        $mhp = User::find($request->user_id);

        if($mhp) {
            if($request->status == "approve") {
                $mhp->status = "approved";
            }

            if($request->status == "reject") {
                $mhp->status = "rejected";         
            }      

            $mhp->save();
            return redirect()->back()->with('message', 'certificate is '.$request->status.' successfully!');
        }
    }
}
