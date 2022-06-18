<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(){
        $rooms = Room::paginate(5);
        return view('rooms.index')->with('rooms',$rooms);
    }

    public function show($id){
        $room = Room::find($id);

        return view('rooms.detail')->with('room', $room);
    }

    public function delete(Request $request){
        $room = Room::find($request->room_id);

        if($room) {
            $room->delete();

          return redirect()->back()->with('message', 'room is deleted successfully!');
        }
       return redirect()->back();
    }
}
