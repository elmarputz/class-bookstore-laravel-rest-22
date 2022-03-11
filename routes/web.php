<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


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

Route::get('/', function () {
    $books = DB::table('books')->get();
    return view('books.index', compact('books'));
});

Route::get('/books/{id}', function ($id) {
    $book = DB::table('books')->find($id);
    return view('books.show', compact('book'));
});
