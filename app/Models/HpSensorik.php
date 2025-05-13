<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HpSensorik extends Model
{
    use HasFactory;

    protected $fillable = ['deskripsi', 'anak_id'];
}
