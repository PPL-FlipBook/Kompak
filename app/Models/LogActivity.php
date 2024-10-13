<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
class LogActivity extends Model
{
    use LogsActivity;

    protected $table = 'activity_log';
    protected $fillable = [
        'description',
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
}
