<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fisioterapi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kunjungan_id',
        'program_id',
        'aktivitas_terapi',
        'evaluasi',
        'catatan_khusus',
        'pilihan_respons',
        'hasil_kegiatan'
    ];

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
