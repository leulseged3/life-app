<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->middleware(['auth']);
Route::middleware(['auth'])->group(function () {
    Route::get('/', function(){
        return view('welcome');
    });
});

Route::middleware('auth')->prefix('users')->group(function() {
    Route::get('/', [UserController::class,'index']);
    // Route::post('add-student',[UserController::class, 'create']);
    // Route::get('detail/{id}',[UserController::class, 'detail']);
});

Route::get('/logout', [LogoutController::class, 'logout']);