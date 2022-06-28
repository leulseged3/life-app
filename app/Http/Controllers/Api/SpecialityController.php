<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Speciality;

class SpecialityController extends Controller
{
    public function index(){
        $specialities = Speciality::all();

        return response()->json($specialities, 200);
    }

    public function show($id){
        $speciality = Speciality::find($id);
        return response()->json($speciality, 200);
    }
}
