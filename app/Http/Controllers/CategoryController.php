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
            'title' => ['required', 'string', 'max:255','unique:categories'],
            'icon' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ])->validate();

        $category = new Category;
        $category->title = $request->title;
        $category->icon = $request->icon;
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
