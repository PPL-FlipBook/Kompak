<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5); // You can adjust the number of items per page
        return view('backend.kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('kategory.index', $category)->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.kategori.index', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        try {
            $category->save();
            return redirect()->route('kategory.index')->with('success', 'Kategori berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('kategory.index')->with('error', 'Error updating category: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {

        $category = Category::findOrFail($id);
        try {
            $category->delete();
            return redirect()->route('kategory.index')->with('success', 'Kategori berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('kategory.index')->with('error', 'Error deleting category: ' . $e->getMessage());
        }
    }
}
