<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Image;
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


    /**
     * create new book
     */

    public function save(Request $request) : JsonResponse {

        $request = $this->parseRequest($request);

        DB::beginTransaction();
        try {
            $book = Book::create($request->all());

            // save images
            if (isset($request['images']) && is_array($request['images'])) {
                foreach ($request['images'] as $img) {
                    $image = Image::firstOrNew([
                        'url' => $img['url'],
                        'title' => $img['title']
                    ]);
                    $book->images()->save($image);
                }
            }

            // save authors
            if (isset($request['authors']) && is_array($request['authors'])) {
                foreach ($request['authors'] as $auth) {
                    $author = Author::firstOrNew([
                        'firstName' => $auth['firstName'],
                        'lastName' => $auth['lastName']
                    ]);
                    $book->authors()->save($author);
                }
            }


            DB::commit();
            return response()->json($book, 201);

        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving book failed:" . $e->getMessage(), 420);
        }

    }

    private function parseRequest(Request $request) : Request {

        $date = new \DateTime($request->published);
        $request['published'] = $date;
        return $request;


    }

}
