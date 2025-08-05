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
        'respons_anak',
        'kemajuan',
        'kendala',
        'catatan_khusus'
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
