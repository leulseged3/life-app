<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;

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

        $certificates = Certificate::paginate(5);
        return view('certificates.index')->with('certificates',$certificates);
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

        $certificate = Certificate::find($request->id);

        if($certificate){
            if($request->status == "approve") {
                $certificate->status = "approved";
            }

            if($request->status == "reject") {
                $certificate->status = "rejected";         
            }                
            $certificate->save();
            return redirect()->back()->with('message', 'certificate is '.$request->status.' successfully!');
        }
    }
}
