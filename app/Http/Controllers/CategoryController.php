<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('categories.index')->with('categories', $categories);
    }

    public function create(Request $request){
        Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:categories',
            'icon' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required|string|max:255',
        ])->validate();

        $path = $request->file('icon')->store('public/icons');
        $icon_name = explode("/", $path)[2];

        $category = new Category;
        $category->title = $request->title;
        $category->icon = $icon_name;
        $category->description = $request->description;
        if($category->save()) {
            return redirect()->back()->with('message',$category->title.' is added sucessfully!');
        }
    }

    public function update(){

    }

    public function delete(){

    }
}
