<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Follow;

class FollowController extends Controller
{
    public function toggleFollower(Request $request, $id){
        //should check if the user is mhp or not
        if($request->user()->id === $id) {
            return response()->json([
                "success"=> false,
                "message"=>"you can not follow your self"
            ], 400);
        }

        if($request->user()->followings()->toggle($id)){
            return response()->json([
                "success"=> true,
                "message"=>"Succecfully toggled"
            ], 200);
        }

        return response()->json([
            "success"=> false,
            "message"=>"something went wrong"
        ], 500);
    }

    public function followers(Request $request){
        $followers = $request->user()->followers()->get();
        return response()->json($followers, 200);
    }

    public function followings(Request $request){
        $followings = $followers = $request->user()->followings()->get();

        return response()->json($followings, 200);
    }
}
