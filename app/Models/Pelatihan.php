<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pelatihan extends Model
{
    use HasFactory;

    public function terapis(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Terapis')->withTimestamps();
    }
}
