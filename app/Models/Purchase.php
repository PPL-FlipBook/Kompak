<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Purchase extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'book_id',
        'purchase_date',
        'quantity',
        'total_amount',
        'payment_method',
        'payment_status',
        'bank_account_id',
    ];

    // Relasi ke tabel BankAccount
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    // Relasi ke tabel Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
