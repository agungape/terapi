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

    protected $fillable = ['anak_id', 'terapis_id', 'catatan', 'status', 'pertemuan', 'jenis_terapi', 'sesi', 'terapis_id_pendamping'];

    protected $dates = ['created_at', 'updated_at'];

    public function anak(): BelongsTo
    {
        return $this->belongsTo('App\Models\Anak');
    }

    public function terapis(): BelongsTo
    {
        return $this->belongsTo('App\Models\Terapis');
    }

    public function terapisPendamping(): BelongsTo
    {
        return $this->belongsTo('App\Models\Terapis', 'terapis_id_pendamping');
    }

    public function pemeriksaans(): HasMany
    {
        return $this->hasMany('App\Models\Pemeriksaan');
    }

    public function fisioterapis(): HasMany
    {
        return $this->hasMany('App\Models\Fisioterapi');
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
}
