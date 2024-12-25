<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'jenis'];

    public function pemasukkans(): HasMany
    {
        return $this->hasMany('App\Models\Pemasukkan');
    }

    public function pengeluarans(): HasMany
    {
        return $this->hasMany('App\Models\Pengeluaran');
    }
}
