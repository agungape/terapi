<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Terapis extends Model
{
    use HasFactory;

    protected $attributes = [
        'status' => 'aktif',
    ];

    protected $fillable = ['nama', 'foto', 'nib', 'tanggal_lahir', 'alamat', 'telepon', 'role', 'perguruan_tinggi', 'jurusan'];

    // protected $casts = [
    //     'tanggal_lahir' => 'date',
    // ];

    public function getUsiaAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    public function pelatihans(): BelongsToMany
    {
        return $this->belongsToMany(Pelatihan::class, 'terapis_pelatihan', 'terapis_id', 'pelatihan_id');
    }

    public function kunjungans(): HasMany
    {
        return $this->hasMany('App\Models\Kunjungan');
    }

    public function jadwals(): HasMany
    {
        return $this->hasMany('App\Models\Jadwal');
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
