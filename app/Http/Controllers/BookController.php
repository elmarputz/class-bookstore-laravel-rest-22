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

   /**
    * find book by search term
    * SQL injection is prevented by default, because Eloquent
    * uses PDO parameter binding
    */
   public function findBySearchTerm(string $searchTerm) {
       $book = Book::with(['authors', 'images', 'user'])
                   ->where('title', 'LIKE', '%' . $searchTerm. '%')
                   ->orWhere('subtitle' , 'LIKE', '%' . $searchTerm. '%')
                   ->orWhere('description' , 'LIKE', '%' . $searchTerm. '%')

                   /* search term in authors name */
                   ->orWhereHas('authors', function($query) use ($searchTerm) {
                       $query->where('firstName', 'LIKE', '%' . $searchTerm. '%')
                            ->orWhere('lastName', 'LIKE',  '%' . $searchTerm. '%');
                        })->get();
       return $book;
   }

}
