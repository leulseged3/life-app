<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FollowController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->prefix('rooms')->group(function() {
    Route::post('/create', [RoomController::class, 'create']);
});

Route::middleware('auth:sanctum')->prefix('articles')->group(function() {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/{id}', [ArticleController::class, 'show']);
    Route::post('/', [ArticleController::class, 'create']);
    Route::delete('/{id}', [ArticleController::class, 'delete']);
});

Route::middleware('auth:sanctum')->prefix('faqs')->group(function() {
    Route::get('/', [FaqController::class, 'index']);
    Route::get('/{id}', [FaqController::class, 'show']);
});

Route::middleware('auth:sanctum')->prefix('categories')->group(function() {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
});

Route::middleware('auth:sanctum')->prefix('follow')->group(function() {
    Route::get('/followers', [FollowController::class, 'followers']);
    Route::get('/followings', [FollowController::class, 'followings']);
    Route::get('/{id}', [FollowController::class, 'toggleFollower']);
});