<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionWawancara extends Model
{
    use HasFactory;

    protected $fillable = ['question_text'];
}
