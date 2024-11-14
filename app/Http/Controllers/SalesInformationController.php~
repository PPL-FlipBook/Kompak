<?php

namespace App\Http\Controllers;

use App\Models\SalesInformation;
use Illuminate\Http\Request;

class SalesInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesInfo = SalesInformation::first();
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

        SalesInformation::create($validatedData);

        return redirect()->route('sales-information.index')
            ->with('success', 'Informasi penjualan berhasil ditambahkan');
    }

    public function update(Request $request, SalesInformation $salesInformation)
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

        $salesInformation->update($validatedData);

        return redirect()->route('sales-information.index')
            ->with('success', 'Informasi penjualan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesInformation $salesInformation)
    {
        $salesInformation->delete();

        return redirect()->route('sales-information.index')
            ->with('success', 'Informasi penjualan berhasil dihapus');
    }
}
