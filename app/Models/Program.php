<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Program extends Model
{
    protected $fillable = ['deskripsi', 'jenis'];

    use HasFactory;

    public function pemeriksaan(): HasOne
    {
        return $this->hasOne('App\Models\Pemeriksaan');
    }

    public function fisioterapis(): HasOne
    {
        return $this->hasOne('App\Models\Fisioterapi');
    }
}
