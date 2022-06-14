<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Rating;
use App\Models\Totalrating;

class RatingController extends Controller
{
    public function index(){
        $ratings = Totalrating::all();
        return response()->json($ratings, 200);
    }
    public function create(Request $request){
        //should check for whether rater already rated the user or not.if rated can't rate again.
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'rate' => 'required|numeric',
        ]);


        if($request->user_id == $request->user()->id) {
            return response()->json([
                'status' => false,
                'message' => 'you can not rate yourself.'
            ], 400);
        }

        if(!$request->user()->is_mhp) {
            return response()->json([
                'status' => false,
                'message' => 'you can not non mhp user.'
            ], 400);
        }

        if($validator->fails()){
            $errors = $validator->errors();
            return response()->json([
                'error' => $errors
            ], 400);
        }

        $already_rated = false;
        $previous_rate = 0;

        $rating = Rating::where(['user_id'=>$request->user_id, 'rater_id' => $request->user()->id])->first();

        if($rating) {
            $already_rated = true;
            $previous_rate = $rating->rate;
            $rating->rate = $request->rate;

        } else {
            $rating = new Rating;
            $rating->user_id = $request->user_id;
            $rating->rater_id = $request->user()->id;
            $rating->rate = $request->rate;
        }

        if($rating->save()) {
            $totalRating = Totalrating::where('user_id',$request->user_id)->first();

            if($totalRating) {
                if($already_rated) {
                    $totalRating->total_ratings =  $totalRating->total_ratings - $previous_rate + $request->rate;
                } else {
                    $totalRating->number_of_raters += 1;
                    $totalRating->total_ratings += $request->rate;
                }
            } else {
                $totalRating = new Totalrating;
                $totalRating->user_id = $request->user_id;
                $totalRating->number_of_raters += 1;
                $totalRating->total_ratings += $request->rate;
            } 

            if($totalRating->save()) {
                return response()->json([
                    "success" => true,
                    "message" => "Rate successfully created",
                ],200);
            }
        }
    }


    public function show(Request $request, $id){
        // $rating = Rating::find($id);
        $rating =  $request->user()->ratings();
        // dd($rating);
        return response()->json($rating, 200);
    }
}
