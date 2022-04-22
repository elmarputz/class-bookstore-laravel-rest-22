<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* protected routes */
Route::group(['middleware' => ['api', 'auth.jwt']], function() {
    Route::post('books', [BookController::class,'save']);
    Route::put('books/{isbn}', [BookController::class,'update']);
    Route::delete('books/{isbn}', [BookController::class,'delete']);
    Route::post('auth/logout',[AuthController::class,'logout']);
});

/* auth */
Route::post('auth/login',[AuthController::class,'login']);
Route::get('books',[BookController::class,'index']);

Route::get('books/{isbn}', [BookController::class,'findByISBN']);
Route::get('books/checkisbn/{isbn}', [BookController::class,'checkISBN']);
Route::get('books/search/{searchTerm}', [BookController::class,'findBySearchTerm']);



