<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BundlesTableSeeder extends Seeder
{

    public function run()
    {
        factory(\App\Models\Bundle::class, 5)->create()->each(function ($bundle) {
            $booksCount = rand(2, 5);
            $bookIds = [];

            while ($booksCount > 0) {
                $book = \App\Models\Book::whereNotIn('id', $bookIds)
                    ->orederBy(DB::raw('RAND()'))
                    ->first();
                $bundle->books()->attach($book);
                $bookIds = $book->id;
                $booksCount--;
            }
        });
    }
}
