<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Terapis extends Model
{
    use HasFactory;

    public function pelatihans(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Pelatihan')->withTimestamps();
    }

    public function kunjungans(): HasMany
    {
        return $this->hasMany('App\Models\Kunjungan');
    }
}
