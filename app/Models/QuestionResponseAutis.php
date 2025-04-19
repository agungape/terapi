<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionResponseAutis extends Model
{
    use HasFactory;

    protected $fillable = ['anak_id', 'question_autis_id', 'answer'];
}
