<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tarif extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi', 'tarif', 'gambar'];

    public function pemasukkans(): HasMany
    {
        return $this->hasMany('App\Models\Pemasukkan');
    }

    public function kunjungans(): HasMany
    {
        return $this->hasMany(Kunjungan::class);
    }

    protected function tarif(): Attribute
    {
        return Attribute::make(
            get: fn($value) => rtrim(rtrim(number_format($value, 2, ',', '.'), '0'), ',')
        );
    }
}
