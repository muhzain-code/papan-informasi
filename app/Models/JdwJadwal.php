<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class JdwJadwal extends Model
{
    protected $table = 'jdw_jadwal';

    protected $fillable = [
        'mata_kuliah_kode',
        'prodi_id',
        'kelas_nama',
        'kelas_status',
        'dosen',
        'hari',
        'jam',
        'ruangan',
        'smt_id',
        'gabung_kelas_nama',
        'gabung_mata_kuliah_kode',
        'gabung_mata_kuliah_nama',
        'gabung_mata_kuliah_sks',
        'synced_at',
    ];

    protected $casts = [
        'synced_at' => 'datetime',
        'gabung_mata_kuliah_sks' => 'integer',
    ];

    // ===== RELATIONSHIPS =====

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(JdwMataKuliah::class, 'mata_kuliah_kode', 'kode');
    }

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(JdwProdi::class, 'prodi_id', 'api_id');
    }

    // ===== SCOPES =====

    public function scopeByHari(Builder $query, string $hari): Builder
    {
        return $query->where('hari', $hari);
    }

    public function scopeByFakultas(Builder $query, string $fakultasId): Builder
    {
        return $query->whereHas('prodi', function ($q) use ($fakultasId) {
            $q->where('fakultas_id', $fakultasId);
        });
    }

    public function scopeByProdi(Builder $query, string $prodiId): Builder
    {
        return $query->where('prodi_id', $prodiId);
    }

    public function scopeBySemester(Builder $query, string $smtId): Builder
    {
        return $query->where('smt_id', $smtId);
    }

    public function scopeByDosen(Builder $query, string $dosen): Builder
    {
        return $query->where('dosen', 'like', "%{$dosen}%");
    }

    public function scopeHariIni(Builder $query): Builder
    {
        $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $today = $days[date('w')];
        return $query->where('hari', $today);
    }

    // ===== ACCESSORS =====

    /**
     * Get formatted dosen name from pipe-separated format
     * Format: "NAMA|GELAR_DEPAN|GELAR_BELAKANG|KODE"
     */
    public function getDosenNamaAttribute(): string
    {
        if (empty($this->dosen)) {
            return 'Belum ditentukan';
        }

        $parts = explode('|', $this->dosen);
        $nama = $parts[0] ?? '';
        $gelarDepan = $parts[1] ?? '';
        $gelarBelakang = $parts[2] ?? '';

        $fullName = trim($gelarDepan . ' ' . $nama);
        if ($gelarBelakang) {
            $fullName .= ', ' . $gelarBelakang;
        }

        return $fullName ?: 'Belum ditentukan';
    }

    /**
     * Get first time slot from jam format
     * Format: "08.00 - 08.40@08.40 - 09.20"
     */
    public function getJamMulaiAttribute(): string
    {
        if (empty($this->jam)) {
            return '-';
        }

        $slots = explode('@', $this->jam);
        $firstSlot = $slots[0] ?? '';
        $times = explode(' - ', $firstSlot);
        
        return str_replace('.', ':', $times[0] ?? '-');
    }

    /**
     * Get last time slot end time
     */
    public function getJamSelesaiAttribute(): string
    {
        if (empty($this->jam)) {
            return '-';
        }

        $slots = explode('@', $this->jam);
        $lastSlot = end($slots);
        $times = explode(' - ', $lastSlot);
        
        return str_replace('.', ':', $times[1] ?? '-');
    }

    /**
     * Get formatted time range
     */
    public function getWaktuAttribute(): string
    {
        return $this->jam_mulai . ' - ' . $this->jam_selesai;
    }

    /**
     * Get prodi singkatan through relationship
     */
    public function getProdiSingkatanAttribute(): string
    {
        return $this->prodi?->singkatan ?? 'N/A';
    }

    /**
     * Get mata kuliah nama through relationship
     */
    public function getMataKuliahNamaAttribute(): string
    {
        return $this->mataKuliah?->nama ?? 'N/A';
    }

    /**
     * Get mata kuliah SKS through relationship
     */
    public function getMataKuliahSksAttribute(): int
    {
        return $this->mataKuliah?->sks ?? 0;
    }
}
