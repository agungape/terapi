<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pemasukkan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah',
        'tarif_id',
        'deskripsi',
        'tanggal',
        'saldo_akhir',
        'gambar',
        'kategori_id',
        // NEW fields
        'anak_id',         // Link langsung ke anak yang membayar
        'assessment_id',   // Link ke assessment yang dibayar (opsional)
        'jenis_layanan',   // Enum: assessment | paket_terapi | lainnya
        'metode_bayar',    // Enum: tunai | transfer
        'sesi_dibayar',    // Sesi keberapa yang dibayar (untuk paket terapi)
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'saldo_akhir' => 'decimal:2',
        'tanggal' => 'date',
    ];

    protected function tanggalFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->tanggal ? $this->tanggal->format('d-m-Y') : '-'
        );
    }

    protected function jumlahFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => 'Rp ' . rtrim(rtrim(number_format($this->jumlah, 2, ',', '.'), '0'), ',')
        );
    }

    public static function getTotalPemasukan(): float
    {
        return (float) self::sum('jumlah');
    }

    protected function saldoakhirFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => 'Rp ' . rtrim(rtrim(number_format($this->saldo_akhir, 2, ',', '.'), '0'), ',')
        );
    }

    // ===================== RELATIONS =====================

    public function kategori(): BelongsTo
    {
        return $this->belongsTo('App\Models\Kategori');
    }

    public function Tarif(): BelongsTo
    {
        return $this->belongsTo('App\Models\Tarif');
    }

    /**
     * Anak yang membayar.
     */
    public function anak(): BelongsTo
    {
        return $this->belongsTo(Anak::class);
    }

    /**
     * Assessment yang dibayar (jika jenis_layanan = assessment).
     */
    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function kunjungans(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'pemasukkan_id');
    }

    // ===================== HELPERS =====================

    /**
     * Ambil jumlah mentah (integer) tanpa format Rp untuk kalkulasi.
     */
    public function getJumlahRawAttribute(): int
    {
        return (int) $this->getRawOriginal('jumlah');
    }

    /**
     * Ambil saldo_akhir mentah (integer) untuk kalkulasi.
     */
    public function getSaldoAkhirRawAttribute(): int
    {
        return (int) $this->getRawOriginal('saldo_akhir');
    }

    /**
     * Hitung sisa pertemuan berdasarkan kwitansi ini.
     * - Untuk paket single: return integer
     * - Untuk paket gabungan: return array ['perilaku' => int, 'fisioterapi' => int]
     * - Untuk assessment/observasi: return null (tidak ada sesi)
     */
    public function getSisaPertemuanAttribute()
    {
        if ($this->jenis_layanan !== 'paket_terapi' || !$this->tarif_id) {
            return null;
        }

        $tarif = $this->tarif;
        if (!$tarif || !$tarif->hasSesi()) {
            return null; // assessment/observasi tidak punya sesi
        }

        if ($tarif->jenis_terapi === 'gabungan') {
            return [
                'perilaku'    => $this->getSisaPertemuanJenis('terapi_perilaku'),
                'fisioterapi' => $this->getSisaPertemuanJenis('fisioterapi'),
            ];
        }

        // Paket single jenis
        $max      = $tarif->jumlah_pertemuan ?? 20;
        $terpakai = $this->kunjungans()
            ->whereIn('status', ['hadir', 'izin_hangus'])
            ->whereDate('created_at', '>=', $this->getRawOriginal('tanggal'))
            ->count();

        return max(0, $max - $terpakai);
    }

    /**
     * Hitung sisa pertemuan untuk jenis terapi tertentu.
     * Digunakan untuk paket gabungan agar per-jenis dihitung terpisah.
     */
    public function getSisaPertemuanJenis(string $jenisTerapi): int
    {
        $tarif = $this->tarif;
        if (!$tarif) return 0;

        $max = $tarif->getPertemuanUntukJenis($jenisTerapi);
        if ($max <= 0) return 0;

        $terpakai = $this->kunjungans()
            ->where('jenis_terapi', $jenisTerapi)
            ->whereIn('status', ['hadir', 'izin_hangus'])
            ->whereDate('created_at', '>=', $this->getRawOriginal('tanggal'))
            ->count();

        return max(0, $max - $terpakai);
    }

    public function getSudahTerpakaiAttribute()
    {
        return $this->kunjungans()
            ->whereIn('status', ['hadir', 'izin_hangus'])
            ->count();
    }
}
