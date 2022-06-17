<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Certificate;

class AuthController extends Controller
{
    public function register(Request $request){
        //is mhp should be numeric
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'username' => 'required|string|unique:users|max:255',
            'mobile_number' => 'required|string|unique:users|max:255',
            'is_mhp'=>'required',
            'password' => 'required|min:6',
            'bios'=> 'nullable|string',
            'certificate' => 'required_if:is_mhp, 1|mimes:jpeg,bmp,png,gif,svg,pdf|max:1024'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return response()->json([
                'error' => $errors
            ], 400);
        }

        if ($validator->passes()) {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'username' => $request->username,
                'mobile_number' => $request->mobile_number,
                'is_mhp|numeric' => $request->is_mhp,
                'bios' => $request->bios,
                'password' => Hash::make($request->password),
            ]);

            if($request->file('certificate') && $request->is_mhp){
                $path = $request->file('certificate')->store('public/certificate');
                $file_name = explode("/", $path)[2];
                $ceritificate = new Certificate;
                $ceritificate->user_id = $user->id;
                $ceritificate->file = $file_name;
                $ceritificate->save();

                $token = $user->createToken('auth_token')->plainTextToken;
        
                return response()->json([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'username' => $request->username,
                    'mobile_number' => $request->mobile_number,
                    'is_mhp' => $request->is_mhp,
                    'bios' => $request->bios,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'certificate' => $file_name
                ],200);
            }

           

            $token = $user->createToken('auth_token')->plainTextToken;
        
            return response()->json([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'username' => $request->username,
                'mobile_number' => $request->mobile_number,
                'is_mhp' => $request->is_mhp,
                'bios' => $request->bios,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],200);
        }
    }

    public function login(Request $request) {
        $user = User::where('email', $request->email)->first();
 
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ], 400);
        }
        
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'username' => $user->username,
            'mobile_number' => $user->mobile_number,
            'is_mhp' => $user->is_mhp,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ],200);
    }
}
