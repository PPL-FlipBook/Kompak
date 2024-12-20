<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Jika pengguna adalah role 'user dan super admin', ambil semua buku
        if (in_array($user->role, ['user', 'super admin'])) {
            $books = Book::with('categories')->paginate(10);
        } else {
            // Jika pengguna adalah admin, ambil hanya buku yang ditambahkan oleh pengguna tersebut
            $books = Book::with('categories')->where('user_id', $user->id)->paginate(10);
        }

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
        $book->user_id = $request->user()->id;

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

        // Log aktivitas
        activity()
            ->causedBy($request->user())
            ->performedOn($book)
            ->withProperties(['book_id' => $book->id])
            ->log("Buku '{$book->title}' telah dibuat.");

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit buku
    public function edit($id)
    {
        $book = Book::with('categories')->findOrFail($id);
        $categories = Category::all();
        return view('backend.book.edit', compact('book', 'categories'));
    }

    // Memperbarui buku yang ada
    public function update(Request $request, $id )
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
            $book->categories()->sync($request->categories);
        } else {
            $book->categories()->detach();
        }

        if ($request->user()) {
            $subjectId = $book->id;
            Log::debug('Subject ID:', [$subjectId]);

            activity()
                ->performedOn($book)
                ->log($request->user()->name . ' berhasil mengedit buku');
        }

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui');
    }


    // Menghapus buku
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        try {
            $book->categories()->detach();
            $book->delete();
            return redirect()->route('books.index')->with('delete', 'Buku berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('books.index')->with('error', 'Error deleting book: ' . $e->getMessage());
        }
    }

    // Menampilkan flipbook
    public function flipbook($id)
    {
        session(['url.intended' => url()->previous()]);
        $book = Book::findOrFail($id);

        $data = [
            'book' => $book,
            'showSuccessConfirmation' => false
        ];

        // Jika user belum login
        if (!auth()->check()) {
            return view('frontend.book-preview', $data);
        }

        // Jika buku gratis
        if ($book->price == 0) {
            return view('frontend.example1', [
                'book' => $book,
                'showFreeBookMessage' => true
            ]);
        }

        // Jika user sudah login dan buku berbayar
        $existingPurchase = Purchase::where('user_id', auth()->id())
            ->where('book_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($existingPurchase) {
            $data['existingPurchase'] = $existingPurchase;

            if ($existingPurchase->payment_status == 1) {
                $data['showSuccessConfirmation'] = true;
                return view('frontend.example1', $data);
            }
    }

        // Jika buku berbayar dan user belum membeli
        return view('frontend.book-preview', $data);
    }
}
