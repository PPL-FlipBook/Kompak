<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
    ];

    // Menghasilkan UUID secara otomatis saat membuat kategori baru
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->id = (string) Str::uuid();
        });
    }

    // In Category.php
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_categories', 'category_id', 'book_id');
    }

}
