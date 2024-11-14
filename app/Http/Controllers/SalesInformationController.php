<?php

namespace App\Http\Controllers;

use App\Models\SalesInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesInformationController extends Controller
{
    public function __construct()
    {
        // Menggunakan middleware auth untuk memastikan pengguna sudah login
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil informasi penjualan yang terkait dengan pengguna yang sedang login
        $salesInfo = SalesInformation::where('user_id', Auth::id())->first();

        return view('backend.information.index', compact('salesInfo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'phone_number' => 'nullable',
            'bank_bri' => 'nullable',
            'bank_bri_name' => 'nullable',
            'bank_bca' => 'nullable',
            'bank_bca_name' => 'nullable',
            'bank_mandiri' => 'nullable',
            'bank_mandiri_name' => 'nullable',
            'dana' => 'nullable',
            'dana_name' => 'nullable',
            'ovo' => 'nullable',
            'ovo_name' => 'nullable',
            'gopay' => 'nullable',
            'gopay_name' => 'nullable',
        ]);

        // Menambahkan user_id ke data yang disimpan
        $validatedData['user_id'] = Auth::id();

        SalesInformation::create($validatedData);

        return redirect()->route('sales-information.index')
            ->with('success', 'Informasi penjualan berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesInformation $salesInformation)
    {
        // Cek apakah pengguna yang sedang login adalah pemilik informasi penjualan
        if ($salesInformation->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action. Anda tidak memiliki izin untuk memperbarui informasi ini.');
        }

        $validatedData = $request->validate([
            'email' => 'required|email',
            'phone_number' => 'nullable',
            'bank_bri' => 'nullable',
            'bank_bri_name' => 'nullable',
            'bank_bca' => 'nullable',
            'bank_bca_name' => 'nullable',
            'bank_mandiri' => 'nullable',
            'bank_mandiri_name' => 'nullable',
            'dana' => 'nullable',
            'dana_name' => 'nullable',
            'ovo' => 'nullable',
            'ovo_name' => 'nullable',
            'gopay' => 'nullable',
            'gopay_name' => 'nullable',
        ]);

        $salesInformation->update($validatedData);

        return redirect()->route('sales-information.index')
            ->with('success', 'Informasi penjualan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesInformation $salesInformation)
    {
        // Cek apakah pengguna yang sedang login adalah pemilik informasi penjualan
        if ($salesInformation->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action. Anda tidak memiliki izin untuk menghapus informasi ini.');
        }

        $salesInformation->delete();

        return redirect()->route('sales-information.index')
            ->with('success', 'Informasi penjualan berhasil dihapus');
    }
}
