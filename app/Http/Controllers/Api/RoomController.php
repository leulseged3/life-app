<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Room;
use Firebase\JWT\JWT;
use DateTime;
use App\Models\Meeting;

class RoomController extends Controller
{
    public function index(){
        $rooms = Room::with(['categories', 'users','meeting','user'])->orderBy('id', 'DESC')->get();
        return response()->json($rooms, 200);
    }

    public function getToken(){
        header("Content-type: application/json; charset=utf-8");
        $issuedAt = new DateTime();
        $expire = $issuedAt->modify('+24 hours')->getTimestamp();
    
        $payload = (object)[];
    
        $payload->apikey = env('VIDEOSDK_API_KEY');

        $payload->permissions = array(
            "allow_join", "allow_mod"
        );
        $payload->iat = $issuedAt->getTimestamp();
        $payload->exp = $expire;
    
        $jwt = JWT::encode(array(
            "apikey" => env('VIDEOSDK_API_KEY'),
            "permissions" => array("allow_join", "allow_mod"),
            "iat" => $issuedAt->getTimestamp(),
            "exp" => $expire
        ), env('VIDEOSDK_SECRET_KEY'),'HS256');
    
        return json_encode(array("token" => $jwt));
    }

    public function createMeeting(Request $request){
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 400);
        }

        header("Content-type: application/json; charset=utf-8");
    
        $token = $request->token;
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('VIDEOSDK_API_ENDPOINT') . '/api/meetings',
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token
            ),
        ));

        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
    }

    public function validateMeeting(Request $request){
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'meetingId' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 400);
        }

        header("Content-type: application/json; charset=utf-8");

        $meetingId = $request->meetingId;
    
        $token = $request->token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('VIDEOSDK_API_ENDPOINT') . '/api/meetings/' . $meetingId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
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
            "meetingID" => "required|string",
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

        $meeting = new Meeting;
        $meeting->meetingID = $request->meetingID;
        $meeting->room_id = $room->id;
        $meeting->save();

        return response()->json([
            'title' => $room->title,
            'description' => $room->description,
            'date' => $room->date,
            'time' => $room->time,
            'limit' => $room->limit,
            'categories' => $room->categories,
            'meetingID'=> $room->meeting->meetingID
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
