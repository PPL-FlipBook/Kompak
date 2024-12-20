<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Ambil semua buku yang sudah dibeli dan sukses (payment_status = 1)
        $purchasedBooks = Purchase::with('book')
            ->where('user_id', Auth::id())
            ->where('payment_status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.library.index', compact('purchasedBooks'));
    }

    public function show($id)
    {
        // Cek apakah user memiliki akses ke buku ini
        $purchase = Purchase::with('book')
            ->where('user_id', Auth::id())
            ->where('book_id', $id)
            ->where('payment_status', 1)
            ->firstOrFail();

        $book = $purchase->book; // Ambil data buku dari relasi

        return view('frontend.example1', compact('purchase', 'book'));
    }
}
