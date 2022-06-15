<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;

class CertificateController extends Controller
{
    public function index(){
        $certificates = Certificate::paginate(5);
        return view('certificates.index')->with('certificates',$certificates);
    }

    public function open($file){
        return response()->file('storage/certificate/'.$file);
    }

    public function action(Request $request) {
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
