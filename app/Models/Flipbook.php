<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flipbook extends Model
{
    use HasFactory;
    // Menentukan kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'title',
        'book_id',
        'status',
        'file_path',
    ];

    // Menentukan kolom-kolom yang harus di-cast
    protected $casts = [
        'status' => 'string',
    ];

    // Relasi ke tabel Book jika diperlukan
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
