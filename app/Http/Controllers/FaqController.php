<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FaqController extends Controller
{
    public function index(){
        $faqs = Faq::paginate(5);
        return view('faqs.index')->with('faqs', $faqs);
    }

    public function create(Request $request){
        Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ])->validate();

        $path = $request->file('image')->store('public/faqs');
        $image_name = explode("/", $path)[2];

        $faq = new Faq;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->image = $image_name;
        if($faq->save()){
            return redirect()->back()->with('message','faq is created sucessfully!');
        }
    }

    public function update(Request $request){
        
        Validator::make($request->all(), [
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ])->validate();
            
        $faq = Faq::find($request->faq_id);
        if($faq->question){
            $faq->question = $request->question;
        }

        if($request->answer){
            $faq->answer = $request->answer;
        }

        if($request->file('image')){
            Storage::delete('public/faqs'.$faq->image);
            $path = $request->file('image')->store('public/faqs');
            $icon_name = explode("/", $path)[2];
            $faq->image = $icon_name;
        }
       
       
        $faq->save();
        return redirect()->back()->with('message','FAQ is updated successfully!');
    }

    public function delete(Request $request){
        $faq = Faq::find($request->faq_id);
        if($faq->delete()) {
            return redirect()->back()->with('message','FAQ deleted successfully!');
        }
    }
}
