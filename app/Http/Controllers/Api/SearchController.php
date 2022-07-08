<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function searchMhps(Request $request, $query){
        $mhps = User::where('is_mhp', 1)
        ->where('first_name','LIKE','%'.$query.'%')
        ->orWhere('last_name','LIKE','%'.$query.'%')
        ->get();

        return response()->json($mhps, 200);
    }
}
