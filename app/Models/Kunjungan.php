<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kunjungan extends Model
{
    use HasFactory;

    protected $fillable = ['anak_id', 'terapis_id', 'catatan', 'status', 'pertemuan', 'jenis_terapi', 'sesi'];

    protected $dates = ['created_at', 'updated_at'];

    public function anak(): BelongsTo
    {
        return $this->belongsTo('App\Models\Anak');
    }

    public function terapis(): BelongsTo
    {
        return $this->belongsTo('App\Models\Terapis');
    }

    public function pemeriksaans(): HasMany
    {
        return $this->hasMany('App\Models\Pemeriksaan');
    }

    public function tarif(): BelongsTo
    {
        return $this->belongsTo(Tarif::class);
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->locale('id') // Menggunakan bahasa Indonesia
            ->translatedFormat('l, d F Y'); // Format "Hari, Tanggal Bulan Tahun"
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     // Event 'creating' untuk menetapkan nomor pertemuan
    //     static::creating(function ($kunjungan) {
    //         // Cek apakah anak sudah pernah kunjungan sebelumnya
    //         $lastVisit = Kunjungan::where('anak_id', $kunjungan->anak_id)
    //             ->orderBy('created_at', 'desc')
    //             ->first();

    //         // Jika ada kunjungan sebelumnya, nomor pertemuan +1 dari yang terakhir
    //         if ($lastVisit) {
    //             $kunjungan->pertemuan = $lastVisit->pertemuan + 1;
    //         } else {
    //             // Jika belum pernah kunjungan sebelumnya, pertemuan diisi dengan 0
    //             $kunjungan->pertemuan = 1;
    //         }
    //     });
    // }
}
