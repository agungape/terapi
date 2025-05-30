<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeGroup extends Model
{
    protected $fillable = ['nama'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
