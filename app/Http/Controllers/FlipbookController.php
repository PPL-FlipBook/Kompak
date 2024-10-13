<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Flipbook;
use App\Models\Book;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FlipbookController extends Controller
{
    public function index()
    {
        $visibleBooks = Book::latest()->limit(12)->get();
        $hiddenBooks = Book::latest()->skip(12)->take(12)->get();
        $categories = Category::all();
        $subjectId = LogActivity::latest()->first();
        return view('frontend.index', compact('visibleBooks','hiddenBooks', 'categories', 'subjectId'));
    }
}
