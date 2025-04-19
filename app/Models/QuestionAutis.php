<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAutis extends Model
{
    use HasFactory;

    protected $fillable = ['question_text', 'no_urut'];
}
