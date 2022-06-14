<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index(){
        $tickets = Ticket::all();

        return response()->json($tickets, 200);
    }

    public function show($id){
        $ticket = Ticket::find($id);
        return response()->json($ticket, 200);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $ticket = new Ticket;

        $ticket->message = $request->message;
        $ticket->user_id = $request->user()->id;
        if($request->file('image')){
            $path = $request->file('image')->store('public/tickets');
            $image = explode("/", $path)[2];
            $ticket->image = $image;
        }

        if($ticket->save()) {
            return response()->json([
                'success' => true,
                'message' => 'ticket created successfully'
            ], 200);
        }
        return response()->json([
            "success" => false,
            'message' => 'something went wrong'
        ], 500);
    }
}
