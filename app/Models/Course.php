<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Course extends Model
{
    use SoftDeletes, LogsActivity;

    protected $fillable = [
        'code',
        'name',
        'sks',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('course')
            ->logOnly($this->fillable)
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(
                fn($event) =>
                "Data course berhasil " .
                    match ($event) {
                        'created' => 'ditambahkan',
                        'updated' => 'diperbarui',
                        'deleted' => 'dihapus',
                        default => $event,
                    }
                    . ' oleh ' . (Auth::user()->name ?? 'Sistem') . '.'
            );
    }

    protected static function booted()
    {
        static::creating(fn($m) => $m->created_by ??= Auth::id());
        static::updating(fn($m) => $m->updated_by = Auth::id());

        static::deleting(function ($m) {
            $m->forceFill(['deleted_by' => Auth::id()])->saveQuietly();
        });
    }

    // Relationships
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
