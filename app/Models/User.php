<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'terapis_id',
        'anak_id',      // Link langsung ke data anak (untuk role anak/orang tua)
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active'        => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function getAuthIdentifierName()
    {
        return 'username';
    }

    /**
     * Terapis yang terhubung dengan user ini.
     */
    public function terapis()
    {
        return $this->belongsTo(Terapis::class);
    }

    /**
     * Data anak yang terhubung dengan user ini (untuk role anak/orang tua).
     * Ini adalah relasi RESMI pengganti pencarian via nama.
     */
    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }

    /**
     * Helper: dapatkan data anak dari user yang login.
     * Prioritaskan via anak_id, fallback ke nama (legacy support).
     */
    public function getAnakData(): ?Anak
    {
        if ($this->anak_id) {
            return $this->anak;
        }
        // Legacy fallback: cari berdasarkan nama
        return Anak::where('nama', $this->name)->first();
    }
}
