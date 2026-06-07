<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanGabungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kunjungan_id',
        'program_id',
        'jenis_form',
        'status',
        'keterangan',
        'aktivitas_terapi',
        'respons_anak',
        'kemajuan',
        'kendala',
        'catatan_khusus',
        'catatan_orang_tua',
        'pilihan_respons',
        'hasil_kegiatan',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    protected $casts = [
        'pilihan_respons' => 'array',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
