<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::paginate(5);

        return view('articles.index')->with('articles', $articles);
    }

    public function create(Request $request){
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
        $article->user_id = Auth::user()->id;
        $article->save();
        $article->categories()->attach($request->categories);
        return view('articles.add')->with('message','successfully create article');
    }

    public function delete(Request $request){
        $article = Article::find($request->article_id);

        if($article->delete()){
            return redirect()->back()->with('message','Article deleted successfully!');
        } else {
            return redirect()->back();
        }
    }

    public function detail(Request $request, $id){
        $article = Article::find($id);
        if($article) {
            return view('articles.detail')->with('article', $article);
        }
    }
}
