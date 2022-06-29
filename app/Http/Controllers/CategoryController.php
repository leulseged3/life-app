<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'VIEW_CATEGORY')){
            return redirect()->back();
        }

        $categories = Category::all();
        return view('categories.index')->with('categories', $categories);
    }

    public function create(Request $request){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'CREATE_CATEGORY')){
            return redirect()->back();
        }

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

    public function delete(Request $request){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'DELETE_CATEGORY')){
            return redirect()->back();
        }

        $category = Category::find($request->category_id);

        if($category->delete()){
            return redirect()->back()->with('message',$category->title.' deleted successfully!');
        } else {
            return redirect()->back();
        }
    }
}
