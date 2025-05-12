<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = ['file_assessment', 'anak_id', 'psikolog_id', 'assessment_awal', 'diagnosa', 'tanggal_assessment', 'rekomendasi', 'catatan_tambahan', 'tindak_lanjut'];


    protected $casts = [
        'tanggal_assessment' => 'date',
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
