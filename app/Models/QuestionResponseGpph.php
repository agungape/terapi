<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionResponseGpph extends Model
{
    use HasFactory;

    protected $fillable = ['anak_id', 'question_gpph_id', 'answer'];

    public function question_gpph(): BelongsTo
    {
        return $this->belongsTo('App\Models\QuestionGpph');
    }
}
