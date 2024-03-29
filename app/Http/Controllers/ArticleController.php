<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index(){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'VIEW_ARTICLE')){
            return redirect()->back();
        }

        $articles = Article::where('status','approved')->paginate(5);

        return view('articles.index')->with('articles', $articles);
    }

    public function pendingArticles(){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'VIEW_ARTICLE')){
            return redirect()->back();
        }

        $articles = Article::where('status','pending')->paginate(5);
        return view('articles.pending')->with('articles', $articles);
    }

    public function approve(Request $request){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'APPROVE_ARTICLE')){
            return redirect()->back();
        }

        $article = Article::find($request->id);

        if($article) {
            $article->status = 'approved';
            if($article->save()){
                return redirect()->back()->with('message', 'Article is approved successfully!');
            }
        }
    }

    public function create(Request $request){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'CREATE_ARTICLE')){
            return redirect()->back();
        }

        Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required',
            'feature_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'video_link' => 'string',
            "categories"    => "required|array|min:1",
            "categories.*"  => "required|string|distinct|min:1",
        ])->validate();

        $path = $request->file('feature_image')->store('public/feature_images');
        $icon_name = explode("/", $path)[2];

        $article = new Article;
        $article->title = $request->title;
        $article->description = $request->description;
        $article->feature_image = $icon_name;
        $article->video_link = $request->video_link;
        $article->status = 'approved';
        Auth::user()->articles()->save($article);
        $article->categories()->attach($request->categories);
        return view('articles.add')->with('message','successfully create article');
    }

    public function update(Request $request){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'UPDATE_ARTICLE')){
            return redirect()->back();
        }

        Validator::make($request->all(), [
            'title' => 'string',
            'feature_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'video_link' => 'string',
            'description' => 'string',
            "categories"    => "array|min:1",
            "categories.*"  => "string|distinct|min:1",
        ])->validate();

        $article = Article::find($request->article_id);
        if($request->title){
            $article->title = $request->title;
        }
        if($request->description){
            $article->description = $request->description;
        }
        if($request->file('feature_image')){
            Storage::delete('public/feature_images/'.$article->feature_image);
            $path = $request->file('feature_image')->store('public/feature_images');
            $icon_name = explode("/", $path)[2];
            $article->feature_image = $icon_name;
        }
        if($request->video_link){
            $article->video_link = $request->video_link;
        }
        if($request->categories){
            $article->categories()->detach($article->categories);
            $article->categories()->attach($request->categories);
        }
        $article->save();
        return redirect()->back()->with('message','article is updated successfully!');
    }

    public function delete(Request $request){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'DELETE_ARTICLE')){
            return redirect()->back();
        }

        $article = Article::find($request->article_id);

        if($article->delete()){
            return redirect()->back()->with('message','Article deleted successfully!');
        } else {
            return redirect()->back();
        }
    }

    public function detail(Request $request, $id){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'VIEW_ARTICLE')){
            return redirect()->back();
        }

        $article = Article::find($id);
        if($article) {
            return view('articles.detail')->with('article', $article);
        }
    }
}
