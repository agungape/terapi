<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'anak_id',
        'jenis',
        'hasil',
        // NEW fields
        'total_skor',
        'interpretasi',
        'catatan_klinis',
        'tanggal_pemeriksaan',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }

    /**
     * Dapatkan label badge warna berdasarkan hasil.
     */
    public function getBadgeClass(): string
    {
        return match (true) {
            str_contains(strtolower($this->hasil), 'normal')         => 'bg-success',
            str_contains(strtolower($this->hasil), 'sesuai')         => 'bg-success',
            str_contains(strtolower($this->hasil), 'penyimpangan')   => 'bg-danger',
            str_contains(strtolower($this->hasil), 'risiko')         => 'bg-warning',
            str_contains(strtolower($this->hasil), 'kemungkinan')    => 'bg-warning',
            default                                                   => 'bg-secondary',
        };
    }
}
