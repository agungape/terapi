<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = ['jumlah', 'deskripsi', 'tanggal', 'saldo_akhir', 'gambar', 'kategori_id'];

    protected function tanggal(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => date("d-m-Y", strtotime($value))
        );
    }

    protected function jumlah(): Attribute
    {
        return Attribute::make(
            get: fn($value) => 'Rp ' . rtrim(rtrim(number_format($value, 2, ',', '.'), '0'), ',')
        );
    }

    public static function getTotalPengeluaran(): float
    {
        return self::sum('jumlah');
    }

    protected function saldoakhir(): Attribute
    {
        return Attribute::make(
            get: fn($value) => 'Rp ' . rtrim(rtrim(number_format($value, 2, ',', '.'), '0'), ',')
        );
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo('App\Models\Kategori');
    }
}
