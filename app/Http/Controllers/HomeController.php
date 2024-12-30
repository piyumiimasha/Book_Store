<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //show homepage
    public function index(Request $request){
        $books = Book::orderBy('created_at', 'DESC');

        if( !empty($request ->keyword)){
            $books -> where('title', 'like', '%'.$request ->keyword.'%');
        }

       $books = $books -> where('status', 1) ->get();
        return view('home',[
            'books' => $books
        ]);
    }

    //show book detail page
    public function detail($id){
        $book = Book::findOrFail($id);

        if($book ->status ==0){
            abort(404);
        }

        
        return view('book-detail',[
            'book' => $book
        ]);
    }
}
