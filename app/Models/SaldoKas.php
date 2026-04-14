<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoKas extends Model
{
    use HasFactory;

    protected $fillable = ['saldo_awal'];

    protected $casts = [
        'saldo_awal' => 'decimal:2',
    ];

    protected function saldoawalFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => 'Rp ' . rtrim(rtrim(number_format($this->saldo_awal, 2, ',', '.'), '0'), ',')
        );
    }
}
