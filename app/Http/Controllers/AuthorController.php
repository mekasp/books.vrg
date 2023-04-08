<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

        return view('/authors/index',[
            'authors' => $authors,
        ]);
    }

    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'surname' => 'required|min:3',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'surname' => $validator->errors()->get('surname'),
                'name' => $validator->errors()->get('name')
            ];

            return response()->json(['errors' => $data], 400);
        }

        $author = Author::create([
            'surname' => $request->surname,
            'name' => $request->name,
            'middle_name' => isset($request->middleName) ? $request->middleName : null
        ]);

        return response($author)->send();
    }

    public function edit($id)
    {
        $author = Author::find($id);

        return response($author)->send();
    }

    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'surname' => 'required|min:3',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'surname' => $validator->errors()->get('surname'),
                'name' => $validator->errors()->get('name')
            ];

            return response()->json(['errors' => $data], 400);
        }

        $author = Author::find($request->id);

        $author->update([
            'surname' => $request->surname,
            'name' => $request->name,
            'middle_name' => isset($request->middleName) ? $request->middleName : null
        ]);

        return response($author)->send();
    }

    public function delete($id)
    {
        if (isset($id)) {
            $author = Author::find($id);
            $author->books()->detach();
            $author->delete();
        }
    }
}
