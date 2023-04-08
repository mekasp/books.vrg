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
        $books = Book::factory(100)->create();
        $authors = Author::factory(100)->create();

        $books->each(function ($book) use ($authors) {
            $book->authors()->attach($authors->random(rand(1, 2))->pluck('id'));
        });
    }
}
