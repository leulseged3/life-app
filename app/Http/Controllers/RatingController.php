<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Totalrating;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
  public function index(){
    $permissions = [];

    if(Auth::user()->is_super_admin) {
        $permissions = ['IS_SUPER_ADMIN'];
    } else if(count(Auth::user()->roles)) {
        $permissions = Auth::user()->roles[0]->permissions;
    }
    if(!user_is_authorized($permissions, 'VIEW_RATING')){
        return redirect()->back();
    }

    $ratings = Totalrating::paginate(5);
    return view('ratings.index')->with('ratings', $ratings);
  }

  public function delete(Request $request){
    $permissions = [];
    
    if(Auth::user()->is_super_admin) {
      $permissions = ['IS_SUPER_ADMIN'];
    } else if(count(Auth::user()->roles)) {
        $permissions = Auth::user()->roles[0]->permissions;
    }
    if(!user_is_authorized($permissions, 'DELETE_RATING')){
        return redirect()->back();
    }

    $totalRating = Totalrating::find($request->rating_id);
    if($totalRating) {
      $ratings = Rating::where('user_id',$totalRating->user_id);
      if($ratings->delete()) {
        if($totalRating->delete()) {
          return redirect()->route('ratings-home')->with('message', 'Rating is deleted successfully!');
        }
      }
    }
    return redirect()->back();
  }
}
