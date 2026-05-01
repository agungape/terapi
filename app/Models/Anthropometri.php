<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anthropometri extends Model
{
    use HasFactory;

    protected $table = 'anthropometris';

    protected $fillable = [
        'anak_id',
        'tanggal_pengukuran',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'lingkar_lengan_atas',
        'usia_bulan',
        'status_bb_u',
        'status_tb_u',
        'status_bb_tb',
        'status_lk_u',
        'catatan',
    ];

    protected $casts = [
        'tanggal_pengukuran' => 'date',
    ];

    public function anak(): BelongsTo
    {
        return $this->belongsTo(Anak::class);
    }
}
