<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    protected $fillable = ['deskripsi', 'jenis'];

    use HasFactory;

    /**
     * BUGFIX: sebelumnya hasOne — satu program bisa punya BANYAK pemeriksaan.
     */
    public function pemeriksaans(): HasMany
    {
        return $this->hasMany('App\Models\Pemeriksaan');
    }

    /**
     * BUGFIX: sebelumnya hasOne — satu program bisa punya BANYAK fisioterapi.
     */
    public function fisioterapis(): HasMany
    {
        return $this->hasMany('App\Models\Fisioterapi');
    }
}
