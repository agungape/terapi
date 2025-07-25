<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_assessment',
        'anak_id',
        'psikolog_id',
        'assessment_awal',
        'tanggal_assessment',
        'rekomendasi',
        'tindak_lanjut',
        'tujuan_pemeriksaan',
        'sumber_asesmen',
        'observasi_awal',
        'hasil_pemeriksaan',
        'diagnosa',
        'rekomendasi_orangtua',
        'rekomendasi_terapi',
        'catatan_tambahan',
        'persetujuan_psikolog',
        'alasan_tidak_setuju',
    ];


    protected $casts = [
        'tanggal_assessment' => 'date',
        'sumber_asesmen' => 'array',
        'observasi_awal' => 'array',
        'hasil_pemeriksaan' => 'array',
        'rekomendasi_orangtua' => 'array',
        'rekomendasi_terapi' => 'array',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }

    public function Psikolog()
    {
        return $this->belongsTo(Psikolog::class);
    }
}
