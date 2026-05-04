<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Anak extends Model
{
    use HasFactory;

    protected $attributes = [
        'status' => 'aktif',
    ];

    protected $fillable = [
        'nib', 'nama', 'foto', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
        'pendidikan', 'alamat', 'anak_ke', 'total_saudara', 'diagnosa',
        'nama_ayah', 'nama_ibu', 'telepon_ayah', 'telepon_ibu',
        'umur_ayah', 'umur_ibu', 'pendidikan_ayah', 'pendidikan_ibu',
        'pekerjaan_ayah', 'pekerjaan_ibu', 'agama_ayah', 'agama_ibu',
        'alamat_ayah', 'alamat_ibu', 'suku_ayah', 'suku_ibu',
        'pernikahan_ayah', 'pernikahan_ibu',
        'usia_saat_hamil_ayah', 'usia_saat_hamil_ibu', 'status',
    ];

    public function getUsiaAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    // ===================== EXISTING RELATIONS =====================

    public function kunjungans(): HasMany
    {
        return $this->hasMany('App\Models\Kunjungan');
    }

    public function jadwals(): HasMany
    {
        return $this->hasMany('App\Models\Jadwal');
    }

    public function observasis(): HasMany
    {
        return $this->hasMany('App\Models\Observasi');
    }

    public function hasilPemeriksaans(): HasMany
    {
        return $this->hasMany(HasilPemeriksaan::class);
    }

    public function assessments(): HasMany
    {
        return $this->hasMany('App\Models\Assessment');
    }

    // ===================== NEW RELATIONS =====================

    /**
     * Akun user (orang tua/anak) yang terhubung ke data anak ini.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * Semua riwayat pembayaran untuk anak ini.
     */
    public function pemasukkans(): HasMany
    {
        return $this->hasMany(Pemasukkan::class);
    }

    /**
     * Cek apakah paket tarif tertentu sudah lunas untuk anak ini.
     */
    public function sudahLunasPaket(int $tarifId): bool
    {
        return $this->pemasukkans()
            ->where('tarif_id', $tarifId)
            ->where('jenis_layanan', 'paket_terapi')
            ->exists();
    }

    /**
     * Dapatkan jumlah sesi terpakai untuk tarif/paket tertentu.
     */
    public function sesiTerpakaiPaket(int $tarifId): int
    {
        return $this->kunjungans()
            ->where('tarif_id', $tarifId)
            ->where('status', 'hadir')
            ->whereNull('catatan')
            ->count();
    }
    /**
     * Cari Kwitansi/Pemasukkan aktif (yang masih ada sisa sesi) untuk jenis terapi tertentu.
     * Menggunakan metode FIFO (First In First Out) - Kwitansi terlama dihabiskan dulu.
     */
    public function kwitansiAktif(string $jenisTerapi)
    {
        $pemasukkans = $this->pemasukkans()
            ->where('jenis_layanan', 'paket_terapi')
            ->whereNotNull('tarif_id')
            ->whereDate('tanggal', '<=', date('Y-m-d'))
            ->orderBy('id', 'asc')
            ->get();

        foreach ($pemasukkans as $p) {
            $tarif = $p->tarif;
            if (!$tarif) continue;

            $tarifJenis  = strtolower(str_replace(' ', '_', $tarif->jenis_terapi ?? ''));
            $searchJenis = strtolower(str_replace(' ', '_', $jenisTerapi));

            // Paket gabungan / semua: cocok dengan semua jenis terapi
            if (in_array($tarifJenis, ['gabungan', 'semua'])) {
                // Cek sisa khusus per-jenis agar tidak salah hitung
                $sisaJenis = $p->getSisaPertemuanJenis($searchJenis);
                if ($sisaJenis > 0) {
                    return $p;
                }
                continue;
            }

            // Paket single jenis: harus cocok persis
            if ($tarifJenis !== $searchJenis) continue;

            $sisa = $p->sisa_pertemuan;
            if (is_int($sisa) && $sisa > 0) {
                return $p;
            }
        }

        return null;
    }
}

