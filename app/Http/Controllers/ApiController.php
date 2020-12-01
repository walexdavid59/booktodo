<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class ApiController extends Controller
{
    public function getAllBooks()
    {
        // logic to get all books goes here
        $books = Book::all();
        return view('project/index')->with(compact('books'));
        // $books = Book::get()->toJson(JSON_PRETTY_PRINT);
        // return response($books, 200);
    }

    public function createBook(Request $request)
    {
        // logic to create a book record goes here
        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->save();

        return response()->json([
            "message" => "book record created"
        ], 201);
    }

    public function getBook($id)
    {
        // logic to get a book record goes here
        if (Book::where('id', $id)->exists()) {
            $book = Book::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($book, 200);
        } else {
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }

    public function updateBook(Request $request, $id)
    {
        // logic to update a book record goes here
        if (Book::where('id', $id)->exists()) {
            $book = Book::find($id);
            $book->title = is_null($request->title) ? $book->title : $request->title;
            $book->author = is_null($request->author) ? $book->author : $request->author;
            $book->description = is_null($request->description) ? $book->description : $request->description;
            $book->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }

    public function deleteBook($id)
    {
        // logic to delete a book record goes here
        if (Book::where('id', $id)->exists()) {
            $book = Book::find($id);
            $book->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }
}