<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a1 = new Author;
        $a1->firstName = "Max";
        $a1->lastName = "Mayer";
        $a1->save();

        $a2 = new Author;
        $a2->firstName = "Fritz";
        $a2->lastName = "Huber";
        $a2->save();

        $a3 = new Author;
        $a3->firstName = "Sepp";
        $a3->lastName = "Gruber";
        $a3->save();
        //
    }
}
