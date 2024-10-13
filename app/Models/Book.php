<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Book extends Model
{
    use LogsActivity;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['title', 'author', 'upload_date', 'status', 'price','pdf_file','cover_image','description', 'user_id','description',];

    protected $casts = [
        'upload_date' => 'datetime',
        'price' => 'decimal:2',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable('*') // Mencatat semua field fillable
            ->setDescriptionForEvent(function (string $eventName) {
                $translatedEvent = [
                    'created' => 'dibuat',
                    'updated' => 'diperbarui',
                    'deleted' => 'dihapus',
                ];

                return "Buku '{$this->title}' telah " . ($translatedEvent[$eventName] ?? $eventName) . ".";
            });
    }

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
