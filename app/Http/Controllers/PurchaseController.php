<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\SalesInformation;
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
        $freeBooks = Book::where('price', 0)->get(); // Tambahkan ini

        return view('backend.purchases.index', compact('purchases', 'freeBooks'));
    }

    // Menampilkan form pembelian untuk flipbook tertentu
    public function create($flipbookId)
    {
        $flipbook = Book::findOrFail($flipbookId);
        $salesInfo = SalesInformation::first();

        if ($flipbook->price == 0) {
            return redirect()->route('frontend.example1', $flipbook->id);
        }

        return view('backend.purchases.create', compact('flipbook', 'salesInfo'));
    }

    // Menyimpan pembelian baru
    public function store(Request $request, $flipbookId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $book = Book::findOrFail($flipbookId);
        $salesInfo = SalesInformation::first();

        // Handle payment proof upload
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')
                ->store('payment_proofs', 'public');
        }

        // Get account number based on payment method
        $paymentAccount = null;
        switch($request->payment_method) {
            case 'Bank BRI':
                $paymentAccount = $salesInfo->bank_bri;
                break;
            case 'Bank BCA':
                $paymentAccount = $salesInfo->bank_bca;
                break;
            case 'Bank Mandiri':
                $paymentAccount = $salesInfo->bank_mandiri;
                break;
            case 'Dana':
                $paymentAccount = $salesInfo->dana;
                break;
            case 'OVO':
                $paymentAccount = $salesInfo->ovo;
                break;
            case 'GoPay':
                $paymentAccount = $salesInfo->gopay;
                break;
        }

        // Create purchase
        $purchase = Purchase::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'sales_information_id' => $salesInfo->id,
            'purchase_date' => now(),
            'quantity' => $request->quantity,
            'total_amount' => $book->price * $request->quantity,
            'payment_method' => $request->payment_method,
            'payment_account' => $paymentAccount,
            'payment_status' => -1, // Pending
            'payment_proof' => $paymentProofPath,
        ]);

        return redirect()->route('purchases.index')
            ->with('success', 'Pembelian berhasil dibuat dan sedang diproses!');
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
            return view('backend.purchases.show', compact('book', 'purchase'));
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
