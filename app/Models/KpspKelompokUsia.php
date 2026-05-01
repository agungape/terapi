<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KpspKelompokUsia extends Model
{
    use HasFactory;

    protected $table = 'kpsp_kelompok_usias';

    protected $fillable = ['kode', 'nama', 'usia_bulan'];

    public function pertanyaans(): HasMany
    {
        return $this->hasMany(KpspPertanyaan::class, 'kpsp_kelompok_usia_id')->orderBy('no_urut');
    }

    public function hasils(): HasMany
    {
        return $this->hasMany(KpspHasil::class, 'kpsp_kelompok_usia_id');
    }
}
