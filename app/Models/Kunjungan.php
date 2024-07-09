<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kunjungan extends Model
{
    use HasFactory;

    protected $fillable = ['anak_id', 'terapis_id', 'catatan', 'status', 'pertemuan'];

    public function anak(): BelongsTo
    {
        return $this->belongsTo('App\Models\Anak');
    }

    public function terapis(): BelongsTo
    {
        return $this->belongsTo('App\Models\Terapis');
    }

    protected static function boot()
    {
        parent::boot();

        // Event 'creating' untuk menetapkan nomor pertemuan
        static::creating(function ($kunjungan) {
            // Cek apakah anak sudah pernah kunjungan sebelumnya
            $lastVisit = Kunjungan::where('anak_id', $kunjungan->anak_id)
                ->orderBy('created_at', 'desc')
                ->first();

            // Jika ada kunjungan sebelumnya, nomor pertemuan +1 dari yang terakhir
            if ($lastVisit) {
                $kunjungan->pertemuan = $lastVisit->pertemuan + 1;
            } else {
                // Jika belum pernah kunjungan sebelumnya, pertemuan diisi dengan 0
                $kunjungan->pertemuan = 1;
            }
        });
    }
}
