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
}
