<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anak extends Model
{
    use HasFactory;

    protected $attributes = [
        'status' => 'aktif',
    ];

    protected $fillable = ['nib', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'pendidikan', 'alamat', 'anak_ke', 'total_saudara', 'diagnosa', 'nama_ayah', 'nama_ibu', 'telepon_ayah', 'telepon_ibu', 'umur_ayah', 'umur_ibu', 'pendidikan_ayah', 'pendidikan_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'agama_ayah', 'agama_ibu', 'alamat_ayah', 'alamat_ibu', 'suku_ayah', 'suku_ibu', 'pernikahan_ayah', 'pernikahan_ibu', 'usia_saat_hamil_ayah', 'usia_saat_hamil_ibu', 'status'];

    public function kunjungans(): HasMany
    {
        return $this->hasMany('App\Models\Kunjungan');
    }
}
