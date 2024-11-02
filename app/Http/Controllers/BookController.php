<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\LogActivity;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $books = Book::with('categories')->paginate(10);
        $categories = Category::all();
        $subjectId = LogActivity::latest()->first();
        return view('backend.book.index', compact('books', 'categories', 'subjectId'));
    }

    // Menampilkan form untuk membuat buku baru
    public function create()
    {
        $user = User::all();
        $categories = Category::all();
        return view('backend.book.create', compact('categories', 'user'));
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'upload_date' => 'required|date',
            'status' => 'required|in:Free,Paid',
            'price' => 'nullable|numeric|min:0',
            'pdf_file' => 'nullable|mimes:pdf|max:20480',
            'cover_image' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'categories' => 'array',
            'categories.*' => 'uuid|exists:categories,id',
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->upload_date = $request->upload_date;
        $book->status = $request->status;
        $book->price = $request->price;
        $book->description = $request->description;

        // Menangani file PDF
        if ($request->hasFile('pdf_file')) {
            $pdfFileName = time() . '_' . $request->file('pdf_file')->getClientOriginalName();
            $request->file('pdf_file')->storeAs('public/books/pdf', $pdfFileName);
            $book->pdf_file = $pdfFileName;
        }

        // Menangani gambar sampul
        if ($request->hasFile('cover_image')) {
            $imageFileName = time() . '_' . $request->file('cover_image')->getClientOriginalName();
            $request->file('cover_image')->storeAs('public/books/images', $imageFileName);
            $book->cover_image = $imageFileName;
        }

        // Simpan buku
        $book->save();

        // Menambahkan kategori
        if ($request->filled('categories')) {
            $book->categories()->attach($request->categories);
        }

        if ($request->user()) {
            $subjectId = $book->id;
            Log::debug('Subject ID:', [$subjectId]);

            activity()
                ->performedOn($book)
                ->log($request->user()->name . ' menambahkan buku baru');
        }
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit buku
    public function edit($id)
    {
        $book = Book::with('categories')->findOrFail($id); // Ambil kategori bersama buku
        $categories = Category::all();
        return view('backend.book.edit', compact('book', 'categories'));
    }

    // Memperbarui buku yang ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'upload_date' => 'required|date',
            'status' => 'required|in:Free,Paid',
            'price' => 'nullable|numeric|min:0',
            'pdf_file' => 'nullable|mimes:pdf|max:20480',
            'cover_image' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'categories' => 'array',
            'categories.*' => 'uuid|exists:categories,id',
        ]);

        $book = Book::findOrFail($id);
        $book->fill($request->only(['title', 'author', 'upload_date', 'status', 'price', 'description']));

        // Menangani file PDF
        if ($request->hasFile('pdf_file')) {
            if ($book->pdf_file) {
                Storage::delete('public/books/pdf/' . $book->pdf_file);
            }
            $pdfFileName = time() . '_' . $request->file('pdf_file')->getClientOriginalName();
            $request->file('pdf_file')->storeAs('public/books/pdf', $pdfFileName);
            $book->pdf_file = $pdfFileName;
        }

        // Menangani gambar sampul
        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::delete('public/books/images/' . $book->cover_image);
            }
            $imageFileName = time() . '_' . $request->file('cover_image')->getClientOriginalName();
            $request->file('cover_image')->storeAs('public/books/images', $imageFileName);
            $book->cover_image = $imageFileName;
        }

        // Menyimpan perubahan buku
        $book->save();

        // Mengupdate kategori
        if ($request->filled('categories')) {
            $book->categories()->sync($request->categories); // Menggunakan sync untuk mengupdate kategori
        } else {
            $book->categories()->detach(); // Jika tidak ada kategori yang dipilih, hapus semua
        }

        if ($request->user()) {
            $subjectId = $book->id;
            Log::debug('Subject ID:', [$subjectId]);

            activity()
                ->performedOn($book)
                ->log($request->user()->name . 'Berhasil mengedit buku');
        }

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui');
    }



    // Menghapus buku
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        try {
            // Menghapus hubungan dengan kategori jika diperlukan
            $book->categories()->detach();
            $book->delete();
            return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('books.index')->with('error', 'Error deleting book: ' . $e->getMessage());
        }
    }

    // Menampilkan flipbook
    public function flipbook($id)
    {
        session(['url.intended' => url()->previous()]);
        $book = Book::findOrFail($id);

        // Jika user sudah login
        if (auth()->check()) {
            // Cek apakah user sudah membeli buku ini
            $purchase = Purchase::where('user_id', auth()->id())
                ->where('book_id', $id)
                ->first();

            // Jika belum membeli sama sekali
            if (!$purchase) {
                return view('frontend.book-preview', compact('book'));
            }

            // Jika sudah membeli tapi status belum sukses
            if ($purchase->payment_status != 1) {
                return view('frontend.book-preview', [
                    'book' => $book,
                    'purchase' => $purchase
                ]);
            }

            // Jika sudah membeli dan status sukses
            if ($purchase->payment_status == 1) {
                return view('frontend.example1', compact('book'));
            }
        }

        // Jika user belum login
        return view('frontend.book-preview', compact('book'));
    }
}
