<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionResponseAutis extends Model
{
    use HasFactory;

    protected $fillable = ['anak_id', 'question_autis_id', 'answer'];

    public function question_autis(): BelongsTo
    {
        return $this->belongsTo('App\Models\QuestionAutis');
    }
}
