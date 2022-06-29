<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Certificate;
use App\Models\Verification;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //is mhp should be numeric
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'username' => 'required|string|unique:users|max:255',
            'mobile_number' => 'required|string|unique:users|max:255',
            'is_mhp' => 'required|numeric',
            'password' => 'required|min:6',
            'bios' => 'nullable|string',
            'bios'=> 'nullable|string',
            'certificates' => 'required_if:is_mhp, 1|array|min:1',
            'certificates.*' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024',
            "categories"    => "array|min:1|nullable",
            "categories.*"  => "distinct|min:1",
            "specialities"    => "required_if:is_mhp, 1|array|min:1",
            "specialities.*"  => "distinct|min:1",
            'profile_pic' => 'required_if:is_mhp, 1|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

         
        if($validator->fails()){
            $errors = $validator->errors();
            return response()->json([
                'error' => $errors
            ], 400);
        }
 
        $profile_pic_name = "";

        $generatedVerificationCode = rand(1231,7879);


        if($request->hasfile('profile_pic') && $request->is_mhp == 1){
            $path = $request->file('profile_pic')->store('public/profile_pics');
            $profile_pic_name = explode("/", $path)[2];
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'mobile_number' => $request->mobile_number,
            'is_mhp' => $request->is_mhp,
            'bios' => $request->bios,
            'password' => Hash::make($request->password),
            'profile_pic' => $profile_pic_name
        ]);

        if(count((array)$request->categories) && $request->is_mhp == 0) {
            $user->categories()->attach($request->categories);
        }

        if(count((array)$request->specialities) && $request->is_mhp == 1) {
            $user->specialities()->attach($request->specialities);
        }

        if($request->hasfile('certificates') && $request->is_mhp == 1){
            foreach($request->file('certificates') as $file)
            {
                // $name = time().'.'.$file->extension();
                // $file->move(public_path().'/files/', $name);  
                // $data[] = $name;  
                // $path = $request->file('certificate')->store('public/certificate');
                $path = $file->store('public/certificate');
                
                $file_name = explode("/", $path)[2];
                $ceritificate = new Certificate;
                $ceritificate->user_id = $user->id;
                $ceritificate->file = $file_name;
                $ceritificate->save();
            }

            $verification = new Verification;
            $verification->code = $generatedVerificationCode;
            $user->verifications()->save($verification);
            
            $info['name'] = $request->first_name;
            $info['verification'] = $generatedVerificationCode;

            $token = $user->createToken('auth_token')->plainTextToken;
            Mail::to($user->email)->send(new UserMail($info));

            return response()->json([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'username' => $request->username,
                'mobile_number' => $request->mobile_number,
                'is_mhp' => $request->is_mhp,
                'bios' => $request->bios,
                'certificates' => $user->certificates,
                'categories' => $request->categories,
                'access_token' => $token,
                'token_type' => 'Bearer',
                // 'categories' => $request->categories,
                'specialities' => $request->specialities,
                'profile_pic' => $profile_pic_name
            ],200);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        Mail::to($user->email)->send(new UserMail($info));

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
            'categories' => $user->categories,
            'profile_pic' => $profile_pic_name
        ],200);
    }

    public function login(Request $request)
    {
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
            'categories' => $user->categories
        ], 200);
    }

    public function verify(Request $request){
        if($request->user()->verifications){
            $verification = $request->user()->verifications[count($request->user()->verifications)-1];
            if($request->verification_code === $verification->code) {
                $updateUser = User::find($request->user()->id);
                $updateUser->email_verified_at = Carbon::now();
                $updateUser->save();
                return response()->json([
                    'message' => 'Email is verified successfully'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Incorrect Verification code'
                ], 400);
            }
        }
        return response()->json([
            'message' => 'Email is not verified.try again'
        ], 400);
    }

    public function resend(Request $request){
        $generatedVerificationCode = rand(1231,7879);
        $user = $request->user();

        $verification = new Verification;
        $verification->code = $generatedVerificationCode;
        $user->verifications()->save($verification);

        $info['name'] = $user->first_name;
        $info['verification'] = $generatedVerificationCode;

        Mail::to($user->email)->send(new UserMail($info));
        return response()->json([
            'message'=>'Vrification code is sent.'
        ], 200);
    }
}
