<?php

namespace Database\Seeders;


use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;

class BooksTableSeeder extends Seeder
{
  public function run(){
   $book = new \App\Models\Book;
   $book->title = "Herr der Ringe";
   $book->isbn = "1234567890";
   $book->subtitle = "Die Rückkehr des Königs";
   $book->rating = 10;
   $book->description = "Letzter Teil der Trilogie";
   $book->published = new DateTime();
   $book->save();

   // add images to book
   $image1 = new \App\Models\Image;
   $image1->title = "Cover 1";
   $image1->url = "https://images-na.ssl-images-amazon.com/images/I/61h%2BnIJyVFL._SX333_BO1,204,203,200_.jpg";

   $image2 = new \App\Models\Image;
   $image2->title = "Cover 2";
   $image2->url = "https://images-eu.ssl-images-amazon.com/images/I/516KV5tjulL._AC_US327_FMwebp_QL65_.jpg";
   $book->images()->saveMany([$image1,$image2]);
   $book->save();
  }
}


