<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcqs extends Model
{
    use HasFactory;

    protected $table = 'mcqs';

    protected $fillable = [
        'quiz_id',
        'question',
        'option1',
        'option2',
        'option3',
        'option4',
        'correct_option',
    ];

    // Relation to quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
