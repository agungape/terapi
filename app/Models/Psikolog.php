<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Psikolog extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'alamat', 'telepon'];

    public function assessments(): HasMany
    {
        return $this->hasMany('App/Models/Assessment');
    }
}
