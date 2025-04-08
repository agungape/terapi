<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['age_group_id', 'question_text'];

    public function ageGroup()
    {
        return $this->belongsTo(AgeGroup::class);
    }
}
