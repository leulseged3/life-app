<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index(){
        $faqs = Faq::all();
        return response()->json($faqs, 200);
    }

    public function show($id){
        $faq = Faq::find($id);
        if($faq){
            return response()->json($faq, 200);
        }
        return response()->json(['success'=>false,'message'=>'no faq found with this id'], 404);
    }
}
