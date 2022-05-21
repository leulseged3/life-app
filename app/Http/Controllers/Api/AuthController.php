<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Enduser;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:endusers|max:255',
            'username' => 'required|string|unique:endusers|max:255',
            'mobile_number' => 'required|string|unique:endusers|max:255',
            'is_mhp'=>'required',
            'password' => 'required|min:6',
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return response()->json([
                'error' => $errors
            ], 400);
        }

        if ($validator->passes()) {
            $enduser = Enduser::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'username' => $request->username,
                'mobile_number' => $request->mobile_number,
                'is_mhp' => $request->is_mhp,
                'password' => Hash::make($request->password)
            ]);
            $token = $enduser->createToken('auth_token')->plainTextToken;
        
            return response()->json([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'username' => $request->username,
                'mobile_number' => $request->mobile_number,
                'is_mhp' => $request->is_mhp,
                'password' => Hash::make($request->password),
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
    }

    public function login(Request $request) {
        $user = Enduser::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'username' => $user->username,
            'mobile_number' => $user->mobile_number,
            'is_mhp' => $user->is_mhp,
            'password' => Hash::make($user->password),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
