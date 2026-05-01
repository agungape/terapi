<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KpspHasil extends Model
{
    use HasFactory;

    protected $table = 'kpsp_hasil';

    protected $fillable = [
        'anak_id',
        'kpsp_kelompok_usia_id',
        'tanggal_pemeriksaan',
        'total_ya',
        'total_tidak',
        'interpretasi',
        'catatan',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
    ];

    public function anak(): BelongsTo
    {
        return $this->belongsTo(Anak::class);
    }

    public function kelompokUsia(): BelongsTo
    {
        return $this->belongsTo(KpspKelompokUsia::class, 'kpsp_kelompok_usia_id');
    }

    /**
     * Label interpretasi lengkap
     */
    public function getLabelInterpretasiAttribute(): string
    {
        return match ($this->interpretasi) {
            'S' => 'Sesuai',
            'M' => 'Meragukan',
            'P' => 'Penyimpangan',
            default => $this->interpretasi,
        };
    }

    /**
     * Warna badge untuk UI
     */
    public function getBadgeColorAttribute(): string
    {
        return match ($this->interpretasi) {
            'S' => 'emerald',
            'M' => 'amber',
            'P' => 'red',
            default => 'slate',
        };
    }
}
