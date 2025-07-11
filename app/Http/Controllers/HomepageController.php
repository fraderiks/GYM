<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index() {
        $books = Book::limit(4)->get();
        return view('homepage.index', ['books' => $books]);
    }

    public function book(int $id) {
        $book = Book::findOrFail($id);
        return view('homepage.book', ['book' => $book]);
    }
}