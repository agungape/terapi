<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssessmentAlatUkur extends Model
{
    use HasFactory;

    protected $table = 'assessment_alat_ukurs';

    protected $fillable = [
        'assessment_id',
        'alat_ukur_id',
        'skor_raw',
        'skor_standar',
        'persentil',
        'klasifikasi',
        'catatan',
        'is_manual',
    ];

    protected $casts = [
        'is_manual' => 'boolean',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function alatUkur(): BelongsTo
    {
        return $this->belongsTo(AlatUkur::class);
    }
}
