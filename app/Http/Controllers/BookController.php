<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class BookController extends Controller
{
    //show book listing page
    public function index(Request $request){
        $books = Book::orderBy('created_at', 'DESC');

        if(!empty($request ->keyword)){
            $books -> where('title', 'like', '%' .$request ->keyword. '%');
        }

        $books = $books -> paginate(10);

        return view('books.list',[
            'books' => $books
        ]);
    }

    //show create book page
    public function create(){
        return view('books.create');
    }

    //store a book in db
    public function store(Request $request){

        $rules = [
            'title' => 'required|min:5',
            'author' => 'required|min:5',
            'status' => 'required'
        ];

        if(!empty($request ->image)){
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        
        $validator = Validator::make($request ->all(),$rules);

        if($validator -> fails()){
            return redirect()->route('books.create')->withInput()->withErrors($validator);
        }

        //save book
        $book = new Book();
        $book ->title = $request->title;
        $book ->description = $request->description;
        $book ->author = $request->author;
        $book ->status = $request->status;
        $book ->save();

        

        return redirect()->route('books.index')->with('success', 'Book Added successfully');
    }
    
    //show edit book page
    public function edit($id){
        $book = Book::findOrFail($id);

        return view('books.edit',[
            'book' => $book
        ]);
    }

    //update a book
    public function update($id , Request $request){
        $book = Book::findOrFail($id);
        $rules = [
            'title' => 'required|min:5',
            'author' => 'required|min:5',
            'status' => 'required'
        ];

        if(!empty($request ->image)){
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        
        $validator = Validator::make($request ->all(),$rules);

        if($validator -> fails()){
            return redirect()->route('books.edit', $book->id)->withInput()->withErrors($validator);
        }

        //update book
        //$book = new Book();
        $book ->title = $request->title;
        $book ->description = $request->description;
        $book ->author = $request->author;
        $book ->status = $request->status;
        $book ->save();

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
        
    }

    //delete a book from db
    public function destroy(Request $request){
        $book = Book::find($request ->id);

        if($book == null){
            session()->flash('error', 'Book not found');
            return response() -> json([
                'status' => false,
                'message' => 'Book not found'
            ]);
        }else{
            File::delete(public_path('uploads/books/' .$book->image));
            $book ->delete();
            session()->flash('success', 'Book Deleted');

            return response() -> json([
                'status' => false,
                'message' => 'Book Deleted'
            ]);
        }
    }
}
