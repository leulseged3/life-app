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
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AccountController;

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
    Route::get('/{id}', [MhpController::class,'show']);
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
    Route::get('/pending', [ArticleController::class,'pendingArticles']);
    Route::get('/add',function(){
        return view('articles.add');
    });
    Route::post('/add',[ArticleController::class, 'create']);
    Route::post('/delete', [ArticleController::class,'delete']);
    Route::post('/edit', [ArticleController::class,'update']);
    Route::post('/approve', [ArticleController::class,'approve']);
    Route::get('/{id}', [ArticleController::class,'detail']);
});

//FAQs ROUTES
Route::middleware('auth')->prefix('faqs')->group(function() {
    Route::get('/', [FaqController::class,'index']);
    Route::post('/create',[FaqController::class, 'create']);
    Route::post('/delete', [FaqController::class,'delete']);
    Route::post('/edit',[FaqController::class, 'update']);
});

//RATINGS ROUTES
Route::middleware('auth')->prefix('ratings')->group(function() {
    Route::get('/', [RatingController::class,'index']);
    Route::post('/delete', [RatingController::class,'delete']);
});

//ADMIN PROFILE ROUTES
Route::middleware('auth')->prefix('profile')->group(function() {
    Route::get('/', [ProfileController::class,'index']);
    Route::post('/update', [ProfileController::class,'update']);
    // Route::post('/delete', [ProfileController::class,'delete']);
});

//TiCKETS RAISED ROUTES
Route::middleware('auth')->prefix('tickets')->group(function() {
    Route::get('/', [TicketController::class,'index']);
    Route::post('/reply', [TicketController::class,'reply']);
    Route::post('/delete', [TicketController::class,'delete']);
});

//CERTIFICATES ROUTES
Route::middleware('auth')->prefix('certificates')->group(function() {
    Route::get('/', [CertificateController::class,'index']);
    Route::post('/action', [CertificateController::class,'action']);
    Route::get('/open/{file}',[CertificateController::class,'open']);
});

//ROOMS ROUTES
Route::middleware('auth')->prefix('rooms')->group(function() {
    Route::get('/', [RoomController::class,'index']);
    Route::get('/{id}', [RoomController::class,'show']);
    Route::post('/delete', [RoomController::class,'delete']);
    // Route::post('/action', [CertificateController::class,'action']);
    // Route::get('/open/{file}',[CertificateController::class,'open']);
});

//ROLE ROUTES
Route::middleware('auth')->prefix('roles')->group(function() {
    Route::get('/', [RoleController::class,'index']);
    Route::post('/create', [RoleController::class,'create']);
    // Route::post('/delete', [RoleController::class,'delete']);
    // Route::post('/action', [CertificateController::class,'action']);
    // Route::get('/open/{file}',[CertificateController::class,'open']);
});

//ACCOUNTS ROUTES
Route::middleware('auth')->prefix('accounts')->group(function() {
    Route::get('/', [AccountController::class,'index']);
    Route::post('/create', [AccountController::class,'create']);
    Route::post('/delete', [AccountController::class,'delete']);
    Route::post('/edit', [AccountController::class,'update']);
});

Route::get('/logout', [LogoutController::class, 'logout']);