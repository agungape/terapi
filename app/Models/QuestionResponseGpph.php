<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionResponseGpph extends Model
{
    use HasFactory;

    protected $fillable = ['anak_id', 'question_gpph_id', 'answer'];
}
