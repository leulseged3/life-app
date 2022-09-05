<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Room;
use Firebase\JWT\JWT;
use DateTime;
use App\Models\Meeting;
use Ramsey\Uuid\Uuid;

class RoomController extends Controller
{
    public function index(){
        $rooms = Room::with(['categories', 'users','meeting','user'])->orderBy('id', 'DESC')->get();
        return response()->json($rooms, 200);
    }

    public function getManagementToken(){
        $app_access_key = "63143742c16640065698d433";
        $app_secret = "xdusHjZaDBEKdH6V3lroZpd1we1Tv3yvqY2X1sYaFIWUeZ9p4sYGo7I32Q5uL5DHVCb22-8Yi8UqERNmcbPbFftAo36hhcSSAAfrGkAXo6Al9UiVXfQ6D9eN7F4JdkEIU8u1MVDGsZSTZGm6JIoWqp_FzWgMaos5-S2QZ_Nr8Vk=";
        
        $issuedAt   = new DateTime();
        $expire = $issuedAt->modify('+24 hours')->getTimestamp();
        
        $payload = [
            'access_key' => $app_access_key,
            'type' => 'management',
            'version' => 2,
            'jti' =>  Uuid::uuid4()->toString(),
            'iat'  => $issuedAt->modify('-24 hours')->getTimestamp(),
            'nbf'  => $issuedAt->getTimestamp(),
            'exp'  => $expire,
        ];
        
        $token = JWT::encode($payload, $app_secret, 'HS256');

        return $token;
    }

    public function getAppToken(){
        
        $issuedAt  = new DateTime();
        $expire    = $issuedAt->modify('+24 hours')->getTimestamp();
        $accessKey = "63143742c16640065698d433";
        $secret = "xdusHjZaDBEKdH6V3lroZpd1we1Tv3yvqY2X1sYaFIWUeZ9p4sYGo7I32Q5uL5DHVCb22-8Yi8UqERNmcbPbFftAo36hhcSSAAfrGkAXo6Al9UiVXfQ6D9eN7F4JdkEIU8u1MVDGsZSTZGm6JIoWqp_FzWgMaos5-S2QZ_Nr8Vk=";
        $version   = 2;
        $type      = "app";
        $role      = "<role>";
        $roomId    = "<room_id>";
        $userId    = "<user_id>";
        
        $payload = [
            'iat'  => $issuedAt->modify('-24 hours')->getTimestamp(),
            'nbf'  => $issuedAt->getTimestamp(),
            'exp'  => $expire,
            'access_key' => $accessKey,
            'type' => "app",
            'jti' =>  Uuid::uuid4()->toString(),
            'version' => 2,
            'role' => $role,
            'room_id' => $roomId,
            'user_id' => $userId
        ];
        
        $token = JWT::encode(
            $payload,
            $secret,
            'HS256'
        );

        return $token;
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
