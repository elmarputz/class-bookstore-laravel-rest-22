<?php

namespace Database\Seeders;


use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book = new Book;
        $book->title = "Herr der Ringe";
        $book->isbn = Str::random(20);
        $book->subtitle = Str::random(100);
        $book->rating = 4;
        $book->description = 'Letzer Teil der Reihe';
        $book->published = new DateTime();
        $book->save();

    }
}
