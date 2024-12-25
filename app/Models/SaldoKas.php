<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoKas extends Model
{
    use HasFactory;

    protected $fillable = ['saldo_awal'];

    protected function saldoawal(): Attribute
    {
        return Attribute::make(
            get: fn($value) => 'Rp ' . rtrim(rtrim(number_format($value, 2, ',', '.'), '0'), ',')
        );
    }
}
