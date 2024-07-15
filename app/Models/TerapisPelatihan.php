<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerapisPelatihan extends Model
{
    protected $table = 'terapis_pelatihan';

    protected $fillable = ['terapis_id', 'pelatihan_id', 'tanggal', 'sertifikat'];

    use HasFactory;
}
