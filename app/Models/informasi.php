<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class informasi extends Model
{
    use HasFactory;

    protected $fillable = ['informasi'];

    protected static function booted()
    {
        // Cek saat model di-boot (pertama kali digunakan)
        if (self::count() === 0) {
            self::create([
                'informasi' => '',
            ]);
        }
    }
}
