<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\InviteController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\SpecialityController;

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

//EMAIL ROUTES
Route::middleware('auth:sanctum')->prefix('email')->group(function() {
    Route::post('/verify', [AuthController::class, 'verify']);
    Route::post('/resend', [AuthController::class, 'resend']);
});

//PASSWORD RESET
Route::prefix('password')->group(function() {
    Route::post('/reset', [AuthController::class, 'reset']);
    Route::post('/new', [AuthController::class, 'newPassword']);
});

//ROOMS ROUTES
Route::middleware(['auth:sanctum','verified'])->prefix('rooms')->group(function() {
    Route::post('/', [RoomController::class, 'create']);
    Route::get('/', [RoomController::class, 'index']);
    Route::post('/toggle', [RoomController::class, 'toggle']);
});

Route::middleware(['auth:sanctum','verified'])->prefix('articles')->group(function() {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/{id}', [ArticleController::class, 'show']);
    Route::post('/', [ArticleController::class, 'create']);
    Route::delete('/{id}', [ArticleController::class, 'delete']);
});

Route::middleware(['auth:sanctum','verified'])->prefix('faqs')->group(function() {
    Route::get('/', [FaqController::class, 'index']);
    Route::get('/{id}', [FaqController::class, 'show']);
});

Route::prefix('categories')->group(function() {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
});

Route::prefix('specialities')->group(function() {
    Route::get('/', [SpecialityController::class, 'index']);
    Route::get('/{id}', [SpecialityController::class, 'show']);
});

Route::middleware(['auth:sanctum','verified'])->prefix('follow')->group(function() {
    Route::get('/followers', [FollowController::class, 'followers']);
    Route::get('/followings', [FollowController::class, 'followings']);
    Route::get('/{id}', [FollowController::class, 'toggleFollower']);
});

Route::middleware(['auth:sanctum','verified'])->prefix('invite')->group(function() {
    Route::post('/', [InviteController::class, 'create']);
    Route::get('/', [InviteController::class, 'index']);
    Route::get('/{id}', [InviteController::class, 'show']);
});

Route::middleware(['auth:sanctum','verified'])->prefix('ratings')->group(function() {
    Route::get('/', [RatingController::class, 'index']);
    Route::post('/', [RatingController::class, 'create']);
    Route::get('/{id}', [RatingController::class, 'show']);
});

Route::middleware(['auth:sanctum','verified'])->prefix('profile')->group(function() {
    Route::patch('/', [UserController::class, 'update']);
    Route::post('/upload', [UserController::class, 'uploadProfile']);
});

Route::middleware(['auth:sanctum','verified'])->prefix('users')->group(function() {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/categories', [UserController::class, 'uploadCategory']);
    Route::post('/specialities', [UserController::class, 'uploadSpeciality']);
    Route::get('/{id}', [UserController::class, 'show']);
});

Route::middleware(['auth:sanctum','verified'])->prefix('tickets')->group(function() {
    Route::get('/', [TicketController::class, 'index']);
    Route::post('/', [TicketController::class, 'create']);
    Route::post('/upload', [TicketController::class, 'uploadProfile']);
    Route::get('/{id}', [TicketController::class, 'show']);
});

