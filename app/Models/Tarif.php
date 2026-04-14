<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tarif extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'tarif',
        'gambar',
        'jumlah_pertemuan',
        'jenis_terapi',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tarif' => 'decimal:2',
    ];

    public function pemasukkans(): HasMany
    {
        return $this->hasMany('App\Models\Pemasukkan');
    }

    public function kunjungans(): HasMany
    {
        return $this->hasMany(Kunjungan::class);
    }

    /**
     * Hitung sisa pertemuan anak dalam paket ini.
     * Berdasarkan kunjungan dengan status hadir yang terhubung ke tarif ini.
     */
    public function sisaPertemuan(int $anakId): int
    {
        if (!$this->jumlah_pertemuan) {
            return 0;
        }

        $terpakai = Kunjungan::where('anak_id', $anakId)
            ->where('tarif_id', $this->id)
            ->where('status', 'hadir')
            ->whereNull('catatan')
            ->count();

        return max(0, $this->jumlah_pertemuan - $terpakai);
    }

    /**
     * Cek apakah paket ini sudah lunas untuk anak tertentu.
     */
    public function sudahLunas(int $anakId): bool
    {
        return Pemasukkan::where('anak_id', $anakId)
            ->where('tarif_id', $this->id)
            ->where('jenis_layanan', 'paket_terapi')
            ->exists();
    }

    /**
     * Get the formatted tarif.
     */
    protected function tarifFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => rtrim(rtrim(number_format($this->tarif, 2, ',', '.'), '0'), ',')
        );
    }
}
