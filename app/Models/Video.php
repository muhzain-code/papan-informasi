<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Video extends Model
{
    use SoftDeletes, LogsActivity;

    protected $table = 'videos';

    protected $fillable = [
        'title',
        'source_type',
        'video_path',
        'video_url',
        'is_active',
        'is_default',
        'start_date',
        'end_date',
        'order',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'is_default' => 'boolean',
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('video')
            ->logOnly($this->fillable)
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(
                fn($event) =>
                "Data video berhasil " .
                    match ($event) {
                        'created' => 'ditambahkan',
                        'updated' => 'diperbarui',
                        'deleted' => 'dihapus',
                        default => $event,
                    } . ' oleh ' . (Auth::user()->name ?? 'Sistem') . '.'
            );
    }

    protected static function booted()
    {
        static::creating(fn($model) => $model->created_by ??= Auth::id());
        static::updating(fn($model) => $model->updated_by = Auth::id());
        static::deleting(
            fn($model) =>
            $model->forceFill(['deleted_by' => Auth::id()])->saveQuietly()
        );
    }

    /**
     * Scope: video yang aktif dan sesuai jadwal hari ini
     * Prioritas: video dengan range tanggal hari ini, fallback ke default
     */
    public function scopePlayableToday($query)
    {
        $today = now('Asia/Jakarta')->toDateString();

        return $query->where('is_active', true)
            ->where(function ($q) use ($today) {
                // Video dengan range tanggal yang mencakup hari ini
                $q->where(function ($q2) use ($today) {
                    $q2->where('is_default', false)
                       ->whereNotNull('start_date')
                       ->whereNotNull('end_date')
                       ->where('start_date', '<=', $today)
                       ->where('end_date', '>=', $today);
                })
                // Atau video default
                ->orWhere('is_default', true);
            });
    }
}
