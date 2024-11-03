<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\CausesActivity;

class User extends Authenticatable
{
    use CausesActivity;
    protected $primaryKey = 'id';  // Mengatur primary key menjadi 'id'
    public $incrementing = false;   // Menghindari auto-increment
    protected $keyType = 'string';   // UUIDs are strings

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Menghasilkan UUID saat model dibuat jika id belum diisi
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    // Kolom yang akan disembunyikan saat serialisasi
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Mengatur tipe data untuk kolom tertentu
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi dengan model Book
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // Relasi dengan model UserRoleTransition
    public function userRoleTransitions() // Penamaan diubah menjadi jamak
    {
        return $this->hasMany(UserRoleTransition::class);
    }
}
