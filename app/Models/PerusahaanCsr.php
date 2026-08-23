<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerusahaanCsr extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan',
        'deskripsi_program',
        'logo',
    ];

    public function pemasukkans()
    {
        return $this->hasMany(Pemasukkan::class, 'perusahaan_csr_id');
    }
}
