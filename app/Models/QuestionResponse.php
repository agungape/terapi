<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionResponse extends Model
{
    protected $fillable = ['anak_id', 'question_id', 'answer'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
