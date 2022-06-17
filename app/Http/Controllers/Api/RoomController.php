<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Room;

class RoomController extends Controller
{
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
}
