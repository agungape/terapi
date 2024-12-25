<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = ['anak_id', 'tanggal', 'waktu', 'terapis_id', 'pertemuan'];

    protected function tanggal(): Attribute
    {
        return Attribute::make(
            // set: fn($value) => Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d'),
            get: fn(string $value) => date("d-m-Y", strtotime($value))
        );
    }

    public function anak(): BelongsTo
    {
        return $this->belongsTo('App\Models\Anak');
    }

    public function terapis(): BelongsTo
    {
        return $this->belongsTo('App\Models\Terapis');
    }

    // fungsi mutator mengubah nilai tanggal ke dalam bentuk format mysql
    // protected function tanggal(): Attribute
    // {
    //     return Attribute::make(
    //         set: fn($value) => Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d'),
    //         get: function (string $value) {
    //             $nama_bulan = [
    //                 "Januari",
    //                 "Februari",
    //                 "Maret",
    //                 "April",
    //                 "Mei",
    //                 "Juni",
    //                 "Juli",
    //                 "Agustus",
    //                 "September",
    //                 "Oktober",
    //                 "November",
    //                 "Desember"
    //             ];
    //             $tanggal = date("j", strtotime($value));
    //             $bulan = date("n", strtotime($value)) - 1;
    //             $tahun = date("Y", strtotime($value));

    //             return "$tanggal $nama_bulan[$bulan] $tahun";
    //         }
    //     );
    // }

    // protected $casts = [
    //     'mulai' => 'datetime:H:i:s',
    //     'selesai' => 'datetime:H:i:s',
    // ];

}
