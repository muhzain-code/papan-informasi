<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JdwProdi extends Model
{
    protected $table = 'jdw_prodi';
    protected $primaryKey = 'api_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'api_id',
        'nama',
        'singkatan',
        'jenjang',
        'fakultas_id',
    ];

    /**
     * Get the fakultas this prodi belongs to
     */
    public function fakultas(): BelongsTo
    {
        return $this->belongsTo(JdwFakultas::class, 'fakultas_id', 'api_id');
    }

    /**
     * Get all jadwal for this prodi
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(JdwJadwal::class, 'prodi_id', 'api_id');
    }

    /**
     * Get display name with jenjang
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->jenjang ? "{$this->nama} ({$this->jenjang})" : $this->nama;
    }
}
