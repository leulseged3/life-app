<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Follow;

class UserController extends Controller
{
    public function index(Request $request){
        $mhps = User::where('is_mhp',1)->where('id','!=',$request->user()->id)->with(['rating','followers','specialities'])->get();
        
        return response()->json($mhps, 200);
    }

    public function show(Request $request, $id){
        $user = User::find($id);

        $following = Follow::where('user_id',$request->user()->id)->where('following_id', $id)->count();

        return response()->json([
            'user' => $user,
            'is_following' => $following
        ], 200);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            // 'email' => 'nullable|email|unique:users|max:255',
            // 'username' => 'nullable|string|unique:users|max:255',
            // 'mobile_number' => 'nullable|string|max:255',
            'password' => 'nullable|string|confirmed|min:6',
            "password_confirmation" => "nullable|string|min:6",
            'bios'=> 'nullable|string',
            "categories"    => "array|min:1|nullable",
            "categories.*"  => "distinct|min:1",
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return response()->json([
                'success' => false,
                'error' => $errors
            ], 400);
        }

        $user = User::find($request->user()->id);

        if($user) {
            if($request->first_name){
                $user->first_name = $request->first_name;
            }
            if($request->last_name){
                $user->last_name = $request->last_name;
            }
            // if($request->email){
            //     $user->email = $request->email;
            // }
            // if($request->username){
            //     $user->username = $request->username;
            // }
            // if($request->mobile_number){
            //     $user->mobile_number = $request->mobile_number;
            // }
            if($request->password){
                $user->password = Hash::make($request->password);
            }
            if($request->bios){
                $user->bios = $request->bios;
            }

            if(count((array)$request->categories)) {
                $user->categories()->detach($user->categories);
                $user->categories()->attach($request->categories);
            }

            if($user->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'user updated successfully!',
                    'user' => $user
                ],200);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'something went wrong'
        ], 500, $headers);
    }
    public function uploadProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'profile_pic' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'error' => $validator->errors()
            ], 400);
        }

        $user = User::find($request->user()->id);

        if($user) {
            $path = $request->file('profile_pic')->store('public/profile_pics');
            $profile_pic_name = explode("/", $path)[2];
            $user->profile_pic = $profile_pic_name;

            if($user->save()) {
                return response()->json([
                    'success' => true,
                    'profile_pic' => $profile_pic_name
                ], 200);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'something wen wrong'
        ], 500);
    }

    public function uploadCategory(Request $request){
        $validator = Validator::make($request->all(), [
            "categories"    => "required|array|min:1|nullable",
            "categories.*"  => "distinct|min:1",
        ]);

        if($request->user()->is_mhp){
            return response()->json([
                'success' => false,
                'message' => 'you can not add categories for mhp'
            ], 400);
        }

        if($validator->fails()){
            $errors = $validator->errors();
            return response()->json([
                'success' => false,
                'error' => $errors
            ], 400);
        }

        if(!count($request->user()->categories)) {
            $request->user()->categories()->attach($request->categories);
        }
        return response()->json([
            'success' => true,
            'message' => 'categories is added successfully'
        ], 200);
    }

    public function uploadSpeciality(Request $request){
        $validator = Validator::make($request->all(), [
            "specialities"    => "required|array|min:1|nullable",
            "specialities.*"  => "distinct|min:1",
        ]);

        if(!$request->user()->is_mhp){
            return response()->json([
                'success' => false,
                'message' => 'you can not add specialities for non mhp user'
            ], 400);
        }

        if($validator->fails()){
            $errors = $validator->errors();
            return response()->json([
                'success' => false,
                'error' => $errors
            ], 400);
        }

        if(!count($request->user()->specialities)) {
            $request->user()->specialities()->attach($request->specialities);
        }

        return response()->json([
            'success' => true,
            'message' => 'specialities is added successfully'
        ], 200);
    }
}
