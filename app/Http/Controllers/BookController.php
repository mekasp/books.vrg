<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController
{
    public function index()
    {
        $books = Book::with('authors')->get();
        $authors = Author::all();

        return view('/books/index', [
            'books' => $books,
            'authors' => $authors
        ]);
    }

    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|max:30',
            'description' => 'max:100',
            'author' => 'required',
            'image' => 'mimes:png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            $data = [
                'title' => $validator->errors()->get('title'),
                'description' => $validator->errors()->get('description'),
                'author' => $validator->errors()->get('author'),
                'image' => $validator->errors()->get('image'),
            ];

            return response()->json(['errors' => $data], 400);
        }

        $img = false;
        if (isset($request->image)) {
            $image = $request->image;
            $path = $image->store('public/books');
            $img = explode('/', $path);
        }

        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $img ? $img[2] : null,
        ]);

        $res = explode(',', $request->author);
        $book->authors()->sync($res);

        return response($book->with('authors')->where('id', $book->id)->get())->send();
    }

    public function edit($id)
    {
        $book = Book::find($id);

        return response($book->with('authors')->where('id', $book->id)->get())->send();
    }

    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|max:30',
            'description' => 'max:100',
            'author' => 'required',
            'image' => 'mimes:png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            $data = [
                'title' => $validator->errors()->get('title'),
                'description' => $validator->errors()->get('description'),
                'author' => $validator->errors()->get('author'),
                'image' => $validator->errors()->get('image'),
            ];

            return response()->json(['errors' => $data], 400);
        }

        $book = Book::find($request->id);

        $img = false;
        if (isset($request->image)) {
            $old_image = 'storage/books/' . $book->image;
            if(\File::exists($old_image) && $book->image != '813uPMOnskL.jpg') {
                \File::delete($old_image);
            }
            $image = $request->image;
            $path = $image->store('public/books');
            $img = explode('/', $path);
        }

        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $img ? $img[2] : $book->image,
        ]);

        $res = explode(',', $request->author);
        $book->authors()->sync($res);

        return response($book->with('authors')->where('id', $book->id)->get())->send();
    }

    public function delete($id)
    {
        if (isset($id)) {
            $book = Book::find($id);
            $book->authors()->detach();
            $book->delete();
        }
    }
}
