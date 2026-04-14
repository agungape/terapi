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

    protected $casts = [
        'jumlah' => 'decimal:2',
        'saldo_akhir' => 'decimal:2',
        'tanggal' => 'date',
    ];

    protected function tanggalFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->tanggal ? $this->tanggal->format('d-m-Y') : '-'
        );
    }

    protected function jumlahFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => 'Rp ' . rtrim(rtrim(number_format($this->jumlah, 2, ',', '.'), '0'), ',')
        );
    }

    public static function getTotalPengeluaran(): float
    {
        return (float) self::sum('jumlah');
    }

    protected function saldoakhirFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => 'Rp ' . rtrim(rtrim(number_format($this->saldo_akhir, 2, ',', '.'), '0'), ',')
        );
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo('App\Models\Kategori');
    }
}
