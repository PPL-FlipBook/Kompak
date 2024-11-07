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
        'payment_account',
        'payment_status',
        'payment_proof',
        'bank_bri',
        'bank_bca',
        'bank_mandiri',
        'dana',
        'ovo',
        'gopay',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Relasi ke model SalesInformation (tambahkan ini)
    public function salesInformation()
    {
        return $this->belongsTo(SalesInformation::class);
    }

    public function getStatusTextAttribute()
    {
        $status = [
            -1 => 'Sedang Diproses',
            0 => 'Ditolak',
            1 => 'Sukses',
        ];

        return $status[$this->payment_status] ?? 'Unknown';
    }

    public function scopeExistingPurchase($query, $userId, $bookId)
    {
        return $query->where('user_id', $userId)
            ->where('book_id', $bookId)
            ->whereIn('payment_status', [-1, 0, 1])
            ->latest()
            ->first();
    }
}
