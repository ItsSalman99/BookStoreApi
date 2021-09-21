<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return $books;

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string',
            'author_id' => 'required|int',
            'img' => 'required|image|mimes:png,jpg|max:2048',
            'pub_date' => 'required|date',
            'no_pages' => 'required|int',
            'lang' => 'required|string'
        ]);
        
        if (!$validator->fails()) {
            if ($request->hasFile('img')) {
                $filename = $request->img->getClientOriginalName();
        
                $request->img->storeAs('book_img', $filename, 'public');
            }
        }
        
        $book = Book::create([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'img' => $filename,
            'pub_date' => $request->pub_date,
            'no_pages' => $request->no_pages,
            'lang' =>$request->lang
        ]);

        return response($book,201);

    }

}
