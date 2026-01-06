<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JdwFakultas extends Model
{
    protected $table = 'jdw_fakultas';
    protected $primaryKey = 'api_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'api_id',
        'nama',
        'singkatan',
    ];

    /**
     * Get all prodi under this fakultas
     */
    public function prodi(): HasMany
    {
        return $this->hasMany(JdwProdi::class, 'fakultas_id', 'api_id');
    }

    /**
     * Get all jadwal under this fakultas through prodi
     */
    public function jadwal()
    {
        return $this->hasManyThrough(
            JdwJadwal::class,
            JdwProdi::class,
            'fakultas_id', // FK on jdw_prodi
            'prodi_id',    // FK on jdw_jadwal
            'api_id',      // Local key on jdw_fakultas
            'api_id'       // Local key on jdw_prodi
        );
    }
}
