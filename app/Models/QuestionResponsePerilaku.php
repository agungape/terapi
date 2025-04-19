<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionResponsePerilaku extends Model
{
    use HasFactory;

    protected $fillable = ['anak_id', 'question_perilaku_id', 'answer'];
}
