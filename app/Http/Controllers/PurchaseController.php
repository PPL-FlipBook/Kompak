<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Flipbook;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function __construct()
    {
        // Hanya pengguna yang terautentikasi yang bisa mengakses controller ini
        $this->middleware('auth');
    }

    // Menampilkan daftar pembelian pengguna yang sedang login
    public function index()
    {
        $purchases = Purchase::where('user_id', Auth::id())->get();
        return view('backend.purchases.index', compact('purchases'));
    }

    // Menampilkan form pembelian untuk flipbook tertentu
    public function create($flipbookId)
    {
        $flipbook = Book::findOrFail($flipbookId);
        return view('backend.purchases.create', compact('flipbook'));
    }

    // Menyimpan pembelian baru
    public function store(Request $request, $flipbookId)
    {
        // Validasi permintaan
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:Credit Card,Bank Transfer,E-Wallet,Other'
        ]);

        $book = Book::findOrFail($flipbookId);

        // Membuat pembelian baru
        $purchase = Purchase::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'purchase_date' => now(),
            'quantity' => $request->input('quantity'),
            'total_amount' => $book->price * $request->input('quantity'),
            'payment_method' => $request->input('payment_method'),
            'payment_status' => -1  // Misalnya, -1 untuk 'Belum Dibayar'
        ]);

        // Lakukan proses pembayaran di sini, misalnya integrasi dengan payment gateway

        return redirect()->route('purchases.index')->with('success', 'Pembelian berhasil dibuat!');
    }

    // Menampilkan detail pembelian tertentu
    public function show(Purchase $purchase)
    {
        session(['url.intended' => url()->previous()]);

        // Pastikan hanya pemilik yang dapat melihat pembelian ini
        if (auth()->id() !== $purchase->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $book = $purchase->book;

        // Jika buku sudah dibeli tapi status belum sukses
        if ($purchase->payment_status != 1) {
            return view('backend.purchases.preview', compact('book', 'purchase'));
        }

        // Jika buku sudah dibeli dan status sukses
        if ($purchase->payment_status == 1) {
            return view('backend.purchases.show', compact('purchase'));
        }

        // Jika tidak memenuhi kondisi di atas, mungkin redirect ke halaman lain
        return redirect()->route('purchases.index')->with('error', 'Pembelian tidak valid.');
    }

    // Menghapus pembelian tertentu
    public function destroy(Purchase $purchase)
    {
        // Pastikan hanya pemilik yang dapat menghapus pembelian ini
        if ($purchase->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan menghapus pembelian ini.');
        }

        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Pembelian berhasil dihapus');
    }

    public function updateStatus(Purchase $purchase, $status)
    {
        if (!auth()->user()->can('admin')) {
            abort(403, 'Unauthorized action.');
        }

        // Validasi status
        if (!in_array($status, [-1, 0, 1, 2])) {
            return redirect()->back()->with('error', 'Status tidak valid');
        }

        $purchase->payment_status = $status;
        $purchase->save();

        return redirect()->route('purchases.index')
            ->with('success', 'Status pembelian berhasil diperbarui');
    }

}
