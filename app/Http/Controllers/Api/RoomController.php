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
            'limit' => 'required|numeric',
            'date_time' => 'required|string|max:255',
            "categories"    => "required|array|min:1",
            "categories.*"  => "required|numeric|distinct|min:1",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $room = new Room;
        $room->title = $request->title;
        $room->user_id = $request->user()->id;
        $room->limit = $request->limit;
        $room->date_time = $request->date_time;

        $room->save();
        $room->categories()->attach($request->categories);

        return response()->json([
            'title' => $room->title,
            'limit' => $room->limit,
            'date_time' => $room->date_time,
            'categories' => $room->categories
        ]);
    }
}
