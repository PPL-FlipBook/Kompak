<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    /**
     * Tampilkan daftar rekening bank.
     */
    public function index()
    {
        $bankAccounts = BankAccount::all();
        return view('bank_accounts.index', compact('bankAccounts'));
    }

    /**
     * Tampilkan form untuk menambahkan rekening bank baru.
     */
    public function create()
    {
        return view('bank_accounts.create');
    }

    /**
     * Simpan rekening bank baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255|unique:bank_accounts',
            'account_holder_name' => 'required|string|max:255',
        ]);

        BankAccount::create($request->all());

        return redirect()->route('bank_accounts.index')->with('success', 'Rekening bank berhasil ditambahkan');
    }

    /**
     * Tampilkan form untuk mengedit rekening bank.
     */
    public function edit(BankAccount $bankAccount)
    {
        return view('bank_accounts.edit', compact('bankAccount'));
    }

    /**
     * Update rekening bank yang ada.
     */
    public function update(Request $request, BankAccount $bankAccount)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255|unique:bank_accounts,account_number,' . $bankAccount->id,
            'account_holder_name' => 'required|string|max:255',
        ]);

        $bankAccount->update($request->all());

        return redirect()->route('bank_accounts.index')->with('success', 'Rekening bank berhasil diperbarui');
    }

    /**
     * Hapus rekening bank.
     */
    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->delete();

        return redirect()->route('bank_accounts.index')->with('success', 'Rekening bank berhasil dihapus');
    }
}
