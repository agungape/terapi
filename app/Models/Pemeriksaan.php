<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = ['kunjungan_id', 'program_id', 'subjek', 'objek', 'assesment', 'planning'];
}
