<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionPenglihatan extends Model
{
    use HasFactory;

    protected $fillable = ['question_text', 'interpretasi'];
}
