<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('owner')->get();
        return response()->json($articles, 200);
    }

    public function create(Request $request)
    {
        
        if(!$request->user()->is_mhp) {
            return response()->json([
                'success'=> false,
                'message' => 'only mhp can create article'
            ], 401);
        }
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required',
            'feature_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'video_link' => 'string|nullable',
            "categories"    => "required|array|min:1",
            "categories.*"  => "required|numeric|distinct|min:1",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 400);
        }
        
        $path = $request->file('feature_image')->store('public/feature_images');
        $image_name = explode("/", $path)[2];

        $article = new Article;
        $article->title = $request->title;
        $article->description = $request->description;
        $article->feature_image = $image_name;
        $article->video_link = $request->video_link;
        $request->user()->articles()->save($article);
        $article->categories()->attach($request->categories);

        return response()->json([
            "success" => true,
            "message" => "Articlle successfully created",
            "article" => $article
        ],200);
    }
    public function show($id)
    {
        $article = Article::find($id);
        return response()->json($article, 200);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function delete(Request $request, $id)
    {
        $article = Article::find($id);

        if(!$article){
            return response()->json(['success'=>false,'message'=>'no article found with this id'], 404);
        }

        if($article->user_id != $request->user()->id) {
            return response()->json([
                'success'=> false,
                'message'=>'not authorized to perform this operation',
            ],401);
        }

        if($article->delete()){
            return response()->json(['success'=>true, 'message'=>'article deleted successfully'],200);
        }
        return response()->json(['success'=>false, 'message'=>'something went wrong'],500);
    }
}
