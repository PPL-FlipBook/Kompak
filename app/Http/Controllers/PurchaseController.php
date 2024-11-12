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
        $user = Auth::user();

        // Jika pengguna adalah admin, ambil semua pembelian
        if ($user->role === 'admin') {
            $purchases = Purchase::with('book')->get();
        } elseif ($user->role === 'user') {
            // Jika pengguna adalah user, ambil hanya pembelian mereka
            $purchases = Purchase::where('user_id', $user->id)->get();
        } else {
            // Jika role tidak dikenali, bisa redirect atau abort
            return redirect()->route('dashboard.index')->with('error', 'Akses tidak diizinkan.');
        }

        $freeBooks = Book::where('price', 0)->get();

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

        // Check if sales information exists
        if (!$salesInfo) {
            return redirect()->route('frontend.example1')->with('error', 'Sales information is not available.');
        }

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
            default:
                return back()->withErrors(['payment_method' => 'Metode pembayaran tidak valid.']);
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

        // Cek apakah pengguna adalah admin atau pemilik pembelian
        if (auth()->user()->isAdmin() || auth()->id() === $purchase->user_id) {
            $book = $purchase->book;

            // Jika buku sudah dibeli tapi status belum sukses
            if ($purchase->payment_status != 1) {
                return view('backend.purchases.show', compact('book', 'purchase'));
            }

            // Jika buku sudah dibeli dan status sukses
            if ($purchase->payment_status == 1) {
                return view('backend.purchases.show', compact('purchase'));
            }
        }

        // Jika tidak memenuhi kondisi di atas, abort dengan 403
        abort(403, 'Unauthorized action.');
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
        // Pastikan hanya admin yang mengupload buku yang dapat menyetujui
        $book = $purchase->book;

        // Cek apakah pengguna yang sedang login adalah admin dan pemilik buku
        if (auth()->user()->role !== 'admin' || auth()->user()->id !== $book->user_id) {
            abort(403, 'Unauthorized action. Anda tidak memiliki izin untuk menyetujui pembelian ini.');
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
