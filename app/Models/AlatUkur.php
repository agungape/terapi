<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AlatUkur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'singkatan',
        'domain',
        'min_usia_bulan',
        'max_usia_bulan',
        'min_skor',
        'max_skor',
        'deskripsi',
        'norma_interpretasi',
        'is_active',
    ];

    protected $casts = [
        'norma_interpretasi' => 'array',
        'is_active'          => 'boolean',
    ];

    /**
     * Assessment yang menggunakan alat ukur ini.
     */
    public function assessments(): BelongsToMany
    {
        return $this->belongsToMany(Assessment::class, 'assessment_alat_ukurs')
            ->withPivot(['skor_raw', 'skor_standar', 'persentil', 'klasifikasi', 'catatan', 'is_manual'])
            ->withTimestamps();
    }

    /**
     * Hitung klasifikasi berdasarkan skor dan norma bawaan alat ukur ini.
     */
    public function getKlasifikasi(int $skor): string
    {
        if ($this->norma_interpretasi) {
            foreach ($this->norma_interpretasi as $norma) {
                if ($skor >= ($norma['min'] ?? 0) && $skor <= ($norma['max'] ?? 999)) {
                    return $norma['label'] ?? 'Tidak Diketahui';
                }
            }
        }

        // Default fallback ke norma IQ standar
        return Assessment::getKlasifikasiIQ($skor);
    }

    /**
     * Label domain yang mudah dibaca.
     */
    public function getDomainLabelAttribute(): string
    {
        return match($this->domain) {
            'kognitif'          => 'Kognitif',
            'bahasa'            => 'Bahasa',
            'motorik'           => 'Motorik',
            'sosial_emosional'  => 'Sosial & Emosional',
            'perilaku_adaptif'  => 'Perilaku Adaptif',
            'komprehensif'      => 'Komprehensif (Multi-Domain)',
            default             => 'Lainnya',
        };
    }
}
