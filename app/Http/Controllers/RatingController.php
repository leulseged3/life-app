<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Totalrating;
use App\Models\Rating;

class RatingController extends Controller
{
  public function index(){
    $ratings = Totalrating::paginate(5);
    return view('ratings.index')->with('ratings', $ratings);
  }

  public function delete(Request $request){
    $totalRating = Totalrating::find($request->rating_id);
    if($totalRating) {
      $ratings = Rating::where('user_id',$totalRating->user_id);
      if($ratings->delete()) {
        if($totalRating->delete()) {
          // return response()->json([
          //   'success'=>true,
          //   'message'=> 'rating is deleted successfully'
          // ], 200);
          return redirect()->back()->with('message', 'Rating is deleted successfully!');
        }
      }
    }
    return redirect()->back();
    // return response()->json([
    //   'success' => false,
    //   'message' => 'something went wrong'
    // ], 500);
  }
}
