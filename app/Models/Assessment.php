<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_assessment',
        'anak_id',
        'psikolog_id',
        'assessment_awal',       // FIX: field ini ada di DB tapi tidak pernah disimpan
        'tanggal_assessment',
        'rekomendasi',
        'tindak_lanjut',
        'tujuan_pemeriksaan',
        'sumber_asesmen',
        'observasi_awal',
        'kesimpulan_observasi',
        'hasil_pemeriksaan',
        'diagnosa',
        'rekomendasi_orangtua',
        'rekomendasi_terapi',
        'catatan_tambahan',
        'persetujuan_psikolog',
        'alasan_tidak_setuju',
        'kesimpulan',
        // NEW clinical fields
        'keluhan_utama',
        'mood_anak',
        'validitas_hasil',
        'catatan_rapport',
        'kontak_mata',
        'komunikasi',
        'interaksi_sosial',
        'diagnosa_banding',
        'saran_rujukan',
        'prioritas_terapi',
        // NEW scoring fields
        'skor_kognitif',
        'skor_bahasa',
        'skor_motorik',
        'skor_sosial_emosional',
        'skor_perilaku_adaptif',
        'skor_iq_total',
        'klasifikasi',
        'interpretasi_skor',
        'status_bayar',
    ];

    protected $casts = [
        'tanggal_assessment'    => 'date',
        'sumber_asesmen'        => 'array',
        'observasi_awal'        => 'array',
        'hasil_pemeriksaan'     => 'array',
        'rekomendasi_orangtua'  => 'array',
        'rekomendasi_terapi'    => 'array',
        'saran_rujukan'         => 'array',
        'prioritas_terapi'      => 'array',
        'persetujuan_psikolog'  => 'boolean',
    ];

    // ===================== RELATIONS =====================

    public function anak(): BelongsTo
    {
        return $this->belongsTo(Anak::class);
    }

    public function Psikolog(): BelongsTo
    {
        return $this->belongsTo(Psikolog::class);
    }

    /**
     * Alat ukur psikologi yang digunakan dalam assessment ini (many-to-many with scores).
     */
    public function alatUkurs(): BelongsToMany
    {
        return $this->belongsToMany(AlatUkur::class, 'assessment_alat_ukurs')
            ->withPivot(['skor_raw', 'skor_standar', 'persentil', 'klasifikasi', 'catatan', 'is_manual'])
            ->withTimestamps();
    }

    /**
     * Riwayat pembayaran untuk assessment ini.
     */
    public function pemasukkans(): HasMany
    {
        return $this->hasMany(Pemasukkan::class);
    }

    // ===================== HELPERS =====================

    /**
     * Cek apakah assessment ini sudah dibayar.
     */
    public function isBayar(): bool
    {
        return $this->status_bayar === 'lunas' || $this->pemasukkans()->exists();
    }

    /**
     * Hitung skor IQ total otomatis berdasarkan rata-rata domain jika belum ada.
     */
    public function hitungSkorTotal(): ?int
    {
        $scores = array_filter([
            $this->skor_kognitif,
            $this->skor_bahasa,
            $this->skor_motorik,
            $this->skor_sosial_emosional,
            $this->skor_perilaku_adaptif,
        ]);

        if (empty($scores)) {
            return null;
        }

        return (int) round(array_sum($scores) / count($scores));
    }

    /**
     * Dapatkan klasifikasi berdasarkan skor IQ total sesuai standar psikologi.
     */
    public static function getKlasifikasiIQ(int $skor): string
    {
        return match (true) {
            $skor >= 130 => 'Sangat Superior (Very Superior)',
            $skor >= 120 => 'Superior',
            $skor >= 110 => 'Di Atas Rata-rata (High Average)',
            $skor >= 90  => 'Rata-rata (Average)',
            $skor >= 80  => 'Di Bawah Rata-rata (Low Average)',
            $skor >= 70  => 'Batas Lemah (Borderline)',
            default      => 'Sangat Rendah (Extremely Low)',
        };
    }
}
