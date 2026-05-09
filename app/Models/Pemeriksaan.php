<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = ['kunjungan_id', 'program_id', 'status', 'keterangan', 'pilihan_respons', 'hasil_kegiatan', 'catatan_orang_tua'];

    protected $casts = [
        'pilihan_respons' => 'array'
    ];

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
