<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    public function index() : JsonResponse {
        $books = Book::with(['authors', 'images', 'user'])->get();
        return response()->json($books, 200);
    }

    public function findByISBN(string $isbn) : Book {

        $book = Book::where('isbn', $isbn)
                ->with(['authors', 'images', 'user'])
                ->first();

        return $book;

    }

    public function checkISBN (string $isbn) {
        $book =  Book::where('isbn', $isbn)->first();
        return $book != null ?
            response()->json(true, 200) :
            response()->json(false, 200);
    }


    public function show(Book $book) {
        // return view('books.show', compact('book'));
    }
}
