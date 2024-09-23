<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['title', 'author', 'upload_date', 'status', 'price','pdf_file','cover_image','description', 'user_id',];

    protected $casts = [
        'upload_date' => 'datetime',
        'price' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::creating(function ($book) {
            if (empty($book->id)) {
                $book->id = (string) Str::uuid();
            }
        });
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories', 'book_id', 'category_id');
    }
}