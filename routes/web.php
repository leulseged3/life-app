<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MhpController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FaqController;
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
// Route::middleware(['auth'])->group(function () {
//     Route::get('/', function(){
//         return view('dashboard.index');
//     });
// });

Route::get('/', [HomeController::class, 'index'])->middleware('auth');

//USERS ROUTES
Route::middleware('auth')->prefix('users')->group(function() {
    Route::get('/', [UserController::class,'index']);
    Route::post('/edit', [UserController::class,'update']);
    Route::post('/delete', [UserController::class,'delete']);
});

//MHP's ROUTES
Route::middleware('auth')->prefix('mhps')->group(function() {
    Route::get('/', [MhpController::class,'index']);
    Route::post('/edit', [MhpController::class,'update']);
    Route::post('/delete', [MhpController::class,'delete']);
});

//CATEGORIES ROUTES
Route::middleware('auth')->prefix('categories')->group(function() {
    Route::get('/', [CategoryController::class,'index']);
    Route::post('/create',[CategoryController::class, 'create']);
    Route::post('/delete', [CategoryController::class,'delete']);
});

//SPECIALITIES ROUTES
Route::middleware('auth')->prefix('specialities')->group(function() {
    Route::get('/', [SpecialityController::class,'index']);
    Route::post('/create',[SpecialityController::class, 'create']);
    Route::post('/delete', [SpecialityController::class,'delete']);
});

//ARTICLES ROUTES
Route::middleware('auth')->prefix('articles')->group(function() {
    Route::get('/', [ArticleController::class,'index']);
    Route::get('/add',function(){
        return view('articles.add');
    });
    Route::post('/add',[ArticleController::class, 'create']);
    Route::post('/delete', [ArticleController::class,'delete']);
    Route::post('/edit', [ArticleController::class,'update']);
    Route::get('/{id}', [ArticleController::class,'detail']);
});

//FAQs ROUTES
Route::middleware('auth')->prefix('faqs')->group(function() {
    Route::get('/', [FaqController::class,'index']);
    Route::post('/create',[FaqController::class, 'create']);
    Route::post('/delete', [FaqController::class,'delete']);
    Route::post('/edit',[FaqController::class, 'update']);
});

Route::get('/logout', [LogoutController::class, 'logout']);