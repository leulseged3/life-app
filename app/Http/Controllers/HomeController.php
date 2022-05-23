<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enduser;

class HomeController extends Controller
{
    function index(){
        $users = Enduser::where('is_mhp',0)->count();
        $mhps = Enduser::where('is_mhp',1)->count();
        $data = ['users'=>$users, 'mhps' => $mhps];
        return view('dashboard.index')->with('data',$data);
    }
}
