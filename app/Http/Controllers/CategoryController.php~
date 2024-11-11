<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests; // Pastikan ini ada

    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Category::paginate(5);
        return view('backend.kategori.index', compact('categories'));
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        $this->authorize('create', Category::class);
        return view('backend.kategori.create');
    }

    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('kategory.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->authorize('update', $category);
        return view('backend.kategori.edit', compact('category'));
    }

    // Memperbarui kategori di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $this->authorize('update', $category);

        try {
            $category->name = $request->name;
            $category->save();
            return redirect()->route('kategory.index')->with('success', 'Kategori berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('kategory.index')->with('error', 'Error updating category: ' . $e->getMessage());
        }
    }

    // Menghapus kategori dari database
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $this->authorize('delete', $category);

        try {
            $category->delete();
            return redirect()->route('kategory.index')->with('success', 'Kategori berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('kategory.index')->with('error', 'Error deleting category: ' . $e->getMessage());
        }
    }
}
