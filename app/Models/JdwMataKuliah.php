<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JdwMataKuliah extends Model
{
    protected $table = 'jdw_mata_kuliah';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode',
        'nama',
        'sks',
    ];

    protected $casts = [
        'sks' => 'integer',
    ];

    /**
     * Get all jadwal for this mata kuliah
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(JdwJadwal::class, 'mata_kuliah_kode', 'kode');
    }

    /**
     * Get display name with SKS
     */
    public function getDisplayNameAttribute(): string
    {
        return "{$this->nama} ({$this->sks} SKS)";
    }
}
