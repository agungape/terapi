<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionResponseWawancara extends Model
{
    use HasFactory;

    protected $fillable = ['anak_id', 'question_wawancara_id', 'answer'];

    public function question_wawancara(): BelongsTo
    {
        return $this->belongsTo('App\Models\QuestionWawancara');
    }
}
