<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAutis extends Model
{
    use HasFactory;

    protected $fillable = ['question_text', 'no_urut', 'section'];

    /**
     * Section A = Pertanyaan ke Orang Tua
     * Section B = Observasi Langsung Terapis
     */
    public function getLabelSectionAttribute(): string
    {
        return match ($this->section ?? 'A') {
            'A' => 'Section A — Pertanyaan ke Orang Tua',
            'B' => 'Section B — Observasi Terapis',
            default => 'Section A',
        };
    }
}
