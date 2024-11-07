<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInformation extends Model
{
    use HasFactory;

    protected $table = 'sales_information';

    protected $fillable = [
        'user_id',
        'email',
        'phone_number',
        'bank_bri',
        'bank_bri_name',
        'bank_bca',
        'bank_bca_name',
        'bank_mandiri',
        'bank_mandiri_name',
        'dana',
        'dana_name',
        'ovo',
        'ovo_name',
        'gopay',
        'gopay_name',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
