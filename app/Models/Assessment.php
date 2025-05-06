<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = ['file_assessment', 'anak_id', 'psikolog_id'];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }

    public function Psikolog()
    {
        return $this->belongsTo(Psikolog::class);
    }
}
