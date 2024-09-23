<?php

namespace App\Http\Controllers;

use App\Models\Flipbook;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FlipbookController extends Controller
{
    public function index()
    {
        $flipbooks = Flipbook::paginate(10);
        return view('backend.flipbook.index', compact('flipbooks'));
    }

    public function create()
    {
        $books = Book::all(); // Mengambil semua buku untuk opsi saat membuat flipbook
        return view('backend.flipbook.create', compact('books'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validate = $request->validate([
            'title' => 'required|max:255',
            'book_id' => 'required|exists:books,id',
            'status' => 'required|in:Published,Draft',
            'file' => 'required|file|mimes:pdf,zip', // Menyesuaikan jenis file yang diizinkan
        ]);

        // Mengunggah file dan menyimpan path-nya
        $filePath = $request->file('file')->store('flipbooks', 'public');

        // Membuat flipbook baru
        Flipbook::create([
            'title' => $validate['title'],
            'book_id' => $validate['book_id'],
            'status' => $validate['status'],
            'file_path' => $filePath,
        ]);

        return redirect()->route('flipbooks.index')->with('success', 'Flipbook created successfully');
    }

    public function edit($id)
    {
        $flipbook = Flipbook::findOrFail($id);
        $books = Book::all(); // Mengambil semua buku untuk opsi saat mengedit flipbook
        return view('backend.flipbook.edit', compact('flipbook', 'books'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validate = $request->validate([
            'title' => 'required|max:255',
            'book_id' => 'required|exists:books,id',
            'status' => 'required|in:Published,Draft',
            'file' => 'nullable|file|mimes:pdf,zip', // Menyesuaikan jenis file yang diizinkan
        ]);

        $flipbook = Flipbook::findOrFail($id);

        // Update file jika ada
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($flipbook->file_path) {
                Storage::disk('public')->delete($flipbook->file_path);
            }
            // Unggah file baru
            $filePath = $request->file('file')->store('flipbooks', 'public');
            $flipbook->file_path = $filePath;
        }

        // Update data lainnya
        $flipbook->update([
            'title' => $validate['title'],
            'book_id' => $validate['book_id'],
            'status' => $validate['status'],
        ]);

        return redirect()->route('flipbooks.index')->with('success', 'Flipbook updated successfully');
    }

    public function destroy($id)
    {
        $flipbook = Flipbook::findOrFail($id);

        // Hapus file jika ada
        if ($flipbook->file_path) {
            Storage::disk('public')->delete($flipbook->file_path);
        }

        $flipbook->delete();
        return redirect()->route('flipbooks.index')->with('success', 'Flipbook deleted successfully');
    }
}
