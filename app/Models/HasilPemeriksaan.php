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
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }
}
