<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//UnAuthencated Routes
Route::get('/authors', [AuthorController::class,'index']);
Route::get('/books', [BookController::class,'index']);
Route::post('/register', [AuthenticationController::class,'register']);
Route::post('/login', [AuthenticationController::class,'login']);

//Authenticated Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthenticationController::class,'signout']);
    Route::post('/author', [AuthorController::class,'store']);
    Route::post('/book', [BookController::class,'store']);
});
