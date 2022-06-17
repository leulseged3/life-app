<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(){
        $rooms = Room::with(['categories', 'users'])->paginate(5);
        return response()->json($rooms, 200);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'date' => 'required|date|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'limit' => 'required|numeric|min:1',
            "categories"    => "required|array|min:1",
            "categories.*"  => "required|numeric|distinct|min:1",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $room = new Room;
        $room->title = $request->title;
        $room->description = $request->description;
        $room->date = $request->date;
        $room->time = $request->time;
        $room->limit = $request->limit;
        $request->user()->rooms()->save($room);
        $room->categories()->attach($request->categories);

        return response()->json([
            'title' => $room->title,
            'description' => $room->description,
            'date' => $room->date,
            'time' => $room->time,
            'limit' => $room->limit,
            'categories' => $room->categories,
        ]);
    }

    public function toggle(Request $request){
        $validator = Validator::make($request->all(), [
            'room_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $room = Room::find($request->room_id);

        if($room) {
            $joined_users = $room->users;

            if($room->limit <= count($joined_users)){
                return response()->json([
                    'success' => false,
                    'message' => 'room is full'
                ], 429);
            }

            $room->users()->toggle($request->user()->id);

            return response()->json([
                "success"=> true,
                "message"=>"User is successfully joined"
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'no room with this ID'
        ], 400);
    }

    public function leave(Request $request){
        $validator = Validator::make($request->all(), [
            'room_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $room = Room::find($request->room_id);

        if($room) {
            // $joined_users = $room->users;

            // if($room->limit <= count($joined_users)){
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'room is full'
            //     ], 429);
            // }

            $room->users()->detach($request->user()->id);

            return response()->json([
                "success"=> true,
                "message"=>"User is successfully left"
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'no room with this ID'
        ], 400);
    }
}
