<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anak extends Model
{
    use HasFactory;

    protected $fillable = ['nib', 'nama', 'alamat', 'tanggal_lahir', 'diagnosa', 'jenis_kelamin', 'telepon', 'wali'];

    public function kunjungans(): HasMany
    {
        return $this->hasMany('App\Models\Kunjungan');
    }
}
