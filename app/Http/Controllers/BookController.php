<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $books = Book::with('categories')->paginate(10); // Fetch paginated books with categories
        $categories = Category::all();
        return view('backend.book.index', compact('books', 'categories'));
    }

    // Menampilkan form untuk membuat buku baru
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('backend.book.create', compact('categories'));
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

        $book = new Book($request->only(['title', 'author', 'upload_date', 'status', 'price', 'description']));

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

        // Menyimpan buku dan mengaitkan kategori
        $book->save();
        if ($request->filled('categories')) {
            $book->categories()->attach($request->categories);
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
        $book = Book::find($id); // Fetch the specific book by ID

        if (!$book) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }

        return view('frontend.example1', compact('book')); // Pass the single book instance
    }
}
