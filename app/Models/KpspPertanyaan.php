<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KpspPertanyaan extends Model
{
    use HasFactory;

    protected $table = 'kpsp_pertanyaans';

    protected $fillable = ['kpsp_kelompok_usia_id', 'no_urut', 'pertanyaan', 'bidang'];

    public function kelompokUsia(): BelongsTo
    {
        return $this->belongsTo(KpspKelompokUsia::class, 'kpsp_kelompok_usia_id');
    }

    public function jawabans(): HasMany
    {
        return $this->hasMany(KpspJawaban::class, 'kpsp_pertanyaan_id');
    }

    /**
     * Label bidang perkembangan
     */
    public function getLabelBidangAttribute(): string
    {
        return match ($this->bidang) {
            'PS' => 'Personal-Sosial',
            'MH' => 'Motorik Halus',
            'B'  => 'Bahasa',
            'MK' => 'Motorik Kasar',
            default => $this->bidang,
        };
    }
}
