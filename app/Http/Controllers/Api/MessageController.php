<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;
use App\Events\MessageEvent;

class MessageController extends Controller
{
    public function index(Request $request){
        $id = $request->user()->id;
        $messages = Message::where('sender_id', $request->user()->id)
        ->orWhere('receiver_id',$request->user()->id)
        ->with('sender','receiver')
        ->orderBy('id', 'DESC')
        ->get()
        
        ->unique(function($query)use($id){
            if($query->receiver_id == $id) {
                return $query->sender_id;
            } else {
                return $query->receiver_id;
            }
        });
        return response()->json($messages, 200);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'receiver_id' => 'required|numeric',
            'message' => 'required',
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return response()->json([
                'error' => $errors
            ], 400);
        }

        $message = new Message;
        $message->receiver_id = $request->receiver_id;
        $message->sender_id = $request->user()->id;
        $message->message = $request->message;

        if($message->save()){
            MessageEvent::dispatch($message);
            return response()->json($message, 200);
        }
    }

    public function detail(Request $request, $user_id){
        $messages = Message::
                    where([
                        ['sender_id', '=', $request->user()->id],
                        ['receiver_id', '=', $request->user_id]
                    ])
                    ->orWhere([
                        ['sender_id', '=', $request->user_id],
                        ['receiver_id', '=', $request->user()->id]
                    ])
                    ->with('sender','receiver')
                    // ->orderBy('id', 'DESC')
                    ->get();
        return response()->json($messages, 200);
    }

    public function delete(Request $request){

    }
}