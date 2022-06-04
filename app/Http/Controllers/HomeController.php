<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Faq;

class HomeController extends Controller
{
    function index(){
        $users = User::where('is_mhp',0)->count();
        $mhps = User::where('is_mhp',1)->count();
        $categories = Category::count();
        $articles = Article::count();
        $faqs = Faq::count();

        $data = ['users'=>$users, 'mhps' => $mhps, 'categories'=>$categories, 'articles'=>$articles,'faqs'=>$faqs];
        return view('dashboard.index')->with('data',$data);
    }
}
