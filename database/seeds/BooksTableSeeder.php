<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = factory(App\Models\Author::class, 10)->create();
        $authors->each(function ($author) {
            $author->ratings()->saveMany(
                factory(App\Models\Rating::class, rand(2, 50))->make()
            );
            $booksCount = rand(1, 5);

            while ($booksCount > 0) {
                $book = factory(App\Models\Book::class)->make();
                $author->books()->save($book);
                $book->ratings()->saveMany(
                    factory(App\Models\Rating::class,rand(20, 50))->make()
                );
                $booksCount--;
            }
        });
    }
}
