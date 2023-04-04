<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $books = Book::factory(20)->create();
        $authors = Author::factory(10)->make()->each(function ($author) use ($books) {
            $author->book_id = $books->random()->id;
            $author->save();
        });
    }
}
