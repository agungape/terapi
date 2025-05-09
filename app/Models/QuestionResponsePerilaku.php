<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionResponsePerilaku extends Model
{
    use HasFactory;

    protected $fillable = ['anak_id', 'question_perilaku_id', 'answer'];

    public function question_perilaku(): BelongsTo
    {
        return $this->belongsTo('App\Models\QuestionPerilaku');
    }
}
