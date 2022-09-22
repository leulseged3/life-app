<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index(){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'VIEW_ROOM')){
            return redirect()->back();
        }

        $rooms = Room::paginate(5);
        return view('rooms.index')->with('rooms',$rooms);
    }

    public function show($id){
        $permissions = [];

        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'VIEW_ROOM')){
            return redirect()->back();
        }

        $room = Room::find($id);

        return view('rooms.detail')->with('room', $room);
    }

    public function delete(Request $request){
        $permissions = [];
        
        if(Auth::user()->is_super_admin) {
            $permissions = ['IS_SUPER_ADMIN'];
        } else if(count(Auth::user()->roles)) {
            $permissions = Auth::user()->roles[0]->permissions;
        }
        if(!user_is_authorized($permissions, 'DELETE_ROOM')){
            return redirect()->back();
        }

        $room = Room::find($request->room_id);

        if($room) {
            $room->delete();

          return redirect()->route('rooms-home')->with('message', 'room is deleted successfully!');
        }
       return redirect()->back();
    }
}
