<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiSyncLog extends Model
{
    protected $fillable = [
        'type',
        'records_synced',
        'status',
        'error_message',
        'synced_at',
    ];

    protected $casts = [
        'synced_at' => 'datetime',
        'records_synced' => 'integer',
    ];

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeSuccessful($query)
    {
        return $query->where('status', 'success');
    }

    public static function getLastSync(string $type = 'akm_students'): ?self
    {
        return static::ofType($type)
            ->successful()
            ->latest('synced_at')
            ->first();
    }
}
