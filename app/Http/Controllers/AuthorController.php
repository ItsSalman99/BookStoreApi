<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

        return $authors;
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string'
        ]);

        $author = Author::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        return response($author, 200);
    }

}
