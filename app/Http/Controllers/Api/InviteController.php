<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Invite;

class InviteController extends Controller
{
    public function index(){
        $invites = Invite::all();
        return response()->json($invites, 200);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'receiver_id' => 'required|numeric',
            'url' => 'required|string|max:255',
        ]);

        if($request->user()->id === $request->receiver_id) {
            return response()->json([
                "success"=> false,
                "message"=>"you can not send invitation for your self"
            ], 400);
        }

        if($validator->fails()){
            $errors = $validator->errors();
            return response()->json([
                'error' => $errors
            ], 400);
        }

        $invite = new Invite;

        $invite->sender_id = $request->user()->id;
        $invite->receiver_id = $request->receiver_id;
        $invite->url = $request->url;

        $invite->save();

        return response()->json([
            "success" => true,
            "message" => "Invite successfully sent",
        ],200);
    }

    public function show($id){
        $invite = Invite::find($id);
        return response()->json($invite, 200);
    }
}
