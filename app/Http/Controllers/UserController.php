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
}
