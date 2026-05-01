<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KpspJawaban extends Model
{
    use HasFactory;

    protected $table = 'kpsp_jawabans';

    protected $fillable = ['anak_id', 'kpsp_kelompok_usia_id', 'kpsp_pertanyaan_id', 'jawaban'];

    public function anak(): BelongsTo
    {
        return $this->belongsTo(Anak::class);
    }

    public function pertanyaan(): BelongsTo
    {
        return $this->belongsTo(KpspPertanyaan::class, 'kpsp_pertanyaan_id');
    }

    public function kelompokUsia(): BelongsTo
    {
        return $this->belongsTo(KpspKelompokUsia::class, 'kpsp_kelompok_usia_id');
    }
}
