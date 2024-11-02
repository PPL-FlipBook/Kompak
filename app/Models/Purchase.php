<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Purchase extends Model
{
    use HasFactory, HasUuids;

    // Daftar kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'user_id',
        'book_id',
        'purchase_date',
        'quantity',
        'total_amount',
        'payment_method',
        'payment_status'
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

    // Jika perlu, buat accessor untuk menampilkan status pembayaran
    public function getStatusTextAttribute()
    {
        $status = [
            -1 => 'Sedang Diproses',
            0 => 'Pembelian Ditolak',
            1 => 'Pembelian Sukses',
        ];

        return $status[$this->payment_status] ?? 'Unknown';
    }
}
