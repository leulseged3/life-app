<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Speciality;

class SpecialityController extends Controller
{
    public function index(){
        $specialities = Speciality::all();
        // dd($specialities);
        return view('specialities.index')->with('specialities', $specialities);
    }

    public function create(Request $request){
        Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:specialities',
            'icon' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required|string|max:255',
        ])->validate();

        $path = $request->file('icon')->store('public/icons/specialities');
        $icon_name = explode("/", $path)[3];
        $speciality = new Speciality;
        $speciality->title = $request->title;
        $speciality->icon = $icon_name;
        $speciality->description = $request->description;
        if($speciality->save()) {
            return redirect()->back()->with('message',$speciality->title.' is added sucessfully!');
        }
    }

    public function update(){

    }

    public function delete(){

    }
}
